<template>
  <div class="cart-perfomance">
    <ul class="cart-perfomance__list">
      <CartPerfomanceItem
        v-for="perfomance in perfomanceInCart"
        :performance="perfomance"
        :key="perfomance.data.id"
        :above="above"
      ></CartPerfomanceItem>
    </ul>
    <p class="cart-perfomance__total">
      <span class="cart-perfomance__total-name">{{ translation.total[documentLang] }}</span>
      <span class="cart-perfomance__currency">{{ ticketsInCartTotalPrice }}</span>
    </p>
    <template v-if="above">
      <p
        class="cart-perfomance__available-text"
        v-if="ticketsAvailable"
      >{{ translation.seatAvailable[documentLang] }}</p>
      <ButtonLoader
        class="btn btn--red btn--lower cart-perfomance__btn"
        v-if="!btnAddToCart"
        @click="checkTicketsAvailability"
        :load="checked"
      >{{ translation.checkAvailable[documentLang] }}</ButtonLoader>
      <ButtonLoader
        type="button"
        class="btn btn--red btn--lower cart-perfomance__btn"
        :load="addToMainCart"
        v-else="btnAddToCart"
        @click="addToCart"
      >{{ translation.addToCart[documentLang] }}</ButtonLoader>
    </template>
  </div>
</template>

<script>
  import ButtonLoader from "../Common/ButtonLoader/ButtonLoader"
  import CartPerfomanceItem from "./CartPerfomanceItem"

  export default {
    components: {
      CartPerfomanceItem,
      ButtonLoader
    },
    props: {
      perfomanceInCart: {
        required: true,
        type: Array
      },
      above: {
        type: Boolean,
        default: false
      }
    },
    data() {
      return {
        ticketsAvailable: false,
        btnAddToCart: false,
        checked: false,
        addToMainCart: false,
        translation: {
          total: {
            ru: `Всего`,
            en: `Total`,
            ua: `Всього`
          },
          seatAvailable: {
            ru: `Места доступны!`,
            en: `Places are available!`,
            ua: `Місця доступні!`
          },
          checkAvailable: {
            ru: `Проверить доступность`,
            en: `Check availability`,
            ua: `Перевірити доступність`
          },
          addToCart: {
            ru: `Добавить в корзину`,
            en: `Add to cart`,
            ua: `Додати в кошик`
          }
        }
      }
    },
    computed: {
      ticketsInCartLength() {
        return this.perfomanceInCart.length
      },
      ticketsInCartTotalPrice() {
        return this.perfomanceInCart.reduce((sum, perfomance) => {
          return sum + perfomance.data.tickets.data.reduce((sum, ticket) => {
            return sum + ticket.seatPrice.data.price
          }, 0)
        }, 0)
      },
      documentLang() {
        return this.$store.getters.documentLang
      }
    },
    methods: {
      checkTicketsAvailability() {
        this.checked = true;

        const tickets = this.$store.getters.cartAbove.map(item => item.data.tickets.data.map(ticket => ticket.id).join(`,`)).join(`,`).split(`,`);

        this.$store.dispatch(`checkTicketsAvailability`, {tickets})
             .then(data => {
                if (!data.data.some(item => !item.isAvailable)) {
                  this.ticketsAvailable = true;
                  this.btnAddToCart = true;
                } else {
                  this.$store.commit(`removeAllTicketsAboveFromCart`)
                }
             });

        this.checked = false;
      },
      addToCart() {
        this.addToMainCart = true;

        this.$store.dispatch(`addTicketToCartFromAboveCart`)
            .catch(err => {
              this.$store.commit(`removeAllTicketsAboveFromCart`)
            });

        this.addToMainCart = false;
      }
    }
  }
</script>
