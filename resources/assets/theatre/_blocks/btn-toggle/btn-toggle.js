// class ToggleBtn  {
//   constructor(item) {
//     this.item = item;
//     // this.type = this.item.dataset.filterItem;
//     this.list = this.item.querySelector(`[data-toggle-list]`);
//     this.button = this.item.querySelector(`[data-toggle-btn]`);
//     this.button.addEventListener(`click`, (e) => {
//       this.drop();
//     });
//   }

//   drop(){
//     if (this.item.hasAttribute(`data-active`)){
//       this.item.removeAttribute(`data-active`);
//       this.list.style = ``;
//     } else {

//       const heightToPageBottom = window.innerHeight - this.button.getBoundingClientRect().top - this.button.offsetHeight;
//       if (heightToPageBottom < parseInt(window.getComputedStyle(this.list).maxHeight)) {
//         this.list.style.maxHeight = `${heightToPageBottom}px`;
//       }
//       this.item.setAttribute(`data-active`, true);

//     }
//   }
// }

// [...document.querySelectorAll(`[data-toggle-item]`)].map((item) => {
//   if (!item || window.innerWidth >= 768) return false;
//     return new ToggleBtn(item);
// });


