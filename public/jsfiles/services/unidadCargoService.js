//servicios con axios para consumir controladores
unidadCargoService = {
    //peticion a funcion index
    getAll() {
        return axios.get(`unidadCargos`);
    },

    //peticion a funcion show
    get(id) {
        return axios.get(`${self.baseUrl}/${id}`);
    },

    //peticion a funcion index de unidadCargounidadCargocargocontroller, obtener cargos
    getCargos(id) {
        return axios.get(`${`unidadCargos`}/${id}/cargos`);
    },

    //peticion a funcion create
    create(data) {
        return axios.post(`unidadCargos`, data);
    },

    //peticion a funcion update
    update(data) {
        return axios.put(`unidadCargos/${data.id}`,data);
    },

    //peticion a funcion destroy
    destroy(data){
        return axios.delete(`unidadCargos/${data.pivot.id}`);
    }

}