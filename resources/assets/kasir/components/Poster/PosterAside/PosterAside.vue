<template>
  <div class="poster-aside">
    <button
      type="button"
      class="btn btn-success btn-block"
      @click="posterRefresh"
    >Обновить афишу</button>
    <router-link
      :to="{name: 'Booking'}"
      class="btn btn-info btn-block"
    >Резерв по ФИО</router-link>
    <router-link
      :to="{name: 'Tickets'}"
      class="btn btn-primary btn-block"
    >Квитки</router-link>
    <div>
      <datepicker
        :language="datepicker.language"
        :inline="true"
        :full-month-name="true"
        :monday-first="true"
        v-model="datepicker.activeDate"
        @selected="changeDate"
        :disabledDates="datepicker.disabledDates"
        :highlighted="datepicker.highlighted"
        :calendar-class="'poster-aside__calendar'"
      ></datepicker>
    </div>
  </div>
</template>

<script>
  import Datepicker from 'vuejs-datepicker';
  import {uk} from 'vuejs-datepicker/dist/locale'

  export default {
    components: {
      Datepicker
    },
    data() {
      return {
        datepicker: {
          language: uk,
          activeDate: new Date(),
          disabledDates: {
            to: new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate())
          },
          highlighted: {
            dates: [
              new Date()
            ]
          }
        }

      }
    },
    methods: {
      posterRefresh() {
        this.$store.dispatch(`getEventsDates`)
          .then(data => this.$store.commit(`clearEvents`));
      },
      changeDate(data) {
        let year = data.getFullYear(),
            month = data.getMonth() + 1,
            date = data.getDate();

        this.$store.dispatch(`getEventsDates`, `${year}-${month}-${date}`);
      }
    }
  }
</script>
