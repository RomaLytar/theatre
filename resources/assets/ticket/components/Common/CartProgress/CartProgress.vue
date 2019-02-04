<template>
  <section class="cart-progress">
    <ul class="cart-progress__steps">
      <li
        class="cart-progress__step"
        v-for="(step, key, index) in steps"
        :key="key"
        :class="{'active': index + 1 == stepActive}"
      >
        {{ step[documentLang] }}
      </li>
    </ul>
  </section>
</template>

<script>
  export default {
    props: {
      stepActive: {
        required: true,
        type: [Number, String]
      }
    },
    data() {
      return {
        steps: {
          cartView: {
            ru: `Просмотр корзины`,
            en: `View Cart`,
            ua: `Переглянути кошик`
          },
          payment: {
            ru: `Оплата`,
            en: `Payment`,
            ua: `Оплата`
          },
          paymentEnd: {
            ru: `Завершение покупки`,
            en: `Completion of the purchase`,
            ua: `Завершення покупки`
          }
        }
      }
    },
    computed: {
      documentLang() {
        return this.$store.getters.documentLang
      }
    }
  }
</script>
