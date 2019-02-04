<template>
  <div class="hall-description">
    <h2 class="hall-description__title">{{ hallInfo.performance.data.title }}</h2>
    <p class="hall-description__date">{{ getDate }} {{ getYear }}</p>
    <p class="hall-description__time">{{ getHours | addZero }}:{{ getMinutes | addZero }}</p>
    <p class="hall-description__hall">{{ hallInfo.hall.data.title }}</p>
  </div>
</template>

<script>
  export default {
    computed: {
      hallInfo() {
        return this.$store.getters.getHallInfo
      },
      hallDate() {
        return this.hallInfo.date
      },
      getYear() {
        return new Date(this.hallDate).getFullYear();
      },
      getDate() {
        const formatter = new Intl.DateTimeFormat(`uk`, {
          month: `long`,
          day: `numeric`
        });

        return formatter.format(new Date(this.hallDate));
      },
      getHours() {
        const formatter = new Intl.DateTimeFormat(`uk`, {
          hour: `numeric`,
          hour12: false
        });

        return formatter.format(new Date(this.hallDate));
      },
      getMinutes() {
        const formatter = new Intl.DateTimeFormat(`uk`, {
          minute: `numeric`
        });

        return formatter.format(new Date(this.hallDate));
      }
    }
  }
</script>
