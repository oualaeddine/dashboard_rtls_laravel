<div class="remodal" data-remodal-id="edit-email" id="edit-email">
    <button data-remodal-action="close" class="remodal-close"></button>
    <h2>Changer l'email</h2>
    <br>
    <form method="POST" action="{{route('profile.email')}}" class="needs-validation" novalidate="">
        @csrf
        @method('PUT')
        <input name="id" class="id" hidden>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="float-left">Nouveau E-Mail</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                        <input name="email"
                               value="{{$admin->email}}"
                               type="email"
                               required
                               class="form-control">
                    </div>
                </div>
            </div>
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
        </div>
        <button class="btn btn-primary float-right pr-4 pl-4">Enregistrer</button>
    </form>
    <button class="btn btn-light float-left" data-remodal-action="cancel">Annuler</button>
</div>

