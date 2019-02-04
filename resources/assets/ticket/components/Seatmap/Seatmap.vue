<template>
  <div class="perfomance">
    <header class="perfomance__header">
      <h1 class="perfomance__title">
        {{ perfomanceInfo.performance.data.title }}
        <!-- <Back class="back--left"></Back> -->
      </h1>
      <div class="perfomance__info">
        <p>{{ perfomanceInfo.hall.data.title }}</p>
        <p>{{ getDate }} {{ getHours | addZero }}:{{ getMinutes | addZero }}</p>
      </div>
      <div class="perfomance__header-descr">
        <p>{{ translation.chooseSeats[documentLang] }}</p>
      </div>
    </header>
    <div class="perfomance__body">
      <div class="perfomance__scheme">
        <div class="perfomance__seats">
          <SchemeSeatMap
            :src="schemeSrc"
            :zoom="zoom"
            ref="scheme"
            @seat-hover="seatHoverOnMap"
            @add-ticket-to-cart="filterOpen = false"
            @too-much-tickets="tooMuchTicketsPopup = true"
          ></SchemeSeatMap>
          <SchemeSeatHint
            :config="seatHover"
            :scheme="$refs.scheme"
            v-if="seatHover.visible"
          ></SchemeSeatHint>
          <SchemeControls @change="schemeZoomChange"></SchemeControls>
        </div>
        <div class="perfomance__scheme-info">
          <Legend class="perfomance__scheme-legend"></Legend>
          <div class="perfomance__scheme-center">
            <p class="perfomance__available">{{ availableSeatsLength }} {{ translation.availableSeats[documentLang] }}</p>
          </div>
          <SchemeSectorFilter
            class="perfomance__scheme-filter"
            v-if="bigSchemeIs"
            :scheme="sectorListForPanel"
            @show-all="showAll"
            @change-sector="changeSector"
          ></SchemeSectorFilter>
        </div>
      </div>
      <div class="perfomance__filter">
        <AppFilter
          :dateChangeVisible="!bigSchemeIs"
          :filterOpen="filterOpen"
          :filterBtnVisible="true"
          @filter-trigger="filterOpen = !filterOpen"
        ></AppFilter>
        <SchemeTickets
          v-if="!filterOpen && (showTicketsPopup && ticketsInCartLength)"
          @check-tickets-available="checkTicketsAvailable"
          :check="check"
        ></SchemeTickets>
      </div>
    </div>
    <Popup
      v-if="seatNotAvailablePopup"
      @popup-close="seatNotAvailablePopupTrigger"
    >
      <AvailablePopup
        class="available-popup--big"
        :tickets="notAvailableTickets"
        @popup-close="seatNotAvailablePopupTrigger"
      >
        <template slot="header">{{ translation.chooseSeatsNotAvailable[documentLang] }}</template>
      </AvailablePopup>
    </Popup>
    <Popup
      v-if="tooMuchTicketsPopup"
      class="ticket-choose-counter__popup"
      @popup-close="tooMuchTicketsPopup = false"
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
    <TicketBottom
      v-if="ticketsInCartLength"
      :ticketsCount="ticketsInCart.length"
      @open-tickets="openTickets"
    ></TicketBottom>
  </div>
</template>

