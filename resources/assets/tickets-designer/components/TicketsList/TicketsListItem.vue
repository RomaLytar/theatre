<template>
  <tr>
    <td>{{ ticket.id }}</td>
    <td>{{ ticket.title }}</td>
    <td>{{ ticket.width }}mm</td>
    <td>{{ ticket.height }}mm</td>
    <td class="tickets-list__table-bg" :style="bgImage"></td>
    <td>
      <span v-if="usedCashBox">{{ usedCashBox }}</span>
      <span v-if="usedOnline">{{ usedOnline }}</span>
    </td>
    <td>
      <ButtonLoader
        class="btn btn-primary btn-block btn-sm"
        :load="deleteTicketLoad"
        @click="editTicket"
      >Редагувати</ButtonLoader>
      <ButtonLoader
        class="btn btn-danger btn-block btn-sm"
        :load="deleteTicketLoad"
        @click="deleteTicket"
      >Видалити</ButtonLoader>
    </td>
  </tr>
</template>

<script>
  import ButtonLoader from "../../../kasir/components/Common/ButtonLoader/ButtonLoader"

  export default {
    props: {
      ticket: {
        type: Object,
        required: true
      }
    },
    components: {
      ButtonLoader
    },
    data() {
      return {
        deleteTicketLoad: false
      }
    },
    computed: {
      usedCashBox() {
        if (this.ticket.is_active_cash_box) return `В касi`

        return false
      },
      usedOnline() {
        if (this.ticket.is_active_online) return `Online`

        return false
      },
      bgImage() {
        return {
          backgroundImage: `url(${this.ticket.poster})`
        }
      }
    },
    methods: {
      deleteTicket() {
        this.deleteTicketLoad = true;
        this.$store.dispatch(`deleteTicket`, this.ticket.id)
          .then(data => this.deleteTicketLoad = false)
          .catch(err => {
            console.warn(err);
            this.deleteTicketLoad = false;
          })
      },
      editTicket() {
        this.$router.push({name: `Ticket`, params: {id: this.ticket.id}})
      }
    }
  }
</script>
