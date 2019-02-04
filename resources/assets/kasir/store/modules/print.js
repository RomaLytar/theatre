export default {
  state: {
    ticketTemplate: {},
    orderForPrint: {},
    printAccept: false
  },
  getters: {
    getTicketTemplate(state) {
      return state.ticketTemplate
    },
    getOrderForPrint(state) {
      return state.orderForPrint
    },
    getPrintAccept(state) {
      return state.printAccept
    }
  },
  mutations: {
    setTicketTemplate(state, payload) {
      state.ticketTemplate = payload;
    },
    setOrderForPrint(state, payload) {
      if (payload) {
        state.orderForPrint = payload;
        state.printAccept = true;

        console.log(state.orderForPrint)
      } else {
        state.orderForPrint = {};
        state.printAccept = false;
      }
    }
  },
  actions: {
    async getTicketTemplate({commit}) {
      try {
        const ticketTemplate = await fetch(`/api/v1/ticket-template?template=cash-box`, {
          method: `GET`,
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`
          }
        })
        .then(response => response.json())
        .then(data => {
          commit(`setTicketTemplate`, data.data);
          return data;
        })
        .catch(error => console.log(error))

        if (!ticketTemplate) {
          throw ticketTemplate
        } else {
          return ticketTemplate.data
        }
      } catch(error) {
        throw error
      }
    }
  }
}
