<template>
  <div class="tickets-list">
    <h2 class="tickets-list__title">
      Шаблони квитків
      <router-link
        :to="{name: 'CreateTicket'}"
        class="btn btn-success tickets-list__btn"
      >Створити новий шаблон</router-link>
    </h2>
    <template v-if="ticketsLoad">
      <Preloader :inline="true"></Preloader>
    </template>
    <div v-else>
      <p class="tickets-list__empty" v-if="!ticketsList.length">Немає шаблонів квитків</p>
      <table class="table table-hover table-bordered tickets-list__table" v-else>
        <thead>
          <tr>
            <th class="tickets-list__table-id">ID</th>
            <th class="tickets-list__table-name">Назва</th>
            <th class="tickets-list__table-width">Ширина</th>
            <th class="tickets-list__table-height">Висота</th>
            <th class="tickets-list__table-bg">Фон</th>
            <th class="tickets-list__table-use">Використовується</th>
            <th class="tickets-list__table-action">Дія</th>
          </tr>
        </thead>
        <tbody>
          <TicketListItem
            v-for="ticket in ticketsList"
            :key="ticket.id"
            :ticket="ticket"
          ></TicketListItem>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
  import Preloader from "../../../kasir/components/Common/Preloader/Preloader"
  import TicketListItem from "./TicketsListItem"

  export default {
    components: {
      Preloader,
      TicketListItem
    },
    created() {
      this.ticketsLoad = true;

      this.$store.dispatch(`getTicketsList`)
        .then(data => this.ticketsLoad = false)
        .catch(err => {
          console.warn(err);
          this.ticketsLoad = false;
        })
    },
    data() {
      return {
        ticketsLoad: false
      }
    },
    computed: {
      ticketsList() {
        return this.$store.getters.ticketsList
      }
    }
  }
</script>
