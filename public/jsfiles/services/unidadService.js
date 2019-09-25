//servicios con axios para consumir controladores
unidadService = {
    //peticion a funcion index
    getAll() {
        return axios.get(`unidads`);
    },

    //peticion a funcion show
    get(id) {
        return axios.get(`${self.baseUrl}/${id}`);
    },

    //peticion a funcion index de unidadUnidadcargocontroller, obtener cargos
    getCargos(id) {
        return axios.get(`${`unidads`}/${id}/cargos`);
    },

    //peticion a funcion create
    create(data) {
        return axios.post(`unidads`, data);
    },

    //peticion a funcion update
    update(data) {
        return axios.put(`unidads/${data.id}`,data);
    },

    //peticion a funcion destroy
    destroy(data){
        return axios.delete(`unidads/${data.id}`);
    }

}