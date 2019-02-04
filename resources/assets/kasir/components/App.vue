<template>
  <div>
    <router-view></router-view>
  </div>
</template>

<script>
  export default {
    created() {
      const id = document.querySelector(`#cash-box-id`).value,
            fullName = document.querySelector(`#cash-box-fullname`).value;

      this.$store.dispatch(`setKasir`, {
        id: id,
        fullName: fullName
      })
    }
  }
</script>
