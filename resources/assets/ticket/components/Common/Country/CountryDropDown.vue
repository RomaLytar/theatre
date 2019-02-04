<template>
  <country-outside :do="close">
    <div class="select-country" :class="{ 'is-active': isOpen }">
      <button ref="button" @click="open" type="button" class="select-country__btn">
        <span v-if="value !== null">{{ value }}</span>
        <span v-else class="select-country__placeholder">{{ translation.country[documentLang] }}</span>
      </button>
      <div ref="dropdown" v-show="isOpen" class="select-country__dropdown">
        <input class="select-country__input"
          v-model="search"
          ref="search"
          @keydown.esc="close"
          @keydown.up="highlightPrev"
          @keydown.down="highlightNext"
          @keydown.enter.prevent="selectHighlighted"
          @keydown.tab.prevent
          :placeholder="translation.placeholder[documentLang]"
        >
        <ul ref="options" v-show="filteredOptions.length > 0" class="select-country__list">
          <li class="select-country__item"
          v-for="(option, i) in filteredOptions"
          :key="option"
          @click="select(option)"
          :class="{ 'is-active': i === highlightedIndex}"
          >{{ option }}</li>
        </ul>
        <div v-show="filteredOptions.length === 0" class="select-country__empty">{{ translation.resultsNotFound[documentLang] }} "{{ search }}"</div>
      </div>
    </div>
  </country-outside>
</template>

<script>
import CountryOutside from "./CountryOutside"
import Popper from "popper.js"

export default {
  components: {
    CountryOutside
  },
  props: ["value", "options", "filterFunction"],
  data() {
    return {
      isOpen: false,
      search: "",
      highlightedIndex: 0,
      translation: {
        country: {
          ru: `Страна`,
          en: `Country`,
          ua: `Країна`
        },
        placeholder: {
          ru: `Выберите страну`,
          en: `Choose the country`,
          ua: `Виберіть країну`
        },
        resultsNotFound: {
          ru: `Не найдено результатов по`,
          en: `No results found for`,
          ua: `Не знайдено результатів по`
        }
      }
    }
  },
  // beforeDestroy() {
  //   this.popper.destroy();
  // },
  computed: {
    filteredOptions() {
      return this.filterFunction(this.search, this.options);
    },
    documentLang() {
      return this.$store.getters.documentLang
    }
  },
  methods: {
    open() {
      if (this.isOpen) {
        return
      }
      this.isOpen = true;
      this.$nextTick(() => {
        this.setupPopper();
        this.$refs.search.focus();
        this.scrollToHighlighted();
      })
    },
    setupPopper() {
      if (this.popper === undefined) {
        this.popper = new Popper(this.$refs.button, this.$refs.dropdown, {
          placement: "bottom"
        })
      } else {
        this.popper.scheduleUpdate();
      }
    },
    close() {
      if (!this.isOpen) {
        return
      }
      this.isOpen = false;
      this.$refs.button.focus();
    },
    select(option) {
      this.$emit("input", option);
      this.search = "";
      this.highlightedIndex = 0;
      this.close();
    },
    selectHighlighted() {
      this.select(this.filteredOptions[this.highlightedIndex]);
    },
    scrollToHighlighted() {
      this.$refs.options.children[this.highlightedIndex].scrollIntoView({
        block: "nearest"
      });
    },
    highlight(index) {
      this.highlightedIndex = index;

      if (this.highlightedIndex < 0) {
        this.highlightedIndex = this.filteredOptions.length - 1;
      }

      if (this.highlightedIndex > this.filteredOptions.length - 1) {
        this.highlightedIndex = 0;
      }

      this.scrollToHighlighted();
    },
    highlightPrev() {
      this.highlight(this.highlightedIndex - 1);
    },
    highlightNext() {
      this.highlight(this.highlightedIndex + 1);
    }
  }
}
</script>
