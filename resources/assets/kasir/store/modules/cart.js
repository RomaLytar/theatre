export default {
  state: {
    cart: [],
    temporaryStorage: [],
    ticketsPrintSrc: ``,
    bookingOrder: ``
  },
  getters: {
    getCart(state) {
      return state.cart
    },
    getTemporaryStorage(state) {
      return state.temporaryStorage
    },
    getTicketsPrintSrc(state) {
      return state.ticketsPrintSrc
    },
    getBookingOrder(state) {
      return state.ticketsPrintSrc
    }
  },
  mutations: {
    addTicketToCart(state, payload) {
      state.cart.push(payload)
    },
    addTicketsFromBookingToCart(state, payload) {
      state.cart.push(payload)
    },
    removeTicketsFromCart(state, payload) {
      payload.forEach(id => {
        const index = state.cart.findIndex(item => item.id == id);

        state.cart.splice(index, 1);
        state.temporaryStorage.push(id);
      })
    },
    clearCart(state) {
      state.cart = [];
    },
    clearTemporaryStorage(state) {
      state.temporaryStorage = [];
    },
    setTicketsPrintSrc(state, payload) {
      state.ticketsPrintSrc = payload;
    },
    setBookingOrder(state, payload) {
      state.bookingOrder = payload;
    }
  },
  actions: {
    async addTicketToCart({commit}, payload) {
      const formatPayload = {tickets: [payload.id]};

      try {
        const status = await fetch(`/api/v1/tickets/reservation?lang=ua`, {
          method: `POST`,
          body: JSON.stringify(formatPayload),
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`
          }
        })
        .then(response => response.json())
        .then(data => data)
        .catch(error => console.log(error))

        if (!status || !status.status) {
          throw status
        } else {
          commit(`addTicketToCart`, payload);
          return status
        }
      } catch(error) {
        throw error
      }
    },
    async removeTicketFromCart({commit}, payload) {
      const formatPayload = {tickets: payload};

      try {
        const status = await fetch(`/api/v1/tickets/cancel-reservation?lang=ua`, {
          method: `POST`,
          body: JSON.stringify(formatPayload),
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`
          }
        })
        .then(response => response.json())
        .then(data => data)
        .catch(error => console.log(error))

        if (!status) {
          throw status
        } else {
          commit(`removeTicketsFromCart`, payload);
        }
      } catch(error) {
        throw error
      }
    },
    async buyTickets({commit, dispatch}, payload) {
      try {
        const status = await fetch(`/admin/cash-box/orders/create?lang=ua`, {
          method: `POST`,
          body: JSON.stringify(payload),
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`,
            'X-CSRF-TOKEN': document.querySelector(`[name=_token]`).value
          }
        })
        .then(response => response.json())
        .then(data => data)
        .catch(error => console.log(error))

        if (!status || !status.status) {
          throw status
        } else {
          commit(`setTicketsPrintSrc`, status.order.data.hash);
          commit(`clearCart`);
          dispatch(`saveLastOrder`, status);
          return status
        }
      } catch(error) {
        throw error
      }
    },
    async buyBookingTickets({commit, dispatch}, payload) {
      try {
        const status = await fetch(`/admin/cash-box/orders/${payload.orderId}/confirm`, {
          method: `POST`,
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`,
            'X-CSRF-TOKEN': document.querySelector(`[name=_token]`).value
          }
        })
        .then(response => response.json())
        .then(data => data)
        .catch(error => console.log(error))

        if (!status || !status.status) {
          throw status
        } else {
          commit(`setTicketsPrintSrc`, status.order.data.hash);
          dispatch(`saveLastOrder`, {
            order: status.order,
            hallInfo: payload.hallInfo
          });
          return status
        }
      } catch(error) {
        throw error
      }
    },
    async bookingTickets({commit, dispatch}, payload) {
      try {
        const status = await fetch(`/admin/cash-box/orders/create?lang=ua`, {
          method: `POST`,
          body: JSON.stringify(payload),
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`,
            'X-CSRF-TOKEN': document.querySelector(`[name=_token]`).value
          }
        })
        .then(response => response.json())
        .then(data => data)
        .catch(error => console.log(error))

        if (!status || !status.status) {
          throw status
        } else {
          commit(`setBookingOrder`, status.order.data.id);
          commit(`clearCart`);
          dispatch(`saveLastOrder`, status);
          return status
        }
      } catch(error) {
        throw error
      }
    }
  }
}
