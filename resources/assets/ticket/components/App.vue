<template>
  <div>
    <LineToIndex></LineToIndex>
    <div class="wrap">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
  import LineToIndex from "./Common/LineToIndex/LineToIndex"

  export default {
    components: {
      LineToIndex
    }
  }
</script>
