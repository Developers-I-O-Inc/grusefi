"use strict"

import Catalogs from "./general.js"

var KTempaqueesList = (function () {

    const catalog = "empaques"
    const catalog_item = "empaque"
    const cat_localidades = "localidades"
    const token = $('meta[name="csrf-token"]').attr('content')

    var table_items,
        btn_modal,
        btn_add,
        btn_cancel,
        btn_submit,
        modal,
        validations,
        form,
        edit_id,
        edit_nombre_corto,
        edit_nombre_fiscal,
        edit_domicilio_fiscal,
        edit_num_ext,
        edit_num_int,
        edit_cp,
        edit_rfc,
        edit_telefonos,
        edit_imagen,
        edit_nombre_embarque,
        edit_domicilio_documentacion,
        edit_codigo,
        edit_exportacion,
        edit_asociado,
        edit_active,
        check_active,
        check_exportacion,
        check_asociado,
        check_exportacion,
        check_asociado,
        select_municipio,
        select_municipio2,
        n,
        edit = () => {
            n.querySelectorAll(
                '[data-kt-empaque-table-filter="edit"]'
            ).forEach((e) => {
                e.addEventListener("click", function (e) {
                    e.preventDefault()
                    $.get("empaques/"+ $(this).data("id") + "/edit", function(data){
                        edit_id.value=data.empaque.id
                        // edit_localidad_id.value = data.empaque.localidad_id
                        // edit_localidad_doc_id.value = data.empaque.
                        // edit_nombre_corto.value = data.empaque.
                        // edit_nombre_fiscal.value = data.empaque.
                        // edit_domicilio_fiscal.value = data.empaque.
                        // edit_num_ext.value = data.empaque.
                        // edit_num_int.value = data.empaque.
                        // edit_cp.value = data.empaque.
                        // edit_rfc.value = data.empaque.
                        // edit_telefonos.value = data.empaque.
                        // edit_imagen.value = data.empaque.
                        // edit_nombre_embarque.value = data.empaque.
                        // edit_domicilio_documentacion.value = data.empaque.
                        // edit_codigo.value = data.empaque.
                        // edit_exportacion.value = data.empaque.
                        // edit_asociado.value = data.empaque.
                        // edit_empaque.value=data.empaque.empaque
                        Catalogs.checked_edit(data.empaque.activo, edit_active, check_active)
                        modal.show()
                    })
                })
            })
        }

        return {
            init: function () {
                (modal = new bootstrap.Modal(
                    document.querySelector("#kt_modal_add_empaque")
                )),
                // inicialize elements html
                (select_municipio = $('#municipio_id').select2()),
                (select_municipio2 = $('#municipio_id2').select2()),
                (btn_add = document.querySelector("#btn_add")),
                (form = document.querySelector("#kt_modal_add_empaque_form")),
                (btn_modal = form.querySelector("#kt_modal_add_empaque_close")),
                (btn_submit = form.querySelector("#kt_modal_add_empaque_submit")),
                (btn_cancel = form.querySelector("#kt_modal_add_empaque_cancel")),
                (edit_id = form.querySelector("#id_empaque")),
                // (edit_empaque = form.querySelector("#empaque")),
                (check_active = form.querySelector("#check_activo")),
                (check_exportacion = form.querySelector("#check_exportacion")),
                (check_asociado = form.querySelector("#check_asociado")),
                (edit_exportacion = form.querySelector("#exportacion")),
                (edit_asociado = form.querySelector("#asociado")),
                (edit_active = form.querySelector("#activo")),
                (validations = FormValidation.formValidation(form, {
                    fields: {
                        empaque: {
                            validators: {
                                notEmpty: {
                                    message: "Ingrese el empaque",
                                },
                            },
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: "",
                        }),
                    },
                })),
                (n = document.querySelector("#kt_empaques_table")) &&
                    (n.querySelectorAll("tbody tr").forEach((t) => {
                        // formats
                        }),
                        (table_items = $(n).DataTable({
                            ajax: "empaques",
                            serverSide: true,
                            processing: true,
                            columns: [
                                { data: "check", name: "check" },
                                { data: "id", name: "id" },
                                { data: "nombre_corto" , name : "nombre_corto" },
                                { data: "nombre_fiscal" , name : "nombre_fiscal" },
                                { data: "domicilio_fiscal" , name : "domicilio_fiscal" },
                                { data: "num_ext" , name : "num_ext" },
                                { data: "num_int" , name : "num_int" },
                                { data: "cp", name : "cp" },
                                { data: "rfc" , name : "rfc" },
                                { data: "telefonos" , name : "telefonos" },
                                { data: "imagen", name : "imagen" },
                                { data: "nombre_embarque" , name : "nombre_embarque" },
                                { data: "domicilio_documentacion" , name : "domicilio_documentacion" },
                                { data: "codigo", name: "codigo" },
                                { data: "exportacion" , name : "exportacion" },
                                { data: "asociados" , name : "asociados"},
                                { data: "activos", name: "activos" },
                                { data: "buttons", name: "buttons" },
                            ],
                            order: [[2, "asc"]],
                            columnDefs: [
                                { orderable: !1, targets: 0 },
                                {
                                    targets: [1],
                                    visible: false,
                                    searchable: false,
                                },
                            ],
                            language: {
                                zeroRecords: "No hay datos que mostrar",
                                info: "Mostrando página _PAGE_ de _PAGES_",
                                infoEmpty: "No hay información",
                                infoFiltered: "(Filtrando _MAX_ registros)",
                                processing:
                                    `<span class="loader"></span>`
                            },
                        })).on("draw", function () {
                            Catalogs.delete_items(n, table_items, catalog, catalog_item, token), edit(), Catalogs.uncheck(n, catalog_item)
                        }),
                        Catalogs.delete_items(n, table_items, catalog, catalog_item, token),
                        edit(),
                        document.querySelector('[data-kt-empaque-table-filter="search"]').addEventListener("keyup", function (e) {
                            table_items.search(e.target.value).draw()
                        })
                    )
                // CHECK ACTIVE
                check_active.addEventListener("click", function (t) {
                    Catalogs.checked(edit_active, check_active)
                })
                // CHECK ASOCIADO
                check_asociado.addEventListener("click", function (t) {
                    Catalogs.checked(edit_asociado, check_asociado)
                })
                // CHECK ACTIVE
                check_exportacion.addEventListener("click", function (t) {
                    Catalogs.checked(edit_exportacion, check_exportacion)
                })
                // BUTTON ADD
                btn_add.addEventListener("click", function (t) {
                    Catalogs.checked(edit_active, check_active)
                    form.reset()
                    $("#pais_id").val(null).trigger("change.select2")
                    modal.show()
                })
                // CLOSE MODAL
                btn_modal.addEventListener("click", function (t) {
                    t.preventDefault(), modal.hide()
                })
                // CLOSE MODAL
                btn_cancel.addEventListener("click", function (t) {
                    t.preventDefault(), modal.hide()
                })
                 // CHANGE MUNICIPIO
                select_municipio.on('change', function() {
                    const select_estado2 = $('#localidad_id').select2()
                    Catalogs.get_next_selects(cat_localidades, select_municipio.val(), catalog_item, select_estado2)
                })
                 // CHANGE MUNICIPIO2
                select_municipio2.on('change', function() {
                    const select_estado2 = $('#localidad_doc_id').select2()
                    Catalogs.get_next_selects(cat_localidades, select_municipio2.val(), catalog_item, select_estado2)
                })
                // SUBMIT
                btn_submit.addEventListener("click", function (e) {
                    e.preventDefault(),
                    validations &&
                    validations.validate().then(function (e) {
                        "Valid" == e
                            ? (btn_submit.setAttribute(
                                    "data-kt-indicator",
                                    "on"
                                ),
                                (btn_submit.disabled = !0),
                                setTimeout(function () {
                                    btn_submit.removeAttribute(
                                        "data-kt-indicator"
                                    )
                                    // const formData = new URLSearchParams(new FormData(document.querySelector(`#kt_modal_add_${catalog_item}_form`)))
                                    const formData = new FormData(document.querySelector(`#kt_modal_add_${catalog_item}_form`))
                                    Catalogs.submit_form(catalog, formData, token, modal, table_items, btn_submit, form)


                                }, 1000))
                            : Swal.fire({
                                    text: "Error, faltan algunos datos, intente de nuevo por favor.",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Entendido!",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    },
                                })
                    })
                })
            },
        }
})()
KTUtil.onDOMContentLoaded(function () {
    KTempaqueesList.init()
})
