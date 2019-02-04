<template>
  <div class="wrap">
    <div class="wrap-user">
      <h1 class="title-main">{{ translation.yourPasswordChanged[documentLang] }}</h1>
      <div class="text">
        <p>{{ translation.nowYouCan[documentLang] }} {{ translation.authorizate[documentLang] }} <router-link :to="{name: 'Authorization'}" class="link">{{ translation.authorization[documentLang] }}</router-link></p>
      </div>
    </div>
  </div>
</template>

<script>
  import translation from "../../../mixins/translation"

  export default {
    mixins: [translation],
    mounted() {
      setTimeout(() => {
        this.$router.replace({name: `Authorization`})
      }, 3000)
    }
  }
</script>
