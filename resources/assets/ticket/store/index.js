import Vue from 'vue'
import Vuex from 'vuex'

import common from './modules/common'
import perfomance from './modules/perfomance'
import entry from './modules/entry'
import cart from './modules/cart'
import auth from './modules/auth'
import tickets from './modules/tickets'

Vue.use(Vuex)

export const store = new Vuex.Store({
  modules: {
    common,
    perfomance,
    entry,
    cart,
    auth,
    tickets
  }
})

