(function() {
  if (document.querySelector(`[data-filter-media]`)) {

    class FilterMedia  {
      constructor(item) {
        this.item = item;
        this.filtersActive = [];
        this.mediaContainer = this.item.querySelector(`[data-media-container]`);
        this.mobile = 768;
        this.elmsQuantityOnPage = 9;
        this.activePage = 1;
        this.serverData = null;
        this.serverDataFiltered = null;
        this.pagination = new PaginationFrontend(document.querySelector(`[data-filter-pagination]`));
        this.mediaType = this.item.hasAttribute(`data-media-video`) ? `video` : `photo`;

        this.filters = [...this.item.querySelectorAll(`[data-filter-item]`)].map(item =>  new FilterValue(item));

        this.item.addEventListener(`filterChanged`, (e) => {
          const obj = e.detail,
                index = this.filtersActive.findIndex(item => item.type == obj.type);

          if(index !== -1) this.filtersActive.splice(index, 1);
          if(obj.value !== "?") this.filtersActive.push(obj);

          this.getData(true);
        });

        this.item.addEventListener(`changePage`, (e) => {
           this.activePage = e.detail.value;
           this.filterServerData();
        });

        this.item.addEventListener(`filterApply`, (e) => this.getData());
        this.getData();
      }

      filterServerData(){
        this.serverDataFiltered = this.serverData.slice((this.activePage - 1) * this.elmsQuantityOnPage , (this.activePage * this.elmsQuantityOnPage));
        this.insertData();
      }

      getData(flag) {
        if (flag) {
          if (window.innerWidth < this.mobile) return false;
        }

        let serverDataUrl = ``,
            typeUrl = ``;

        if (this.mediaType == `video`) {
          typeUrl = `media_videos`;
        } else if (this.mediaType == `photo`) {
          typeUrl = `media_albums`;
        }

        if (this.filtersActive.length) {
          serverDataUrl += "?";

          this.filtersActive.forEach((item, i, arr) => {
              serverDataUrl += item.value.slice(1);
            if (i !== arr.length-1) {
              serverDataUrl += "&";
            }
          })
        }
        // console.log(`${window.location.origin}/api/v1/${typeUrl}${serverDataUrl}`);
        return window.customAjax({
          url: `${window.location.origin}/api/v1/${typeUrl}${serverDataUrl}`,
          method: `GET`,
          json: true
        })
        .then((data) => {
          this.serverData = data.data;
          this.filterServerData();
          this.pagination.setLength(Math.ceil(this.serverData.length/this.elmsQuantityOnPage));

        // console.log(this.serverData);
          return this.serverData;
        }, (error) => {
          console.warn(error);
        });
      }

      insertData() {
        let content = ``;
        this.serverDataFiltered.forEach((item, index) => {
          let template = ``;
          if (this.mediaType == `video`) {
            template = `
              <div class="col-md-6 col-xl-4">
                <article class="video" data-video>
                  <a href="${item.url}" class="video__link" data-fancybox>
                    <div class="video__img">
                      <img src="${item.img ? item.img : '//img.youtube.com/vi/' + item.youtubeimg + '/0.jpg'}" alt="${item.title}">
                      <p class="video__icon-play">
                        <svg width="45" height="45" fill="#fff">
                          <use xlink:href="#icon-play" />
                        </svg>
                      </p>
                    </div>
                    <div class="video__container">
                      <h3 class="video__title">${item.title}</h3>
                      <p class="video__type">${item.cat}</p>
                    </div>
                  </a>
                </article>
              </div>`;
          } else if (this.mediaType == `photo`) {
            template = `
              <div class="col-md-6 col-xl-4">
                <article class="album">
                  <a class="album__link" href="${item.url}">
                    <figure class="album__img">
                      <img src="${item.img}" alt="${item.title}">
                    </figure>
                    <div class="album__container">
                      <h3 class="album__title">${item.title}</h3>
                      <p class="album__type">${item.cat}</p>
                    </div>
                  </a>
                </article>
              </div>`;
          }

          content += template;

        })
        this.mediaContainer.innerHTML = content;
      }
    }

    window.addEventListener(`load`, () => {
      new FilterMedia(document.querySelector(`[data-filter-media]`));
    });
  }
})();

(function() {
  class FilterApply {
    constructor(item) {
      this.item = item;
      this.item.addEventListener(`click`, (e) => this.btnApply())
    }

    btnApply(){
      const event = new CustomEvent(`filterApply`, {
        bubbles: true,
        cancelable: true
      });
      this.item.dispatchEvent(event);

      const close = new CustomEvent(`popupClose`, {
        bubbles: true,
        cancelable: true
      });
      this.item.dispatchEvent(close);
    }
  }

  [...document.querySelectorAll(`[data-filter-apply]`)].forEach(item => new FilterApply(item))

})();

