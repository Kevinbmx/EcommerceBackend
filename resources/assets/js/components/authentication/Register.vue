<template>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <input  type="text" 
                                v-model="name" 
                                class="form-control" 
                                placeholder="name">
                    </div>
                    <div class="form-group">
                        <input  type="email" 
                                v-model="email" 
                                class="form-control" 
                                placeholder="email">
                    </div>
                    <div class="form-group">
                        <input  type="password" 
                                v-model="password" 
                                class="form-control" 
                                placeholder="password">
                    </div>
                    <button class="btn btn-primary pull-right">
                        Register
                    </button>
                </div>
            </div>
        </div>
        <!-- <pre>
            {{$data}}
        </pre> -->
    </div>
</template>
<script>
export default {
    data(){
        return{
            name: '',
            email:'',
            password:''
        }
    }
}
</script>
