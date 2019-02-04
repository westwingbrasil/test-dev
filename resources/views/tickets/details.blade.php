@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if(!$ticket)
                        <p>Nenhum ticket cadastrado</p>
                    @else
                        <div class="card-header"><b>Detalhes do Ticket</b></div>
                        <div class="card-body">
                            @if (session()->has('message'))
                                <div class="alert alert-info alert-dismissible fade show">
                                    {{ session()->get('message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form>
                                <div class="form-group">
                                    @foreach ($ticket as $t)
                                        <label>Código do ticket</label>
                                        <input type="text" value="{{ $t->ticket_id }}" class="form-control" disabled>
                                        <label>Título</label>
                                        <input type="text" value="{{ $t->ticket_title }}" class="form-control" disabled>
                                        <label>Email do Cliente</label>
                                        <input type="text" value="{{ $t->client->client_email }}" class="form-control" disabled>
                                        <label>Criado em</label>
                                        <input type="text" value="{{ $t->updated_at }}" class="form-control" disabled>
                                        <label>Detalhes</label>
                                        <textarea type="text" rows="7" class="form-control" disabled>{{ $t->ticket_content }}</textarea>
                                        <hr>
                                    @endforeach
                                </div>
                            </form>

                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
