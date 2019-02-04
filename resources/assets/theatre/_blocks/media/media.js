(() => {
    const mediaContainer =  document.querySelector(`[data-media]`);
    let galleryClickedFlag = false;
    // const imgArr = ["http://bipbap.ru/wp-content/uploads/2017/09/Cool-High-Resolution-Wallpaper-1920x1080.jpg", "http://bipbap.ru/wp-content/uploads/2017/05/VOLKI-krasivye-i-ochen-umnye-zhivotnye.jpg", "https://www.youtube.com/watch?v=_sI_Ps7JSEk"];

    if (!mediaContainer) return false;

    let insertVideosToGallery = function(data, targetUrl) {

       let arr = data.map((item) => item.url);

      [...mediaContainer.querySelectorAll(`[data-video] a`)].forEach((item) => arr.push(item.getAttribute(`href`)));

      arr.forEach(function(item, i){
        if (item == targetUrl) {
          arr.splice(i, 1);
        }
      });
      arr.unshift(targetUrl);

      innitGallery(arr);
    };

    let innitGallery = function(arr) {
      let getObjArr = arr.map((item) => ({src: item}));

      $.fancybox.open(getObjArr, {
        loop : true,
        'onStart': galleryClickedFlag = false
      });
    };

    let getData = function(requestUrl, albumId, targetUrl, urlArr) {
      if (albumId){
        window.customAjax({
          url: `${requestUrl}?id=${albumId}`,
          method: `GET`,
          json: true
        }).then((data) => {
          insertVideosToGallery(data.data, targetUrl);
        }, (error) => {
          console.warn("Data has not getting " + error);
        });
      } else {
        insertVideosToGallery(urlArr, targetUrl);
      }
    };

    mediaContainer.addEventListener(`click`, function(e) {
      e.preventDefault();

      if (galleryClickedFlag) return false;

      galleryClickedFlag = true;

        const target = e.target.closest(`a`);

        if (!target) return false;
        const targetContainer = target.closest(`[data-media-item]`),
              targetUrl = target.getAttribute(`href`),
              requestUrl = mediaContainer.getAttribute(`data-action`),
              gallery = e.target.closest(`[data-media]`);

        let albumId = mediaContainer.getAttribute(`data-id`),
            urlArr = [];

        if (gallery.hasAttribute(`data-media-without-album`)) {
          [...gallery.querySelectorAll(`[data-media-item] a`)].forEach((item) => urlArr.push(item.getAttribute(`href`)));
          urlArr = urlArr.map((item) => ({url: item}));
          albumId = null;
        }

        if(targetContainer.hasAttribute(`data-video`)){

          $.fancybox.open({
                src: targetUrl,
                'onStart': galleryClickedFlag = false
          });
        } else {
          getData(requestUrl, albumId, targetUrl, urlArr);
        }
    });
})();


// innit Slick Slider for Media
(() => {
  let timer;

  const innitSliderMedia = () => {
    const dataSlick = document.querySelector(`[data-slick-slider-media]`);
    if (!dataSlick) return false;

    const sliderItemLength = dataSlick.querySelectorAll(`[data-media-item]`).length,
          slickSliderActive = dataSlick.getAttribute(`data-slick-slider-media`);

    if (sliderItemLength >= 2 && window.innerWidth < 768) {
      if (slickSliderActive) return false;
      dataSlick.setAttribute(`data-slick-slider-media`, true);

      $(dataSlick).slick({
        dots: true,
        autoplay: true,
        arrows: false,
        infinite: true,
        slidesToScroll: 1,
        autoplay: false,
        centerMode: true,
        slidesToShow: 1,
        centerPadding: `80px`,
        responsive: [
          {
            breakpoint: 481,
              settings: {
              centerMode: false,
              slidesToShow: 1,
            }
          }
        ]
      });

      calcHeightSlick($(`[data-slick-slider-media]`));
    } else {
      if (!slickSliderActive) return false;

      $(dataSlick).slick(`unslick`);
      dataSlick.setAttribute(`data-slick-slider-media`, ``);
    }
  };

  innitSliderMedia();
  window.addEventListener(`resize`, () => {
    clearTimeout(timer);

    timer = setTimeout(innitSliderMedia, 300);
  });
})();
