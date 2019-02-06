<?php
namespace App\Http\Controllers;

use App\Facades\TicketFacade;
use Http\Client\Exception\HttpException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    /**
     * Display a listing of the tickets.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTickets()
    {
        try
        {
            return response()->json(['success' => true, 'data' => TicketFacade::getAll()], 200);
        }
        catch (HttpException $httpException)
        {
            return response()->json(['success' => false, 'error_message' => $httpException->getMessage()], $httpException->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getTicketById(Request $request)
    {
        /** Recovers parameters */
        $ticketId = $request->get('id');
        /** Initialize validator */
        $validator = Validator::make($request->all(),[
            'id' => 'required',
        ]);
        /** If validator fails */
        if ($validator->fails())
        {
            return response()->json(['success' => false, 'error_messages' => $validator->errors()],401);
        }
        /** Try to recover data */
        try
        {
            return response()->json(['success' => true, 'data' => TicketFacade::getById($ticketId)], 200);
        }
        catch (HttpException $httpException)
        {
            return response()->json(['success' => false, 'error_message' => $httpException->getMessage()], $httpException->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTicket(Request $request)
    {
        /** Recovers parameters */
        $ticketPedidoId = $request->get('pedido_id');
        $ticketTitulo = $request->get('titulo');
        $ticketDesc = $request->get('descricao');
        /** Initialize validator */
        $validator = Validator::make($request->all(),[
            'pedido_id' => 'required',
            'titulo' => 'required',
            'descricao' => 'required'
        ]);
        /** If validator fails */
        if ($validator->fails())
        {
            return response()->json(['success' => false, 'error_messages' => $validator->errors()],401);
        }

        $arrayData = [
            'pedido_id' => $ticketPedidoId,
            'titulo' => $ticketTitulo,
            'descricao' => $ticketDesc
        ];

        try {
            return response()->json(['success' => true, 'data' => TicketFacade::storeData($arrayData)],200);
        }
        catch (HttpException $httpException)
        {
            return response()->json(['success' => false, 'error_message' => $httpException->getMessage()], $httpException->getCode());
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateTicket(Request $request)
    {
        /** Recovers parameters */
        $ticketId = $request->get('id');
        $ticketTitulo = $request->get('titulo');
        $ticketDesc = $request->get('descricao');
        /** Initialize validator */
        $validator = Validator::make($request->all(),[
            'id' => 'required',
            'titulo' => 'required',
            'descricao' => 'required'
        ]);
        /** If validator fails */
        if ($validator->fails())
        {
            return response()->json(['success' => false, 'error_messages' => $validator->errors()],401);
        }

        $arrayData = [
            'id' => $ticketId,
            'titulo' => $ticketTitulo,
            'descricao' => $ticketDesc
        ];

        try {
            return response()->json(['success' => true, 'data' => TicketFacade::updateData($arrayData)],200);
        }
        catch (HttpException $httpException)
        {
            return response()->json(['success' => false, 'error_message' => $httpException->getMessage()], $httpException->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroyTicket(Request $request)
    {
        /** Recovers parameters */
        $ticketId = $request->get('id');
        /** Initialize validator */
        $validator = Validator::make($request->all(),[
            'id' => 'required',
        ]);
        /** If validator fails */
        if ($validator->fails())
        {
            return response()->json(['success' => false, 'error_messages' => $validator->errors()],401);
        }
        /** Try to recover data */
        try
        {
            return response()->json(['success' => true, 'data' => TicketFacade::destroyById($ticketId)], 200);
        }
        catch (HttpException $httpException)
        {
            return response()->json(['success' => false, 'error_message' => $httpException->getMessage()], $httpException->getCode());
        }
    }
}
