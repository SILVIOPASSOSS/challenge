import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/HomeView.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView,
    meta: {
      title: 'Consulta de Aluno'
    }
  },
  {
    path: '/register',
    name: 'registerStudent',
    component: () => import('../components/students/Register.vue'),
    meta: {
      title: 'Cadastro de Aluno'
    }
  },
  {
    path: '/edit/:id',
    name: 'editStudent',
    component: () => import('../components/students/Edit.vue'),
    meta: {
      title: 'Editar Aluno'
    }
  },
  {
    path: '/detail/:id',
    name: 'detailStudent',
    component: () => import('../components/students/Detail.vue'),
    meta: {
      title: 'Detalhes do Aluno'
    }
  },
  {
    path: '/about',
    name: 'about',
    meta: {
      title: 'Sobre'
    },
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () =>
      import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
