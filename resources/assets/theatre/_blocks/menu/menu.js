(function(){
  const closeMenu = function(e) {
        if(e.target.parentElement && e.target.parentElement.querySelector(`[data-menu-second]`) || e.target.parentElement && e.target.parentElement.hasAttribute(`data-menu-item`)){
          e.preventDefault();
        }
        let menu = document.querySelector(`[data-menu]`);
        if(menu.classList.contains(`active`)){
          menu.classList.remove(`active`);
          [...menu.querySelectorAll(`[data-menu-item]`)].forEach((item) => {
            if(item.classList.contains(`active`)) {
              let secondElenentsArr = [...item.querySelectorAll(`a[tabindex]`)];
              item.classList.remove(`active`);
              secondElenentsArr.forEach((item) => {
                item.tabIndex = `-1`;
              })
            }
          });
        }
      },
      openMenu = function(e, element) {
        if(element.querySelector(`[data-menu-second]`)){
          e.preventDefault();
          let menu = element.closest(`[data-menu]`),
              secondElenentsArr = [...element.querySelectorAll(`a[tabindex]`)];

          if(!menu.classList.contains(`active`)) {
            menu.classList.add(`active`);

          } else {
            [...menu.querySelectorAll(`[data-menu-item]`)].forEach((item) => {
              if(item.classList.contains(`active`)) {
                e.preventDefault();
                item.classList.remove(`active`);
                [...item.querySelectorAll(`a[tabindex]`)].forEach((item) => {
                  item.tabIndex = `-1`;
                })
              }
            });
          }
          element.classList.add(`active`);
          secondElenentsArr.forEach((item) => {
            item.tabIndex = ``;

          })
        }
      };

  window.addEventListener(`click`, (e) => {
    let element = e.target.closest(`[data-menu-item]`);
    if(!element || element.classList.contains(`active`)) {
      closeMenu(e);
    } else {
      openMenu(e, element);
    }
 });

  window.addEventListener(`keydown`, (e) => {
    if (e.keyCode === 27) {
      if(document.querySelector(`[data-menu]`).classList.contains(`active`)){
        e.preventDefault();
        closeMenu(e);
      }
    }
  })
})();



(function() {
  window.Menu = class {
    constructor(options) {
      this._elem = options.elem;
      this._header = document.querySelector(`[data-header]`);
      this._btn = document.querySelector(`[data-menu-btn]`);
      this._opened = options.opened || false;
      this._btn.addEventListener("click", (e) => {
        this._onClick(e);
      });
    }

    _onClick(e) {
        e.preventDefault();
        this._menuToggle();
    }

    // Menu
    _onMenuChange() {
      this._elem.dispatchEvent(new CustomEvent("bodyOverflow", {
        bubbles: true,
        detail: {
          open: this._opened,
          openedObj: this._elem
        }
      }));
    }

    _menuToggle() {
      this._header.dataset.active == `true` ? this._menuClose() : this._menuOpen();
    }

    _menuOpen() {
      this._header.dataset.active = true;
      this._opened = true;
      this._onMenuChange();
    };

    _menuClose() {
      this._header.removeAttribute(`data-active`);
      this._opened = false;
      this._onMenuChange();
    };
  }

  if (document.querySelector(`[data-menu]`)) {
    window.pageMenu = new Menu({
      elem: document.querySelector(`[data-menu]`)
    });
  }
})();
