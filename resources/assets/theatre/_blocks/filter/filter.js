class Filter  {
  constructor(item) {
    this.item = item;
    this.type = this.item.dataset.filterItem;
    this.list = this.item.querySelector(`[data-filter-list]`);
    this.button = this.item.querySelector(`[data-filter-name]`);
    this.button.addEventListener(`click`, (e) => {
      this.drop();
    });
  }

  drop(){
    if (this.item.hasAttribute(`data-active`)){
      this.item.removeAttribute(`data-active`);
      this.list.style = ``;
    } else {
      if(window.innerWidth < 768){

        let childrenArr = [...this.item.parentNode.children];
        childrenArr.forEach((itm) => {
          if(itm.hasAttribute(`data-active`)) {
           itm.removeAttribute(`data-active`);
          }
        });
      }

      const heightToPageBottom = window.innerHeight - this.button.getBoundingClientRect().top - this.button.offsetHeight;
      if (heightToPageBottom < parseInt(window.getComputedStyle(this.list).maxHeight)) {
        this.list.style.maxHeight = `${heightToPageBottom}px`;
      }
      this.item.setAttribute(`data-active`, true);
    }
  }
}

class FilterValue extends Filter {
  constructor(item) {
    super(item);
    this.buttonText = this.button.querySelector(`span`);
    this.list.addEventListener(`click`, (e) => {
      e.preventDefault();
      let target = e.target.closest(`a`);

      if (!target) return false;

      this.changeFilter(target);
    });

    // this.clearAllFiltersBtn.addEventListener(`click`, () => {
    //   this.setFilter();
    //   this.clearDate();
    // });
  }

  changeFilter(target){
    if(!target.hasAttribute(`data-active`)) {
      [...this.list.querySelectorAll(`a`)].forEach((item) => item.removeAttribute(`data-active`));
      target.setAttribute(`data-active`, true);
      this.buttonText.innerHTML = target.innerHTML;

      let targetValue = target.getAttribute(`href`);

      if (targetValue === `all`) targetValue = ``;

      const event = new CustomEvent(`filterChanged`, {
        bubbles: true,
        cancelable: true,
        detail: {
          type: this.item.dataset.filterItem,
          item: this.item,
          value: targetValue
        }
      });
      this.item.dispatchEvent(event);
    }

    this.drop();
  }

  setFilter(obj) {
    let itemText;
    if (obj) {
      const value = obj.value,
            hidden = obj.hidden || false,
            list = [...this.list.querySelectorAll(`a`)];

      list.forEach((item) => item.removeAttribute(`data-active`));

      let valueInArr = list.some((item) => item.getAttribute(`href`) == value);
      if (value && valueInArr) {
        list.forEach((item) => {
          if (item.getAttribute(`href`) == value) {
            item.setAttribute(`data-active`, true);
            itemText = item.innerHTML;
          }
        });
      } else {
        let element = [...this.list.querySelectorAll(`a`)][0];

        element.setAttribute(`data-active`, true);
        itemText = element.innerHTML;
        // console.warn(`Значение ${value} не определено`);
      }

      if (hidden) {
        this.item.dataset.hidden = true;
      } else {
        this.item.removeAttribute(`data-hidden`);
      }
    } else {
      let element = [...this.list.querySelectorAll(`a`)][0];

      element.setAttribute(`data-active`, true);
      itemText = element.innerHTML;
      // console.warn(`Значение ${value} не определено`);
    }
    this.buttonText.innerHTML = itemText;
  }
}

class FilterRange extends Filter {
  constructor(item, link) {
    super(item);
    this.dateSpan = this.item.querySelector(`[data-filter-name]`);
    this.apply = this.item.querySelector(`[data-datepicker-apply]`);
    this.link = link;
    this.filterItem = $(this.item.querySelector(`[data-datepicker]`)).datepicker({
      range: true
    }).data(`datepicker`);

    this.apply.addEventListener(`click`, (e) => {

      if (!this.link) {
        e.preventDefault();
        this.applyDate();
      } else {
        e.preventDefault();

        const datesArrString = this.filterItem.selectedDates.map((item) => {
          return `${new Date(item).getMonth()}.${new Date(item).getDate()}.${new Date(item).getFullYear()}`
        }).join(",");

        window.location.href = `${window.location.origin}/calendar#/events?daterange=${datesArrString}`;
      }
    });

    this.CONSTANT = window.CONSTANT;
  }

  applyDate(clear) {
    const event = new CustomEvent(`filterChanged`, {
      bubbles: true,
      cancelable: true,
      detail: {
        type: this.item.dataset.filterItem,
        item: this.item,
        value: this.filterItem.selectedDates
      }
    });

    this.item.dispatchEvent(event);

    if (!clear) this.drop();

    if (document.querySelector(`[data-calendar]`) && !clear) this.setDaterangeHtml(this.filterItem.selectedDates);
  }

  setDate(obj) {
    const value = obj.value,
          hidden = obj.hidden || false;

    if (hidden) {
      this.item.dataset.hidden = true;
    } else {
      this.item.removeAttribute(`data-hidden`);
      this.item.style = ``;
    }

    this.filterItem.selectDate(value);

    if (document.querySelector(`[data-calendar]`)){
      this.setDaterangeHtml(value);
    };
  }

  setDaterangeHtml(arrDates) {
    if (document.querySelector(`.calendar-daterange`)) document.querySelector(`.calendar-daterange`).remove();

    if (arrDates.length) {
      const formatValue = (value) => value > 9 ? value : `0${value}`;

      const template = document.createElement(`div`),
            daterangeValue = `
              ${arrDates.map((item) => {
                return `<span data-daterange class="filter__name-daterange">${formatValue(new Date(item).getDate())}.${formatValue(new Date(item).getMonth() + 1)}.${new Date(item).getFullYear()}</span>`
              }).join("")}
            `,
            daterangeInner = `
                <p class="calendar-daterange__dates">
                  <svg width="15" height="15" fill="#333" class="calendar-daterange__icon">
                    <use xlink:href="#icon-calendar" />
                  </svg>
                  ${daterangeValue}
                </p>

              <button type="submit" class="btn-more" data-calendar-daterange-reset>${this.CONSTANT.RESET_DATA[this.CONSTANT.LANG]}</button>
            `;

      template.addEventListener("click", (e) => {
        const target = e.target.closest("[data-calendar-daterange-reset]");

        if (!target) return false;
        this.clearDate();
      });

      template.classList.add(`calendar-daterange`);
      template.innerHTML = daterangeInner;
      document.querySelector(`.calendar__filter`).appendChild(template);

      if (!this.dateSpan.querySelector(`[data-daterange]`)) this.dateSpan.insertAdjacentHTML(`afterBegin`, daterangeValue);
    }
  }

  clearDate() {
      // console.log(`run`);

    this.filterItem.clear();
    if (document.querySelector(`.calendar-daterange`)) document.querySelector(`.calendar-daterange`).remove();

    this.dateSpan.querySelectorAll(`[data-daterange]`).forEach((item) => {
      if (item) item.remove();
    });

    this.applyDate(true);
  }
}

[...document.querySelectorAll(`[data-filter-item]`)].map((item) => {
  if (!item.closest(`[data-filter-calendar]`) && !document.querySelector(`[data-event]`) && !document.querySelector(`[data-filter-media]`)) {
    if (item.getAttribute(`data-filter-item`) == `daterange`) {
      return new FilterRange(item, true);
    } else {
      return new Filter(item);
    }
  }
});


