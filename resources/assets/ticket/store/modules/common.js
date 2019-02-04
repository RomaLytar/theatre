export default {
  state: {
    loading: false,
    error: null,
    countries: []
  },
  getters: {
    loading(state) {
      return state.loading
    },
    error(state) {
      return state.error
    },
    countries(state) {
      return state.countries
    }
  },
  mutations: {
    setLoading(state, payload) {
      state.loading = payload
    },
    setError(state, payload) {
      state.error = payload
    },
    clearError(state) {
      state.error = null
    },
    setCountries(state, payload) {
      state.countries = payload;
    }
  },
  actions: {
    setLoading({commit}, payload) {
      commit(`setLoading`, payload)
    },
    setError({commit}, payload) {
      commit(`setError`, payload)
    },
    clearError({commit}) {
      commit(`clearError`)
    },
    async getTextData({commit, getters}, payload) {
      // commit(`setLoading`, true);

      try {
        const text = await fetch(`${payload}?lang=${getters.documentLang}`, {
          method: `GET`,
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`
          },
        })
        .then(response => response.json())
        .catch(error => {
          console.log(error);
        })

        // commit(`setLoading`, false);

        if (text.data) {
          return text.data
        } else {
          throw text
        }
      } catch(error) {
        throw error
      }
    },
    async getCountries({commit, getters}) {
      // commit(`setLoading`, true);

      try {
        const countries = await fetch(`/api/v1/countries?lang=${getters.documentLang}`, {
          method: `GET`,
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`
          },
        })
        .then(response => response.json())
        .catch(error => {
          console.log(error);
        })

        // commit(`setLoading`, false);

        if (countries.data) {
          commit(`setCountries`, countries.data)
          return countries.data
        } else {
          throw countries
        }
      } catch(error) {
        throw error
      }
    }
  }
}
