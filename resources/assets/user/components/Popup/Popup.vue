<template>
  <div class="popup" :class="modalOpen">
    <div class="popup__inner">
      <div class="popup__wrap">
        <button type="button" class="popup__close" @click="$emit('popup-close')">
          <span class="visually-hidden">{{ translation.close[documentLang] }}</span>
          <svg viewBox="0 0 224.512 224.512" width="25" height="25" fill="#111111">
            <path d="M224.507 6.997L217.521 0 112.256 105.258 6.998 0 .005 6.997l105.258 105.257L.005 217.512l6.993 7L112.256 119.24l105.265 105.272 6.986-7-105.258-105.258z"></path>
          </svg>
        </button>

        <h1 class="title-main">
          <slot name="title"></slot>
        </h1>

        <slot></slot>
      </div>
    </div>
  </div>
</template>

<script>
  import translation from "../../mixins/translation"

  export default {
    props: [`open`],
    mixins: [translation],
    computed: {
      modalOpen() {
        return {
          'popup--active': this.open
        }
      }
    },
    created() {
      const domKeyClick = (e) => {
        if (e.keyCode === 27) {
          this.$emit('popup-close');
          document.removeEventListener(`domMouseClick`, domMouseClick);
          document.removeEventListener(`keyup`, domKeyClick);
        }
      };

      const domMouseClick = (e) => {
        if (!e.target.closest(`.popup__wrap`)) {
          this.$emit('popup-close');
          document.removeEventListener(`domMouseClick`, domMouseClick);
          document.removeEventListener(`keyup`, domKeyClick);
        }
      };

      document.addEventListener(`keyup`, domKeyClick);
      document.addEventListener(`click`, domMouseClick);
    }
  }
</script>
