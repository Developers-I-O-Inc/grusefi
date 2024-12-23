"use strict"
import Operation from "./general.js"

var KTCreateAccount = (function () {
    let check_active,
        edit_active,
        check_import
    const token = $('meta[name="csrf-token"]').attr('content')
    var e,
        btn_modal,
        btn_modal_c,
        btn_add_marca,
        btn_add_maquilador,
        btn_add_products,
        btn_add_product,
        count_marcas = 0,
        edit_text_marca,
        edit_text_products,
        table_marcas,
        table_maquilador,
        table_products,
        stepper_embarques,
        form_embarques,
        form_products,
        modal,
        btn_submit,
        s,
        r,
        select_empaque,
        select_consolidado,
        select_destinatario,
        select_marca,
        select_maquiladores,
        select_pais,
        select_puerto,
        select_tefs,
        select_variedad,
        select_presentacion,
        select_puerto2,
        arr_validations = [],
        add_fields = (table, select) => {
            if(select.val() != ""){
                var data = table.rows().data(); // All data datatable permissions
                let repeat=false;
                for (var i = 0; i < data.length; i++) {
                    if (data[i][0] === select.val()) {
                        repeat=true;
                    }
                }
                if(repeat){
                    Swal.fire({
                        title: "Advertencia!",
                        text: "El permiso " + select.val() +" ya esta asignado al usuario!",
                        icon: "warning"
                      });
                }else{

                    table.row.add([select.val(), select.select2('data')[0].text, `<button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1"
                        data-kt-customer-table-filter="delete_row">
                        <span class="svg-icon svg-icon-muted svg-icon-5"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"/>
                            <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"/>
                            <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"/>
                            </svg></span>
                        </button>`]).draw()

                    count_marcas = count_marcas + 1
                    edit_text_marca.value=count_marcas

                }
            }
            else{
                Swal.fire({
                    title: "Advertencia!",
                    text: "Seleccione un permiso!",
                    icon: "warning"
                  });
            }
        },
        delete_permission = (table, marca) => {
            document.querySelectorAll('[data-kt-customer-table-filter="delete_row"]').forEach((e) => {
                e.addEventListener("click", function (e) {
                    e.preventDefault();
                    const o = e.target.closest("tr")
                    table.row($(o)).remove().draw()
                    if(marca){
                        edit_text_marca.value = table.column(0).data().length > 0 ? 1 : ''
                    }
                });
            });
        },
        save_embarque = async (datos, token, btnSubmit, form) => {
            try {
                Swal.fire({
                    title: "<strong>Cargando</strong>",
                    html: `<div class="progress container-fluid"></div>`,
                    showConfirmButton: false,
                });
                const response = await fetch('embarques', {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": token,
                    },
                    body: datos,
                });
                if (!response.ok) {
                    throw new Error("Error en la base de datos");
                }

                const result = await response.json();
                $('#link_dictamen').attr('href', `/operation/imprimir_dictamen_embarque/${select_pais.val()}/${result.embarque_id}`)
                $('#link_consulta').attr('href', `/operation/embarques_admin`)
                // Mostrar alerta de éxito
                await Swal.fire({
                    text: "Datos guardados exitosamente!",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Entendido!",
                    customClass: {
                        confirmButton: "btn btn-primary",
                    },
                });

                btnSubmit.disabled = false;
                form.reset();

            } catch (error) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: error.message,
                });
                console.error(error);
                btnSubmit.disabled = false;
            }
        }
    return {
        init: function () {
                (modal = new bootstrap.Modal(document.querySelector("#kt_modal_add_product"))),
                (select_pais = $('#pais_id').select2()),
                (select_empaque = $('#empaque_id').select2()),
                (select_tefs = $('#tefs_id').select2()),
                (select_presentacion = $('#presentacion_id').select2()),
                (select_consolidado = $('#consolidado_id').select2()),
                (select_destinatario = $('#destinatario_id').select2()),
                (select_variedad = $('#variedad_id').select2()),
                (select_marca = $('#select_marca').select2()),
                (select_maquiladores = $('#select_maquiladores').select2()),
                (select_puerto = $('#puerto_id').select2()),
                (select_puerto2 = document.querySelector("#puerto_id")),
                (edit_text_marca = document.querySelector("#edit_marcas")),
                (edit_text_products = document.querySelector("#edit_products")),
                (check_active = document.querySelector("#check_activo")),
                (check_import = document.querySelector("#check_import")),
                (edit_active = document.querySelector("#consolidado")),
                (btn_add_marca = document.querySelector("#btn_add_marca")),
                (btn_add_maquilador = document.querySelector("#btn_add_maquilador")),
                (btn_add_products = document.querySelector("#btn_add_products")),
                (btn_add_product = document.querySelector("#btn_add_product")),
                (stepper_embarques = document.querySelector("#stepper_embarques")),
                (form_embarques = stepper_embarques.querySelector("#form_embarques")),
                (form_products = document.querySelector("#kt_modal_add_product_form")),
                (btn_modal = document.querySelector("#kt_modal_add_product_close")),
                (btn_modal_c = document.querySelector("#cancel_modal")),
                (btn_submit = stepper_embarques.querySelector('[data-kt-stepper-action="submit"]')),
                (s = stepper_embarques.querySelector('[data-kt-stepper-action="next"]')),
                (r = new KTStepper(stepper_embarques)).on("kt.stepper.changed", function (e) {
                    5 === r.getCurrentStepIndex()
                        ? (btn_submit.classList.remove("d-none"),
                            btn_submit.classList.add("d-inline-block"),
                            s.classList.add("d-none"))
                        : 6 === r.getCurrentStepIndex()
                            ? (btn_submit.classList.add("d-none"), s.classList.add("d-none"))
                            : (btn_submit.classList.remove("d-inline-block"),
                                btn_submit.classList.remove("d-none"),
                                s.classList.remove("d-none"))
                }),
                r.on("kt.stepper.next", function (e) {
                    var t = arr_validations[e.getCurrentStepIndex() - 1]
                    t ? t.validate().then(function (t) {
                        if ("Valid" == t) {
                            e.goNext();
                            KTUtil.scrollTop();
                        } else {
                            let errorMessage = "Error, verifique los datos por favor";
                            if (e.getCurrentStepIndex() === 2) {
                                errorMessage = "Error, ingrese al menos una marca";
                            } else if (e.getCurrentStepIndex() === 3) {
                                errorMessage = "Error, ingrese al menos un producto";
                            }
                            Swal.fire({
                                text: errorMessage,
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "Entendido!",
                                customClass: { confirmButton: "btn btn-primary" },
                            }).then(function () {
                                KTUtil.scrollTop();
                            });
                        }
                        })
                        : (e.goNext(), KTUtil.scrollTop())
                }),
                r.on("kt.stepper.previous", function (e) {
                    console.log("stepper.previous"), e.goPrevious(), KTUtil.scrollTop()
                }),
                // CHECK ACTIVE
                 check_active.addEventListener("click", function (t) {
                    Operation.checked(edit_active, check_active)
                }),
                // CHECK IMPORT
                 check_import.addEventListener("click", function (t) {
                    if (check_import.checked) {
                        Swal.fire({
                            title: "Advertencia!",
                            text: "Para poder importar un archivo primero necesitas generar el embarque!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#1F4529",
                            confirmButtonText: "Entendido!",
                            cancelButtonText: "Cancelar"
                          }).then((result) => {
                            if (result.isConfirmed) {
                                edit_text_products.value = 1
                            }
                            else{
                                check_import.checked = false
                                edit_text_products.value = ''
                            }
                          })
                    } else {
                        edit_text_products.value = ''
                    }
                }),
                 // TABLE PERMISSIONS
                (table_marcas = $("#kt_marcas_table").DataTable({
                    order: [[1, "asc"]],
                    columnDefs: [
                        { orderable: !1, targets: 0, visible:0 },
                    ],
                    language: {
                        zeroRecords: "<div class='container-fluid '> <div class='d-flex flex-center'>" +
                        "<span>No hay datos que mostrar</span></div></div>",
                        info: "Mostrando página _PAGE_ de _PAGES_",
                        infoEmpty: "<div class='container-fluid'>No hay Información</div>",
                        infoFiltered: "(Filtrando _MAX_ registros)",
                        processing:
                            "<span class='fa-stack fa-lg'>\n\
                            <i class='fa fa-spinner fa-spin fa-stack-2x fa-fw'></i>\n\
                        </span>&emsp;Processing Message here...",
                    },
                }).on("draw", function(){
                    delete_permission(table_marcas, 1);
                })),
                 // TABLE MAQUILADORES
                (table_maquilador = $("#kt_maquiladores_table").DataTable({
                    order: [[1, "asc"]],
                    columnDefs: [
                        { orderable: !1, targets: 0, visible:0 },
                    ],
                    language: {
                        zeroRecords: "<div class='container-fluid '> <div class='d-flex flex-center'>" +
                        "<span>No hay datos que mostrar</span></div></div>",
                        info: "Mostrando página _PAGE_ de _PAGES_",
                        infoEmpty: "<div class='container-fluid'>No hay Información</div>",
                        infoFiltered: "(Filtrando _MAX_ registros)",
                        processing:
                            "<span class='fa-stack fa-lg'>\n\
                            <i class='fa fa-spinner fa-spin fa-stack-2x fa-fw'></i>\n\
                        </span>&emsp;Processing Message here...",
                    },
                }).on("draw", function(){
                    delete_permission(table_maquilador, 0);
                })),
                 // TABLE PRODUCTS
                (table_products = $("#kt_products_table").DataTable({
                    order: [[1, "asc"]],
                    columnDefs: [
                        { orderable: !1, targets: 0 },
                        { orderable: !1, targets: 8, visible : 0 },
                        { orderable: !1, targets: 10, visible : 0 },
                        { orderable: !1, targets: 12, visible : 0 },
                    ],
                    language: {
                        zeroRecords: "<div class='container-fluid '> <div class='d-flex flex-center'>" +
                        "<span>No hay datos que mostrar</span></div></div>",
                        info: "Mostrando página _PAGE_ de _PAGES_",
                        infoEmpty: "<div class='container-fluid'>No hay Información</div>",
                        infoFiltered: "(Filtrando _MAX_ registros)",
                        processing:
                            "<span class='fa-stack fa-lg'>\n\
                            <i class='fa fa-spinner fa-spin fa-stack-2x fa-fw'></i>\n\
                        </span>&emsp;Processing Message here...",
                    },
                }).on("draw", function(){
                    delete_permission(table_maquilador, 0);
                })),
                arr_validations.push(
                    FormValidation.formValidation(form_embarques, {
                        fields: {
                            fecha_embarque: {
                                validators: {
                                    notEmpty: { message: "Ingrese una fecha" },
                                    format: {
                                        pattern: "YYYY-MM-DD",
                                        message: "La fecha no es válida",
                                    }
                                },
                            },
                            pais_id: {
                                validators: {
                                    notEmpty: { message: "Seleccione un país" },
                                },
                            },
                            variedad_id: {
                                validators: {
                                    notEmpty: { message: "Seleccione una variedad" },
                                },
                            },
                            empaque_id: {
                                validators: {
                                    notEmpty: { message: "Seleccione un empaque" },
                                },
                            },
                            destinatario_id: {
                                validators: {
                                    notEmpty: { message: "Seleccione un destinatario" },
                                },
                            },
                            tefs_id: {
                                validators: {
                                    notEmpty: { message: "Seleccione un usuario" },
                                },
                            },
                            puerto_id: {
                                validators: {
                                    notEmpty: { message: "Seleccione un usuario" },
                                },
                            },
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: ".fv-row",
                            }),
                            icon: new FormValidation.plugins.Icon({
                                valid: 'fa fa-check',
                                invalid: 'fa fa-times',
                                validating: 'fa fa-refresh',
                            }),
                        },
                    })
                ),
                arr_validations.push(
                    FormValidation.formValidation(form_embarques, {
                        fields: {
                            edit_marcas: {
                                validators: {
                                    notEmpty: { message: "La marca es obligatorìa" },
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
                    })
                ),
                arr_validations.push(
                    FormValidation.formValidation(form_embarques, {
                        fields: {
                            edit_products: {
                                validators: {
                                    notEmpty: { message: "La marca es obligatorìa" },
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
                    })
                ),
                btn_submit.addEventListener("click", function (e) {
                    e.preventDefault
                    arr_validations[0].validate().then(function (t) {
                        const formData = new FormData(document.querySelector(`#form_embarques`));
                        const marcasArray = table_marcas.column(0).data().toArray()
                        const maquiladoresArray = table_marcas.column(0).data().toArray()
                        const productosArray = table_products.data().toArray();
                        formData.append('marcas', JSON.stringify(marcasArray))
                        formData.append('maquiladores', JSON.stringify(maquiladoresArray))
                        formData.append('productos', JSON.stringify(productosArray))
                        // const dropzoneFiles = myDropzone.getAcceptedFiles();
                        // if (dropzoneFiles.length > 0) {
                        //     formData.append('file_import', dropzoneFiles[0], dropzoneFiles[0].name)
                        // }
                        arr_validations[0].enableValidator('puerto_id')
                        arr_validations[0].enableValidator('destinatario_id')
                        "Valid" == t
                            ? (
                                e.preventDefault(),
                                (btn_submit.disabled = !0),
                                btn_submit.setAttribute("data-kt-indicator", "on"),
                                setTimeout(function () {
                                    btn_submit.removeAttribute("data-kt-indicator"),
                                        (btn_submit.disabled = !1),
                                        // save data
                                        save_embarque(formData, token, btn_submit, form_embarques )
                                        r.goNext()
                                }, 2e3))
                            : Swal.fire({
                                text: "Ya se enviaron los datos recarga la página por favor.",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "Entendido!",
                                customClass: { confirmButton: "btn btn-light" },
                            }).then(function () {
                                KTUtil.scrollTop()
                            })
                    })
                }),
                select_tefs.on('change', function() {
                    arr_validations[0].revalidateField('tefs_id')
                })
                 // CHANGE PAIS
                select_pais.on('change', function() {
                    // const select_estado2 = $('#estado_id').select2()
                    arr_validations[0].revalidateField('pais_id')
                    arr_validations[0].disableValidator('puerto_id')
                    Operation.get_next_selects("puertos", select_pais.val(), select_puerto)
                })
                 // CHANGE EMPAQUE
                select_empaque.on('change', function() {
                    arr_validations[0].revalidateField('empaque_id')
                    arr_validations[0].disableValidator('destinatario_id')
                    // const select_estado2 = $('#estado_id').select2()
                    Operation.get_next_selects("destinatarios", select_empaque.val(), select_destinatario)
                    Operation.get_next_selects("marcas", select_empaque.val(), select_marca)
                    Operation.get_next_selects("maquiladores", select_empaque.val(), select_maquiladores)
                    Operation.get_next_selects("maquiladores", select_empaque.val(), select_consolidado)
                })
                // SELECT VARIEDADES
                select_variedad.on('change', function() {
                    arr_validations[0].revalidateField('variedad_id')
                    if(select_pais.val() == "" || select_pais.val() == null){
                        Swal.fire({
                            title: "Advertencia!",
                            text: "Seleccione un país!",
                            icon: "warning"
                          });
                    }
                    else{
                        Operation.validate_plantilla(`validate_plantilla/${select_pais.val()}/${select_variedad.val()}`, 'GET',
                            select_pais.find('option:selected').text(), select_variedad.find('option:selected').text())
                        Operation.get_next_selects("presentaciones", select_variedad.val(), select_presentacion, true)
                    }
                })
                // CLOSE MODAL
                btn_modal_c.addEventListener("click", function (t) {
                    t.preventDefault(), modal.hide()
                })
                 // CLOSE MODAL
                btn_modal.addEventListener("click", function (t) {
                    t.preventDefault(), modal.hide()
                })
                 // ADD PERMISSION TO DATATABLE
                btn_add_marca.addEventListener("click", function (t) {
                    t.preventDefault();
                    add_fields(table_marcas, select_marca)
                })
                 // ADD PERMISSION TO DATATABLE
                btn_add_maquilador.addEventListener("click", function (t) {
                    t.preventDefault();
                    add_fields(table_maquilador, select_maquiladores)
                })
                // ADD Products
                btn_add_products.addEventListener("click", function (t) {
                    t.preventDefault();
                    modal.show()
                })
                 // ADD Product
                btn_add_product.addEventListener("click", function (t) {
                    t.preventDefault();
                    Operation.add_products(table_products, btn_add_product,form_products, 0, edit_text_products)
                })
                $("#fecha_embarque").daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: parseInt(moment().format("YYYY"),10),
                    maxYear: parseInt(moment().format("YYYY"),10),
                    locale: {
                        format: 'YYYY-MM-DD',
                        applyLabel: 'Aceptar',
                        cancelLabel: 'Cancelar'
                    },
                    parentEl: '#kt_modal_add_complaint',
                    // drops: 'up'
                })
                $('#kt_products_table tbody').on('click', '.delete_product', function() {
                    var row = $(this).closest('tr')
                    table_products.row(row).remove().draw()
                });
        },
    }
})()
KTUtil.onDOMContentLoaded(function () {
    KTCreateAccount.init()
})

export function init() {
}

document.addEventListener("DOMContentLoaded", () => {
    init();
});
