<template>
    <div class="container table_view">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-content">
                        <div class="col-md-6 mb-2">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                                Novo Ticket
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-body">
                        <data-table :fetch-url="urlApi + 'getFilteredData'" :columns="['numero_do_ticket', 'numero_do_pedido', 'titulo_do_pedido', 'email_do_cliente', 'data_criacao_ticket']"></data-table>
                    </div>
                </div>
            </div>
        </div>
        <modal title="Inserir Novo Ticket">
            <template slot="body">
                <FlashMessage></FlashMessage>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="nome">Nome do Cliente</span>
                            </div>
                            <input type="text" class="form-control" v-model="ticket.clienteNome" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="email">Email do Cliente</span>
                            </div>
                            <input type="email" class="form-control" v-model="ticket.clienteEmail" required>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="num_ped">Número do Pedido</span>
                            </div>
                            <select class="custom-select" required v-model="ticket.pedido_id">
                                <option disabled selected >Selecione...</option>
                                <option v-for="item in pedidos" :value="item.id">{{ item.titulo }} - {{ item.descricao }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="title_ticket">Título do ticket</span>
                            </div>
                            <input type="text" class="form-control" v-model="ticket.titulo" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="desc_ticket">Conteúdo do ticket</span>
                            </div>
                            <input type="text" class="form-control" v-model="ticket.descricao" required>
                        </div>
                    </div>
                </div>
            </template>
            <template slot="footer">
                <button type="button" class="btn btn-primary" @click="setTicket()">
                    Salvar
                </button>
            </template>
        </modal>
    </div>
</template>

<script>
    import {TheMask} from 'vue-the-mask';
    export default {
        data() {
          return {
              urlApi: window.Laravel.apiBaseUri,
              ticket: {
                  pedido_id: '',
                  clienteNome: '',
                  clienteEmail: '',
                  titulo: '',
                  descricao: ''
              },
              pedidos: [],
          }
        },
        methods: {
            limpaCampos() {
                this.ticket.pedido_id = '';
                this.ticket.clienteNome = '';
                this.ticket.clienteEmail = '';
                this.ticket.titulo = '';
                this.ticket.descricao = '';
            },
            getPedidos(){
               axios.get(this.urlApi + 'getPedidos')
                   .then(({ data }) => {
                       this.pedidos = data.data;
                   }).catch(error => console.log(error.message))
            },
            setTicket(){
                let urlTicket = this.urlApi + 'storeTicket'
                                            + '?pedido_id=' + this.ticket.pedido_id
                                            + '&cliente_nome=' + this.ticket.clienteNome
                                            + '&cliente_email=' + this.ticket.clienteEmail
                                            + '&titulo=' + this.ticket.titulo
                                            + '&descricao=' + this.ticket.descricao;
                console.log(urlTicket);
               axios.get(urlTicket).then(({ data }) => {
                   console.log(data);
                       if(data.success){
                           this.limpaCampos();
                           this.flashMessage.success({
                               title: 'Opa!',
                               message: data.data,
                               time: 5000
                           });
                       } else {
                           this.flashMessage.error({title: 'Atenção' || 'Error', message: data.error_messages});
                           console.log(data);
                       }
                   }).catch(error => {
                   this.flashMessage.error({title: 'Error', message: error.message});
               })
            }
        },
        mounted() {
          this.getPedidos();
        },
        components: {TheMask}
    }
</script>
