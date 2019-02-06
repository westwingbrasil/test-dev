<?php

namespace App\Http\Controllers;

use App\Facades\PedidoFacade;
use Http\Client\Exception\HttpException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PedidoController extends Controller
{
    /**
     * Display a listing of the pedidos.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPedidos()
    {
        try
        {
            return response()->json(['success' => true, 'data' => PedidoFacade::getAll()], 200);
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
    public function getPedidoById(Request $request)
    {
        /** Recovers parameters */
        $pedidoId = $request->get('id');
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
            return response()->json(['success' => true, 'data' => PedidoFacade::getById($pedidoId)], 200);
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
    public function storePedido(Request $request)
    {
        /** Recovers parameters */
        $pedidoTitulo = $request->get('titulo');
        $pedidoDesc = $request->get('descricao');
        /** Initialize validator */
        $validator = Validator::make($request->all(),[
            'titulo' => 'required',
            'descricao' => 'required'
        ]);
        /** If validator fails */
        if ($validator->fails())
        {
            return response()->json(['success' => false, 'error_messages' => $validator->errors()],401);
        }

        $arrayData = [
            'titulo' => $pedidoTitulo,
            'descricao' => $pedidoDesc
        ];

        try {
            return response()->json(['success' => true, 'data' => PedidoFacade::storeData($arrayData)],200);
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
    public function updatePedido(Request $request)
    {
        /** Recovers parameters */
        $pedidoId = $request->get('id');
        $pedidoTitulo = $request->get('titulo');
        $pedidoDesc = $request->get('descricao');
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
            'id' => $pedidoId,
            'titulo' => $pedidoTitulo,
            'descricao' => $pedidoDesc
        ];

        try {
            return response()->json(['success' => true, 'data' => PedidoFacade::updateData($arrayData)],200);
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
    public function destroyPedido(Request $request)
    {
        /** Recovers parameters */
        $pedidoId = $request->get('id');
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
            return response()->json(['success' => true, 'data' => PedidoFacade::destroyById($pedidoId)], 200);
        }
        catch (HttpException $httpException)
        {
            return response()->json(['success' => false, 'error_message' => $httpException->getMessage()], $httpException->getCode());
        }
    }
}
