<template>
  <div class="col-auto">
    <ul v-if="ticket" class="list-group">
      <li class="list-group-item">Cliente: {{ ticket.name }}</li>
      <li class="list-group-item">Pedido: {{ ticket.o_title }}</li>
      <li class="list-group-item">Título: {{ ticket.t_title }}</li>
      <li class="list-group-item">Ticket: {{ ticket.content }}</li>
      <li class="list-group-item">Data: {{ ticket.created_at | moment("DD/MM/YYYY HH:mm:ss") }}</li>
      <li class="list-group-item">Atualização: {{ ticket.updated_at | moment("DD/MM/YYYY HH:mm:ss") }}</li>
    </ul>
    <br>
    <button type="button" class="btn btn-primary mb-2" @click="back()">Voltar</button>
  </div>
</template>

<script>
export default {
  props: [ 'id' ],
  computed: {
    ticket() {
      return this.$store.getters.ticket;
    }
  },
  methods: {
    back() {
      history.back();
    }
  },
  mounted() {
    axios.get('/ticketData/' + this.id).then(function (response) {
      const obj = { index: 'ticket_detalhe', data: response.data.ticket };
      vx_tickets.dispatch('changeDetails', obj);
    }, function (error) {
      console.log('Erro ao carregar ticket', error);
    });
  }
};
</script>
