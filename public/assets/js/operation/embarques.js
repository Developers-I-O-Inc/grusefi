"use strict"
import Operation from "./general.js"

var KTCreateAccount = (function () {
    let edit_pallet,
        edit_lote,
        edit_sader,
        edit_cajas,
        edit_registros,
        edit_tipo_fruta,
        select_categoria,
        select_cultivo,
        select_calibre,
        select_presentacion,
        check_active,
        edit_active
    const token = $('meta[name="csrf-token"]').attr('content')
    var e,
        btn_modal,
        btn_modal_c,
        btn_add_marca,
        btn_add_maquilador,
        btn_add_products,
        btn_add_product,
        count_marcas = 0,
        count_products = 0,
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
        select_puerto2,
        validations_products,
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
                // Mostrar alerta de carga antes de la solicitud
                Swal.fire({
                    title: "<strong>Cargando</strong>",
                    html: `<div class="progress container-fluid"></div>`,
                    showConfirmButton: false,
                });
                console.log(table_marcas.column(0).data().toArray())
                // Realizar la solicitud fetch
                const response = await fetch('embarques', {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": token,
                    },
                    body: datos,
                });

                // Verificar si la respuesta es correcta
                if (!response.ok) {
                    throw new Error("Error en la base de datos");
                }

                // Convertir la respuesta a JSON
                const result = await response.json();
                $('#link_dictamen').attr('href', `/operation/imprimir_dictamen_embarque/${select_pais.val()}/${result.embarque_id}`)
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

                // Acción posterior a la confirmación del SweetAlert
                btnSubmit.disabled = false;
                form.reset();

            } catch (error) {
                // Manejo de errores
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: error.message,
                });
                console.error(error);
                btnSubmit.disabled = false;
            }
            // console.log(datos)
        }
    return {
        init: function () {
                (modal = new bootstrap.Modal(
                    document.querySelector("#kt_modal_add_product")
                )),
                (select_pais = $('#pais_id').select2()),
                (select_empaque = $('#empaque_id').select2()),
                (select_consolidado = $('#consolidado_id').select2()),
                (select_destinatario = $('#destinatario_id').select2()),
                (select_marca = $('#select_marca').select2()),
                (select_calibre = $('#calibre_id').select2()),
                (select_maquiladores = $('#select_maquiladores').select2()),
                (select_puerto = $('#puerto_id').select2()),
                (select_categoria = $('#categoria_id').select2()),
                (select_presentacion = $('#presentacion_id').select2()),
                (select_cultivo = $('#tipo_cultivo_id').select2()),
                (select_puerto2 = document.querySelector("#puerto_id")),
                (edit_text_marca = document.querySelector("#edit_marcas")),
                (edit_text_products = document.querySelector("#edit_products")),
                (check_active = document.querySelector("#check_activo")),
                (edit_active = document.querySelector("#consolidado")),
                (btn_add_marca = document.querySelector("#btn_add_marca")),
                (btn_add_maquilador = document.querySelector("#btn_add_maquilador")),
                (btn_add_products = document.querySelector("#btn_add_products")),
                (btn_add_product = document.querySelector("#btn_add_product")),
                (stepper_embarques = document.querySelector("#stepper_embarques")),
                (form_embarques = stepper_embarques.querySelector("#form_embarques")),
                (form_products = document.querySelector("#kt_modal_add_product_form")),
                (edit_pallet = form_products.querySelector("#pallet")),
                (edit_lote = form_products.querySelector("#lote")),
                (edit_cajas = form_products.querySelector("#cajas")),
                (edit_registros = form_products.querySelector("#registros")),
                (edit_sader = form_products.querySelector("#sader")),
                (edit_tipo_fruta = form_products.querySelector("#tipo_fruta")),
                (btn_modal = document.querySelector("#kt_modal_add_product_close")),
                (btn_modal_c = document.querySelector("#cancel_modal")),
                (validations_products = FormValidation.formValidation(form_products, {
                    fields: {
                        pallet: {
                            validators: {
                                notEmpty: {
                                    message: "Pallet requerido",
                                },
                            },
                        },
                        lote: {
                            validators: {
                                notEmpty: {
                                    message: "Lote requerido",
                                },
                            },
                        },
                        id_categoria: {
                            validators: {
                                notEmpty: {
                                    message: "Categoría requerida",
                                },
                            },
                        },
                        tipo_cultivo_id: {
                            validators: {
                                notEmpty: {
                                    message: 'Tipo de cultivo requerido'
                                }
                            }
                        },
                        sader: {
                            validators: {
                                notEmpty: {
                                    message: 'SADER requerido'
                                }
                            }
                        },
                        cajas: {
                            validators: {
                                notEmpty: {
                                    message: 'N° de cajas requerido'
                                },
                                between: {
                                    min: 1,  // El valor mínimo permitido
                                    max: 100, // Puedes ajustar el máximo si es necesario
                                    message: "Tiene que haber al menos una caja"
                                }
                            },
                        },
                        registros: {
                            validators: {
                                notEmpty: {
                                    message: 'N° de registros requerido'
                                },
                                between: {
                                    min: 1,  // El valor mínimo permitido
                                    max: 100, // Puedes ajustar el máximo si es necesario
                                    message: "El valor debe ser mayor que 0"
                                }
                            },
                        },
                        presentacion_id: {
                            validators: {
                                notEmpty: {
                                    message: 'Presentación requerida'
                                }
                            }
                        },
                        calibre_id: {
                            validators: {
                                notEmpty: {
                                    message: 'Calibre requerido'
                                }
                            }
                        },
                        tipo_fruta: {
                            validators: {
                                notEmpty: {
                                    message: 'Tipo de fruta requerido'
                                }
                            }
                        },
                        categoria_id: {
                            validators: {
                                notEmpty: {
                                    message: 'Categoría requerida'
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
                    console.log("stepper.next")
                    var t = arr_validations[e.getCurrentStepIndex() - 1]
                    t
                        ? t.validate().then(function (t) {
                            console.log("validated!"),
                                "Valid" == t
                                    ? (e.goNext(), KTUtil.scrollTop())
                                    : Swal.fire({
                                        text: "Error, verifique los datos por favor",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Entendido!",
                                        customClass: { confirmButton: "btn btn-primary" },
                                    }).then(function () {
                                        KTUtil.scrollTop()
                                    })
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
                        { orderable: !1, targets: 5, visible : 0 },
                        { orderable: !1, targets: 7, visible : 0 },
                        { orderable: !1, targets: 9, visible : 0 },
                        { orderable: !1, targets: 11, visible : 0 },
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
                            account_type: {
                                validators: {
                                    notEmpty: { message: "Ingrese una fecha" },
                                },
                            },
                            pais_id: {
                                validators: {
                                    notEmpty: { message: "Seleccione un país" },
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
                                eleInvalidClass: "",
                                eleValidClass: "",
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
                    arr_validations[0].validate().then(function (t) {
                        const formData = new FormData(document.querySelector(`#form_embarques`));
                        const marcasArray = table_marcas.column(0).data().toArray()
                        const maquiladoresArray = table_marcas.column(0).data().toArray()
                        const productosArray = table_products.data().toArray();
                        formData.append('marcas', JSON.stringify(marcasArray))
                        formData.append('maquiladores', JSON.stringify(maquiladoresArray))
                        formData.append('productos', JSON.stringify(productosArray))
                        const datos = new URLSearchParams(formData)

                        "Valid" == t
                            ? (
                                e.preventDefault(),
                                (btn_submit.disabled = !0),
                                btn_submit.setAttribute("data-kt-indicator", "on"),
                                setTimeout(function () {
                                    btn_submit.removeAttribute("data-kt-indicator"),
                                        (btn_submit.disabled = !1),
                                        // save data
                                        save_embarque(datos, token, btn_submit, form_embarques )
                                        r.goNext()
                                }, 2e3))
                            : Swal.fire({
                                text: "Ya se enviaron los datos recarga la página por favor.",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got it!",
                                customClass: { confirmButton: "btn btn-light" },
                            }).then(function () {
                                KTUtil.scrollTop()
                            })
                    })
                }),
                 // CHANGE PAIS
                select_pais.on('change', function() {
                    // const select_estado2 = $('#estado_id').select2()
                    Operation.get_next_selects("puertos", select_pais.val(), select_puerto)
                })
                 // CHANGE EMPAQUE
                select_empaque.on('change', function() {
                    // const select_estado2 = $('#estado_id').select2()
                    Operation.get_next_selects("destinatarios", select_empaque.val(), select_destinatario)
                    Operation.get_next_selects("marcas", select_empaque.val(), select_marca)
                    Operation.get_next_selects("maquiladores", select_empaque.val(), select_maquiladores)
                    Operation.get_next_selects("maquiladores", select_empaque.val(), select_consolidado)
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
                    validations_products &&
                    validations_products.validate().then(function (e) {
                        "Valid" == e
                            ? (btn_add_product.setAttribute(
                                    "data-kt-indicator",
                                    "on"
                                ),
                                setTimeout(function () {
                                    btn_add_product.removeAttribute("data-kt-indicator")
                                    console.log(select_calibre.text())
                                    console.log(select_cultivo.text())
                                    console.log(select_categoria.text())
                                    for(let i=0; i < edit_registros.value; i++){
                                        table_products.row.add([`<button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1 delete_product"
                                            data-kt-customer-table-filter="delete_row">
                                            <span class="svg-icon svg-icon-muted svg-icon-5"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"/>
                                                <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"/>
                                                <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"/>
                                                </svg></span>
                                            </button>`, edit_pallet.value, edit_lote.value, edit_sader.value, select_categoria.text(), select_categoria.val(),
                                            select_cultivo.text(), select_cultivo.val(), select_presentacion.text(), select_presentacion.val().split('|')[0],
                                            $('#calibre_id').find('option:selected').text(), select_calibre.val(), edit_cajas.value, select_presentacion.val().split('|')[1], edit_tipo_fruta.value]).draw()
                                    }
                                    count_products = count_products + 1
                                    edit_text_products.value=count_products
                                    btn_add_product.setAttribute("data-kt-indicator","off")
                                    form_products.reset()
                                    toastr.success("Agregado correctamente");
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
