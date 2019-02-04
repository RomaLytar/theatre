export default class DistributorsControllerClass {
  constructor(item, data) {
    this.item = item;
    this.title = this.item.querySelector(`.kasir__prices-title`);
    this.list = this.item.querySelector(`.kasir__prices-list`);
    this.colorBtn = null;
    this.listBtns = null;
    this.priceZonesList = data;
    this.priceZoneActive = null;
    this.disabledColor = true;

    this.setTitle(`Дистрибьюторы`);
    this.createBtn();
    this.colorBtn = this.item.querySelector(`[data-color-btn]`);

    this.createElement(this.priceZonesList);
    this.listBtns = [...this.list.querySelectorAll(`.kasir__prices-btn`)];

    this.colorBtn.addEventListener(`click`, (e) => {
      this.triggerColorsVisible();
    });

    this.item.addEventListener(`click`, (e) => {
      const target = e.target.closest(`.kasir__prices-btn`),
            btnPay = e.target.closest(`.kasir__prices-btn-sell`);

      if (target) {
        if (target.hasAttribute(`data-active`)) return false;

        this.listBtns.forEach(item => item.removeAttribute(`data-active`));
        target.setAttribute(`data-active`, true);

        this.priceZoneActive = this.getDataById(target.getAttribute(`data-id`));
        this.item.dispatchEvent(
          new CustomEvent(`priceZonesChange`, {
            bubbles: true,
            cancelable: true,
            detail: {
              priceZoneActive: this.priceZoneActive
            }
          })
        )
      } else if (btnPay) {
        this.item.dispatchEvent(
          new CustomEvent(`sellTickets`, {
            bubbles: true,
            cancelable: true,
            detail: {
              id: btnPay.getAttribute(`data-id`)
            }
          })
        )
      }
    });
  }

  createElement(list) {
    let map = list.map((item, i) => {
      return `<li data-btn-visible="false">
        <button type="button" class="kasir__prices-btn" data-id="${item.id}">
          <span class="kasir__prices-color" style="background:${item.color_code}"></span>
          <span class="kasir__prices-name">${item.title}</span>
        </button>
        <button type="button" class="kasir__prices-btn-sell btn btn-success" data-id="${item.id}">Продати</button>
      </li>`
    });

    map.unshift(`<li>
      <button type="button" class="kasir__prices-btn" data-id="null">
          <span class="kasir__prices-color" style="border: 1px solid #333"></span>
          <span class="kasir__prices-name">Не размечены</span>
      </span>
    </li>`);

    map = map.join(``);
    this.list.innerHTML = map;
  }

  createBtn() {
    this.title.insertAdjacentHTML(`beforeEnd`, `<button type="button" class="btn btn-success" data-color-btn>За кольорами</button>`);
  }

  setTitle(value) {
    this.title.textContent = value;
  }

  getDataById(id) {
    const zone = this.priceZonesList.find(itemId => itemId.id == id);

    if (zone) {
      return {
        id: zone.id,
        color: zone.color_code
      }
    } else {
      return {
        id: null,
        color: null
      }
    }
  }

  triggerColorsVisible() {
    if (this.item.hasAttribute(`data-color-disabled`)) {
      this.item.removeAttribute(`data-color-disabled`);
      this.colorBtn.classList.remove(`btn-success`);
      this.colorBtn.classList.add(`btn-warning`);
    } else {
      this.item.setAttribute(`data-color-disabled`, true);
      this.colorBtn.classList.remove(`btn-warning`);
      this.colorBtn.classList.add(`btn-success`);
    }

    this.disabledColor = !this.disabledColor;

    this.item.dispatchEvent(
      new CustomEvent(`disabledColor`, {
        bubbles: true,
        cancelable: true,
        detail: {
          disabledColor: this.disabledColor
        }
      })
    )
  }

  triggerActiveHoverItem(id, count, flag) {
    const item = this.listBtns.find(item => item.dataset.id == id);

    if (flag) {
      item.setAttribute(`data-hover`, true);
      item.insertAdjacentHTML(`beforeEnd`, `<span class="kasir__badge">(${count})<span>`)
    } else {
      item.removeAttribute(`data-hover`);

      const el = item.querySelector(`.kasir__badge`);

      if (el) el.remove();
    }
  }

  showBtnSell(id) {
    const btn = this.listBtns.find(item => item.getAttribute(`data-id`) == id);

    if (btn) btn.closest(`li`).setAttribute(`data-btn-visible`, true);
  }

  hideBtnSell(id) {
    const btn = this.listBtns.find(item => item.getAttribute(`data-id`) == id);

    if (btn) btn.closest(`li`).setAttribute(`data-btn-visible`, false);
  }

  disabledBtnSell(id) {
    const btn = this.item.querySelector(`.kasir__prices-btn-sell[data-id="${id}"]`);

    if (btn) btn.setAttribute(`disabled`, true);
  }

  enabledBtnSell(id) {
    const btn = this.item.querySelector(`.kasir__prices-btn-sell[data-id="${id}"]`);

    if (btn) btn.removeAttribute(`disabled`);
  }
}
