import './bootstrap';
import './popper'
import './metisMenu'
import './defaultAdmin'
import Vue from 'vue'

import App from './components/App.vue'
import Router from './routes'
// window.VeeValidate = require('vee-validate');
import  VeeValidate from 'vee-validate'
import  VueResource from 'vue-resource'
import Auth from './packages/auth/Auth.js'

Vue.use(VeeValidate);
Vue.use(VueResource);
Vue.use(Auth);

Vue.http.options.root = 'http://webtrovare.test:8000'
Vue.http.headers.common['Authorization'] = 'Bearer ' + Vue.auth.getToken()

Router.beforeEach(
  (to,from, next)=>{
    if(to.matched.some(record => record.meta.visitors)){
      if(Vue.auth.isAuthenticated()){
        next({
          path: '/admin/mainpage'
        })
      }else next()
    }
    else if(to.matched.some(record => record.meta.requiresAuth)){
      if(!Vue.auth.isAuthenticated()){
        next({
          path: '/login'
        })
      }else next()
    } 
    else next()
  }
)

// new Vue(
//  Vue.util.extend(
//  { router },
//  App
//  )
// ).$mount('#app');

new Vue({
    el: '#app',
    render: h => h (App),
    // template: '<App/>'
    router:Router
  })
  
