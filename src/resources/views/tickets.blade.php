@extends('template')
@section('content')
<div class="panel-screen">
    <div class="flex-center panel-home">
        @if(Session::has('warning'))
        <div class="alert alert-warning">
            {!! Session::get('warning') !!}
        </div>
        @endif
        <h4 class="center">Tickets</h4>
        <div class="header-buttons">
            <button type="button" data-toggle="modal" data-target="#modal" class="btn btn-primary btn-search">
                <i class="large material-icons">search</i>
            </button>
        </div>
        <table class="table table-striped">
            <thead>
                <th>
                    ID
                </th> 
                <th>
                    Pedido
                </th> 
                <th>
                    Título
                </th>
                <th>
                    E-mail
                </th>
                <th>
                    Data
                </th>
                <th></th>
        </thead>
            <tbody>
                @forelse ($tickets as $ticket)
                <tr>
                    <th scope="row">{{ $ticket['id'] }}</th>
                    <td>{{ $ticket['order'] }}</td>
                    <td>{{ $ticket['title'] }}</td>
                    <td>{{ $ticket['email'] }}</td>
                    <td>{{ date('d/m/Y H:i:s', strtotime($ticket['created_at'])) }}</td>
                    <td>
                        <a type="button" href="{{ url('/tickets/'.$ticket['id']) }}" class="btn btn-info">
                            <i class="small material-icons">chevron_right</i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="td-empty" colspan="6">Nenhum ticket encontrado.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {!! $tickets->render() !!}
        <div class="footer-buttons">
            <a type="button" href="{{ url('/') }}" class="btn btn-secondary pull-left">Voltar</a>
        </div>
    </div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-search" method="get" action="{{ url('/tickets') }}">
                <div class="modal-header">
                    <h4>
                        Buscar Ticket
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="input-email">E-mail</label>
                        <input type="text" name="email" id="input-email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="input-order-id">Número do Pedido</label>
                        <input type="number" step="1" name="order" id="input-order-id" class="form-control">
                    </div>
                </div>
                <div class="modal-footer footer-buttons">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection