export default {
  state: {
    token: null,
    user: {}
  },
  getters: {
    token(state) {
      return state.token
    },
    user(state) {
      return state.user
    }
  },
  mutations: {
    token(state, payload) {
      state.token = payload;
      localStorage.setItem(`token`, payload);
    },
    setUserByToken(state, payload) {
      state.user = payload;
    },
    setUserByEmailOrReg(state, payload) {
      state.user = payload;
    }
  },
  actions: {
    async registrationUser({commit, getters}, payload) {
      commit(`setLoading`, true);

      try {
        const user = await fetch(`/api/register?lang=${getters.documentLang}`, {
          method: `POST`,
          body: JSON.stringify(payload),
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`
          },
        })
        .then(response => response.json())
        .catch(error => {
          console.log(error);
        })

        commit(`setLoading`, false);

        if (!user.data) throw user;
      } catch(error) {
        throw error
      }
    },
    async getToken({commit, getters}, payload) {
      commit(`setLoading`, true);

      try {
        const token = await fetch(`/api/login?lang=${getters.documentLang}`, {
          method: `POST`,
          body: JSON.stringify(payload),
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`
          },
        })
        .then(response => response.json())
        .catch(error => {
          console.log(error);
        })

        commit(`setLoading`, false);

        if (token.meta) {
          commit(`token`, token.meta.token);
        } else {
          throw new Error(token.errors.root);
        }
      } catch(error) {
        throw error
      }
    },
    async getUserByToken({commit, getters}, payload) {
      const userToken = payload || localStorage.getItem(`token`);
      commit(`setLoading`, true);

      if (!userToken) return false;

      try {
        const user = await fetch(`/api/profile?lang=${getters.documentLang}`, {
          method: `GET`,
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`,
            "Authorization": `Bearer ${userToken}`
          },
        })
        .then(response => response.json())
        .catch(error => console.log(error))

        commit(`setLoading`, false);

        if (user.data) {
          commit(`setUserByToken`, user.data);
          commit(`token`, userToken)
        } else {
          throw new Error(user.error);
        }
      } catch(error) {
        throw error
      }
    }
  }
}
