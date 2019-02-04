<template>
  <tr>
    <td v-if="index == 0" :rowspan="rowSpan" class="booking__table-number">{{ order.id }}</td>
    <td v-if="index == 0" :rowspan="rowSpan" class="booking__table-fullname">{{ order.name }}</td>
    <td v-if="index == 0" :rowspan="rowSpan" class="booking__table-phone">{{ order.phone }}</td>
    <td v-if="index == 0" :rowspan="rowSpan" class="booking__table-event">{{ eventName }}</td>
    <td v-if="index == 0" :rowspan="rowSpan" class="booking__table-date">
      <div>{{ getDate }} {{ getYear }}</div>
      <div>{{ getHours | addZero }}:{{ getMinutes | addZero }}</div>
    </td>
    <td class="booking__table-sector">{{ ticket.seatPrice.data.section_title }}</td>
    <td class="booking__table-row">{{ ticket.seatPrice.data.row_number }}</td>
    <td class="booking__table-place">{{ ticket.seatPrice.data.seat_number }}</td>
    <td class="booking__table-price">{{ ticket.seatPrice.data.price }}</td>
    <td class="booking__table-action">
      <ButtonLoader
        class="btn btn-warning btn-sm btn-block"
        :load="globalProcessing || localProcessing"
        @click="removeTicketPopup = true"
      >Зняти бронь</ButtonLoader>

      <Popup
        class="popup"
        v-if="removeTicketPopup"
        @popup-close="removeTicketPopup = false"
      >
        <section class="confirm-remove-tickets">
          <h2 class="confirm-remove-tickets__title">
            Ви впевненi, що бажаєте зняти бронь з квитка?
          </h2>
          <p class="confirm-remove-tickets__performance">
            {{ eventName }}
          </p>
          <p class="confirm-remove-tickets__date">
            {{ getDate }} {{ getYear }} | {{ getHours | addZero }}:{{ getMinutes | addZero }}
          </p>
          <div class="confirm-remove-tickets__seat">
            <p>
              <span class="confirm-remove-tickets__seat-name">Сектор:</span>
              <span class="confirm-remove-tickets__seat-value">{{ ticket.seatPrice.data.section_title }}</span>
            </p>
            <p>
              <span class="confirm-remove-tickets__seat-name">Ряд:</span>
              <span class="confirm-remove-tickets__seat-value">{{ ticket.seatPrice.data.row_number }}</span>
            </p>
            <p>
              <span class="confirm-remove-tickets__seat-name">Мiсце:</span>
              <span class="confirm-remove-tickets__seat-value">{{ ticket.seatPrice.data.seat_number }}</span>
            </p>
            <p>
              <span class="confirm-remove-tickets__seat-name">Цiна:</span>
              <span class="confirm-remove-tickets__seat-value">{{ ticket.seatPrice.data.price }} грн.</span>
            </p>
          </div>

          <ButtonLoader
            class="btn btn-block btn-danger"
            :load="globalProcessing || localProcessing"
            @click="removeOneTicketFromBooking"
          >
            Зняти бронь
          </ButtonLoader>
        </section>
      </Popup>
    </td>
  </tr>
</template>

<script>
  import ButtonLoader from "../Common/ButtonLoader/ButtonLoader"
  import dateFormat from "../../mixins/date-format"
  import Popup from "../Common/Popup/Popup"

  export default {
    mixins: [dateFormat],
    props: {
      ticket: {
        required: true,
        type: Object
      },
      globalProcessing: {
        default: false
      },
      order: {
        required: true,
        type: Object
      },
      index: {
        required: true,
        type: Number
      }
    },
    components: {
      ButtonLoader,
      Popup
    },
    data() {
      return {
        localProcessing: false,
        removeTicketPopup: false
      }
    },
    computed: {
      tickets() {
        return this.order.tickets.data
      },
      ticketsLength() {
        return this.tickets.length
      },
      rowSpan() {
        return this.ticketsLength > 1 ? this.ticketsLength : false
      },
      eventName() {
        return this.tickets[0].performanceCalendar.data.performance.data.title
      },
      eventDate() {
        return this.tickets[0].performanceCalendar.data.date
      }
    },
    methods: {
      removeOneTicketFromBooking() {
        this.localProcessing = true;

        if (this.order.tickets.data.length > 1) {
          this.$store.dispatch(`removeOneTicketFromBooking`, {
            orderId: this.order.id,
            ticketId: this.ticket.id,
            arrName: `searchResult`
          })
            .catch(err => {
              console.log(err)
            });
        } else {

          this.$store.dispatch(`removeAllBookingTickets`, this.order.id)
            .catch(err => {
              console.log(`Not delete`)
            });
        }

        this.localProcessing = false;
      }
    },
    watch: {
      localProcessing(val) {
        this.$emit(`removeTicket`, val);
      }
    }
  }
</script>
