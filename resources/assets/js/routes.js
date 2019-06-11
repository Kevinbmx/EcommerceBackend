window.Vue = require('vue');

window.VueRouter=require('vue-router').default;

window.VueAxios=require('vue-axios').default;

window.Axios=require('axios').default;


// Vue.http.headers.common['X-CSRF-TOKEN'] = Laravel.crsfToken;

window.Vue.use(window.VueRouter,window.VueAxios, window.VueAxios);
// Vue.use(VueRouter)
const router = new VueRouter({
        routes:[
                {
                        path:"/login",
                        component: require('./components/authentication/Login.vue'),
                        meta:{
                                visitors:true,
                        }
                },
                {
                        path:"/register",
                        component: require('./components/authentication/Register.vue'),
                        meta:{
                                visitors: true,
                        }
                }, 
                {
                        path:"/admin/mainpage",
                        component: require('./components/administration/Mainpage.vue'),
                        meta:{
                                requiresAuth: true,
                        }
                }, 
                {
                        name:'listUsers',
                        path: '/admin/user', 
                        component: require('./components/administration/users/index.vue'),
                        meta:{
                                requiresAuth:true,
                        }
                },
                {
                        name:'createUser',
                        path: '/admin/create', 
                        component: require('./components/administration/users/form.vue'),
                        meta:{
                                requiresAuth:true,
                        }
                },
                {
                        name:'editUser',
                        path: '/admin/user/:id/edit', 
                        component: require('./components/administration/users/edit.vue'),
                        meta:{
                                requiresAuth:true,
                        }
                },
                {
                        name:'showUser',
                        path: '/admin/user/:id', 
                        component: require('./components/administration/users/show.vue'),
                        meta:{
                                requiresAuth:true,
                        }
                },
        ]
        // ,mode:'history'
})

// const routes =[
    
//         // {path: '/', component: require('./components/Listposts.vue')},
//         // {path: '/add-post', component: require('./components/Addpost.vue')},
//         // {path: '/edit/:id', component: require('./components/Editpost.vue')},
//         // {path: '/post-delete', component: require('./components/Deletepost.vue')},

//         // {path: '/', component: require('./components/administration/users/index.vue')},
//         // {path: '/user/create', component: require('./components/administration/users/form.vue')},
//         // {path: '/user/edit/:id', component: require('./components/administration/users/Edituser.vue')},
//         // {path: '/user/delte', component: require('./components/administration/users/Deleteuser.vue')},


//         {name:'listUsers',path: '/', component: require('./components/administration/users/index.vue')},
//         {name:'createUser',path: '/create', component: require('./components/administration/users/form.vue')},
//         {name:'editUser',path: '/:id/edit', component: require('./components/administration/users/edit.vue')},
//         {name:'showUser',path: '/:id', component: require('./components/administration/users/show.vue')},
    
// ];

// const router = new VueRouter({ linkActiveClass:'active', routes: routes});

export default router