export default {
  state: {
    ticketsHash: null,
    ticketsSuccess: []
  },
  getters: {
    ticketsHash(state) {
      return state.ticketsHash ? state.ticketsHash : localStorage.getItem(`ticketHash`);
    },
    ticketsSuccess(state) {
      return state.ticketsSuccess
    }
  },
  mutations: {
    ticketsSuccess(state, payload) {
      state.ticketsSuccess = payload;
    },
    ticketsHash(state, payload) {
      state.ticketsHash = payload;
      localStorage.setItem(`ticketHash`, payload);
    }
  },
  actions: {
    ticketsSuccess({dispatch, commit, getters}, payload) {
      commit(`ticketsSuccess`, payload);
      commit(`clearCart`);

      localStorage.setItem(`ticketsSuccess`, JSON.stringify(payload))
    },
    addTicketsSuccessFromLocalStorage({commit}) {
      const payload = JSON.parse(localStorage.getItem(`ticketsSuccess`));

      commit(`ticketsSuccess`, payload);
    }
  }
}
