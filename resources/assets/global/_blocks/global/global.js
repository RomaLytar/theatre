// Add/Remove overflow
;(function(){
  let objOpenArr = [];

  window.addEventListener("bodyOverflow", (e) => {
    if (e.detail.opened || e.detail.open) {
      objOpenArr.push({obj: e.detail.openedObj});

      document.body.classList.add("body-popup");
    } else {
      objOpenArr.forEach((item, i) => {
        if (item.obj == e.detail.openedObj) {
          objOpenArr.splice(i, 1);
        }
      });

      if (!objOpenArr.length) {
        document.body.classList.remove("body-popup");
      }
    }
  });
})();
// ______________________________


//change image desktop/mobile

;(function(){
  let changeImg = function() {
    const imgArr = [...document.querySelectorAll(`[data-mobile-url]`)];

    if(!imgArr) return false;

    imgArr.forEach((item) => {
      if(window.innerWidth < 768){
        if(!item.hasAttribute(`data-mobile-url-active`)) {
          item.setAttribute(`data-desktop-url`, item.getAttribute(`src`));
          item.setAttribute(`src`, item.getAttribute(`data-mobile-url`));
          item.setAttribute(`data-mobile-url-active`, true);
        }
      } else {
        if(item.hasAttribute(`data-mobile-url-active`)) {
          item.setAttribute(`data-mobile-url`, item.getAttribute(`src`));
          item.setAttribute(`src`, item.getAttribute(`data-desktop-url`));
          item.removeAttribute(`data-mobile-url-active`);
        }
      }
    });
  }

  changeImg();
  window.addEventListener(`resize`, changeImg);
})();

