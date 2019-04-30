@extends('partials/page')

@section('title', 'Géstion des employés')

@section('page_title')
    <h1>Gestion des employés</h1>
@stop
@section('action_btn')
    <button class="btn btn-primary float-right"
            data-remodal-target="add-employee">
        <i class="fas fa-user-plus"></i> Ajouter un employé
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
                    <th>uid bracelet</th>
                    <th>Type</th>
                    <th style="min-width: 80px" data-priority="1">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td>{{$employee->id}}</td>
                        <td>{{$employee->firstname}}</td>
                        <td>{{$employee->lastname}}</td>
                        <td>{{$employee->uid_bracelet}}</td>
                        <td>
                            <span class="badge {{$employee->type == \App\Enums\PersonTypes::EMPLOYEE ? 'badge-primary' : 'badge-info'}}">
                                {{\App\Enums\PersonTypes::getDescription($employee->type)}}
                            </span>
                        </td>
                        <td>
                            <a class="btn  btn-icon btn-sm text-primary edit-employee"
                               href="#"
                               data-id="{{$employee->id}}"
                               data-firstname="{{$employee->firstname}}"
                               data-lastname="{{$employee->lastname}}"
                               data-uid_bracelet="{{$employee->uid_bracelet}}"
                               data-type="{{$employee->type}}"
                               data-remodal-target="edit-employee"
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
                            <a class="btn btn-icon btn-sm text-danger delete-employee"
                               href="#"
                               data-toggle="tooltip"
                               data-original-title="Supprimer"
                               data-id="{{$employee->id}}"
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
    @include('persons.employees.add_modal')
    @include('persons.employees.edit_modal')
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
            $('.edit-employee').click(function () {
                var button = $(this);

                //Get Data
                var id = button.data('id');
                var firstname = button.data('firstname');
                var lastname = button.data('lastname');
                var uid_bracelet = button.data('uid_bracelet');
                var type = button.data('type');

                //Fill Data
                $('#edit-employee .id').val(id);
                $('#edit-employee .firstname').val(firstname);
                $('#edit-employee .lastname').val(lastname);
                $('#edit-employee .uid_bracelet').val(uid_bracelet);
                if(type == '{{\App\Enums\PersonTypes::EMPLOYEE}}'){
                    $('#edit-employee .employee').prop('checked', true);
                    $('#edit-employee .resident').removeAttr('checked');
                }
                else {
                    $('#edit-employee .resident').prop('checked', true);
                    $('#edit-employee .employee').removeAttr('checked');
                }
            });
            //End Edit Admin Fill Modal

            //Start Delete Admin Alert
            $('.delete-employee').click(function () {
                var id = $(this).data('id');

                $.confirm({
                    type: 'red',
                    title: '<h6>Voulez vous vraiment supprimer cet employée</h6>',
                    content: '<form id="delete-employee" method="post" action="{{route('employees.delete')}}">'
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
                                $( "#delete-employee" ).submit();
                            }
                        }
                    }
                });
            });
            //End Delete Admin Alert
        });
    </script>
@stop
