<template>
  <span class="date-change__popup-item-text">{{ getDate }} | {{ getHours | addZero }}:{{ getMinutes | addZero }}</span>
</template>

<script>
  import dateFormat from "../../../mixins/date-format"

  export default {
    props: {
      date: {
        type: String
      }
    },
    mixins: [dateFormat],
    computed: {
      dateForFormat() {
        return this.date
      }
    }
  }
</script>
