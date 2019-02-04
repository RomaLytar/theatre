export default {
  state: {
    kasir: {},
    eventsDates: [],
    events: []
  },
  getters: {
    kasir(state) {
      return state.kasir
    },
    eventsDates(state) {
      return state.eventsDates
    },
    events(state) {
      return state.events
    }
  },
  mutations: {
    setKasir(state, kasir) {
      state.kasir = kasir;
    },
    setEventsDates(state, dates) {
      state.eventsDates = dates;
    },
    setEvents(state, events) {
      const index = state.events.find(item => item.date == events.date);

      index ? state.events.splice(index, 1, events) : state.events.push(events);
    },
    clearEvents(state) {
      state.events = [];
    },
    refreshEvent(state, event) {
      state.events.forEach(date => {
        const index = date.data.find(item => item.id == event.id);

        if (index) date.data.splice(index, 1, event.data[0]);
      })
    }
  },
  actions: {
    setKasir({commit}, kasir) {
      commit(`setKasir`, kasir);
    },
    async getEventsDates({commit}, payload) {
      let date = ``;

      if (payload) date = `?date=${payload}`;

      try {
        const eventsDates = await fetch(`/admin/cash-box/coming-dates${date}`, {
          method: `GET`,
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`
          }
        })
        .then(response => response.json())
        .then(data => {
          commit(`setEventsDates`, data.dates);
          return data;
        })
        .catch(error => console.log(error))

        if (!eventsDates.status) {
          throw eventsDates
        } else {
          return eventsDates
        }
      } catch(error) {
        throw error
      }
    },
    async getEventByDate({commit}, payload) {
      const date = payload.slice(0, 10);

      try {
        const events = await fetch(`/admin/cash-box/events-date?date=${date}`, {
          method: `GET`,
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`
          }
        })
        .then(response => response.json())
        .then(data => {
          commit(`setEvents`, {
            date: payload,
            data: data.data
          });

          return data;
        })
        .catch(error => console.log(error))
        return events
      } catch(error) {
        throw error
      }
    },
    async refreshEventById({commit}, id) {
      try {
        const events = await fetch(`/admin/cash-box/events-date?eventId=${id}`, {
          method: `GET`,
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`
          }
        })
        .then(response => response.json())
        .then(data => {
          commit(`refreshEvent`, {
            id: id,
            data: data.data
          });

          return data;
        })
        .catch(error => console.log(error))
        return events
      } catch(error) {
        throw error
      }
    }
  }
}
