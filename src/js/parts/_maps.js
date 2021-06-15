/*
	Google Map integration: Multiple pointers with infowindows
*/

var mapStylesObj = {
    "default": []
};

function initmultiplePointersMap(mapId, markers, mapStyle) {
    var google = window.google;
    mapStyle = mapStyle ? mapStyle : 'default';
    var $viewportWidth = window.innerWidth;
    var isDraggable = $viewportWidth > 767 ? true : false;

    // Nel caso sia una mappa di layout disabilito alcune funzioni
    //isDraggable = mapStyle == 'gray_normal' ? isDraggable : false;
    var disableDefaultUI = $viewportWidth > 767 ? disableDefaultUI : false;

    var mapOptions = {
        zoom: 13,
        styles: mapStylesObj[mapStyle],
        mapTypeControl: false,
        disableDefaultUI: disableDefaultUI,
        scrollwheel: false,
        draggable: isDraggable,
        //zoomControl: $viewportWidth > 767 ? activeControl : true,
        //mapTypeControl: true,
        //scaleControl: $viewportWidth > 767 ? activeControl : true,
        //streetViewControl: $viewportWidth > 767 ? activeControl : false,
        //rotateControl: true,
        //fullscreenControl: $viewportWidth > 767 ? activeControl : false,
    };


    // Init map
    let multiplePointersMap = new google.maps.Map(document.getElementById(mapId), mapOptions);

    // Init map bounds
    let bounds = new google.maps.LatLngBounds();

    // Store {lat, lng} objects to be used when drawing line later
    let lineCoordinates = [];

    // Cycle pointers
    for ( let i = 0; i < markers.length; i++) {

        // Pointer coordinates
        var coo = [markers[i].map_pointer.lat, markers[i].map_pointer.lng];
        lineCoordinates.push({ lat: markers[i].map_pointer.lat, lng: markers[i].map_pointer.lng });
        var info = markers[i].txt;

        // Build pointer
        let tmpPointer = new google.maps.LatLng(coo[0], coo[1]);
        bounds.extend(tmpPointer);

        var markerIcon = templateUrl + '/dist/images/pointer.png';

        var markerObj = {
            map: multiplePointersMap,
            position: tmpPointer,
            title: 'marker'+i,
            icon: {
                url: markerIcon,
                // This marker is 20 pixels wide by 32 pixels high.
                size: new google.maps.Size(54, 78),

                // The origin for this image is (0, 0).
                // origin: new google.maps.Point(12.5, 12.5),

                // The anchor for this image is the base of the flagpole at (0, 32).
                anchor: new google.maps.Point(15, 39),
                scaledSize: new google.maps.Size(27, 39),
            }
        };

        var marker = new google.maps.Marker(markerObj);

        if (info) {
            const infowindow = new google.maps.InfoWindow({
                content: info,
            });

            marker.addListener('click', function() {
                infowindow.open(multiplePointersMap, marker);
            });

            /*
            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                if (!markers[i].marker_link) {
                    return function() {
                        infowindow.setContent(markers[i].txt);
                        infowindow.open(multiplePointersMap, marker);
                    };
                }
            }));
            */
        }
    }

    // Check if we have a single pointer and center the map
    if ( markers.length == 1 ){
        multiplePointersMap.setCenter(bounds.getCenter());
        multiplePointersMap.setZoom(17);
    } else {
        multiplePointersMap.fitBounds(bounds);
    }
}

window.checkAndStartMap = function(){
    if (window.google_maps_data) {

        for (let i = 0; i < window.google_maps_data.length; i++) {

            let mapId = window.google_maps_data[i].map_id;
            let mapStyle = window.google_maps_data[i].map_style ? window.google_maps_data[i].map_style : false;
            let markers = window.google_maps_data[i].markers;

            if ( markers ) {
                initmultiplePointersMap(mapId, markers, mapStyle);
            }
        }
    }
};
