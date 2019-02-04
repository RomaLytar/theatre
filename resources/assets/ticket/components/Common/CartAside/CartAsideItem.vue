<template>
  <li class="cart-aside__item">
    <h3 class="cart-aside__item-title">{{ performanceName }}</h3>
    <p class="cart-aside__item-datetime">{{ getWeekday }} {{ getDate }} {{ getHours | addZero }}:{{ getMinutes | addZero }}</p>
    <p class="cart-aside__item-total">
      <span>{{ translation.tickets[documentLang] }}: {{ performanceTicketsCount }}</span>
      <span>{{ performanceTotalPrice }} {{ translation.currency[documentLang] }}</span>
    </p>
  </li>
</template>

<script>
  import dateFormat from "../../../mixins/date-format"

  export default {
    props: {
      performance: {
        required: true,
        type: Object
      }
    },
    mixins: [dateFormat],
    data() {
      return {
        translation: {
          tickets: {
            ru: `Билетов`,
            en: `Tickets`,
            ua: `Квиткiв`
          },
          currency: {
            ru: `грн.`,
            en: `uah`,
            ua: `грн.`
          },
        }
      }
    },
    computed: {
      dateForFormat() {
        return this.performance.data.date
      },
      performanceName() {
        return this.performance.data.performance.data.title
      },
      performanceTotalPrice() {
        return this.performance.data.tickets.data.reduce((sum, ticket) => {
          return sum + ticket.seatPrice.data.price
        }, 0)
      },
      performanceTicketsCount() {
        return this.performance.data.tickets.data.length
      }
    }
  }
</script>
