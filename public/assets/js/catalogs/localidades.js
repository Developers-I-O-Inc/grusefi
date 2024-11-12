"use strict"

import Catalogs from "./general.js"

var KTlocalidadesList = (function () {

    const catalog_fat = "estados"
    const catalog_fat2 = "municipios"
    const catalog = "localidades"
    const catalog_item = "localidad"
    const token = $('meta[name="csrf-token"]').attr('content')

    let table_items,
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
        edit_active,
        check_active,
        select_pais,
        select_estado,
        select_municipio,
        select_estado_2,
        var_estado,
        n,
        edit = () => {
            n.querySelectorAll(
                '[data-kt-localidad-table-filter="edit"]'
            ).forEach((e) => {
                e.addEventListener("click", function (e) {
                    e.preventDefault()
                    $.get("localidades/"+ $(this).data("id") + "/edit", function(data){
                        edit_id.value = data.localidad[0].id
                        edit_nombre.value = data.localidad[0].nombre
                        edit_nombre_corto.value = data.localidad[0].nombre_corto
                        edit_codigo.value = data.localidad[0].codigo
                        if(data.localidad[0].activo){
                            check_active.checked = true
                            edit_active.value = 1
                        }
                        else{
                            check_active.checked = false
                            edit_active.value = 0
                        }
                        $("#pais_id").val(data.localidad[0].pais_id).trigger("change.select2")
                        select_pais.trigger('change');
                        select_estado_2.setAttribute('data-id', data.localidad[0].estado_id)
                        $("#estado_id").val(data.localidad[0].estado_id).trigger("change.select2")
                        var_estado= data.localidad[0].estado_id
                        select_estado.trigger('change');
                        select_municipio.setAttribute('data-id', data.localidad[0].municipio_id)

                        modal.show()
                    })
                })
            })
        }

        return {
            init: function () {
                (modal = new bootstrap.Modal(
                    document.querySelector("#kt_modal_add_localidad")
                )),
                // inicialize elements html
                (select_pais = $('#pais_id').select2()),
                (select_estado = $('#estado_id').select2()),
                (select_estado_2 = document.querySelector("#estado_id")),
                (select_municipio = document.querySelector("#municipio_id")),
                (btn_add = document.querySelector("#btn_add")),
                // (select_estado = document.querySelector("#estado_id")),
                (form = document.querySelector("#kt_modal_add_localidad_form")),
                (btn_modal = form.querySelector("#kt_modal_add_localidad_close")),
                (btn_submit = form.querySelector("#kt_modal_add_localidad_submit")),
                (btn_cancel = form.querySelector("#kt_modal_add_localidad_cancel")),
                (edit_id = form.querySelector("#id_localidad")),
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
                        municipio_id: {
                            validators: {
                                notEmpty: {
                                    message: 'Seleccione un municipio'
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
                (n = document.querySelector("#kt_localidades_table")) &&
                    (n.querySelectorAll("tbody tr").forEach((t) => {
                        // formats
                        }),
                        (table_items = $(n).DataTable({
                            ajax: "localidades",
                            serverSide: true,
                            processing: true,
                            columns: [
                                { data: "check", name: "check" },
                                { data: "id", name: "id" },
                                { data: "nombre", name: "nombre" },
                                { data: "nombre_corto", name: "nombre_corto" },
                                { data: "municipio", name: "municipio" },
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
                        document.querySelector('[data-kt-localidad-table-filter="search"]').addEventListener("keyup", function (e) {
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
                    $("#municipio_id").val(null).trigger("change.select2")
                    $("#estado_id").val(null).trigger("change.select2")
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
    KTlocalidadesList.init()
})
