(() => {
  const gallerySlider = [...document.querySelectorAll(`[data-gallery-slider]`)];

  if (!gallerySlider) return false;

  gallerySlider.forEach((item) => {

    let flag = item.getAttribute(`data-gallery-slider`);

    if (item.children.length > 4 && !flag) {
      $(item).slick({
        dots: true,
        autoplay: false,
        arrows: false,
        slidesToShow: 4,
        responsive: [
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 2,
            }
          },
          {
            breakpoint: 481,
              settings: {
              slidesToShow: 1,
            }
          }
        ]
      });

      item.setAttribute(`data-gallery-slider`, true);
    }
  })
})();


(() => {

  let timer;

  const gallerySliderEvent = [...document.querySelectorAll(`[data-gallery-event]`)];

  if (!gallerySliderEvent) return false;

  let innitEventSlider = (() => {
    gallerySliderEvent.forEach((item) => {

      let flag = item.getAttribute(`data-slider-active`);

      if (window.innerWidth <= 1024 && !flag) {
        console.log(true);
        $(item).slick({
          dots: true,
          autoplay: false,
          arrows: false,
          slidesToShow: 3,
          responsive: [
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 2,
              }
            },
            {
              breakpoint: 481,
                settings: {
                slidesToShow: 1,
              }
            }
          ]
        });

        item.setAttribute(`data-slider-active`, true);

      } else if (window.innerWidth > 1024 && flag) {

        console.log(false);
        // console.log(flag);
        $(item).slick(`unslick`);
        item.removeAttribute(`data-slider-active`);
      }
    })
  })

  innitEventSlider();

  window.addEventListener(`resize`, () => {
    clearTimeout(timer);

    timer = setTimeout(innitEventSlider, 300);
  });
})();
