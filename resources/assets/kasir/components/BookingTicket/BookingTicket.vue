<template>
  <section class="booking-ticket">
    <h2 class="booking-ticket__title">
      Бронювання
      <button
        type="button"
        class="btn btn-primary booking-ticket__vip"
      >VIP</button>
    </h2>
    <form action="" method="POST" class="booking-ticket__form">
      <label class="booking-ticket__label">
        <span class="booking-ticket__form-text">Ім'я</span>
        <input
          type="text"
          class="form-control form-control-sm"
          required
          name="name"
          v-model="name"
          placeholder="Ім'я"
        >
      </label>
      <label class="booking-ticket__label">
        <span class="booking-ticket__form-text">Прізвище</span>
        <input
          type="text"
          class="form-control form-control-sm"
          required
          name="surname"
          v-model="surname"
          placeholder="Прізвище"
        >
      </label>
      <label class="booking-ticket__label">
        <span class="booking-ticket__form-text">№ тел.</span>
        <MaskedInput
          class="form-control form-control-sm"
          type="tel"
          name="phone"
          required
          placeholder="+38 (XXX) XXX-XX-XX"
          mask="\+\38 (111) 111-11-11"
          autocomplete="nope"
          @input="phone = arguments[1]"
        ></MaskedInput>
      </label>
    </form>
    <p class="booking-ticket__order" v-if="showOrderId">Номер броні: <b>{{ orderId }}</b></p>
    <button
      v-else
      class="btn btn-success btn-block"
      :disabled="!validForm"
      @click="bookingTickets"
    >Бронировать</button>
  </section>
</template>

<script>
  import MaskedInput from "vue-masked-input"

  export default {
    components: {
      MaskedInput
    },
    data() {
      return {
        name: ``,
        surname: ``,
        phone: ``,
        orderId: ``,
        showOrderId: false
      }
    },
    computed: {
      cart() {
        return this.$store.getters.getCart
      },
      validForm() {
        return this.name.length > 2 && this.surname.length > 2 && this.phone.length > 5
      }
    },
    methods: {
      bookingTickets() {
        const payload = {
          status: `booked`,
          name: `${this.name} ${this.surname}`,
          phone: parseInt(`38${this.phone}`),
          seller_id: parseInt(document.querySelector(`#cash-box-id`).value),
          tickets: this.cart.map(ticket => parseInt(ticket.id))
        };

        this.$store.dispatch(`bookingTickets`, payload)
          .then(data => {
            this.orderId = data.order.data.id;
            this.showOrderId = true;
            this.$emit(`refreshData`);
          })
          .catch(err => console.log(err))
      }
    }
  }
</script>
