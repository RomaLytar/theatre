export default {
  state: {
    cartTickets: [],
    cartAbove: [],
    orderId: null,
    formData: []
  },
  getters: {
    cartTickets(state) {
      return state.cartTickets
    },
    cartAbove(state) {
      return state.cartAbove
    },
    orderId(state) {
      return state.orderId
    },
    formData(state) {
      return state.formData
    }
  },
  mutations: {
    setTicketsToCart(state, payload) {
      state.cartTickets = payload;
    },
    removeTicketsFromCart(state, payload) {
      const perfomanceIndex = state.cartTickets.findIndex(item => item.data.id == payload.perfomanceId);

      if (perfomanceIndex == -1) return false;

      const perfomance = state.cartTickets[perfomanceIndex],
            tickets = perfomance.data.tickets.data;

      if (tickets.length == payload.tickets.length) {
        state.cartTickets.splice(perfomanceIndex, 1);
      } else {
        perfomance.data.tickets.data = tickets.filter(ticket => ticket.id != payload.tickets[0]);
      }

      window.localStorageCart.removeTickets({
        id: payload.perfomanceId,
        tickets: payload.tickets
      })
    },
    setTicketsAboveToCart(state, payload) {
      state.cartAbove = payload;
    },
    removeTicketsAboveFromCart(state, payload) {
      const perfomanceIndex = state.cartAbove.findIndex(item => item.data.id == payload.perfomanceId);

      if (perfomanceIndex == -1) return false;

      const perfomance = state.cartAbove[perfomanceIndex],
            tickets = perfomance.data.tickets.data;

      if (tickets.length == payload.tickets.length) {
        state.cartAbove.splice(perfomanceIndex, 1);
      } else {
        perfomance.data.tickets.data = tickets.filter(ticket => ticket.id != payload.tickets[0]);
      }

      window.sessionStorageCart.removeTickets({
        id: payload.perfomanceId,
        tickets: payload.tickets
      })
    },
    removeAllTicketsAboveFromCart(state) {
      state.cartAbove = [];
      window.sessionStorageCart._deleteCart();
    },
    addTicketToCartFromAboveCart(state, {payload, reserved_time}) {
      if (!state.cartTickets.length) {
        state.cartTickets = payload;
      } else {
        let newArr = state.cartTickets.map(item => {
          const findTicket = payload.find(ticket => ticket.data.id == item.data.id);

          if (findTicket) {
            const itemClone = item;

            findTicket.data.tickets.data.forEach(ticket => itemClone.data.tickets.data.push(ticket));

            return itemClone;
          }

          return item;
        });

        payload.filter(ticket => !newArr.find(item => item.data.id == ticket.data.id)).forEach(ticket => newArr.push(ticket));

        state.cartTickets = newArr;
      }

      payload.forEach(item => {
        window.localStorageCart.addTickets({
          reserved_time: reserved_time,
          perfomances: [{
            id: item.data.id,
            date: item.data.date,
            tickets: item.data.tickets.data.map(item => item.id)
          }]
        })
      })
    },
    addTicketToAboveCart(state, payload) {
      if (!state.cartAbove.length) {
        state.cartAbove = [payload];
      } else {
        let newArr = [];

        if (state.cartAbove.find(item => item.data.id == payload.data.id)) {
          newArr = state.cartAbove.map(item => {
            if (payload.data.id == item.data.id) {
              //
              const itemClone = item;

              payload.data.tickets.data
                .filter(ticket => !itemClone.data.tickets.data.find(item => item.id == ticket.id))
                .forEach(ticket => itemClone.data.tickets.data.push(ticket));

              return itemClone;
            }

            return item;
          });
        } else {
          newArr = state.cartAbove;
          newArr.push(payload);
        }

        state.cartAbove = newArr;
      }
    },
    clearCart(state) {
      state.cartTickets = [];
      window.localStorageCart._deleteCart();
    },
    setOrderId(state, payload) {
      state.orderId = payload;
      localStorage.setItem(`orderId`, payload);
    },
    setFormData(state, payload) {
      state.formData = payload;
    }
  },
  actions: {
    async getTicketsInfo({commit, getters}, payload) {
      commit(`setLoading`, true);

      const reqData = {tickets: payload.tickets},
            above = payload.above;

      try {
        const tickets = await fetch(`/api/v1/tickets/details?lang=${getters.documentLang}`, {
          method: `POST`,
          body: JSON.stringify(reqData),
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`
          }
        })
        .then(response => response.json())
        .then(data => {
          const cart = [];

          data.tickets.data.forEach(ticket => {
            const index = cart.findIndex(perfomance => perfomance.data.id == ticket.performanceCalendar.data.id);

            if (index != -1) {
              const ticketsArr = cart[index].data.tickets.data;

              if(!ticketsArr.find(item => item.id == ticket.id)) {
                ticketsArr.push({
                  id: ticket.id,
                  seatPrice: ticket.seatPrice
                })
              }
            } else {
              cart.push({data: ticket.performanceCalendar.data});

              cart[cart.length - 1].data.tickets = {
                data: [{
                  id: ticket.id,
                  seatPrice: ticket.seatPrice
                }]
              }
            }
          });


          if (above) {
            commit(`setTicketsAboveToCart`, cart)
          } else {
            commit(`setTicketsToCart`, cart);
          }

          commit(`setLoading`, false);

          return data
        })
        .catch(error => console.log(error))

        if (!tickets) {
          throw tickets
        } else {
          return tickets
        }
      } catch(error) {
        throw error
      }
    },
    async removeTicketsFromCart({commit, getters}, payload) {
      const formatPayload = {'tickets': payload.tickets};

      try {
        const status = await fetch(`/api/v1/tickets/cancel-reservation?lang=${getters.documentLang}`, {
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
    async checkTicketsAvailability({commit, getters}, payload) {
      try {
        const tickets = await fetch(`/api/v1/tickets/information?lang=${getters.documentLang}`, {
          method: `POST`,
          body: JSON.stringify(payload),
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`
          }
        })
        .then(response => response.json())
        .then(data => data)
        .catch(error => console.log(error))

        if (!tickets) {
          throw tickets
        } else {
          return tickets
        }
      } catch(error) {
        throw error
      }
    },
    addTicketToCartFromAboveCart({dispatch, commit, getters}) {
      const tickets = getters.cartAbove.map(perfomance => perfomance.data.tickets.data.map(item => item.id).join(`,`)).join(`,`).split(`,`);

      dispatch(`checkTicketsAvailable`, {tickets})
        .then(data => {
          if (data.status) {
            commit(`addTicketToCartFromAboveCart`, {
              payload: getters.cartAbove,
              reserved_time: data.reservedTickets.data[0].reserved_time*1000
            });
            commit(`removeAllTicketsAboveFromCart`);
          } else {
            throw data
          }
        })
    },
    addTicketToAboveCart({dispatch, commit}, payload) {
      dispatch(`removeTicketsFromCart`, {
        perfomanceId: payload.data.id,
        tickets: payload.data.tickets.data.map(ticket => ticket.id)
      })

      commit(`addTicketToAboveCart`, payload);
    },
    async getOrderId({commit}, payload) {
      try {
        const order = await fetch(`/api/v1/orders/create-order`, {
          method: `POST`,
          body: JSON.stringify(payload),
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`
          }
        })
        .then(response => response.json())
        .then(data => data)
        .catch(error => console.log(error))

        if (!order.status) {
          throw order
        } else {
          return order
        }
      } catch(error) {
        throw error
      }
    },
    async getFormDataForPayment({commit}, payload) {
      try {
        const formData = await fetch(`/api/v1/orders/payment-code?order_id=${payload}`, {
          method: `GET`,
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`
          }
        })
        .then(response => response.json())
        .then(data => data)
        .catch(error => console.log(error))

        if (!formData.status) {
          throw formData
        } else {
          commit(`setFormData`, formData.data)
          return formData
        }
      } catch(error) {
        throw error
      }
    },
    async getOrder({commit, getters}, payload) {
      try {
        const order = await fetch(`/api/v1/orders/details?lang=${getters.documentLang}`, {
          method: `POST`,
          body: JSON.stringify(payload),
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`
          }
        })
        .then(response => response.json())
        .then(data => data)
        .catch(error => console.log(error))

        if (!order.status) {
          throw order
        } else {
          return order
        }
      } catch(error) {
        throw error
      }
    }
  }
}
