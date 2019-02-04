;(function() {
  window.popupFeedback = (text) => {
    const generateElement = (template) => {
      const container = document.createElement("section");
            container.classList.add("popup");
            container.classList.add("popup--feedback");
            container.classList.add("popup--active");
            container.dataset.popup = "feedback";
            container.innerHTML = template;

      const onPopupEscPress = (e) => window.keyCodeObject.isEscEvent(e, removeElement);

      const removeElement = () => {
        popupEvent(false);
        document.body.removeChild(container);
        document.removeEventListener("keydown", onPopupEscPress);

      };

      const popupEvent = (flag) => {
        let event = new CustomEvent("bodyOverflow", {
          bubbles: true,
          detail: {
            opened: flag,
            openedObj: container
          }
        });

        document.dispatchEvent(event);
      };

      container.addEventListener("click", (e) => {
        const target = e.target;

        if (target.closest("[data-popup-close]")) {
          removeElement();
        }
      });

      document.addEventListener("keydown", onPopupEscPress);

      container.addEventListener("keydown", (e) => window.keyCodeObject.isEnterEvent(e, removeElement));

      popupEvent(true);

      return container;
    };

    const popupFeedbackTemplate = (text) => `
      <div class="popup__inner">
        <div class="popup__wrap">
          <button type="button" class="popup__close" data-popup-close>
            Close
            <svg width="46" height="46" fill="#666666">
              <use xlink:href="#icon-cross" />
            </svg>
          </button>
          <p class="popup__feedback-text">${text}</p>
        </div>
      </div>`;

    document.body.appendChild(generateElement(popupFeedbackTemplate(text)));
  };
})();
