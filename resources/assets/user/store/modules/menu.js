export default {
  state: {
    menu: [],
    openMenu: false
  },
  getters: {
    menu(state) {
      return state.menu
    },
    menuOpen(state) {
      return state.openMenu
    }
  },
  mutations: {
    setMenu(state, payload) {
      state.menu = payload
    },
    triggerMenu(state) {
      state.openMenu = !state.openMenu;
    }
  },
  actions: {
    async getMenu({commit, getters}) {
      try {
        const menu = await fetch(`/api/v1/menu?lang=${getters.documentLang}`, {
          method: `GET`,
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`
          }
        })
        .then(response => response.json())
        .catch(error => console.log(error))

        if (menu.data) {
          commit(`setMenu`, menu.data);

          return menu.data
        } else {
          throw menu;
        }
      } catch(error) {
        throw error
      }
    }
  }
}
