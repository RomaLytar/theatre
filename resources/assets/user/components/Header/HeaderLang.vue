<template>
  <div class="lang">
    <form
      method="POST"
      action="/language/change"
      class="visually-hidden"
      ref="langForm"
    >
      <input name="_token" type="hidden" value="TThBvSZc0MfZigmvkitj6Ii1Sbyfnqp1SYPNLNiH">
      <select name="locale" ref="langSelect">
        <option
          v-for="item in lang"
          :value="item.name.toLowerCase()"
          :key="item.name"
          :selected="item.selected"
        >{{ item.name }}</option>
      </select>
    </form>
    <ul class="lang__list">
      <li
        v-for="(item, i) in lang"
        :key="item.name"
        :class="{'lang__list-active': item.selected}"
      >
        <a
          :href="item.name.toLowerCase()"
          @click.prevent="langChange(item, i)"
        >{{ item.name }}
        </a>
      </li>
    </ul>
  </div>
</template>

<script>
  export default {
    created() {
      const lang = document.documentElement.getAttribute(`lang`).toLowerCase();

      this.lang.find(item => item.name.toLowerCase() == lang).selected = true;
    },
    data() {
      return {
        lang: [
          {
            name: `En`,
            selected: false
          },
          {
            name: `Ru`,
            selected: false
          },
          {
            name: `Ua`,
            selected: false
          }
        ]
      }
    },
    methods: {
      langChange(item, i) {
        if (!item.selected) {
          this.$refs.langSelect.selectedIndex = i;
          this.$refs.langForm.submit();
        }
      }
    }
  }
</script>
