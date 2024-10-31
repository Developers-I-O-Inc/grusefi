"use strict"

var KTadminlist = (function () {
    let blockUI, target
    var table_items,
        btn_search,
        span_fecha_embarque,
        start_date,
        end_date,
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
                        console.log(plantilla)
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

                        document.querySelector('#kt_accordion_1_header_2 button').classList.remove('collapsed');
                        document.querySelector('#kt_accordion_1_body_2').classList.add('show');
                        document.querySelectorAll('.accordion-collapse').forEach((accordion) => {
                            if (accordion !== document.querySelector('#kt_accordion_1_body_2')) {
                                accordion.classList.remove('show');
                            }
                        });

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
                (span_fecha_embarque = document.querySelector('#fecha_embarque')),
                (start_date = document.querySelector('#start_date')),
                (end_date = document.querySelector('#end_date')),
                (btn_search = document.querySelector('#btn_search')),
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
                    )

                btn_search.addEventListener('click', function () {
                    table_items.ajax.reload();
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

                blockUI.block()
            },

        }
})()
KTUtil.onDOMContentLoaded(function () {
    KTadminlist.init()
})
