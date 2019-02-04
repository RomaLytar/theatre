// ;(function(){
//   const replaceSocialBlock = function(){
//     let footerSocialBlock = document.querySelector(`[data-footer-social]`),
//           headerSocialBlock = document.querySelector(`[data-header-social]`),
//           socialBlockInFooter = footerSocialBlock.querySelector(`[data-social]`),
//           socialBlockInHeader = headerSocialBlock.querySelector(`[data-social]`);

//     if(window.innerWidth <= 1024) {
//       if(socialBlockInFooter) {
//         return false;
//       } else {
//         socialBlockInHeader = headerSocialBlock.querySelector(`[data-social]`);
//         if(socialBlockInHeader) {
//           socialBlockInFooter = socialBlockInHeader;
//           socialBlockInHeader.remove();
//           footerSocialBlock.appendChild(socialBlockInFooter);
//         }
//       }
//     } else {
//       if(socialBlockInHeader) {
//         return false;
//       } else {
//         socialBlockInFooter = footerSocialBlock.querySelector(`[data-social]`);
//         if(socialBlockInFooter) {
//           socialBlockInHeader = socialBlockInFooter;
//           socialBlockInFooter.remove();
//           headerSocialBlock.appendChild(socialBlockInHeader);
//         }
//       }
//     }
//   }

//   replaceSocialBlock();
//   window.addEventListener(`resize`, replaceSocialBlock);
// })();
