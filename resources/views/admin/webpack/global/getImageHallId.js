export default function getImageHallId() {
  const winLoc = location.href,
        lastIndex = location.href.lastIndexOf(`/`),
        hallPricePatternId = winLoc.slice(winLoc.indexOf(`halls`) + 6, lastIndex);

  return hallPricePatternId;
};
