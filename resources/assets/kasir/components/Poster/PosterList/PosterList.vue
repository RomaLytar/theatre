<template>
  <ul class="poster-list">
    <PosterItem
      v-for="(eventDate, index) in eventsDates"
      :class="index == '0' ? 'active' : ''"
      :key="eventDate"
      :eventDate="eventDate"
    ></PosterItem>
  </ul>
</template>

<script>
  import PosterItem from "./PosterItem"

  export default {
    components: {
      PosterItem
    },
    computed: {
      eventsDates() {
        return this.$store.getters.eventsDates
      }
    }
  }
</script>
