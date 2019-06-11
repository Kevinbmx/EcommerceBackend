<template>
    <div class="wrapper wrapper-content fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5> {{title}}</h5>
                        <div class="ibox-tools">
                            <a href="#" class="collapse-link">
                                <i class="fas fa-chevron-down"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-b-md">
                                    <router-link class="btn btn-warning min-letter" v-bind:to="'/'"><i class="fas fa-arrow-left"></i> Lista de Usuarios</router-link>
                                    <router-link :to="'/' + model.id + '/edit'" class="btn btn-primary min-letter"><i class="fas fa-pencil-alt"></i> Edit</router-link>
                                    <button class="btn btn-danger min-letter" @click="remove"><i class="fas fa-trash-alt"></i> Delete</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label><strong> Name</strong></label>
                                        <p>{{model.name}}</p>
                                
                                        <label><strong>Email </strong></label>
                                        <p>{{model.email}}</p>

                                        <label><strong>Created At</strong></label>
                                        <p>{{model.created_at}}</p>
                                    
                                    </div>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Vue from 'vue'
    import axios from 'axios'
    export default {
        name: 'UserShow',
        data() {
            return {
                model: {},
                title: 'Vista de Usuario',
                apiresource: '/admin/api/user',
                redirect: '/'
            }
        },
        beforeMount() {
            this.fetchData()
        },
        watch: {
            '$route': 'fetchData'
        },
        methods: {
            remove() {
                swal({
                title: "¿Esta seguro?",
                text: "Una vez eliminada, usted no podra recuperar este dato!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    // let uri = 'api/user/'+id;
                    var vm = this
                    axios.delete(`${this.apiresource}/${this.$route.params.id}`)
                    .then(function(response) {
                        if(response.data.deleted) {
                            vm.$router.push(vm.redirect)
                        }
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
                    swal("El usuario ha sido eliminado!", {
                    icon: "success",
                    });
                } else {
                    swal("su Usuario esta a salvo!");
                }
            });
               
            },
           
            fetchData() {
                var vm = this
                axios.get(`${this.apiresource}/${this.$route.params.id}`)
                    .then(function(response) {
                        Vue.set(vm.$data, 'model', response.data.model)
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            }
        }
    }
</script>