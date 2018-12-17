@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Lista de tickets</div>
                    <form method="get" action="{{ url('/tickets/search') }}">
                        <div class="card-body row no-gutters align-items-center">
                            <div class="col">
                                <input class="form-control form-control" name="search" type="search" placeholder="buscar...">
                            </div>
                            <div class="col-auto">
                                <button class="btn btn btn-success" type="submit"><i class="fas fa-search" style="font-size: 20px;"></i></button>
                            </div>
                        </div>
                    </form>
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-info alert-dismissible fade show">
                                {{ session()->get('message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <table class="table col-sm-12">
                            <tr>
                                <th class="custom-table-head custom-table"> Cliente </th>
                                <th class="custom-table-head custom-table" width="150px"> N° do pedido</th>
                                <th class="custom-table-head custom-table">  </th>
                                <th class="custom-table-head custom-table">  </th>
                                <th class="custom-table-head custom-table">  </th>
                            <tr>

                            @foreach ($tickets as $ticket)
                                <tr>
                                    @if(isset( $ticket->client ))
                                        <td class="custom-table">{{ $ticket->client->client_name }}</td>
                                    @endif
                                    <td class="custom-table"> {{ $ticket->ticket_order }} </td>
                                    <td class="custom-table">
                                        <a class="btn btn-primary" href="{{ url('tickets/details') . '/' . $ticket->ticket_id }}">
                                            Detalhes
                                        </a>
                                    </td>
                                    <td class="custom-table">
                                        <a class="btn btn-primary" href="{{ url('tickets/update') . '/' . $ticket->ticket_id }}">
                                            Editar
                                        </a>
                                    </td>
                                    <td class="custom-table">
                                        <a class="btn btn-danger" href="{{ url('tickets/delete') . '/' . $ticket->ticket_id }}" onclick="return confirm(' Você Deseja Realmente excluir ? ')" >
                                            Excluir
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                            {{ $tickets->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
