(function() {
  if (document.querySelector(`[data-event-parent]`)) {

    class FilterEvent  {
      constructor(item) {
        this.item = item;
        this.unicDateArr = [];
        this.actorsArr = this.item.querySelectorAll(`[data-event-artist]`);
        this.filter = new FilterValue(this.item.querySelector(`[data-filter-item="date"]`));
        this.CONSTANT = window.CONSTANT;

        this.getUnicDates();
        this.addDateItems();

        this.item.addEventListener(`filterChanged`, (e) => {
          this.sortArtistForDates(e.detail.value);
        });
      }

      transformDate(numericDate) {
        const fullDate = new Date(numericDate),
              dateDay = fullDate.getDate(),
              dateMonth = fullDate.getMonth(),
              dateYear = fullDate.getFullYear();

        return `${dateDay} ${this.CONSTANT.MONTH_GENITIVE[dateMonth][this.CONSTANT.LANG]} ${dateYear}`;
      }

      getUnicDates() {
        this.actorsArr.forEach((item) => {
          item.getAttribute(`data-date`).split(`,`).forEach(date => {
            if(this.unicDateArr.find(item => item == date)) return false;

            this.unicDateArr.push(date);
          })
        })

        this.unicDateArr.sort((a, b) => +new Date(a) > +new Date(b) ? 1 : -1);

      }

      // ФУнкция наполнения списка
      addDateItems(){
        this.filter.list.insertAdjacentHTML("beforeEnd", this.unicDateArr.map((item) => `<li><a href="${item}">${this.transformDate(item)}</a></li>`).join(``));
      }


      sortArtistForDates(choosedDate) {
        this.actorsArr.forEach((item) => {
          if(item.getAttribute(`data-date`).indexOf(choosedDate) != -1){
            item.removeAttribute(`data-hidden`);
          } else {
            item.setAttribute(`data-hidden`, true);
          }
        })
      }
    }

    window.addEventListener(`load`, () => {
      new FilterEvent(document.querySelector(`[data-event-parent]`));
    });
  }
})();
