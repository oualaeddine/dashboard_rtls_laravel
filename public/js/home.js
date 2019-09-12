var map;
initMap();

function initMap() {

    map = L.map('mapid', {
        minZoom: 1,
        maxZoom: 4,
        center: [0, 0],
        zoom: 1,
        crs: L.CRS.Simple,
        attributionControl: false
    });

    var w = 1280 * 3,
        h = 806 * 3,
        url = './plan_with_ch.svg';
// calculate the edges of the image, in coordinate space
    var southWest = map.unproject([0, h], map.getMaxZoom() - 1);
    var northEast = map.unproject([w, 0], map.getMaxZoom() - 1);
    var bounds = new L.LatLngBounds(southWest, northEast);

// add the image overlay,
// so that it covers the entire map
    L.imageOverlay(url, bounds).addTo(map);

    map.setMaxBounds(bounds);

    L.control.attribution({
        prefix: false
    }).addAttribution('<a href="https://ktalyse.com">Ktalyse.com</a>').addTo(map);

    function clicked(e) {
        //  console.log(e.latlng)
    }

    map.on('click', clicked);
}

var personsRooms = [];
var markers = [];

function addPerson(room, person) {
    // noinspection EqualityComparisonWithCoercionJS
    if (personsRooms[person.id] != room) {
        if (typeof markers[person.id] !== 'undefined') {
            map.removeLayer(markers[person.id])
        }

        var fullname = person.firstname + " " + person.lastname;
        var polygonPoints = [];
        for (let i = 0; i < room.corners.length; i++) {
            polygonPoints[i] = [room.corners[i].x, room.corners[i].y]
        }
        var poly = L.polygon(polygonPoints);
        var m = randomPointInPoly(poly);
        var icon, color_class;
        switch (person.type) {
            case "PENSIONNAIRE":
                icon = "blind";
                color_class = "  t_" + person.type;
                // noinspection EqualityComparisonWithCoercionJS
                if (room.isInterdite == 1) {
                    icon = "exclamation-triangle iconA fa-beat";
                    color_class = "alert_a ";
                }
                break;
            case "RESIDENT":
                icon = "user-md";
                color_class = "  t_" + person.type;
                break;
            case "EMPLOYEE" :
                icon = "male";
                color_class = "  t_" + person.type;
                break
        }

        var customPin = L.divIcon({
            className: 'location-pin',
            html: "<div style='text-align: center' style='width: auto'> " +
                "<i class='fas fa-3x iconM fa-" + icon + " " + color_class + "'></i>" +
                "<br>"
                + "<span  class='text-small " + color_class + "' ><small>" + fullname + "</small></span></div>"
            , iconSize: [100, 50],
            iconAnchor: [20, 20],
            popupAnchor: [27, -21],
        });
        var marker = L.marker(m.geometry.coordinates, {
            icon: customPin
        }).addTo(map);
        var mPopup = "<h6>" + fullname + "</h6>" +
            "<span><b>chambre : </b>" + room.nom + "</span>";
        marker.bindPopup(mPopup);


        marker.on('mouseover', function (ev) {
            ev.target.openPopup();
        });

        markers[person.id] = marker;
        personsRooms[person.id] = room;
    }
}

function randomPointInPoly(polygon) {
    var bounds = polygon.getBounds();
    var x_min = bounds.getEast() + 20;
    var x_max = bounds.getWest() - 20;
    var y_min = bounds.getSouth() - 20;
    var y_max = bounds.getNorth() + 20;

    var lat = y_min + (Math.random() * (y_max - y_min));
    var lng = x_min + (Math.random() * (x_max - x_min));

    var point = turf.point([lng, lat]);
    var poly = polygon.toGeoJSON();
    var inside = turf.inside(point, poly);

    if (inside) {
        return point
    } else {
        return randomPointInPoly(polygon)
    }
}

function showAlertNotification(person, room) {
    toastr.error('Le pensionnaire <b>' + person.firstname + " " + person.lastname + "</b>,a acceder a la chambre <b>" + room.nom + "</b>!", 'Alerte!')
}

if ("WebSocket" in window) {
    // Let us open a web socket
    var ws = new WebSocket("ws://79.137.78.86:8090");

    ws.onopen = function () {
        // Web Socket is connected
        console.info("Connection is opened...");
        $('body').click()
    };

    ws.onmessage = function (evt) {
        var received_msg = evt.data;
        received_msg = JSON.parse(received_msg);
        // noinspection EqualityComparisonWithCoercionJS
        if (received_msg.type == "position") {
            addPerson(chambres_list[received_msg.room - 1], received_msg.person);
        } else
        // noinspection EqualityComparisonWithCoercionJS
        if (received_msg.type == "alert") {
            showAlertNotification(received_msg.person, chambres_list[received_msg.room - 1]);
        }
    };

    ws.onclose = function () {
        // websocket is closed.
        console.error("Connection is closed...");
    };
} else {
    // The browser doesn't support WebSocket
    alert("WebSocket NOT supported by your Browser!");
}
