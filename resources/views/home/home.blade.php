@extends('partials/page')


@section('page_title', 'Positions en temps réel')

@section('css')
    <link rel="stylesheet" href="./leaflet/leaflet.css"/>

    <style>

        .chambre {

            -webkit-transition: all 1s ease-out;
            -moz-transition: all 1s ease-out;
            -ms-transition: all 1s ease-out;
            -o-transition: all 1s ease-out;
            transition: all 1s ease-out;
        }

        .chambre:hover {
            fill: #f2f2f2;
        }

        .person {
            height: 1em;
            font-size: 3em;
            width: 0.5em;
        }

        .t_0 {
            fill: red;
            color: red
        }

        .t_1 {
            fill: blue;
            color: blue;
            height: 0.4em;
            width: 0.27em;

        }

        .t_2 {
            fill: darkgreen;
            color: darkgreen;
        }

        #mapid {
            height: 600px;
            background: white;
        }


    </style>
@stop

@section('content')


    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <div class="card">

                <div class="card-body">
                    <div id="mapid"></div>


                    <button onclick="ajouterPersonne(0,0)"> Ajouter pensionaire salle 115</button>
                    <button onclick="ajouterPersonne(1,0)">Ajouter resident salle 115</button>
                    <button onclick="ajouterPersonne(2,0)">Ajouter employé salle 115</button>
                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="./leaflet/leaflet.js"></script>

    <script>
        const PENSIONNAIRE = 0,
            RESIDENT = 1,
            EMPLOYEE = 2;
        const STEPx = 5;
        const STEPy = 10;
        const chambres_list = [
            {
                id: 0,
                name: "",
                class: "ch_115",
                startX: 14.5,
                startY: -118.5,
                width: (54 - 10.5),
                height: (110 - 193),
                peoples: []
            }, {
                id: 1,
                name: "",
                class: "ch_2",
                startX: 391.875 + 1,
                startY: 86.4583 + 1,
                width: 291.667,
                height: 168.75,
                peoples: []
            }, {
                id: 2,
                name: "",
                class: "ch_3",
                startX: 196.042 + 1,
                startY: 272.917 + 1,
                width: 318.75,
                height: 143.75,
                peoples: []
            }, {
                id: 3,
                name: "",
                class: "ch_4",
                startX: 0,
                startY: 0,
                width: 318.75,
                height: 143.75,
                peoples: []
            }, {
                id: 4,
                name: "",
                class: "ch_5",
                startX: 0,
                startY: 0,
                width: 318.75,
                height: 143.75,
                peoples: []
            }, {
                id: 5,
                name: "",
                class: "ch_6",
                startX: 0,
                startY: 0,
                width: 318.75,
                height: 143.75,
                peoples: []
            }, {
                id: 6,
                name: "",
                class: "ch_7",
                startX: 0,
                startY: 0,
                width: 318.75,
                height: 143.75,
                peoples: []
            }, {
                id: 7,
                name: "",
                class: "ch_8",
                startX: 0,
                startY: 0,
                width: 259.375,
                height: 160.417,
                peoples: []
            }
        ];


        var persons_list = [
            {
                id: 0,
                type: PENSIONNAIRE,
                fullname: "Fateh",
                chambre: chambres_list[0],
                x: 0,
                y: 0
            },
            {
                id: 1,
                type: RESIDENT,
                fullname: "Ouala Eddine",
                chambre: chambres_list[0],
                x: 0,
                y: 0
            },
            {
                id: 2,
                type: EMPLOYEE,
                fullname: "Omar",
                chambre: chambres_list[0],
                x: 0,
                y: 0
            }
        ];

        function removePersonFromPlan(id) {
            for (var i = 0; i < chambres_list.length; i++) {
                for (var j = 0; j < chambres_list[i].peoples.length; j++) {
                    for (var p = 0; p < chambres_list[i].peoples[j].length; p++) {
                        if (chambres_list[i].peoples[j][p].person != null && chambres_list[i].peoples[j][p].person.id == id) {
                            chambres_list[i].peoples[j][p].person = null
                        }
                    }
                }
                let x = document.querySelectorAll(".per_" + id);
                let k;
                for (k = 0; k < x.length; k++) {
                    x[k].remove();
                }
            }
        }


        initMatrices();

        function initMatrices() {
            for (var k = 0; k < chambres_list.length; k++) {
                chambre = chambres_list[k];
                var nbrPersonnesX = Math.round(chambre.width / STEPx) - 1;
                var nbrPersonnesY = (Math.round(Math.abs(chambre.height) / STEPy));
                console.log(chambre.class + "  :  " + Math.abs(chambre.height));

                var matrix = [];
                for (var i = 0; i < nbrPersonnesY; i++) {
                    matrix[i] = [];
                    for (var j = 0; j < nbrPersonnesX; j++) {
                        matrix[i][j] = {
                            posi: {i: i, j: j},
                            x: chambre.startX + STEPx * j,
                            y: chambre.startY - STEPy * i,
                            person: null
                        };
                    }
                }

                chambres_list[chambre.id].peoples = matrix;
            }
            console.log(chambres_list)
        }

        function ajouterPersonne(personId, chambreId) {

            persons_list[personId].chambre = chambres_list[chambreId];
            var person = persons_list[personId];
            var icon;
            switch (person.type) {
                case PENSIONNAIRE: {
                    icon = "blind fa-2x";
                    break
                }
                case RESIDENT: {
                    icon = "user-md";
                    icon = "male fa-2x";
                    break
                }
                case EMPLOYEE: {
                    icon = "male fa-2x";
                    break
                }
                default:
                    return;
            }
            var customPin = L.divIcon({
                className: 'location-pin',
                html: "<div style='text-align: center'> " +
                    "<i class='fas fa-" + icon + "  t_" + person.type + "'></i>" +
                    "<br>"
                /* + "<span  class='t_" + person.type + "'>" + person.fullname + "</span></div>"*/
                , iconSize: [40, 40],
                iconAnchor: [20, 20],
                popupAnchor: [3, -21]
            });

            var m = getPersonPosition(chambres_list[chambreId]);
            chambres_list[person.chambre.id].peoples[m.posi.i][m.posi.j].person = person;

            var marker = L.marker([m.y, m.x], {
                icon: customPin
            }).addTo(map);
            marker.bindPopup("<b style='font-size:12pt;'> " + person.fullname + " </b> ")

            marker.on('mouseover', function (ev) {
                ev.target.openPopup();
            });
        }


        function getPersonPosition(chambre) {
            var my_ch = chambres_list[chambre.id];
            for (var i = 0; i < my_ch.peoples.length; i++) {
                for (var j = 0; j < my_ch.peoples[i].length; j++) {
                    // noinspection EqualityComparisonWithCoercionJS
                    if (my_ch.peoples[i][j].person == null) {
                        console.log(my_ch.peoples[i][j]);
                        return my_ch.peoples[i][j];
                    }
                }
            }
            console.log("malguitch blasa")
        }

        var map = L.map('mapid', {
            minZoom: 1,
            maxZoom: 4,
            center: [0, 0],
            zoom: 1,
            crs: L.CRS.Simple,
            attributionControl: false
        });

        var w = 1280 * 3,
            h = 806 * 3,
            url = './enzo.svg';
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
            console.log(e.latlng)
        }

        map.on('click', clicked);

    </script>
@stop
