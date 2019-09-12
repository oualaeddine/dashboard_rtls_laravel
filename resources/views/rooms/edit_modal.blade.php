<div class="remodal" data-remodal-id="room-edit" id="room-edit">
    <button data-remodal-action="close" class="remodal-close"></button>
    <h1>Modifier la piece</h1>
    <br>
    <form method="POST" action="{{route('rooms.update')}}" class="needs-validation" novalidate="">
        @csrf
        @method('PUT')
        <input class="id" name="id" hidden>
        <input class="data" name="data" hidden>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="name" class="float-left">Nom de la piece</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-home"></i>
                            </div>
                        </div>
                        <input
                            id="name" name="name"
                               type="text"
                               required
                               minlength="4"
                               class="form-control name">
                    </div>

                    <div class="form-group">
                        <label class="custom-switch mt-2 float-left">
                            <input type="checkbox"
                                   name="is_soins"
                                   class="custom-switch-input is-soins">
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description">Cette chambre est une chambre de soins</span>
                        </label>

                        <br>

                        <label class="custom-switch mt-2 float-left">
                            <input type="checkbox"
                                   name="is_interdite"
                                   class="custom-switch-input is-interdite">
                            <span class="danger-custom-switch-indicator" ></span>
                            <span class="custom-switch-description">Cette chambre est interdite aux Pensionnaires</span>
                        </label>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <button class="btn btn-primary float-right pr-4 pl-4">Enregistrer</button>
    </form>
    <button class="btn btn-light float-left" data-remodal-action="cancel">Annuler</button>
</div>

