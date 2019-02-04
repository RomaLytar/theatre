<template>
  <div class="form__field">
    <div class="form__field-left">
      <div class="form__label">
        <country-drop-down
          v-model="selectedCountry"
          :options="countries"
          :filter-function="applySearchFilter"
        ></country-drop-down>
        <span class="form__label-text" data-active>
          <slot></slot>
        </span>
      </div>
    </div>
    <div class="form__field-right">
      <span class="form-field__required">{{ translation.optional[documentLang] }}</span>
    </div>
  </div>
</template>

<script>
  import CountryDropDown from './CountryDropDown'
  import translation from "../../mixins/translation"

  export default {
    props: [`obj`],
    mixins: [translation],
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
