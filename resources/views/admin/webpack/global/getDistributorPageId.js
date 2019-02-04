export default function getDistributorPageId() {
  const winLoc = location.href,
        lastIndex = location.href.lastIndexOf(`/`),
        hallPricePatternId = winLoc.slice(winLoc.indexOf(`performanceCalendars`) + 21, lastIndex);

  return hallPricePatternId;
};
