<template>
  <section class="ticket-choose-counter">
    <h3 class="ticket-choose-counter__title"> {{ translation.ticketsCount[documentLang] }}</h3>
    <ul class="ticket-choose-counter__list">
      <li v-for="n in ticketsLength">
        <button
          class="ticket-choose-counter__btn"
          type="button"
          :data-active="activeBtn === n"
          @click="chooseTicketCount(n)"
        >{{ n }}</button>
      </li>
      <li v-if="moreVisible">
        <button
          class="ticket-choose-counter__btn"
          type="button"
          @click="chooseTicketCount(Infinity)"
        >{{ ticketsMore }}</button>
      </li>
    </ul>
    <Popup
      v-if="popupOpen"
      class="ticket-choose-counter__popup"
      @popup-close="popupOpen = false"
    >
      <h2 class="ticket-choose-counter__popup-title">{{ translation.orderMoreTenTickets[documentLang] }}</h2>
      <div class="ticket-choose-counter__popup-descr">
        <p
          v-for="text in translation.specialConditions"
          :key="text.en"
        >
          {{ text[documentLang] }}
        </p>
      </div>
      <a href="tel:+80997777777" class="ticket-choose-counter__popup-link">0997777777</a>
    </Popup>
  </section>
</template>

<script>
  import Popup from "../Popup/Popup"

  export default {
    props: {
      tickets: {
        type: [Number, String],
        required: true
      }
    },
    data() {
      return {
        popupOpen: false,
        activeBtn: null,
        ticketsMore: `+`,
        translation: {
          ticketsCount: {
            ru: `Количество билетов`,
            en: `Number of tickets`,
            ua: `Кількість квитків`
          },
          orderMoreTenTickets: {
            ru: `При заказе 10 и более билетов`,
            en: `When ordering 10 or more tickets`,
            ua: `При замовленні 10 і більше квитків`
          },
          specialConditions: [
            {
              ru: `действуют специальные условия`,
              en: `special conditions apply`,
              ua: `діють спеціальні умови`
            },
            {
              ru: `обратитесь по телефону`,
              en: `call by phone`,
              ua: `зверніться по телефону`
            }
          ],

        }
      }
    },
    components: {
      Popup
    },
    computed: {
      moreVisible() {
        return this.tickets > 9 ? true : false
      },
      ticketsLength() {
        return this.tickets > 9 ? 9 : this.tickets
      },
      documentLang() {
        return this.$store.getters.documentLang
      }
    },
    methods: {
      chooseTicketCount(n) {
        if (n >= 10) {
          this.popupOpen = true;
          this.activeBtn = null;
          this.$emit(`active-choose`, null);
        } else {
          this.activeBtn = n;
          this.$emit(`active-choose`, n);
        }
      }
    }
  }
</script>
