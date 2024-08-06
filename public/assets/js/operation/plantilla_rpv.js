"use strict"

var KTcalibreesList = (function () {
    const token = $('meta[name="csrf-token"]').attr('content')
    var btn_add,
    btn_search,
    select_pais,
    form,
    obtener_datos = (formulario, pais) => {
        const clase = "p_input"
        const inputs = formulario.querySelectorAll(`input.${clase}`)

        let datosFormulario = { pais_id: pais }

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
        console.log(datosFormulario)
        fetch('save_plantilla', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify(datosFormulario)
        })
        .then(response => response.json())
        .then(data => {
            console.log('Éxito:', data)
        })
        .catch((error) => {
            console.error('Error:', error)
        })
    }
    return {
        init: function () {
            btn_add = document.querySelector("#btn_add")
            btn_search = document.querySelector("#btn_search")
            select_pais = $('#pais_id').select2()
            form = document.querySelector("#form_plantilla")

            btn_add.addEventListener("click", function (t) {
                if(select_pais.val() != '' && select_pais.val() !== null){
                    obtener_datos(form, select_pais.val())
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
                        // body: JSON.stringify(datosFormulario)
                    })
                    .then(response => response.json())
                    .then(data => {
                        const datos = data.plantilla[0]
                        delete datos.id
                        delete datos.created_at
                        delete datos.deleted_at
                        delete datos.updated_at

                        for (const [key, value] of Object.entries(datos)) {
                            const elementos = document.getElementsByName(key);
                            if (elementos.length > 0) {
                              if (elementos[0].type === 'radio') {
                                elementos.forEach(radio => {
                                    console.log("entra aqyu", value)
                                  radio.checked = radio.value == value.toString();
                                });
                              } else if (elementos[0].type === 'checkbox') {
                                elementos[0].checked = Boolean(value);
                              } else {
                                elementos[0].value = value;
                              }
                            }
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error)
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
        }
    }
})()
KTUtil.onDOMContentLoaded(function () {
    KTcalibreesList.init()
})
