export default class RecommendateController {
    constructor(item) {
      this.item = item;
      this.list = this.item.querySelector(`.kasir__prices-list`);
      this.listBtns = [...this.list.querySelectorAll(`.kasir__prices-btn`)];
      this.seatTypeActive = null;

      this.item.addEventListener(`click`, (e) => {
        const target = e.target.closest(`.kasir__prices-btn`);

        if (!target) return false;

        if (target.hasAttribute(`data-active`)) return false;

        this.listBtns.forEach(item => item.removeAttribute(`data-active`));
        target.setAttribute(`data-active`, true);

        this.seatTypeActive = target.getAttribute(`data-id`);
        this.createEventChangePriseZones();
      });
    }

    createEventChangePriseZones() {
      this.item.dispatchEvent(
        new CustomEvent(`seatTypeChange`, {
          bubbles: true,
          cancelable: true,
          detail: {
            seatTypeActive: this.seatTypeActive
          }
        })
      )
    }
  }
