<template>
  <li class="cart-aside__item">
    <h3 class="cart-aside__item-title">{{ performanceName }}</h3>
    <p class="cart-aside__item-datetime">{{ getWeekday }} {{ getDate }} {{ getHours | addZero }}:{{ getMinutes | addZero }}</p>
    <ul class="cart-aside__tickets">
      <li
        v-for="ticket in performanceTickets"
        :key="ticket.id"
      >
        <div class="cart-aside__ticket-info">
          <p>{{ getSectionName(ticket.seatPrice.data.section_number) }}</p>
          <p v-if="ticket.seatPrice.data.row_number">
          {{ translation.row[documentLang] }}
          {{ ticket.seatPrice.data.row_number }}
          {{ translation.seat[documentLang] }}
          {{ ticket.seatPrice.data.seat_number }}</p>
          <p v-else>
            {{ translation.ticket[documentLang] }}
            {{ ticket.seatPrice.data.seat_number }}
          </p>
        </div>
        <a
          :href="ticket.pdf_link"
          class="cart-aside__ticket-download"
        >
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20" height="20" fill="#333">
            <path d="M498.966,339.946c-7.197,0-13.034,5.837-13.034,13.034v49.804c0,28.747-23.388,52.135-52.135,52.135H78.203
              c-28.747,0-52.135-23.388-52.135-52.135V352.98c0-7.197-5.835-13.034-13.034-13.034C5.835,339.946,0,345.782,0,352.98v49.804
              c0,43.121,35.082,78.203,78.203,78.203h355.594c43.121,0,78.203-35.082,78.203-78.203V352.98
              C512,345.782,506.165,339.946,498.966,339.946z"/>
            <path d="M419.833,391.3H92.167c-7.197,0-13.034,5.837-13.034,13.034s5.835,13.034,13.034,13.034h327.665
              c7.199,0,13.034-5.835,13.034-13.034C432.866,397.137,427.031,391.3,419.833,391.3z"/>
            <path d="M387.919,207.93c-4.795-5.367-13.034-5.834-18.404-1.038l-100.482,89.765V44.048c0-7.197-5.835-13.034-13.034-13.034
              c-7.197,0-13.034,5.835-13.034,13.034v252.609l-100.482-89.764c-5.367-4.796-13.607-4.328-18.404,1.038
              c-4.794,5.369-4.331,13.609,1.037,18.404l109.174,97.527c6.187,5.529,13.946,8.292,21.708,8.292
              c7.759,0,15.519-2.763,21.708-8.289l109.174-97.53C392.25,221.537,392.714,213.297,387.919,207.93z"/>
          </svg>
        </a>
      </li>
    </ul>
  </li>
</template>

<script>
  import dateFormat from "../../../mixins/date-format"

  export default {
    props: {
      performance: {
        required: true,
        type: Object
      }
    },
    mixins: [dateFormat],
    data() {
      return {
        translation: {
          row: {
            ru: `Ряд`,
            en: `Row`,
            ua: `Ряд`
          },
          seat: {
            ru: `Место`,
            en: `Seat`,
            ua: `Місце`
          },
          ticket: {
            ru: `Билет`,
            en: `Ticket`,
            ua: `Квиток`
          },
          parter: {
            ru: `Партер`,
            en: `Parquet`,
            ua: `Партер`
          },
          balconyLeft: {
            ru: `Балкон левая сторона`,
            en: `Balcony left side`,
            ua: `Балкон ліва сторона`
          },
          balconyRight: {
            ru: `Балкон правая сторона`,
            en: `Balcony right side`,
            ua: `Балкон права сторона`
          },
          balcony1: {
            ru: `Балкон I-го яруса`,
            en: `Balcony I-tier`,
            ua: `Балкон I-го ярусу`
          },
          balcony2: {
            ru: `Балкон II-го яруса`,
            en: `Balcony II tier`,
            ua: `Балкон II-го ярусу`
          }
        }
      }
    },
    computed: {
      dateForFormat() {
        return this.performance.data.date
      },
      performanceName() {
        return this.performance.data.performance.data.title
      },
      performanceHallType() {
        return this.performance.data.hall.data.name
      },
      performanceTickets() {
        return this.performance.data.tickets.data
      }
    },
    methods: {
      getSectionName(sectionNumber) {
        const sectNum = parseInt(sectionNumber);

        switch(this.performanceHallType) {
          case "small":
            switch(sectNum) {
              case 1:
                return this.translation.parter[this.documentLang]
                break;

              case 2:
                return this.translation.balconyLeft[this.documentLang]
                break;

              case 3:
                return this.translation.balconyRight[this.documentLang]
                break;
            }
            break;

          case "big":
            switch(sectNum) {
              case 1:
                return this.translation.parter[this.documentLang]
                break;

              case 2:
              case 3:
              case 4:
                return this.translation.balcony1[this.documentLang]
                break;

              case 5:
              case 6:
              case 7:
                return this.translation.balcony2[this.documentLang]
                break;
            }
            break;

          case "muzsalon":
            return this.translation.parter[this.documentLang]
            break;

          case "outdoor":
            return ``
            break;
        }
      }
    }
  }
</script>
