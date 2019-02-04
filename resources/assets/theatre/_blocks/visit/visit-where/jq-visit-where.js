(() => {
  const mapElementArr = document.querySelectorAll(`[data-map]`);

  if (mapElementArr) {
    const createMarker = (coordinates, map) => {
      const coordinateParse = coordinates.split(`,`);

      return new google.maps.Marker({
        position: {lat: parseFloat(coordinateParse[0].trim()), lng: parseFloat(coordinateParse[1].trim())},
        map: map,
        title: ``,
        zIndex: 9999
      });
    }

    [...mapElementArr].forEach(mapElement => {
      const scale = parseFloat(mapElement.dataset.mapScale) || 11,
            drag = true,
            scroll = false,
            zoomAuto = mapElement.dataset.autoZoom || false,
            bounds = new google.maps.LatLngBounds(),
            coordinate = mapElement.dataset.mapCoordinate.split(`;`);

      let markers = [];

      const map = new google.maps.Map(mapElement, {
        zoom: scale,
        center: new google.maps.LatLng(parseFloat(coordinate[0].split(`,`)[0].trim()), parseFloat(coordinate[0].split(`,`)[1].trim())),
        panControl: false,
        zoomControl: false,
        mapTypeControl: false,
        streetViewControl: false,
        draggable: drag,
        scrollwheel: scroll
      });

      if (coordinate.length) {
        markers = coordinate.map(item => {
          const marker = createMarker(item, map);

          if (zoomAuto) bounds.extend(new google.maps.LatLng(marker.position.lat(), marker.position.lng()));

          return marker;
        });
      }

      if (markers.length) markers.forEach(marker => marker.setMap(map));

      if (zoomAuto) {
        map.fitBounds(bounds);
        map.panToBounds(bounds);
      }
    });
  }
})();
