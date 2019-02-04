<template>
  <div class="form__group">
    <div class="form__label">
      <span class="form__group-text">
        <slot></slot>
      </span>
      <country-drop-down
        v-model="selectedCountry"
        :options="countries"
        :filter-function="applySearchFilter"
      ></country-drop-down>
    </div>
  </div>
</template>

<script>
import CountryDropDown from './CountryDropDown'

export default {
  props: [`obj`],
  components: {
    CountryDropDown
  },
  created() {
    if (!this.$store.getters.countries.length) {
      this.$store.dispatch(`getCountries`)
      .then((countries) => {
        countries.forEach(item => this.countries.push(item.country_name));
        this.countries_server = countries;
      }).
      then(() => {
        if (this.obj.value) {
          this.selectedCountry = this.countries_server.find((item) => item.id == this.obj.value).country_name;
        } else {
          this.selectedCountry = this.countries_server.find((item) => item.id == 240).country_name;
        }
      })
      .catch((err) => {
        console.log(err)
      })
    } else {
      this.$store.getters.countries.forEach(item => this.countries.push(item.country_name));
      this.countries_server = this.$store.getters.countries;

      if (this.obj.value) {
        this.selectedCountry = this.countries_server.find((item) => item.id == this.obj.value).country_name;
      } else {
        this.selectedCountry = this.countries_server.find((item) => item.id == 240).country_name;
      }
    }
  },
  data() {
    return {
      selectedCountry: null,
      search: ``,
      countries_server: [],
      countries: []
    }
  },
  computed: {
    countryId() {
      const countryId = this.countries_server.find((item) => item.country_name === this.selectedCountry);

      return countryId ? countryId.id : ` `;
    }
  },
  watch: {
    selectedCountry() {
      this.$emit("update", Object.assign({}, this.obj, {
        value: this.countryId,
        valid: this.obj.regExp.test(this.selectedCountry)
      }))
    }
  },
  methods: {
    applySearchFilter(search, countries) {
      return countries.filter(countries => countries.toLowerCase().startsWith(search.toLowerCase()))
    }
  }
}
</script>
