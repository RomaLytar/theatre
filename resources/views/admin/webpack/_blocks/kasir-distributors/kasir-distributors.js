import {alertError as ticketsAlert} from "../../global/alert"

export default function kasirDistributors() {
  (() => {
    if(!document.querySelector(`[data-distributors-tickets]`)) return false;

        class TicketLimit  {
          constructor(item) {
            this.item = item;
            this.maxTickets = item.querySelector(`[data-total-tickets]`).textContent || 0;
            this.form = item.querySelector(`[data-distributors-form]`);
            this.dataDistributorInputArr = [...item.querySelectorAll(`[data-distributor-input]`)];

            this.form.addEventListener(`submit`, (e) => {
              this.submitForm(e);
            })
          }

          calcDistributorTickets() {
            return this.dataDistributorInputArr.reduce((sum, item) => sum + +item.value, 0);
          }

          submitForm(e) {
            console.log(this.calcDistributorTickets());

            if(this.calcDistributorTickets() <= this.maxTickets) return false;

            e.preventDefault();

            this.form.prepend(ticketsAlert(`Вказана кількість квитків більше доступної кількості`));
          }
        }

        window.addEventListener(`load`, () => {
          new TicketLimit(document.querySelector(`[data-distributors-tickets]`));
        });
  })();
}
