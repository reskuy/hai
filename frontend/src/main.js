import Vue from 'vue'
import App from './App.vue'
import router from './router'
import vuetify from './plugins/vuetify';
import sweetalert2 from './plugins/sweetalert2';
import './registerServiceWorker'
import VueQrcode from '@chenfengyuan/vue-qrcode';
// import './registNotifWorker'
import moment from 'moment'

Vue.prototype.moment = moment
Vue.config.productionTip = false
Vue.component(VueQrcode.name, VueQrcode);

new Vue({
  router,
  vuetify,
  sweetalert2,
  render: h => h(App)
}).$mount('#app')