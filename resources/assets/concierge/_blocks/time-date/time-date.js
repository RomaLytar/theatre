(() => {
  let dateBlock = document.querySelector(`[data-current-date]`),
      timeBlock = document.querySelector(`[data-current-time]`);

    if (!dateBlock && !timeBlock) return false;

    function getCurrentDate(){
      const date = new Date();

      let formatTime = new Intl.DateTimeFormat("uk", {
            hour: "numeric",
            minute: "numeric",
            second: "numeric"
          }),
          formatDate = new Intl.DateTimeFormat("uk");

      dateBlock.innerHTML = formatDate.format(date);
      timeBlock.innerHTML = formatTime.format(date);

      // console.log(formatDate.format(date) ); // 31.12.2014

      // console.log(formatTime.format(date) ); // 12:30:00
    }

    setInterval(() => {getCurrentDate()}, 1000);

})();

