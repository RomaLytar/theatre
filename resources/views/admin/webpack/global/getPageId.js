export default function getIdPage() {
  const winLoc = location.href,
        hallPricePatternId = winLoc.slice(winLoc.lastIndexOf(`/`) + 1);

  return hallPricePatternId;
};
