class Operation {
    constructor(token) {
        this.token = $('meta[name="csrf-token"]').attr('content')
    }

    checked(campo, check) {
        if (check.checked) {
            campo.value = 1
        } else {
            campo.value = 0
        }
    }

    get_next_selects(catalog, id, select_change){
        fetch(`/catalogs/get_${catalog}?id=${id}`, {
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
            const arr_data = data.catalogo
            select_change.empty()
                arr_data.forEach(item => {
                    const option = new Option(item.nombre, item.id);
                    select_change.append(option)
                })
            select_change.val(select_change.attr('data-id')).trigger('change.select2');

        })
        .catch(error => {
            console.error(error)
        })
    }

    add_products(table_products, btn_add_product, form_products, embarque_id, edit_text_products = null) {
        let edit_pallet = document.getElementById('folio_pallet'),
        edit_lote = document.getElementById('lote'),
        edit_sader = document.getElementById('sader'),
        edit_cajas = document.getElementById('cajas'),
        edit_registros = document.getElementById('n_registros'),
        edit_tipo_fruta = document.getElementById('tipo_fruta'),
        select_categoria = $('#categoria_id').select2(),
        select_cultivo = $('#tipo_cultivo_id').select2(),
        select_calibre = $('#calibre_id').select2(),
        select_presentacion = $('#presentacion_id').select2(),
        count_products = 0

        const validations_products = FormValidation.formValidation(form_products, {
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
                            min: 1,
                            max: 100,
                            message: "Tiene que haber al menos una caja y menos de 100"
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
        })

        validations_products && validations_products.validate().then((e) => {
            if (e === "Valid") {
                let ban = false
                btn_add_product.setAttribute("data-kt-indicator", "on")
                if (edit_text_products != null) {
                    count_products += 1;
                    edit_text_products.value = count_products;
                    ban = true
                } else {
                    ban = this.save_products(embarque_id, btn_add_product)
                }
                if(ban){
                    table_products.row.add([
                        `<button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1 delete_product"
                            data-kt-customer-table-filter="delete_row">
                            <span class="svg-icon svg-icon-muted svg-icon-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"/>
                                    <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"/>
                                    <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"/>
                                </svg>
                            </span>
                        </button>`,
                        edit_pallet.value,
                        edit_lote.value,
                        edit_cajas.value,
                        select_presentacion.val().split('|')[1],
                        edit_cajas.value * select_presentacion.val().split('|')[1],
                        edit_sader.value,
                        select_categoria.find('option:selected').text(),
                        select_categoria.val(),
                        select_cultivo.find('option:selected').text(),
                        select_cultivo.val(),
                        select_presentacion.find('option:selected').text(),
                        select_presentacion.val().split('|')[0],
                        select_calibre.find('option:selected').text(),
                        select_calibre.val(),
                        edit_tipo_fruta.value,
                        edit_registros.value,
                    ]).draw()

                    btn_add_product.setAttribute("data-kt-indicator", "off")
                    form_products.reset()
                    toastr.success("Agregado correctamente")
                }

            } else {
                Swal.fire({
                    text: "Error, faltan algunos datos, intente de nuevo por favor.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Entendido!",
                    customClass: {
                        confirmButton: "btn btn-primary",
                    },
                });
            }
        })

    }

    async save_products(embarque_id, btn_add_product) {
        let form = new FormData(document.getElementById("kt_modal_add_product_form"))
        form.append('embarque_id', embarque_id)
        try {
            const respuesta = await fetch('save_products_embarque', {
                method: 'POST',
                headers: {
                'Content-Type': 'application/json',
                "X-CSRF-TOKEN": this.token,
                },
                body: JSON.stringify(Object.fromEntries(form.entries()))
            })

            if (!respuesta.ok) {
                throw new Error(`Error en la solicitud: ${respuesta.status}`)
            }
            return (true)
        }
        catch (error) {
            Swal.fire({
                text: "Error, ocurrio un error en la base de datos.",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Entendido!",
                customClass: {
                    confirmButton: "btn btn-primary",
                },
            })
            btn_add_product.setAttribute("data-kt-indicator", "off")
            console.error('Error al obtener los datos:', error)
            return (false)
        }
    }
}

export default new Operation()
