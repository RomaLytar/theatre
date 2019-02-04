<template>
  <div class="cart">
    <h2 class="cart__title">
      Квитки
      <Cross
        v-if="cart.length"
        width="16"
        height="16"
        fill="red"
        @click="removeAllTicket"
      ></Cross>
    </h2>
    <table class="cart__table">
      <thead>
        <tr>
          <th class="cart__table-section">Сектор</th>
          <th class="cart__table-row">Ряд</th>
          <th class="cart__table-seat">Місце</th>
          <th colspan="2" class="cart__table-two">Ціна</th>
        </tr>
      </thead>
      <template v-if="cart.length">
        <tbody>
          <tr
            v-for="ticket in cart"
            :key="ticket.id"
          >
            <td class="cart__table-section">{{ ticket.sectionName }}</td>
            <td class="cart__table-row">{{ ticket.row }}</td>
            <td class="cart__table-seat">{{ ticket.seat }}</td>
            <td class="cart__table-price">{{ ticket.price }}</td>
            <td class="cart__table-remove">
              <Cross
                width="16"
                height="16"
                fill="red"
                @click="removeTicket(ticket.id)"
              ></Cross>
            </td>
          </tr>
          <tr>
            <td class="cart__table-total-text">Загалом:</td>
            <td colspan="4" class="cart__table-total">{{ totalPrice }}</td>
          </tr>
        </tbody>
      </template>
    </table>
    <div class="cart__btns" v-if="cart.length">
      <button
        type="button"
        class="btn btn-success"
        @click="payment"
      >Оплата</button>
      <button
        type="button"
        class="btn btn-primary"
        @click="booking"
      >Бронь</button>
    </div>
    <Popup
      v-if="paymentOpen"
      @popup-close="paymentOpen = false"
    >
      <Payment
        @close="paymentOpen = false"
        @refreshData="$emit(`refreshData`)"
      ></Payment>
    </Popup>
    <Popup
      v-if="bookingOpen"
      @popup-close="bookingOpen = false"
    >
      <BookingTicket
        @close="bookingOpen = false"
        @refreshData="$emit(`refreshData`)"
      ></BookingTicket>
    </Popup>
  </div>
</template>

<script>
  import Cross from "../Common/Cross/Cross"
  import Popup from "../Common/Popup/Popup"
  import Payment from "../Payment/Payment"
  import BookingTicket from "../BookingTicket/BookingTicket"

  export default {
    components: {
      Cross,
      Popup,
      Payment,
      BookingTicket
    },
    data() {
      return {
        paymentOpen: false,
        bookingOpen: false
      }
    },
    computed: {
      cart() {
        return this.$store.getters.getCart
      },
      totalPrice() {
        return this.cart.reduce((sum, item) => {
          return sum + parseInt(item.price);
        }, 0)
      }
    },
    methods: {
      removeTicket(id) {
        this.$store.dispatch(`removeTicketFromCart`, [id]);
      },
      removeAllTicket() {
        this.$store.dispatch(`removeTicketFromCart`, this.cart.map(ticket => ticket.id));
      },
      payment() {
        this.paymentOpen = true;
      },
      booking() {
        this.bookingOpen = true;
      }
    }
  }
</script>
