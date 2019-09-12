@extends('partials/page')


@section('title', 'Profile')

@section('page_title')
    <h1>Profil</h1>
@stop

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
                            <div class="profile-widget-item-value">{{date('d-m-Y', strtotime($admin->created_at))}}</div>
                        </div>
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Dernier Modification</div>
                            <div class="profile-widget-item-value">{{date('d-m-Y', strtotime($admin->updated_at))}}</div>
                        </div>
                        {{--<div class="profile-widget-item">--}}
                            {{--<div class="profile-widget-item-label">Revue</div>--}}
                            {{--<div class="profile-widget-item-value">10</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
                <div class="profile-widget-description">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <b>Nom</b>
                            <span class="float-right">{{$admin->firstname}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Prénom</b>
                            <span class="float-right">{{$admin->lastname}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>E-Mail</b>
                            <span class="float-right">{{$admin->email}}</span>
                            <span class="btn btn-sm btn-light float-right mr-2"
                                  data-remodal-target="edit-email">Changer</span>
                        </li>
                        {{--<li class="list-group-item">--}}
                            {{--<b>Nom d'utilisateur</b>--}}
                            {{--<span class="float-right">{{$admin->username}}</span>--}}
                        {{--</li>--}}
                        <li class="list-group-item">
                            <b>Mot de passe</b>
                            <span class="float-right">*************</span>
                            <span class="btn btn-sm btn-light float-right mr-2"
                                  data-remodal-target="edit-password">Changer</span>
                        </li>
                        {{--<li class="list-group-item">--}}
                            {{--<b>Téléphone</b>--}}
                            {{--<span class="float-right">{{$admin->tel}}</span>--}}
                        {{--</li>--}}
                        {{--<li class="list-group-item">--}}
                            {{--<b>Type</b>--}}
                            {{--<span class="float-right">{{$admin->type}}</span>--}}
                        {{--</li>--}}
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{--Start Include Modals--}}
    @include('administration.profile.password_modal')
    @include('administration.profile.email_modal')
    {{--End Include Modals--}}
@stop

@section('js')
<script>

</script>
@stop
