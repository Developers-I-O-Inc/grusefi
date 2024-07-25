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

               obtener_datos(form, select_pais.val())
            })
            btn_search.addEventListener("click", function (t) {
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
                    const inputs = form.querySelectorAll('.p_input');
                    inputs.forEach(input => {
                        if (data.plantilla.hasOwnProperty(input.id)) {
                            // if (input.type === 'checkbox') {
                            if (typeof dato[input.value] === "boolean") {
                                input.checked = datos[input.id];
                            } else {
                                input.value = datos[input.id];
                            }
                        }
                    });
                })
                .catch((error) => {
                    console.error('Error:', error)
                })
            })
        }
    }
})()
KTUtil.onDOMContentLoaded(function () {
    KTcalibreesList.init()
})
