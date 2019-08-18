@extends('template')
@section('content')
<div class="panel-screen">
    <div class="flex-center panel-home">
        @if(Session::has('success'))
        <div class="alert alert-success">
            {!! Session::get('success') !!}
            <br>
            <a href="{{ url(Session::get('link')) }}">Clique aqui</a> para visualizar.
        </div>
        @endif
        @if(Session::has('warning'))
        <div class="alert alert-warning">
            {!! Session::get('warning') !!}
        </div>
        @endif
        <form class="form-create" method="post" action="{{ url('/tickets/create') }}">
            {{ csrf_field() }}
            <h4 class="center">Novo Ticket</h4>
            <div class="form-group">
                <label for="input-name">Nome</label>
                <input type="text" name="ticket[name]" id="input-name" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label for="input-email">E-mail</label>
                <input type="email" name="ticket[email]" id="input-email" class="form-control">
            </div>
            <div class="form-group">
                <label for="input-order-id">Número do Pedido</label>
                <input type="number" step="1" name="ticket[order]" id="input-order-id" class="form-control">
            </div>
            <div class="form-group">
                <label for="input-title">Título</label>
                <input type="text" step="1" name="ticket[title]" id="input-title" class="form-control">
            </div>
            <div class="form-group">
                <label for="input-description">Descrição</label>
                <textarea name="ticket[description]" rows="3" id="input-description" class="form-control input-description"></textarea>
            </div>
            <div class="form-group footer-buttons">
                <a type="button" href="{{ url('/') }}" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-primary">Criar</button>
            </div>
        </form>
    </div>
</div>
@endsection