<template>
  <li>
    <div class="poster-list__header">
      <span class="poster-list__date">{{ getDate }}</span>
      <span class="poster-list__day">{{ getWeekday }}</span>
      <template v-if="ifCurrentDate">
        <span class="poster-list__date-current">Сегодня</span>
      </template>
      <button
        type="button"
        class="poster-list__btn"
        @click="getEvents"
      >
        <ArrowDown></ArrowDown>
      </button>
    </div>
    <table
      class="poster-list__table"
      v-if="eventsTableOpen">
      <tbody>
        <PosterItemTable
          v-for="(event, index) in events"
          :key="index"
          :event="event"
        ></PosterItemTable>
      </tbody>
    </table>
  </li>
</template>

<script>
  import ArrowDown from "../../Common/ArrowDown/ArrowDown"
  import PosterItemTable from "./PosterItemTable"

  export default {
    props: {
      eventDate: {
        required: true,
        type: String
      }
    },
    components: {
      ArrowDown,
      PosterItemTable
    },
    data() {
      return {
        documentLang: `uk`,
        eventsTableOpen: false
      }
    },
    computed: {
      events() {
        const filteredItem = this.$store.getters.events.find(item => item.date == this.eventDate);

        if (filteredItem) {
          return filteredItem.data;
        } else {
          this.eventsTableOpen = false;
          return null
        }
      },
      ifCurrentDate() {
        return Date.parse(this.eventDate.split(" ")[0]) == new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate())
      },
      getWeekday() {
        const formatter = new Intl.DateTimeFormat(this.documentLang, {
          weekday: `long`
        });

        return formatter.format(new Date(this.eventDate)).charAt(0).toUpperCase() + formatter.format(new Date(this.eventDate)).slice(1);
      },
      getDate() {
        const formatter = new Intl.DateTimeFormat(this.documentLang, {
          month: `long`,
          day: `numeric`
        });

        return formatter.format(new Date(this.eventDate));
      }
    },
    methods: {
      getEvents() {
        if (!this.eventsTableOpen) {
          const hasData = this.$store.getters.events.find(item => item.date == this.eventDate);

          if (!hasData) {
            this.$store.dispatch(`getEventByDate`, this.eventDate)
              .then(data => {
                this.eventsTableOpen = true;
              })
            } else {
              this.eventsTableOpen = true;
            }
        } else {
          this.eventsTableOpen = false;
        }
      }
    }
  }
</script>
