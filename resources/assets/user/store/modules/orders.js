const formatFunc = (arr) => {
  const orders = [];

  arr.forEach(order => {
    order.tickets.data.forEach(ticket => {
      const index = orders.findIndex(item => item.event_id == ticket.event_id);

      if (index == -1) {
        orders.push({
          event_id: ticket.event_id,
          event_date: ticket.event_date,
          event_time: ticket.event_time,
          event_title: ticket.event_title,
          hall_title: ticket.hall_title,
          tickets: [{
            row_number: ticket.row_number,
            seat_number: ticket.seat_number,
            section_title: ticket.section_title,
            ticket_id: ticket.ticket_id,
            price: ticket.price,
            orderHash: order.hash
          }]
        })
      } else {
        orders[index].tickets.push({
          row_number: ticket.row_number,
          seat_number: ticket.seat_number,
          section_title: ticket.section_title,
          ticket_id: ticket.ticket_id,
          price: ticket.price,
          orderHash: order.hash
        })
      }
    })
  });

  return orders;
}

export default {
  state: {
    activeOrders: [],
    archiveOrders: []
  },
  getters: {
    activeOrders(state) {
      return state.activeOrders
    },
    formatActiveOrders(state) {
      return formatFunc(state.activeOrders)
    },
    formatArchiveOrders(state) {
      return formatFunc(state.archiveOrders)
    },
    archiveOrders(state) {
      return state.archiveOrders
    }
  },
  mutations: {
    setActiveOrders(state, payload) {
      state.activeOrders = payload;
    },
    setArchiveOrders(state, payload) {
      state.archiveOrders = payload;
    }
  },
  actions: {
    async getOrders({commit, getters}, payload) {
      const userToken = localStorage.getItem(`token`);

      if (!userToken) return false;

      commit(`setLoading`, true);

      try {
        const orders = await fetch(`/api/tickets?with=${payload}&lang=${getters.documentLang}`, {
          method: `GET`,
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`,
            "Authorization": `Bearer ${userToken}`
          },
        })
        .then(response => response.json())
        .catch(error => {
          console.log(error);
        })

        commit(`setLoading`, false);

        if (orders.data) {
          if (payload == `active`) {
            commit(`setActiveOrders`, orders.data);
          } else {
            commit(`setArchiveOrders`, orders.data);
          }

        } else {
          throw new Error(user.error);
        }
      } catch(error) {
        throw error
      }
    },
  }
}
