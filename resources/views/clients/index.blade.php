@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Lista de clientes</div>
                    <form method="get" action="{{ url('/clients/search') }}">
                        <div class="card-body row no-gutters align-items-center">
                            <div class="col-auto">
                                <i class="fas fa-search h4 text-body"></i>
                            </div>
                            <!--end of col-->
                            <div class="col">
                                <input class="form-control form-control" name="search" type="search" placeholder="buscar...">
                            </div>
                            <!--end of col-->
                            <div class="col-auto">
                                <button class="btn btn btn-success" type="submit">Buscar</button>
                            </div>
                            <!--end of col-->
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
                                <th class="custom-table-head custom-table"> Nome </th>
                                <th class="custom-table-head custom-table" width="150px"> Email </th>
                                <th class="custom-table-head custom-table">  </th>
                                <th class="custom-table-head custom-table">  </th>
                                <th class="custom-table-head custom-table">  </th>
                            <tr>

                            @foreach ($clients as $client)
                                <tr>
                                    <td class="custom-table">{{ $client->client_name }}</td>
                                    <td class="custom-table"> {{ $client->client_email }} </td>
                                    <td class="custom-table">
                                        <a class="btn btn-primary" href="{{ url('clients/details') . '/' . $client->client_id }}">
                                            <i class="fa fa-pencil-square-o"></i> Detalhes
                                        </a>
                                    </td>
                                    <td class="custom-table">
                                        <a class="btn btn-primary" href="{{ url('clients/update') . '/' . $client->client_id }}">
                                            <i class="fa fa-pencil-square-o"></i> Editar
                                        </a>
                                    </td>
                                    <td class="custom-table">
                                        <a class="btn btn-danger" href="{{ url('clients/delete') . '/' . $client->client_id }}" onclick="return confirm(' Você Deseja Realmente deletar ? ')" >
                                            <i class="fa fa-trash"></i> Excluir
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                            {{ $clients->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
