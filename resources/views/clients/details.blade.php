@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if(!$client)
                        <p>Nenhum cliente cadastrado</p>
                    @else
                        <div class="card-header"><b>Cliente - {{ $client->client_id }} </b></div>
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
                                <label>Nome</label>
                                <input type="text" value="{{ $client->client_name }}" class="form-control" disabled>
                                <label>Email</label>
                                <input type="text" value="{{ $client->client_email }}" class="form-control" disabled>
                                <hr>
                            </div>
                        </form>

                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
