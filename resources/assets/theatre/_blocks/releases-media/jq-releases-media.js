(() => {
  if ($(`.releases-media`)) {
    if ($(`[data-slick-slider-releases]`)) {

        $(`.releases-media [data-slick-slider-releases]`).slick({
          dots: true,
          autoplay: false,
          infinite: true,
          arrows: false,
          adaptiveHeight: true,
          slidesToShow: 3,
          slidesToScroll: 1,
          speed: 1000,
          responsive: [
            {
              breakpoint: 1400,
              settings: {
                centerMode: true,
                centerPadding: '20.86%',
                slidesToShow: 1
              }
            },
            {
              breakpoint: 768,
              settings: {
                centerPadding: '40px',
                slidesToShow: 1
              }
            },
            {
              breakpoint: 480,
              settings: {
                centerPadding: '20px',
                slidesToShow: 1
              }
            }
          ]
        });

        calcHeightSlick($(`.releases-media`));
      }

    if ($(`[data-fancybox=gallery]`)) {
      var fancyBoxItems = document.querySelectorAll(`[data-slider-item]:not(.slick-cloned) [data-fancybox=gallery]`)

      const addRelAttribute = (itemArr) => [...itemArr].forEach((item) => item.setAttribute(`rel`, `group-releases-media`));

      const innitReleasesGallery = (itemArr) => {
        const fancyBoxLinks = $(`a[rel=group-releases-media]`);

        if (fancyBoxLinks) fancyBoxLinks.fancybox();
      };

      addRelAttribute(fancyBoxItems);
      innitReleasesGallery(fancyBoxItems);
    }
  }
})();
