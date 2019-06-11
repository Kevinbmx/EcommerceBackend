<template id="user-edit">
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
                              </div>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <form  @submit.prevent="updateuser">
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
export default{
  data() {
    return {
        form: {},
        title: 'Editar Usuario',
        store: 'api/user/',
        redirect: '/',
    }
  },
  created: function(){
     var vm = this
    let uri = 'api/user/'+this.$route.params.id+'/edit';
    Axios.get(uri).then((response) => {
        Vue.set(vm.$data, 'form', response.data.form)
        // this.form = response.data;
    });
  },
  methods: {
    updateuser: function() {
        this.$validator.validate().then((result) => {
            if ( result ) {
                var vm = this
                var tipoParameter = 'Usuario modificado';
                
                axios['put'](this.store+this.$route.params.id, this.form)
                .then(function(response) {
                    if(response) {
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
// let uri = 'api/user/'+this.$route.params.id;
//           Axios.put(uri, this.user).then((response) => {
//           this.$router.push({name: 'ListUsers'})
  //       })
    }
  }
}
</script>