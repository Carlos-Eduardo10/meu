GMaps.prototype.createPanorama = function (streettelemetria.view_options) {
  if (
    !streettelemetria.view_options.hasOwnProperty("lat") ||
    !streettelemetria.view_options.hasOwnProperty("lng")
  ) {
    streettelemetria.view_options.lat = this.getCenter().lat();
    streettelemetria.view_options.lng = this.getCenter().lng();
  }

  this.panorama = GMaps.createPanorama(streettelemetria.view_options);

  this.map.setStreetView(this.panorama);

  return this.panorama;
};

GMaps.createPanorama = function (options) {
  var el = getElementById(options.el, options.context);

  options.position = new google.maps.LatLng(options.lat, options.lng);

  delete options.el;
  delete options.context;
  delete options.lat;
  delete options.lng;

  var streettelemetria.view_events = [
      "closeclick",
      "links_changed",
      "pano_changed",
      "position_changed",
      "pov_changed",
      "resize",
      "visible_changed",
    ],
    streettelemetria.view_options = extend_object({ visible: true }, options);

  for (var i = 0; i < streettelemetria.view_events.length; i++) {
    delete streettelemetria.view_options[streettelemetria.view_events[i]];
  }

  var panorama = new google.maps.StreetViewPanorama(el, streettelemetria.view_options);

  for (var i = 0; i < streettelemetria.view_events.length; i++) {
    (function (object, name) {
      if (options[name]) {
        google.maps.event.addListener(object, name, function () {
          options[name].apply(this);
        });
      }
    })(panorama, streettelemetria.view_events[i]);
  }

  return panorama;
};
