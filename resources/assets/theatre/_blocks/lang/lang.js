(function(){
  const langBlock = document.querySelector(`[data-lang]`),
        lang = document.documentElement.lang;

  if (!langBlock) return false;

  const form = langBlock.querySelector(`[data-lang-form]`),
        select = form.querySelector(`select`),
        listLinkArr = langBlock.querySelector(`[data-lang-list]`).querySelectorAll(`a`);

  form.addEventListener(`change`, function(e) {
    this.submit();
  });

  listLinkArr.forEach(link => {
    const defaultSelected = lang === link.getAttribute(`href`) ? true : false;

    let option = new Option(link.textContent, link.getAttribute(`href`), defaultSelected, defaultSelected);

    select.appendChild(option);

    link.addEventListener(`click`, (e) => {
      e.preventDefault();

      if (!link.closest(`li`).classList.contains(`lang__list-active`)) {
        option.selected = true;

        const event = new Event(`change`, {bubbles: true, cancelable: true});

        option.dispatchEvent(event);
      }
    });
  });
})();
