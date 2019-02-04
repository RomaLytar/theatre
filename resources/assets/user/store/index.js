import Vue from 'vue'
import Vuex from 'vuex'

import user from './modules/user'
import common from './modules/common'
import translation from './modules/translation'
import orders from './modules/orders'
import menu from './modules/menu'

Vue.use(Vuex)

export const store = new Vuex.Store({
  modules: {
    user,
    common,
    translation,
    orders,
    menu
  }
})

