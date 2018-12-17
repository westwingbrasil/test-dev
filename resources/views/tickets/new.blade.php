@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cadastrar ticket</div>
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-info alert-dismissible fade show">
                                {{ session()->get('message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form method="POST" action="{{ url('/tickets/store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="ticket_title"
                                       class="col-md-4 col-form-label text-md-right">Cliente</label>
                                <div class="col-md-6">
                                    <select required class="custom-select" name="client_id">
                                        @if(count($clients))
                                            <option value="" selected="">Selecione...</option>
                                        @else
                                            <option value="" selected="">Nenhum cliente cadastrado</option>
                                        @endif
                                        @foreach($clients as $client)
                                            <option value={{ $client->client_id ?? $client->client_id}} >
                                                {{$client->client_name}}
                                            </option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('ticket_title'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('ticket_title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ticket_title"
                                       class="col-md-4 col-form-label text-md-right">Título</label>

                                <div class="col-md-6">
                                    <input id="ticket_title" type="text" value="{{ old('ticket_title') }}"
                                           class="form-control{{ $errors->has('ticket_title') ? ' is-invalid' : '' }}"
                                           name="ticket_title" required>

                                    @if ($errors->has('ticket_title'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('ticket_title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ticket_order" class="col-sm-4 col-form-label text-md-right">Pedido</label>
                                <div class="col-md-6">
                                    <input id="ticket_order" type="text"
                                           class="form-control{{ $errors->has('ticket_order') ? ' is-invalid' : '' }}"
                                           name="ticket_order" value="{{ old('ticket_order') }}" required autofocus>

                                    @if ($errors->has('ticket_order'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('ticket_order') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ticket_content" class="col-sm-4 col-form-label text-md-right">Detalhes</label>

                                <div class="col-md-6">
                                    <textarea id="ticket_content" type="text" rows="7"
                                              class="form-control{{ $errors->has('ticket_content') ? ' is-invalid' : '' }}"
                                              name="ticket_content" required autofocus>{{ old('ticket_content') }}
                                    </textarea>

                                    @if ($errors->has('ticket_content'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('ticket_content') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Cadastrar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
