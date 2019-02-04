export default {
  state: {
    hall: {}
  },
  getters: {
    getHallInfo(state) {
      return state.hall
    }
  },
  mutations: {
    setHallInfo(state, payload) {
      state.hall = payload;
    }
  },
  actions: {
    async getHallData({commit}, payload) {
      try {
        const hallInfo = await fetch(`/api/v1/events/${payload}/tickets?online=false&lang=ua`, {
          method: `GET`,
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`
          }
        })
        .then(response => response.json())
        .then(data => {
          commit(`setHallInfo`, data.data);
          return data;
        })
        .catch(error => console.log(error))

        if (!hallInfo.data) {
          throw hallInfo
        } else {
          return hallInfo.data
        }
      } catch(error) {
        throw error
      }
    }
  }
}
