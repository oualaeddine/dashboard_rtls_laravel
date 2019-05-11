@extends('partials/page')

@section('page_title')
    <h1 class="text-primary"> Positions en temps réel</h1>
@stop
@section('page_title', 'Positions en temps réel')

@section('css')
    <link rel="stylesheet" href="./leaflet/leaflet.css"/>
    <link rel="stylesheet" href="./css/home.css"/>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <div class="card card-primary">
                <div class="card-body">
                    <div id="mapid"></div>

                    <span class="text-warning"><small><strong>NB: la position affichée sur le plan n'indique pas la position exacte de la personne, elle indique la presence d'une personne dans une chambre.</strong></small></span>
                  {{--  <button onclick="ajouterPersonne(0,0)"> Ajouter pensionaire salle 115</button>
                    <button onclick="ajouterPersonne(1,0)">Ajouter resident salle 115</button>
                    <button onclick="ajouterPersonne(2,0)">Ajouter employé salle 115</button>--}}
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src='https://unpkg.com/@turf/turf'></script>

    <script src="./leaflet/leaflet.js"></script>
    <script>

        var chambres_list = [

                @foreach($rooms as $r)
            {
                id:{{$r->id}},
                nom: "{{$r->name}}",
                type: "{{$r->type}}",
                isInterdite:{{$r->isInterdite}},
                peoples:[],
                corners: [
                    <?php
                    $co = json_decode($r->data)->corners;
                    foreach ($co as $item) {
                        echo "{x:" . $item->x . ",y:" . $item->y . "},";
                    }
                    ?>
                ]
            },
            @endforeach
        ]
    </script>
    <script src="./js/home.js"></script>
@stop
