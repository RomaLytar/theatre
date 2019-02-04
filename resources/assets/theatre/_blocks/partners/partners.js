// (() => {

//   const titleArr = [...document.querySelectorAll(`[data-partner-title]`)];

//   if (!document.querySelector(`[data-partner-title]`)) return false;

//   const getTitleHeight = () => {
//           const titleHeightArr = titleArr.map((item) => item.offsetHeight);

//           getMaxValue(titleHeightArr);
//         },

//         getMaxValue = (arr) => {
//           let maxValue = arr[0];

//           arr.forEach((item) => {
//             if (maxValue < item) maxValue = item;
//           });

//           setTitleHeight(maxValue);
//         },

//         setTitleHeight = (heigth) => {
//           titleArr.forEach((item) => {
//             item.style.height = `${heigth}px`;
//           });
//         };

//   getTitleHeight();
//   window.addEventListener(`resize`, getTitleHeight);

// })();
