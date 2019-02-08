<?php
namespace App\Http\Controllers;

use App\Facades\ClienteFacade;
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
     * Get filtered data for datatables
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFilteredData(Request $request)
    {
        /** Recovers parameters */
        $column = $request->get('column');
        $order = $request->get('order');
        $perPage = $request->get('per_page');
        /** Initialize validator */
        $validator = Validator::make($request->all(),[
            'column' => 'required',
            'order' => 'required',
            'per_page' => 'required',
        ]);
        /** If validator fails */
        if ($validator->fails())
        {
            return response()->json(['success' => false, 'error_messages' => $validator->errors()],401);
        }
        /** Try to recover data */
        try
        {
            return response()->json(['success' => true, 'data' => TicketFacade::getForDataTable($column, $order, $perPage)], 200);
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
        $ticketClienteNome = $request->get('cliente_nome');
        $ticketClienteEmail = $request->get('cliente_email');
        $ticketTitulo = $request->get('titulo');
        $ticketDesc = $request->get('descricao');
        /** Initialize validator */
        $validator = Validator::make($request->all(),[
            'pedido_id' => 'required',
            'cliente_nome' => 'required',
            'cliente_email' => 'required',
            'titulo' => 'required',
            'descricao' => 'required'
        ]);
        /** If validator fails */
        if ($validator->fails())
        {
            return response()->json(['success' => false, 'error_messages' => $validator->errors()],406);
        }

        try {
            $arrayInsertData = [
                'pedido_id' => $ticketPedidoId,
                'titulo' => $ticketTitulo,
                'descricao' => $ticketDesc
            ];

            if(ClienteFacade::getByEmail($ticketClienteEmail)) {
                $tickets = TicketFacade::getByFiller();
                if($tickets) {
                    $arrayUpdateData = [
                        'id' => $tickets->id,
                        'pedido_id' => $ticketPedidoId,
                        'titulo' => $ticketTitulo,
                        'descricao' => $ticketDesc
                    ];

                    $updateTicket = TicketFacade::storeData($arrayUpdateData);

                    if(strpos($updateTicket, 'Erro')) {
                        return response()->json(['success' => false, 'error_messages' => $updateTicket],401);
                    }

                    return response()->json(['success' => true, 'data' => $updateTicket],200);
                } else {
                    $storeTicket = TicketFacade::storeData($arrayInsertData);

                    if(strpos($storeTicket, 'Erro')) {
                        return response()->json(['success' => false, 'error_messages' => $storeTicket],401);
                    }

                    return response()->json(['success' => true, 'data' => $storeTicket],200);
                }
            } else {
                $clienteArray = [
                    'nome' => $ticketClienteNome,
                    'email' => $ticketClienteEmail
                ];

                $storeCliente = ClienteFacade::storeData($clienteArray);

                if(strpos($storeCliente, 'Erro')) {
                    return response()->json(['success' => false, 'error_messages' => $storeCliente],401);
                }

                $storeTicket = TicketFacade::storeData($arrayInsertData);

                if(strpos($storeTicket, 'Erro')) {
                    return response()->json(['success' => false, 'error_messages' => $storeTicket],401);
                }

                return response()->json(['success' => true, 'data' => $storeTicket],200);
            }
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
