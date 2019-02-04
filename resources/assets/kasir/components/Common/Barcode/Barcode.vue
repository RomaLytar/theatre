<template>
  <svg ref="barcode" class="barcode"></svg>
</template>

<script>
  export default {
    props: {
      code: {
        type: [String, Number],
        required: true
      },
      size: {
        type: Object,
        required: true
      }
    },
    mounted() {
      JsBarcode(this.$refs.barcode, this.code, {
        height: this.size.height,
        width: 1,
        displayValue: false,
        background: `transparent`,
        margin: 0
      });
    }
  }
</script>
