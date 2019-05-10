@extends('tickets.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 mt-2" >
        <div class=" float-right">
            <a class="btn btn-info" href="{{ route('tickets.index') }}"> Relatório de tickets</a>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 margin-tb flex-center">
        <div>
            <h2>Visualizar Ticket</h2>
        </div>
    </div>
</div>
  
<div class="row flex-center">
    <div class="card mt-4">
        <div class="card-header">
        Ticket
        </div>
        <div class="card-body">
            <div class="col-xs-12 col-sm-12 col-md-12"> 
                    <div class="form-group">
                        <strong>Titulo:</strong>
                        {{ $ticket->title }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Conteúdo:</strong>
                        {{ $ticket->content }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Cliente:</strong>
                        {{ $ticket->name }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Numero do Pedido:</strong>
                        {{ $ticket->code }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Criado em:</strong>
                        {{ $ticket->created_at->format('d/m/Y h:i:s') }}
                    </div>
                </div>
        </div>
    </div>
   
    </div>
@endsection