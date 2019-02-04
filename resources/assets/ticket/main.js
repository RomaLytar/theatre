import Vue from 'vue'
import App from './components/App.vue'
import {store} from './store'
import {router} from './routes'

Vue.filter("addZero", (value) => value >= 10 ? value : `0${value}`);

new Vue({
  el: `#app`,
  store,
  router,
  render: h => h(App)
})
