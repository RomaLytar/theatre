<template>
  <button
    type="button"
    class="back"
    @click="goToPrevPage"
  >
    <span class="visually-hidden">{{ translation.back[documentLang] }}</span>
    <svg viewBox="0 0 19.8 37.7" :width="width" :height="height" :fill="fill">
      <path d="M19.4,2.1L2.9,18.9l16.6,16.8c0.2,0.2,0.3,0.5,0.3,0.8c0,0.3-0.1,0.6-0.3,0.8c-0.5,0.5-1.2,0.5-1.7,0L0.4,19.7
    c-0.1-0.1-0.2-0.3-0.3-0.4C-0.1,18.9,0,18.4,0.4,18L17.8,0.4c0.5-0.5,1.2-0.5,1.7,0C19.9,0.9,19.9,1.7,19.4,2.1z"/>
    </svg>
  </button>
</template>

<script>
  export default {
    props: {
      link: {
        type: Object
      },
      width: {
        type: [Number, String],
        default: 11
      },
      height: {
        type: [Number, String],
        default: 20
      },
      fill: {
        type: String,
        default: `#333333`
      }
    },
    data(){
      return {
        translation: {
          back: {
            ru: `Вернуться назад`,
            en: `Go back`,
            ua: `Повернутися назад`
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
      goToPrevPage() {
        if (!this.link) {
          history.back();
        }
      }
    }
  }
</script>
