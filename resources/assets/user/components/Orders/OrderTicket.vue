<template>
  <li>
    <a :href="ticketUrl" class="orders__tiskets-link">
      <p class="orders__tiskets-sector">{{ ticket.section_title }}</p>
      <p>
        <span v-if="ticket.row_number">{{ translation.row[documentLang] }} {{ ticket.row_number }}</span>
        <span v-if="ticket.row_number">{{ translation.seat[documentLang] }} {{ ticket.seat_number }}</span>
        <span v-else>{{ translation.ticket[documentLang] }}</span> {{ ticket.place }}
      </p>
    </a>
    <a :href="ticketUrl" class="orders__tiskets-pdf">
      <span class="visually-hidden">{{ translation.download[documentLang] }} pdf</span>
      <svg width="26" height="26" fill="#333333">
        <use xlink:href="#icon-pdf" />
      </svg>
    </a>
  </li>
</template>

<script>
  import translation from "../../mixins/translation"

  export default {
    mixins: [translation],
    props: {
      ticket: {
        required: true,
        type: Object
      }
    },
    computed: {
      ticketUrl() {
        return `/ticket-download/${this.ticket.orderHash}?ticket=${this.ticket.ticket_id}`
      }
    }
  }
</script>