<script>
  import dateFormat from "../../mixins/date-format"
  import Back from "../Common/Back/Back"
  import Popup from "../Common/Popup/Popup"
  import AvailablePopup from "../Common/AvailablePopup/AvailablePopup"
  import AppFilter from "../Common/Filter/Filter"
  import SchemeSector from "../Common/SchemeSector/SchemeSector"
  import Legend from "../Common/Legend/Legend"
  import SchemeSectorFilter from "../Common/SchemeSectorFilter/SchemeSectorFilter"
  import SchemeControls from "../Common/SchemeControls/SchemeControls"
  import SchemeSeatMap from "../Common/SchemeSeatMap/SchemeSeatMap"
  import SchemeTickets from "../Common/SchemeTickets/SchemeTickets"
  import SchemeSeatHint from "../Common/SchemeSeatHint/SchemeSeatHint"
  import TicketBottom from "../Common/TicketBottom/TicketBottom"

  export default {
    data() {
      return {
        zoom: 0,
        seatNotAvailablePopup: false,
        notAvailableTickets: [],
        filterOpen: true,
        showTicketsPopup: true,
        activeSector: null,
        tooMuchTicketsPopup: false,
        showFullScheme: false,
        check: false,
        seatHover: {
          visible: false,
          section: ``,
          row: ``,
          seat: ``,
          price: ``,
          coordinates: {}
        },
        translation: {
          chooseSeats: {
            ru: `Выберите ваши места`,
            en: `Choose your places`,
            ua: `Виберіть ваші місця`
          },
          availableSeats: {
            ru: `мест доступно`,
            en: `places available`,
            ua: `місць є`
          },
          chooseSeatsNotAvailable: {
            ru: `Выбранные места уже заняты:`,
            en: `Selected places are already taken:`,
            ua: `Вибрані місця вже зайняті:`
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
          ]
        }
      }
    },
    created() {
      if (this.windowWidth <= 768) this.showTicketsPopup = false;
    },
    mixins: [dateFormat],
    components: {
      Back,
      AppFilter,
      Legend,
      Popup,
      AvailablePopup,
      SchemeSector,
      SchemeSectorFilter,
      SchemeControls,
      SchemeSeatMap,
      SchemeTickets,
      SchemeSeatHint,
      TicketBottom
    },
    computed: {
      dateForFormat() {
        return this.perfomanceInfo.date
      },
      schemeSrc() {
        if (!this.bigSchemeIs) {
          return `/design/img/scheme/${this.schemeName}.svg`
        } else {
          const sectorsLength = this.activeSectors.length;

          if (this.showFullScheme) {
            return `/design/img/scheme/big.svg`
          } else {
            const firstEl = this.activeSectors[0];

            if (firstEl == 1) {
              return `/design/img/scheme/big-parter.svg`
            } else if (firstEl == 2) {
              return `/design/img/scheme/big-balcone-1.svg`
            } else {
              return `/design/img/scheme/big-balcone-2.svg`
            }
          }
        }
      },
      schemeName() {
        return this.$store.getters.perfomanceInfo.hall.data.name
      },
      bigSchemeIs() {
        return this.schemeName === `big` ? true : false
      },
      allSeats() {
        return this.$store.getters.allSeats;
      },
      perfomanceFilterPrice() {
        return this.$store.getters.perfomanceFilterPrices
      },
      ticketsInCart() {
        return this.$store.getters.tickets
      },
      ticketsInCartLength() {
        if (this.ticketsInCart.length == 0 && this.windowWidth <= 768) {
          this.showTicketsPopup = false;
        }

        return this.ticketsInCart.length
      },
      sectorList() {
        return this.$store.getters.sectorList
      },
      sectorListForPanel() {
        let findActive = null;

        if (!this.activeSector) {
          findActive = this.sectorList.find(item => item.checked === true);
        } else {
          findActive = this.sectorList.find(item => item.sectionId === this.activeSector.sectionId);
        }

        return this.sectorList.map(item => {
          const obj = {
            sectionId: item.sectionId,
            sections: item.sections,
            prices: {
              min: item.prices.min,
              max: item.prices.max
            }
          };

          obj.sectionId === findActive.sectionId ? obj.checked = true : obj.checked = false;

          return obj
        });
      },
      activeSectors() {
        return this.sectorListForPanel.filter(sector => sector.checked)
                            .map(sector => sector.sections.join(`,`))
                            .join(`,`).split(`,`).map(item => +item);
      },
      availableSeats() {
        if (this.bigSchemeIs && !this.showFullScheme) {
          return this.$store.getters.availableFilteredNotCartSeats
                   .filter(ticket => this.activeSectors.indexOf(ticket.seatPrice.data.section_number) !== -1)
        } else {
          return this.$store.getters.availableFilteredNotCartSeats
        }
      },
      availableSeatsLength() {
        return this.availableSeats.length
      },
      perfomanceInfo() {
        return this.$store.getters.perfomanceInfo
      },
      documentLang() {
        return this.$store.getters.documentLang
      },
      windowWidth() {
        return this.$store.getters.windowWidth
      }
    },
    methods: {
      showAll() {
        this.showFullScheme = !this.showFullScheme;
      },
      seatNotAvailablePopupTrigger() {
        this.seatNotAvailablePopup = false;
        this.$store.commit(`removeTickets`, this.notAvailableTickets);
      },
      changeSector(e) {
        this.activeSector = e;
      },
      schemeZoomChange(zoomIn) {
        zoomIn ? this.zoom++ : this.zoom--;
      },
      seatHoverOnMap(obj) {
        if (obj === null) {
          this.seatHover.visible = false
        } else {
          this.seatHover = {
            visible: true,
            section: obj.section,
            sectionName: obj.sectionName,
            row: obj.row,
            seat: obj.seat,
            price: obj.price,
            coordinates: obj.coordinates
          };
        }
      },
      checkTicketsAvailable() {
        this.check = true;

        const tickets = this.ticketsInCart.map(ticket => ticket.id);
        this.$store.dispatch(`checkTicketsAvailable`, {tickets})
            .then(data => {
              if (data.status) {
                const reservedTickets = data.reservedTickets.data,
                      reservedTime = reservedTickets[0].reserved_time * 1000;

                window.localStorageCart.addTickets({
                  reserved_time: reservedTime,
                  perfomances: [
                    {
                      id: this.perfomanceInfo.id,
                      date: this.perfomanceInfo.date,
                      tickets: tickets
                    }
                  ]
                });

                this.$router.push({name: `Cart`})
              } else {
                throw data;
              }
            }).catch(data => {
              const notAvailableTicketsId = data.tickets.data.filter(ticket => !ticket.isAvailable).map(ticket => ticket.id);

                this.notAvailableTickets = this.ticketsInCart.filter(ticket => notAvailableTicketsId.find(item => item == ticket.id));

                this.getNewTicketsData()

                this.seatNotAvailablePopup = true;
            })

        this.check = false;
      },
      getNewTicketsData() {
        this.$store.dispatch(`getPerfomanceData`, this.$route.params.id)
      },
      openTickets(event) {
        this.showTicketsPopup = event;
        this.filterOpen = false;
      }
    }
  }
</script>
