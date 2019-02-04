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
        <p class="perfomance__header-desktop">{{ translation.chooseDate[documentLang] }}</p>
        <p class="perfomance__header-mobile">{{ translation.chooseSector[documentLang] }}</p>
      </div>
    </header>
    <div class="perfomance__body">
      <div class="perfomance__sector">
        <SectorChooseFilter @change-sector="changeSector">
          <h2 class="perfomance__subtitle">{{ translation.chooseSector[documentLang] }}</h2>
        </SectorChooseFilter>
      </div>
      <div class="perfomance__scheme">
        <SchemeSector
          @change-sector="changeSector"
          :sectorList="sectorList"
        ></SchemeSector>
        <p class="perfomance__available">{{ availableFilteredNotCartSeats.length }} {{ translation.availableSeats[documentLang] }}</p>
        <router-link
          :to="{ name: 'Seatmap'}"
          tag="button"
          class="btn btn--red"
          :disabled="!availableFilteredNotCartSeats.length"
        >{{ translation.chooseSeats[documentLang] }}</router-link>
      </div>
      <div class="perfomance__filter">
        <AppFilter
          :filterOpen="filterOpen"
          :filterBtnVisible="true"
          @filter-trigger="filterOpen = !filterOpen"
        ></AppFilter>
      </div>
    </div>
  </div>
</template>

<script>
  import dateFormat from "../../mixins/date-format"
  import Back from "../Common/Back/Back"
  import SectorChooseFilter from "../Common/SectorChooseFilter/SectorChooseFilter"
  import SchemeSector from "../Common/SchemeSector/SchemeSector"
  import AppFilter from "../Common/Filter/Filter"

  export default {
    data() {
      return {
        translation: {
          chooseDate: {
            ru: `Выберите ценовой диапазон, дату и сектор, которые соответствуют Вашим предпочтениям`,
            en: `Choose the price range, date and sector that match your preferences.`,
            ua: `Виберіть ціновий діапазон, дату і сектор, які відповідають Вашим перевагам`
          },
          chooseSector: {
            ru: `Выбор сектора`,
            en: `Sector selection`,
            ua: `Вибір сектора`
          },
          availableSeats: {
            ru: `мест доступно`,
            en: `places available`,
            ua: `місць є`
          },
          chooseSeats: {
            ru: `Выбрать места`,
            en: `Choose places`,
            ua: `Вибрати місця`
          }
        },
        filterOpen: true
      }
    },
    components: {
      Back,
      SectorChooseFilter,
      SchemeSector,
      AppFilter
    },
    created() {
      this.setSectorPrices();
    },
    mixins: [dateFormat],
    methods: {
      changeSector(e) {
        this.$store.commit(`sectorListChange`, e);
      },
      setSectorPrices() {
        let sectionPrices = {
          1: [],
          2: [],
          3: []
        };

        this.availableSeat.forEach((ticket, i) => {
          const ticketObj = ticket.seatPrice.data,
                ticketSectionNumber = ticketObj.section_number,
                ticketPrice = ticketObj.price;

          if (ticketSectionNumber == 1) {
            if (sectionPrices[`1`].indexOf(ticketPrice) == -1) sectionPrices[`1`].push(ticketPrice);
          } else if (ticketSectionNumber >= 2 && ticketSectionNumber <= 4) {
            if (sectionPrices[`2`].indexOf(ticketPrice) == -1) sectionPrices[`2`].push(ticketPrice);
          } else {
            if (sectionPrices[`3`].indexOf(ticketPrice) == -1) sectionPrices[`3`].push(ticketPrice);
          }
        });

        this.$store.commit(`setSectorPrices`, sectionPrices);
      }
    },
    computed: {
      sectorList() {
        return this.$store.getters.sectorList
      },
      activeSectors() {
        return this.sectorList.filter(sector => sector.checked)
                   .map(sector => sector.sections.join(`,`))
                   .join(`,`).split(`,`).map(item => +item);
      },
      availableSeat() {
        return this.$store.getters.availableSeats
      },
      availableFilteredNotCartSeats() {
        return this.$store.getters.availableFilteredNotCartSeats
                   .filter(ticket => this.activeSectors.indexOf(ticket.seatPrice.data.section_number) !== -1)
      },
      perfomanceInfo() {
        return this.$store.getters.perfomanceInfo
      },
      ticketsInCart() {
        return this.$store.getters.tickets
      },
      dateForFormat() {
        return this.perfomanceInfo.date
      }
    }
  }
</script>
