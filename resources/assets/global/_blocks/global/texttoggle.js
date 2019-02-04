class ToggleText  {
  constructor(item) {
    this.item = item;
    this.text = this.item.querySelector(`[data-texttoggle-toggled]`);
    this.model = this.item.querySelector(`[data-texttoggle-model]`);
    this.parent = this.item.querySelector(`[data-texttoggle-parent]`);
    this.btn = item.querySelector(`[data-texttoggle-btn]`);
    this.timer = null;

    this.calcHeight(item);

    this.btn.addEventListener("click", (e) => this.toggle(item));
    window.addEventListener("resize", (e) => {
      clearTimeout(this.timer);

      this.timer = setTimeout(() => {
        this.calcHeight(item);
      }, this.getTransitionText())
    });
  }

  getTransitionText(){
    return parseFloat(getComputedStyle(this.text).transitionDuration) * 1000;
  }

  getMarginText(){
    if(window.innerWidth < 768) {
      return 0;
    } else {
      return parseFloat(getComputedStyle(this.text).marginBottom);
    }
  }

  getBtnMoreHeight(){
    let btnMore = this.parent.querySelector(`[data-more-btn]`),
        btnMoreHeight = 0;

    if(btnMore) btnMoreHeight = btnMore.offsetHeight;
    return btnMoreHeight;
  }

  getLineHeightText(){
    let textLineheight = parseInt(getComputedStyle(this.text).lineHeight),
        lineHeightCount;

    if(window.innerWidth < 768) {
      lineHeightCount = 8;
    } else {
      lineHeightCount = Math.round((this.model.offsetHeight - this.text.offsetTop - this.getBtnMoreHeight()) / parseInt(getComputedStyle(this.text).lineHeight));
    }

    return lineHeightCount * textLineheight;
  }

  calcHeight(item){
    if(!this.text.hasAttribute(`data-texttoggled`)) {
      this.setTextHeight(`auto`);
    }

    if(item.hasAttribute(`data-text`)){
      if(window.innerWidth < 768){

        let height = this.getLineHeightText();

        if(this.text.offsetHeight > height) {
          this.text.setAttribute(`data-need-toggle`, true);
          this.setTextHeight(`${height}px`);
        } else {
          if(this.text.hasAttribute(`data-need-toggle`)) {
            this.text.removeAttribute(`data-need-toggle`);
          }
        }

        if (this.text.hasAttribute(`data-texttoggled`)){
          this.text.removeAttribute(`data-texttoggled`);
        }
      } else {
        if(this.text.hasAttribute(`data-need-toggle`)) {
          this.text.removeAttribute(`data-need-toggle`);
        }
      }
    } else if(!item.hasAttribute(`data-text`)){


      let modelHeight = this.model.offsetHeight,
          textTop = this.text.offsetTop,
          textHeightInitial = this.text.offsetHeight;



      if(modelHeight < (textTop + textHeightInitial + this.getBtnMoreHeight())) {
        this.text.setAttribute(`data-need-toggle`, true);
        this.setTextHeight(`${this.getLineHeightText() - this.getMarginText()}px`);

      } else {
        if(this.text.hasAttribute(`data-need-toggle`)) {
          this.text.removeAttribute(`data-need-toggle`);
        }
      }

      if (this.text.hasAttribute(`data-texttoggled`)){
        this.text.removeAttribute(`data-texttoggled`);
      }
    }
  }

  setTextHeight(height){
    this.text.style.height = height;
  }

  toggle(item){
    if (this.text.hasAttribute(`data-texttoggled`)){
      this.calcHeight(item);
    } else {

      this.setTextHeight(`${this.text.scrollHeight}px`);

      this.text.setAttribute(`data-texttoggled`, true);
    }
  }
}

[...document.querySelectorAll(`[data-texttoggle-container]`)].map((item) => {
  return new ToggleText(item);
});
