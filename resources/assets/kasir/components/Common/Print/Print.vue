<template>
  <div class="print">
    <PrintTicket
      v-for="ticket in ticketsList"
      :key="ticket.id"
      :ticket="ticket"
      :ticketsInfo="tickets"
    ></PrintTicket>
  </div>
</template>

<script>
  import PrintTicket from "./PrintTicket"

  export default {
    props: {
      tickets: {
        required: true,
        type: Object
      }
    },
    components: {
      PrintTicket
    },
    created() {
      if (!this.ticketTemplate.width) {
        this.$store.dispatch(`getTicketTemplate`)
          .then(data => this.print())
          .catch(err => console.warn(err))
      } else {
        this.print();
      }
    },
    computed: {
      ticketsList() {
        return this.tickets.order.data.tickets.data
      },
      ticketTemplate() {
        return this.$store.getters.getTicketTemplate
      }
    },
    methods: {
      print() {
        setTimeout(() => {
          this.$store.commit(`setOrderForPrint`);

          // document.documentElement.id = `print`;
          window.print();
        }, 100)
      }
    }
  }
</script>
