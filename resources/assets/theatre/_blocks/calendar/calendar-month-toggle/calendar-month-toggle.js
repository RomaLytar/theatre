(function(){
  window.CalendarMonthToggle = class {
    constructor(option) {
      this.item = option.item;
      this.nextBtn = this.item.querySelector(`[data-calendar-month="next"]`);
      this.prevBtn = this.item.querySelector(`[data-calendar-month="prev"]`);
      this.monthName = this.item.querySelector(`[data-calendar-month-name]`);

      this.item.addEventListener(`click`, (e) => {
        const target = e.target.closest(`button`);

        if (!target) return false;
        this.changeMonth(target);
      });
    }

    changeMonth(target) {
      let monthDirection = target.dataset.calendarMonth == `prev` ? -1 : 1;

      const event = new CustomEvent("monthToggle", {
        bubbles: true,
        cancelable: true,
        detail: {
          month: monthDirection
        }
      });

      this.item.dispatchEvent(event);
    }

    setMonth(option) {
      this.monthName.textContent = option.text;
      this.prevBtn.dataset.disabled = option.prevBtnDisabled;
      this.nextBtn.dataset.disabled = option.nextBtnDisabled;
      this.changeVisibleElement(option.elementVisible);
    }

    changeVisibleElement(flag) {
      if (flag) {
        this.item.removeAttribute(`data-hidden`);
      } else {
        this.item.dataset.hidden = true;
      }
    }
  }
})();
