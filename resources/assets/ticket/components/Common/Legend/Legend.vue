<template>
  <section class="legend">
    <button
      type="button"
      class="legend__btn"
      @click="legendOpen = !legendOpen"
      :data-close="!legendOpen"
    >
      <span class="legend__btn-title">{{ translation.legend[documentLang] }}</span>
      <ArrowDown width="12" height="7"></ArrowDown>
    </button>
    <ul class="legend__list" v-if="legendOpen">
      <li
        class="legend__item"
        v-for="(item, key) in perfomanceLegend"
        :key="item.name.en"
      >
        <span class="legend__item-icon" :style="item.style"></span>
        {{ item.name[documentLang] }}
      </li>
    </ul>
  </section>
</template>

<script>
  import ArrowDown from "../ArrowDown/ArrowDown"

  export default {
    data(){
      return {
        legendOpen: false,
        translation: {
          legend: {
            ru: `Легенда`,
            en: `Legend`,
            ua: `Легенда`
          }
        }
      }
    },
    computed: {
      perfomanceLegend() {
        return this.$store.getters.perfomanceLegend
      },
      documentLang() {
        return this.$store.getters.documentLang
      }
    },
    components: {
      ArrowDown
    }
  }
</script>
