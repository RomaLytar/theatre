<template>
  <div class="print__ticket" :style="ticketSize">
    <PrintEl
      v-for="el in jsonEl"
      :customEl="el"
      :key="el.id"
      :ticketInfo="ticketsInfo"
      :ticket="ticket"
    ></PrintEl>
  </div>
</template>

<script>
  import PrintEl from "./PrintEl"

  export default {
    props: {
      ticketsInfo: {
        required: true,
        type: Object
      },
      ticket: {
        required: true,
        type: Object
      }
    },
    components: {
      PrintEl
    },
    computed: {
      ticketTemplate() {
        return this.$store.getters.getTicketTemplate
      },
      ticketSize() {
        if (this.ticketTemplate.width) {
          return {
            width: `${this.ticketTemplate.width * 1.25}mm`,
            height: `${this.ticketTemplate.height * 1.25}mm`
          }
        }
      },
      jsonEl() {
        if (this.ticketTemplate.width) {
          const elArr = JSON.parse(this.ticketTemplate.json_code);

          return elArr
        }
      }
    }
  }
</script>
