/**
 * Generated google maps based on spot tracking.
 *
 * @author Tom Bradshaw
 */

/**
 * The API key
 */
var key;

/**
 * Constructor.
 *
 * @type {{init}}
 */
var TRACKING = TRACKING || (function () {

            return {
                init: function (Args) {
                    key = Args[0];
                }
            };
        }()
    );

/**
 * Bootstrapping function for google maps initialisation
 */
function initMap() {
    $.get("https://www.bananaroamer.com:8443/tracker-service/checkin/" + key, function (data) {
        drawMap(data.coordinates);
    });
}

/**
 * Function to draw, centre and scale a google map from an array of co-ordinate objects.
 *
 * @param coordinates An array of google lat / long co-ordinates
 */
function drawMap(coordinates) {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 3,
        center: {lat: 0, lng: 0},
        mapTypeId: 'terrain',
        scrollwheel: false
        // Turn these options off for now. Allow people to move and the map if they feel the need to.
        // draggable: false,
        // scaleControl: false
    });

    // Scale and centre
    var bounds = getBounds(coordinates);
    map.fitBounds(bounds);
    map.panToBounds(bounds);

    // Draw the tripline
    var tripLine = getTripLine(coordinates);
    tripLine.setMap(map);

    // Add start and end markers
    addStartAndEndMarkers(coordinates, map);
}

/**
 * Gets the bounds of all the co-ordinates so they can be applied to fitBounds() / panToBounds()
 *
 * @param coordinates An array of google lat / long co-ordinates
 * @returns {google.maps.LatLngBounds} The bounds.
 */
function getBounds(coordinates) {
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, l = coordinates.length; i < l; i++) {
        bounds.extend(coordinates[i]);
    }
    return bounds;
}

/**
 * Creates and returns a google.maps.Polyline for the given co-ordinates.
 *
 * @param coordinates An array of google lat / long co-ordinates
 * @returns {google.maps.Polyline}
 */
function getTripLine(coordinates) {
    var tripLine = new google.maps.Polyline({
        path: coordinates,
        geodesic: true,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 2
    });
    return tripLine;
}

/**
 * Adds the first and final co-ordinates to the map as markers, signalling the start and end-points in
 * different colours.
 *
 * @param coordinates The full set of co-ordinates
 * @param map {The google.maps.Map} to add the markers to.
 **/
function addStartAndEndMarkers(coordinates, map) {
    // Start
    new google.maps.Marker({
        position: coordinates[0],
        map: map,
        title: "Start",
        icon: getMarkerIcon('#ff0000')
    });

    // End
    new google.maps.Marker({
        position: coordinates[coordinates.length - 1],
        map: map,
        title: "End",
        icon: getMarkerIcon('#00ff00')
    });
}
function getMarkerIcon(colour) {
    return {
        path:
        "M0-48c-9.8 0-17.7 7.8-17.7 17.4 0 15.5 17.7 30.6 17.7 " +
        "30.6s17.7-15.4 17.7-30.6c0-9.6-7.9-17.4-17.7-17.4z",
        scale: 0.7,
        strokeWeight: 3,
        fillColor: colour,
        fillOpacity: 0.5
    };
}
