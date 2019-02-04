<template>
  <div class="scheme-controls">
    <button
      type="button"
      class="scheme-controls__btn"
      @click="schemeZoomChange(true)"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 57.9 57.9"
        :width="svg.size"
        :height="svg.size"
        :fill="svg.color"
      >
        <path d="M27.5,27.5H1.3c-0.7,0-1.3,0.6-1.3,1.3c0,0.4,0.1,0.7,0.4,0.9C0.6,30,1,30.2,1.3,30.2l26.4,0v26.4
      c0,0.4,0.1,0.7,0.4,0.9s0.6,0.4,0.9,0.4c0.7,0,1.3-0.6,1.3-1.3l0-26.2l26.2,0c0.7,0,1.3-0.6,1.3-1.3c0-0.7-0.6-1.3-1.3-1.3l-26.4,0
      l0-26.4c0-0.7-0.6-1.3-1.3-1.3c-0.7,0-1.3,0.6-1.3,1.3L27.5,27.5z"/>
      </svg>
      <span class="visually-hidden">{{ translation.zoomIn[documentLang] }}</span>
    </button>
    <button
      type="button"
      class="scheme-controls__btn"
      @click="schemeZoomChange(false)"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 57.9 57.9"
        :width="svg.size"
        :height="svg.size"
        :fill="svg.color"
      >
        <path d="M1.3,27.5c-0.7,0-1.3,0.6-1.3,1.3c0,0.4,0.1,0.7,0.4,0.9C0.6,30,1,30.2,1.3,30.2l55.2,0.2
          c0.7,0,1.3-0.6,1.3-1.3c0-0.7-0.6-1.3-1.3-1.3L1.3,27.5z"/>
      </svg>
      <span class="visually-hidden">{{ translation.zoomOut[documentLang] }}</span>
    </button>
  </div>
</template>

<script>
  export default {
    data(){
      return {
        svg: {
          size: 16,
          color: `#ccc`
        },
        translation: {
          zoomIn: {
            ru: `Увеличить размер`,
            en: `ZoomIn`,
            ua: `Збільшити розмір`
          },
          zoomOut: {
            ru: `Уменьшить размер`,
            en: `ZoomOut`,
            ua: `Зменшити розмір`
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
      schemeZoomChange(zoom) {
        this.$emit(`change`, zoom);
      }
    }
  }
</script>
