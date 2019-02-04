<template>
  <div class="cart">
    <template v-if="loading || !userToken">
      <Preloader></Preloader>
    </template>
    <div class="cart__wrap" v-else>
      <div class="cart__inner">
        <h1 class="cart__title">{{ translation.auth[documentLang] }}</h1>
        <AuthTrigger
          :options="userTypesConfig"
          :default="userType"
          @user-type-changed="userTypeChanged"
        ></AuthTrigger>

        <Form :authType="userType"></Form>
      </div>
      <aside class="cart__aside cart__aside--top">
        <CartAside
          :btnVisible="false"
          v-if="showTicketsPopup"
        ></CartAside>
      </aside>
      <TicketBottom
        :ticketsCount="allTicketCount"
        @open-tickets="openTickets"
      ></TicketBottom>
    </div>
  </div>
</template>

<script>
  import TicketBottom from "../Common/TicketBottom/TicketBottom"
  import Preloader from "../Common/Preloader/Preloader"
  import CartAside from "../Common/CartAside/CartAside"
  import Form from "../Common/Form/Form"
  import AuthTrigger from "./AuthTrigger/AuthTrigger"
  import cartMixin from "../../mixins/cart-mixin"

  export default {
    components: {
      Preloader,
      CartAside,
      AuthTrigger,
      Form,
      TicketBottom
    },
    mixins: [cartMixin],
    created() {
      if (this.windowWidth <= 768) this.showTicketsPopup = false;

      const token = this.$store.getters.token || localStorage.getItem(`token`);

      if (token) {
        this.$store.dispatch(`getUserByToken`, token).then(() => {
          this.$router.replace({name: `Payment`})
        })
        .catch((err) => {
          this.userToken = true;
          this.userType = `reg`;
        })
      } else {
        this.userToken = true;
      }
    },
    data() {
      return {
        showTicketsPopup: true,
        translation: {
          auth: {
            ru: `Авторизация`,
            en: `Authorization`,
            ua: `Авторизація`
          },
          newUser: {
            ru: `Я новый пользователь`,
            en: `I am a new user`,
            ua: `Я новий користувач`
          },
          regUser: {
            ru: `Я зарегистрированный пользователь`,
            en: `I am a registered user`,
            ua: `Я зареєстрований користувач`
          }
        },
        userToken: false,
        userType: `new`
      }
    },
    methods: {
      userTypeChanged(userType) {
        this.userType = userType;
      },
      openTickets(event) {
        this.showTicketsPopup = event;
      }
    },
    computed: {
      windowWidth() {
        return this.$store.getters.windowWidth
      },
      loading() {
        return this.$store.getters.loading
      },
      documentLang() {
        return this.$store.getters.documentLang
      },
      allTicketCount() {
        return this.perfomanceInCart.reduce((sum, perfomance) => {
          return sum + perfomance.data.tickets.data.length
        }, 0);
      },
      userTypesConfig() {
        return [{
          value: `new`,
          text: this.translation.newUser[this.documentLang]
        },
        {
          value: `reg`,
          text: this.translation.regUser[this.documentLang]
        }]
      }
    }
  }
</script>
