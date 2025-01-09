"use strict"
import Operation from "./general.js"

var KTadminlist = (function () {
    const token = $('meta[name="csrf-token"]').attr('content')
    let blockUI, target
    let embarque_id = 0
    var table_items,
        edit_folio,
        btn_search,
        btn_products,
        btn_standards,
        btn_add_product,
        btn_add_standard,
        btn_save_standards,
        btn_save,
        btn_finish,
        btn_import,
        form_products,
        form_rpv,
        span_fecha_embarque,
        span_hora_embarque,
        select_standard,
        dates,
        filter,
        modal,
        modal_standards,
        modal_upload,
        modal_import,
        // select_presentacion,
        table_products,
        table_standards,
        n,
        save_embarque = (formulario, embarque_id) => {
            const clase = "p_input"
            const inputs = formulario.querySelectorAll(`input.${clase}`)
            let datosFormulario = {}
            datosFormulario = {
                embarque_id: embarque_id,
                folio_embarque: edit_folio.value
            }
            Array.from(inputs).forEach(input => {
                switch(input.type) {
                    case 'checkbox':
                        datosFormulario[input.id] = input.checked
                        break
                    case 'radio':
                        if(input.checked) {
                            datosFormulario[input.name] = input.value
                        }
                        break
                    case 'select-multiple':
                        datosFormulario[input.id] = Array.from(input.selectedOptions).map(option => option.value)
                        break
                    default:
                        datosFormulario[input.id] = input.value
                }
            })
            fetch(`save_embarque_rpv`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify(datosFormulario)
            })
            .then(
                async response => {
                    return response.json();
                }
            )
            .then(data => {
                Swal.fire({
                    text: "Datos guardados exitosamente!",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Entendido!",
                    customClass: {
                        confirmButton: "btn btn-primary",
                    },
                }).then(({ isConfirmed }) => {
                    if (isConfirmed) {
                        location.reload()
                    }
                })
            })
            .catch((error) => {
                console.error('Error:', error)
            })
            Swal.fire({
                title: "<strong>Cargando</strong>",
                html: `<div class="progress container-fluid"></div>`,
                showConfirmButton: false,
            })
        },
        finish_embarque = (formulario, embarque_id) => {
            const clase = "p_input"
            const inputs = formulario.querySelectorAll(`input.${clase}`)
            let datosFormulario = {}
            datosFormulario = {
                embarque_id: embarque_id,
                folio_embarque: edit_folio.value
            }
            Array.from(inputs).forEach(input => {
                switch(input.type) {
                    case 'checkbox':
                        datosFormulario[input.id] = input.checked
                        break
                    case 'radio':
                        if(input.checked) {
                            datosFormulario[input.name] = input.value
                        }
                        break
                    case 'select-multiple':
                        datosFormulario[input.id] = Array.from(input.selectedOptions).map(option => option.value)
                        break
                    default:
                        datosFormulario[input.id] = input.value
                }
            })
            fetch(`finish_embarque_rpv`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify(datosFormulario)
            })
            .then(async response => {
                const data = await response.json();
                if (!response.ok) {
                    throw data;
                }
                return data;
            })
            .then(data => {
                Swal.fire({
                    text: "Datos guardados y embarque terminado exitosamente!",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Entendido!",
                    customClass: {
                        confirmButton: "btn btn-primary",
                    },
                }).then(({ isConfirmed }) => {
                    if (isConfirmed) {
                        location.reload();
                    }
                });
            })
            .catch(error => {
                Swal.fire({
                    text: error.error || "Ocurrió un error inesperado.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Entendido!",
                    customClass: {
                        confirmButton: "btn btn-primary",
                    },
                });
            });

            // Mensaje de carga mientras se procesa la solicitud
            Swal.fire({
                title: "<strong>Cargando</strong>",
                html: `<div class="progress container-fluid"></div>`,
                showConfirmButton: false,
            });
        },
        edit = () => {
            n.querySelectorAll(
                '[data-kt-admin-table-filter="edit"]'
            ).forEach((e) => {
                e.addEventListener("click", function (e) {
                    e.preventDefault()
                    fetch(`get_embarque_edit/${$(this).data("id")}`, {
                        method: "GET",
                        headers:{
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response =>{
                        if(!response.ok){
                            throw new Error('Error en la base de datos')
                        }
                        return response.json()
                    })
                    .then(data => {
                        console.log(data)
                        const {plantilla, embarque } = data
                        delete plantilla.id
                        delete plantilla.created_at
                        delete plantilla.deleted_at
                        delete plantilla.updated_at
                        span_fecha_embarque.innerText  = (embarque.fecha_embarque).substring(0,10)
                        span_hora_embarque.innerText  = (embarque.fecha_embarque).substring(11)
                        edit_folio.value  = embarque.folio_embarque
                        edit_folio.disabled = false
                        for (const [key, value] of Object.entries(plantilla)) {
                            const elementos = document.getElementsByName(key);
                            if (elementos.length > 0) {
                                if (elementos[0].type === 'radio') {
                                elementos.forEach(radio => {
                                    radio.checked = radio.value == value;
                                });
                                } else if (elementos[0].type === 'checkbox') {
                                elementos[0].checked = Boolean(value);
                                } else {
                                    elementos[0].value = value;
                                }
                            }
                        }
                        for (const [key, value] of Object.entries(embarque)) {
                            const embarques_data = document.getElementsByName(key);
                            if (embarques_data.length > 0) {
                                if (embarques_data[0].tagName.toLowerCase() === 'span') {
                                    embarques_data[0].innerText = value;
                                } else {
                                    embarques_data[0].value = value;
                                }
                            }
                        }
                        // Operation.get_next_selects("presentaciones", embarque.variedad_id, select_presentacion, true)
                        document.getElementById('btn_products').setAttribute('data-embarque', embarque.id);
                        document.getElementById('btn_standards').setAttribute('data-embarque', embarque.id);
                        document.querySelector('#kt_accordion_1_header_2 button').classList.remove('collapsed');
                        document.querySelector('#kt_accordion_1_body_2').classList.add('show');
                        document.querySelectorAll('.accordion-collapse').forEach((accordion) => {
                            if (accordion !== document.querySelector('#kt_accordion_1_body_2')) {
                                accordion.classList.remove('show');
                            }
                        });
                        embarque_id = embarque.id
                        btn_save.classList.remove("d-none")
                        btn_finish.classList.remove("d-none")
                        blockUI.release()
                    })
                    .catch(error => {
                        console.error(error)
                    })

                })
            })
        },
        upload = () => {
            n.querySelectorAll(
                '[data-kt-admin-table-filter="upload"]'
            ).forEach((e) => {
                e.addEventListener("click", function (e) {
                    e.preventDefault()
                    modal_upload.show()

                })
            })
        }
        print = () => {
            n.querySelectorAll(
                '[data-kt-admin-table-filter="print"]'
            ).forEach((e) => {
                e.addEventListener("click", function (e) {
                    e.preventDefault()
                    Swal.fire("Esta en mantenimiento")

                })
            })
        }
        return {
            init: function () {
                (target = document.querySelector("#kt_block_ui_1_target")),
                (blockUI = new KTBlockUI(target, {
                    overlayClass: "bg-success bg-opacity-15",
                    message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Bloqueado seleccione un embarque...</div>'
                })),
                (modal = new bootstrap.Modal(document.querySelector("#kt_modal_add_product"))),
                (modal_standards = new bootstrap.Modal(document.querySelector("#kt_modal_edit_standards"))),
                (modal_upload = new bootstrap.Modal(document.querySelector("#kt_modal_upload"))),
                (modal_import = new bootstrap.Modal(document.querySelector("#kt_modal_import"))),
                (span_fecha_embarque = document.querySelector('#fecha_embarque')),
                (span_hora_embarque = document.querySelector('#hora_embarque')),
                // (select_presentacion = $('#presentacion_id').select2()),
                (form_products = document.querySelector("#kt_modal_add_product_form")),
                (form_rpv = document.querySelector("#form_rpv")),
                (dates = document.querySelector('#dates')),
                (filter = document.querySelector('#dates_filter')),
                (edit_folio = document.querySelector('#FolioRPV')),
                (btn_search = document.querySelector('#btn_search')),
                (btn_products = document.getElementById('btn_products')),
                (btn_standards = document.getElementById('btn_standards')),
                (btn_add_product = document.querySelector("#btn_add_product")),
                (btn_add_standard = document.querySelector("#btn_add_standard")),
                (btn_save_standards = document.querySelector("#btn_save_standards")),
                (btn_save = document.querySelector("#btn_save")),
                (btn_finish = document.querySelector("#btn_finish")),
                (btn_import = document.querySelector("#btn_import")),
                (select_standard = $('#select_standard').select2()),
                (n = document.querySelector("#kt_admin_table")) &&
                (n.querySelectorAll("tbody tr").forEach((t) => {
                    // formats
                    }),
                    (table_items = $(n).DataTable({
                        ajax: {
                            url:"embarques_admin",
                            data: {
                                dates: function() {return dates.value},
                                filter : function() {return filter.value}
                            }
                        },
                        serverSide: true,
                        processing: true,
                        dom: 'Bfrtip',
                        buttons: [
                            {
                                extend: 'excelHtml5',
                                title: 'Cost Balers Data',
                            }
                        ],
                        columns: [
                            { data: "id", name: "id" },
                            { data: "folio_embarque", name: "folio_embarque" },
                            { data: "nombre_fiscal", name: "nombre_fiscal" },
                            { data: "nombre", name: "nombre" },
                            { data: "puerto", name: "puerto" },
                            { data: "fecha_embarque", name: "fecha_embarque" },
                            { data: "buttons", name: "buttons" },

                        ],
                        language: {
                            search:"Buscar",
                            zeroRecords: "No hay datos que mostrar",
                            info: "Mostrando página _PAGE_ de _PAGES_",
                            infoEmpty: "No hay información",
                            infoFiltered: "(Filtrando _MAX_ registros)",
                            processing:
                                `<span class="loader"></span>`
                        },
                    }).on("draw", function () {
                        edit(), upload(), print()
                    })
                )
                ),
                 // TABLE PRODUCTS
                (table_products = $("#kt_products_table").DataTable({
                    order: [[1, "asc"]],
                    columnDefs: [
                        { orderable: !1, targets: 0 },
                        { orderable: !1, targets: 5, visible : 0 },
                        { orderable: !1, targets: 7, visible : 0 },
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
                })),
                 // TABLE standards
                (table_standards = $("#kt_standards_table").DataTable({
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
                })),
                btn_search.addEventListener('click', function () {
                    filter.value=1;
                    table_items.ajax.reload()
                })
                btn_products.addEventListener('click', function () {
                    // e.preventDefault()
                    fetch(`get_products_embarque/${$(this).data("embarque")}`, {
                        method: "GET",
                        headers:{
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response =>{
                        if(!response.ok){
                            throw new Error('Error en la base de datos')
                        }
                        return response.json()
                    })
                    .then(data => {
                        table_products.clear().draw();
                        data.forEach(item => {
                            table_products.row.add([`<button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1 delete_product"
                                data-kt-customer-table-filter="delete_row">
                                <span class="svg-icon svg-icon-muted svg-icon-5"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"/>
                                    <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"/>
                                    <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"/>
                                    </svg></span>
                                </button>`,
                                item.folio_pallet,
                                item.lote,
                                item.sader,
                                item.cartilla,
                                item.variedad_id,
                                item.variedad,
                                item.presentacion_id,
                                item.presentacion,
                                item.cantidad,
                                item.peso,
                                item.total_kilos,
                                item.marca_id,
                                item.marca]).draw()
                        });
                        modal.show()
                    })
                    .catch(error => {
                        console.error(error)
                    })
                })
                btn_standards.addEventListener('click', function () {
                    fetch(`get_standards_embarque/${$(this).data("embarque")}`, {
                        method: "GET",
                        headers:{
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response =>{
                        if(!response.ok){
                            throw new Error('Error en la base de datos')
                        }
                        return response.json()
                    })
                    .then(data => {
                        table_standards.clear().draw();
                        data.forEach(item => {
                            table_standards.row.add([item.id, item.name, `<button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1 delete_standard"
                                data-kt-customer-table-filter="delete_row">
                                <span class="svg-icon svg-icon-muted svg-icon-5"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"/>
                                    <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"/>
                                    <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"/>
                                    </svg></span>
                                </button>`]).draw()
                        })
                        modal_standards.show()
                    })
                    .catch(error => {
                        console.error(error)
                    })
                })
                // SAVE EMBARQUE RPV
                btn_save.addEventListener("click", function (t) {
                    t.preventDefault()
                    save_embarque(form_rpv, embarque_id)
                })
                // IMPORT
                btn_import.addEventListener("click", function (t) {
                    t.preventDefault()
                    modal_import.show()
                })
                // SAVE EMBARQUE RPV
                btn_finish.addEventListener("click", function (t) {
                    t.preventDefault()
                    finish_embarque(form_rpv, embarque_id)
                })
                // ADD Product
                btn_add_product.addEventListener("click", function (t) {
                    t.preventDefault();
                    Operation.add_products(table_products, btn_add_product, form_products, embarque_id)
                })
                // ADD standard
                btn_add_standard.addEventListener("click", function (t) {
                    t.preventDefault();
                    if(select_standard.val() != "" && select_standard.val() != null){
                        var data = table_standards.rows().data();
                        let repeat=false;
                        for (var i = 0; i < data.length; i++) {
                            if (data[i][0] == select_standard.val()) {
                                repeat=true;
                            }
                        }
                        if(repeat){
                            Swal.fire({
                                title: "Advertencia!",
                                text: select_standard.find('option:selected').text() +" ya esta agregada!",
                                icon: "warning"
                              });
                        }else{
                            table_standards.row.add([select_standard.val(), select_standard.find('option:selected').text(),  `<button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1 delete_standard">
                                <span class="svg-icon svg-icon-muted svg-icon-5"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"/>
                                    <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"/>
                                    <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"/>
                                    </svg></span>
                                </button>`]).draw();
                        }
                    }
                    else{
                        Swal.fire({
                            title: "Advertencia!",
                            text: "Seleccione una standard!",
                            icon: "warning"
                          });
                    }
                })
                 // SAVE standardS
                 btn_save_standards.addEventListener("click", function (t) {
                    t.preventDefault();
                    let standards = [];
                    table_standards.rows().data().each(function (value) {
                        standards.push({
                            standard_id: value[0],
                            standard: value[1]
                        });
                    });

                    fetch(`save_standards_embarques`, {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            "X-CSRF-TOKEN": Operation.token,
                        },
                        body: JSON.stringify({
                            embarque_id: embarque_id,
                            standards: standards
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error en la base de datos');
                        }
                        return response.json();
                    })
                    .then(data => {
                        Swal.fire({
                            title: "Éxito!",
                            text: "Las normas han sido guardadas correctamente!",
                            icon: "success"
                        });
                        modal_standards.hide();
                    })
                    .catch(error => {
                        console.error(error);
                        Swal.fire({
                            title: "Error!",
                            text: "Hubo un problema al guardar las normas!",
                            icon: "error"
                        });
                    });
                })
                $("#dates").daterangepicker({
                    locale: {
                        format: 'YYYY-MM-DD',
                        applyLabel: 'Aceptar',
                        cancelLabel: 'Cancelar'
                    },
                })
                $('#kt_products_table tbody').on('click', '.delete_product', function() {
                    var row = $(this).closest('tr')
                    table_products.row(row).remove().draw()
                    toastr.success("Eliminado correctamente")
                });
                $('#kt_standards_table tbody').on('click', '.delete_standard', function() {
                    var row = $(this).closest('tr')
                    table_standards.row(row).remove().draw()
                    toastr.success("Eliminado correctamente")
                });

                blockUI.block()
            },

        }
})()
KTUtil.onDOMContentLoaded(function () {
    KTadminlist.init()
})
