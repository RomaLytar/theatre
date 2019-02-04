<template>
  <section class="date-change" v-if="date">
    <template v-if="showCurrentDate">
      <h2 class="date-change__title">
        <slot name="title">{{ translation.dateAndTime[documentLang] }}</slot>
      </h2>
      <p class="date-change__active-datetime">
        <span class="date-change__active-date">{{ getDate }}</span>
        <span class="date-change__active-time">{{ getHours | addZero }}:{{ getMinutes | addZero }}</span>
      </p>
    </template>

    <button
      class="btn btn--border btn--width"
      type="button"
      @click="modalOpen = true"
      v-if="changeDateBtnVisibility && dateList.length > 1"
    >
      {{ translation.changeDateAndTime[documentLang] }}
    </button>
    <Popup
      v-if="modalOpen"
      @popup-close="modalOpen = false"
    >
      <DateChangePopup
        :dateList="dateListWithoutCurrentDate"
        @popup-close="modalOpen = false"
        @date-change="changeDate"
      ></DateChangePopup>
    </Popup>
  </section>
</template>

<script>
  import dateFormat from "../../../mixins/date-format"
  import Popup from "../Popup/Popup"
  import DateChangePopup from "./DateChangePopup"

  export default {
    props: {
      date: {
        type: [Object, String]
      },
      dateList: {
        default(){
          return []
        }
      },
      showCurrentDate: {
        type: Boolean,
        default: true
      }
    },
    mixins: [dateFormat],
    data() {
      return {
        modalOpen: false,
        translation: {
          dateAndTime: {
            ru: `Дата и время`,
            en: `Date and time`,
            ua: `Дата та час`
          },
          changeDateAndTime: {
            ru: `Изменить дату`,
            en: `Change date`,
            ua: `Змінити дату`
          }
        }
      }
    },
    components: {
      Popup,
      DateChangePopup
    },
    computed: {
      dateForFormat() {
        return this.date
      },
      dateListWithoutCurrentDate() {
        return this.dateList.filter(date => date.date !== this.date)
      },
      changeDateBtnVisibility() {
        if (Array.isArray(this.dateList)) {
          return this.dateList.length
        } else if (this.dateList === null) {
          return false
        }
      }
    },
    methods: {
      changeDate(e) {
        this.$router.push({ name: `Entry`, params: { id: e }})
      }
    }
  }
</script>
