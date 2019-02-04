<template>
  <button
    type="button"
    :disabled="disabled || load"
    @click="$emit('click')"
  >
    <slot></slot>
    <Spinner
      class="btn__spinner"
      :size="16"
      v-if="load"
    ></Spinner>
  </button>
</template>

<script>
  import Spinner from 'vue-simple-spinner'

  export default {
    components: {
      Spinner
    },
    props: {
      disabled:{
        type: Boolean,
        default: false
      },
      load: {
        type: Boolean,
        default: false
      }
    }
  }
</script>

<style scoped>
  .btn {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .btn__spinner {
    margin: 0 0 0 10px !important;
  }
</style>
