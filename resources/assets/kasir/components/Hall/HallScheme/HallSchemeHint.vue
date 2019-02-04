<template>
  <section
    class="scheme-seat-hint"
    :style="position"
    :class="positionClass"
    ref="hint"
  >
    <p>{{ config.sectionName }}</p>
    <p>
      Ряд {{ config.row }}
      Місце {{ config.seat }}
    </p>
    <p>
      Ціна {{ config.price }} грн.
    </p>
  </section>
</template>

<script>
  export default {
    props: {
      config: {
        type: Object
      },
      scheme: {
        type: null
      }
    },
    data(){
      return {
        position: {},
        positionClass: {
          "scheme-seat-hint--left": false,
          "scheme-seat-hint--right": false,
          "scheme-seat-hint--top": false,
          "scheme-seat-hint--bottom": false
        }
      }
    },
    mounted() {
      const hintHeight = parseInt(getComputedStyle(this.$refs.hint).height),
            hintWidth = parseInt(getComputedStyle(this.$refs.hint).width),
            {left, top, bottom, right, width, height} = this.config.coordinates,
            schemeWidth = parseInt(getComputedStyle(this.scheme).width),
            schemeHeight = parseInt(getComputedStyle(this.scheme).height);

      let hintLeft = null,
          hintTop = null;

      if (left < hintWidth) {
        hintLeft = left + width / 2 - 13;
        this.positionClass[`scheme-seat-hint--left`] = true;
        this.positionClass[`scheme-seat-hint--right`] = false;
      } else {
        hintLeft = left + width / 2 - hintWidth + 13;
        this.positionClass[`scheme-seat-hint--left`] = false;
        this.positionClass[`scheme-seat-hint--right`] = true;
      }

      if (top - hintHeight - 14 < 0) {
        hintTop = top + height + 14;
        this.positionClass[`scheme-seat-hint--top`] = true;
        this.positionClass[`scheme-seat-hint--bottom`] = false;
      } else {
        hintTop = top - 14 - hintHeight;
        this.positionClass[`scheme-seat-hint--top`] = false;
        this.positionClass[`scheme-seat-hint--bottom`] = true;
      }

      this.position = {
        left: `${hintLeft}px`,
        top: `${hintTop}px`
      };
    }
  }
</script>
