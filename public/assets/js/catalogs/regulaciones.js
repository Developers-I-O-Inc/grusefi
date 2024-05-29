"use strict"

import Catalogs from "./general.js"

var KTregulacionesList = (function () {

    const catalog = "regulaciones"
    const catalog_item = "regulacion"
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
        edit_dictamen_4,
        edit_dictamen_5,
        edit_dictamen_11,
        edit_pais_dictamen,
        edit_pais_certificado,
        edit_embarques,
        edit_inspector,
        edit_huertas,
        edit_analisis,
        edit_impresion,
        edit_active,
        check_active,
        check_embarques,
        check_inspector,
        check_huertas,
        check_analisis,
        check_impresion,
        select_pais,
        n,
        edit = () => {
            n.querySelectorAll(
                '[data-kt-regulacion-table-filter="edit"]'
            ).forEach((e) => {
                e.addEventListener("click", function (e) {
                    e.preventDefault()
                    $.get("regulaciones/"+ $(this).data("id") + "/edit", function(data){
                        edit_id.value=data.regulacion[0].id
                        edit_dictamen_4.value=data.regulacion[0].dictamen_apartado_4
                        edit_dictamen_5.value=data.regulacion[0].dictamen_apartado_5
                        edit_dictamen_11.value=data.regulacion[0].dictamen_apartado_11
                        edit_pais_dictamen.value=data.regulacion[0].nombre_pais_dictamen
                        edit_pais_certificado.value=data.regulacion[0].nombre_pais_certificado
                        Catalogs.checked_edit(data.regulacion[0].activo_embarques, edit_embarques, check_embarques)
                        Catalogs.checked_edit(data.regulacion[0].rq_inspector, edit_inspector, check_inspector)
                        Catalogs.checked_edit(data.regulacion[0].rq_huertas, edit_huertas, check_huertas)
                        Catalogs.checked_edit(data.regulacion[0].rq_estudios_analisis, edit_analisis, check_analisis)
                        Catalogs.checked_edit(data.regulacion[0].rq_impresion, edit_impresion, check_impresion)
                        Catalogs.checked_edit(data.regulacion[0].rq_activo, edit_active, check_active)
                        $("#pais_id").val(data.regulacion[0].pais_id).trigger("change.select2")
                        select_pais.trigger('change');
                        modal.show()
                    })
                })
            })
        }

        return {
            init: function () {
                (modal = new bootstrap.Modal(
                    document.querySelector("#kt_modal_add_regulacion")
                )),
                // inicialize elements html
                (btn_add = document.querySelector("#btn_add")),
                (select_pais = $('#pais_id').select2()),
                (form = document.querySelector("#kt_modal_add_regulacion_form")),
                (btn_modal = form.querySelector("#kt_modal_add_regulacion_close")),
                (btn_submit = form.querySelector("#kt_modal_add_regulacion_submit")),
                (btn_cancel = form.querySelector("#kt_modal_add_regulacion_cancel")),
                (edit_id = form.querySelector("#id_regulacion")),
                (edit_dictamen_4 = form.querySelector("#dictamen_apartado_4")),
                (edit_dictamen_5 = form.querySelector("#dictamen_apartado_5")),
                (edit_dictamen_11 = form.querySelector("#dictamen_apartado_11")),
                (edit_pais_dictamen = form.querySelector("#nombre_pais_dictamen")),
                (edit_pais_certificado = form.querySelector("#nombre_pais_certificado")),
                (check_active = form.querySelector("#active_check")),
                (check_embarques = form.querySelector("#check_embarques")),
                (check_inspector = form.querySelector("#check_inspector")),
                (check_huertas = form.querySelector("#check_huertas")),
                (check_analisis = form.querySelector("#check_analisis")),
                (check_impresion = form.querySelector("#check_impresion")),
                (edit_active = form.querySelector("#activo")),
                (edit_embarques = form.querySelector("#activo_embarques")),
                (edit_inspector = form.querySelector("#rq_inspector")),
                (edit_huertas = form.querySelector("#rq_huertas")),
                (edit_analisis = form.querySelector("#rq_estudios_analisis")),
                (edit_impresion = form.querySelector("#rq_impresion")),
                (validations = FormValidation.formValidation(form, {
                    fields: {
                        nombre: {
                            validators: {
                                notEmpty: {
                                    message: "Nombre requerido",
                                },
                            },
                        },
                        nombre_corto: {
                            validators: {
                                notEmpty: {
                                    message: "Nombre corto requerido",
                                },
                            },
                        },
                        codigo: {
                            validators: {
                                notEmpty: {
                                    message: "Código",
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
                (n = document.querySelector("#kt_regulaciones_table")) &&
                    (n.querySelectorAll("tbody tr").forEach((t) => {
                        // formats
                        }),
                        (table_items = $(n).DataTable({
                            ajax: "regulaciones",
                            serverSide: true,
                            processing: true,
                            columns: [
                                { data: "check", name: "check" },
                                { data: "buttons", name: "buttons" },
                                { data: "id", name: "id" },
                                { data: "pais", name: "pais" },
                                { data: "abreviacion", name: "abreviacion" },
                                { data: "dictamen_apartado_4", name: "dictamen_apartado_4" },
                                { data: "dictamen_apartado_5", name: "dictamen_apartado_5" },
                                { data: "dictamen_apartado_11", name: "dictamen_apartado_11" },
                                { data: "nombre_pais_dictamen", name: "nombre_pais_dictamen" },
                                { data: "nombre_pais_certificado", name: "nombre_pais_certificado" },
                                { data: "embarques", name: "embarques" },
                                { data: "inspector", name: "inspector" },
                                { data: "huertas", name: "huertas" },
                                { data: "analisis", name: "analisis" },
                                { data: "impresion", name: "impresion" },
                                { data: "activos", name: "activos" },
                            ],
                            order: [[2, "asc"]],
                            columnDefs: [
                                { orderable: !1, targets: 0 },
                                {
                                    targets: [2],
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
                        document.querySelector('[data-kt-regulacion-table-filter="search"]').addEventListener("keyup", function (e) {
                            table_items.search(e.target.value).draw()
                        })
                    )
                // CHECK ACTIVE
                check_active.addEventListener("click", function (t) {
                    Catalogs.checked(edit_active, check_active)
                })
                // CHECK EMBARQUES
                check_embarques.addEventListener("click", function (t) {
                    Catalogs.checked(edit_embarques, check_embarques)
                })
                // CHECK INSPECTOR
                check_inspector.addEventListener("click", function (t) {
                    Catalogs.checked(edit_inspector, check_inspector)
                })
                // CHECK HUERTAS
                check_huertas.addEventListener("click", function (t) {
                    Catalogs.checked(edit_huertas, check_huertas)
                })
                // CHECK ANALISIS
                check_analisis.addEventListener("click", function (t) {
                    Catalogs.checked(edit_analisis, check_analisis)
                })
                // CHECK IMPRESION
                check_impresion.addEventListener("click", function (t) {
                    Catalogs.checked(edit_impresion, check_impresion)
                })
                // BUTTON ADD
                btn_add.addEventListener("click", function (t) {
                    Catalogs.checked(edit_active, check_active)
                    form.reset()
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
                                    ),
                                    $.ajax({
                                        url: "regulaciones",
                                        type: "POST",
                                        dataType:"json",
                                        encode: "true",
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        data: $("#kt_modal_add_regulacion_form").serialize(),
                                        success: function (result) {
                                                Swal.fire({
                                                text: "Datos guardados exitosamente!",
                                                icon: "success",
                                                buttonsStyling: !1,
                                                confirmButtonText:
                                                    "Entendido!",
                                                customClass: {
                                                confirmButton:
                                                    "btn btn-primary",
                                            },
                                            }).then(function (e) {
                                                e.isConfirmed &&
                                                    (modal.hide(),
                                                    (btn_submit.disabled =
                                                        !1), table_items.ajax.reload(), form.reset())
                                            })
                                        },
                                        beforeSend(){
                                            Swal.fire({
                                                title: "<strong>Cargando</strong>",
                                                html: `<div class="progress container-fluid"></div>`,
                                                showConfirmButton: false,
                                                })
                                        },
                                        error(data){
                                            Swal.fire({
                                                icon: "error",
                                                title: "Error",
                                                text: "Ocurrio un error en la base de datos!",
                                            })
                                            btn_submit.disabled = !1
                                            console.log(data)
                                        }
                                    })

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
    KTregulacionesList.init()
})
