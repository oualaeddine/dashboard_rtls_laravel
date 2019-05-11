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
        var icon;
        switch (person.type) {
            case "PENSIONNAIRE":
                icon = "blind";
                break;
            case "RESIDENT":
                icon = "user-md";
                break;
            case "EMPLOYEE" :
                icon = "male";
                break
        }
        var customPin = L.divIcon({
            className: 'location-pin',
            html: "<div style='text-align: center' style='width: auto'> " +
                "<i class='fas   fa-3x iconM fa-" + icon + "  t_" + person.type + "'></i>" +
                "<br>"
                + "<span  class='text-small t_" + person.type + "' ><small>" + fullname + "</small></span></div>"
            , iconSize: [100, 50],
            iconAnchor: [20, 20],
            popupAnchor: [3, -21],
        });
        var marker = L.marker(m.geometry.coordinates, {
            icon: customPin
        }).addTo(map);
        marker.bindPopup("<b style='font-size:12pt;'> " + fullname + " </b> ");
        marker.on('mouseover', function (ev) {
            ev.target.openPopup();
        });

        markers[person.id] = marker;
        personsRooms[person.id] = room;
    }
}

function randomPointInPoly(polygon) {
    var bounds = polygon.getBounds();
    var x_min = bounds.getEast() + 10;
    var x_max = bounds.getWest() - 10;
    var y_min = bounds.getSouth() - 10;
    var y_max = bounds.getNorth() + 10;

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

if ("WebSocket" in window) {
    // Let us open a web socket
    var ws = new WebSocket("ws://localhost:8090");

    ws.onopen = function () {
        // Web Socket is connected
        console.info("Connection is opened...");
    };

    ws.onmessage = function (evt) {
        var received_msg = evt.data;
        received_msg = JSON.parse(received_msg);

        addPerson(chambres_list[received_msg.room - 1], received_msg.person[0])
    };

    ws.onclose = function () {
        // websocket is closed.
        console.error("Connection is closed...");
    };
} else {
    // The browser doesn't support WebSocket
    alert("WebSocket NOT supported by your Browser!");
}
