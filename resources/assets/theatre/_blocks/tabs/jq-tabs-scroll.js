(() => {

  const navScroll = document.querySelector(`[data-nav-scroll]`);

  if (!navScroll) return false;


  let navScrollParent = navScroll.parentElement,
        navScrollHeight = navScroll.offsetHeight,
        eventName = document.querySelector(`[data-event-name]`).textContent,
        eventBtn = document.querySelector(`[data-event-btn]`),
        eventScrollTabs = document.querySelector(`[data-event-scroll-tabs]`);

  $(`a[data-scroll]`).on(`click`, function() {
    const currentNavScroll = document.querySelector(`[data-nav-scroll]`),
          currentNavScrollHeight = currentNavScroll.offsetHeight;

    console.log(currentNavScrollHeight);
    if (location.pathname.replace(/^\//,`) == this.pathname.replace(/^\//,`) && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $(`[name=` + this.hash.slice(1) +`]`);

      if (target.length) {
        $(`html,body`).animate({
          scrollTop: target.offset().top - currentNavScrollHeight
        }, 1000);
        return false;
      }
    }
  });

  if(eventBtn = document.querySelector(`[data-event-btn]`)) {
    const eventBtnCloned = eventBtn.cloneNode(true);
    eventScrollTabs.append(eventBtnCloned);
  }
  eventScrollTabs.insertAdjacentHTML(`afterBegin`, `<p data-event-name class="tabs__title">${eventName}</p>`);

  const fixNavScrollPosition = () => {
    if (window.innerWidth < 768) {
      if(navScroll.hasAttribute(`data-active`)) {
        navScroll.removeAttribute(`data-active`);
        navScroll.style = ``;
        navScrollParent.style = ``;
      }
    } else {
      const navScrollParentPosition = {
              top: navScrollParent.getBoundingClientRect().top,
              left: parseInt(getComputedStyle(document.body).paddingLeft),
              height: navScrollParent.offsetHeight
            };

      if (navScrollParentPosition.top < 0) {
        navScroll.dataset.active = true;
        navScroll.style.left = `${navScrollParentPosition.left}px`;
        navScrollParent.style.paddingTop = `${navScrollHeight}px`;

        if (navScrollParentPosition.top + navScrollParentPosition.height < 0) {
          navScroll.style.opacity = 0;
          navScroll.style.zIndex = -1;
        } else {
          navScroll.style.opacity = 1;
          navScroll.style.zIndex = ``;
        }
      } else {
        navScroll.removeAttribute(`data-active`);
        navScroll.style = ``;
        navScrollParent.style = ``;
      }
    }
  };

  window.addEventListener(`scroll`, fixNavScrollPosition);
  window.addEventListener(`resize`, fixNavScrollPosition);
})();

