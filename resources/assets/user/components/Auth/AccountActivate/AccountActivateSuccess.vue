<template>
  <div class="wrap">
    <div class="wrap-user">
      <div v-if="status === 'done'">
        <h1 class="title-main">{{ translation.yourAccountIsActivated[documentLang] }}</h1>
        <div class="text">
          <p>{{ translation.nowYouCan[documentLang] }} <router-link :to="{name: 'Authorization'}" class="link">{{ translation.authorizate[documentLang] }}</router-link></p>
        </div>
      </div>
      <div v-else-if="status === 'activatedBefore'">
        <h1 class="title-main">{{ translation.yourAccountWasActivatedEarly[documentLang] }}</h1>
        <div class="text">
          <p>{{ translation.please[documentLang] }} <router-link :to="{name: 'Authorization'}" class="link">{{ translation.pleaseAuthorizate[documentLang] }}</router-link></p>
        </div>
      </div>
      <div v-else-if="status === 'error'">
        <h1 class="title-main">{{ translation.yourDataIsInvalid[documentLang] }}</h1>
        <div class="text">
          <p>{{ translation.please[documentLang] }} <router-link :to="{name: 'Registration'}" class="link">{{ translation.pleaseRegistration[documentLang] }}</router-link></p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import translation from "../../../mixins/translation"

  export default {
    mixins: [translation],
    mounted() {
      this.$store.dispatch(`activateUser`, {
        user_id: this.user_id,
        token: this.token
      }).then(activate => {
        if (this.$store.getters.activateUser) {
          this.status = activate.status === true ? `done` : `activatedBefore`;
          this.$store.commit(`activateUser`, null);

          setTimeout(() => {
            this.$router.replace({name: `Authorization`})
          }, 3000)
        } else {
          throw new Error()
        }
      }).catch(error => {
        this.status = `error`;
        this.$store.commit(`activateUser`, null);

        setTimeout(() => {
          this.$router.replace({name: `Registration`})
        }, 3000)
      })
    },
    data() {
      return {
        status: `check`,
        user_id: this.$route.params.id,
        token: this.$route.params.token
      }
    }
  }
</script>

