class Operation {
    constructor() {}

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
}

export default new Operation()
