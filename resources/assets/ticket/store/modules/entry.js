export default {
  state: {
    documentLang: document.documentElement.getAttribute(`lang`),
    windowWidth: window.innerWidth,
    perfomanceInfo: {},
    perfomanceDates: [],
    perfomancePrices: []
  },
  getters: {
    documentLang(state) {
      return state.documentLang
    },
    windowWidth(state) {
      return state.windowWidth
    },
    perfomanceInfo(state) {
      return state.perfomanceInfo
    },
    perfomanceDates(state) {
      return state.perfomanceDates
    },
    perfomancePrices(state) {
      return state.perfomancePrices
    },
    allSeats(state) {
      if (!state.perfomanceInfo.tickets) {
        return null
      } else {
        return state.perfomanceInfo.tickets.data
      }
    },
    availableSeats(state, getters) {
      if (!getters.allSeats) {
        return null
      } else {
        return getters.allSeats.filter(ticket => ticket.isAvailable == true)
      }
    },
    availableFilteredNotCartSeats(state, getters) {
      if (!getters.availableSeats) {
        return null
      } else {
        return getters.availableSeats.filter(ticket => !getters.tickets.find(item => item.id === ticket.id))
                                     .filter(ticket => ticket.seatPrice.data.price >= getters.perfomanceFilterPrices[0] && ticket.seatPrice.data.price <= getters.perfomanceFilterPrices[1])
      }
    }
  },
  mutations: {
    setPerfomanceInfo(state, payload) {
      state.perfomanceInfo = payload;
    },
    setPerfomanceDates(state, payload) {
      state.perfomanceDates = payload;
    },
    setPerfomancePrices(state, payload) {
      state.perfomancePrices = payload.priceZones.data.map(item => parseInt(item.price));
    }
  },
  actions: {
    async getPerfomanceData({commit, getters, dispatch}, payload) {
      commit(`setLoading`, true);

      const perfomanceInfo = await dispatch(`getPerfomanceInfo`, payload),
            perfomanceDates = await dispatch(`getPerfomanceDates`, perfomanceInfo.performance.data.id),
            perfomancePrices = await dispatch(`getPerfomancePrices`, perfomanceInfo.price_pattern_id);

      return perfomanceInfo;

      commit(`setLoading`, false);
    },
    async getPerfomanceInfo({commit, getters}, payload) {
      try {
        const perfomanceInfo = await fetch(`/api/v1/events/${payload}/tickets?lang=${getters.documentLang}`, {
          method: `GET`,
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`
          }
        })
        .then(response => response.json())
        .then(data => {
          commit(`setPerfomanceInfo`, data.data);
          return data;
        })
        .catch(error => console.log(error))

        if (!perfomanceInfo.data) {
          throw perfomanceInfo
        } else {
          return perfomanceInfo.data
        }
      } catch(error) {
        throw error
      }
    },
    async getPerfomanceDates({commit, getters}, payload) {
      try {
        const perfomanceDates = await fetch(`/api/v1/performances/${payload}/dates?lang=${getters.documentLang}`, {
          method: `GET`,
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`
          }
        })
        .then(response => response.json())
        .then(data => {
          commit(`setPerfomanceDates`, data.data);

          return data;
        })
        .catch(error => console.log(error))

        if (!perfomanceDates.data) {
          throw perfomanceDates
        } else {
          return perfomanceDates.data
        }
      } catch(error) {
        throw error
      }
    },
    async getPerfomancePrices({commit, getters}, payload) {
      try {
        const perfomancePrices = await fetch(`/api/v1/events/${payload}/price-zones?lang=${getters.documentLang}`, {
          method: `GET`,
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`
          }
        })
        .then(response => response.json())
        .then(data => {
          commit(`setPerfomancePrices`, data.data);

          return data;
        })
        .catch(error => console.log(error))

        if (!perfomancePrices.data) {
          throw perfomancePrices
        } else {
          return perfomancePrices
        }
      } catch(error) {
        throw error
      }
    }
  }
}
