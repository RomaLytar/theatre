<template>
  <div class="header__link">
    <Preloader v-if="loading"></Preloader>
    <template v-else>
      <a href="/user" class="header__login">
        <svg width="10" height="10">
          <use xlink:href="#icon-user" />
        </svg>
        <span v-if="user">{{ userEmail }}</span>
        <span v-else>{{ translation.enter[lang] }}</span>
      </a>
      <a href="/logout" class="header__exit" v-if="user" @click="logout">
        <svg width="10" height="10">
          <use xlink:href="#icon-exit" />
        </svg>
        <span>{{ translation.exit[lang] }}</span>
      </a>
    </template>

    <a href="/search" class="header__search">
      <svg width="10" height="10">
        <use xlink:href="#icon-search" />
      </svg>
      Поиск
    </a>
  </div>
</template>

<script>
  import Preloader from "../../../ticket/components/Common/Preloader/Preloader"

  export default {
    components: {
      Preloader
    },
    created() {
      if (!this.user) {
        const token = localStorage.getItem(`token`);

        if (!token) return false;

        this.$store.dispatch(`getUserByToken`);
      }
    },
    computed: {
      loading() {
        return this.$store.getters.loading
      },
      user() {
        return this.$store.getters.user
      },
      userEmail() {

        if (this.user) return this.user.email
      },
      translation() {
        return this.$store.getters.translation
      },
      lang() {
        return this.$store.getters.documentLang
      }
    },
    methods: {
      logout(e) {
        e.preventDefault();

        this.$store.dispatch(`logoutUser`)
          .then(() => this.$router.push({name: `Authorization`}));
      }
    }
  }
</script>


