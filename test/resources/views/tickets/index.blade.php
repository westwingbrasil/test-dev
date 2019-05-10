@extends('tickets.layout')
  
@section('content')
<div class="row mt-3">
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
            </tr>
            @foreach ($tickets as $ticket)
            <tr>
                <td>{{ $ticket->id }}</td>
                <td>{{ $ticket->code }}</td>
                <td>{{ $ticket->title }}</td>
                <td>{{ $ticket->email }}</td>
                <td> {{ $ticket->created_at->format('d/m/Y h:i:s') }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
      
@endsection