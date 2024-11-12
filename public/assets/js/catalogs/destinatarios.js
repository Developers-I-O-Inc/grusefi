"use strict"

import Catalogs from "./general.js"

var KTdestinatarioesList = (function () {

    const catalog = "destinatarios"
    const catalog_item = "destinatario"
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
        edit_nombre,
        edit_nombre_corto,
        edit_domicilio,
        edit_telefonos,
        edit_correos,
        select_empaque,
        edit_active,
        check_active,
        n,
        edit = () => {
            n.querySelectorAll(
                '[data-kt-destinatario-table-filter="edit"]'
            ).forEach((e) => {
                e.addEventListener("click", function (e) {
                    e.preventDefault()
                    $.get("destinatarios/"+ $(this).data("id") + "/edit", function(data){
                        edit_id.value=data.destinatario.id
                        $("#empaque_id").val(data.destinatario.empaque_id).trigger("change.select2")
                        select_empaque.trigger('change');
                        edit_nombre.value=data.destinatario.nombre
                        edit_nombre_corto.value=data.destinatario.nombre_corto
                        edit_domicilio.value=data.destinatario.domicilio
                        edit_telefonos.value=data.destinatario.telefonos
                        edit_correos.value=data.destinatario.correos
                        Catalogs.checked_edit(data.destinatario.activo, edit_active, check_active)
                        modal.show()
                    })
                })
            })
        }

        return {
            init: function () {
                (modal = new bootstrap.Modal(
                    document.querySelector("#kt_modal_add_destinatario")
                )),
                // inicialize elements html
                (select_empaque = $('#empaque_id').select2()),
                (btn_add = document.querySelector("#btn_add")),
                (form = document.querySelector("#kt_modal_add_destinatario_form")),
                (btn_modal = form.querySelector("#kt_modal_add_destinatario_close")),
                (btn_submit = form.querySelector("#kt_modal_add_destinatario_submit")),
                (btn_cancel = form.querySelector("#kt_modal_add_destinatario_cancel")),
                (edit_id = form.querySelector("#id_destinatario")),
                (edit_nombre = form.querySelector("#nombre")),
                (edit_nombre_corto = form.querySelector("#nombre_corto")),
                (edit_domicilio = form.querySelector("#domicilio")),
                (edit_telefonos = form.querySelector("#telefonos")),
                (edit_correos = form.querySelector("#correos")),
                (check_active = form.querySelector("#check_activo")),
                (edit_active = form.querySelector("#activo")),
                (validations = FormValidation.formValidation(form, {
                    fields: {
                        nombre: {
                            validators: {
                                notEmpty: {
                                    message: "Ingrese el nombre del destinatario",
                                },
                            },
                        },
                        nombre_corto: {
                            validators: {
                                notEmpty: {
                                    message: "Ingrese el nombre corto del destinatario",
                                },
                            },
                        },
                        domicilio: {
                            validators: {
                                notEmpty: {
                                    message: "Ingrese el domicilio del destinatario",
                                },
                            },
                        },
                        telefonos: {
                            validators: {
                                notEmpty: {
                                    message: "Ingrese los telefonos del destinatario",
                                },
                            },
                        },
                        correos: {
                            validators: {
                                notEmpty: {
                                    message: "Ingrese los correos del destinatario",
                                },
                            },
                        },
                        empaque_id: {
                            validators: {
                                notEmpty: {
                                    message: "Seleccione el empaque",
                                },
                            },
                        }
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
                (n = document.querySelector("#kt_destinatarios_table")) &&
                    (n.querySelectorAll("tbody tr").forEach((t) => {
                        // formats
                        }),
                        (table_items = $(n).DataTable({
                            ajax: "destinatarios",
                            serverSide: true,
                            processing: true,
                            columns: [
                                { data: "check", name: "check" },
                                { data: "id", name: "id" },
                                { data: "nombre_fiscal", name: "nombre_fiscal" },
                                { data: "nombre", name: "nombre" },
                                { data: "nombre_corto", name: "nombre_corto" },
                                { data: "domicilio", name: "domicilio" },
                                { data: "telefonos", name: "telefonos" },
                                { data: "correos", name: "correos" },
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
                        document.querySelector('[data-kt-destinatario-table-filter="search"]').addEventListener("keyup", function (e) {
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
                    $("#empaque_id").val(null).trigger("change.select2")
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
    KTdestinatarioesList.init()
})
