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
        edit_regulacion,
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
                        edit_regulacion.value=data.regulacion[0].regulacion
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
                (edit_regulacion = form.querySelector("#regulacion")),
                (check_active = form.querySelector("#active_check")),
                (edit_active = form.querySelector("#activo")),
                (validations = FormValidation.formValidation(form, {
                    fields: {
                        regulacion: {
                            validators: {
                                notEmpty: {
                                    message: "Descripción requerida",
                                },
                            },
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                        })
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
                                { data: "id", name: "id" },
                                { data: "regulacion", name: "regulacion" },
                                { data: "activos", name: "activos" },
                                { data: "buttons", name: "buttons" },
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
