
(() => {
  class ConciergeSelectEvent  {
    constructor(item) {
      this.item = item;
      this.btnBack = this.item.querySelector(`[data-btn-back]`);
      this.evtList = this.item.querySelector(`[data-event-list]`);
      this.evtForm = this.item.querySelector(`[data-form]`);
      this.evtInput = this.evtForm.querySelector(`[data-ticket-code]`);
      this.evtBlock = this.item.querySelector(`[data-event-block]`);
      this.evtTitle = this.evtBlock.querySelector(`[data-event-title]`);
      this.evtDate = this.evtBlock.querySelector(`[data-event-date]`);
      this.evtTime = this.evtBlock.querySelector(`[data-event-time]`);
      this.evtHall = this.evtBlock.querySelector(`[data-event-hall]`);
      this.evtID = null;
      this.ticketServerInfo = {};
      this.feedback = null;

      this.btnBack.addEventListener(`click`, (e) => {
        e.preventDefault();
        this.toggleBtnBack();
        this.toggleEventBlock();
      });

      this.evtList.addEventListener(`click`, (e) => {
        e.preventDefault();
        let target = e.target.closest(`a`);
        if (!target) return false;
        this.setEventData(target);
        this.evtInput.focus();
      });

      this.evtForm.addEventListener(`submit`, (e) => {
        e.preventDefault();
        let ticketCode = this.evtInput.value
        this.getInfoTicket(ticketCode);
      });
    }

    setEventData(el){
      this.evtTitle.innerHTML = el.getAttribute(`data-title`);
      this.evtDate.innerHTML = el.getAttribute(`data-date`);
      this.evtTime.innerHTML = el.getAttribute(`data-time`);
      this.evtHall.innerHTML = el.getAttribute(`data-hall`);
      this.evtID = el.getAttribute(`data-id`);

      this.toggleEventBlock();
      this.toggleBtnBack();
    }

    toggleEventBlock() {
      this.evtBlock.classList.toggle(`visible`);
      this.evtList.classList.toggle(`visible`);
    }

    toggleBtnBack() {
      this.btnBack.classList.toggle(`visible`);
      this.clearTicketInputValue();
    }

    clearTicketInputValue() {
      this.evtInput.value = ``;
    }

    setFocusInput() {
      this.evtInput.value = ``;
      this.evtInput.focus();
    }

    createFeedBack() {
      let obj = this.ticketServerInfo,
          message = obj.message || `-`,
          status = obj.status,
          time = obj.activated_at || `-`,
          title = `-`,
          hall = `-`,
          section = `-`,
          row = `-`,
          seat = `-`;

      if(obj.ticket){
        title = obj.ticket.data.performanceCalendar.data.performance.data.title || `-`,
        hall = obj.ticket.data.performanceCalendar.data.hall.data.title || `-`,
        section = obj.ticket.data.seatPrice.data.section_number || `-`,
        row = obj.ticket.data.seatPrice.data.row_number || `-`,
        seat = obj.ticket.data.seatPrice.data.seat_number || `-`;
      }

      this.feedback = `<div class="popup__inner" data-status="${status}">
            <div class="popup__wrap">
              <div class="popup__concierge">
                <p class="popup__concierge-status">${message}</p>
                <p class="popup__concierge-ticket popup__concierge-ticket--time"><b>Активовано:&nbsp;</b>${time}</p>
                <p class="popup__concierge-title">${title}</p>
                <div class="popup__concierge-info">
                  <p class="popup__concierge-ticket popup__concierge-ticket--hall"><b>Зал:&nbsp;</b>${hall}</p>
                  <p class="popup__concierge-ticket popup__concierge-ticket--section"><b>Сектор:&nbsp;</b>${section}</p>
                  <p class="popup__concierge-ticket popup__concierge-ticket--row"><b>Ряд:&nbsp;</b>${row}</p>
                  <p class="popup__concierge-ticket popup__concierge-ticket--seat"><b>Місце:&nbsp;</b>${seat}</p>
                </div>
              </div>
              <button type="button" class="popup__close-feedback-ok" data-popup-close="">Закрити</button>
            </div>
          </div>`;
    }

    generateElementFeedBack() {
      const container = document.createElement("section");
            container.classList.add("popup");
            container.classList.add("popup--feedback");
            container.classList.add("popup--active");
            container.dataset.popup = "concierge";
            container.innerHTML = this.feedback;

      container.addEventListener("click", (e) => {
        const target = e.target;

        if (target.closest("[data-popup-close]")) {
          this.removePopup();
          this.setFocusInput();
        }
      });

      this.setFocusInput();

      return container;
    };

    removePopup() {
      const popup = document.querySelector(`[data-popup="concierge"]`);
      if(!popup) return false;

      popup.remove();
    }

    getInfoTicket(value) {
      const STATUS_CODE = {
          OK: 200,
          OTHER: `Unknown status`
        },
            OPTIONS = {
          method: 'GET'
        };

      let url = `/api/v1/tickets/activate/${this.evtID}/${value}`;

      fetch(url, OPTIONS)
      .then(response => {
        return response.json()
      })
      .then(data => {
        this.ticketServerInfo = data;
        // console.log(data);
        this.removePopup();
        this.createFeedBack();
        document.body.appendChild(this.generateElementFeedBack());
      })
      .catch((err) => {
        this.ticketServerInfo.message = `Невірний код квитка`;
        this.ticketServerInfo.status = false;
        this.ticketServerInfo.ticket = undefined;
        this.ticketServerInfo.activated_at = undefined;
        this.removePopup();
        this.createFeedBack();
        document.body.appendChild(this.generateElementFeedBack());
        // this.enteredWrongTicketDate();
      })
    }
  }

  window.addEventListener(`load`, () => {
    new ConciergeSelectEvent(document.querySelector(`[data-concierge]`));
  });
})();

