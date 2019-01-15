
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Vuex = require('vuex');
window.Paginate = require('vuejs-paginate');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('register-component', require('./components/RegisterComponent.vue').default);
Vue.component('list-component', require('./components/ListComponent.vue').default);
Vue.component('detail-component', require('./components/DetailComponent.vue').default);
Vue.component('paginate', Paginate);

Vue.use(require('vue-moment'));

window.vx_tickets = new Vuex.Store({
    state: {
        tickets: [],
        ticket_detalhe: [],
        filTickets: [],
        paginated: [],
        regspPage: 5
    },
    getters: {
        ticket: function (state) {
            return state.ticket_detalhe[0];
        },
        tickets: function (state) {
            return state.tickets;
        },
        ticketFiltrado: function (state) {
            return state.filTickets;
        },
        ticketPaginado: function (state) {
            return state.paginated;
        },
        regspPage: function (state) {
            return state.regspPage;
        }
    },
    mutations: {
        CHANGE_DETAILS: function (state, obj) {
            state[obj.index] = obj.data;
        },
        FILTER: function (state, filters) {
            state.filTickets = state.tickets;
            if (filters !== undefined) {
                const keys = Object.keys(filters);
                const index = keys[0];
                const val = filters[index];
                let ret = '';
                state.filTickets = _.filter(state.tickets, function (item) {
                    if (typeof item[index] === 'number') {
                        if (!val && val !== 0) {
                            ret = item[index] !== 0;
                        } else {
                            ret = item[index] === val;
                        }
                    } else {
                        ret = item[index].indexOf(val) >= 0;
                    }
                    return ret;
                });
            }
        },
        PAGINATE: function (state, obj) {
            state.paginated = _.slice(state.filTickets, 0, state.regspPage);
            if (obj !== undefined) {
                state.paginated = _.slice(state.filTickets, obj.start, obj.end);
            }
        }
    },
    actions: {
        changeDetails: function (context, obj) {
            context.commit('CHANGE_DETAILS', obj);
        },
        filter: function (context, obj) {
            context.commit('FILTER', obj);
            context.commit('PAGINATE');
        },
        paginate: function (context, obj) {
            context.commit('PAGINATE', obj);
        }
    }
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store: vx_tickets,
    mounted() {
        axios.get('/ticketsData').then(function (response) {
            const obj = { index: 'tickets', data: response.data.tickets };
            vx_tickets.dispatch('changeDetails', obj);
            vx_tickets.dispatch('filter');
        }, function (error) {
            console.log('Erro ao carregar tickets', error);
        });
    }
});
