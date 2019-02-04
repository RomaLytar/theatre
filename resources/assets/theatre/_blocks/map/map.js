(() => {
  const replaceMap = function(){
    const pageTitle = document.querySelector(`[data-mob-map-innit]`);
    if (!pageTitle) return false;

    let replaced = pageTitle.getAttribute(`data-replaced`),
        replaceMapParent = document.querySelector(`[data-map-parent]`),
        replaceMap = document.querySelector(`[data-map]`);
        // parentAbout = replaceSocialParent.querySelector(`[data-about]`);
    if (!replaced) {
      if (window.innerWidth < 768 && replaceMap) {
        pageTitle.parentNode.insertBefore(replaceMap, pageTitle.nextSibling);
        pageTitle.setAttribute(`data-replaced`, `replaced`);
      }
    } else {
      if (window.innerWidth >= 768) {
        replaceMapParent.appendChild(replaceMap);
        pageTitle.removeAttribute(`data-replaced`);
      }
    }
  }

  replaceMap();
  window.addEventListener(`resize`, replaceMap);
})();
