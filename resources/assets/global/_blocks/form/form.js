;(() => {
  $(`input[type='tel']`).mask(`+38 (000) 000 00 00`);

  window.FormCustomValidation = class {
    constructor(obj) {
      this.obj = obj;
      this._popup = this.obj.closest(`[data-popup]`);
      this._regExp = {
        EMAIL: /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/,
        NAME: /^([A-Za-zА-Яа-яЁё\s]{2,})*$/,
        TEL: /^(\+38)\s(\([0-9]{3}\))\s([0-9]{3})\s([0-9]{2})\s([0-9]{2})$/
      };
      this.requiredFields = obj.querySelectorAll(`:required`);
      this.allFields = obj.querySelectorAll(`[data-input]`);
      this.buttonSubmit = obj.querySelector(`[type=submit]`);
      this.buttonSubmit.addEventListener(`click`, (e) => this.checkValidation(e));

      this.TextError = window.CONSTANT;

      [...this.allFields].forEach((item) => item.addEventListener(`blur`, (e) => this._fieldAnimateText(item)));
      [...this.requiredFields].forEach((item) => item.addEventListener(`input`, (e) => this._keyInput(item)));
    }

    checkValidation(e) {
      let formValid = [...this.requiredFields].every(item => this.fieldValidation(item));

      if (formValid) {
        e.preventDefault();
        this._sendData();
      } else {
        console.warn(`Not correct data`);
      }
    };

    fieldValidation(item) {
      let value = item.value,
            type = item.type;

      if (type == `text`) type = item.name;

      type = type.toUpperCase();

      if (this._regExp[type]) {
        if (value.search(this._regExp[type]) != 0) {
          this._fieldInvalid(item);
          return false;
        } else {
          this._fieldValid(item);
          return true;
        }
      } else {
        console.log(`This field type ${type} was not found in regExp`);
        return true;
      }
    };

    _fieldAnimateText(item) {
      const value = item.value;

      if (value.length) {
        item.setAttribute(`data-input-fill`, true);
      } else {
        item.removeAttribute(`data-input-fill`);
      }
    };

    _keyInput(item) {
      this.fieldValidation(item);
    };

    _fieldValid(item) {
      const placeholder = item.parentElement.querySelector(`[data-text-placeholder]`);

      item.removeAttribute(`data-input-error`);
      item.setAttribute(`data-input-done`, true);
      item.setCustomValidity(``);

      if (placeholder) placeholder.innerHTML = ``;
    };

    _fieldInvalid(item) {
      item.removeAttribute(`data-input-done`);
      item.setAttribute(`data-input-error`, true);

      const itemType = item.type.toUpperCase(),
            placeholder = item.parentElement.querySelector(`[data-text-placeholder]`);

      if (item.name.toUpperCase() === `NAME`) {
        if (item.validity.tooShort) {
          item.setCustomValidity(this.TextError.FORM.MESSAGE.ERROR.NAME_LENGTH[this.TextError.LANG]);
        } else {
          item.setCustomValidity(this.TextError.FORM.MESSAGE.ERROR.NAME[this.TextError.LANG]);
        }

        if (placeholder) placeholder.innerHTML = this.TextError.FORM.MESSAGE.ERROR.NAME[this.TextError.LANG];

      } else if (item.name.toUpperCase() === `EMAIL`) {
        if (placeholder) placeholder.innerHTML = this.TextError.FORM.MESSAGE.ERROR.EMAIL[this.TextError.LANG];
      } else if (item.name.toUpperCase() === `TEL`) {
        if (placeholder) placeholder.innerHTML = this.TextError.FORM.MESSAGE.ERROR.TEL[this.TextError.LANG];
      } else {
        item.setCustomValidity(this.TextError.FORM.MESSAGE.ERROR[itemType][this.TextError.LANG]);
      }
    };

    _sendData(item) {
      window.customAjax({
        url: this.obj.action,
        method: this.obj.method,
        data: new FormData(this.obj),
      }).then((data) => {
        if (this._popup) {
          this._popup.customPopup.close();
        }

        window.popupFeedback(this.TextError.FORM.FEEDBACK.OK[this.TextError.LANG]);
      }, (error) => {
        window.popupFeedback(this.TextError.FORM.FEEDBACK.ERROR[this.TextError.LANG]);
        console.warn(error);
      });
    };
  }
})();

;(() => {
  window.addEventListener(`load`, (e) => {
    [...document.querySelectorAll(`[data-form-validate]`)].map((item) => new FormCustomValidation(item));
  })
})();


;(() => {
  const inputs = document.querySelectorAll('input[type=file]');
  Array.prototype.forEach.call( inputs, function( input ) {
    let span  = input.nextElementSibling,
      labelVal = span.innerHTML;

    input.addEventListener( 'change', function( e ) {
      let file = input.files[0],
          fileName = e.target.value.split( '\\' ).pop(),
          size = 2097152;
          // extension = e.target.value.split('.').pop();

      // if(extension==`pdf` || extension==`docx` || extension==`doc`){
      //     alert(`only pdf, doc, docx`);
      // }

      if (file.size > size) {
        alert("File must be less than 2MB");
        return false;
      }

      if( fileName )
        span.innerHTML = fileName;
      else
        span.innerHTML = labelVal;
    });
  });
})();
