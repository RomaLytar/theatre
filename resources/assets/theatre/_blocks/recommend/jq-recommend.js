(() => {
  let timer;

  const innitSliderRecommend = () => {
    const dataSlick = document.querySelector(`[data-slick-slider-recommend]`);
    if (!dataSlick) return false;

    const sliderItemLength = dataSlick.querySelectorAll(`[data-slider-item]`).length,
          slickSliderActive = dataSlick.getAttribute(`data-slick-slider-recommend`);

    if (sliderItemLength > 4 || window.innerWidth < 768) {
      if (slickSliderActive) return false;
      dataSlick.setAttribute(`data-slick-slider-recommend`, true);

      $(dataSlick).slick({
        dots: true,
        autoplay: true,
        arrows: false,
        slidesToShow: 2,
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

      calcHeightSlick($(`[data-slick-slider-recommend]`));
    } else {
      if (!slickSliderActive) return false;

      $(dataSlick).slick(`unslick`);
      dataSlick.setAttribute(`data-slick-slider-recommend`, ``);
    }
  };

  innitSliderRecommend();
  window.addEventListener(`resize`, () => {
    clearTimeout(timer);

    timer = setTimeout(innitSliderRecommend, 300);
  });
})();
