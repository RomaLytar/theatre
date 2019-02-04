;(function(){
  const KEYCODES = {
    ESC: 27,
    ENTER: 13
  };

  window.keyCodeObject = {
    isEscEvent(e, action) {
      if (e.keyCode === KEYCODES.ESC) {
        action();
      }
    },

    isEnterEvent(e, action) {
      if (e.keyCode === KEYCODES.ENTER) {
        action();
      }
    }
  }
})();
