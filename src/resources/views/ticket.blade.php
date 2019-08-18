@extends('template')
@section('content')
<div class="panel-screen">
    <div class="flex-center panel-home">
        @if(Session::has('success'))
        <div class="alert alert-success">
            {!! Session::get('success') !!}
        </div>
        @endif
        <h4 class="center">Ticket</h4>
        <table class="table table-striped table-details">
            <tbody>
                <tr>
                    <th scope="row">ID</th>
                    <td>{{ $ticket['id'] }}</td>
                </tr>
                <tr>
                    <th scope="row">Data</th>
                    <td>{{ date('d/m/Y H:i:s', strtotime($ticket['created_at'])) }}</td>
                </tr>
                <tr>
                    <th scope="row">Pedido</th>
                    <td>{{ $ticket['order'] }}</td>
                </tr>
                <tr>
                    <th scope="row">Cliente</th>
                    <td>{{ $ticket['name'] }}</td>
                </tr>
                <tr>
                    <th scope="row">E-mail</th>
                    <td>{{ $ticket['email'] }}</td>
                </tr>
                <tr>
                    <th scope="row">Título</th>
                    <td>{{ $ticket['title'] }}</td>
                </tr>
                <tr>
                    <th scope="row">Descrição</th>
                    <td>{!! nl2br($ticket['description']) !!}</td>
                </tr>
            </tbody>
        </table>
        <div class="footer-buttons">
            <a type="button" href="{{ url()->previous() }}" class="btn btn-secondary pull-left">Voltar</a>
        </div>
    </div>
</div>
@endsection