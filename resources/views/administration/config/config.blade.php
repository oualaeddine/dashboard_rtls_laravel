@extends('partials/page')

@section('title', 'Paramètres')

@section('page_title')
    <h1>Paramètres</h1>
@stop

@section('css')

@stop

@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-8 offset-lg-2">
            <form method="POST" action="{{route('config.update')}}" class="needs-validation" novalidate="">
                @csrf
                <div class="card" id="settings-card">
                    <div class="card-header">
                        <h4>Paramètres</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row align-items-center">
                            <label for="site-title"
                                   class="form-control-label col-sm-3 text-md-right">Courtier</label>
                            <div class="col-sm-6 col-md-9">
                                <input type="text"
                                       name="broker_url"
                                       class="form-control"
                                       value="{{$config->broker_url ?? ''}}"
                                       id="broker_url">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="tel1"
                                   class="form-control-label col-sm-3 text-md-right">Port</label>
                            <div class="col-sm-6 col-md-9">
                                <input type="number"
                                       name="port"
                                       class="form-control"
                                       value="{{$config->port ?? ''}}"
                                       id="port">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="tel2"
                                   class="form-control-label col-sm-3 text-md-right">Username</label>
                            <div class="col-sm-6 col-md-9">
                                <input type="text"
                                       name="username"
                                       class="form-control"
                                       value="{{$config->username ?? ''}}"
                                       id="username">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="tel2"
                                   class="form-control-label col-sm-3 text-md-right">Password</label>
                            <div class="col-sm-6 col-md-9">
                                <input type="text"
                                       name="password"
                                       class="form-control"
                                       value="{{$config->password ?? ''}}"
                                       id="password">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="tel2"
                                   class="form-control-label col-sm-3 text-md-right">Chaîne s'abonner</label>
                            <div class="col-sm-6 col-md-9">
                                <input type="text"
                                       name="chanel_subscribe"
                                       class="form-control"
                                       value="{{$config->chanel_subscribe ?? ''}}"
                                       id="chanel_subscribe">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="tel2"
                                   class="form-control-label col-sm-3 text-md-right">Canal publier</label>
                            <div class="col-sm-6 col-md-9">
                                <input type="text"
                                       name="chanel_publish"
                                       class="form-control"
                                       value="{{$config->chanel_publish ?? ''}}"
                                       id="chanel_publish">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="tel2"
                                   class="form-control-label col-sm-3 text-md-right">Chemin</label>
                            <div class="col-sm-6 col-md-9">
                                <input type="text"
                                       name="path"
                                       class="form-control"
                                       value="{{$config->path ?? ''}}"
                                       id="path">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="tel2"
                                   class="form-control-label col-sm-3 text-md-right">Vitesse de transmission</label>
                            <div class="col-sm-6 col-md-9">
                                <input type="number"
                                       name="baudrate"
                                       class="form-control"
                                       value="{{$config->baudrate ?? ''}}"
                                       id="baudrate">
                            </div>
                        </div>

                    </div>
                    <div class="card-footer bg-whitesmoke text-md-right">
                        <button class="btn btn-primary" id="save-btn">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop

@section('js')

@stop
