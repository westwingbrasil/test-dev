<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class NovoController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    return view('novo', array('type' => '', 'msg' => ''));
  }

  /**
   * Save the Ticket by Transaction.
   *
   * @param  object  $request
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function saveData(Request $request)
  {
    $transaction = DB::transaction(function () use ($request) {
      $client_id = 0;
      $client = DB::table('clients')
        ->select('id', 'email')
        ->where('email', 'like', $request->input('email'))
        ->get();

      if (isset($client[0]) && $request->input('email') === $client[0]->email) {
        $client_id = $client[0]->id;
      } else {
        $client_id = DB::table('clients')->insertGetId(
          ['name' => $request->input('name'),
           'email' => $request->input('email'),
           'created_at' => date('Y-m-d H:i:s')]
        );
      }

      if ($client_id) {
        $order_id = 0;
        $update = false;
        $order = DB::table('orders')
          ->select('id', 'client_id')
          ->where('id', '=', $request->input('order_id'))
          ->get();

        if (isset($order[0]) && intval($request->input('order_id')) === $order[0]->id) {
          if ($order[0]->client_id !== $client_id) {
            $error = 'N° do pedido já existe para outro cliente!';
            return $error;
          } else {
            $order_id = $order[0]->id;
            $update = true;
          }
        } else {
          $order_id = DB::table('orders')->insertGetId(
            [
              'client_id' => $client_id,
              'o_title' => 'Pedido do Cliente ' . $request->input('name'),
              'created_at' => date('Y-m-d H:i:s')
            ]
          );
        }

        if ($order_id) {
          $ticket_id = 0;
          if ($update) {
            $ticket = DB::table('tickets')
              ->select('id')
              ->where('client_id', '=', $client_id)
              ->where('order_id', '=', $order_id)
              ->get();
            if (isset($ticket[0])) {
              $ticket_id = $ticket[0]->id;
              DB::table('tickets')
                ->where('id', $ticket_id)
                ->update([
                  't_title' => $request->input('title'),
                  'content' => $request->input('content'),
                  'updated_at' => date('Y-m-d H:i:s')
                ]);
            } else {
              $error = 'Não foi possível obter o ticket';
              throw new Exception($error);
            }
          } else {
            $ticket_id = DB::table('tickets')->insertGetId(
              [
                'client_id' => $client_id,
                'order_id' => $order_id,
                't_title' => $request->input('title'),
                'content' => $request->input('content'),
                'created_at' => date('Y-m-d H:i:s')
              ]
            );
          }

          return array('update' => $update, 'ticket_id' => $ticket_id);
        } else {
          $error = 'Não foi possível obter o pedido';
          throw new Exception($error);
        }
      } else {
        $error = 'Não foi possível obter o cliente';
        throw new Exception($error);
      }
    });

    $ret = '';

    if (is_array($transaction)) {
      $cpl = ($transaction['update']) ? ' atualizado ' : ' cadastrado ';
      $msg = 'Ticket ' . $transaction['ticket_id'] . $cpl . 'com sucesso!';
      $ret = view('novo', array('type' => 'success', 'msg' => $msg));
    } else {
      $ret = view('novo', array('type' => 'danger', 'msg' => $transaction));
    }

    return $ret;
  }
}
