@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if(!$ticket)
                        <p>Este ticket não existe</p>
                    @else
                        <div class="card-header">Atualizar ticket</div>
                        <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-info alert-dismissible fade show">
                                {{ session()->get('message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form method="POST" action="{{ url('/tickets/update' . '/' . $ticket->ticket_id) }}">
                            @csrf
                            <div class="form-group row">
                                <label for="ticket_title"
                                       class="col-md-4 col-form-label text-md-right">Título</label>

                                <div class="col-md-6">
                                    <input id="ticket_title" type="text"
                                           class="form-control{{ $errors->has('ticket_title') ? ' is-invalid' : '' }}"
                                           name="ticket_title" value="{{ $ticket->ticket_title }}" required>

                                    @if ($errors->has('ticket_title'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('ticket_title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ticket_order" class="col-sm-4 col-form-label text-md-right">Order</label>

                                <div class="col-md-6">
                                    <input id="ticket_order" type="text"
                                           class="form-control{{ $errors->has('ticket_order') ? ' is-invalid' : '' }}"
                                           name="ticket_order" value="{{ $ticket->ticket_order }}" required>

                                    @if ($errors->has('ticket_order'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('ticket_order') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ticket_content" class="col-sm-4 col-form-label text-md-right">Conteudo</label>

                                <div class="col-md-6">
                                    <textarea id="ticket_content" type="text" rows="7"
                                              class="form-control{{ $errors->has('ticket_content') ? ' is-invalid' : '' }}"
                                              name="ticket_content" required>{{ $ticket->ticket_content }}
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
