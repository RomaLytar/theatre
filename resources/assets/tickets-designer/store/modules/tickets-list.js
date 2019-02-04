export default {
  state: {
    ticketsList: []
  },
  getters: {
    ticketsList(state) {
      return state.ticketsList
    }
  },
  mutations: {
    setTicketsList(state, payload) {
      state.ticketsList = payload
    },
    deleteTicket(state, payload) {
      const index = state.ticketsList.findIndex(ticket => ticket.id == payload);

      if (index != -1) state.ticketsList.splice(index, 1);
    }
  },
  actions: {
    async getTicketsList({commit}) {
      try {
        const ticketsList = await fetch(`/admin/ticket-templates`, {
          method: `GET`,
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`
          }
        })
        .then(response => response.json())
        .then(data => data)
        .catch(error => console.log(error))

        if (!ticketsList) {
          throw ticketsList
        } else {
          commit(`setTicketsList`, ticketsList.data)
          return ticketsList
        }
      } catch(error) {
        throw error
      }
    },
    async deleteTicket({commit}, payload) {
      try {
        const status = await fetch(`/admin/ticket-templates/${payload}`, {
          method: `DELETE`,
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`,
            'X-CSRF-TOKEN': document.querySelector(`[name=_token]`).value
          }
        })
        .then(response => response.json())
        .then(data => data)
        .catch(error => console.log(error))

        if (!status.status) {
          throw status
        } else {
          commit(`deleteTicket`, payload)
          return status
        }
      } catch(error) {
        throw error
      }
    }
  }
}
