export default {
  created() {
    const domLocalStorage = window.localStorageCart,
          domSessionStorage = window.sessionStorageCart,
          cartPerfomances = domLocalStorage.perfomances,
          sessionPerfomances = domSessionStorage.perfomances;

    domLocalStorage.setVue(this);
    domSessionStorage.setVue(this);

    if (cartPerfomances) {
      if (!this.$store.getters.cartTickets.length) {
        const tickets = cartPerfomances.map(item => item.tickets.join(`,`)).join(`,`).split(`,`);
        this.$store.dispatch(`getTicketsInfo`, {tickets})
      }
    }

    if (sessionPerfomances && this.$route.name == `Cart`) {
      const tickets = sessionPerfomances.map(item => item.tickets.join(`,`)).join(`,`).split(`,`);

      this.$store.dispatch(`getTicketsInfo`, {tickets, above: true})
      this.above = true;
    } else {
      this.above = false;
    }
  },
  computed: {
    perfomanceInCart() {
      return this.$store.getters.cartTickets
    }
  },
  methods: {
    clearCart() {
      if (this.perfomanceInCart.length) {
        this.perfomanceInCart.forEach(item => this.$store.dispatch(`addTicketToAboveCart`, item))

        if (this.above != undefined) {
          this.above = true;
        }
      }
    }
  }
}
