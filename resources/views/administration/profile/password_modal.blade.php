<div class="remodal" data-remodal-id="edit-password" id="edit-password">
    <button data-remodal-action="close" class="remodal-close"></button>
    <h2>Changer le mot de pass</h2>
    <br>
    <form method="POST" action="{{route('profile.password')}}" class="needs-validation" novalidate="">
        @csrf
        @method('PUT')
        <input name="id" class="id" hidden>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="float-left">Mot de pass</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-key"></i>
                            </div>
                        </div>
                        <input name="password"
                               type="password"
                               minlength="6"
                               required
                               class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="float-left">Confirmer le mot de pass</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-key"></i>
                            </div>
                        </div>
                        <input name="password_confirmation"
                               type="password"
                               minlength="6"
                               required
                               class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="float-left">Ancien mot de pass</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-key"></i>
                            </div>
                        </div>
                        <input name="old_password"
                               type="password"
                               minlength="6"
                               required
                               class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary float-right pr-4 pl-4">Enregistrer</button>
    </form>
    <button class="btn btn-light float-left" data-remodal-action="cancel">Annuler</button>
</div>

