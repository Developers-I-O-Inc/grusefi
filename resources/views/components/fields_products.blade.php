@props(['variedades' => $variedades, 'presentaciones' => $presentaciones])
<div class="row mb-5">
    <div class="col-md-6 fv-row">
        <label class="required fs-6 fw-bold mb-2">Folio Pallet</label>
        <input type="text" class="form-control" placeholder="Ingresa el folio del pallet" name="folio_pallet" id="folio_pallet" />
    </div>
    <div class="col-md-6 fv-row">
        <label class="required fs-6 fw-bold mb-2">Lote</label>
        <input type="text" class="form-control" placeholder="Ingresa el n° de lote" name="lote" id="lote" />
    </div>
</div>
<div class="row mb-5">
    <div class="col-md-6 fv-row">
        <label class="required fs-6 fw-bold mb-2">SADER</label>
        <input type="text" class="form-control" placeholder="Ingresa el codigo SADER" name="sader" id="sader" />
    </div>
    <div class="col-md-6 fv-row">
        <label class="required fs-6 fw-bold mb-2">Cartilla</label>
        <input type="text" class="form-control" placeholder="Ingresa el n° de registros" name="cartilla" id="cartilla" />
    </div>
</div>
<div class="row mb-5">
    <div class="col-md-6 fv-row">
        <label class="required fs-6 fw-bold mb-2">Variedad</label>
        <select id="variedad_product_id" name="variedad_product_id" class="form-select" data-control="select2" data-dropdown-parent="#kt_modal_add_product" data-placeholder="Seleccione una variedad" data-allow-clear="true">
            <option></option>
            @foreach($variedades as $variedad)
                <option value="{{$variedad->id}}">{{$variedad->variedad}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6 fv-row">
        <label class="required fs-6 fw-bold mb-2">Presentación</label>
        <select id="presentacion_id" name="presentacion_id" class="form-select" data-control="select2" data-dropdown-parent="#kt_modal_add_product" data-placeholder="Seleccione una presentación" data-allow-clear="true">
            <option></option>
            @foreach($presentaciones as $presentacion)
                <option value="{{$presentacion->id}}">{{$presentacion->presentacion}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row mb-5">
    <div class="col-md-6 fv-row">
        <label class="required fs-6 fw-bold mb-2">Peso</label>
        <input type="number" class="form-control" placeholder="Ingresa el peso" name="peso" id="peso" />
    </div>
    <div class="col-md-6 fv-row">
        <label class="required fs-6 fw-bold mb-2">Cantidad</label>
        <input type="number" class="form-control" placeholder="Ingresa la cantidad" name="cantidad" id="cantidad" />
    </div>
</div>
<div class="row mb-5">
    <div class="col-md-6 fv-row">
        <label class="required fs-6 fw-bold mb-2">Marca Distintiva</label>
        <select id="select_marca" name="select_marca" class="form-select" data-control="select2" data-dropdown-parent="#kt_modal_add_product" data-placeholder="Seleccione una marca" data-allow-clear="true">
            <option></option>
        </select>
    </div>
</div>
