<template>
  <div class="hall-price">
    <ul class="hall-price__list" v-if="hallPriceLength">
      <HallPriceItem
        v-for="price in hallPrice"
        :key="price.color"
        :price="price"
      ></HallPriceItem>
    </ul>
  </div>
</template>

<script>
  import HallPriceItem from "./HallPriceItem"

  export default {
    props: {
      event: {
        type: Object,
        required: true
      }
    },
    components: {
      HallPriceItem
    },
    computed: {
      hallPrice() {
        return this.event.priceZones
      },
      hallPriceLength() {
        return Object.keys(this.hallPrice).length
      }
    }
  }
</script>
