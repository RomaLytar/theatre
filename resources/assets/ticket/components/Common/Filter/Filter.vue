<template>
  <section class="filter">
    <button
      type="button"
      class="filter__title"
      @click="filterBtnVisible ? $emit('filter-trigger') : null"
      :data-close="!filterOpen"
    >
      <span class="filter__btn-title">{{ translation.filters[documentLang] }}</span>
      <span class="visually-hidden">{{ translation.close[documentLang] }}</span>
      <ArrowDown width="16" height="10" v-if="filterBtnVisible"></ArrowDown>
    </button>
    <div
      class="filter__outer"
      v-show="filterOpen"
    >
      <div class="filter__inner">
        <PriceFilter
          :perfomancePrices="perfomancePrices"
          @reset-filter="resetRangeSlider = false"
          @filter-changed="filterChanged"
        ></PriceFilter>
        <button
          type="button"
          class="btn btn--border btn--width"
          @click="resetFilter"
        >{{ translation.resetFilters[documentLang] }}</button>
        <DateChange
          v-if="dateChangeVisible"
          :date="perfomanceInfo.date"
          :dateList="perfomanceDates"
        ></DateChange>

        <button
          class="btn btn--red btn--long filter__btn"
          @click="$emit('filter-trigger')"
        >{{ translation.apply[documentLang] }}</button>
      </div>
    </div>
  </section>
</template>

<script>
  import dateFormat from "../../../mixins/date-format"
  import PriceFilter from "../PriceFilter/PriceFilter"
  import DateChange from "../DateChange/DateChange"
  import ArrowDown from "../ArrowDown/ArrowDown"

  export default {
    props: {
      dateChangeVisible: {
        type: Boolean,
        default: true
      },
      filterOpen: {
        type: Boolean,
        default: true
      },
      filterBtnVisible: {
        type: Boolean,
        default: false
      }
    },
    mixins: [dateFormat],
    components: {
      PriceFilter,
      DateChange,
      ArrowDown
    },
    created() {
      if (window.innerWidth <= 768) this.$emit('filter-trigger');
    },
    data() {
      return {
        resetRangeSlider: false,
        translation: {
          filters: {
            ru: `Фильтры`,
            en: `Filters`,
            ua: `Фільтри`
          },
          close: {
            ru: `Закрыть`,
            en: `Close`,
            ua: `Закрити`
          },
          resetFilters: {
            ru: `Сбросить фильтры`,
            en: `Reset filters`,
            ua: `Скинути фільтри`
          },
          apply: {
            ru: `Применить`,
            en: `Apply`,
            ua: `Застосувати`
          }
        }
      }
    },
    methods: {
      resetFilter() {
        this.resetRangeSlider = true;
      },
      filterChanged(e) {
        this.$store.commit(`perfomanceFilterPrices`, e)
      }
    },
    computed: {
      dateForFormat() {
        return this.perfomanceInfo.date
      },
      perfomancePrices() {
        let start = ``,
            end = ``;

        if (this.perfomanceFilterPrices.length) {
          start = this.perfomanceFilterPrices[0];
          end = this.perfomanceFilterPrices[1];
        }

        return {
          prices: this.$store.getters.perfomancePrices,
          start: start,
          end: end,
          resetRangeSlider: this.resetRangeSlider
        }
      },
      perfomanceFilterPrices() {
        return this.$store.getters.perfomanceFilterPrices
      },
      perfomanceDates() {
        return this.$store.getters.perfomanceDates
      },
      perfomanceInfo() {
        return this.$store.getters.perfomanceInfo
      },
      documentLang() {
        return this.$store.getters.documentLang
      }
    }
  }
</script>
