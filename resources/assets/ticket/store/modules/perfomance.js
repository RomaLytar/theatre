export default {
  state: {
    perfomanceLegend: {
      available: {
        name: {
          "ru": `Доступные`,
          "en": `Available`,
          "ua": `Доступні`
        },
        style: {
          "background": `#009238`
        }
      },
      notAvailable: {
        name: {
          "ru": `Не доступные`,
          "en": `Not available`,
          "ua": `Не доступні`
        },
        style: {
          "background": `#e7e7e7`,
          "border": `1px solid #888888`
        }
      },
      selected: {
        name: {
          "ru": `Выбрано`,
          "en": `Selected`,
          "ua": `Вибрано`
        },
        style: {
          "background": `#f490a5`
        }
      },
      bestChoise: {
        name: {
          "ru": `Лучший выбор`,
          "en": `Best choice`,
          "ua": `Кращий вибір`
        },
        style: {
          "background": `#cc9933`
        }
      }
    },
    perfomanceFilterPrices: [],
    sectorList: [
      {
        checked: true,
        sectionId: `1`,
        sections: [1],
        sectionName: {
          "ru": `Партер`,
          "en": `Parquet`,
          "ua": `Партер`
        },
        prices: {
          min: ``,
          max: ``
        }
      },
      {
        checked: true,
        sectionId: `2`,
        sections: [2, 3, 4],
        sectionName: {
          "ru": `Балкон I-го яруса`,
          "en": `Balcony I-tier`,
          "ua": `Балкон I-го ярусу`
        },
        prices: {
          min: ``,
          max: ``
        }
      },
      {
        checked: true,
        sectionId: `3`,
        sections: [5, 6, 7],
        sectionName: {
          "ru": `Балкон II-го яруса`,
          "en": `Balcony II tier`,
          "ua": `Балкон II-го ярусу`
        },
        prices: {
          min: ``,
          max: ``
        }
      }
    ],
    tickets: []
  },
  getters: {
    perfomanceLegend(state) {
      return state.perfomanceLegend
    },
    perfomanceFilterPrices(state) {
      return state.perfomanceFilterPrices
    },
    tickets(state) {
      return state.tickets
    },
    sectorList(state) {
      return state.sectorList
    }
  },
  mutations: {
    perfomanceFilterPrices(state, payload) {
      state.perfomanceFilterPrices = [payload.min, payload.max]
    },
    addTicketsToCart(state, payload) {
      state.tickets.unshift(payload);
    },
    removeTickets(state, tickets) {
      tickets.forEach(ticket => {
        const number = state.tickets.findIndex(item => item.id === ticket.id);

        if (number != -1) state.tickets.splice(number, 1);
      });
    },
    setSectorPrices(state, payload) {
      for (var key in payload) {
        const filteredArr = payload[key].sort((a, b) => a > b ? 1 : -1),
              sectorItem = state.sectorList.find(item => item.sectionId == key);

        sectorItem.prices.min = filteredArr[0];
        sectorItem.prices.max = filteredArr[filteredArr.length - 1];
      }
    },
    sectorListChange(state, payload) {
      state.sectorList.find(item => item.sectionId === payload.sectionId).checked = !payload.checked;
    }
  },
  actions: {
    async checkTicketsAvailable({commit, getters}, payload) {
      try {
        const tickets = await fetch(`/api/v1/tickets/reservation?lang=${getters.documentLang}`, {
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
    async checkTicketsAvailableProstoNebo({commit, getters}, payload) {
      try {
        const tickets = await fetch(`/api/v1/tickets/reservation/${payload.meta}?lang=${getters.documentLang}`, {
          method: `POST`,
          body: JSON.stringify(payload.payload),
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
    }
  }
}
