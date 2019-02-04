<template>
  <li>
    <div class="cart-perfomance__info" :style="performancePoster">
      <div class="cart-perfomance__info-left">
        <h3 class="cart-perfomance__item-name">{{ performanceName }}</h3>
        <p class="cart-perfomance__item-hall">{{ performanceHall }}</p>
        <p class="cart-perfomance__datetime">
          <span class="cart-perfomance__day">{{ getWeekday }}</span>
          <span class="cart-perfomance__date">{{ getDate }}</span>
          <span class="cart-perfomance__time">{{ getHours | addZero }}:{{ getMinutes | addZero }}</span>
        </p>
      </div>
      <div class="cart-perfomance__info-right">
        <button
          class="cart-perfomance__remove"
          @click="removePerformance()"
        >{{ translation.remove[documentLang] }}</button>
      </div>
    </div>
    <ul class="cart-perfomance__tickets">
      <li
        v-for="ticket in performanceTickets"
        :key="ticket.id"
      >
        <div class="cart-perfomance__ticket-info">
          <p>{{ getSectionName(ticket.seatPrice.data.section_number) }}</p>
          <p v-if="ticket.seatPrice.data.row_number">
            {{ translation.row[documentLang] }}
            {{ ticket.seatPrice.data.row_number }}
            {{ translation.seat[documentLang] }}
            {{ ticket.seatPrice.data.seat_number }}</p>
          <p v-else>
            {{ translation.ticket[documentLang] }}
            {{ ticket.seatPrice.data.seat_number }}
          </p>
        </div>
        <p class="cart-perfomance__currency">{{ ticket.seatPrice.data.price }}</p>
        <Cross
          class="cart-perfomance__ticket-remove"
          @click="removeTicket(ticket.id)"
        >
          <span class="visually-hidden">{{ translation.deleteTicket[documentLang] }}</span>
        </Cross>
      </li>
    </ul>
  </li>
</template>

<script>
  import dateFormat from "../../mixins/date-format"
  import Cross from "../Common/Cross/Cross"

  export default {
    components: {
      Cross
    },
    mixins: [dateFormat],
    props: {
      performance: {
        type: Object,
        required: true
      },
      above: {
        type: Boolean,
        default: false
      }
    },
    data() {
      return {
        translation: {
          remove: {
            ru: `Удалить`,
            en: `Remove`,
            ua: `Видалити`
          },
          row: {
            ru: `Ряд`,
            en: `Row`,
            ua: `Ряд`
          },
          seat: {
            ru: `Место`,
            en: `Seat`,
            ua: `Місце`
          },
          ticket: {
            ru: `Билет`,
            en: `Ticket`,
            ua: `Квиток`
          },
          deleteTicket: {
            ru: `Удалить билет`,
            en: `Remove ticket`,
            ua: `Видалити квиток`
          },
          parter: {
            ru: `Партер`,
            en: `Parquet`,
            ua: `Партер`
          },
          balconyLeft: {
            ru: `Балкон левая сторона`,
            en: `Balcony left side`,
            ua: `Балкон ліва сторона`
          },
          balconyRight: {
            ru: `Балкон правая сторона`,
            en: `Balcony right side`,
            ua: `Балкон права сторона`
          },
          balcony1: {
            ru: `Балкон I-го яруса`,
            en: `Balcony I-tier`,
            ua: `Балкон I-го ярусу`
          },
          balcony2: {
            ru: `Балкон II-го яруса`,
            en: `Balcony II tier`,
            ua: `Балкон II-го ярусу`
          }
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
      performanceHall() {
        return this.performance.data.hall.data.title
      },
      performanceHallType() {
        return this.performance.data.hall.data.name
      },
      performanceTickets() {
        return this.performance.data.tickets.data
      },
      performancePoster() {
        return {
          'background-image': `url(${this.performance.data.performance.data.poster})`
        }
      }
    },
    methods: {
      getSectionName(sectionNumber) {
        const sectNum = parseInt(sectionNumber);

        switch(this.performanceHallType) {
          case "small":
            switch(sectNum) {
              case 1:
                return this.translation.parter[this.documentLang]
                break;

              case 2:
                return this.translation.balconyLeft[this.documentLang]
                break;

              case 3:
                return this.translation.balconyRight[this.documentLang]
                break;
            }
            break;

          case "big":
            switch(sectNum) {
              case 1:
                return this.translation.parter[this.documentLang]
                break;

              case 2:
              case 3:
              case 4:
                return this.translation.balcony1[this.documentLang]
                break;

              case 5:
              case 6:
              case 7:
                return this.translation.balcony2[this.documentLang]
                break;
            }
            break;

          case "muzsalon":
            return this.translation.parter[this.documentLang]
            break;

          case "outdoor":
            return ``
            break;
        }
      },
      removePerformance() {
        const ticketsIdList = this.performance.data.tickets.data.map(ticket => ticket.id);

        if (this.above) {
          this.$store.commit(`removeTicketsAboveFromCart`, {
            perfomanceId: this.performance.data.id,
            tickets: ticketsIdList
          });
        } else {
          this.$store.dispatch(`removeTicketsFromCart`, {
            perfomanceId: this.performance.data.id,
            tickets: ticketsIdList
          });
        }
      },
      removeTicket(ticketId) {
        if (this.above) {
          this.$store.commit(`removeTicketsAboveFromCart`, {
            perfomanceId: this.performance.data.id,
            tickets: [ticketId]
          });
        } else {
          this.$store.dispatch(`removeTicketsFromCart`, {
            perfomanceId: this.performance.data.id,
            tickets: [ticketId]
          });
        }
      }
    }
  }
</script>
