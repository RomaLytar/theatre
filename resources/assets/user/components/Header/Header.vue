<template>
  <header class="header" :data-active="menuOpen">
    <HeaderSvg></HeaderSvg>
    <div class="header__wrap">
      <div class="header__inner">
        <div class="header__mobile-wrapper">
          <p class="header__season">Сезон №143</p>
          <a href="/" class="header__logo">
            <img src="/design/img/logo/logo.svg" alt="">
          </a>

          <button
            type="button"
            class="burger"
            @click="openMenu"
          >
            Menu
            <span class="burger__toggle-line burger__toggle-line--1"></span>
            <span class="burger__toggle-line burger__toggle-line--2"></span>
            <span class="burger__toggle-line burger__toggle-line--3"></span>
          </button>

          <Calendar></Calendar>
        </div>
        <div class="header__drop">
          <Menu></Menu>
          <Link></Link>
          <Lang></Lang>
          <Social></Social>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
  import Menu from "./HeaderMenu"
  import Lang from "./HeaderLang"
  import Link from "./HeaderLink"
  import Social from "./HeaderSocial"
  import Calendar from "./HeaderCalendar"
  import HeaderSvg from "./HeaderSvg"

  export default {
    components: {
      Menu,
      Lang,
      Link,
      Social,
      Calendar,
      HeaderSvg
    },
    computed: {
      menuOpen() {
        return this.$store.getters.menuOpen
      }
    },
    methods: {
      openMenu() {
        this.$store.commit(`triggerMenu`)
      }
    }
  }
</script>
