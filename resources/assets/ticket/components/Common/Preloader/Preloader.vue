<template>
  <div class="preloader">
    <Spinner :size="100"></Spinner>
  </div>
</template>

<script>
  import Spinner from 'vue-simple-spinner'

  export default {
    components: {
      Spinner
    }
  }
</script>
