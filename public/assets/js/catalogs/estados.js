"use strict";
var KTestadoesList = (function () {
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
        edit_active,
        check_active,
        select_pais,
        n,
        loader,
        edit = () => {
            n.querySelectorAll(
                '[data-kt-estado-table-filter="edit"]'
            ).forEach((e) => {
                e.addEventListener("click", function (e) {
                    e.preventDefault();
                    $.get("estados/"+ $(this).data("id") + "/edit", function(data){
                        edit_id.value=data.estado.id;
                        edit_nombre.value=data.estado.nombre;
                        edit_nombre_corto.value=data.estado.nombre_corto;
                        edit_codigo.value=data.estado.codigo;
                        if(data.estado.activo){
                            check_active.checked = true
                            edit_active.value = 1
                        }
                        else{
                            check_active.checked = false
                            edit_active.value = 0
                        }
                        $("#pais_id").val(data.estado.pais_id).trigger("change.select2");
                        modal.show();
                    })
                });
            });
        },
        delete_items = () => {
            const e = n.querySelectorAll('[type="checkbox"]'),
                o = document.querySelector(
                    '[data-kt-estado-table-select="delete_selected"]'
                );
            e.forEach((t) => {
                t.addEventListener("click", function () {
                    setTimeout(function () {
                        uncheck();
                    }, 50);
                });
            }),
            o.addEventListener("click", function () {
                let arr_items_deleted=[];
                e.forEach((e) => {
                    e.checked && arr_items_deleted.push($(e).data("id"));
                });
                Swal.fire({
                    text: "Estas seguro de eliminar los registros seleccionados?",
                    icon: "warning",
                    showCancelButton: !0,
                    buttonsStyling: !1,
                    confirmButtonText: "Si, eliminar!",
                    cancelButtonText: "No, cancelar",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary",
                    },
                }).then(function (o) {
                    o.value
                    ?
                    $.ajax({
                        url: "destroy_estados",
                        type: "POST",
                        dataType:"json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            ids:arr_items_deleted
                        },
                        success: function (result) {
                            Swal.fire({
                                text: "Datos eliminados correctamente!",
                                icon: "success",
                                buttonsStyling: !1,
                                confirmButtonText:"Entendido!",
                                customClass: {
                                    confirmButton:"btn btn-primary",
                                },
                            }).then(function (e) {
                                e.isConfirmed && table_items.ajax.reload();
                            });
                        },
                        beforeSend(){
                            Swal.fire({
                                title: "<strong>Cargando</strong>",
                                html: `<div class="progress container-fluid"></div>`,
                                showConfirmButton: false,
                            });
                        },
                        error(data){
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: "Ocurrio un error en la base de datos!",
                            });
                                console.log(data);
                        }
                    })

                    : "cancel" === o.dismiss &&
                        Swal.fire({
                            text: "Los registros no se eliminaron.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Entendido!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            },
                        });
                });
            });
        };
        const uncheck = () => {
            const t = document.querySelector(
                    '[data-kt-estado-table-toolbar="base"]'
                ),
                e = document.querySelector(
                    '[data-kt-estado-table-toolbar="selected"]'
                ),
                o = document.querySelector(
                    '[data-kt-estado-table-select="selected_count"]'
                ),
                c = n.querySelectorAll('tbody [type="checkbox"]');
            let r = !1,
                l = 0;
            c.forEach((t) => {
                t.checked && ((r = !0), l++);
            }),
                r ? ((o.innerHTML = l),
                    t.classList.add("d-none"),
                    e.classList.remove("d-none"))
                    : (t.classList.remove("d-none"), e.classList.add("d-none"));
        };
        return {
            init: function () {
                (modal = new bootstrap.Modal(
                    document.querySelector("#kt_modal_add_estado")
                )),
                // inicialize elements html
                (btn_add = document.querySelector("#btn_add")),
                (loader = document.querySelector("#loader")),
                (select_pais = document.querySelector("#select_pais")),
                (form = document.querySelector("#kt_modal_add_estado_form")),
                (btn_modal = form.querySelector("#kt_modal_add_estado_close")),
                (btn_submit = form.querySelector("#kt_modal_add_estado_submit")),
                (btn_cancel = form.querySelector("#kt_modal_add_estado_cancel")),
                (edit_id = form.querySelector("#id_estado")),
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
                (n = document.querySelector("#kt_estados_table")) &&
                    (n.querySelectorAll("tbody tr").forEach((t) => {
                        // formats
                        }),
                        (table_items = $(n).DataTable({
                            ajax: "estados",
                            serverSide: true,
                            processing: true,
                            columns: [
                                { data: "check", name: "check" },
                                { data: "id", name: "id" },
                                { data: "nombre", name: "nombre" },
                                { data: "nombre_corto", name: "nombre_corto" },
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
                                    `<div id="loader">
                                    <span class='fa-stack fa-lg'>
                                        <i class='fa fa-spinner fa-spin fa-stack-2x fa-fw'></i>
                                    </span>&emsp;Loading...
                                </div>`
                            },
                        })).on("draw", function () {
                            delete_items(), edit(), uncheck();
                        }),
                        delete_items(),
                        edit(),
                        document.querySelector('[data-kt-estado-table-filter="search"]').addEventListener("keyup", function (e) {
                            table_items.search(e.target.value).draw();
                        })
                    );
                // CHECK ACTIVE
                check_active.addEventListener("click", function (t) {
                    if(check_active.checked) {
                        edit_active.value=1
                    }
                    else{
                        edit_active.value=0
                    }
                });
                // BUTTON ADD
                btn_add.addEventListener("click", function (t) {
                    t.preventDefault()
                    form.reset()
                    $("#pais_id").val(null).trigger("change.select2");
                    modal.show()
                });
                // CLOSE MODAL
                btn_modal.addEventListener("click", function (t) {
                    t.preventDefault(), modal.hide();
                });
                // CLOSE MODAL
                btn_cancel.addEventListener("click", function (t) {
                    t.preventDefault(), modal.hide();
                });
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
                                        url: "estados",
                                        type: "POST",
                                        dataType:"json",
                                        encode: "true",
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        data: $("#kt_modal_add_estado_form").serialize(),
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
                                                        !1), table_items.ajax.reload(), form.reset());
                                            });
                                        },
                                        beforeSend(){
                                            Swal.fire({
                                                title: "<strong>Cargando</strong>",
                                                html: `<div class="progress container-fluid"></div>`,
                                                showConfirmButton: false,
                                                });
                                        },
                                        error(data){
                                            Swal.fire({
                                                icon: "error",
                                                title: "Error",
                                                text: "Ocurrio un error en la base de datos!",
                                            });
                                            console.log(data);
                                            btn_submit.disabled = !1
                                        }
                                    });

                                }, 1000))
                            : Swal.fire({
                                    text: "Error, faltan algunos datos, intente de nuevo por favor.",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Entendido!",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    },
                                });
                    });
                });
            },
        };
})();
KTUtil.onDOMContentLoaded(function () {
    KTestadoesList.init();
});
