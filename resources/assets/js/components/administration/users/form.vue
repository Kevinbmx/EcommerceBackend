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
                                    <!-- <a href="{{url('/admin/user')}}" class="btn btn-warning min-letter"><i class="fas fa-arrow-left"></i> Lista de Usuarios</a> -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            <form class="form" @submit.prevent="save">
                                    <div class="form-group">
                                        <label>name</label>
                                        <input type="text" v-validate="'required'" name="name" class="form-control" v-model="form.name">
                                         <span  class="text-danger" v-show ="errors.has('name')">
                                            {{errors.first('name')}}
                                        </span>
                                        <!-- <small class="text-danger" v-if="errors.name">{{errors.name[0]}}</small> -->
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input name="email" v-validate="'required|email'" type="text" class="form-control" v-model="form.email">
                                        <span  class="text-danger" v-show ="errors.has('email')">
                                            {{errors.first('email')}}
                                        </span>
                                        <!-- <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small> -->
                                    </div>
                                
                                     <div class="form-group">
                                        <label>Contraseña</label>
                                        <input name="password" v-validate="'required|min:6'" class="form-control"  type="password"  v-model="form.password" >
                                        <span  class="text-danger" v-show ="errors.has('password')">
                                            {{errors.first('password')}}
                                        </span>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label> Confirme contraseña</label>
                                        <input name="confirm_password" data-vv-as="password" v-validate="'required|confirmed:password'" class="form-control" type="password">
                                        <span  class="text-danger" v-show ="errors.has('confirm_password')">
                                            {{errors.first('confirm_password')}}
                                        </span>
                                    </div> -->

                               
                                    <input type="submit" class="btn btn-primary" value="Guardar">
                                </form>
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
        name: 'UserForm',
        data() {
            return {
                form: {},
                // errors: {},
                option: {},
                title: 'Nuevo Usuario',
                initialize: 'api/user/create',
                redirect: '/',
                store: 'api/user',
                method: 'post'
            }
        },
        beforeMount() {
            if(this.$route.meta.mode === 'edit') {
                this.title = 'Editar Usuario'
                this.initialize = 'api/user/' + this.$route.params.id + '/edit'
                this.store = 'api/user/' + this.$route.params.id
                this.method = 'put'
            }
            this.fetchData()
        },
        watch: {
            '$route': 'fetchData'
        },
        methods: {
            fetchData() {
                var vm = this
                axios.get(this.initialize)
                    .then(function(response) {
                        Vue.set(vm.$data, 'form', response.data.form)
                        Vue.set(vm.$data, 'option', response.data.option)
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            },
            save() {
                this.$validator.validate().then((result) => {
                    if ( result ) {
                        var vm = this
                        var tipoParameter = 'Usuario Registrado';
                        if (this.method == 'edit') {
                            tipoParameter = 'Usuario modificado';
                        }
                        axios[this.method](this.store, this.form)
                        .then(function(response) {
                            if(response.data.saved) {
                                vm.$router.push(vm.redirect)
                                swal(tipoParameter, {
                                icon: "success",
                                });
                            }
                        })
                        .catch(function(error) {
                            Vue.set(vm.$data, 'errors', error.response.data)
                        })
                    }
                })
            
            }
        }
    }
</script>