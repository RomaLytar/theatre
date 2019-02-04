<template>
  <button
    type="button"
    class="ticket-bottom"
    :data-open="openedTickets"
    @click="openTickets"
  >
    <span class="ticket-bottom__cart">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 65.1 57.3" width="22" height="22" fill="#fff">
        <path d="M46.5,44.5c-3.5,0-6.4,2.9-6.4,6.4c0,3.5,2.9,6.4,6.4,6.4c3.5,0,6.4-2.9,6.4-6.4C52.9,47.4,50,44.5,46.5,44.5z M46.5,54.5
        c-2,0-3.5-1.6-3.5-3.5c0-2,1.6-3.5,3.5-3.5c2,0,3.5,1.6,3.5,3.5C50,52.9,48.5,54.5,46.5,54.5z"/>
        <path d="M63.6,9H12.7l-0.9-3.6C11.1,2.2,8.2,0,4.9,0H1.4C0.6,0,0,0.6,0,1.4c0,0.8,0.6,1.4,1.4,1.4h3.5
        c1.9,0,3.6,1.3,4.1,3.2l7,28.5c0.8,3.2,3.6,5.4,6.9,5.4h29.8c3.3,0,6.2-2.3,6.9-5.5L65,10.8c0.1-0.4,0-0.9-0.3-1.2
        C64.5,9.2,64.1,9,63.6,9z M56.8,33.8c-0.4,1.9-2.2,3.3-4.1,3.2H22.9c-1.9,0-3.6-1.3-4.1-3.2l-5.4-21.9h48.4L56.8,33.8z"/>
        <path d="M27.1,44.5c-3.5,0-6.4,2.9-6.4,6.4c0,3.5,2.9,6.4,6.4,6.4c3.5,0,6.4-2.9,6.4-6.4C33.5,47.4,30.6,44.5,27.1,44.5z M27.1,54.5
        c-2,0-3.5-1.6-3.5-3.5c0-2,1.6-3.5,3.5-3.5c2,0,3.5,1.6,3.5,3.5C30.6,52.9,29,54.5,27.1,54.5z"/>
      </svg>
    </span>
    <span class="ticket-bottom__text">
      {{ translation.yourTickets[documentLang] }}
      {{ ticketsCount }}
    </span>
    <ArrowDown
      width="16"
      height="10"
      fill="#fff"
      class="ticket-bottom__arrow"
    ></ArrowDown>
  </button>
</template>

<script>
  import ArrowDown from "../ArrowDown/ArrowDown"

  export default {
    components: {
      ArrowDown
    },
    props: {
      ticketsCount: {
        required: true,
        type: [String, Number]
      }
    },
    data() {
      return {
        openedTickets: false,
        translation: {
          yourTickets: {
            ru: `Ваши билеты`,
            en: `Your tickets`,
            ua: `Вашi квитки`
          }
        }
      }
    },
    computed: {
      documentLang() {
        return this.$store.getters.documentLang
      }
    },
    methods: {
      openTickets() {
        this.openedTickets = !this.openedTickets;
        this.$emit(`open-tickets`, this.openedTickets);
      }
    }
  }
</script>
