import Vue from 'vue'
import Vuex from 'vuex'

import common from './modules/common'
import entry from './modules/entry'
import hall from './modules/hall'
import cart from './modules/cart'
import lastOrder from './modules/lastOrder'
import booking from './modules/booking'
import print from './modules/print'

Vue.use(Vuex)

export const store = new Vuex.Store({
  modules: {
    common,
    entry,
    hall,
    cart,
    lastOrder,
    booking,
    print
  }
})
