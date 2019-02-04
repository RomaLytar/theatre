<template>
  <div class="wrap">
    <div class="wrap-user">
      <h1 class="title-main">{{ translation.instructionRecoveryPassword[documentLang] }}</h1>
      <div class="text text--no-centered">
        <p v-for="text in translation.passwordRecoveryText">
          {{ text[documentLang] }}
        </p>
      </div>
    </div>
  </div>
</template>

<script>
  import translation from "../../../mixins/translation"

  export default {
    mixins: [translation]
  }
</script>
