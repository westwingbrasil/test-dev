@extends('tickets.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 mt-2" >
        <div class=" float-right">
            <a class="btn btn-info" href="{{ route('tickets.create') }}"> Cadastrar tickets</a>
            <a class="btn btn-info" href="{{ route('tickets.index') }}"> Listar tickets</a>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 margin-tb flex-center">
        <div>
            <h2>Relatório de Tickets</h2>
        </div>
    </div>
</div>
 
<div class="row mb-4 mt-4">
    <div class="col-xs-12 col-sm-12 col-md-12"> 
        <form action="{{route('tickets.report')}}" method="POST">
            {!! csrf_field() !!}
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" name="email" placeholder="Email">
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="order_code" placeholder="Número do pedido">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>
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
        @if (isset($params))
            {!! $tickets->appends($params)->links() !!}
        @else
            {!! $tickets->links() !!}
        @endif
    </div>
</div>
      
@endsection