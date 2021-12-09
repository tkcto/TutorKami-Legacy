<!DOCTYPE html>
<html>
<head>
    <title>Google Maps API - Autocomplete Address Search Box with Map Example</title>
    <style type="text/css">
        #map {
            width: 100%;
            height: 400px;
        }
        .mapControls {
            margin-top: 10px;
            border: 1px solid transparent;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            height: 32px;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }
        #searchMapInput {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 50%;
        }
        #searchMapInput:focus {
            border-color: #4d90fe;
        }
    </style>
</head>
<body>
  
<h1>Google Maps API - Autocomplete Address Search Box with Map Example</h1>
  
<input id="searchMapInput" class="mapControls" type="text" placeholder="Enter a location">
<div id="map"></div>
<ul id="geoData">
    <li>Full Address: <span id="location-snap"></span></li>
    <li>Latitude: <span id="lat-span"></span></li>
    <li>Longitude: <span id="lon-span"></span></li>
</ul>
  
<script>
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 22.3038945, lng: 70.80215989999999},
      zoom: 13
    });
    var input = document.getElementById('searchMapInput');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
   
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);
  
    var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
    });
  
    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
    
        /* If the place has a geometry, then present it on a map. */
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
        marker.setIcon(({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
        }));
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
      
        var address = '';
        if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }
      
        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        infowindow.open(map, marker);
        
        /* Location details */
        document.getElementById('location-snap').innerHTML = place.formatted_address;
        document.getElementById('lat-span').innerHTML = place.geometry.location.lat();
        document.getElementById('lon-span').innerHTML = place.geometry.location.lng();
    });
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initMap" defer></script>
  
</body>
</html>