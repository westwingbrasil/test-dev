<template>
  <div class="col-auto">
    <form>
      <div class="row">
        <div class="col-6">
          <input type="email" class="form-control" placeholder="E-mail" @input="dbEmail">
        </div>
        <div class="col-6">
          <input type="number" class="form-control" placeholder="N° Pedido" @input="dbOrder">
        </div>
      </div>
    </form>
    <table class="table">
      <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col">N° Ticket</th>
          <th scope="col">N° Pedido</th>
          <th scope="col">Pedido</th>
          <th scope="col">E-mail</th>
          <th scope="col">Data</th>
        </tr>
      </thead>
      <tbody>
        <tr v-show="tickets_pages.length === 0">
          <td colspan="6">Ainda não existem tickets cadastrados</td>
        </tr>
        <tr v-for="item in tickets_pages" :key="item.id">
          <td>
            <button type="button" class="btn btn-primary mb-2" @click="details(item.id)">Detalhe</button>
          </td>
          <th scope="row">{{ item.id }}</th>
          <td>{{ item.order_id }}</td>
          <td>{{ item.o_title }}</td>
          <td>{{ item.email }}</td>
          <td>{{ item.created_at | moment("DD/MM/YYYY") }}</td>
        </tr>
      </tbody>
    </table>
    <paginate
      v-show="tickets.length > regspPage"
      v-model="page"
      :page-count="pagsTotal"
      :page-range="3"
      :margin-pages="2"
      :click-handler="paginationClick"
      :prev-text="'Anterior'"
      :next-text="'Próximo'"
      :container-class="'pagination justify-content-end'"
      :prev-class="'page-item'"
      :page-class="'page-item'"
      :next-class="'page-item'"
      :prev-link-class="'page-link'"
      :page-link-class="'page-link'"
      :next-link-class="'page-link'">
    </paginate>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      email: '',
      order: '',
      page: 1
    };
  },
  computed: {
    pagsTotal() {
      return Math.ceil(this.$store.getters.ticketFiltrado.length / this.regspPage);
    },
    regspPage() {
      return this.$store.getters.regspPage;
    },
    tickets() {
      return this.$store.getters.tickets;
    },
    tickets_pages() {
      return this.$store.getters.ticketPaginado;
    }
  },
  methods: {
    paginationClick(pageNum) {
      const inicio = ((pageNum - 1) * this.regspPage);
      const fim = (pageNum * this.regspPage);
      const obj = { start: inicio, end: fim };
      this.$store.dispatch('paginate', obj);
    },
    details(id) {
      window.location.href = axios.defaults.baseURL + '/ticket/' + id;
    },
    dbEmail: _.debounce(function (e) {
      this.email = e.target.value;
      const obj = (this.email !== '') ? { email: this.email } : undefined;
      this.$store.dispatch('filter', obj);
    }, 1000),
    dbOrder: _.debounce(function (e) {
      this.order = parseInt(e.target.value, 10);
      const obj = (this.order !== '') ? { 'order_id': this.order } : undefined;
      this.$store.dispatch('filter', obj);
    }, 1000)
  }
};
</script>
