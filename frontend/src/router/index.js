import Vue from 'vue'
import VueRouter from 'vue-router'

const Login = () => import (/* webpackChunkName: "Login"*/ '../components/Login.vue')
const Dashboard = () => import (/* webpackChunkName: "Dashboard"*/ '../components/Dashboard.vue')
const FormTesDrive = () => import (/* webpackChunkName: "FormTesDrive"*/ '../components/FormTesDrive.vue')
const TesDrive = () => import (/* webpackChunkName: "TesDrive"*/ '../components/TesDrive.vue')

Vue.use(VueRouter)

const routes = [
  {
    path: '/auth',
    name: 'Login',
    component: Login,
    meta: {
      auth: false,
    },
  },
  {
    path: '/',
    name: 'Dashboard',
    component: Dashboard,
    meta: {
      auth: false,
    },
  },
  {
    path: '/FormTesDrive',
    name: 'FormTesDrive',
    component: FormTesDrive,
    meta: {
      auth: false,
    },
  },
  {
    path: '/TesDrive',
    name: 'TesDrive',
    component: TesDrive,
    meta: {
      auth: false,
    },
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
