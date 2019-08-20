@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Adicionar ticket</h1>
        <div>

        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 pb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <br />
        @endif

        <form method="post" action="{{ route('ticket.store') }}">
            @csrf

            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="name">
                            {{ __('Nome do cliente') }}
                        </label>
                        <div class="">
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ isset($client->name) ? $client->name : old('name') }}" required autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="email">
                            {{ __('E-mail') }}
                        </label>
                        <div class="">
                            <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ isset($client->email) ? $client->email : old('email') }}" required >
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="code">
                            {{ __('Código') }}
                        </label>
                        <div class="">
                            <input type="text" id="code" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ isset($ticket->code) ? $ticket->code : old('code') }}" required >
                            @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="title">
                            {{ __('Título do ticket') }}
                        </label>
                        <div class="">
                            <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ isset($ticket->title) ? $ticket->title : old('title') }}" required>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="content">
                            {{ __('Conteúdo do ticket') }}
                        </label>
                        <div class="">
                            <textarea type="text" id="content" name="content" class="form-control @error('content') is-invalid @enderror">{{ isset($ticket->content) ? $ticket->content : old('content') }}</textarea>
                            @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('ticket.index') }}" class="btn btn-default btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</div>
@endsection
