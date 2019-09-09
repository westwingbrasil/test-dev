<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tickets_query = DB::table('tickets')
            ->join('orders', 'orders.order_id', 'tickets.order_id')
            ->join('users', 'users.user_id', 'orders.user_id')
            ->select('tickets.*', 'users.email AS user_email');

        if ($request->input('email')) {
            $tickets_query->where('users.email', $request->input('email'));
        }
        if ($request->input('order_id')) {
            $tickets_query->where('tickets.order_id', $request->input('order_id'));
        }

        $tickets = $tickets_query->oldest()->paginate(5);
        session()->flashInput($request->input());
        return view('tickets.index', ['tickets' => $tickets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email:strict|max:255',
            'order' => 'required|integer',
            'subject' => 'required',
            'body' => 'required'
        ]);

        $validated = $validator->validate();

        $user_id = DB::table('users')->where('email', $validated['email'])->value('user_id');
        if (!$user_id) {
            // TODO: handle insertion failure
            $user_id = DB::table('users')->insertGetId([
                'name' => $request->input('name'),
                'email' => $validated['email']
            ], 'user_id');
        }

        // Since the order_id is given by the user when filling in the form,
        // we don't need to get a value generated by the database.
        // What this means for us is we can just save it to the database if
        // it doesn't belong to another user. This query is kind of a wonky
        // way to do it while trying to minimize race conditions.
        //
        // Basically, if the inner SELECT returns nothing, it could mean
        // such order doesn't exist or it doesn't belong the requesting user.
        // If the INSERT fails with a primary key constraint violation, we now
        // know the order does exist, but belongs to another user.
        // If it doesn't fail with that error, we know the order didn't exist
        // in the first place, but the provided order_id maps to it.
        try {
            DB::insert('
                INSERT INTO
                    orders (order_id, user_id)
                SELECT
                    ?, ?
                FROM
                    DUAL
                WHERE NOT EXISTS(
                    SELECT
                        1
                    FROM
                        orders
                    WHERE
                        (order_id, user_id) = (?, ?)
                )
                LIMIT 1;
            ', [$validated['order'], $user_id, $validated['order'], $user_id]);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e ->getCode() === '23000') {
                $validator->errors()->add('order', 'Order #'.$validated['order'].' was not found in your orders');
                return redirect()->route('tickets.create')->withErrors($validator)->withInput();
            }

            // TODO: proper handling of other errors
        }

        // TODO: handle insertion failure
        $saved_ticket = DB::insert('
            INSERT INTO
                tickets (order_id, subject, body)
            VALUES
                (:order_id, :subject, :body)
            ON DUPLICATE KEY UPDATE subject = VALUES(subject), body = VALUES(body)
        ', ['order_id' => $validated['order'], 'subject' => $validated['subject'], 'body' => $validated['body']]);

        $request->session()->flash('alert-success', 'Your ticket has been created!');
        return redirect()->route('tickets.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = DB::table('tickets')
            ->join('orders', 'orders.order_id', 'tickets.order_id')
            ->join('users', 'users.user_id', 'orders.user_id')
            ->where('ticket_id', $id)
            ->select('tickets.*', 'users.email AS user_email', 'users.name AS user_name')
            ->first();

        return view('tickets.show', ['ticket' => $ticket]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
