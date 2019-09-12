@extends('partials/page')

@section('title', 'Les évenements')

@section('page_title')
    <h1>Les évènements </h1>
@stop

@section('css')

@stop

@section('content')
    {{--Start Alerts Table--}}
    {{--<div class="card">--}}
        {{--<div class="card-header">--}}
            {{--alertes--}}
        {{--</div>--}}
        {{--<div class="card-body">--}}
            {{--<table id="table_id" class="table table-striped w-100">--}}
                {{--<thead>--}}
                {{--<tr>--}}
                    {{--<th>#</th>--}}
                    {{--<th data-priority="2">Personne</th>--}}
                    {{--<th data-priority="3">Pièce</th>--}}
                    {{--<th>Date</th>--}}
                {{--</tr>--}}
                {{--</thead>--}}
                {{--<tbody>--}}
                {{--@foreach($alerts as $a)--}}
                    {{--<tr>--}}
                        {{--<td>{{$a->id}}</td>--}}
                        {{--<td>{{$a->person->fullname()}}</td>--}}
                        {{--<td>{{$a->piece->name}}</td>--}}
                        {{--<td>{{$a->date_time}}</td>--}}
                    {{--</tr>--}}
                {{--@endforeach--}}
                {{--</tbody>--}}
            {{--</table>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--End Alerts Table--}}

    {{--Start Seances Table--}}
    <div class="card">
        <div class="card-header">
            Séances
        </div>
        <div class="card-body">
            <table id="table_id2" class="table table-striped w-100">
                <thead>
                <tr>
                    <th>#</th>
                    <th data-priority="2">Résident</th>
                    <th data-priority="3">Pensionnaire</th>
                    <th>Date de démarrage</th>
                    <th>Date de fin</th>
                    <th>Durée</th>
                </tr>
                </thead>
                <tbody>
                @foreach($seances as $s)
                    <tr>
                        <td>{{$s->id}}</td>
                        <td>{{$s->resident->fullname()}}</td>
                        <td>{{$s->pensionaire->fullname()}}</td>
                        <td>{{$s->date_start}}</td>
                        <td>{{$s->date_end}}</td>
                        <td>{{$s->getDuration()}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{--End Seances Table--}}
@stop

@section('js')
<script>
    $(document).ready(function () {
        // Start Datatables Options
        $('#table_id, #table_id2').DataTable({
            responsive: true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            // dom: 'Bfrtip',
            // buttons: [
            //     {
            //         extend: 'pdf',
            //         title: 'Liste des admins',
            //         exportOptions: {
            //             columns: [1,2,3,4,5,6,7],
            //         } ,
            //         customize: function (doc) {
            //             doc.content[1].table.widths =
            //                 Array(doc.content[1].table.body[0].length + 1).join('*').split('');
            //         }
            //     },
            //     // {
            //     //     extend: 'csv',
            //     //     title: 'Liste des admins',
            //     //     exportOptions: {
            //     //         columns: [1,2,3,4,5,6,7]
            //     //     }
            //     //
            //     // },
            //     {
            //         extend: 'excel',
            //         title: 'Liste des admins',
            //         exportOptions: {
            //             columns: [1,2,3,4,5,6,7]
            //         }
            //     },
            //     {
            //         extend: 'print',
            //         title: 'Liste des admins',
            //         exportOptions: {
            //             columns: [1,2,3,4,5,6,7]
            //         }
            //     }
            // ]
        });
        // End Datatables Options
    })
</script>
@stop
