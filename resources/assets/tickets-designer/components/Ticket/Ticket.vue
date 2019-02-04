<template>
    <div class="constructor">
      <template v-if="ticketLoad">
        <Preloader></Preloader>
      </template>
      <template v-else>
        <ConstructorAside></ConstructorAside>
        <ConstructorResult></ConstructorResult>
      </template>
    </div>
  </div>
</template>

<script>
  import ConstructorAside from "../ConstructorAside/ConstructorAside"
  import ConstructorResult from "../ConstructorResult/ConstructorResult"
  import Preloader from "../../../kasir/components/Common/Preloader/Preloader"

  export default {
    components: {
      Preloader,
      ConstructorAside,
      ConstructorResult
    },
    created() {
      const id = this.$route.params.id;

      if (id) {
        this.ticketLoad = true;

        this.$store.dispatch(`getTicketTamplate`, id)
          .then(data => this.ticketLoad = false)
          .catch(err => {
            console.warn(err);
            this.ticketLoad = false;
          })
      } else {
        this.$store.dispatch(`resetTicketData`)
      }
    },
    data() {
      return {
        ticketLoad: false
      }
    }
  }
</script>
