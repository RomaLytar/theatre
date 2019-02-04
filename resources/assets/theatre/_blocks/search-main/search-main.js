(function() {
  window.GetInputValue = class {
    constructor(item) {
      this.item = item;

      this.item.addEventListener(`input`, (e) => {
        const event = new CustomEvent(`inputSearchChanged`, {
          bubbles: true,
          cancelable: true,
          detail: {
            value: this.item.value
          }
        });
        this.item.dispatchEvent(event);
      });
    }
  }
})();

(function() {
  window.GetTypeValue = class {
    constructor(item) {
      this.item = item;

      this.item.addEventListener(`click`, (e) => {
        e.preventDefault();
        let target = e.target.closest(`a`);

        if (!target) return false;

        this.item.querySelector(`[data-active]`).removeAttribute(`data-active`);
        target.setAttribute(`data-active`, true);

        const event = new CustomEvent(`typeSearchChanged`, {
          bubbles: true,
          cancelable: true,
          detail: {
            value: target.href.substring(target.href.lastIndexOf('?')),
            dataType: target.getAttribute(`data-serverdata-type`)
          }
        });
        this.item.dispatchEvent(event);
      });
    }
  }
})();

(function() {
  if (document.querySelector(`[data-search-main]`)) {

    class SearchMain  {
      constructor(item) {
        this.item = item;
        this.searchTitle = this.item.querySelector(`[data-search-main-title]`);
        this.searchTitleTextInitial = this.searchTitle.textContent;
        this.searchBtn = this.item.querySelector(`[data-search-main-btn-submit]`);
        this.typeSelect = this.item.querySelector(`[data-search-main-type]`);
        this.searchTypeActive = this.typeSelect.querySelector(`[data-active]`);
        this.resultContainer = this.item.querySelector(`[data-search-main-result]`);
        this.resultNoResult = this.item.querySelector(`[data-search-main-answer]`);
        this.serverData = null;
        this.serverDataType = `list`;
        this.activePage = 1;
        this.serverDataFiltered = null;
        this.elmsQuantityOnPage = 9;
        this.searchTypeValue = this.searchTypeActive.href.substring(this.searchTypeActive.href.lastIndexOf('?'));
        this.searchInputValue = null;
        this.getInputValue = new GetInputValue(document.querySelector(`[data-search-main-input]`));
        this.pagination = new PaginationFrontend(document.querySelector(`[data-search-main-pagination]`));
        this.getTypeValue = new GetTypeValue(this.typeSelect);

        this.item.addEventListener(`inputSearchChanged`, (e) => {
           this.searchInputValue = e.detail.value;
        });

        this.item.addEventListener(`typeSearchChanged`, (e) => {
           this.searchTypeValue = e.detail.value;
           this.serverDataType = e.detail.dataType;
           if (this.searchTypeValue && this.searchInputValue) {
            this.getData(this.searchTypeValue, this.searchInputValue);
          }
        });

        this.searchBtn.addEventListener(`click`, (e) => {
          e.preventDefault();
          if (this.searchTypeValue && this.searchInputValue) {
            this.setTitle();
            this.getData(this.searchTypeValue, this.searchInputValue);
          }
        });

        this.item.addEventListener(`changePage`, (e) => {
          this.activePage = e.detail.value;
          this.filterServerData();
        });
      }

      getData(type, value) {
        let serverDataUrl = ``;

        // console.log(`${window.location.origin}/api/v1/search${type}&q=${value}`);

        return window.customAjax({
          url: `${window.location.origin}/api/v1/search${type}&q=${value}`,
          method: `GET`,
          json: true
        })
        .then((data) => {
          this.serverData = data.data;
          this.filterServerData();
          this.pagination.setLength(Math.ceil(this.serverData.length/this.elmsQuantityOnPage));
          console.log(this.serverData);
          return this.serverData;
        }, (error) => {
          console.warn(error);
        });
      }

      filterServerData(){
        this.serverDataFiltered = this.serverData.slice((this.activePage - 1) * this.elmsQuantityOnPage , (this.activePage * this.elmsQuantityOnPage));
        this.insertData();
      }

      setTitle() {
        this.searchTitle.innerHTML = `${this.searchTitleTextInitial}${this.searchInputValue}`;
        this.searchTitle.classList.add(`active`);
      }

      insertData() {
        let content = ``,
            container = ``;

        if (this.serverDataFiltered.length > 0){
          this.serverDataFiltered.forEach((item, index) => {
            let template = ``,
                getImgUrl = () => {
                  let imgUrl = ``;
                  if (item.img) {
                    imgUrl = item.img;
                  } else {
                    imgUrl = '//img.youtube.com/vi/' + item.youtubeimg + '/0.jpg';
                  }
                  return imgUrl;
                }
            if (this.serverDataType == `list`) {
              template = `
                <li class="search-main__result-item">
                  <h2 class="search-main__result-title">
                    <a href="${item.url}" class="search-main__result-link">${item.title}</a>
                  </h2>
                  <p class="search-main__descr">${item.descr}</p>
                </li>`;
            } else if (this.serverDataType == `media`) {
              template = `
                <li class="search-main__result-item col-md-6 col-xl-4">
                  <a href="${item.url}" ${item.type == "video" ? "data-fancybox" : ""} class="search-main__result-link">
                    <h2 class="search-main__result-title">${item.title}</h2>
                    <figure class="search-main__result-img ${item.type == "video"||item.type == "album" ? "search-main__result-img--media" : "search-main__result-img--actors"}">
                      <img src="${getImgUrl()}" alt="${item.title}">
                      ${item.type == "video" ? '<p class="search-main__icon-play"><svg width="45" height="45" fill="#fff"><use xlink:href="#icon-play" /></svg></p>' : ""}
                    </figure>
                  </a>
                </li>`;
            }

            content += template;
          })

          if (this.serverDataType == `media`) {
            container = `
              <div class="search-main__result">
                <ul class="search-main__result-list row">
                ${content}
                </ul>
              </div>`;
          } else if (this.serverDataType == `list`) {
            container = `
              <div class="search-main__result">
                <ul class="search-main__result-list">
                ${content}
                </ul>
              </div>`;
          }

        this.resultNoResult.classList.remove(`active`);

        } else {
          this.resultNoResult.classList.add(`active`);
        }
        this.resultContainer.innerHTML = container;
      }
    }

    window.addEventListener(`load`, () => {
      new SearchMain(document.querySelector(`[data-search-main]`));
    });
  }
})();

