<template>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-body">
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
                    <button @click="login" class="btn btn-primary pull-right">
                        Login
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
            email: '',
            password:''
        }
    },
    methods:{
        login(){
            var data={
                client_id: 2,
                client_secret:'u4U7e7yqFX60j4urXTnJ0Z6I4yH6J1lEloXuBEeK',
                grant_type:'password',
                username: this.email,
                password:this.password
            }
            this.$http.post("oauth/token",data)
           .then(response =>{
            //    console.log(response)
            this.$auth.setToken(response.body.access_token,response.body.expires_in + Date.now())
            this.$router.push("/admin/mainpage")
           })
        //    https://www.youtube.com/watch?v=o2819ilKQ5M&index=4&list=PLkZU2rKh1mT9TgMvpFY1QVrX2z4I3D3Jq
           // .then(function (response){
            //     console.log(response)
            // })
        }
    }
}
</script>

