export default class PriceZonesController {
    constructor(item, data) {
      this.item = item;
      this.title = this.item.querySelector(`.kasir__prices-title`);
      this.list = this.item.querySelector(`.kasir__prices-list`);
      this.listBtns = null;
      this.priceZonesList = data.priceZones.data;
      this.priceZoneActive = null;


      this.setTitle(data.title);
      this.createElement(this.priceZonesList);
      this.listBtns = [...this.list.querySelectorAll(`.kasir__prices-btn`)];

      this.item.addEventListener(`click`, (e) => {
        const target = e.target.closest(`.kasir__prices-btn`);

        if (!target) return false;

        if (target.hasAttribute(`data-active`)) return false;

        this.listBtns.forEach(item => item.removeAttribute(`data-active`));
        target.setAttribute(`data-active`, true);

        this.priceZoneActive = this.getZoneById(target.getAttribute(`data-id`));
        this.createEventChangePriseZones();
      });
    }

    createElement(list) {
      let map = list.map(item => {
        return `<li>
          <button type="button" class="kasir__prices-btn" data-id="${item.id}">
            <span class="kasir__prices-color" style="background:${item.color_code}"></span>
            <span class="kasir__prices-price">${item.price}&#8372;</span>
            <span class="kasir__prices-name">${item.color_name}</span>
          </button>
        </li>`
      });

      map.unshift(`<li>
        <span class="kasir__prices-btn-default">
          <span class="kasir__prices-color" style="border: 1px solid #333"></span>
          <span class="kasir__prices-name">Не размечены</span>
        </span>
      </li>`);

      map = map.join(``);
      this.list.innerHTML = map;
    }

    setTitle(value) {
      this.title.textContent = value;
    }

    createEventChangePriseZones() {
      this.item.dispatchEvent(
        new CustomEvent(`priceZonesChange`, {
          bubbles: true,
          cancelable: true,
          detail: {
            priceZoneActive: this.priceZoneActive
          }
        })
      )
    }

    getZoneById(id) {
      return this.priceZonesList.find(itemId => itemId.id == id)
    }

    getDataById(id) {
      const zone = this.priceZonesList.find(itemId => itemId.id == id);

      if (zone) {
        return {
          id: zone.id,
          color: zone.color_code
        }
      } else {
        return `#000000`
      }
    }
  }
