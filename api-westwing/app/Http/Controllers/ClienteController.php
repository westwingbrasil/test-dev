<?php

namespace App\Http\Controllers;

use App\Facades\ClienteFacade;
use Http\Client\Exception\HttpException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    /**
     * Display a listing of the clients.
     *
     * @return \Illuminate\Http\Response
     */
    public function getClients()
    {
        try
        {
            return response()->json(['success' => true, 'data' => ClienteFacade::getAll()], 200);
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
    public function getClientById(Request $request)
    {
        /** Recovers parameters */
        $clientId = $request->get('id');
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
            return response()->json(['success' => true, 'data' => ClienteFacade::getById($clientId)], 200);
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
    public function storeClient(Request $request)
    {
        /** Recovers parameters */
        $clientName = $request->get('nome');
        $clientEmail = $request->get('email');
        /** Initialize validator */
        $validator = Validator::make($request->all(),[
            'nome' => 'required',
            'email' => 'required'
        ]);
        /** If validator fails */
        if ($validator->fails())
        {
            return response()->json(['success' => false, 'error_messages' => $validator->errors()],401);
        }

        $arrayData = [
          'nome' => $clientName,
          'email' => $clientEmail
        ];

        try {
            return response()->json(['success' => true, 'data' => ClienteFacade::storeData($arrayData)],200);
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
    public function updateClient(Request $request)
    {
        /** Recovers parameters */
        $clientId = $request->get('id');
        $clientName = $request->get('nome');
        /** Initialize validator */
        $validator = Validator::make($request->all(),[
            'nome' => 'required',
            'email' => 'required'
        ]);
        /** If validator fails */
        if ($validator->fails())
        {
            return response()->json(['success' => false, 'error_messages' => $validator->errors()],401);
        }

        $arrayData = [
            'id' => $clientId,
            'nome' => $clientName
        ];

        try {
            return response()->json(['success' => true, 'data' => ClienteFacade::updateData($arrayData)],200);
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
    public function destroyClient(Request $request)
    {
        /** Recovers parameters */
        $clientId = $request->get('id');
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
            return response()->json(['success' => true, 'data' => ClienteFacade::destroyById($clientId)], 200);
        }
        catch (HttpException $httpException)
        {
            return response()->json(['success' => false, 'error_message' => $httpException->getMessage()], $httpException->getCode());
        }
    }
}
