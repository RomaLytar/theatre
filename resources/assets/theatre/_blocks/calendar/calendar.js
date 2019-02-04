(function() {
  const getCurrentDate = (value) => {
    let date;

    if (value) {
      date = new Date(value);
    } else {
      date = new Date();
    }

    return {
      fullDate: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
      year: date.getFullYear(),
      month: date.getMonth(),
      date: date.getDate()
    }
  };

  const checkSessionStorage = () => {
    try {
      return `sessionStorage` in window && window[`sessionStorage`] !== null;
    } catch (e) {
      return false;
    }
  };

  if (document.querySelector("[data-calendar]")) {

    window.Calendar = class  {
      constructor(params) {
        this.item = params.item;
        this.parentURL = params.urlName;

        this.type = ``;

        this.minDate = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
        this.maxDate = new Date(new Date().getFullYear(), 11, 1);

        this.search = ``;

        this.filter = {
          event: ``,
          time: ``,
          scene: ``,
          daterange: ``,
          date: {
            fullDate: "",
            year: "",
            month: "",
            date: ""
          }
        };

        this.serverData = null;
        this.serverDataFiltered = null;
        this.dateRangeInnerValue = null;
        this.hoveredObject = {
          title: null,
          imgURL: null,
          elements: []
        };

        this.elements = {
          clearAllFiltersBtn: this.item.querySelector(`[data-reset-all-filters]`),
          calendarTypeListLink: this.item.querySelector(`[data-calendar-type-link-list]`),
          events: this.item.querySelector("[data-calendar-events]"),
          type: new CalendarTypeToggle({
            item: this.item.querySelector(`[data-calendar-type]`)
          }),
          monthToggler: new CalendarMonthToggle({
            item: this.item.querySelector(`[data-calendar-month-change]`)
          }),
          search: new CalendarSearch(this.item.querySelector(`[data-event-search]`)),
          filters: {
            event: new FilterValue(this.item.querySelector(`[data-filter-item='event']`)),
            time: new FilterValue(this.item.querySelector(`[data-filter-item='time']`)),
            scene: new FilterValue(this.item.querySelector(`[data-filter-item='scene']`)),
            daterange: new FilterRange(this.item.querySelector(`[data-filter-item='daterange']`)),
            date: new FilterValue(this.item.querySelector(`[data-filter-item='date']`))
          }
        };

        this.CONSTANT = window.CONSTANT;

        this.item.addEventListener(`filterChanged`, (e) => {
          const eventName = e.detail.type,
                eventValue = e.detail.value;

          if (eventValue === ``) {
            this.filter[eventName] = ``;
          } else {
            if (eventName === `date`) {
              let parseHrefArr = eventValue.split(`&`),
                  year = parseHrefArr[0].split(`=`)[1],
                  month = parseHrefArr[1].split(`=`)[1],
                  newDate = new Date() > new Date(year, month) ? newDate = new Date(year, month, new Date().getDate()) : new Date(year, month, 1);
              this.filter.date = getCurrentDate(newDate);
            } else if (eventName == `daterange`) {
              this.filter.daterange = eventValue.map((item) => {
                return `${new Date(item).getMonth()}.${new Date(item).getDate()}.${new Date(item).getFullYear()}`
              }).join(",");
            } else {
              this.filter[eventName] = eventValue;
            }
          }

          this.router(true);
        });

        this.item.addEventListener(`searchChanged`, (e) => {
          console.log(e.detail.value);
          this.search = e.detail.value;

          this.router(true);
        });

        this.item.addEventListener(`monthToggle`, (e) => {
          let year = this.filter.date.year,
              month = this.filter.date.month,
              date = this.filter.date.date,
              newDate;

          if (e.detail.month > 0) {
            month++;
            date = 1;
          } else {
            month--;

            if (month == new Date().getMonth()) {
              date = new Date().getDate();
            }
          }

          newDate = new Date(year, month, date);

          this.filter.date = {
            fullDate: newDate,
            year: newDate.getFullYear(),
            month: newDate.getMonth(),
            date: newDate.getDate()
          };

          this.router(true);
        });

        this.item.addEventListener(`typeToggle`, (e) => {
          if (e.detail.type === this.type) return false;

          this.type = e.detail.type;

          if (this.type === "#/calendar") {
            this.filter.daterange = ``;
            this.filter.date = getCurrentDate();
          } else {
            this.filter.date = ``;
            // Set default detarange value when change type
            // this.filter.daterange = this.getCurrentDaterange();
          }

          this.elements.type.setEvent(this.type);
          this.router(true);
        });

        this.elements.clearAllFiltersBtn.addEventListener(`click`, () => {
          this.filter = {
            event: ``,
            time: ``,
            scene: ``,
            daterange: ``,
            date: {
              fullDate: "",
              year: "",
              month: "",
              date: ""
            }
          };

          this.changeHash();
        })

        window.addEventListener(`mouseover`, (e) => {
          const calendarEvent = e.target.closest(`[data-calendar-event]`);

          if (calendarEvent) {
            this.hoverOnEvent(calendarEvent)
          } else {
            this.hoverOnEvent();
          }
        });

        window.addEventListener(`hashchange`, (e) => {
          this.router();
        });

        window.addEventListener(`resize`, (e) => {
          this.setCalendarOnMobile();
        });

        this.setMinMaxDateValue();
        this.router();
        this.setCalendarOnMobile();
      }

      setCalendarOnMobile() {
        let link = this.elements.calendarTypeListLink;

        if (window.innerWidth < 768 && !link.hasAttribute(`data-active`)) {
          link.click();
        }
      }

      router(flag) {
        if (!flag) {
          this.decodeHash(window.location.hash);
        }

        this.setFilters();
        this.getData();
        this.changeHash();
      };

      changeHash() {
        const hashArr = [],
              type = this.type;

        for (const key in this.filter) {
          if (this.filter[key] != ``) {
            if (key == `date`) {
              hashArr.push(`year=${this.filter.date.year}`);
              hashArr.push(`month=${this.filter.date.month}`);
            } else if (key == `daterange`) {
              hashArr.push(`daterange=${this.filter.daterange}`);
            } else {
              hashArr.push(`${this.filter[key]}`);
            }
          }
        }

        window.location.hash = `${type}?${hashArr.join("&")}`;
      };

      decodeHash(hash) {
        let parseType,
            parseYear,
            parseMonth,
            parseDate = null,
            parseEvent,
            parseTime,
            parseScene,
            parseDaterange;

        if (hash) {
          let parseHashSplitArr = hash.split("?"),
              parseFilterSplitArr = parseHashSplitArr[1].split("&");

          parseType = parseHashSplitArr[0];

          // Проходим по массиву и заполняем не достающие значения
          parseFilterSplitArr.forEach((item) => {
            if (item.indexOf(`year`) != -1) {
              parseYear = item.split(`=`)[1];
            } else if (item.indexOf(`month`) != -1) {
              parseMonth = item.split(`=`)[1];
            } else if (item.indexOf(`event`) != -1) {
              parseEvent = item;
            } else if (item.indexOf(`time`) != -1) {
              parseTime = item;
            } else if (item.indexOf(`scene`) != -1) {
              parseScene = item;
            } else if (item.indexOf(`daterange`) != -1) {
              parseDaterange = item.split(`=`)[1];
            }
          });
        } else {
          parseType = `#/calendar`;
        }

        if (parseType == `#/calendar`) {
          if (parseYear > new Date().getFullYear() || parseMonth > new Date().getMonth()) {
            this.filter.date = getCurrentDate(new Date(parseYear, parseMonth, 1));
          } else {
            this.filter.date = getCurrentDate();
          }
          parseDaterange = ``;
        } else {
          this.filter.date = ``;
        }

        this.type = parseType || ``;
        this.filter.event = parseEvent || ``;
        this.filter.time = parseTime || ``;
        this.filter.scene = parseScene || ``;
        this.filter.daterange = parseDaterange || ``;
      };

      setFilters() {
        let calendarType = this.type == `#/calendar` ? true : false,
            searchType = this.type == `#/search` ? true : false,
            eventType = this.type == `#/events` ? true : false;

        // Установка фильтра смены типа календарь/список
        this.elements.type.setEvent(this.type);

        // Установка фильтра смены переключения месяца
        if (this.elements.monthToggler) {
          const obj = {
            text: ``,
            elementVisible: calendarType,
            prevBtnDisabled: false,
            nextBtnDisabled: false
          };

          if (calendarType) {
            obj.text = this.CONSTANT.MONTH[this.filter.date.month][this.CONSTANT.LANG];
            obj.prevBtnDisabled = +this.minDate == +this.filter.date.fullDate;
            obj.nextBtnDisabled = +this.maxDate == +this.filter.date.fullDate;
          }

          this.elements.monthToggler.setMonth(obj);
        }

        // Установка фильтра события
        this.elements.filters.event.setFilter({
          value: this.filter.event
        });

        // Установка фильтра времени
        this.elements.filters.time.setFilter({
          value: this.filter.time
        });

        // Установка фильтра сцены
        this.elements.filters.scene.setFilter({
          value: this.filter.scene
        });

        // Установка фильтра daterange
        if (eventType || searchType) {
          let dateArr = [];

          if (this.filter.daterange) {
            dateArr = this.filter.daterange.split(`,`).map((item) => {
              const itemArr = item.split(`.`),
                    itemDate = +itemArr[1],
                    itemMonth = +itemArr[0],
                    itemYear = +itemArr[2];

              return new Date(itemYear, itemMonth, itemDate);
            });
          }

          this.elements.filters.daterange.setDate({
            value: dateArr,
            hidden: false
          });
        } else {
          this.elements.filters.daterange.setDate({
            value: [],
            hidden: true
          });
        }

        // Установка фильтра месяца
        if (eventType || searchType) {
          this.elements.filters.date.setFilter({
            value: this.filter.date,
            hidden: true
          });
        } else {
          this.elements.filters.date.setFilter({
            value: `year=${this.filter.date.year}&month=${this.filter.date.month}`,
            hidden: false
          });
        }

        // Установка фильтра поиска
        searchType === true ? this.elements.search.showElement(true) : this.elements.search.showElement();
      };

      setMinMaxDateValue() {
        const dateArr = this.elements.filters.date.list.querySelectorAll(`a`),
              minValue = dateArr[0].getAttribute(`href`),
              maxValue = dateArr[dateArr.length - 1].getAttribute(`href`);

        const createDateFromHref = (value, minValueFlag) => {
          const monthYearArr = value.split(`&`),
                month = monthYearArr[1].split(`=`)[1],
                year = monthYearArr[0].split(`=`)[1],
                date = minValueFlag === true ? +new Date().getDate() : 1;

          return new Date(year, month, date);
        };

        this.minDate = createDateFromHref(minValue, true);
        this.maxDate = createDateFromHref(maxValue);
      };

      hoverOnEvent(event) {
        const resetHoveredObject = () => {
          this.hoveredObject.title = null;
          this.hoveredObject.imgURL = null;
          this.hoveredObject.elements.map((item) => {

            let parent = item.closest(`[data-event-bg]`);
            parent.style = ``;
            parent.classList.remove(`hovered`);
            return false;
          });
        };

        if (!event) {
          if (this.hoveredObject.title) {
            resetHoveredObject();
          }
        } else {
          const eventTitle = event.querySelector(`[data-calendar-event-name]`).textContent;

          if (this.hoveredObject.title == eventTitle) return false;
          if (this.hoveredObject.title) resetHoveredObject();

          this.hoveredObject.title = eventTitle;
          this.hoveredObject.imgURL = this.serverDataFiltered.filter((item) => {
            return item.title == eventTitle ? true : false;
          })[0].imageUrl;

          this.hoveredObject.elements = [...this.item.querySelectorAll(`[data-calendar-event]`)].filter((item) => {
            return item.querySelector(`[data-calendar-event-name]`).textContent == eventTitle ? true : false;
          });

          this.hoveredObject.elements.forEach((item) => {
            let parent = item.closest(`[data-event-bg]`);
            parent.style.cssText = `background-image: url(${this.hoveredObject.imgURL}); color: #fff`;
            parent.classList.add(`hovered`);
          })
        }
      };

      // -------------------------------------------------
      getData() {
        const dateStringNow = new Date(),
              yearNow = dateStringNow.getFullYear(),
              monthNow = dateStringNow.getMonth() + 1 < 10 ? `0${dateStringNow.getMonth()}` : dateStringNow.getMonth(),
              dateNow = dateStringNow.getDate() < 10 ? `0${dateStringNow.getDate()}` : dateStringNow.getDate();

        const getAJAXData = () => {
          return window.customAjax({
            url: `${window.location.origin}/api/v1/calendar?from=${yearNow}-${monthNow}-${dateNow}&to=${yearNow + 1}-${monthNow}-${dateNow}`,
            method: `GET`,
            json: true
          })
          .then((data) => {
            this.serverData = data.data;
            return this.serverData;
          }, (error) => {
            console.warn(error);
          });
        }

        let promiseData = new Promise((resolve, reject) => {
          if (checkSessionStorage()) {
            if (!this.serverData) {
              if (sessionStorage.getItem(`calendarData`)) {
                this.serverData = JSON.parse(sessionStorage.getItem(`calendarData`));
                resolve(Promise.resolve(this.serverData));
              } else {
                getAJAXData().then((data) => {
                  sessionStorage.setItem(`calendarData`, JSON.stringify(data));
                  resolve(Promise.resolve(this.serverData));
                });
              }
            } else {
              resolve(Promise.resolve(this.serverData));
            }
          } else {
            resolve(getAJAXData());
          }
        });

        promiseData.then((data) => {
          let activeFilter = {},
              checkSearchFilter = this.type === `#/search`;

          for (const key in this.filter) {
            if (this.filter[key] == ``) continue;

            if (key == `date`) {
              if (this.filter.date.year) {
                activeFilter.year = this.filter.date.year;
              }

              if (this.filter.date.month) {
                activeFilter.month = this.filter.date.month;
              }

              continue;
            }

            if (this.filter[key].indexOf(`=`) != -1) {
              activeFilter[key] = this.filter[key].split(`=`)[1];
            } else {
              activeFilter[key] = this.filter[key];
            }
          }

          if (checkSearchFilter) activeFilter.search = this.search;

          this.serverDataFiltered = data.filter(item => {
            const itemFormatDate = new Date(item.dateTime);

            const obj = {
              year: itemFormatDate.getFullYear(),
              month: itemFormatDate.getMonth(),
              date: itemFormatDate.getDate(),
              fullDate: new Date(itemFormatDate.getFullYear(), itemFormatDate.getMonth(), itemFormatDate.getDate()),
              event: item.type,
              scene: item.scene,
              time: new Date(item.dateTime).getHours() > this.CONSTANT.DAY_SPLIT ? `night` : `daytime`,
              search: [item.title, item.author, item.actors]
            };

            for (const key in activeFilter) {
              if (key == `daterange`) {
                let rangeArr = this.filter.daterange.split(`,`),
                    rangeSize = rangeArr.length > 1 ? true : false,
                    rangeMin,
                    rangeMax;

                function convertDate(item) {
                  let itemArr = item.split(`.`),
                      year = itemArr[2],
                      month = itemArr[0],
                      date = itemArr[1];

                  return new Date(year, month, date);
                }

                if (rangeSize) {
                  rangeMax = convertDate(rangeArr[1]);
                }

                rangeMin = convertDate(rangeArr[0]);

                if (rangeSize) {
                  if (obj.fullDate < rangeMin || obj.fullDate > rangeMax) {
                    return false;
                  }
                } else {
                  if (+obj.fullDate != +rangeMin) {
                    return false;
                  }
                }
              } else if (key === `search`) {
                if (activeFilter.search === ``) return false;
                if (obj[key].join(` `).toUpperCase().indexOf(activeFilter.search.toUpperCase()) === -1) return false;
              } else {
                if (activeFilter[key] != obj[key]) return false;
              }
            }

            return true;
          });

          if (checkSearchFilter) {
            activeFilter.search === `` ? this.elements.search.setTitleResult() : this.elements.search.setTitleResult(this.serverDataFiltered.length > 0);
          }

          this.createEvents();
        });
      };

      createEvents() {
        this.type === `#/calendar` ? this.createCalendar() : this.createList();
      }

      createCalendar() {
        const validDayNumber = (day) => day == 0 ? 6 : day - 1;

        const template = document.createDocumentFragment(),
              tableTemplate = document.createElement("div"),
              tableHeaderTemplate = `
                <div class="calendar__table-row calendar__table-thead">
                  <div class="calendar__table-td" data-event-bg>${this.CONSTANT.DAY["1"][this.CONSTANT.LANG]}</div>
                  <div class="calendar__table-td" data-event-bg>${this.CONSTANT.DAY["2"][this.CONSTANT.LANG]}</div>
                  <div class="calendar__table-td" data-event-bg>${this.CONSTANT.DAY["3"][this.CONSTANT.LANG]}</div>
                  <div class="calendar__table-td" data-event-bg>${this.CONSTANT.DAY["4"][this.CONSTANT.LANG]}</div>
                  <div class="calendar__table-td" data-event-bg>${this.CONSTANT.DAY["5"][this.CONSTANT.LANG]}</div>
                  <div class="calendar__table-td" data-event-bg>${this.CONSTANT.DAY["6"][this.CONSTANT.LANG]}</div>
                  <div class="calendar__table-td" data-event-bg>${this.CONSTANT.DAY["0"][this.CONSTANT.LANG]}</div>
                </div>
              `;

        tableTemplate.classList.add("calendar__table");
        tableTemplate.innerHTML = tableHeaderTemplate;

        const firstDay = new Date(new Date(this.filter.date.fullDate).setMonth(+this.filter.date.month + 1, 0)),
              lastDay = new Date(firstDay).getDate(),
              startDay = validDayNumber(new Date(new Date(this.filter.date.fullDate).setMonth(this.filter.date.month, 1)).getDay()),
              finishDay = validDayNumber(new Date(new Date(this.filter.date.fullDate).setMonth(+this.filter.date.month + 1, 0)).getDay()),
              weekLength = Math.ceil((lastDay + startDay) / 7);
        let dateNumber = 0;

        for (let i = 0; i < weekLength; i++) {
          // Create table row
          const tableRow = document.createElement("div");
                tableRow.classList.add("calendar__table-row");

          for (let j = 0; j < 7; j++) {
            // Create table cell
            const tableTd = document.createElement("div");
                  tableTd.classList.add("calendar__table-td");
                  tableTd.setAttribute(`data-event-bg`, true);

            if (i == 0 && j < startDay || i == weekLength - 1 && j > finishDay) {
              tableTd.classList.add("calendar__table-td--empty");
            } else {
              dateNumber++;
              tableTd.innerHTML = `
                <div class="calendar__table-content">
                  ${this.serverDataFiltered
                    .filter((item) => new Date(item.dateTime).getDate() == dateNumber)
                    .map((item) => this.createEvent(item))
                    .join("")
                  }
                </div>`;
            }

            tableRow.appendChild(tableTd);
          }

          tableTemplate.appendChild(tableRow);
        }

        template.appendChild(tableTemplate);
        this.elements.events.innerHTML = ``;
        this.elements.events.appendChild(template);
      };

      createList() {
        const preparedDataFunc = () => {
          const preparedData = [],
                getDateType = (date) => new Date(date);

          for (let i = 0; i < this.serverDataFiltered.length; i++) {
            // Check our arr if we have need month?
            let arrMonthNumber = null,
                arrDaysNumber = null;

            // Check month
            preparedData.forEach((item, position) => {
              if (item.month == getDateType(this.serverDataFiltered[i].dateTime).getMonth()) {
                arrMonthNumber = position;
              }
            });

            if (arrMonthNumber == null) {
              preparedData.push({
                month: getDateType(this.serverDataFiltered[i].dateTime).getMonth(),
                days: []
              });

              arrMonthNumber = preparedData.length - 1;
            }

            preparedData[arrMonthNumber].days.forEach((item, position) => {
              if (item.date == getDateType(this.serverDataFiltered[i].dateTime).getDate()) {
                arrDaysNumber = position;
              }
            });

            if (arrDaysNumber == null) {
              preparedData[arrMonthNumber].days.push({
                month: getDateType(this.serverDataFiltered[i].dateTime).getMonth(),
                date: getDateType(this.serverDataFiltered[i].dateTime).getDate(),
                day: this.CONSTANT.DAY[getDateType(this.serverDataFiltered[i].dateTime).getDay()][this.CONSTANT.LANG],
                events: []
              });

              arrDaysNumber = preparedData[arrMonthNumber].days.length - 1;
            }

            preparedData[arrMonthNumber].days[arrDaysNumber].events.push(this.serverDataFiltered[i]);
          }

          // preparedData.sort((a, b) => {
          //   return a.month > b.month ? true : false;
          // });

          return preparedData;
        }

        const sortData = preparedDataFunc(),
              template = document.createDocumentFragment(),
              listTemplate = document.createElement("ul"),
              getEventDate = (date) => date > 9 ? date : `0${date}`;

        listTemplate.classList.add("calendar-list");

        const listItemTemplate = `
          ${sortData.map((itemMonth) => {
            return `<li class="calendar-list__month">
              <ul class="calendar-list__days">
                ${itemMonth.days.map((itemDay) => {
                  return `<li class="calendar-list__day">
                    <p class="calendar-list__day-info">
                      <span class="calendar-list__day-number">${getEventDate(itemDay.date)}</span>
                      <span class="calendar-list__day-month">${this.CONSTANT.MONTH_GENITIVE[itemDay.month][this.CONSTANT.LANG]}</span>
                      <span class="calendar-list__day-name">${itemDay.day}</span>
                    </p>
                    <ul class="calendar-list__events" data-event-bg>
                      ${itemDay.events.map((itemEvent) => {
                        return `<li>
                          ${this.createEvent(itemEvent)}
                        </li>`
                      }).join(``)}
                    </ul>
                  </li>`
                }).join(``)}
              </ul>
            </li>`
          }).join(``)}
        `.trim();

        listTemplate.innerHTML = listItemTemplate;
        template.appendChild(listTemplate);
        this.elements.events.innerHTML = ``;
        this.elements.events.appendChild(template);
      };

      createEvent(item) {
        let template;
        const getEventTime = (item) => {
          const date = new Date(item.dateTime),
                checkTime = (time) => time > 9 ? time : `0${time}`;

          return `${checkTime(date.getHours())}:${checkTime(date.getMinutes())}`
        };

        const getEventType = (type) => {
          if (this.CONSTANT.EVENT_TYPE[type]) {
            return this.CONSTANT.EVENT_TYPE[type][this.CONSTANT.LANG]
          } else {
            console.warn(`Not valid type ${type}`);
            return `ERROR`;
          }
        };

        const getEventScene = (scene) => {
          if (this.CONSTANT.EVENT_SCENE[scene]) {
            return this.CONSTANT.EVENT_SCENE[scene][this.CONSTANT.LANG]
          } else {
            console.warn(`Not valid type ${scene}`);
            return `ERROR`;
          }
        };

        const getEventPrice = (item, price) => {
          if (item.price === undefined) {
            console.warn(`The variable price does not exist`);
            return `ERROR`;
          }

          switch (price) {
            case `min`:
              try {
                return item.price.min
              } catch (err) {
                console.warn(`The variable min does not exist`);
                return `ERROR`;
              }
            break;

            case `max`:
              try {
                return item.price.max
              } catch (err) {
                console.warn(`The variable max does not exist`);
                return `ERROR`;
              }
            break;

            default:
              console.warn(`Not valid price ${price}`);
              return `ERROR`;
          }
        }

        if (this.type == `#/calendar`) {
          template = `
            <div data-sold="${item.ticketsSold}" class="calendar-table-event" data-calendar-event>
              <a href="${item.eventUrl}" class="calendar-table-event__name" data-calendar-event-name>${item.title}</a>
              <time datetime="${item.dateTime}" class="calendar-table-event__time">
                ${getEventTime(item)}
              </time>
              <p class="calendar-table-event__type">${getEventType(item.type)}</p>
              <a href="${item.eventUrl}" class="btn-buy calendar-table-event__btn">${this.CONSTANT.BUY_TICKET[this.CONSTANT.LANG]}</a>
              <p class="calendar-table-event__sold">${this.CONSTANT.TICKETS_SOLD[this.CONSTANT.LANG]}</p>
            </div>
          `;
        } else {
          template = `
            <div data-sold="${item.ticketsSold}" class="calendar-list-event" data-calendar-event>
              <div class="calendar-list-event__descr">
                <p class="calendar-list-event__scene">${getEventScene(item.scene)}</p>
                <time datetime="${item.dateTime}" class="calendar-list-event__time">
                  ${getEventTime(item)}
                </time>
                <p class="calendar-list-event__type">${getEventType(item.type)}</p>
              </div>
              <div class="calendar-list-event__info">
                ${item.author != `undefined` ? `<p class="calendar-list-event__author">${item.author}</p>` : ``}
                <a href="${item.eventUrl}" class="calendar-list-event__name" data-calendar-event-name>${item.title}</a>
                <p class="calendar-list-event__artists">
                  ${item.actors != `undefined` ? `${item.actors.join(`, `)}` : ``}
                </p>
              </div>
              <div class="col-xl-4 calendar-list-event__buy">
                <p class="calendar-list-event__price-range">${this.CONSTANT.TICKETS[this.CONSTANT.LANG]} ${this.CONSTANT.FROM[this.CONSTANT.LANG]} ${getEventPrice(item, 'min')} ${this.CONSTANT.TO[this.CONSTANT.LANG]} ${getEventPrice(item, 'max')} ${this.CONSTANT.UAH[this.CONSTANT.LANG]}</p>
                <a href="${item.eventUrl}" class="btn-buy calendar-list-event__btn">${this.CONSTANT.BUY_TICKET[this.CONSTANT.LANG]}</a>
                <p class="calendar-list-event__sold">${this.CONSTANT.TICKETS_SOLD[this.CONSTANT.LANG]}</p>
              </div>
            </div>
          `;
        }

        return template;
      };
      // -------------------------------------------------

      getCurrentDaterange() {
        const date = new Date();
        let lastDate = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();

        return `${date.getMonth()}.${date.getDate()}.${date.getFullYear()},${date.getMonth()}.${lastDate}.${date.getFullYear()}`;
      };
    }

    window.addEventListener(`load`, () => {
      let calendar = new Calendar({
        item: document.querySelector(`[data-calendar]`),
        urlName: `calendar`
      });
    });
  }
})();

