(() => {

  const promoLow = document.querySelector(`[data-promo-low]`);

  if (!promoLow) return false;

  const fixPromoLowPosition = () => {
    let divElement = document.createElement('div'),
        parentBlock = promoLow.parentElement;

    divElement.classList.add(`promo-low__twin`);
    divElement.setAttribute(`data-promo-low-twin`, true);

    if (window.innerWidth <= 1024) {

      if (promoLow.hasAttribute(`data-active`)) {
        promoLow.removeAttribute(`data-active`);
        promoLow.style = ``;
        parentBlock.removeChild(parentBlock.querySelector(`[data-promo-low-twin]`));
      }
    } else {
      const parentPosition = {
              top: parentBlock.getBoundingClientRect().top,
              height: parentBlock.offsetHeight
            };

      if (parentPosition.top < 0) {

        if (parentPosition.top + parentPosition.height < 0) {
          if (promoLow.hasAttribute(`data-active`)) return false;

          promoLow.setAttribute(`data-active`, true);
          divElement.style.height = `${parentPosition.height}px`;
          parentBlock.appendChild(divElement);

        } else {
          if (!promoLow.hasAttribute(`data-active`)) return false;
          promoLow.removeAttribute(`data-active`);
          parentBlock.removeChild(parentBlock.querySelector(`[data-promo-low-twin]`));
        }
      } else {
        promoLow.style = ``;
      }
    }
  };

  window.addEventListener(`scroll`, fixPromoLowPosition);
  window.addEventListener(`resize`, fixPromoLowPosition);
})();

