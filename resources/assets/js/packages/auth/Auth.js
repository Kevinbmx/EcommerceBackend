export default function (Vue){
    Vue.auth={

        setToken(token, expiration){
            localStorage.setItem('token', token)
            localStorage.setItem('expiration', expiration)
        },
        getToken(){
            var token = localStorage.getItem('token')
            var experation = localStorage.getItem('expiration')
            if(!token || !experation)
                return null
                if(Date.now()> parseInt(experation)){
                    this.destroyToken()
                    return null
                }else{
                    return token
                }
        },
        destroyToken(){
            localStorage.removeItem('token')
            localStorage.removeItem('expiration')
        },
        isAuthenticated(){
            if (this.getToken()) {
                return true;
            }else{
                return false;
            }
        }
    }
    Object.defineProperties(Vue.prototype,{
        $auth:{
            get(){
                return Vue.auth
            }
        }
    })
}