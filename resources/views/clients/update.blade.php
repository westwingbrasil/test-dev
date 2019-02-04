@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if(!$client)
                        <p>Este ticket não existe</p>
                    @else
                        <div class="card-header">Atualizar cliente</div>
                        <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-info alert-dismissible fade show">
                                {{ session()->get('message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form method="POST" action="{{ url('/clients/update' . '/' . $client->client_id) }}">
                            @csrf
                            <input type="hidden" name="client_status" value="A">
                            <div class="form-group row">
                                <label for="client_name"
                                       class="col-md-4 col-form-label text-md-right">Nome</label>

                                <div class="col-md-6">
                                    <input id="client_name" type="text"
                                           class="form-control{{ $errors->has('client_name') ? ' is-invalid' : '' }}"
                                           name="client_name" value="{{ $client->client_name }}" required>

                                    @if ($errors->has('client_name'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('client_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="client_email" class="col-sm-4 col-form-label text-md-right">E-Mail</label>

                                <div class="col-md-6">
                                    <input id="client_email" type="email"
                                           class="form-control{{ $errors->has('client_email') ? ' is-invalid' : '' }}"
                                           name="client_email" value="{{ $client->client_email }}" required autofocus>

                                    @if ($errors->has('client_email'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('client_email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Atualizar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
