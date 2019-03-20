// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import mixins from './mixins'
import store from './store'
import axios from 'axios'
import VueAxios from 'vue-axios'

import moment from 'moment'

Vue.prototype.moment = moment
Vue.use(require('vue-moment'))


Vue.use(VueAxios, axios);

Vue.prototype.$axios = axios
Vue.config.productionTip = false

// Notif
import notif from '@/components/Includes/notif.vue'
Vue.component('notif', notif);

// Vue Notif
import VueNotifications from 'vue-notifications'
import miniToastr from 'mini-toastr'// https://github.com/se-panfilov/mini-toastr
miniToastr.init()
function toast ({title, message, type, timeout, cb}) {
  return miniToastr[type](message, title, timeout, cb)
}
const options = {
  success: toast,
  error: toast,
  info: toast,
  warn: toast
}
Vue.use(VueNotifications, options)
// ./Vue Notif

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  mixins: ['mixins'],
  components: { App },
  template: '<App/>'
})
