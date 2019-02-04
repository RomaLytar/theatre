<template>
  <div>
    <div v-if="error.is">
      {{ error.message }}
    </div>
    <div v-else>
      <template v-if="loading">
        <Preloader></Preloader>
      </template>
    </div>
  </div>
</template>

<script>
  import Preloader from "../Common/Preloader/Preloader"

  export default {
    components: {
      Preloader
    },
    data() {
      return {
        error: {
          is: false,
          message: ``
        }
      }
    },
    created(){
      this.getPerfomanceInfo(this.$route.params.id);
    },
    methods: {
      getPerfomanceInfo(id) {
        this.$store.dispatch(`getPerfomanceData`, id)
        .then(data => {
          switch(data.hall.data.name) {
            case `small`:
              this.$router.push({ name: `Seatmap`})
              break;

            case `muzsalon`:
              this.$router.push({ name: `Seatmap`})
              break;

            case `big`:
              this.$router.push({ name: `Perfomance`})
              break;

            case `outdoor`:
              this.$router.push({ name: `ProstoNeba`})
              break;
          }
        })
        .catch(error => {
          this.error.is = true;
          this.error.message = error.message;
        })
      }
    },
    computed: {
      loading() {
        return this.$store.getters.loading
      }
    }
  }
</script>
