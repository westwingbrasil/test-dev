@extends('template')
@section('content')
<div class="panel-screen home">
    <div class="flex-center panel-home">
        @if(Session::has('message'))
        <div class="alert alert-danger">
            {!! Session::get('message') !!}
        </div>
        @endif
        <div>
            <a class="btn btn-primary" role="button" href="{{ url('/tickets/create') }}">
                <i class="large material-icons">add</i>
                <br>
                Novo Ticket
            </a>
            <a class="btn btn-primary" role="button" href="{{ url('/tickets') }}">
                <i class="large material-icons">search</i>
                <br>
                Buscar Ticket
            </a>
        </div>
    </div>
</div>
@endsection