<template>
  <div class="popup" @click="popupClose">
    <div class="popup__inner">
      <div class="popup__wrap">
        <Cross
          class="popup__close"
          @click="$emit('popup-close')"
        >
          <span class="visually-hidden">{{ translation.close[documentLang] }}</span>
        </Cross>
        <slot></slot>
      </div>
    </div>
  </div>
</template>

<script>
  import Cross from "../Cross/Cross";

  export default {
    components: {
      Cross
    },
    methods: {
      popupClose(e) {
        if (!e.target.closest(`.popup__wrap`)) {
          this.$emit(`popup-close`);
        }
      }
    },
    data() {
      return {
        escFunc: (e) => {
          if (e.keyCode === 27) this.$emit(`popup-close`);
        },
        translation: {
          close: {
            ru: `Закрыть`,
            en: `Close`,
            ua: `Закрити`
          }
        }
      }
    },
    computed: {
      documentLang() {
        return this.$store.getters.documentLang
      }
    },
    mounted() {
      document.addEventListener(`keyup`, this.escFunc);
    },
    beforeDestroy() {
      document.removeEventListener(`keyup`, this.escFunc);
    }
  }
</script>
