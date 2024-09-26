"use strict"
import Operation from "./general.js"

var KTCreateAccount = (function () {
    var e,
        stepper_embarques,
        form_embarques,
        o,
        s,
        r,
        select_empaque,
        select_destinatario,
        select_pais,
        select_puerto,
        select_puerto2,
        arr_validations = []
    return {
        init: function () {
            // (e = document.querySelector("#kt_modal_create_account")) &&
            //     new bootstrap.Modal(e),
                (select_pais = $('#pais_id').select2()),
                (select_empaque = $('#empaque_id').select2()),
                (select_destinatario = $('#destinatario_id').select2()),
                (select_puerto = $('#puerto_id').select2()),
                (select_puerto2 = document.querySelector("#puerto_id")),
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
                // arr_validations.push(
                //     FormValidation.formValidation(form_embarques, {
                //         fields: {
                //             fecha_embarque: {
                //                 validators: {
                //                     notEmpty: { message: "La fecha es obligatoria" },
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
