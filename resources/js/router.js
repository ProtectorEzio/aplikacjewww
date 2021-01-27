import Vue from'vue'
import Router from 'vue-router'
Vue.use(Router)
import Home from  './views/Home.vue';
import Login from  './views/Login.vue';
import Register from  './views/Register.vue';
import Users from  './views/components/tabele/Users.vue';
import Posts from  './views/components/tabele/Posts.vue';
import NewPost from  './views/components/NewPost.vue';
import Role from  './views/components/tabele/Role.vue';
import PrzypiszRole from  './views/components/PrzypiszRole.vue';


const routes = [
  {
    path: '/',
    component: Home,
  },
  {
    path: '/login',
    component: Login,
  },
  {
    path: '/register',
    component: Register,
  },
  {
    path: '/users',
    component: Users,
  },
  {
    path: '/posts',
    component: Posts,
  },
  {
    path: '/role',
    component: Role,
  },
  {
    path: '/przypiszrole',
    component: PrzypiszRole,
  },
  {
    path: '/nowypost',
    component: NewPost,
  },
]

export default new Router({
    mode: 'history',
    routes

})