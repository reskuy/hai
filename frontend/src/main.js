import Vue from 'vue'
import App from './App.vue'
import router from './router'
import vuetify from './plugins/vuetify';
import sweetalert2 from './plugins/sweetalert2';
import './registerServiceWorker'
// import './registNotifWorker'

Vue.config.productionTip = false

new Vue({
  router,
  vuetify,
  sweetalert2,
  render: h => h(App)
}).$mount('#app')