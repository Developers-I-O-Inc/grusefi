"use strict"

var KTcalibreesList = (function () {
    const token = $('meta[name="csrf-token"]').attr('content')
    var btn_add,
    btn_search,
    btn_edit,
    edit_id,
    btn_imprimir,
    select_pais,
    form,
    target,
    blockUI,
    obtener_datos = (formulario, pais, saveoredit) => {
        const clase = "p_input"
        const url = saveoredit ? "save_plantilla" : "edit_plantilla"

        const inputs = formulario.querySelectorAll(`input.${clase}`)
        let datosFormulario = {}
        if(!saveoredit){
            datosFormulario = { pais_id: pais, id: edit_id.value }
        }
        else{

            datosFormulario = { pais_id: pais }
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
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify(datosFormulario)
        })
        .then(
            async response => {
                if (!response.ok) {
                    const data = await response.json()
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Ya existe una plantilla para este país si desea modificarla, seleccione el país y presione el botón de buscar ",
                    })
                }
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
    }
    return {
        init: function () {
            (target = document.querySelector("#kt_block_ui_1_target")),
            (blockUI = new KTBlockUI(target, {
                overlayClass: "bg-success bg-opacity-15",
                message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Bloqueado seleccione un pais...</div>'
            })),
            btn_add = document.querySelector("#btn_add")
            edit_id = document.querySelector("#plantilla_id")
            btn_edit = document.querySelector("#btn_edit")
            btn_imprimir = document.querySelector("#btn_imprimir")
            btn_search = document.querySelector("#btn_search")
            select_pais = $('#pais_id').select2()
            form = document.querySelector("#form_plantilla")

            btn_add.addEventListener("click", function (t) {
                if(select_pais.val() != '' && select_pais.val() !== null){
                    obtener_datos(form, select_pais.val(), true)
                }
                else{
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Selecciona un pais",
                    })
                }
            })
            btn_edit.addEventListener("click", function (t) {
                if(select_pais.val() != '' && select_pais.val() !== null){
                    obtener_datos(form, select_pais.val(), false)
                }
                else{
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Selecciona un pais",
                    })
                }
            })
            btn_search.addEventListener("click", function (t) {
                if(select_pais.val() != '' && select_pais.val() !== null){
                    fetch(`get_plantilla/${select_pais.val()}`, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        const datos = data.plantilla[0]
                        if (datos) {
                            edit_id.value = datos.id
                            delete datos.id
                            delete datos.created_at
                            delete datos.deleted_at
                            delete datos.updated_at

                            for (const [key, value] of Object.entries(datos)) {
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
                            btn_imprimir.classList.remove("d-none")
                            btn_edit.classList.remove("d-none")
                            btn_add.classList.add("d-none")
                            Swal.close()
                        }
                        else{
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: "No se encontró una plantilla para este país",
                            })
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error)
                    })
                    Swal.fire({
                        title: "<strong>Cargando</strong>",
                        html: `<div class="progress container-fluid"></div>`,
                        showConfirmButton: false,
                    })
                }
                else{
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Selecciona un pais",
                    })
                }

            })
             // CHANGE PIS
             select_pais.on('change', function() {
                blockUI.release()
            })
            blockUI.block()
        }
    }
})()
KTUtil.onDOMContentLoaded(function () {
    KTcalibreesList.init()
})
