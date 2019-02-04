(() => {
  const socialLikes = document.querySelector(`[data-social-likes]`);

  if (!socialLikes) return false;

  const script = document.createElement(`script`);
        script.src = `https://cdn.jsdelivr.net/npm/social-likes/dist/social-likes.min.js`;

  document.body.appendChild(script);

  script.addEventListener(`load`, (e) => {
    $(`[data-social-likes-list]`).socialLikes();
  });
})();


// remove social-share on description block
(() => {
  const replaceSocialShareBlock = function(){
    const replaceSocialParent = document.querySelector(`[data-replace-social-share]`);
    if (!replaceSocialParent) return false;

    let removed = replaceSocialParent.getAttribute(`data-replace-social-share`),
        replaceSocialBlock = replaceSocialParent.querySelector(`[data-replace-social-share-block]`),
        parentAbout = replaceSocialParent.querySelector(`[data-about]`);
    if (!removed) {
      if (window.innerWidth < 768 && replaceSocialBlock) {
        parentAbout.appendChild(replaceSocialBlock);
        replaceSocialParent.setAttribute(`data-replace-social-share`, `removed`);
      }
    } else {
      if (window.innerWidth >= 768 && replaceSocialBlock) {
        let parentInfo = replaceSocialParent.querySelector(`[data-info]`);
        parentInfo.appendChild(replaceSocialBlock);
        replaceSocialParent.setAttribute(`data-replace-social-share`, ``);
      }
    }
  }

  replaceSocialShareBlock();
  window.addEventListener(`resize`, replaceSocialShareBlock);
})();
