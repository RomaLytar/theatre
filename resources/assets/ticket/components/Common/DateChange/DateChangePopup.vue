<template>
  <section class="date-change__popup">
    <h2 class="date-change__popup-title">{{ translation.chooseDate[documentLang] }}</h2>

    <ul class="date-change__popup-list">
      <li v-for="date in filterDateToHigh">
        <label class="date-change__popup-item">
          <input
            type="radio"
            class="visually-hidden"
            :value="date.id"
            v-model="chooseDate"
          >
          <DateChangeFormatDate
            :date="date.date"
          ></DateChangeFormatDate>
        </label>
      </li>
    </ul>

    <button
      type="button"
      class="btn btn--full"
      @click="changeDate"
    >{{ translation.change[documentLang] }}</button>
    <button
      type="button"
      class="btn btn--border"
      @click="resetChangesDate"
    >{{ translation.cancel[documentLang] }}</button>
  </section>
</template>

<script>
  import DateChangeFormatDate from "./DateChangeFormatDate"

  export default {
    props: {
      dateList: {
        type: Array
      }
    },
    components: {
      DateChangeFormatDate
    },
    data() {
      return {
        chooseDate: false,
        translation: {
          chooseDate: {
            ru: `Выберите дату`,
            en: `Choose a date`,
            ua: `Виберіть дату`
          },
          change: {
            ru: `Изменить`,
            en: `Change`,
            ua: `Змінити`
          },
          cancel: {
            ru: `Отмена`,
            en: `Reset`,
            ua: `Скасувати`
          }
        }
      }
    },
    computed: {
      filterDateToHigh() {
        return this.dateList.sort((a, b) => {
          if (new Date(a.date) > new Date(b.date)) {
            return 1
          }

          return -1
        });
      },
      documentLang() {
        return this.$store.getters.documentLang
      }
    },
    methods: {
      changeDate() {
        if (this.chooseDate) {
          this.$emit(`date-change`, this.chooseDate);
          this.$emit(`popup-close`);
        }
      },
      resetChangesDate() {
        this.chooseDate = false;
        this.$emit(`popup-close`);
      }
    }
  }
</script>

<style scoped>
  .btn {
    max-width: 130px;
  }
</style>
