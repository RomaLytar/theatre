export default function schemeDraw() {
  const svgElement = document.querySelector("#scheme");
  const panZoom = svgPanZoom(svgElement, {
    viewportSelector: ".svg-pan-zoom_viewport",
    panEnabled: true,
    controlIconsEnabled: false,
    zoomEnabled: true,
    dblClickZoomEnabled: true,
    mouseWheelZoomEnabled: true,
    preventMouseEventsDefault: true,
    zoomScaleSensitivity: 0.2,
    minZoom: 0.5,
    maxZoom: 10,
    fit: true,
    contain: false,
    center: true,
    refreshRate: "auto",
    eventsListenerElement: null
  });

  document.getElementById("zoom-in").addEventListener("click", (e) => {
    e.preventDefault()
    panZoom.zoomIn()
  });

  document.getElementById("zoom-out").addEventListener("click", (e) => {
    e.preventDefault()
    panZoom.zoomOut()
  });

  document.getElementById("zoom-reset").addEventListener("click", (e) => {
    e.preventDefault()
    panZoom.resetZoom()
    panZoom.resetPan()
  });

  window.addEventListener(`keydown`, (e) => {
    if (e.keyCode === 17) panZoom.disablePan();
  });

  window.addEventListener(`keyup`, (e) => {
    if (e.keyCode === 17) panZoom.enablePan();
  });

  svgElement.addEventListener(`mousedown`, (e) => {
    const target = e.target.closest(`[data-seat]`);

    if (target) panZoom.disablePan();
  });

  svgElement.addEventListener(`mouseup`, (e) => {
    panZoom.enablePan();
  });

  return svgElement
};
