import VueRouter from 'vue-router';

let routes = [
  {
    path: '/',
    component: require('./components/Login.vue')
  },
  {
    path: '/tracker',
    component: require('./components/tracker/Index.vue')
  },
  {
    path: '/funds',
    component: require('./components/funds/Index.vue')
  },
  {
    path: '/debts',
    component: require('./components/debts/Index.vue')
  }
]

export default new VueRouter({
  routes,
  linkActiveClass: 'active',
  mode: 'history'
});