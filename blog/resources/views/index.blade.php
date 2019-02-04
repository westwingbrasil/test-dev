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
          <div class="col-10">
            <h2 class="title m-b-md">
                 Sistema de tickets
            </h2>
            <a href="{{ url('/ticket') }}"> Abra um novo ticket</a>
          </div>
        </div>
      </div>
    </div>
<?php 
  include 'modules/footer.php';
?>