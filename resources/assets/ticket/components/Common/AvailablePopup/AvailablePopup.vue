<template>
  <div class="available-popup">
    <div class="available-popup__text">
      <p class="available-popup__title">
        <slot name="header">{{ translation.seatIsNotAvailable[documentLang] }}</slot>
      </p>
      <template v-if="tickets">
        <template v-for="section in sortTicketsBySection">
          <div class="available-popup__section-name">{{ section.sectionName }}</div>
          <ul class="available-popup__section-list">
            <li v-for="ticket in section.tickets">
              {{ translation.row[documentLang] }}: {{ ticket.row }} {{ translation.seat[documentLang] }} {{ ticket.seat }}
            </li>
          </ul>
        </template>
      </template>

      <p class="available-popup__request">{{ translation.chooseOtherSeats[documentLang] }}</p>
    </div>
    <button
      type="button"
      class="btn btn--short btn--full"
      @click="$emit('popup-close')"
    >{{ translation.change[documentLang] }}</button>
  </div>
</template>

<script>
  export default {
    props: {
      tickets: {
        type: Array
      }
    },
    data(){
      return {
        translation: {
          seatIsNotAvailable: {
            ru: `Выбранные места уже заняты:`,
            en: `Selected places are already taken:`,
            ua: `Вибрані місця вже зайняті:`
          },
          chooseOtherSeats: {
            ru: `Выберите другие места`,
            en: `Choose other seats`,
            ua: `Виберіть інші місця`
          },
          change: {
            ru: `Изменить`,
            en: `Change`,
            ua: `Змінити`
          },
          row: {
            ru: `Ряд`,
            en: `Row`,
            ua: `Ряд`
          },
          seat: {
            ru: `Место`,
            en: `Seat`,
            ua: `Місце`
          }
        }
      }
    },
    computed: {
      sortTicketsBySection() {
        let sections = [];

        this.tickets.forEach(item => {
          if (!sections.length || !sections.find(section => section.sectionName == item.sectionName)) {
            sections.push({
              sectionName: item.sectionName,
              tickets: [item]
            })
          } else {
            sections.find(section => section.sectionName == item.sectionName).tickets.push(item)
          }
        });

        return sections
      },
      documentLang() {
        return this.$store.getters.documentLang
      }
    }
  }
</script>
