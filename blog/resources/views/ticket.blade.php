<?php 
  include "modules/header.php";
?>
<div class="flex-center position-ref full-height">
    <div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <div class="top-right links">
                <a href="{{ url('/') }}">Home |</a>
                <a href="{{ url('/ticket') }}">Novo ticket |</a>
                <a href="{{ url('/history') }}">Historico de chamados</a>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-2">
            <h2 class="title m-b-md">
                Novo ticket
            </h2>
        </div>
        <div class="col-10">
            {!! Form::open(['route' => 'ticket.store']) !!}
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif
            <div class="form-group">
                {!! Form::label('name', 'Nome') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'E-mail') !!}
                {!! Form::text('email', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('orderNumber', 'Número do pedido') !!}
                {!! Form::text('orderNumber', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('ticketTile', 'Título') !!}
                {!! Form::text('ticketTile', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::textarea('ticketDescription', null, ['class' => 'form-control']) !!}
            </div>
            {!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}
            {!! Form::close() !!}
        </div>
    </div>
    </div>
</div>
<?php 
  include 'modules/footer.php';
?>