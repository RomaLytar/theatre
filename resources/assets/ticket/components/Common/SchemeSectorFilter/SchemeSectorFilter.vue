<template>
  <section class="scheme-sector-filter" :data-open="shemeOpen">
    <Cross
      width="20"
      height="20"
      class="scheme-sector-filter__close"
      @click="shemeOpen = !shemeOpen"
    ></Cross>

    <button
      type="button"
      class="scheme-sector-filter__title"
      @click="schemeOpen"
    >
      {{ translation.chooseSector[documentLang] }}
      <ArrowDown width="12" height="7"></ArrowDown>
    </button>
    <div class="scheme-sector-filter__svg">
      <SchemeSector
        class="scheme-sector--small"
        :sectorList="scheme"
        @change-sector="changeSector"
        v-if="!fullScheme"
      ></SchemeSector>
      <button
        type="button"
        class="scheme-sector-filter__link"
        @click="chooseAllHall"
      >
        <template v-if="!fullScheme">{{ translation.wholeHall[documentLang] }}</template>
        <template v-else>{{ translation.chooseSector[documentLang] }}</template>
      </button>
    </div>
  </section>
</template>

<script>
  import Cross from "../Cross/Cross"
  import SchemeSector from "../SchemeSector/SchemeSector"
  import ArrowDown from "../ArrowDown/ArrowDown"

  export default {
    props: {
      scheme: {
        type: Array,
        required: true
      }
    },
    components: {
      SchemeSector,
      ArrowDown,
      Cross
    },
    data() {
      return {
        fullScheme: false,
        shemeOpen: false,
        translation: {
          chooseSector: {
            ru: `Выбор сектора`,
            en: `Sector selection`,
            ua: `Вибір сектора`
          },
          wholeHall: {
            ru: `Весь зал`,
            en: `Whole hall`,
            ua: `Весь зал`
          },
          bySectors: {
            ru: `По секторам`,
            en: `By sector`,
            ua: `За секторами`
          }
        }
      }
    },
    computed: {
      documentLang() {
        return this.$store.getters.documentLang
      }
    },
    methods: {
      schemeOpen() {
        if (window.innerWidth <= 768) {
          if (!this.shemeOpen) this.shemeOpen = !this.shemeOpen;
        } else {
          this.shemeOpen = false;
        }
      },
      changeSector(e) {
        if (this.scheme.find(item => item.sectionId === e.sectionId).checked != true) {
          this.$emit(`change-sector`, e);
          this.shemeOpen = false;
        }
      },
      chooseAllHall() {
        this.fullScheme = !this.fullScheme;
        this.shemeOpen = false;

        this.$emit(`show-all`);
      }
    }
  }
</script>
