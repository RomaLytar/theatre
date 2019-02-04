<template>
  <nav class="menu" :class="{'active':secondMenu.open}">
    <ul class="menu__list">
      <MenuItem
        v-for="item in menu"
        :key="item.id"
        :item="item"
        @secondMenuOpen="secondMenuOpen(item.id, $event)"
        :lastOpenSubmenu="secondMenu.key"
      ></MenuItem>
    </ul>
  </nav>
</template>

<script>
  import MenuItem from "./HeaderMenuItem";

  export default {
    components: {
      MenuItem
    },
    created() {
      this.$store.dispatch(`getMenu`)
    },
    computed: {
      menu() {
        return this.$store.getters.menu
      },
      menuOpen() {
        return this.$store.getters.menuOpen
      }
    },
    data() {
      return {
        secondMenu: {
          key: null,
          open: false
        }
      }
    },
    methods: {
      secondMenuOpen(key, event) {
        this.secondMenu = {
          key,
          open: event
        }
      }
    },
    watch: {
      menuOpen(val) {
        if (val) {
          document.body.style.overflow = `hidden`;
        } else {
          document.body.style.overflow = ``;
        }
      },
      secondMenu: {
        handler(val) {
          if (val.open) {
            document.body.style.overflow = `hidden`;
          } else {
            if (!this.menuOpen) {
              document.body.style.overflow = ``;
            }
          }
        },
        deep: true
      }
    }
  }
</script>
