// add attribute mail-to tolinks

;(() => {
  const parentEl = document.querySelector(`[data-mail-to-container]`);
  if (!parentEl) return false;
  const linksArr = [...parentEl.querySelectorAll(`a`)];
  linksArr.forEach((item) => {
    if(item.innerHTML.indexOf(`@`) > 0){
      let link = `mailto:${item.textContent}`;
      item.setAttribute(`href`, link);
    }
  })
})();
