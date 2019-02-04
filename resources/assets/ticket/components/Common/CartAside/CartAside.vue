<template>
  <section class="cart-aside">
    <h2 class="cart-aside__title">{{ translation.cart[documentLang] }}</h2>
    <div class="cart-aside__list-wrap">
      <ul class="cart-aside__list" v-if="ticketsInCartLength">
        <CartAsideItem
          v-for="performance in performanceInCart"
          :performance="performance"
          :key="performance.data.id"
        ></CartAsideItem>
      </ul>

      <p
        v-else
        class="cart-aside__list-empty"
      >{{ translation.cartEmpty[documentLang] }}</p>
    </div>

    <p class="cart-aside__total">
      <span>{{ translation.total[documentLang] }}</span>
      <span>{{ ticketsInCartTotalPrice }} {{ translation.currency[documentLang] }}</span>
    </p>
    <template v-if="btnVisible">
      <router-link
        class="btn btn--red cart-aside__btn-pay"
        v-if="ticketsInCartLength"
        tag="button"
        :to="{ name: 'Authorization'}"
      >{{ translation.goToPayment[documentLang] }}</router-link>
      <a
        class="btn btn--link"
        href="/calendar#/events?"
      >{{ translation.continueShopping[documentLang] }}</a>
    </template>
    <template v-if="payment">
      <ButtonLoader
        class="btn btn--red btn--lower"
        v-if="ticketsInCartLength"
        @click="$emit(`pay`)"
        :load="load"
      >{{ translation.payment[documentLang] }}</ButtonLoader>
    </template>
  </section>
</template>

<script>
  import CartAsideItem from "./CartAsideItem";
  import ButtonLoader from "../ButtonLoader/ButtonLoader";

  export default {
    props: {
      btnVisible: {
        type: Boolean,
        default: true
      },
      payment: {
        type: Boolean,
        default: false
      },
      load: {
        type: Boolean,
        default: false
      }
    },
    components: {
      CartAsideItem,
      ButtonLoader
    },
    data(){
      return {
        translation: {
          cart: {
            ru: `Корзина`,
            en: `Cart`,
            ua: `Кошик`
          },
          cartEmpty: {
            ru: `В вашей корзине пусто`,
            en: `Your cart is empty`,
            ua: `Ваш кошик порожнiй`
          },
          currency: {
            ru: `грн.`,
            en: `uah`,
            ua: `грн.`
          },
          goToPayment: {
            ru: `Перейти к оплате`,
            en: `Go to the payment`,
            ua: `Перейти до оплати`
          },
          continueShopping: {
            ru: `Продолжить покупки`,
            en: `Continue shopping`,
            ua: `Продовжити покупки`
          },
          payment: {
            ru: `Оплатить`,
            en: `To pay`,
            ua: `Сплатити`
          },
          total: {
            ru: `Всего`,
            en: `Total`,
            ua: `Всього`
          }
        }
      }
    },
    computed: {
      performanceInCart() {
        return this.$store.getters.cartTickets
      },
      ticketsInCartLength() {
        return this.performanceInCart.length
      },
      ticketsInCartTotalPrice() {
        return this.$store.getters.cartTickets.reduce((sum, performance) => {
          return sum + performance.data.tickets.data.reduce((sum, ticket) => {
            return sum + ticket.seatPrice.data.price
          }, 0)
        }, 0)
      },
      documentLang() {
        return this.$store.getters.documentLang
      }
    }
  }
</script>
