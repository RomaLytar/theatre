$("[data-scroll-arr]").on("click", function(e) {
  e.preventDefault();

  const menuHeight = $(".header").height(),
        scrollPosition = this.getBoundingClientRect().bottom + pageYOffset - menuHeight;

  $("html,body").animate({
    scrollTop: scrollPosition
  }, 1000);
});

(() => {
  const promoSlider = document.querySelector("[data-promo-slider]");
  if (!promoSlider) return false;

  $(promoSlider).slick({
    dots: false,
    arrows: false
  });
})();


;(function(){
  let changePromoSliderImg = function() {
    const imgArr = [...document.querySelectorAll(`[data-promo-mobile-url]`)];
    imgArr.forEach((item) => {
      if(!imgArr) return false;

      if(window.innerWidth <= 375){
        if(!item.hasAttribute(`data-promo-mobile-url-active`)){
          item.setAttribute(`data-promo-desktop-url`, item.getAttribute(`src`));
          item.setAttribute(`src`, item.getAttribute(`data-promo-mobile-url`));
          item.setAttribute(`data-promo-mobile-url-active`, true);
        }
      } else {
        if(item.hasAttribute(`data-promo-mobile-url-active`)){
          item.setAttribute(`data-promo-mobile-url`, item.getAttribute(`src`));
          item.setAttribute(`src`, item.getAttribute(`data-promo-desktop-url`));
          item.removeAttribute(`data-promo-mobile-url-active`);
        }
      }
    });
  }

  changePromoSliderImg();
  window.addEventListener(`resize`, changePromoSliderImg);
})();
