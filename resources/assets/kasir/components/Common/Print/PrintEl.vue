<template>
  <div class="print__el" :style="customStyle" :class="{'print__el--barcode': customEl.type == 'barcode'}">
    <template v-if="customEl.type !== 'barcode'">
      {{ outerText }}
    </template>
    <template v-else>
      <Barcode :code="getBarcode" :size="{width: customEl.width, height: customEl.height}"></Barcode>
    </template>
  </div>
</template>

<script>
  import Barcode from "../Barcode/Barcode"

  export default {
    props: {
      customEl: {
        required: true,
        type: Object
      },
      ticketInfo: {
        required: true,
        type: Object
      },
      ticket: {
        required: true,
        type: Object
      }
    },
    components: {
      Barcode
    },
    computed: {
      customStyle() {
        return {
          fontFamily: this.customEl.fontFamily ? this.customEl.fontFamily : ``,
          fontSize: this.customEl.fontSize ? `${this.customEl.fontSize}mm`: ``,
          lineHeight: this.customEl.lineHeight ? `${this.customEl.lineHeight}`: ``,
          transform: this.customEl.angle ? `rotate(${this.customEl.angle}deg)` : ``,
          fontWeight: this.customEl.fontWeight ? 700 : ``,
          textDecoration: this.customEl.textDecoration ? `underline` : ``,
          width: this.customEl.width ? `${this.customEl.width}px`: ``,
          height: this.customEl.height ? `${this.customEl.height}px`: ``,
          left: this.customEl.posX ? `${this.customEl.posX}px` : ``,
          top: this.customEl.posY ? `${ this.customEl.posY}px` : ``,
        }
      },
      outerText() {
        switch(this.customEl.type) {
          case "date":
            return this.getDate;
            break;

          case "time":
            return this.getTime;
            break;

          case "row":
            return this.getRow;
            break;

          case "seat":
            return this.getSeat;
            break;

          case "cost":
            return this.getCost;
            break;

          case "name":
            return this.getName;
            break;

          case "hall":
            return this.getHall;
            break;

          case "barcode":
            return this.getBarcode;
            break;

          case "sector":
            return this.getSector;
            break;
        }
      },
      getDate() {
        const date = new Date(Date.parse(this.ticketInfo.hallInfo.date));

        return `${this.checkZero(date.getDate())}.${this.checkZero(date.getMonth() + 1)}.${date.getFullYear()}`
      },
      getTime() {
        const date = new Date(Date.parse(this.ticketInfo.hallInfo.date));

        return `${this.checkZero(date.getHours())}:${this.checkZero(date.getMinutes())}`
      },
      getRow() {
        return this.ticket.seatPrice.data.row_number
      },
      getSeat() {
        return this.ticket.seatPrice.data.seat_number
      },
      getCost() {
        return this.ticket.seatPrice.data.price
      },
      getName() {
        return this.ticketInfo.hallInfo.performance.data.title
      },
      getHall() {
        return this.ticketInfo.hallInfo.hall.data.title
      },
      getBarcode() {
        return `${this.ticketInfo.order.data.id}-${this.ticket.id}`
      },
      getSector() {
        if (this.ticketInfo.hallInfo.hall.data.name == `big` && this.ticketInfo.hallInfo.hall.data.name == `small`) {
          return this.ticket.seatPrice.data.section_title
        } else {
          return ``
        }
      }
    },
    methods: {
      checkZero(val) {
        if (val < 10) {
          return `0${val}`
        } else if (val == 0) {
          return `00`
        } else {
          return val
        }
      }
    }
  }
</script>
