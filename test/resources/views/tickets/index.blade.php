@extends('tickets.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 mt-2" >
        <div class=" float-right">
            <a class="btn btn-info" href="{{ route('tickets.create') }}"> Cadastrar tickets</a>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 margin-tb flex-center">
        <div>
            <h2>Lista de Tickets</h2>
        </div>
    </div>
</div>
  
<div class="row flex-center">
    <div class="col-xs-12 col-sm-12 col-md-12"> 
        <table class="table table-bordered">
            <tr>
                <th>Número do ticket</th>
                <th>Número do pedido</th>
                <th>Título do Pedido</th>
                <th>E-mail do cliente</th>
                <th>Data de criação do ticket</th>
                <th>Action</th>
            </tr>
            @foreach ($tickets as $ticket)
            <tr>
                <td>{{ $ticket->id }}</td>
                <td>{{ $ticket->code }}</td>
                <td>{{ $ticket->title }}</td>
                <td>{{ $ticket->email }}</td>
                <td> {{ $ticket->created_at->format('d/m/Y h:i:s') }}</td>
                <td>
                        <a class="btn btn-info" href="{{ route('tickets.show',$ticket->id) }}">Ver</a>
                </td>
            </tr>
            @endforeach
        </table>
  
        {!! $tickets->links() !!}
    </div>
</div>
      
@endsection