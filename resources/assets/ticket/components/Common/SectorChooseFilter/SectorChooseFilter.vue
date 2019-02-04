<template>
  <section class="sector-choose-filter">
    <slot>{{ translation.chooseSector[documentLang] }}</slot>
    <ul class="sector-choose-filter__list">
      <li
        class="sector-choose-filter__item"
        v-for="item in sectorList"
        :key="item.sectionId"
      >
        <Checkbox
          :checked="item.checked"
          @change="$emit(`change-sector`, item)"
        >
          <span class="sector-choose-filter__name">{{ item.sectionName[documentLang] }}</span>
          <span class="sector-choose-filter__prices">
            {{ item.prices.min }} - {{ item.prices.max }}
          </span>
        </Checkbox>
      </li>
    </ul>
  </section>
</template>

<script>
  import Checkbox from "../Checkbox/Checkbox";

  export default {
    components: {
      Checkbox
    },
    data(){
      return {
        translation: {
          chooseSector: {
            ru: `Выбор сектора`,
            en: `Sector selection`,
            ua: `Вибір сектора`
          }
        }
      }
    },
    computed: {
      sectorList() {
        return this.$store.getters.sectorList
      },
      documentLang() {
        return this.$store.getters.documentLang
      }
    }
  }
</script>
