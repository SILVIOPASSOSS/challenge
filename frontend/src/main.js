import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import vuetify from './plugins/vuetify'
import axios from 'axios'
import Vuelidate from 'vuelidate'


Vue.component('notifications', require('./components/Notifications'))


Vue.config.productionTip = false

Vue.use(Vuelidate)

new Vue({
  router,
  store,
  vuetify,
  axios,
  render: h => h(App)
}).$mount('#app')
