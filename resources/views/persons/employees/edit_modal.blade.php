<div class="remodal" data-remodal-id="edit-employee" id="edit-employee">
    <button data-remodal-action="close" class="remodal-close"></button>
    <h1>Modifier l'employé</h1>
    <br>
    <form method="POST" action="{{route('employees.update')}}" class="needs-validation" novalidate="">
        @csrf
        @method('PUT')
        <input name="id" class="id" hidden>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="float-left">Nom</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <input name="firstname"
                               type="text"
                               pattern="[a-zA-Z ]+$"
                               required
                               minlength="4"
                               class="form-control firstname">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="float-left">Prénom</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <input name="lastname"
                               type="text"
                               pattern="[a-zA-Z ]+$"
                               required
                               minlength="4"
                               class="form-control lastname">
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="form-group">
                    <label class="form-label float-left">Type</label>
                    <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                            <input type="radio" name="type" value="{{\App\Enums\PersonTypes::EMPLOYEE}}" class="selectgroup-input employee">
                            <span class="selectgroup-button">{{\App\Enums\PersonTypes::getDescription(\App\Enums\PersonTypes::EMPLOYEE)}}</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="type" value="{{\App\Enums\PersonTypes::RESIDENT}}" class="selectgroup-input resident">
                            <span class="selectgroup-button">{{\App\Enums\PersonTypes::getDescription(\App\Enums\PersonTypes::RESIDENT)}}</span>
                        </label>

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="float-left">Uid bracelet</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                        <input name="uid_bracelet"
                               type="text"
                               required
                               class="form-control uid_bracelet">
                    </div>
                </div>
            </div>

        </div>
        <button class="btn btn-primary float-right">Enregistrer</button>
    </form>
    <button class="btn btn-light float-left" data-remodal-action="cancel">Annuler</button>
    {{--<form method="POST" action="{{route('admins.update', 0)}}" class="needs-validation">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-6">--}}
                {{--<div class="form-group">--}}
                    {{--<label  class="float-left">Nom</label>--}}
                    {{--<div class="input-group">--}}
                        {{--<div class="input-group-prepend">--}}
                            {{--<div class="input-group-text">--}}
                                {{--<i class="fas fa-user"></i>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<input type="text"--}}
                               {{--class="form-control phone-number"--}}
                               {{--minlength="4"--}}
                               {{--required--}}
                        {{-->--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-6">--}}
                {{--<div class="form-group">--}}
                    {{--<label class="float-left">Prénom</label>--}}
                    {{--<div class="input-group">--}}
                        {{--<div class="input-group-prepend">--}}
                            {{--<div class="input-group-text">--}}
                                {{--<i class="fas fa-user"></i>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<input type="text"--}}
                               {{--class="form-control phone-number"--}}
                               {{--minlength="4"--}}
                               {{--required--}}
                        {{-->--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-6">--}}
                {{--<div class="form-group">--}}
                    {{--<label class="float-left">Username</label>--}}
                    {{--<div class="input-group">--}}
                        {{--<div class="input-group-prepend">--}}
                            {{--<div class="input-group-text">--}}
                                {{--<i class="fas fa-user"></i>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<input type="text"--}}
                               {{--class="form-control phone-number"--}}
                               {{--minlength="4"--}}
                               {{--required--}}
                        {{-->--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-6">--}}
                {{--<div class="form-group">--}}
                    {{--<label class="float-left">E-Mail</label>--}}
                    {{--<div class="input-group">--}}
                        {{--<div class="input-group-prepend">--}}
                            {{--<div class="input-group-text">--}}
                                {{--<i class="fas fa-user"></i>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<input type="email"--}}
                               {{--class="form-control phone-number"--}}
                               {{--required--}}
                        {{-->--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="col-xl-12">--}}
                {{--<button class="btn btn-primary">Submits</button>--}}
            {{--</div>--}}

            {{--<div class="form-group">--}}
                {{--<label>Phone Number (US Format)</label>--}}
                {{--<div class="input-group">--}}
                    {{--<div class="input-group-prepend">--}}
                        {{--<div class="input-group-text">--}}
                            {{--<i class="fas fa-phone"></i>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<input type="text" class="form-control phone-number">--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="form-group">--}}
                {{--<label>Password Strength</label>--}}
                {{--<div class="input-group">--}}
                    {{--<div class="input-group-prepend">--}}
                        {{--<div class="input-group-text">--}}
                            {{--<i class="fas fa-lock"></i>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<input type="password" class="form-control pwstrength" data-indicator="pwindicator">--}}
                {{--</div>--}}
                {{--<div id="pwindicator" class="pwindicator">--}}
                    {{--<div class="bar"></div>--}}
                    {{--<div class="label"></div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="form-group">--}}
                {{--<label>Currency</label>--}}
                {{--<div class="input-group">--}}
                    {{--<div class="input-group-prepend">--}}
                        {{--<div class="input-group-text">--}}
                            {{--$--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<input type="text" class="form-control currency">--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="form-group">--}}
                {{--<label>Purchase Code</label>--}}
                {{--<input type="text" class="form-control purchase-code" placeholder="ASDF-GHIJ-KLMN-OPQR">--}}
            {{--</div>--}}
            {{--<div class="form-group">--}}
                {{--<label>Invoice</label>--}}
                {{--<input type="text" class="form-control invoice-input">--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<br>--}}
        {{--<button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>--}}
        {{--<button data-remodal-action="confirm" class="remodal-confirm">OK</button>--}}
    {{--</form>--}}
</div>

