(() => {
  window.calcHeightSlick = (slider) => {
    $(document).ready(function() {
      slider.on(`setPosition`, function () {
        $(this).find(`.slick-slide`).height(`auto`);
        var slickTrack = $(this).find(`.slick-track`);
        var slickTrackHeight = $(slickTrack).height();
        $(this).find(`.slick-slide`).css(`height`, slickTrackHeight + `px`);
      });
    });
  };
})();
