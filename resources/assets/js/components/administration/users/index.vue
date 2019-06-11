<template>
  <div class="wrapper wrapper-content fadeInRight">
    <div class="row">
      <div class="col-lg-12">
        <div class="ibox float-e-margins">
          <div class="ibox-title">
              <h5>lista de usuarios</h5>
              <div class="ibox-tools">
                  <a href="#" class="collapse-link">
                      <i class="fas fa-chevron-down"></i>
                  </a>
              </div>
          </div>
          <div class="ibox-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="m-b-xs">
                      <!-- <router-link class="btn btn-xs btn-primary" v-bind:to="{path: '/create'}">
                        <i class="fas fa-user-plus"></i> Nuevo Usuario
                      </router-link> -->
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <data-viewer :source="source" :thead="thead" :filter="filter" :create="create">
                      <template slot-scope="props">
                          <tr>
                              <!-- <td>{{props.item.id}}</td> -->
                              <!-- <td><router-link  class="btn btn-link text-warning img-buttons" v-bind:to="{name: 'editUser', path: '/'+'', params: props.item.id}"><i class="fas fa-pencil-alt"></i></router-link></td> -->
                              <td><router-link :to="'/' + props.item.id " class="btn btn-link text-warning img-buttons"><i class="fas fa-eye"></i></router-link></td>
                              <!-- <td><router-link :to="'/' + props.item.id + '/edit'" class="btn btn-link text-warning img-buttons"> <i class="fas fa-pencil-alt"></i> </router-link></td> -->
                              <!-- <td><a class="btn btn-link text-danger img-buttons" @click="deleteUser(props.item.id)"><i class="fas fa-trash-alt"></i></a></td> -->
                              <td>{{props.item.name}}</td>
                              <td>{{props.item.email}}</td>
                              <td>{{props.item.created_at}}</td>
                          </tr>
                      </template>
                  </data-viewer>
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
    import DataViewer from '../../DataViewer.vue'

    export default {
        name: 'UserIndex',
        data() {
            return {
                title: 'Lista de Usuarios',
                source: '/admin/api/user',
                create: '/create',
                thead: [
                    // {title: 'ID', key: 'id', sort: true},
                    {title: 'ver'},
                    {title: 'Name', key: 'name', sort: true},
                    {title: 'Email Address', key: 'email', sort: true},
                    {title: 'Created At', key: 'created_at', sort: true}
                ],
                filter: [
                    'id', 'name', 'email'
                ]
            }
        },
        components: {
            DataViewer
        },
        methods: {
         
      }
    }
</script>