"use strict"

import Catalogs from "./general.js"

var KTmunicipioesList = (function () {

    const catalog_fat = "estados"
    const catalog = "municipios"
    const catalog_item = "municipio"
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
        edit_codigo,
        check_active,
        edit_active,
        select_estado,
        select_pais,
        n,
        edit = () => {
            n.querySelectorAll(
                '[data-kt-municipio-table-filter="edit"]'
            ).forEach((e) => {
                e.addEventListener("click", function (e) {
                    // e.preventDefault()
                    $.get("municipios/"+ $(this).data("id") + "/edit", function(data){
                        edit_id.value = data.municipio[0].id
                        edit_nombre.value = data.municipio[0].nombre
                        edit_nombre_corto.value = data.municipio[0].nombre_corto
                        edit_codigo.value = data.municipio[0].codigo
                        if(data.municipio[0].activo){
                            check_active.checked = true
                            edit_active.value = 1
                        }
                        else{
                            check_active.checked = false
                            edit_active.value = 0
                        }
                        $("#pais_id").val(data.municipio[0].pais_id).trigger("change.select2")
                        select_pais.trigger('change');
                        select_estado.setAttribute('data-id', data.municipio[0].estado_id)
                        modal.show()
                    })
                })
            })
        }

        return {
            init: function () {
                (modal = new bootstrap.Modal(
                    document.querySelector("#kt_modal_add_municipio")
                )),
                // inicialize elements html
                (btn_add = document.querySelector("#btn_add")),
                (select_estado = document.querySelector("#estado_id")),
                (select_pais = $('#pais_id').select2()),
                (form = document.querySelector("#kt_modal_add_municipio_form")),
                (btn_modal = form.querySelector("#kt_modal_add_municipio_close")),
                (btn_submit = form.querySelector("#kt_modal_add_municipio_submit")),
                (btn_cancel = form.querySelector("#kt_modal_add_municipio_cancel")),
                (edit_id = form.querySelector("#id_municipio")),
                (edit_nombre = form.querySelector("#nombre")),
                (edit_nombre_corto = form.querySelector("#nombre_corto")),
                (edit_codigo = form.querySelector("#codigo")),
                (check_active = form.querySelector("#active_check")),
                (edit_active = form.querySelector("#activo")),
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
                        pais_id: {
                            validators: {
                                notEmpty: {
                                    message: 'Seleccione un país'
                                }
                            }
                        },
                        estado_id: {
                            validators: {
                                notEmpty: {
                                    message: 'Seleccione un estado'
                                }
                            }
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
                (n = document.querySelector("#kt_municipios_table")) &&
                    (n.querySelectorAll("tbody tr").forEach((t) => {
                        // formats
                        }),
                        (table_items = $(n).DataTable({
                            ajax: "municipios",
                            serverSide: true,
                            processing: true,
                            columns: [
                                { data: "check", name: "check" },
                                { data: "id", name: "id" },
                                { data: "nombre", name: "nombre" },
                                { data: "nombre_corto", name: "nombre_corto" },
                                { data: "estado", name: "estado" },
                                { data: "pais", name: "pais" },
                                { data: "codigo", name: "codigo" },
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
                        document.querySelector('[data-kt-municipio-table-filter="search"]').addEventListener("keyup", function (e) {
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
                    $("#pais_id").val(null).trigger("change.select2")
                    $("#estado_id").val(null).trigger("change.select2")
                    select_estado.removeAttribute('data-id')
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
    KTmunicipioesList.init()
})
