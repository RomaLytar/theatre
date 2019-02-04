<template>
  <div>
    <template v-if="loading">
      <Preloader></Preloader>
    </template>
    <template v-else>
      <KasirHeader>
        <router-link
          class="btn btn-info mr-3"
          :to="{name: 'Poster'}"
          exact
        >До афiши</router-link>
      </KasirHeader>

      <div class="wrap">
        <div class="booking">
          <h1 class="booking__title">Квитки</h1>
          <form class="booking__form" @submit.prevent="search">
            <div class="booking__search">
              <label for="search" class="booking__search-label">Пошук:</label>
              <input
                type="text"
                class="form-control booking__search-input"
                id="search"
                name="search"
                v-model="searchValue"
                :disabled="searching"
              >
              <ButtonLoader
                type="submit"
                class="btn btn-success booking__search-btn"
                :load="searching"
              >Шукати</ButtonLoader>
            </div>
            <div class="booking__search-type">
              <label class="form-check">
                <input
                  type="radio"
                  class="form-check-input"
                  name="all"
                  value="all"
                  v-model="filterType"
                >
                <span class="form-check-label">Усi</span>
              </label>
              <label class="form-check">
                <input
                  type="radio"
                  class="form-check-input"
                  name="cash"
                  value="cash"
                  v-model="filterType"
                >
                <span class="form-check-label">Готiвковий</span>
              </label>
              <label class="form-check">
                <input
                  type="radio"
                  class="form-check-input"
                  name="cashless"
                  value="cashless"
                  v-model="filterType"
                >
               <span class="form-check-label">Безготiвковий</span>
              </label>
            </div>
          </form>
          <TicketsTable v-if="soldTickets.length"></TicketsTable>
        </div>
      </div>

      <Print
        v-if="printAccept"
        :tickets="printTickets"
      ></Print>
    </template>
  </div>
</template>

<script>
  import Preloader from "../Common/Preloader/Preloader"
  import KasirHeader from "../Common/KasirHeader/KasirHeader"
  import ButtonLoader from "../Common/ButtonLoader/ButtonLoader"
  import TicketsTable from "./TicketsTable"
  import Print from "../Common/Print/Print"

  export default {
    components: {
      Preloader,
      KasirHeader,
      ButtonLoader,
      TicketsTable,
      Print
    },
    data() {
      return {
        searchValue: ``,
        searching: false
      }
    },
    created() {
      this.searching = true;

      this.$store.dispatch(`getSoldTickets`)
        .then(data => this.searching = false)
        .catch(err => this.searching = false)
    },
    computed: {
      loading() {
        return this.$store.getters.loading
      },
      soldTickets() {
        return this.$store.getters.getSoldTickets
      },
      filterType: {
        get() {
          return this.$store.getters.getSoldTicketsFilterType
        },
        set(value) {
          this.changeFilterType(value);
        }
      },
      printTickets() {
        return this.$store.getters.getOrderForPrint
      },
      printAccept() {
        return this.$store.getters.getPrintAccept
      }
    },
    methods: {
      changeFilterType(value) {
        this.$store.commit(`changeSoldTicketsFilterType`, value)
      },
      search() {
        this.searching = true;

        if (this.searchValue.length) {
          const formatSearchValue = this.searchValue.split(`-`)[0],
                payload = `param=id&query=${formatSearchValue}`;

          this.$store.dispatch(`getSearchSoldResult`, payload)
            .then(data => this.searching = false)
            .catch(err => this.searching = false)
        } else {
          this.$store.dispatch(`getSoldTickets`)
            .then(data => this.searching = false)
            .catch(err => this.searching = false)
        }
      }
    }
  }
</script>
