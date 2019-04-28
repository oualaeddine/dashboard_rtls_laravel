@extends('partials/page')


@section('page_title', 'page title')

@section('css')

@stop

@section('content')
    <div class="row">
         <div class="col-md-8 offset-md-2">
            <div class="card profile-widget mt-5">
                <div class="profile-widget-header">
                    <img alt="image" src="{{asset('stisla/img/avatar/avatar-1.png')}}" class="rounded-circle profile-widget-picture">
                    <div class="profile-widget-items">
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Date d'ajout</div>
                            <div class="profile-widget-item-value">12-02-2019</div>
                        </div>
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Dernier Modification</div>
                            <div class="profile-widget-item-value">12-02-2019</div>
                        </div>
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Revue</div>
                            <div class="profile-widget-item-value">15</div>
                        </div>
                    </div>
                </div>
                <div class="profile-widget-description">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <b>Nom</b>
                            <span class="float-right">Bekhiekh</span>
                        </li>
                        <li class="list-group-item">
                            <b>Prénom</b>
                            <span class="float-right">Djamal</span>
                        </li>
                        <li class="list-group-item">
                            <b>Nom d'utilisateur</b>
                            <span class="float-right">djamal-soft</span>
                        </li>
                        <li class="list-group-item">
                            <b>E-Mail</b>
                            <span class="float-right">djamal@a.com</span>
                            <span class="btn btn-sm btn-light float-right mr-2">Edit</span>
                        </li>
                        <li class="list-group-item">
                            <b>Mot de pass</b>
                            <span class="float-right">*************</span>
                            <span class="btn btn-sm btn-light float-right mr-2">Edit</span>
                        </li>
                        <li class="list-group-item">
                            <b>Téléphone</b>
                            <span class="float-right">0657696373</span>
                        </li>
                        <li class="list-group-item">
                            <b>Type</b>
                            <span class="float-right">SU</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
@stop

@section('js')
<script>
    $(document).ready(function () {
        $('.btn').click(function () {
            $.confirm({

                type: 'blue',
                buttons: {
                    annuler: function () {
                        // here the button key 'hey' will be used as the text.
                        $.alert('You clicked on "hey".');
                    },
                    heyThere: {
                        text: 'hey there!', // With spaces and symbols
                        action: function () {
                            $.alert('You clicked on "heyThere"');
                        }
                    }
                }
            });
        });
    });
</script>
@stop
