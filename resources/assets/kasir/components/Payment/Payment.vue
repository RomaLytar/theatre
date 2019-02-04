<template>
  <section class="payment">
    <h2 class="payment__title">Продаж квитків</h2>
    <template v-if="!ticketsPrintSrc">
      <p class="payment__banking">
        <span class="payment__text">До сплати:</span>
        <span class="payment__cost">{{ totalPrice }}</span>
        грн.
      </p>
      <form
        method="POST"
        class="payment__form"
        @submit.prevent
      >
        <label class="payment__label">
          <span class="payment__form-text">Введіть суму готівкою</span>
          <input
            type="number"
            class="form-control"
            v-model.number="userPrice"
            ref="paymentInput"
          >
        </label>
      </form>
      <p class="payment__banking">
        <span class="payment__text">Решта:</span>
        <span class="payment__cost">{{ change }}</span>
        грн.
      </p>
      <div class="payment__btns">
        <button
          type="button"
          class="btn btn-success"
          @click="payment(0)"
          :disabled="!change"
        >Прийняти</button>
        <button
          type="button"
          class="btn btn-danger"
          @click="cancelPayment"
        >Скасувати</button>
      </div>
      <button
        type="button"
        class="btn btn-info btn-block"
        @click="payment(1)"
        :disabled="!change"
      >Безготівковий розрахунок</button>
    </template>
    <template v-else>
      <button
        type="button"
        class="btn btn-primary btn-block"
        @click="printTickets"
      >Друк квитків</button>
    </template>
  </section>
</template>

<script>
  export default {
    props: {
      order: {
        type: Object
      }
    },
    data() {
      return {
        userPrice: ""
      }
    },
    mounted() {
      this.$refs.paymentInput.focus();
    },
    beforeDestroy() {
      this.$store.commit(`setTicketsPrintSrc`, ``)
    },
    computed: {
      cart() {
        return this.$store.getters.getCart
      },
      totalPrice() {
        const price = this.cart.reduce((sum, item) => {
          return sum + parseInt(item.price);
        }, 0);

        this.userPrice = price;

        return price
      },
      change() {
        const change = this.userPrice - this.totalPrice;

        return change < 0 ? 0 : change == 0 ? "0" : change
      },
      ticketsPrintSrc() {
        return this.$store.getters.getTicketsPrintSrc
      }
    },
    methods: {
      payment(type) {
        if (!this.order) {
          const payload = {
                status: `sold`,
                payment_type: type,
                tickets: this.cart.map(ticket => parseInt(ticket.id)),
                seller_id: parseInt(document.querySelector(`#cash-box-id`).value)
              };

          this.$store.dispatch(`buyTickets`, payload)
            .then(data => this.$emit(`refreshData`))
            .catch(err => console.log(err))
        } else {
          const performance = this.order.tickets.data[0].performanceCalendar.data;
          this.$store.dispatch(`buyBookingTickets`, {
              orderId: this.order.id,
              hallInfo: {
                date: performance.date,
                hall: performance.hall,
                id: performance.id,
                performance: performance.performance,
                price_pattern_id: performance.price_pattern_id
              }
            })
            .then(data => this.$emit(`refreshData`))
            .catch(err => console.log(err))
        }
      },
      cancelPayment() {
        this.$emit(`close`);
      },
      printTickets() {
        this.$store.commit(`setOrderForPrint`, this.$store.getters.getLastOrder);
      }
    }
  }
</script>
