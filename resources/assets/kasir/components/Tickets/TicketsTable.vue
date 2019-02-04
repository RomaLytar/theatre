<template>
  <table class="table table-bordered booking__table">
    <thead>
      <tr>
        <th class="booking__table-order">№ замовл.</th>
        <th class="booking__table-event">Виступ</th>
        <th class="booking__table-date">Дата</th>
        <th class="booking__table-cash">Вид оплати</th>
        <th class="booking__table-sector">Сектор</th>
        <th class="booking__table-row">Ряд</th>
        <th class="booking__table-place">Мiсце</th>
        <th class="booking__table-price">Цiна</th>
        <th class="booking__table-action">Дiя</th>
      </tr>
    </thead>
    <tbody>
      <TicketsTableItem
        v-for="order in getSoldTickets"
        :key="order.id"
        :order="order"
      ></TicketsTableItem>
    </tbody>
  </table>
</template>

<script>
  import TicketsTableItem from "./TicketsTableItem"

  export default {
    components: {
      TicketsTableItem
    },
    computed: {
      getSoldTickets() {
        if (this.filterSoldType == `all`) {
          return this.$store.getters.getSoldTickets
        } else if (this.filterSoldType == `cash`) {
          return this.$store.getters.getSoldTickets.filter(item => item.payment_type == 0)
        } else {
          return this.$store.getters.getSoldTickets.filter(item => item.payment_type == 1)
        }
      },
      filterSoldType() {
        return this.$store.getters.getSoldTicketsFilterType
      }
    }
  }
</script>
