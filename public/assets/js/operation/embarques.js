"use strict"
import Operation from "./general.js"

var KTCreateAccount = (function () {
    var e,
        btn_add_marca,
        btn_add_maquilador,
        count_marcas = 0,
        edit_text_marca,
        table_marcas,
        table_maquilador,
        stepper_embarques,
        form_embarques,
        o,
        s,
        r,
        select_empaque,
        select_destinatario,
        select_marca,
        select_maquiladores,
        select_pais,
        select_puerto,
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
            console.log("le di click")
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
        }
    return {
        init: function () {
                (select_pais = $('#pais_id').select2()),
                (select_empaque = $('#empaque_id').select2()),
                (select_destinatario = $('#destinatario_id').select2()),
                (select_marca = $('#select_marca').select2()),
                (select_maquiladores = $('#select_maquiladores').select2()),
                (select_puerto = $('#puerto_id').select2()),
                (select_puerto2 = document.querySelector("#puerto_id")),
                (edit_text_marca = document.querySelector("#edit_marcas")),
                (btn_add_marca = document.querySelector("#btn_add_marca")),
                (btn_add_maquilador = document.querySelector("#btn_add_maquilador")),
                (stepper_embarques = document.querySelector("#stepper_embarques")),
                (form_embarques = stepper_embarques.querySelector("#form_embarques")),
                (o = stepper_embarques.querySelector('[data-kt-stepper-action="submit"]')),
                (s = stepper_embarques.querySelector('[data-kt-stepper-action="next"]')),
                (r = new KTStepper(stepper_embarques)).on("kt.stepper.changed", function (e) {
                    4 === r.getCurrentStepIndex()
                        ? (o.classList.remove("d-none"),
                            o.classList.add("d-inline-block"),
                            s.classList.add("d-none"))
                        : 5 === r.getCurrentStepIndex()
                            ? (o.classList.add("d-none"), s.classList.add("d-none"))
                            : (o.classList.remove("d-inline-block"),
                                o.classList.remove("d-none"),
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
                                    notEmpty: { message: "La fecha es obligatoria" },
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
                // arr_validations.push(
                //     FormValidation.formValidation(form_embarques, {
                //         fields: {
                //             account_team_size: {
                //                 validators: { notEmpty: { message: "Time size is required" } },
                //             },
                //             account_name: {
                //                 validators: {
                //                     notEmpty: { message: "Account name is required" },
                //                 },
                //             },
                //             account_plan: {
                //                 validators: {
                //                     notEmpty: { message: "Account plan is required" },
                //                 },
                //             },
                //         },
                //         plugins: {
                //             trigger: new FormValidation.plugins.Trigger(),
                //             bootstrap: new FormValidation.plugins.Bootstrap5({
                //                 rowSelector: ".fv-row",
                //                 eleInvalidClass: "",
                //                 eleValidClass: "",
                //             }),
                //         },
                //     })
                // ),
                // arr_validations.push(
                //     FormValidation.formValidation(form_embarques, {
                //         fields: {
                //             business_name: {
                //                 validators: {
                //                     notEmpty: { message: "Busines name is required" },
                //                 },
                //             },
                //             business_descriptor: {
                //                 validators: {
                //                     notEmpty: { message: "Busines descriptor is required" },
                //                 },
                //             },
                //             business_type: {
                //                 validators: {
                //                     notEmpty: { message: "Busines type is required" },
                //                 },
                //             },
                //             business_description: {
                //                 validators: {
                //                     notEmpty: { message: "Busines description is required" },
                //                 },
                //             },
                //             business_email: {
                //                 validators: {
                //                     notEmpty: { message: "Busines email is required" },
                //                     emailAddress: {
                //                         message: "The value is not a valid email address",
                //                     },
                //                 },
                //             },
                //         },
                //         plugins: {
                //             trigger: new FormValidation.plugins.Trigger(),
                //             bootstrap: new FormValidation.plugins.Bootstrap5({
                //                 rowSelector: ".fv-row",
                //                 eleInvalidClass: "",
                //                 eleValidClass: "",
                //             }),
                //         },
                //     })
                // ),
                // arr_validations.push(
                //     FormValidation.formValidation(form_embarques, {
                //         fields: {
                //             card_name: {
                //                 validators: {
                //                     notEmpty: { message: "Name on card is required" },
                //                 },
                //             },
                //             card_number: {
                //                 validators: {
                //                     notEmpty: { message: "Card member is required" },
                //                     creditCard: { message: "Card number is not valid" },
                //                 },
                //             },
                //             card_expiry_month: {
                //                 validators: { notEmpty: { message: "Month is required" } },
                //             },
                //             card_expiry_year: {
                //                 validators: { notEmpty: { message: "Year is required" } },
                //             },
                //             card_cvv: {
                //                 validators: {
                //                     notEmpty: { message: "CVV is required" },
                //                     digits: { message: "CVV must contain only digits" },
                //                     stringLength: {
                //                         min: 3,
                //                         max: 4,
                //                         message: "CVV must contain 3 to 4 digits only",
                //                     },
                //                 },
                //             },
                //         },
                //         plugins: {
                //             trigger: new FormValidation.plugins.Trigger(),
                //             bootstrap: new FormValidation.plugins.Bootstrap5({
                //                 rowSelector: ".fv-row",
                //                 eleInvalidClass: "",
                //                 eleValidClass: "",
                //             }),
                //         },
                //     })
                // ),
                o.addEventListener("click", function (e) {
                    arr_validations[0].validate().then(function (t) {
                        console.log("validated!"),
                            "Valid" == t
                                ? (e.preventDefault(),
                                    (o.disabled = !0),
                                    o.setAttribute("data-kt-indicator", "on"),
                                    setTimeout(function () {
                                        o.removeAttribute("data-kt-indicator"),
                                            (o.disabled = !1),
                                            r.goNext()
                                    }, 2e3))
                                : Swal.fire({
                                    text: "Sorry sdffdssdf, looks like there are some errors detected, please try again.",
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
                // $(i.querySelector('[name="card_expiry_month"]')).on(
                //     "change",
                //     function () {
                //         arr_validations[3].revalidateField("card_expiry_month")
                //     }
                // ),
                // $(i.querySelector('[name="card_expiry_year"]')).on(
                //     "change",
                //     function () {
                //         arr_validations[3].revalidateField("card_expiry_year")
                //     }
                // ),
                // $(i.querySelector('[name="business_type"]')).on("change", function () {
                //     arr_validations[2].revalidateField("business_type")
                // })
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
                }
            )
        },
    }
})()
KTUtil.onDOMContentLoaded(function () {
    KTCreateAccount.init()
})
