<template>
  <li
    class="menu__item menu__item--child"
    :class="{'active':subMenuOpen}"
    @click="openSecondMenu"
  >
    <a :href="item.url" class="menu__item-name">{{ item.title }}</a>
    <div
      class="menu__second-wrap"
      data-menu-second
      v-if="submenu.length"
    >
      <div class="menu__second-img">
        <p class="menu__second-item-name" data-menu-img>{{ item.title }}</p>
        <img src="/design/img/menu/bg.jpg" alt="">
      </div>
      <ul class="menu__second">
        <li
          v-for="secondItem in item.childrenItems.data"
          :key="secondItem.title"
        >
          <a
            :href="secondItem.url"
            class="menu__item-name"
            :tabindex="formatTabIndex"
          >{{ secondItem.title }}</a>
        </li>
      </ul>
    </div>
  </li>
</template>

<script>
  export default {
    props: {
      item: {
        required: true,
        type: Object
      },
      lastOpenSubmenu: {
        type: [String, Number]
      }
    },
    data() {
      return {
        subMenuOpen: false
      }
    },
    computed: {
      submenu() {
        return this.item.childrenItems.data
      },
      formatTabIndex() {
        return this.subMenuOpen ? 0 : -1;
      }
    },
    methods: {
      openSecondMenu(e) {
        if (this.submenu.length) {
          e.preventDefault();

          if (this.subMenuOpen) {
            this.subMenuOpen = false;
            this.$emit(`secondMenuOpen`, this.subMenuOpen);
          } else {
            this.subMenuOpen = true;
            this.$emit(`secondMenuOpen`, this.subMenuOpen);
          }
        }
      }
    },
    watch: {
      lastOpenSubmenu(val) {
        if (val != this.item.id) {
          this.subMenuOpen = false;
        }
      }
    }
  }
</script>
