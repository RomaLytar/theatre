<template>
  <button
    :disabled="disabled"
    @click="$emit('send-data')"
  >
    <slot v-if="!disabled">Сохранить</slot>
    <div class="loader" v-else></div>
  </button>
</template>

<script>
  export default {
    props: [`disabled`]
  }
</script>

<style scoped>
  .loader,
  .loader::after {
    border-radius: 50%;
    width: 20px;
    height: 20px;
  }

  .loader {
    margin: 0 auto;
    font-size: 0;
    line-height: 0;
    position: relative;
    border-top: 3px solid rgba(255, 255, 255, 0.2);
    border-right: 3px solid rgba(255, 255, 255, 0.2);
    border-bottom: 3px solid rgba(255, 255, 255, 0.2);
    border-left: 3px solid #ffffff;
    transform: translateZ(0);
    animation: load 1.1s infinite linear;
  }

  @keyframes load {
    0% {
      transform: rotate(0deg);
    }
    100% {
      transform: rotate(360deg);
    }
  }
</style>
