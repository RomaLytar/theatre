<template>
  <section class="price-filter" v-if="perfomancePrices.prices.length > 0">
    <h2 class="price-filter__title">{{ translation.priceRange[documentLang] }}</h2>
    <div id="price-filter-range" ref="range" class="price-filter__range"></div>
    <div class="price-filter__inputs">
      <PriceFilterInput
        :value="inputMin"
        :min="min"
        :max="max"
        :step="step"
        @input-change="inputChange(`min`, $event)"
      >{{ translation.min[documentLang] }}</PriceFilterInput>

      <PriceFilterInput
        :value="inputMax"
        :min="min"
        :max="max"
        :step="step"
        @input-change="inputChange(`max`, $event)"
      >{{ translation.max[documentLang] }}</PriceFilterInput>
    </div>
  </section>
</template>

<script>
  import noUiSlider from "nouislider";
  import PriceFilterInput from "./PriceFilterInput";

  export default {
    props: {
      perfomancePrices: {
        type: Object,
        required: true
      }
    },
    components: {
      PriceFilterInput
    },
    data() {
      return {
        min: ``,
        max: ``,
        inputMin: ``,
        inputMax: ``,
        timer: ``,
        translation: {
          priceRange: {
            ru: `Ценовой диапазон`,
            en: `Price range`,
            ua: `Ціновий діапазон`
          },
          min: {
            ru: `Минимум`,
            en: `Minimum`,
            ua: `Мінімум`
          },
          max: {
            ru: `Максимум`,
            en: `Maximum`,
            ua: `Максимум`
          }
        }
      }
    },
    created() {
      const filteredArr = this.perfomancePrices.prices.filter((a, b) => {
        if (a > b) return 1;
        return -1;
      });

      this.min = filteredArr[0];
      this.max = filteredArr[filteredArr.length - 1];
      this.inputMin = this.min;
      this.inputMax = this.max;
    },
    mounted() {
      const start = this.perfomancePrices.start || this.min,
            end = this.perfomancePrices.end || this.max;

      noUiSlider.create(this.$refs.range, {
        start: [start, end],
        connect: true,
        range: {
          "min": this.min,
          "max": this.max
        }
      });

      this.$refs.range.noUiSlider.on(`update`, (values, handle) => {
        const value = values[handle];

        handle ? this.inputMax = Math.round(value) : this.inputMin = Math.round(value);

        this.filterChanged({min: this.inputMin, max: this.inputMax});
      });
    },
    computed: {
      step() {
        return this.min / 10
      },
      documentLang() {
        return this.$store.getters.documentLang
      }
    },
    watch: {
      perfomancePrices: {
        handler(val) {
          if (val.resetRangeSlider) this.resetFilter();
          this.$emit(`reset-filter`);
        },
        deep: true
      }
    },
    methods: {
      inputChange(type, value) {
        if (type === `min`) {
          this.inputMin = value;
          this.$refs.range.noUiSlider.set([value, null]);
        } else {
          this.inputMax = value;
          this.$refs.range.noUiSlider.set([null, value]);
        }
      },
      resetFilter() {
        this.inputMin = this.min;
        this.inputMax = this.max;
        this.$refs.range.noUiSlider.set([this.min, this.max]);
      },
      filterChanged(obj) {
        clearTimeout(this.timer);

        this.timer = setTimeout(() => {
          this.$emit(`filter-changed`, obj);
        }, 200)
      }
    }
  }
</script>
