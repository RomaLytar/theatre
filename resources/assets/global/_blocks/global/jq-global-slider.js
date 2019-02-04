
// Innit slick always slider global

;(() => {
  let timer;

  const innitAlwaysSlider = () => {
    const alwaysSliderArr = [...document.querySelectorAll(`[data-slick-slider]`)];
    if(!alwaysSliderArr) return false;

    alwaysSliderArr.forEach((item) => {
      if(item.hasAttribute(`data-without-slider`)) return false;

      const sliderItemLength = item.querySelectorAll(`[data-slider-item]`).length,
            slickSliderActive = item.getAttribute(`data-slick-slider`);

        if (sliderItemLength > 3 || window.innerWidth < 768) {
          if (slickSliderActive) return false;
          item.setAttribute(`data-slick-slider`, true);

          $(item).slick({
            dots: true,
            autoplay: true,
            arrows: false,
            slidesToShow: 3,
            infinite: true,
            slidesToScroll: 1,
            autoplay: false,
            responsive: [
              {
                breakpoint: 768,
                settings: {
                  centerMode: true,
                  slidesToShow: 1,
                  centerPadding: `80px`,
                }
              },
              {
                breakpoint: 481,
                  settings: {
                  centerMode: false,
                  slidesToShow: 1,
                }
              }
            ]
          });

          calcHeightSlick($(item));
        } else {
          if (!slickSliderActive) return false;

          item.setAttribute(`data-slick-slider`, ``);
          $(item).slick(`unslick`);
        }
    });
  }

  innitAlwaysSlider();

  window.addEventListener(`resize`, () => {
    clearTimeout(timer);

    timer = setTimeout(innitAlwaysSlider, 300);
  });
})();
