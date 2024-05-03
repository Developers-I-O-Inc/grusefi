<div class="container-xxl" id="kt_content_container">
    <div class="card mb-5 mb-xl-5">
        <form wire:submit="updatePassword">
            <div class="card-body pt-9 pb-0">
                <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center mb-2">
                                    <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">Cambiar Contraseña</a>
                                </div>
                                <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                    <div class="fv-row mb-7">
                                        <input class="form-control form-control-solid" placeholder="Contraseña Anterior"  id="current_password" type="password" wire:model="state.current_password" autocomplete="current-password" />
                                    </div>
                                    <div class="fv-row mb-7">
                                        <input class="form-control form-control-solid" placeholder="Nueva Contraseña" id="password" type="password" wire:model="state.password" autocomplete="new-password"/>
                                    </div>
                                    <div class="fv-row mb-7">
                                        <input class="form-control form-control-solid" placeholder="Repita la nueva contraseña" id="password_confirmation" type="password" wire:model="state.password_confirmation" autocomplete="new-password" />
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex my-4">
                                <button wire:target="photo" type="submit" class="btn btn-sm btn-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_offer_a_deal">Guardar Contraseña</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
