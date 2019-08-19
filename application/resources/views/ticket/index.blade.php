@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
                <h1>Tickets</h1>

                <form>
                    <div class="d-flex align-items-center">
                        <strong class="mr-1">Filtros: </strong>
                        <input type="text" class="form-control mr-1 ml-1" name="email" value="{{ isset($email) ? $email : '' }}" placeholder="E-mail" />
                        <input type="text" class="form-control mr-1 ml-1" name="code"  value="{{ isset($code) ? $code : '' }}" placeholder="Número do Pedido" />
                        <button class="btn btn-secondary ml-1">Pesquisar</button>
                    </div>
                </form>

                <a href="{{ route('ticket.create') }}" class="btn btn-primary">Adicionar Ticket</a>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Número</td>
                        <td>Código</td>
                        <td>Título</td>
                        <td>Conteudo</td>
                        <td>E-mail</td>
                        <td>Data de criação</td>
                        <td colspan = 2></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <td>{{$ticket->id}}</td>
                            <td>{{$ticket->code}}</td>
                            <td>{{$ticket->title}}</td>
                            <td>{{$ticket->content}}</td>
                            <td>{{$ticket->client->email}}</td>
                            <td>{{$ticket->created_at}}</td>
                            <td>
                                <a href="{{ route('ticket.edit', $ticket->id)}}" class="btn btn-primary">Editar</a>
                            </td>
                            <td>
                                <a href="{{ route('ticket.show', $ticket->id)}}" class="btn btn-secondary">Visualizar</a>
                            </td>
                            <td>
                                <form action="{{ route('ticket.destroy', $ticket->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Deletar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $tickets->links() }}
        <div>
    </div>
</div>
@endsection
