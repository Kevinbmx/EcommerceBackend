<template>
    <div>
        <h1>bienvenidos</h1>
        <ul>
            <li v-for="user in users">
                {{user.name}}
            </li>
        </ul>

    </div>
</template>

<script>
export default {
    data(){
        return{
            users:[]
        }
    },
    created(){
        this.$http.get('admin/api/user',this.$auth.getToken())
        .then(response =>{
            this.users = response.body
        })
    }
}
</script>

<style>

</style>

