<template>
  <div v-if="loading">
    Loading
  </div>
  <div class="wrap" v-else>
    <cross-back></cross-back>
    <div class="wrap-user">
      <h1 class="title-main">{{ translation.ordersHistory[documentLang] }}</h1>

      <div class="text text--margin-small">
        <p v-for="translationText in translation.ordersHistoryText">{{ translationText[documentLang] }}</p>
      </div>

      <orders-list
        v-if="ordersIs"
        :orders="orders"
      ></orders-list>

      <div
        v-else
        class="text text--margin-small"
      >
        <p>{{ translation.notActiveOrders[documentLang] }}</p>
      </div>

      <router-link
        :to="{name: 'Archive'}"
        class="btn btn--full btn--orders"
      >{{ translation.archive[documentLang] }}</router-link>
    </div>
  </div>
</template>

<script>
  import translation from "../../mixins/translation"
  import OrdersList from './OrdersList'
  import CrossBack from "../CrossBack/CrossBack"

  export default {
    components: {
      OrdersList,
      CrossBack
    },
    mixins: [translation],
    created() {
      if (!this.ordersIs) {
        this.$store.dispatch(`getOrders`, `active`);
      }
    },
    computed: {
      loading() {
        return this.$store.getters.loading
      },
      ordersIs() {
        return this.orders.length
      },
      orders() {
        return this.$store.getters.formatActiveOrders
      }
    }
  }
</script>
