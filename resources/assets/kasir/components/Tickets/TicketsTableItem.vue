<template>
  <tr>
    <td colspan="9" style="padding:0;">
      <div class="booking__table-wrap">
        <table class="table table-hover">
          <tbody>
            <TicketsTableItemTicket
              v-for="(ticket, i) in order.tickets.data"
              :key="ticket.id"
              :ticket="ticket"
              :order="order"
              :index="i"
              :globalProcessing="globalProcessing"
              @removeTicket="removeOneTicket"
            >
            </TicketsTableItemTicket>
            <tr>
              <td colspan="9" class="booking__table-total">
                <ButtonLoader
                  class="btn btn-info booking__table-btn"
                  :load="seatLoading"
                  @click="seatsShow"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512"
                    width="20"
                    height="20"
                    fill="#ffffff"
                  >
                    <path d="M256,96C144.341,96,47.559,161.021,0,256c47.559,94.979,144.341,160,256,160c111.656,0,208.439-65.021,256-160
                      C464.441,161.021,367.656,96,256,96z M382.225,180.852c30.082,19.187,55.572,44.887,74.719,75.148
                      c-19.146,30.261-44.639,55.961-74.719,75.148C344.428,355.257,300.779,368,256,368c-44.78,0-88.428-12.743-126.225-36.852
                      c-30.08-19.188-55.57-44.888-74.717-75.148c19.146-30.262,44.637-55.962,74.717-75.148c1.959-1.25,3.938-2.461,5.929-3.65
                      C130.725,190.866,128,205.613,128,221c0,70.691,57.308,128,128,128c70.691,0,128-57.309,128-128
                      c0-15.387-2.725-30.134-7.703-43.799C378.285,178.39,380.266,179.602,382.225,180.852z M256,205c0,26.51-21.49,48-48,48
                      s-48-21.49-48-48s21.49-48,48-48S256,178.49,256,205z"/>
                  </svg>
                  Подивитись мiсця
                </ButtonLoader>
                <button
                  type="button"
                  class="btn btn-info booking__table-btn"
                  :disabled="globalProcessing"
                  @click="printTickets"
                >Надрукувати усi квитки</button>
                <ButtonLoader
                  class="btn btn-danger booking__table-btn"
                  :load="globalProcessing"
                  @click="removeTicketsPopup = true"
                >Повернути усi квитки</ButtonLoader>
              </td>
            </tr>
          </tbody>
        </table>
        <Popup
          class="popup--full"
          v-if="seatsShowPopup"
          @popup-close="closeShowPopup"
        >
          <ShowHall
            :order="order"
            @schemeLoad="seatLoading = true"
          ></ShowHall>
        </Popup>
        <Popup
          v-if="removeTicketsPopup"
          @popup-close="removeTicketsPopup = false"
        >
          <section class="confirm-remove-tickets">
            <h2 class="confirm-remove-tickets__title">
              Ви впевненi, що бажаєте повернути замовлення №{{ order.id }}?
            </h2>
            <ButtonLoader
              class="btn btn-block btn-danger"
              :load="globalProcessing"
              @click="returnAllPaymentTickets"
            >
              Повернути
            </ButtonLoader>
          </section>
        </Popup>
      </div>
    </td>
  </tr>
</template>

<script>
  import ButtonLoader from "../Common/ButtonLoader/ButtonLoader"
  import TicketsTableItemTicket from "./TicketsTableItemTicket"
  import ShowHall from "../ShowHall/ShowHall"
  import Popup from "../Common/Popup/Popup"

  export default {
    props: {
      order: {
        required: true,
        type: Object
      }
    },
    components: {
      ButtonLoader,
      TicketsTableItemTicket,
      ShowHall,
      Popup
    },
    data() {
      return {
        globalProcessing: false,
        seatsShowPopup: false,
        seatLoading: false,
        removeTicketsPopup: false
      }
    },
    methods: {
      returnAllPaymentTickets() {
        this.globalProcessing = true;

        this.$store.dispatch(`returnAllPaymentTickets`, this.order.id)
          .catch(err => console.log(`Not delete`));

        this.globalProcessing = false;
      },
      removeOneTicket(val) {
        this.globalProcessing = val ? true : false;
      },
      seatsShow() {
        this.seatLoading = true;
        this.seatsShowPopup = true;
      },
      closeShowPopup() {
        this.seatsShowPopup = false;
        this.seatLoading = false;
      },
      printTickets() {
        const printTickets = {
                hallInfo: this.order.tickets.data[0].performanceCalendar.data,
                order: {
                  data: this.order
                }
              };

        this.$store.commit(`setOrderForPrint`, printTickets);
      }
    }
  }
</script>
