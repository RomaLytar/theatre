(function(){
  window.CalendarSearch = class {
    constructor(el) {
      this.item = el;
      this.title = this.item.querySelector(`[data-search-title]`);
      this.form = this.item.querySelector(`[data-search-form]`);
      this.input = this.item.querySelector(`[data-search-input]`);
      this.btn = this.item.querySelector(`[data-search-btn]`);
      this.btnReset = this.item.querySelector(`[data-search-reset]`);
      this.searchValue = ``;
      this.CONSTANT = window.CONSTANT;

      this.form.addEventListener(`submit`, (e) => {
        e.preventDefault();

        this.searchValue = this.input.value.trim();
        this.search();
      });

      this.btnReset.addEventListener(`click`, (e) => {
        e.preventDefault();

        this.input.value = ``;
        this.searchValue = ``;
        this.search();
      });
    }

    search() {
      if (this.searchValue === ``) {
        this.btnReset.removeAttribute(`data-active`);
      } else {
        this.btnReset.setAttribute(`data-active`, true);
      }

      const event = new CustomEvent(`searchChanged`, {
        bubbles: true,
        cancelable: true,
        detail: {
          type: `search`,
          item: this.item,
          value: this.searchValue
        }
      });

      this.item.dispatchEvent(event);
    }

    setTitleResult(flag) {
      if (flag === undefined) {
        this.title.innerHTML = `${this.CONSTANT.SEARCH.DEFAULT[this.CONSTANT.LANG]}`;
        return false;
      }

      if (flag) {
        this.title.innerHTML = `${this.CONSTANT.SEARCH.RESULT[this.CONSTANT.LANG]}: <small>${this.searchValue}</small>`;
      } else {
        this.title.innerHTML = `${this.CONSTANT.SEARCH.RESULT[this.CONSTANT.LANG]}: <small>${this.CONSTANT.SEARCH.EMPTY[this.CONSTANT.LANG]}</small>`;
      }
    }

    showElement(flag) {
      if (flag) {
        this.item.setAttribute(`data-active`, true);
      } else {
        this.item.removeAttribute(`data-active`);
      }
    }
  }
})();
