<template>
  <div class="cart">
    <template v-if="getOrderId">
      <Preloader></Preloader>
    </template>
    <template else>
      <CartProgress
        stepActive="2"
      ></CartProgress>
      <div class="cart__wrap">
        <div class="cart__inner">
          <template v-if="paymentError">
            <h1 class="cart__title">{{ translation.failure[documentLang] }}</h1>
            <div class="cart__text">
              <p>{{ translation.failureText[documentLang] }}</p>

              <p><strong>{{ translation.failureTextStrong[documentLang] }}</strong></p>
            </div>
          </template>

          <h1 class="cart__title" :class="titleClassError">{{ translation.contactInformation[documentLang] }}</h1>
          <div class="payment">
            <div class="payment__info">
              <p>{{ userEmail }}</p>
            </div>

            <div class="payment__method">
              <!-- <h3 class="payment__method-title">{{ translation.paymentMethod[documentLang] }}</h3>

              <AuthTrigger
                :options="paymentMethods"
                @user-type-changed="changePaymentMethod"
              ></AuthTrigger> -->

              <form
                method="POST"
                :action="formData[0].action"
                accept-charset="utf-8"
                v-if="formData.length"
                class="visually-hidden"
              >
                <input type="hidden" name="data" :value="formData[0].data"/>
                <input type="hidden" name="signature" :value="formData[0].signature"/>
                <button type="submit" ref="sendForm">Send</button>
              </form>

              <ButtonLoader
                type="button"
                class="btn btn--red btn--lower payment__btn"
                @click="pay"
                :load="paymentAsync"
              >{{ translation.pay[documentLang] }}</ButtonLoader>
            </div>
          </div>
        </div>
        <aside class="cart__aside">
          <CartAside
            v-if="showTicketsPopup"
            :payment="true"
            :btnVisible="false"
            @pay="pay"
            :load="paymentAsync"
          ></CartAside>
        </aside>
        <TicketBottom
          :ticketsCount="allTicketCount"
          @open-tickets="openTickets"
        ></TicketBottom>
      </div>
    </template>
  </div>
</template>

<script>
  import TicketBottom from "../Common/TicketBottom/TicketBottom"
  import ButtonLoader from "../Common/ButtonLoader/ButtonLoader"
  import CartProgress from "../Common/CartProgress/CartProgress"
  import CartAside from "../Common/CartAside/CartAside"
  import AuthTrigger from "../Authorization/AuthTrigger/AuthTrigger"
  import Preloader from "../Common/Preloader/Preloader"
  import cartMixin from "../../mixins/cart-mixin"

  export default {
    components: {
      CartProgress,
      CartAside,
      AuthTrigger,
      TicketBottom,
      ButtonLoader,
      Preloader
    },
    mixins: [cartMixin],
    created() {
      if (this.windowWidth <= 768) this.showTicketsPopup = false;

      const order_id = localStorage.getItem(`orderId`);

      this.getOrderId = true;

      if (!order_id) {
        this.$store.dispatch(`getOrderId`, {
            authorization: this.user.id ? true : false,
            user_id: this.user.id ? this.user.id : null,
            email:  this.user.email,
            tickets: this.perfomanceInCart.map(item => item.data.tickets.data.map(ticket => ticket.id).join(",")).join(",").split(",")
          }).then(data => {
            const order_id = data.order_id;
            this.$store.commit(`setOrderId`, order_id);

            this.$store.dispatch(`getFormDataForPayment`, order_id)
              .then(data => this.getOrderId = false)
              .catch(err => console.warn(err));
          })
          .catch(err => {
            this.getOrderId = false;
            console.warn(err);
          })
      } else {
        this.$store.commit(`setOrderId`, order_id);
        this.$store.dispatch(`getFormDataForPayment`, order_id)
              .then(data => this.getOrderId = false)
              .catch(err => console.warn(err));

        if (this.$route.query.payment == `error`) {
          this.paymentError = true;
        }
      }
    },
    data() {
      return {
        showTicketsPopup: true,
        paymentMethod: `privat24`,
        paymentError: false,
        paymentAsync: false,
        getOrderId: false,
        translation: {
          failure: {
            ru: `Отказ!`,
            en: `Failure!`,
            ua: `Відмова!`
          },
          failureText: {
            ru: `Оплата билетов не произведена. Проверьте правильность своих действий или обратитесь в банк-эмитент Вашей карты за дополнительной информацией`,
            en: `Payment of tickets is not made. Check the correctness of your actions or contact your card issuing bank for more information`,
            ua: `Оплата квитків не проведена. Перевірте правильність своїх дій або зверніться в банк-емітент Вашої картки за додатковою інформацією`
          },
          failureTextStrong: {
            ru: `Вы можете попробовать еще раз`,
            en: `You can try again`,
            ua: `Ви можете спробувати ще раз`
          },
          contactInformation: {
            ru: `Контактная информация`,
            en: `Contact Information`,
            ua: `Контактна інформація`
          },
          paymentMethod: {
            ru: `Выберите способ оплаты`,
            en: `Select a payment method`,
            ua: `Виберіть спосіб оплати`
          },
          paymentPrivat: {
            ru: `Приват24`,
            en: `Privat24`,
            ua: `Приват24`
          },
          paymentLiqpay: {
            ru: `Кошелек LiqPay`,
            en: `LiqPay Wallet`,
            ua: `Гаманець LiqPay`
          },
          pay: {
            ru: `Оплатить`,
            en: `To pay`,
            ua: `Сплатити`
          }
        }
      }
    },
    methods: {
      pay() {
        this.paymentAsync = true;
        this.$refs.sendForm.click();
      },
      changePaymentMethod(method) {
        this.paymentMethod = method;
      },
      openTickets(event) {
        this.showTicketsPopup = event;
      }
    },
    computed: {
      windowWidth() {
        return this.$store.getters.windowWidth
      },
      allTicketCount() {
        return this.perfomanceInCart.reduce((sum, perfomance) => {
          return sum + perfomance.data.tickets.data.length
        }, 0);
      },
      documentLang() {
        return this.$store.getters.documentLang
      },
      user() {
        return this.$store.getters.user
      },
      userEmail() {
        if (this.user.email) return this.user.email;

        return localStorage.getItem(`paymentAuthUserEmail`)
      },
      titleClassError() {
        return {
          'cart__title--small': this.paymentError
        }
      },
      paymentMethods() {
        return [
          {
            value: `privat24`,
            text: this.translation.paymentPrivat[this.documentLang]
          },
          {
            value: `liqpay`,
            text: this.translation.paymentLiqpay[this.documentLang]
          }
        ]
      },
      formData() {
        return this.$store.getters.formData
      }
    }
  }
</script>
