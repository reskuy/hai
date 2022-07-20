import Vue from 'vue'
import VueRouter from 'vue-router'

const Login = () => import (/* webpackChunkName: "Login"*/ '../components/Login.vue')
const Dashboard = () => import (/* webpackChunkName: "Dashboard"*/ '../components/Dashboard.vue')
const FormTesDrive = () => import (/* webpackChunkName: "FormTesDrive"*/ '../components/FormTesDrive.vue')
const FormPeminjaman = () => import (/* webpackChunkName: "FormPeminjaman"*/ '../components/FormPeminjaman.vue')
const TesDrive = () => import (/* webpackChunkName: "TesDrive"*/ '../components/TesDrive.vue')
const AksiTesDrive = () => import (/* webpackChunkName: "AksiTesDrive"*/ '../views/Aksi/AksiTesDrive.vue')
const Peminjaman = () => import (/* webpackChunkName: "Peminjaman"*/ '../components/Peminjaman.vue')
const PengembalianTesDrive = () => import (/* webpackChunkName: "PengembalianTesDrive"*/ '../components/PengembalianTesDrive.vue')
const PengembalianPeminjaman = () => import (/* webpackChunkName: "PengembalianPeminjaman"*/ '../components/PengembalianPeminjaman.vue')
const Aset = () => import (/* webpackChunkName: "Aset"*/ '../components/Aset.vue')
const User = () => import (/* webpackChunkName: "User"*/ '../components/User.vue')
const FormDataUser = () => import (/* webpackChunkName: "FormDataUser"*/ '../views/User/FormDataUser.vue')
const FormDataAset = () => import (/* webpackChunkName: "FormDataAset"*/ '../views/Aset/FormDataAset.vue')
const History = () => import (/* webpackChunkName: "History"*/ '../components/History.vue')

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
  {
    path: '/TesDrive/:id',
    name: 'AksiTesDrive',
    component: AksiTesDrive,
    meta: {
      auth: false,
    },
  },
  {
    path: '/Aset',
    name: 'Aset',
    component: Aset,
    meta: {
      auth: false,
    },
  },
  {
    path: '/FormPeminjaman',
    name: 'FormPeminjaman',
    component: FormPeminjaman,
    meta: {
      auth: false,
    },
  },
  {
    path: '/User',
    name: 'User',
    component: User,
    meta: {
      auth: false,
    },
  },
  {
    path: '/FormDataUser',
    name: 'FormDataUser',
    component: FormDataUser,
    meta: {
      auth: false,
    },
  },
  {
    path: '/FormDataAset',
    name: 'FormDataAset',
    component: FormDataAset,
    meta: {
      auth: false,
    },
  },
  {
    path: '/Peminjaman',
    name: 'Peminjaman',
    component: Peminjaman,
    meta: {
      auth: false,
    },
  },
  {
    path: '/PengembalianTesDrive',
    name: 'PengembalianTesDrive',
    component: PengembalianTesDrive,
    meta: {
      auth: false,
    },
  },
  {
    path: '/PengembalianPeminjaman',
    name: 'PengembalianPeminjaman',
    component: PengembalianPeminjaman,
    meta: {
      auth: false,
    },
  },
  {
    path: '/History',
    name: 'History',
    component: History,
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
