<template>
  <div class="col-auto">
    <form :action="url" method="POST">
      <input type="hidden" name="_token" :value="csrf">
      <div class="form-group">
        <label for="formGroupExampleInput">Nome do cliente</label>
        <input type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Nome" required>
      </div>
      <div class="form-group">
        <label for="formGroupExampleInput2">E-mail</label>
        <input type="email" name="email" class="form-control" id="formGroupExampleInput2" placeholder="E-mail" required>
      </div>
      <div class="form-group">
        <label for="formGroupExampleInput2">N° do pedido</label>
        <input type="number" name="order_id" class="form-control" id="formGroupExampleInput2" placeholder="Nº" required>
      </div>
      <div class="form-group">
        <label for="formGroupExampleInput2">Título do ticket</label>
        <input type="text" name="title" class="form-control" id="formGroupExampleInput2" placeholder="Título" required>
      </div>
      <div class="form-group">
        <label for="formGroupExampleInput2">Conteúdo do ticket</label>
        <textarea name="content" class="form-control" placeholder="Conteúdo" required></textarea>
      </div>
      <button class="btn btn-primary" type="submit">Cadastrar</button>
    </form>
  </div>
</template>

<script>
export default {
  props: [ 'url' ],
  data() {
    return {
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
  }
};
</script>
