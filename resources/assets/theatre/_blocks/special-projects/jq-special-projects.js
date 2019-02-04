// innit Slick Slider for Special Projects
(() => {
  let timer;

  const innitSliderSpecialProjects = () => {
    const dataSlick = document.querySelector(`[data-slick-slider-special-projects]`);
    if (!dataSlick) return false;

    const sliderItemLength = dataSlick.querySelectorAll(`[data-slider-item]`).length,
          slickSliderActive = dataSlick.getAttribute(`data-slick-slider-special-projects`);

    if (sliderItemLength > 2 || window.innerWidth < 768) {
      if (slickSliderActive) return false;
      dataSlick.setAttribute(`data-slick-slider-special-projects`, true);

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

      calcHeightSlick($(`[data-slick-slider-special-projects]`));
    } else {
      if (!slickSliderActive) return false;

      $(dataSlick).slick(`unslick`);
      dataSlick.setAttribute(`data-slick-slider-special-projects`, ``);
    }
  };

  innitSliderSpecialProjects();
  window.addEventListener(`resize`, () => {
    clearTimeout(timer);

    timer = setTimeout(innitSliderSpecialProjects, 300);
  });
})();
