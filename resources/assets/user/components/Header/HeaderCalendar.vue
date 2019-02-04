<template>
  <a href="/calendar" class="calendar-btn">
    <span class="calendar-btn__text">Календарь</span>
    <svg viewBox="0 0 20 22" width="20" height="22" fill="#fff">
      <path fill-rule="evenodd" clip-rule="evenodd" d="M20,8V7V3V2h-1h-3V0h-1v2H5V0H4v2H1H0v1v4v1v14h1h18h1v-1V8zM19,21H1V8h18V21z M19,7H1V3h3v2h1V3h10v2h1V3h3V7z"></path>
      <text :x="calendarX" :y="calendarY" ref="calendar">{{ getCurrentDate }}</text>
    </svg>
  </a>
</template>

<script>
  export default {
    data() {
      return {
        width: 20,
        height: 22,
        pageLoad: false
      }
    },
    computed: {
      getCurrentDate() {
        this.pageLoad = true;
        return new Date().getDate();
      },
      calendarX() {
        if (this.pageLoad) {
          return (this.width - Math.round(this.$refs.calendar.textLength.baseVal.value)) / 2
        }
      },
      calendarY() {
        if (this.pageLoad) {
          return this.height - 3
        }
      }
    }
  }
</script>
