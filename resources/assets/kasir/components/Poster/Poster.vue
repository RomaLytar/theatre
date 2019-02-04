<template>
  <div>
    <template v-if="loading">
      <Preloader></Preloader>
    </template>
    <template v-else>
      <KasirHeader></KasirHeader>

      <div class="wrap">
        <div class="poster">
          <div class="poster__aside">
            <PosterAside></PosterAside>
          </div>
          <div class="poster__data">
            <PosterList></PosterList>
          </div>
        </div>
      </div>
    </template>
  </div>
</template>

<script>
  import Preloader from "../Common/Preloader/Preloader"
  import KasirHeader from "../Common/KasirHeader/KasirHeader"
  import PosterList from "./PosterList/PosterList"
  import PosterAside from "./PosterAside/PosterAside"

  export default {
    components: {
      Preloader,
      KasirHeader,
      PosterList,
      PosterAside
    },
    created() {
      this.$store.dispatch(`getEventsDates`)
    },
    computed: {
      loading() {
        return this.$store.getters.loading
      }
    }
  }
</script>
