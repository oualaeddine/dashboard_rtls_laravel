@extends('partials/page')

@section('title', 'Géstion des admins')

@section('page_title')
    <h1>Gestion des admins</h1>
@stop
@section('action_btn')
    <button class="btn btn-primary float-right"
            data-remodal-target="add-admin">
        <i class="fas fa-user-plus"></i> Ajouter un admin
    </button>
@stop

@section('css')

@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table id="table_id" class="table table-striped w-100">
                <thead>
                <tr>
                    <th>#</th>
                    <th data-priority="2">Nom</th>
                    <th data-priority="3">Prénom</th>
                    <th>E-Mail</th>
                    <th style="min-width: 80px" data-priority="1">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($admins as $admin)
                    <tr>
                        <td>{{$admin->id}}</td>
                        <td>{{$admin->firstname}}</td>
                        <td>{{$admin->lastname}}</td>
                        <td>{{$admin->email}}</td>
                        <td>
                            <a class="btn  btn-icon btn-sm text-primary edit-admin"
                               href="#"
                               data-id="{{$admin->id}}"
                               data-firstname="{{$admin->firstname}}"
                               data-lastname="{{$admin->lastname}}"
                               data-email="{{$admin->email}}"
                               data-remodal-target="edit-admin"
                               data-toggle="tooltip"
                               data-original-title="Modifier"
                            >
                                <i class="fas fa-user-edit"></i>
                            </a>
                            {{--<a class="btn btn-icon btn-sm text-warning change-status"--}}
                               {{--href="#"--}}
                               {{--data-id="{{$admin->id}}"--}}
                               {{--data-status="{{$admin->is_active}}"--}}
                               {{--data-toggle="tooltip"--}}
                               {{--data-original-title="{{$admin->is_active == 1 ? 'Suspendre' : 'Réactiver'}}"--}}
                            {{-->--}}
                                {{--<i class="fas {{$admin->is_active == 1 ? 'fa-user-lock' : 'fa-user-check'}}"></i>--}}
                            {{--</a>--}}
                            <a class="btn btn-icon btn-sm text-danger delete-admin"
                               href="#"
                               data-toggle="tooltip"
                               data-original-title="Supprimer"
                               data-id="{{$admin->id}}"
                            >
                                <i class="fas fa-user-times"></i>
                            </a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{--Start Include Modals--}}
    @include('administration.admins.edit_modal')
    @include('administration.admins.add_modal')
    {{--End Include Modals--}}

@stop

@section('js')
    <script>
        $(document).ready(function () {


            // Start Datatables Options
            $('#table_id').DataTable({
                responsive: true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                },
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'pdf',
                        title: 'Liste des admins',
                        exportOptions: {
                            columns: [1,2,3,4,5,6,7],
                        } ,
                        customize: function (doc) {
                            doc.content[1].table.widths =
                                Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                        }
                    },
                    // {
                    //     extend: 'csv',
                    //     title: 'Liste des admins',
                    //     exportOptions: {
                    //         columns: [1,2,3,4,5,6,7]
                    //     }
                    //
                    // },
                    {
                        extend: 'excel',
                        title: 'Liste des admins',
                        exportOptions: {
                            columns: [1,2,3,4,5,6,7]
                        }
                    },
                    {
                        extend: 'print',
                        title: 'Liste des admins',
                        exportOptions: {
                            columns: [1,2,3,4,5,6,7]
                        }
                    }
                ]
            });
            // End Datatables Options

            //Start Edit Admin Fill Modal
            $('.edit-admin').click(function () {
                var button = $(this);

                //Get Data
                var id = button.data('id');
                var firstname = button.data('firstname');
                var lastname = button.data('lastname');
                var email = button.data('email');

                //Fill Data
                $('#edit-admin .id').val(id);
                $('#edit-admin .firstname').val(firstname);
                $('#edit-admin .lastname').val(lastname);
                $('#edit-admin .email').val(email);
            });
            //End Edit Admin Fill Modal

            //Start Delete Admin Alert
            $('.delete-admin').click(function () {
                var id = $(this).data('id');

                $.confirm({
                    type: 'red',
                    title: '<h6>Voulez vous vraiment supprimer cet admin</h6>',
                    content: '<form id="delete-admin" method="post" action="{{route('admins.delete')}}">'
                        + '{{csrf_field()}}'
                        + '<input type="hidden" name="_method" value="delete" />'
                        + '<input hidden name="id" value="'+id+'">'
                        + '</form>',
                    buttons: {
                        Annuler: {
                            text: 'Non',
                            action: function () {
                            }
                        },
                        change: {
                            text: 'Supprimer',
                            btnClass: 'btn-red',
                            action: function () {
                                $( "#delete-admin" ).submit();
                            }
                        }
                    }
                });
            });
            //End Delete Admin Alert
        });
    </script>
@stop
