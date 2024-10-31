"use strict"

var KTadminlist = (function () {

    var table_items,
        btn_search,
        start_date,
        end_date,
        blockUI,
        target,
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
                        const arr_data = data

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
                    blockUI.release();
                })
            })
        }
        return {
            init: function () {
                (target = document.querySelector("#kt_block_ui_1_target")),
                (blockUI = new KTBlockUI(target)),
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

                $("#kt_daterangepicker_3").daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: 1901,
                    maxYear: parseInt(moment().format("YYYY"),10)
                }, function(start, end, label) {
                    var years = moment().diff(start, "years");
                    alert("You are " + years + " years old!");
                }
            );
                blockUI.block()
            },

        }
})()
KTUtil.onDOMContentLoaded(function () {
    KTadminlist.init()
})
