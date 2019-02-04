// window.addEventListener("error", (err) => {
//   let errorBlock = document.createElement("div"),
//       template = `
//         <button type="button" class="error__close">Закрыть</button>
//         <figure class="error__img">
//           <img src="/img/error/error-member.jpg" alt="Ответственный" />
//         </figure>
//         <p class="error__text">Извините, произошла ошибка. Ответственный человек свяжется с вами.</p>
//       `;

//   errorBlock.classList.add("error");
//   errorBlock.innerHTML = template;

//   errorBlock.addEventListener("click", (e) => {
//     if (e.target.tagName == "BUTTON") {
//       e.currentTarget.parentElement.removeChild(e.currentTarget);
//     }
//   });

//   document.body.appendChild(errorBlock);
// });
