<template>
  <div class="hall-seats">
    <p>Всего:
      <span>{{ count }}</span>
    </p>
    <p>Бронь:
      <span style="color: blue;">{{ booked }}</span>
    </p>
    <p>Продано:
      <span style="color: red;">{{ sold }}</span>
    </p>
    <p>Свободно:
      <span style="color: green;">{{ available }}</span>
    </p>
  </div>
</template>

<script>
  export default {
    props: {
      event: {
        type: Object,
        required: true
      }
    },
    computed: {
      available() {
        return this.event.seats_available
      },
      booked() {
        return this.event.seats_booked
      },
      count() {
        return this.event.seats_count
      },
      sold() {
        return this.event.seats_sold
      }
    }
  }
</script>
