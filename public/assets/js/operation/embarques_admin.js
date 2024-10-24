"use strict"

var KTadminlist = (function () {

    var table_items,
        btn_search,
        start_date,
        end_date,
        n
        return {
            init: function () {
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

                                { data: "pallet_id", name: "pallet_id" },
                                { data: "pallet_date", name: "pallet_date" },
                                { data: "presentation", name: "presentation" },
                                { data: "employee", name: "employee" },
                                { data: "total", name: "total" },
                                { data: "total_labor_cost", name: "total_labor_cost" },
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
                        }))
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
            },

        }
})()
KTUtil.onDOMContentLoaded(function () {
    KTadminlist.init()
})
