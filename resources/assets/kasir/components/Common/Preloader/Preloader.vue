<template>
  <div class="preloader" :class="{'preloader--inline': inline}">
    <Spinner :size="100"></Spinner>
  </div>
</template>

<script>
  import Spinner from 'vue-simple-spinner'

  export default {
    props: {
      inline: {
        type: Boolean
      }
    },
    components: {
      Spinner
    }
  }
</script>
