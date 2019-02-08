<template>
    <div class="data-table">
        <div class="well">
            <input type="text" class="form-control" placeholder="Digite para filtrar" v-model="filterData">
        </div>
        <div class="main-table">
            <table class="table">
                <thead>
                <tr>
                    <th class="table-head">#</th>
                    <th v-for="column in columns" :key="column" @click="sortByColumn(column)"
                        class="table-head">
                        {{ column | columnHead }}
                        <span v-if="column === sortedColumn">
                            <i v-if="order === 'asc' " class="fas fa-arrow-up"></i>
                            <i v-else class="fas fa-arrow-down"></i>
                        </span>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr class="" v-if="tableData.length === 0">
                    <td class="lead text-center" :colspan="columns.length + 1">No data found.</td>
                </tr>
                <tr v-for="(data, key1) in tableData" :key="data.id" class="m-datatable__row" v-else>
                    <td>{{ serialNumber(key1) }}</td>
                    <td v-for="(value, key) in data">{{ value }}</td>
                    <td>
                        <button type="button" class="btn btn-primary" @click="getTicket(data.numero_do_ticket)" data-toggle="modal" data-target="#modalDetails">View</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <nav v-if="pagination && tableData.length > 0">
            <ul class="pagination">
                <li class="page-item" :class="{'disabled' : currentPage === 1}">
                    <a class="page-link" href="#" @click.prevent="changePage(currentPage - 1)">Anterior</a>
                </li>
                <li v-for="page in pagesNumber" class="page-item"
                    :class="{'active': page === pagination.current_page}">
                    <a href="javascript:void(0)" @click.prevent="changePage(page)" class="page-link">{{ page }}</a>
                </li>
                <li class="page-item" :class="{'disabled': currentPage === pagination.last_page }">
                    <a class="page-link" href="#" @click.prevent="changePage(currentPage + 1)">Próximo</a>
                </li>
                <span style="margin-top: 8px;"> &nbsp; <i>Exibindo {{ pagination.data.length }} de {{ pagination.total }} tickets.</i></span>
            </ul>
        </nav>
        <modal-details v-if="show" @close="show = false" title="Detalhes do Ticket">
            <template slot="body">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Pedido:</span>
                            </div>
                            <input type="text" class="form-control" v-model="pedidoTitle" disabled>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Título do ticket:</span>
                            </div>
                            <input type="text" class="form-control" v-model="tickets.titulo" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Conteúdo do ticket:</span>
                            </div>
                            <input type="text" class="form-control" v-model="tickets.descricao" disabled>
                        </div>
                    </div>
                </div>
            </template>
        </modal-details>
    </div>
</template>

<script type="text/ecmascript-6">
    export default {
        props: {
            fetchUrl: { type: String, required: true },
            columns: { type: Array, required: true },
        },
        data() {
            return {
                tableData: [],
                url: '',
                urlApi: window.Laravel.apiBaseUri,
                pagination: {
                    to: 1,
                    from: 1
                },
                offset: 4,
                search: '',
                currentPage: 1,
                perPage: 5,
                sortedColumn: 'created_at',
                order: 'asc',
                searchs: [],
                filterData: '',
                pedidoTitle: '',
                pedidoDesc: '',
                tickets: {
                    titulo: '',
                    descricao: ''
                },
                show: false
            }
        },
        watch: {
            fetchUrl: {
                handler: function(fetchUrl) {
                    this.url = fetchUrl
                },
                immediate: true
            }
        },
        created() {
            return this.fetchData()
        },
        computed: {
            /**
             * Get the pages number array for displaying in the pagination.
             * */
            pagesNumber() {
                if (!this.pagination.to) {
                    return []
                }
                let from = this.pagination.current_page - this.offset
                if (from < 1) {
                    from = 1
                }
                let to = from + (this.offset * 2)
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page
                }
                let pagesArray = []
                for (let page = from; page <= to; page++) {
                    pagesArray.push(page)
                }
                return pagesArray
            },
            /**
             * Get the total data displayed in the current page.
             * */
            totalData() {
                return (this.pagination.to - this.pagination.from) + 1
            },

            data() {
                var self = this;
                return this.searchs.filterData(function (item) {
                    return item.indexOf(self.filterData) > -1;
                })
            }
        },
        methods: {
            fetchData() {
                let dataFetchUrl = `${this.url}?page=${this.currentPage}&column=${this.sortedColumn}&order=${this.order}&per_page=${this.perPage}`
                axios.get(dataFetchUrl)
                    .then(({ data }) => {
                        this.pagination = data.data;
                        this.tableData = data.data.data;
                    }).catch(error => this.tableData = [])
            },
            /**
             * Get the serial number.
             * @param key
             * */
            serialNumber(key) {
                return (this.currentPage - 1) * this.perPage + 1 + key
            },
            /**
             * Change the page.
             * @param pageNumber
             */
            changePage(pageNumber) {
                this.currentPage = pageNumber
                this.fetchData()
            },
            /**
             * Sort the data by column.
             * */
            sortByColumn(column) {
                if (column === this.sortedColumn) {
                    this.order = (this.order === 'asc') ? 'desc' : 'asc'
                } else {
                    this.sortedColumn = column;
                    this.order = 'asc'
                }
                this.fetchData()
            },
            getTicket(id) {
                axios.get(this.urlApi + 'getTicket?id=' + id)
                    .then(({ data }) => {
                        console.log(data.data.titulo);
                        this.tickets.titulo = data.data.titulo;
                        this.tickets.descricao = data.data.descricao;
                        this.getPedidoById(data.data.pedido_id);
                        this.show = true;
                    }).catch(error => console.log(error.message))
            },
            getPedidoById(id){
                axios.get(this.urlApi + 'getPedido?id=' + id)
                    .then(({ data }) => {
                        this.pedidoTitle = data.data.titulo + ' - ' + data.data.descricao;
                    }).catch(error => console.log(error.message))
            }
        },
        filters: {
            columnHead(value) {
                return value.split('_').join(' ').toUpperCase()
            }
        },
        name: 'DataTable'
    }
</script>

<style scoped>
</style>