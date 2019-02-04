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
          <h1 class="booking__title">Пошук за бронею</h1>
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
                  name="id"
                  value="id"
                  v-model="searchType"
                >
                <span class="form-check-label">За номером замовлення</span>
              </label>
              <label class="form-check">
                <input
                  type="radio"
                  class="form-check-input"
                  name="name"
                  value="name"
                  v-model="searchType"
                >
               <span class="form-check-label">За ім'ям</span>
              </label>
              <label class="form-check">
                <input
                  type="radio"
                  class="form-check-input"
                  name="phone"
                  value="phone"
                  v-model="searchType"
                >
                <span class="form-check-label">За номером телефону</span>
              </label>
            </div>
          </form>
          <BookingTable v-if="searchResult.length"></BookingTable>
        </div>
      </div>
    </template>
  </div>
</template>

<script>
  import Preloader from "../Common/Preloader/Preloader"
  import KasirHeader from "../Common/KasirHeader/KasirHeader"
  import ButtonLoader from "../Common/ButtonLoader/ButtonLoader"
  import BookingTable from "./BookingTable"

  export default {
    components: {
      Preloader,
      KasirHeader,
      ButtonLoader,
      BookingTable
    },
    data() {
      return {
        searchValue: ``,
        searchType: `phone`,
        searching: false
      }
    },
    computed: {
      loading() {
        return this.$store.getters.loading
      },
      searchResult() {
        return this.$store.getters.getSearchResult
      }
    },
    methods: {
      search() {
        const payload = `param=${this.searchType}&query=${this.searchValue}`;

        this.searching = true;

        this.$store.dispatch(`getSearchResult`, payload)
          .then(data => this.searching = false)
          .catch(err => this.searching = false)
      }
    }
  }
</script>
