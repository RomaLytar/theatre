<template>
  <section class="scheme-tickets">
    <template v-if="ticketsLength">
      <SchemeTicketsPhoto
        :src="ticketPreview"
        :href="ticketPoster"
      ></SchemeTicketsPhoto>

      <h2 class="scheme-tickets__title">{{ translation.viewOnScene[documentLang] }}</h2>

      <SchemeTicketsList></SchemeTicketsList>

      <p class="scheme-tickets__total">
        <span class="scheme-tickets__total-name">{{ translation.total[documentLang] }}</span>
        <span class="scheme-tickets__total-price">{{ ticketsTotalPrice }} {{ translation.currency[documentLang] }}</span>
      </p>
      <ButtonLoader
        class="btn btn--red btn--width"
        :load="check"
        @click="$emit('check-tickets-available')"
      >{{ translation.addToCart[documentLang] }}</ButtonLoader>
    </template>
    <template v-else>
      <p class="scheme-tickets__empty">{{ translation.makeChoise[documentLang] }}</p>
    </template>
  </section>
</template>

<script>
  import SchemeTicketsPhoto from "./SchemeTicketsPhoto"
  import SchemeTicketsList from "./SchemeTicketsList"
  import ButtonLoader from "../ButtonLoader/ButtonLoader"

  export default {
    props: {
      check: {
        type: Boolean,
        default: false
      }
    },
    components: {
      SchemeTicketsPhoto,
      SchemeTicketsList,
      ButtonLoader
    },
    data(){
      return {
        translation: {
          viewOnScene: {
            ru: `Вид на сцену`,
            en: `View of the stage`,
            ua: `Вид на сцену`
          },
          total: {
            ru: `Всего`,
            en: `Total`,
            ua: `Всього`
          },
          currency: {
            ru: `грн.`,
            en: `uah.`,
            ua: `грн.`
          },
          addToCart: {
            ru: `Добавить в корзину`,
            en: `Add to cart`,
            ua: `Додати в кошик`
          },
          makeChoise: {
            ru: `Сделайте выбор`,
            en: `Make a choice`,
            ua: `Зробіть вибір`
          }
        }
      }
    },
    computed: {
      tickets() {
        return this.$store.getters.tickets
      },
      ticketsLength() {
        return this.tickets.length > 0
      },
      lastTicket() {
        return this.tickets[this.tickets.length - 1]
      },
      ticketPoster() {
        return this.lastTicket.seat_poster
      },
      ticketPreview() {
        return this.lastTicket.seat_preview
      },
      ticketsTotalPrice() {
        return this.tickets.reduce((sum, ticket) => sum + parseInt(ticket.price), 0)
      },
      documentLang() {
        return this.$store.getters.documentLang
      }
    }
  }
</script>
