<template>
  <table class="table table-bordered booking__table">
    <thead>
      <tr>
        <th class="booking__table-number">№</th>
        <th class="booking__table-fullname">Прiзвище та Iм'я</th>
        <th class="booking__table-phone">№ телефону</th>
        <th class="booking__table-event">Виступ</th>
        <th class="booking__table-date">Дата</th>
        <th class="booking__table-sector">Сектор</th>
        <th class="booking__table-row">Ряд</th>
        <th class="booking__table-place">Мiсце</th>
        <th class="booking__table-price">Цiна</th>
        <th class="booking__table-action">Дiя</th>
      </tr>
    </thead>
    <tbody>
      <BookingTableItem
        v-for="order in searchResult"
        :key="order.id"
        :order="order"
      ></BookingTableItem>
    </tbody>
  </table>
</template>

<script>
  import BookingTableItem from "./BookingTableItem"

  export default {
    components: {
      BookingTableItem
    },
    computed: {
      searchResult() {
        return this.$store.getters.getSearchResult
      }
    }
  }
</script>
