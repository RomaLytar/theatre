<template>
  <section class="last-order">
    <h2 class="last-order__title">Останнє замовлення</h2>
    <h3 class="last-order__order">
      № {{ lastOrder.order.data.id }}
      <small v-if="isBooked">(Бронь)</small>
    </h3>
    <div class="last-order__user" v-if="isBooked">
      <p class="last-order__user-fullname">{{ lastOrder.order.data.name }}</p>
      <p class="last-order__user-phone">+ {{ lastOrder.order.data.phone }}</p>
    </div>
    <div class="last-order__perfomance">
      <h3 class="last-order__perfomance-title">{{ lastOrderPerformance.performance.data.title }}</h3>
      <p>{{ getDate }} {{ getYear }} | {{ getHours | addZero }}:{{ getMinutes | addZero }}</p>
      <p class="last-order__perfomance-hall" v-if="lastOrderPerformance.hall">{{ lastOrderPerformance.hall.data.title }}</p>
    </div>
    <table class="last-order__table">
      <thead>
        <tr>
          <th class="last-order__table-section">Сектор</th>
          <th class="last-order__table-row">Ряд</th>
          <th class="last-order__table-seat">Місце</th>
          <th class="last-order__table-price">Ціна</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="ticket in lastOrderTickets"
          :key="ticket.id"
        >
          <td class="last-order__table-section">{{ ticket.seatPrice.data.section_title }}</td>
          <td class="last-order__table-row">{{ ticket.seatPrice.data.row_number }}</td>
          <td class="last-order__table-seat">{{ ticket.seatPrice.data.seat_number }}</td>
          <td class="last-order__table-price">{{ ticket.seatPrice.data.price }}</td>
        </tr>
        <tr>
          <td class="last-order__table-total-text">Загалом:</td>
          <td colspan="3" class="last-order__table-total">{{ totalPrice }}</td>
        </tr>
      </tbody>
    </table>
    <template v-if="!isBooked">
      <p class="last-order__banking">
        <span class="last-order__text">Сплачено:</span>
        <span class="last-order__cost">{{ totalPrice }}</span>
        грн.
      </p>
      <button
        class="btn btn-primary btn-block"
        @click="printTickets"
      >Друк квитків</button>
    </template>
  </section>
</template>

<script>
  export default {
    computed: {
      lastOrder() {
        return this.$store.getters.getLastOrder
      },
      lastOrderPerformance() {
        return this.lastOrder.hallInfo
      },
      ticketsPrintSrc() {
        return this.lastOrder.order.data.hash
      },
      lastOrderTickets() {
        return this.lastOrder.order.data.tickets.data
      },
      totalPrice() {
        return this.lastOrderTickets.reduce((sum, item) => {
          return sum + item.seatPrice.data.price
        }, 0)
      },
      ticketTemplate() {
        return this.$store.getters.getTicketTemplate
      },
      isBooked() {
        return this.lastOrder.order.data.status == `booked` ? true : false
      },
      hallDate() {
        return this.lastOrderPerformance.date
      },
      getYear() {
        return new Date(this.hallDate).getFullYear();
      },
      getDate() {
        const formatter = new Intl.DateTimeFormat(`uk`, {
          month: `long`,
          day: `numeric`
        });

        return formatter.format(new Date(this.hallDate));
      },
      getHours() {
        const formatter = new Intl.DateTimeFormat(`uk`, {
          hour: `numeric`,
          hour12: false
        });

        return formatter.format(new Date(this.hallDate));
      },
      getMinutes() {
        const formatter = new Intl.DateTimeFormat(`uk`, {
          minute: `numeric`
        });

        return formatter.format(new Date(this.hallDate));
      }
    },
    methods: {
      printTickets() {
        this.$store.commit(`setOrderForPrint`, this.lastOrder);
      }
    }
  }
</script>
