export default {
  computed: {
    documentLang() {
      return this.$store.getters.documentLang
    },
    windowWidth() {
      return this.$store.getters.windowWidth
    },
    translation() {
      return this.$store.getters.translation
    }
  }
}
