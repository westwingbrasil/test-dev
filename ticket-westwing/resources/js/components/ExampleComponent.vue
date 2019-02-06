<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Cadastro de Tickets</div>

                    <div class="card-body">
                        <data-table :fetch-url="urlApi" :columns="['nome', 'email','created_at']"></data-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
          return {
              urlApi: window.Laravel.apiBaseUri + 'getClients'
          }
        }
    }
</script>
