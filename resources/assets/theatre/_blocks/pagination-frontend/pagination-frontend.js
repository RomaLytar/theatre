(function() {
  window.PaginationFrontend = class {
    constructor(item) {
      this.item = item;
      this.length = 0;
      if(item) {
        this.item.addEventListener(`click`, (e) => {
          e.preventDefault();
          let target = e.target.closest(`a`);

          if (!target) return false;

          this.generateEventClick(target);
        })
      }
    }

    insertPagination(){

      this.item.innerHTML = this.generatePagination();
    }

    setLength(length){
      this.length = new Array(length).fill(true);
      if (length <= 1) {
        this.item.innerHTML = ``;
      } else {
        this.insertPagination();
      }
    }

    generateEventClick(btn){
      let page = ``;

      const pageActiveEl = this.item.querySelector(`[data-active]`),
            clickedItem = btn.textContent,
            pageActive = +(pageActiveEl.textContent);

        // console.log(pageActive);
      if (clickedItem == pageActive) return false;

      if (btn.rel == `prev`) {
        if (pageActive - 1 == 0) return false;
        page = pageActive - 1;
      } else if (btn.rel == `next`) {
        if (pageActive + 1 > this.length.length) return false;
        page = pageActive + 1;
      } else {
        page = clickedItem;
      }

      const event = new CustomEvent(`changePage`, {
        bubbles: true,
        cancelable: true,
        detail: {
          value: page
        }
      });
      pageActiveEl.parentElement.children[page].setAttribute(`data-active`, true);
      pageActiveEl.removeAttribute(`data-active`);

      this.item.dispatchEvent(event);
    }

    setPaginationQuantity(){
      return this.length.map((item, index) => {
        return `
          <li class="pagination__item" ${index == 0 ? 'data-active' : null}>
            <a class="pagination__link">${index+1}</a>
          </li>`;
      }).join(``);
    }

    generatePagination(){
      return `
          <ul class="pagination__list">
            <li class="pagination__item">
              <a class="pagination__link" rel="prev">Предыдущая
                <svg width="10" height="10" fill="#999999">
                  <use xlink:href="#icon-arrow-right" />
                </svg>
              </a>
            </li>
            ${this.setPaginationQuantity()}
            <li class="pagination__item">
              <a class="pagination__link" rel="next">Следующая
                <svg width="10" height="10" fill="#999999">
                  <use xlink:href="#icon-arrow-right" />
                </svg>
              </a>
            </li>
          </ul>`;
    }
  }
})();
