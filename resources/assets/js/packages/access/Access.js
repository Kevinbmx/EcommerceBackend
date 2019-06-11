export default function (Vue){


    Object.defineProperties(Vue.prototype,{
        $http:{
            get(){
                return Vue.auth
            }
        }
    })
}