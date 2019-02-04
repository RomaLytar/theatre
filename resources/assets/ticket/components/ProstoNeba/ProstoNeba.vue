<template>
  <div class="perfomance">
    <header class="perfomance__header">
      <h1 class="perfomance__title">
        {{ perfomanceInfo.performance.data.title }}
        <Back class="back--left"></Back>
      </h1>
      <div class="perfomance__info">
        <p>{{ perfomanceInfo.hall.data.title }}</p>
        <p>{{ getDate }} {{ getHours | addZero }}:{{ getMinutes | addZero }}</p>
      </div>
      <div class="perfomance__header-descr">
        <p>{{ translations.chooseDate[documentLang] }}</p>
      </div>
    </header>

    <div class="perfomance__alone-btn">
      <DateChange
        :date="perfomanceInfo.date"
        :dateList="perfomanceDates"
        :showCurrentDate="false"
      ></DateChange>
    </div>

    <TicketChooseCounter
      :tickets="availableSeatsLength"
      @active-choose="tickets = $event"
    ></TicketChooseCounter>

    <p class="perfomance__available">{{ availableSeatsLength }} {{ translations.availableSeats[documentLang] }}</p>

    <ButtonLoader
      class="btn btn--red btn--long"
      :disabled="!tickets"
      :load="checkSeatAvailable"
      @click="addToCart"
    >{{ translations.addToCart[documentLang] }}</ButtonLoader>

    <Popup
      v-if="seatNotAvailable"
      @popup-close="seatNotAvailable = false"
    >
      <AvailablePopup @popup-close="seatNotAvailable = false">
        <template slot="header">{{ translations.seatsError[documentLang] }}</template>
      </AvailablePopup>
    </Popup>
  </div>
</template>

<script>
  import dateFormat from "../../mixins/date-format"
  import Back from "../Common/Back/Back"
  import DateChange from "../Common/DateChange/DateChange"
  import TicketChooseCounter from "../Common/TicketChooseCounter/TicketChooseCounter"
  import Popup from "../Common/Popup/Popup"
  import AvailablePopup from "../Common/AvailablePopup/AvailablePopup"
  import ButtonLoader from "../Common/ButtonLoader/ButtonLoader"

  export default {
    mixins: [dateFormat],
    components: {
      Back,
      DateChange,
      TicketChooseCounter,
      Popup,
      AvailablePopup,
      ButtonLoader
    },
    created() {
      const filteredArr = this.$store.getters.perfomancePrices.filter((a, b) => {
        if (a > b) return 1;
        return -1;
      });

      this.$store.commit(`perfomanceFilterPrices`, {
        min: filteredArr[0],
        max: filteredArr[filteredArr.length - 1]
      })
    },
    data() {
      return {
        disabledBtn: true,
        seatNotAvailable: false,
        tickets: ``,
        checkSeatAvailable: false,
        translations: {
          chooseDate: {
            ru: `Выберите дату, необходимое количество мест и нажмите "Добавить в корзину"`,
            en: `Select the date, the required number of places and click "Add to cart"`,
            ua: `Виберіть дату, необхідну кількість місць та натисніть "Додати в кошик"`
          },
          availableSeats: {
            ru: `мест доступно`,
            en: `places available`,
            ua: `місць є`
          },
          addToCart: {
            ru: `Добавить в корзину`,
            en: `Add to cart`,
            ua: `Додати в кошик`
          },
          seatsError: {
            ru: `В заданном количестве доступных мест нет`,
            en: `There are no available places in the specified number.`,
            ua: `У заданій кількості доступних місць немає`
          }
        }
      }
    },
    methods: {
      addToCart() {
        this.checkSeatAvailable = true;

        this.$store.dispatch(`checkTicketsAvailableProstoNebo`, {
            meta: this.perfomanceInfo.id,
            payload: {
              count: this.tickets
            }
          }).then(data => {
            this.checkSeatAvailable = false;

            if (data.reservedTickets) {
              const reservedTickets = data.reservedTickets.data,
                    reservedTime = reservedTickets[0].reserved_time * 1000,
                    reservedTicketsId = reservedTickets.map(item => item.ticket_id);

              window.localStorageCart.addTickets({
                reserved_time: reservedTime,
                perfomances: [
                  {
                    id: this.perfomanceInfo.id,
                    date: this.perfomanceInfo.date,
                    tickets: reservedTicketsId
                  }
                ]
              });

              this.$router.push({name: `Cart`})
            } else {
              throw data;
            }
          }).catch(err => {
            this.seatNotAvailable = true;
            this.$store.dispatch(`getPerfomanceData`, this.$route.params.id);
          })
      }
    },
    computed: {
      dateForFormat() {
        return this.perfomanceInfo.date
      },
      perfomanceInfo() {
        return this.$store.getters.perfomanceInfo
      },
      perfomanceDates() {
        return this.$store.getters.perfomanceDates
      },
      availableSeats() {
        return this.$store.getters.availableFilteredNotCartSeats
      },
      availableSeatsLength() {
        return this.availableSeats.length
      },
      documentLang() {
        return this.$store.getters.documentLang
      }
    }
  }
</script>
