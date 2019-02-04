import Vue from 'vue'
import Vuex from 'vuex'

import ticket from './modules/ticket'
import ticketsList from './modules/tickets-list'

Vue.use(Vuex)

export const store = new Vuex.Store({
  modules: {
    ticketsList,
    ticket
  }
})
