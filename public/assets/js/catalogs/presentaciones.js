"use strict"

import Catalogs from "./general.js"

var KTpresentacionesList = (function () {

    const catalog = "presentaciones"
    const catalog_item = "presentacion"
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
        edit_presentacion,
        edit_peso,
        edit_active,
        check_active,
        select_variedad,
        n,
        edit = () => {
            n.querySelectorAll(
                '[data-kt-presentacion-table-filter="edit"]'
            ).forEach((e) => {
                e.addEventListener("click", function (e) {
                    e.preventDefault()
                    $.get("presentaciones/"+ $(this).data("id") + "/edit", function(data){
                        edit_id.value=data.presentacion.id
                        edit_presentacion.value=data.presentacion.presentacion
                        edit_peso.value=data.presentacion.peso
                        Catalogs.checked_edit(data.presentacion.activo, edit_active, check_active)
                        $("#variedad_id").val(data.presentacion.variedad_id).trigger("change.select2")
                        modal.show()
                    })
                })
            })
        }

        return {
            init: function () {
                (modal = new bootstrap.Modal(
                    document.querySelector("#kt_modal_add_presentacion")
                )),
                // inicialize elements html
                (btn_add = document.querySelector("#btn_add")),
                (select_variedad = $("#variedad_id").select2()),
                (form = document.querySelector("#kt_modal_add_presentacion_form")),
                (btn_modal = form.querySelector("#kt_modal_add_presentacion_close")),
                (btn_submit = form.querySelector("#kt_modal_add_presentacion_submit")),
                (btn_cancel = form.querySelector("#kt_modal_add_presentacion_cancel")),
                (edit_id = form.querySelector("#id_presentacion")),
                (edit_presentacion = form.querySelector("#presentacion")),
                (edit_peso = form.querySelector("#peso")),
                (check_active = form.querySelector("#check_activo")),
                (edit_active = form.querySelector("#activo")),
                (validations = FormValidation.formValidation(form, {
                    fields: {
                        variedad_id: {
                            validators: {
                                notEmpty: {
                                    message: "Seleccione una variedad",
                                },
                            },
                        },
                        presentacion: {
                            validators: {
                                notEmpty: {
                                    message: "Ingrese una presentación",
                                },
                            },
                        },
                        peso: {
                            validators: {
                                notEmpty: {
                                    message: "Ingrese el peso",
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
                (n = document.querySelector("#kt_presentaciones_table")) &&
                    (n.querySelectorAll("tbody tr").forEach((t) => {
                        // formats
                        }),
                        (table_items = $(n).DataTable({
                            ajax: "presentaciones",
                            serverSide: true,
                            processing: true,
                            columns: [
                                { data: "check", name: "check" },
                                { data: "id", name: "id" },
                                { data: "variedad", name: "variedad" },
                                { data: "presentacion", name: "presentacion" },
                                { data: "peso", name: "peso" },
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
                        document.querySelector('[data-kt-presentacion-table-filter="search"]').addEventListener("keyup", function (e) {
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
                    $("#variedad_id").val(null).trigger("change.select2")
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
                                    )
                                    const formData = new URLSearchParams(new FormData(document.querySelector(`#kt_modal_add_${catalog_item}_form`)))
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
    KTpresentacionesList.init()
})
