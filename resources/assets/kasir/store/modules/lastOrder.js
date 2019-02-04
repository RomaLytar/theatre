export default {
  state: {
    lastOrder: {},
    ticketTemplate: {}
  },
  getters: {
    getLastOrder(state) {
      return state.lastOrder
    }
  },
  mutations: {
    saveLastOrder(state, payload) {
      localStorage.setItem(`lastOrder`, JSON.stringify(payload));

      state.lastOrder = payload;
    }
  },
  actions: {
    saveLastOrder({commit, rootState}, status) {
      if (!status.hallInfo) {
        commit(`saveLastOrder`, {
          order: status.order,
          hallInfo: {
            date: rootState.hall.hall.date,
            hall: rootState.hall.hall.hall,
            id: rootState.hall.hall.id,
            performance: rootState.hall.hall.performance,
            price_pattern_id: rootState.hall.hall.price_pattern_id
          }
        })
      } else {
        commit(`saveLastOrder`, status)
      }
    }
  }
}
