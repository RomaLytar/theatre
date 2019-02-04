(() => {
  (() => {
    class SessionStorageCartClass {
      constructor() {
        this.perfomances = null;
        this._init();
        this.vue = null;
      }

      _init() {
        this._intervalFunc();

        setInterval(() => {
          this._intervalFunc();
        }, 300);
      }

      _intervalFunc() {
        const sessionStorageData = sessionStorage.getItem(`cart`);

        if (sessionStorageData) {
          const parseData = JSON.parse(sessionStorageData),
                filteredData = parseData.perfomances.filter(perfomance => this._checkTimeEnd(perfomance.date, perfomance.reserved_time));

          this.perfomances = filteredData;

          if (!this.perfomances.length) {
            this._deleteCart();
          } else {
            sessionStorage.setItem(`cart`, JSON.stringify({perfomances: this.perfomances}))
          }
        }
      }

      _deleteCart() {
        this.perfomances = null;

        sessionStorage.removeItem(`cart`);
      }

      _checkTimeEnd(date, reserved_time) {
        return new Date() < new Date(date) && new Date() - 24 * 60 * 60 * 1000 < new Date(reserved_time)
      }

      addTickets(obj) {
        if (this.perfomances) {
          const index = this.perfomances.findIndex(item => item.id == obj.id);

          if (index == -1) {
            this.perfomances.push({
              reserved_time: new Date(),
              id: obj.id,
              date: obj.date,
              tickets: obj.tickets
            })
          } else {
            obj.tickets.forEach(item => {
              const arr = this.perfomances[index].tickets;

              if (arr.every(arrItem => arrItem != item)) arr.push(item);
            });
          }
        } else {
          this.perfomances = [{
            reserved_time: new Date(),
            id: obj.id,
            date: obj.date,
            tickets: obj.tickets
          }];
        }

        sessionStorage.setItem(`cart`, JSON.stringify({perfomances: this.perfomances}));
      }

      removeTickets(obj) {
        if (this.perfomances) {
          const index = this.perfomances.findIndex(item => item.id == obj.id);

          if (index != -1) {
            const newArr = this.perfomances[index].tickets.filter(item => !obj.tickets.find(ticket => item == ticket));

            !newArr.length ? this.perfomances.splice(index, 1) : this.perfomances[index].tickets = newArr;

            if (this.perfomances.length) {
              sessionStorage.setItem(`cart`, JSON.stringify({perfomances: this.perfomances}));
            } else {
              this.perfomances = null;
              sessionStorage.removeItem(`cart`);
            }
          }
        }
      }

      setVue(obj) {
        this.vue = obj;
      }
    };

    window.sessionStorageCart = new SessionStorageCartClass();
  })();

  (() => {
    class LocalStorageCartClass {
      constructor() {
        this.el = null;
        this.localStorageData = null;
        this.reserved_time = null;
        this.perfomances = null;
        this.vue = null;
        this.lang = document.documentElement.getAttribute(`lang`);
        this.translation = {
          youHave: {
            ru: `У вас есть`,
            en: `You have`,
            ua: `У вас є`
          },
          minutes: {
            ru: `минут, чтобы оформить заказ`,
            en: `minutes to place an order`,
            ua: `хвилин, щоб оформити замовлення`
          }
        };

        this._init();
      }

      _init() {
        this._intervalFunc();

        setInterval(() => {
          this._intervalFunc();
        }, 300);
      }

      _intervalFunc() {
        const localStorageData = localStorage.getItem(`cart`);

        if (localStorageData) {
          this.localStorageData = localStorageData;

          const parseData = JSON.parse(this.localStorageData);

          this.reserved_time = parseData.reserved_time;
          this.perfomances = parseData.perfomances;

          if (this._checkTimeEnd()) {
            this.perfomances.forEach(item => window.sessionStorageCart.addTickets(item))

            this._deleteCart();
          } else {
            !this._cartInDom() ? this._createCart() : this._changeCart();
          }
        } else {
          this._deleteCart();
        }
      }

      _getData() {
        const goodsCount = this.perfomances.reduce((sum, item) => sum + item.tickets.length, 0),
              timerStart = +new Date(this.reserved_time),
              timerEnd = timerStart + 15 * 60 * 1000,
              timerNow = Date.now(),
              secondsFullLeft = Math.floor((timerEnd - timerNow) / 1000),
              minutesLeft = Math.floor(secondsFullLeft / 60),
              secondsLeft = Math.floor(secondsFullLeft - minutesLeft * 60);
        return {
          goodsCount,
          minutesLeft,
          secondsLeft
        }
      }

      _cartInDom() {
        return document.querySelector(`.cart-global`);
      }

      _formatDate(value) {
        return value < 10 ? `0${value}` : value;
      }

      _createCart() {
        const data = this._getData(),
              template = `<section class="cart-global">
                <div class="cart-global__wrap">
                  <a href="/ticket/cart" class="cart-global__link">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 65.1 57.3" width="30" height="26" fill="#fff">
                      <path d="M46.5,44.5c-3.5,0-6.4,2.9-6.4,6.4c0,3.5,2.9,6.4,6.4,6.4c3.5,0,6.4-2.9,6.4-6.4C52.9,47.4,50,44.5,46.5,44.5z M46.5,54.5
                      c-2,0-3.5-1.6-3.5-3.5c0-2,1.6-3.5,3.5-3.5c2,0,3.5,1.6,3.5,3.5C50,52.9,48.5,54.5,46.5,54.5z"/>
                      <path d="M63.6,9H12.7l-0.9-3.6C11.1,2.2,8.2,0,4.9,0H1.4C0.6,0,0,0.6,0,1.4c0,0.8,0.6,1.4,1.4,1.4h3.5
                      c1.9,0,3.6,1.3,4.1,3.2l7,28.5c0.8,3.2,3.6,5.4,6.9,5.4h29.8c3.3,0,6.2-2.3,6.9-5.5L65,10.8c0.1-0.4,0-0.9-0.3-1.2
                      C64.5,9.2,64.1,9,63.6,9z M56.8,33.8c-0.4,1.9-2.2,3.3-4.1,3.2H22.9c-1.9,0-3.6-1.3-4.1-3.2l-5.4-21.9h48.4L56.8,33.8z"/>
                      <path d="M27.1,44.5c-3.5,0-6.4,2.9-6.4,6.4c0,3.5,2.9,6.4,6.4,6.4c3.5,0,6.4-2.9,6.4-6.4C33.5,47.4,30.6,44.5,27.1,44.5z M27.1,54.5
                      c-2,0-3.5-1.6-3.5-3.5c0-2,1.6-3.5,3.5-3.5c2,0,3.5,1.6,3.5,3.5C30.6,52.9,29,54.5,27.1,54.5z"/>
                    </svg>
                    <span class="cart-global__count" data-cart-global-count>${data.goodsCount}</span>
                  </a>
                  <div class="cart-global__info">
                    ${this.translation.youHave[this.lang]} <span class="cart-global__timer" data-cart-global-timer>${this._formatDate(data.minutesLeft)}:${this._formatDate(data.secondsLeft)}</span> ${this.translation.minutes[this.lang]}
                  </div>
                </div>
              </section>`;

        document.body.insertAdjacentHTML(`afterBegin`, template);
        document.body.classList.add(`cart-global-insert`);
        this.el = this._cartInDom();
      }

      _deleteCart() {
        if (this.perfomances) {
          this.localStorageData = null;
          this.reserved_time = null;
          this.perfomances = null;

          if (this._cartInDom()) {
            this.el.remove();
            this.el = null;
          }

          localStorage.removeItem(`cart`);
          document.body.classList.remove(`cart-global-insert`);

          if (this.vue) {
            this.vue.clearCart();
            const route = this.vue.$route;

            if (route) {
              if (route.meta.cart) {
                this.vue.$router.push({ name: `Cart`})
              }
            }
          }
        }
      }

      _changeCart() {
        const timer = this.el.querySelector(`[data-cart-global-timer]`),
              goods = this.el.querySelector(`[data-cart-global-count]`),
              data = this._getData();

        timer.textContent = `${this._formatDate(data.minutesLeft)}:${this._formatDate(data.secondsLeft)}`;
        goods.textContent = data.goodsCount;
      }

      _checkTimeEnd() {
        return +new Date(this.reserved_time) + 15 * 60 * 1000 < Date.now()
      }

      addTickets(obj) {
        if (this.localStorageData) {
          const index = this.perfomances.findIndex(item => item.id == obj.perfomances[0].id);

          index == -1 ? this.perfomances.push(obj.perfomances[0]) : obj.perfomances[0].tickets.forEach(item => this.perfomances[index].tickets.push(item));
        } else {
          this.perfomances = obj.perfomances;
          this.reserved_time = obj.reserved_time;
        }

        const createJSON = JSON.stringify({
          reserved_time: this.reserved_time,
          perfomances: this.perfomances
        });

        this.localStorageData = createJSON;

        localStorage.setItem(`cart`, createJSON);
      }

      removeTickets(obj) {
        if (this.localStorageData) {
          const index = this.perfomances.findIndex(item => item.id == obj.id);

          if (index != -1) {
            const newArr = this.perfomances[index].tickets.filter(item => !obj.tickets.find(ticket => item == ticket));

            !newArr.length ? this.perfomances.splice(index, 1) : this.perfomances[index].tickets = newArr;

            if (this.perfomances.length) {
              localStorage.setItem(`cart`, JSON.stringify({
                reserved_time: this.reserved_time,
                perfomances: this.perfomances
              }));
            } else {
              localStorage.removeItem(`cart`);
            }
          }
        }
      }

      setVue(obj) {
        this.vue = obj;
      }
    };

    window.localStorageCart = new LocalStorageCartClass();
  })();
})();

