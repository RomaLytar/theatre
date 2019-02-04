<template>
  <section class="cart-aside">
    <h2 class="cart-aside__title">{{ translation.cart[documentLang] }}</h2>
    <div class="cart-aside__list-wrap">
      <ul class="cart-aside__list">
        <CartAsideTicketsItem
          v-for="performance in perfomanceInCart"
          :performance="performance"
          :key="performance.data.id"
        ></CartAsideTicketsItem>
      </ul>
    </div>

    <a
      :href="downloadAllTickets"
      class="btn btn--red btn--lower"
    >{{ translation.downloadAll[documentLang] }}</a>
  </section>
</template>

<script>
  import CartAsideTicketsItem from "./CartAsideTicketsItem";

  export default {
    components: {
      CartAsideTicketsItem
    },
    data(){
      return {
        translation: {
          cart: {
            ru: `Корзина`,
            en: `Cart`,
            ua: `Кошик`
          },
          downloadAll: {
            ru: `Скачать все`,
            en: `Download all`,
            ua: `Завантажити все`
          }
        }
      }
    },
    computed: {
      perfomanceInCart() {
        return this.$store.getters.ticketsSuccess
      },
      documentLang() {
        return this.$store.getters.documentLang
      },
      downloadAllTickets() {
        return `/ticket-download/${this.$store.getters.ticketsHash}`;
      }
    }
  }
</script>
