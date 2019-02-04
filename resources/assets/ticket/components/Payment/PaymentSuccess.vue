<template>
  <div class="cart">
    <CartProgress
      stepActive="3"
    ></CartProgress>
    <div class="cart__wrap">
      <div class="cart__inner">
        <h1 class="cart__title">{{ translation.thanks[documentLang] }}</h1>
        <div class="cart__text cart__text--together">
          <p
            v-for="text in translation.thanksText"
            :key="text.en"
          >{{ text[documentLang] }}</p>
        </div>

        <a href="/" class="cart__link">{{ translation.toMainPage[documentLang] }}</a>
      </div>
      <aside class="cart__aside">
        <CartAsideTickets  v-if="showTicketsPopup"></CartAsideTickets>
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
  import CartProgress from "../Common/CartProgress/CartProgress"
  import CartAsideTickets from "../Common/CartAside/CartAsideTickets"

  export default {
    components: {
      CartProgress,
      CartAsideTickets,
      TicketBottom
    },
    data() {
      return {
        showTicketsPopup: true,
        translation: {
          thanks: {
            ru: `Спасибо!`,
            en: `Thanks!`,
            ua: `Дякуємо!`
          },
          toMainPage: {
            ru: `На главную`,
            en: `To main`,
            ua: `На головну`
          },
          thanksText: [
            {
              ru: `На Ваш электронный почтовый ящик выслано письмо с электронным билетом.`,
              en: `An email with an electronic ticket has been sent to your email inbox.`,
              ua: `На Вашу електронну поштову скриньку надіслано листа з електронним квитком.`
            },
            {
              ru: `Распечатайте его на белом листе бумаги. Штрих-код должен быть отчётливым.`,
              en: `Print it on a white sheet of paper. Barcode must be distinct.`,
              ua: `Роздрукуйте його на білому аркуші паперу. Штрих-код повинен бути виразним.`
            },
            {
              ru: `Или используйте электронную версию билетов в Вашем смартфоне.`,
              en: `Or use the electronic version of tickets in your smartphone.`,
              ua: `Або використовуйте електронну версію квитків у Вашому смартфоні.`
            },
            {
              ru: `Просим не удалять это письмо до окончания мероприятия.`,
              en: `Please do not delete this letter until the end of the event.`,
              ua: `Просимо не видаляти цей лист до закінчення заходу.`
            }
          ]
        }
      }
    },
    created() {
      if (this.windowWidth <= 768) this.showTicketsPopup = false;

      if (!this.perfomanceInCart.length) {
        this.$store.commit(`ticketsHash`, localStorage.getItem(`ticketHash`));
        this.$store.dispatch(`addTicketsSuccessFromLocalStorage`);
        localStorage.removeItem(`orderId`);
      }
    },
    computed: {
      perfomanceInCart() {
        return this.$store.getters.ticketsSuccess
      },
      windowWidth() {
        return this.$store.getters.windowWidth
      },
      documentLang() {
        return this.$store.getters.documentLang
      },
      allTicketCount() {
        return this.perfomanceInCart.reduce((sum, perfomance) => {
          return sum + perfomance.data.tickets.data.length
        }, 0);
      }
    },
    methods: {
      openTickets(event) {
        this.showTicketsPopup = event;
      }
    }
  }
</script>
