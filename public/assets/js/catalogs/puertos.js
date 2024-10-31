"use strict"

import Catalogs from "./general.js"

var KTpuertoesList = (function () {

    const catalog_fat = "estados"
    const catalog_fat2 = "municipios"
    const catalog = "puertos"
    const catalog_item = "puerto"
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
        edit_puerto,
        edit_nombre_corto,
        edit_transporte,
        edit_active,
        edit_placas,
        check_active,
        check_placas,
        select_pais,
        select_estado,
        select_estado2,
        select_municipio,
        var_estado,
        n,
        edit = () => {
            n.querySelectorAll(
                '[data-kt-puerto-table-filter="edit"]'
            ).forEach((e) => {
                e.addEventListener("click", function (e) {
                    e.preventDefault()
                    $.get("puertos/"+ $(this).data("id") + "/edit", function(data){
                        edit_id.value=data.puerto[0].id
                        edit_puerto.value=data.puerto[0].puerto
                        edit_nombre_corto.value=data.puerto[0].nombre_corto
                        edit_transporte.value=data.puerto[0].medio_transporte
                        Catalogs.checked_edit(data.puerto[0].placas, edit_placas, check_placas)
                        Catalogs.checked_edit(data.puerto[0].activo, edit_active, check_active)
                        $("#medio_transporte").val(data.puerto[0].medio_transporte).trigger("change.select2")
                        $("#pais_id").val(data.puerto[0].pais_id).trigger("change.select2")
                        select_pais.trigger('change');
                        select_estado2.setAttribute('data-id', data.puerto[0].estado_id)
                        $("#estado_id").val(data.puerto[0].estado_id).trigger("change.select2")
                        var_estado= data.puerto[0].estado_id
                        select_estado.trigger('change');
                        select_municipio.setAttribute('data-id', data.puerto[0].municipio_id)
                        modal.show()
                    })
                })
            })
        }

        return {
            init: function () {
                (modal = new bootstrap.Modal(
                    document.querySelector("#kt_modal_add_puerto")
                )),
                // inicialize elements html
                (select_pais = $('#pais_id').select2()),
                (select_estado = $('#estado_id').select2()),
                (select_estado2 = document.querySelector("#estado_id")),
                (select_municipio = document.querySelector("#municipio_id")),
                (btn_add = document.querySelector("#btn_add")),
                (form = document.querySelector("#kt_modal_add_puerto_form")),
                (btn_modal = form.querySelector("#kt_modal_add_puerto_close")),
                (btn_submit = form.querySelector("#kt_modal_add_puerto_submit")),
                (btn_cancel = form.querySelector("#kt_modal_add_puerto_cancel")),
                (edit_id = form.querySelector("#id_puerto")),
                (edit_puerto = form.querySelector("#puerto")),
                (edit_nombre_corto = form.querySelector("#nombre_corto")),
                (edit_transporte = form.querySelector("#medio_transporte")),
                (check_active = form.querySelector("#check_activo")),
                (check_placas = form.querySelector("#check_placas")),
                (edit_active = form.querySelector("#activo")),
                (edit_placas = form.querySelector("#placas")),
                (validations = FormValidation.formValidation(form, {
                    fields: {
                        pais_id: {
                            validators: {
                                notEmpty: {
                                    message: "Seleccione el país",
                                },
                            },
                        },
                        estado_id: {
                            validators: {
                                notEmpty: {
                                    message: "Seleccione el país",
                                },
                            },
                        },
                        municipio_id: {
                            validators: {
                                notEmpty: {
                                    message: "Seleccione el país",
                                },
                            },
                        },
                        puerto: {
                            validators: {
                                notEmpty: {
                                    message: "Ingrese el puerto",
                                },
                            },
                        },
                        nombre_corto: {
                            validators: {
                                notEmpty: {
                                    message: "Ingrese el nombre corto del puerto",
                                },
                            },
                        },
                        medio_transporte: {
                            validators: {
                                notEmpty: {
                                    message: "Seleccione el medio de transporte",
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
                (n = document.querySelector("#kt_puertos_table")) &&
                    (n.querySelectorAll("tbody tr").forEach((t) => {
                        // formats
                        }),
                        (table_items = $(n).DataTable({
                            ajax: "puertos",
                            serverSide: true,
                            processing: true,
                            columns: [
                                { data: "check", name: "check" },
                                { data: "buttons", name: "buttons" },
                                { data: "id", name: "id" },
                                { data: "puerto", name: "puerto" },
                                { data: "pais", name: "pais" },
                                { data: "estado", name: "estado" },
                                { data: "municipio", name: "municipio" },
                                { data: "nombre_corto", name: "nombre_corto" },
                                { data: "medio_transporte", name: "medio_transporte" },
                                { data: "placas", name: "placas" },
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
                        document.querySelector('[data-kt-puerto-table-filter="search"]').addEventListener("keyup", function (e) {
                            table_items.search(e.target.value).draw()
                        })
                    )
                // CHECK ACTIVE
                check_active.addEventListener("click", function (t) {
                    Catalogs.checked(edit_active, check_active)
                })
                 // CHECK INSPECTOR
                check_placas.addEventListener("click", function (t) {
                    Catalogs.checked(edit_placas, check_placas)
                })
                // BUTTON ADD
                btn_add.addEventListener("click", function (t) {
                    Catalogs.checked(edit_active, check_active)
                    form.reset()
                    $("#pais_id").val(null).trigger("change.select2")
                    $("#estado_id").val(null).trigger("change.select2")
                    $("#municipio_id").val(null).trigger("change.select2")
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
                 // CHANGE PAIS
                 select_pais.on('change', function() {
                    const select_estado2 = $('#estado_id').select2()
                    Catalogs.get_next_selects(catalog_fat, select_pais.val(), catalog_item, select_estado2)
                })
                // CHANGE ESTADO
                select_estado.on('change', function() {
                    const select_estado2 = $('#municipio_id').select2()
                    let estado_id_changue
                    if (typeof var_estado === "undefined") {
                        estado_id_changue = select_estado.val()
                      }
                    else{
                        estado_id_changue = var_estado
                    }
                    Catalogs.get_next_selects(catalog_fat2, estado_id_changue, catalog_item, select_estado2)
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
    KTpuertoesList.init()
})
