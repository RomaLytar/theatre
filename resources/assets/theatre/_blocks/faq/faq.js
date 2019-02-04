(() => {
  const faq = document.querySelector(`[data-faq]`);

  if (!faq) return false;

  faq.addEventListener(`click`, (e) => {
    const target = e.target.closest(`[data-faq-btn]`);

    if (!target) return false;

    const parent = target.closest(`[data-faq-item]`),
          description = parent.querySelector(`[data-faq-description]`),
          descriptionHeight = description.scrollHeight;

    if (!description) return false;

    if (parent.hasAttribute(`data-active`)) {
      parent.removeAttribute(`data-active`);
      description.style.height = `0`;
      // description.style.marginTop = `0`;
    } else {
      parent.setAttribute(`data-active`, true);
      description.style.height = `${descriptionHeight}px`;
      // if(window.innerWidth < 768) description.style.marginTop = `30px`;
    }
  });
})()
