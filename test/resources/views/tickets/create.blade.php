@extends('tickets.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 mt-2" >
        <div class=" float-right">
            <a class="btn btn-info" href="{{ route('tickets.index') }}"> Relatório de tickets</a>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 margin-tb flex-center">
        <div>
            <h2>Adicionar Ticket</h2>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Erros ao enviar seus dados.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row flex-center">
   <div class="col-xs-8 col-sm-12 col-md-8">
        <form action="{{ route('tickets.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="client_name">Nome do Cliente:</label>
                <input type="text" name="client_name" class="form-control" placeholder="Nome do Cliente" required />
            </div>
        
            <div class="form-group">
                <label for="client_email">Email do Cliente:</label>
                <input class="form-control" name="client_email" placeholder="Email do Cliente" type="email" required/>
            </div>
        
            <div class="form-group">
                <label for="order_code">Número do Pedido:</label>
                <input class="form-control" name="order_code" placeholder="Número do Pedido" type="text" required/>
            </div>

            <div class="form-group">
                <label for="title">Título do Ticket:</label>
                <input class="form-control" name="title" placeholder="Título do Ticket" type="text" required/>
            </div>
        
            <div class="form-group">
                <label for="content">Conteúdo do Ticket:</label>
                <textarea class="form-control" style="height:150px" name="content" placeholder="Conteúdo do Ticket" required></textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </div>
   
</form>
@endsection