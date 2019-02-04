(function(){
  window.CalendarTypeToggle = class {
    constructor(option) {
      this.item = option.item;
      this.linkArr = this.item.querySelectorAll(`[data-calendar-type-link]`);

      this.item.addEventListener(`click`, (e) => {
        e.preventDefault();

        const target = e.target.closest(`[data-calendar-type-link]`);

        if (!target) return false;
        this.changeEvent(target);
      });
    }

    changeEvent(target) {
      const event = new CustomEvent(`typeToggle`, {
        bubbles: true,
        cancelable: true,
        detail: {
          type: target.getAttribute(`href`)
        }
      });

      this.item.dispatchEvent(event);
    }

    setEvent(type) {
      [...this.linkArr].forEach((item) => {
        if(type === item.getAttribute(`href`)) {
          item.setAttribute(`data-active`, true);
          item.closest(`li`).setAttribute(`data-active`, true);
        } else {
          item.removeAttribute(`data-active`);
          item.closest(`li`).removeAttribute(`data-active`);
        }
      });
    }
  }
})();
