<template>
  <div class="wrap">
    <cross-back></cross-back>
    <div class="wrap-user">
      <h1 class="title-main">{{ translation.ordersArchive[documentLang] }}</h1>

      <orders-list
        class="orders--archive"
        v-if="ordersIs"
        :orders="orders"
      ></orders-list>

      <div
        v-else
        class="text text--margin-small"
      >
        <p>{{ translation.archiveEmpty[documentLang] }}</p>
      </div>

      <router-link
        :to="{name: 'Orders'}"
        class="btn btn--full btn--orders"
      >{{ translation.toOrdersHistory[documentLang] }}</router-link>
    </div>
  </div>
</template>

<script>
  import translation from "../../mixins/translation"
  import OrdersList from '../Orders/OrdersList'
  import CrossBack from "../CrossBack/CrossBack"

  export default {
    components: {
      OrdersList,
      CrossBack
    },
    mixins: [translation],
    created() {
      if (!this.ordersIs) {
        this.$store.dispatch(`getOrders`, `overdue`);
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
        return this.$store.getters.formatArchiveOrders
      }
    }
  }
</script>
