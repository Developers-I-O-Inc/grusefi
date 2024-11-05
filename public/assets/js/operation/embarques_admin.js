"use strict"
import Operation from "./general.js"

var KTadminlist = (function () {
    let blockUI, target
    let embarque_id = 0
    var table_items,
        btn_search,
        btn_products,
        btn_add_product,
        form_products,
        span_fecha_embarque,
        start_date,
        end_date,
        modal,
        table_products,
        n,

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

                        const {plantilla, embarque } = data
                        delete plantilla.id
                        delete plantilla.created_at
                        delete plantilla.deleted_at
                        delete plantilla.updated_at
                        span_fecha_embarque.innerText  = embarque.fecha_embarque
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
                        document.getElementById('btn_products').setAttribute('data-embarque', embarque.id);
                        document.querySelector('#kt_accordion_1_header_2 button').classList.remove('collapsed');
                        document.querySelector('#kt_accordion_1_body_2').classList.add('show');
                        document.querySelectorAll('.accordion-collapse').forEach((accordion) => {
                            if (accordion !== document.querySelector('#kt_accordion_1_body_2')) {
                                accordion.classList.remove('show');
                            }
                        });
                        embarque_id = embarque.id
                        blockUI.release()
                    })
                    .catch(error => {
                        console.error(error)
                    })

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
                (modal = new bootstrap.Modal(
                    document.querySelector("#kt_modal_edit_products")
                )),
                (span_fecha_embarque = document.querySelector('#fecha_embarque')),
                (form_products = document.querySelector("#kt_modal_add_product_form")),
                (start_date = document.querySelector('#start_date')),
                (end_date = document.querySelector('#end_date')),
                (btn_search = document.querySelector('#btn_search')),
                (btn_products = document.getElementById('btn_products')),
                (btn_add_product = document.querySelector("#btn_add_product")),
                (n = document.querySelector("#kt_admin_table")) &&
                (n.querySelectorAll("tbody tr").forEach((t) => {
                    // formats
                    }),
                    (table_items = $(n).DataTable({
                        ajax: {
                            url:"embarques_admin",
                            data: {
                                start_date: function() { return start_date.value; },
                                end_date: function() { return end_date.value; }
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

                            { data: "empaque_id", name: "empaque_id" },
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
                        edit()
                    })
                )
                ),
                 // TABLE PERMISSIONS
                (table_products = $("#kt_products_table").DataTable({
                    order: [[1, "asc"]],
                    columnDefs: [
                        { orderable: !1, targets: 0 },
                        { orderable: !1, targets: 8, visible : 0 },
                        { orderable: !1, targets: 10, visible : 0 },
                        { orderable: !1, targets: 12, visible : 0 },
                        { orderable: !1, targets: 14, visible : 0 },
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
                }))
                btn_search.addEventListener('click', function () {
                    table_items.ajax.reload();
                })
                btn_products.addEventListener('click', function () {
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
                            // for (let i = 0; i < item.n_registros; i++) {
                                table_products.row.add([`<button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1 delete_product"
                                    data-kt-customer-table-filter="delete_row">
                                    <span class="svg-icon svg-icon-muted svg-icon-5"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"/>
                                        <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"/>
                                        <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"/>
                                        </svg></span>
                                    </button>`, item.folio_pallet, item.lote, item.cajas, item.peso, item.total_kilos, item.sader, item.categoria, item.categoria_id,
                                    item.tipo_cultivo, item.tipo_cultivo_id, item.presentacion, item.presentacion_id,
                                    item.calibre, item.calibre_id, item.tipo_fruta, item.n_registros]).draw()
                            // }
                        });
                        modal.show()
                    })
                    .catch(error => {
                        console.error(error)
                    })
                })
                // ADD Product
                btn_add_product.addEventListener("click", function (t) {
                    t.preventDefault();
                    Operation.add_products(table_products, btn_add_product, form_products, embarque_id)
                })
                $("#start_date").daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    locale: {
                        format: 'YYYY-MM-DD',
                        applyLabel: 'Aceptar',
                        cancelLabel: 'Cancelar'
                    },
                })
                $("#end_date").daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    locale: {
                        format: 'YYYY-MM-DD',
                        applyLabel: 'Aceptar',
                        cancelLabel: 'Cancelar'
                    },
                })
                $('#kt_products_table tbody').on('click', '.delete_product', function() {
                    var row = $(this).closest('tr')
                    table_products.row(row).remove().draw()
                });

                blockUI.block()
            },

        }
})()
KTUtil.onDOMContentLoaded(function () {
    KTadminlist.init()
})
