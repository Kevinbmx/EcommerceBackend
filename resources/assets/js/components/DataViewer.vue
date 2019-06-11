<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="form-group">
                <router-link :to="create" class="btn btn-primary btn-sm"><i class="fas fa-user-plus"></i> Nuevo Usuario</router-link>
                <button class="btn btn-default btn-sm" @click="showFilter = !showFilter">Filtro</button>
            </div>
        </div>
        <div class="panel-body">
            <div class="row" v-if="showFilter">
                <div class="col-md-2">
                    <div class="form-group">
                        <select class="form-control" v-model="params.search_column">
                            <option v-for="column in filter" :value="column">{{column}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <select class="form-control" v-model="params.search_operator">
                            <option v-for="(value, key) in operators" :value="key">{{value}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="text" class="form-control" v-model="params.search_query_1"
                            @keyup.enter="fetchData" placeholder="Search">
                    </div>
                </div>
                <div >
                    <div class="form-group" v-if="params.search_operator === 'between'">
                        <input type="text" class="form-control" v-model="params.search_query_2"
                            @keyup.enter="fetchData" placeholder="Search">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="filter-btn">
                        <button class="btn btn-outline-success " @click="fetchData">Buscar</button>
                         
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th v-for="item in thead">
                                <div class="dataviewer-th" @click="sort(item.key)" v-if="item.sort">
                                    <span>{{item.title}}</span>
                                    <span v-if="params.column === item.key">
                                        <span v-if="params.direction === 'asc'">&#x25B2;</span>
                                        <span v-else>&#x25BC;</span>
                                    </span>
                                </div>
                                <div v-else>
                                    <span>{{item.title}}</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <slot v-for="item in model.data" :item="item">         
                        </slot>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-footer pagination-footer ">
                <div class="col-md-3">
                    <span>Por pagina: </span>
                    <select v-model="params.per_page" @change="fetchData">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <small>Mostrando {{model.from}} - {{model.to}} de {{model.total}}</small>
                </div>
                <div class="col-md-3">
                    <small>Pag Actual: </small>
                    <input type="text" class="pagination-input" v-model="params.page"
                        @keyup.enter="fetchData">
                    <small> de {{model.last_page}}</small>
                </div>
                <div class="col-md-3">
                    <button @click="prev" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i> Ant</button>
                    <button @click="next" class="btn btn-default btn-sm">Sig <i class="fas fa-chevron-right"></i></button>
                </div>
                </div>
    </div>
</template>
<script>
    import Vue from 'vue'
    import axios from 'axios'

    export default {
        props: ['source', 'thead', 'filter', 'create', 'title','api'],
        data() {
            return {
                showFilter: false,
                // apisource = `${this.api}`,
                model: {
                    data: []
                },
                params: {
                    column: 'id',
                    direction: 'desc',
                    per_page: 10,
                    page: 1,
                    search_column: 'id',
                    search_operator: 'greater_than',
                    search_query_1: '0',
                    search_query_2: ''
                },
                operators: {
                    equal_to: '=',
                    not_equal: '<>',
                    less_than: '<',
                    greater_than: '>',
                    less_than_or_equal_to: '<=',
                    greater_than_or_equal_to: '>=',
                    in: 'IN',
                    not_in: 'NOT IN',
                    like: 'LIKE',
                    between: 'BETWEEN'
                }
            }
        },
        beforeMount() {
            this.fetchData()
        },
        methods: {
            next() {
                if(this.model.next_page_url) {
                    this.params.page++
                    this.fetchData()
                }
            },
            prev() {
                if(this.model.prev_page_url) {
                    this.params.page--
                    this.fetchData()
                }
            },
            sort(column) {
                if(column === this.params.column) {
                    if(this.params.direction === 'desc') {
                        this.params.direction = 'asc'
                    } else {
                        this.params.direction = 'desc'
                    }
                } else {
                    this.params.column = column
                    this.params.direction = 'asc'
                }

                this.fetchData()
            },
            fetchData: function () {
                var vm = this
                axios.get(this.buildURL())
                    .then(function(response) {
                        Vue.set(vm.$data, 'model', response.data.model)
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            },
            buildURL() {
                var p = this.params
                return `${this.source}?column=${p.column}&direction=${p.direction}&per_page=${p.per_page}&page=${p.page}&search_column=${p.search_column}&search_operator=${p.search_operator}&search_query_1=${p.search_query_1}&search_query_2=${p.search_query_2}`
            }
        }
    }
</script>