@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Ticket #{{$ticket->id}}</h1>
        <div>

        <div class="row">
            <div class="col-6 col-sm-2 text-right"><strong>ID</strong></div>
            <div class="col-6 col-sm-10">{{$ticket->id}}</div>
        </div>

        <div class="row">
            <div class="col-6 col-sm-2 text-right"><strong>CODE</strong></div>
            <div class="col-6 col-sm-10">{{$ticket->code}}</div>
        </div>

        <div class="row">
            <div class="col-6 col-sm-2 text-right"><strong>TITLE</strong></div>
            <div class="col-6 col-sm-10">{{$ticket->title}}</div>
        </div>

        <div class="row">
            <div class="col-6 col-sm-2 text-right"><strong>CONTENT</strong></div>
            <div class="col-6 col-sm-10">{{$ticket->content}}</div>
        </div>

        <div class="row">
            <div class="col-6 col-sm-2 text-right"><strong>CLIENT_ID</strong></div>
            <div class="col-6 col-sm-10">{{$ticket->client_id}}</div>
        </div>

        <div class="row">
            <div class="col-6 col-sm-2 text-right"><strong>CREATED_AT</strong></div>
            <div class="col-6 col-sm-10">{{$ticket->created_at}}</div>
        </div>

        <div class="row">
            <div class="col-6 col-sm-2 text-right"><strong>UPDATED_AT</strong></div>
            <div class="col-6 col-sm-10">{{$ticket->updated_at}}</div>
        </div>

    </div>

    <a href="{{ route('ticket.index') }}" class="btn btn-default btn-secondary">Voltar</a>
</div>
@endsection
