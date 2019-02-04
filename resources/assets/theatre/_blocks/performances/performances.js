(() => {
  const perfomances = document.querySelector(`[data-performances]`);

  if (!perfomances) return false;

  [...document.querySelectorAll(`[data-performances-item]`)].forEach((item) => {
    const itemHover = item.querySelector(`[data-performances-hover]`);

    itemHover.addEventListener(`mouseenter`, () => item.classList.add(`performances__item--hover`));

    item.addEventListener(`mouseleave`, () => item.classList.remove(`performances__item--hover`));
  });
})();
