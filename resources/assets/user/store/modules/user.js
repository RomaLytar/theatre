export default {
  state: {
    activateUser: null,
    token: null,
    user: null,
    countries: []
  },
  getters: {
    activateUser(state) {
      return state.activateUser
    },
    token(state) {
      return state.token
    },
    user(state) {
      return state.user
    },
    countries(state) {
      return state.countries
    }
  },
  mutations: {
    activateUser(state, payload) {
      state.activateUser = payload;
    },
    token(state, payload) {
      state.token = payload;
      localStorage.setItem(`token`, payload);
    },
    removeToken(state) {
      localStorage.removeItem(`token`);
      state.token = null;
    },
    setUserByToken(state, payload) {
      state.user = payload;
    },
    updateProfile(state, payload) {
      state.user = payload;
    },
    setCountries(state, payload) {
      state.countries = payload;
    },
    deleteUser(state) {
      state.user = null;
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
        .catch(error => console.log(error))

        commit(`setLoading`, false);

        if (!user.data) throw user;
      } catch(error) {
        throw error
      }
    },
    async activateUser({commit, getters}, payload) {
      commit(`setLoading`, true);

      try {
        const activate = await fetch(`/api/activate?lang=${getters.documentLang}`, {
          method: `POST`,
          body: JSON.stringify(payload),
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`
          },
        })
        .then(response => response.json())
        .catch(error => console.log(error))

        commit(`setLoading`, false);

        if (activate.status !== undefined) {
          commit(`activateUser`, true);
        }

        return activate
      } catch(error) {
        console.log(`Api error`, error);
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
        .catch(error => console.log(error))

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
          }
        })
        .then(response => response.json())
        .catch(error => console.log(error))

        commit(`setLoading`, false);

        if (user.data) {
          commit(`setUserByToken`, user.data);
          commit(`token`, userToken);
        } else {
          throw user;
        }
      } catch(error) {
        throw error
      }
    },
    async forgotPassword({commit, getters}, payload) {
      commit(`setLoading`, true);

      try {
        const obj = await fetch(`/api/password/create?lang=${getters.documentLang}`, {
          method: `POST`,
          body: JSON.stringify(payload),
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`
          },
        })
        .then(response => response.json())
        .catch(error => console.log(error))

        commit(`setLoading`, false);

        if (obj.status !== true) {
          throw new Error(obj.message)
        }
      } catch(error) {
        throw error
      }
    },
    async checkResetPasswordToken({commit, getters}, payload) {
      commit(`setLoading`, true);

      try {
        const obj = await fetch(`/api/password/find?lang=${getters.documentLang}`, {
          method: `POST`,
          body: JSON.stringify(payload),
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`
          },
        })
        .then(response => response.json())
        .catch(error => console.log(error))

        commit(`setLoading`, false);

        if (obj.status === true) {
          return obj.data
        } else {
          throw new Error(obj.message)
        }
      } catch(error) {
        throw error
      }
    },
    async resetPassword({commit, getters}, payload) {
      commit(`setLoading`, true);

      try {
        const obj = await fetch(`/api/password/reset?lang=${getters.documentLang}`, {
          method: `POST`,
          body: JSON.stringify(payload),
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`
          },
        })
        .then(response => response.json())
        .catch(error => console.log(error))

        commit(`setLoading`, false);

        if (obj.status !== true) {
          throw new Error(obj.message)
        }
      } catch(error) {
        throw error
      }
    },
    async updateProfile({commit, getters}, payload) {
      const userToken = payload.token;
      commit(`setLoading`, true);

      try {
        const user = await fetch(`/api/profile/update?lang=${getters.documentLang}`, {
          method: `PATCH`,
          body: JSON.stringify(payload.data),
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
          commit(`updateProfile`, user.data);
        } else {
          throw user
        }
      } catch(error) {
        throw error
      }
    },
    async logoutUser({commit, getters}) {
      commit(`setLoading`, true);

      try {
        const token = await fetch(`/api/logout?lang=${getters.documentLang}`, {
          method: `POST`,
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`,
            "Authorization": `Bearer ${getters.token}`
          }
        })
        .catch(error => console.log(error))

        commit(`setLoading`, false);

        commit(`removeToken`);
        commit(`deleteUser`);

        return token
      } catch(error) {
        throw error
      }
    },
    async getTextData({commit, getters}, payload) {
      commit(`setLoading`, true);

      try {
        const text = await fetch(payload, {
          method: `GET`,
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`
          },
        })
        .then(response => response.json())
        .catch(error => console.log(error))

        commit(`setLoading`, false);

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
      commit(`setLoading`, true);

      try {
        const countries = await fetch(`/api/v1/countries?lang=${getters.documentLang}`, {
          method: `GET`,
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`
          },
        })
        .then(response => response.json())
        .catch(error => console.log(error))

        commit(`setLoading`, false);

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
