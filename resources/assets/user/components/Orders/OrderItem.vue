<template>
  <li class="orders__item">
    <h2 class="orders__title">{{order.event_title}}</h2>
    <p class="orders__hall">{{order.hall_title}}</p>
    <p class="orders__descr">
      <span class="orders__date">{{ order.event_date }}</span>
      <span class="orders__time">{{ order.event_time}}</span>
    </p>
    <ul class="orders__tiskets">
      <order-ticket
        v-for="ticket in order.tickets"
        :key="ticket.ticket_id"
        :ticket="ticket"
      ></order-ticket>
    </ul>
  </li>
</template>

<script>
  import OrderTicket from './OrderTicket'

  export default {
    components: {
      OrderTicket
    },
    props: [`order`]
  }
</script>
