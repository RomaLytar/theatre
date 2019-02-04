<template>
  <Preloader></Preloader>
</template>

<script>
  import Preloader from "../Common/Preloader/Preloader"
  import cartMixins from "../../mixins/cart-mixin"

  export default {
    components: {
      Preloader
    },
    mixins: [cartMixins],
    created() {
      const orderId = localStorage.getItem(`orderId`);

      if (!orderId || !localStorage.getItem(`cart`)) {
        this.$router.replace({ name: `Authorization`})
      }

      this.orderId = orderId;
    },
    data() {
      return {
        orderId: null
      }
    },
    watch: {
      perfomanceInCart() {
        this.$store.dispatch(`getOrder`, {order_id: this.orderId})
          .then(data => {
            const orderHash = data.order.data.hash;

            this.$store.commit(`ticketsHash`, orderHash);

            const tickets = this.$store.getters.cartTickets.map(perfomance => {
              perfomance.data.tickets.data.map(ticket => {
                ticket.pdf_link = `/ticket-download/${orderHash}?ticket=${ticket.id}`;
                return ticket;
              });

              return perfomance
            })

            this.$store.dispatch(`ticketsSuccess`, tickets);
            this.$router.push({name: `PaymentSuccess`});
          })
          .catch(err => {
            console.warn(err);
            this.$router.replace({ name: `Payment`, query: {payment: `error`}})
          })
      }
    }
  }
</script>
