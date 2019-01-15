<template>
  <div class="col-auto">
    <form>
      <div class="form-group">
        <label for="formGroupExampleInput">Nome do cliente</label>
        <input type="text" class="form-control is-invalid" id="formGroupExampleInput" placeholder="Nome" required>
      </div>
      <div class="form-group">
        <label for="formGroupExampleInput2">E-mail</label>
        <input type="email" class="form-control is-invalid" id="formGroupExampleInput2" placeholder="E-mail" required>
      </div>
      <div class="form-group">
        <label for="formGroupExampleInput2">N° do pedido</label>
        <input type="number" class="form-control is-invalid" id="formGroupExampleInput2" placeholder="Nº" required>
      </div>
      <div class="form-group">
        <label for="formGroupExampleInput2">Título do ticket</label>
        <input type="text" class="form-control is-invalid" id="formGroupExampleInput2" placeholder="Título" required>
      </div>
      <div class="form-group">
        <label for="formGroupExampleInput2">Conteúdo do ticket</label>
        <textarea class="form-control is-invalid" placeholder="Conteúdo" required></textarea>
      </div>
      <button class="btn btn-primary" type="button">Cadastrar</button>
    </form>
  </div>
</template>

<script>
export default {};
</script>
