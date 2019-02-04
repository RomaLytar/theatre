<template>
  <ul class="scheme-tickets__list">
    <li
      class="scheme-tickets__item"
      v-for="ticket in tickets"
    >
      <div class="scheme-tickets__place">
        <p class="scheme-tickets__section">{{ ticket.sectionName }}</p>
        <p class="scheme-tickets__row">{{ translation.row[documentLang] }}: {{ ticket.row }}</p>
        <p class="scheme-tickets__seat">{{ translation.seat[documentLang] }}: {{ ticket.seat }}</p>
      </div>
      <p class="scheme-tickets__price">{{ ticket.price }} {{ translation.currency[documentLang] }}</p>
      <Cross
        class="scheme-tickets__item-remove"
        :width="12"
        :height="12"
        @click="ticketRemove(ticket)"
      >
        <span class="visually-hidden">{{ translation.remove[documentLang] }}</span>
      </Cross>
    </li>
  </ul>
</template>

<script>
  import Cross from "../Cross/Cross"

  export default {
    components: {
      Cross
    },
    data(){
      return {
        translation: {
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
          currency: {
            ru: `грн.`,
            en: `uah`,
            ua: `грн.`
          },
          remove: {
            ru: `Удалить`,
            en: `Remove`,
            ua: `Видалити`
          }
        }
      }
    },
    computed: {
      tickets() {
        return this.$store.getters.tickets
      },
      documentLang() {
        return this.$store.getters.documentLang
      }
    },
    methods: {
      ticketRemove(ticket) {
        this.$store.commit(`removeTickets`, [ticket]);
      }
    }
  }
</script>
