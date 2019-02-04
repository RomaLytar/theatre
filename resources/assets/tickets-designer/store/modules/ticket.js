export default {
  state: {
    name: `Без імені`,
    width: 200,
    height: 72,
    ticketFields: [],
    activeCashBox: false,
    activeOnline: false,
    poster: null,
    activeId: null
  },
  getters: {
    getName(state) {
      return state.name
    },
    getWidth(state) {
      return state.width
    },
    getHeight(state) {
      return state.height
    },
    getTicketFields(state) {
      return state.ticketFields
    },
    getActiveCashBox(state) {
      return state.activeCashBox
    },
    getActiveOnline(state) {
      return state.activeOnline
    },
    getPoster(state) {
      return state.poster
    },
    getActiveId(state) {
      return state.activeId
    }
  },
  mutations: {
    setName(state, payload) {
      state.name = payload;
    },
    setWidth(state, payload) {
      state.width = payload;
    },
    setHeight(state, payload) {
      state.height = payload;
    },
    setActiveCashBox(state, payload) {
      state.activeCashBox = payload;
    },
    setActiveOnline(state, payload) {
      state.activeOnline = payload;
    },
    setPoster(state, payload) {
      state.poster = payload;
    },
    setAllFields(state, fields) {
      state.ticketFields = fields;
    },
    addTicketField(state, ticket) {
      state.ticketFields.push(ticket);
    },
    changeTicketField(state, payload) {
      const fieldIndex = state.ticketFields.findIndex(item => item === payload.field);

      if (fieldIndex != -1) state.ticketFields[fieldIndex][payload.type] = payload.value;
    },
    ticketFieldResize(state, payload) {
      const fieldIndex = state.ticketFields.findIndex(item => item === payload.field);

      if (fieldIndex != -1) {
        const ticket = state.ticketFields[fieldIndex];

        ticket.posX = payload.posX;
        ticket.posY = payload.posY;
        ticket.width = payload.width;
        ticket.height = payload.height;
      }
    },
    removeTicketField(state, payload) {
      const fieldIndex = state.ticketFields.findIndex(ticket => ticket.id === payload);

      if (fieldIndex != -1) state.ticketFields.splice(fieldIndex, 1);
    },
    resetTicket(state) {
      state.ticketFields = []
    },
    setActiveId(state, payload) {
      state.activeId = payload;
    }
  },
  actions: {
    async saveTicket({commit}, payload) {
      try {
        const ticket = await fetch(`/admin/ticket-templates`, {
          method: `POST`,
          body: payload,
          headers: {
            "Accept": `application/json`,
            'X-CSRF-TOKEN': document.querySelector(`[name=_token]`).value
          }
        })
        .then(response => response.json())
        .then(data => data)
        .catch(error => console.log(error))

        if (!ticket) {
          throw ticket
        } else {
          return ticket
        }
      } catch(error) {
        throw error
      }
    },
    async updateTicket({commit}, payload) {
      try {
        const ticket = await fetch(`/admin/ticket-templates/${payload.id}`, {
          method: `POST`,
          body: payload.data,
          headers: {
            "Accept": `application/json`,
            'X-CSRF-TOKEN': document.querySelector(`[name=_token]`).value
          }
        })
        .then(response => response.json())
        .then(data => data)
        .catch(error => console.log(error))

        if (!ticket) {
          throw ticket
        } else {
          return ticket
        }
      } catch(error) {
        throw error
      }
    },
    async getTicketTamplate({commit}, payload) {
      try {
        const ticketTemplate = await fetch(`/admin/ticket-templates/${payload}`, {
          method: `GET`,
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`,
            'X-CSRF-TOKEN': document.querySelector(`[name=_token]`).value
          }
        })
        .then(response => response.json())
        .then(data => data)
        .catch(error => console.log(error))

        if (!ticketTemplate) {
          throw ticketTemplate
        } else {
          const obj = ticketTemplate.data;

          commit(`setName`, obj.title);
          commit(`setWidth`, obj.width);
          commit(`setHeight`, obj.height);
          commit(`setActiveCashBox`, obj.is_active_cash_box);
          commit(`setActiveOnline`, obj.is_active_online);
          commit(`setPoster`, obj.poster);

          try {
            commit(`setAllFields`, JSON.parse(obj.json_code));
          } catch(err) {
            console.warn(err);
          }

          return ticketTemplate.data
        }
      } catch(error) {
        throw error
      }
    },
    resetTicketData({commit}) {
      commit(`resetTicket`);
      commit(`setName`, `Без імені`);
      commit(`setWidth`, 200);
      commit(`setHeight`, 72);
      commit(`setActiveCashBox`, false);
      commit(`setActiveOnline`, false);
      commit(`setPoster`, null);
    }
  }
}
