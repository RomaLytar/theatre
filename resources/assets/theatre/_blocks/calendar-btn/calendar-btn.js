;(() => {
  const getDateSvgCalendar = function () {

    const svgCalendarArr = [...document.querySelectorAll(`[data-svg-calendar]`)];

    if (!svgCalendarArr) return false;

    svgCalendarArr.forEach((item) => {

      let svgWidth = 20,
            svgHeight = 22,
            textElement = item.querySelector(`text`);
      textElement.innerHTML = new Date().getDate();

      const textElementWidth = Math.round(textElement.textLength.baseVal.value);

      textElement.setAttribute(`x`, (svgWidth - textElementWidth) / 2);
      textElement.setAttribute(`y`, svgHeight - 3);
    });
  }

  getDateSvgCalendar();

  window.addEventListener(`resize`, getDateSvgCalendar);
})();
