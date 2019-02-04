<template>
  <div>
    <Header></Header>
    <router-view></router-view>
  </div>
</template>

<script>
  import {router} from "../routes"
  import Header from "./Header/Header"

  export default {
    components: {
      Header
    }
  }
</script>
