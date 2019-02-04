export default class ImagesControllerClass {
    constructor(item) {
      this.item = item;
      this.form = item.querySelector(`form`);
      this.inputFile = this.form.elements.file;
      this.imageList = item.querySelector(`.kasir__prices-image`);
      this.loadBtn = item.querySelector(`#loadImage`);

      this.inputFile.addEventListener(`change`, (e) => {
        const template = [...e.target.files].map(file => {
          const btnTemplate = `
            <div class="kasir__prices-image-item">
              <img src="${window.URL.createObjectURL(file)}" alt="">
              <div class="info">
                <button type="button" class="btn btn-success" data-check>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 442.533 442.533" width="30" height="30" fill="#fff">
                    <path d="M434.539,98.499l-38.828-38.828c-5.324-5.328-11.799-7.993-19.41-7.993c-7.618,0-14.093,2.665-19.417,7.993L169.59,247.248 l-83.939-84.225c-5.33-5.33-11.801-7.992-19.412-7.992c-7.616,0-14.087,2.662-19.417,7.992L7.994,201.852 C2.664,207.181,0,213.654,0,221.269c0,7.609,2.664,14.088,7.994,19.416l103.351,103.349l38.831,38.828 c5.327,5.332,11.8,7.994,19.414,7.994c7.611,0,14.084-2.669,19.414-7.994l38.83-38.828L434.539,137.33 c5.325-5.33,7.994-11.802,7.994-19.417C442.537,110.302,439.864,103.829,434.539,98.499z"/>
                </button>
              </div>
            </div>`;

            // <button type="button" class="btn btn-danger" data-remove>
            //       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 408.483 408.483" width="30" height="30" fill="#fff">
            //         <path d="M87.748,388.784c0.461,11.01,9.521,19.699,20.539,19.699h191.911c11.018,0,20.078-8.689,20.539-19.699l13.705-289.316
            //           H74.043L87.748,388.784z M247.655,171.329c0-4.61,3.738-8.349,8.35-8.349h13.355c4.609,0,8.35,3.738,8.35,8.349v165.293
            //           c0,4.611-3.738,8.349-8.35,8.349h-13.355c-4.61,0-8.35-3.736-8.35-8.349V171.329z M189.216,171.329
            //           c0-4.61,3.738-8.349,8.349-8.349h13.355c4.609,0,8.349,3.738,8.349,8.349v165.293c0,4.611-3.737,8.349-8.349,8.349h-13.355
            //           c-4.61,0-8.349-3.736-8.349-8.349V171.329L189.216,171.329z M130.775,171.329c0-4.61,3.738-8.349,8.349-8.349h13.356
            //           c4.61,0,8.349,3.738,8.349,8.349v165.293c0,4.611-3.738,8.349-8.349,8.349h-13.356c-4.61,0-8.349-3.736-8.349-8.349V171.329z"/>
            //         <path d="M343.567,21.043h-88.535V4.305c0-2.377-1.927-4.305-4.305-4.305h-92.971c-2.377,0-4.304,1.928-4.304,4.305v16.737H64.916
            //           c-7.125,0-12.9,5.776-12.9,12.901V74.47h304.451V33.944C356.467,26.819,350.692,21.043,343.567,21.043z"/>
            //     </button>

          return btnTemplate;
        }).join(``);

        this.imageList.innerHTML = template;

        this.checkImgList();
      });

      this.item.addEventListener(`click`, (e) => {
        const target = e.target.closest(`.btn`);

        if (!target) return false;

        // if (target.hasAttribute(`data-remove`)) {
        //   const el = target.closest(`.kasir__prices-image-item`),
        //         index = [...this.imageList.children].findIndex(item => item == el);

        //   if (index == -1) return false;

        //   let obj = Object.assign({}, this.inputFile.files);

        //   delete obj[index];

        //   el.remove();

        //   console.log(obj)
        //   // console.log(this.inputFile.files);

        //   this.checkImgList();
        // }
      });
    }

    checkImgList() {
      this.imageList.children == 0 ? this.loadBtn.setAttribute(`data-hidden`) : this.loadBtn.removeAttribute(`data-hidden`);
    }

    // createEventChangePriseZones() {
    //   this.item.dispatchEvent(
    //     new CustomEvent(`seatTypeChange`, {
    //       bubbles: true,
    //       cancelable: true,
    //       detail: {
    //         seatTypeActive: this.seatTypeActive
    //       }
    //     })
    //   )
    // }
  }
