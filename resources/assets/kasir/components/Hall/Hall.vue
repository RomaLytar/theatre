<template>
  <div>
    <KasirHeader>
      <router-link
        class="btn btn-info mr-3"
        :to="{name: 'Poster'}"
        exact
      >До афiши</router-link>
      <button
        type="button"
        class="btn btn-success mr-3"
        @click="getLastOrder"
        v-if="showBtnLastOrder"
      >Останнє замовлення</button>
      <button
        type="button"
        class="btn btn-primary"
        @click="resetZoom"
      >Автомасштаб</button>
    </KasirHeader>

    <template v-if="startLoading">
      <Preloader class="mt-5"></Preloader>
    </template>
    <div class="wrap" v-else>
      <section class="hall">
        <aside class="hall__aside">
          <HallDescription></HallDescription>
          <Cart @refreshData="refreshAvailableSeats"></Cart>
        </aside>

        <div class="hall__scheme">
          <template v-if="refreshSeats">
            <Preloader class="preloader--inline"></Preloader>
          </template>
          <HallScheme :event="eventInfo" v-else></HallScheme>
        </div>

        <aside class="hall__info">
          <template v-if="refreshInfoSeats">
            <Preloader class="preloader--inline"></Preloader>
          </template>
          <HallSeats :event="eventInfo" v-else></HallSeats>
          <HallPrice :event="eventInfo"></HallPrice>
          <HallPriceDefault></HallPriceDefault>
        </aside>
      </section>
    </div>
    <Popup
      v-if="showPopupLastOrder"
      @popup-close="showPopupLastOrder = false"
    >
      <LastOrder></LastOrder>
    </Popup>
    <Print
      v-if="printAccept"
      :tickets="printTickets"
    ></Print>
  </div>
</template>

<script>
  import Preloader from "../Common/Preloader/Preloader"
  import KasirHeader from "../Common/KasirHeader/KasirHeader"
  import HallDescription from "./HallDescription/HallDescription"
  import HallSeats from "./HallSeats/HallSeats"
  import HallPrice from "./HallPrice/HallPrice"
  import HallPriceDefault from "./HallPrice/HallPriceDefault"
  import HallScheme from "./HallScheme/HallScheme"
  import Cart from "../Cart/Cart"
  import Popup from "../Common/Popup/Popup"
  import LastOrder from "../LastOrder/LastOrder"
  import Print from "../Common/Print/Print"

  export default {
    components: {
      Preloader,
      KasirHeader,
      HallDescription,
      HallSeats,
      HallPrice,
      HallPriceDefault,
      HallScheme,
      Cart,
      Popup,
      LastOrder,
      Print
    },
    created() {
      const hallId = this.$route.params.id;

      this.startLoading = true;
      this.$store.dispatch(`getHallData`, hallId)
        .then(data => this.startLoading = false);

      const lastOrder = localStorage.getItem(`lastOrder`);

      if (lastOrder) this.$store.commit(`saveLastOrder`, JSON.parse(lastOrder));
    },
    data() {
      return {
        startLoading: false,
        refreshSeats: false,
        refreshInfoSeats: false,
        showPopupLastOrder: false
      }
    },
    computed: {
      showBtnLastOrder() {
        return this.$store.getters.getLastOrder.order
      },
      eventInfo() {
        const id = this.$route.params.id;
        let currentEvent = ``;

        this.$store.getters.events.forEach(item => {
          const resultEvent = item.data.find(event => event.id == id);

          if (resultEvent) currentEvent = resultEvent;
        });

        return currentEvent
      },
      printTickets() {
        return this.$store.getters.getOrderForPrint
      },
      printAccept() {
        return this.$store.getters.getPrintAccept
      }
    },
    methods: {
      resetZoom() {
        console.log(`Reset zoom`);
      },
      refreshAvailableSeats() {
        const hallId = this.$route.params.id;

        this.refreshSeats = true;

        this.$store.dispatch(`getHallData`, hallId)
          .then(data => this.refreshSeats = false);

        this.refreshInfoSeats = true;
        this.$store.dispatch(`refreshEventById`, hallId)
          .then(data => this.refreshInfoSeats = false);
      },
      getLastOrder() {
        this.showPopupLastOrder = true;
      }
    }
  }
</script>
