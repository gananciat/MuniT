//servicios con axios para consumir controladores
cargoService = {
    //peticion a funcion index
    getAll() {
        return axios.get(`cargos`);
    },

    //peticion a funcion show
    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },

    //peticion a funcion create
    create(data) {
        return axios.post(`cargos`, data);
    },

    //peticion a funcion update
    update(data) {
        return axios.put(`cargos/${data.id}`,data);
    },

    //peticion a funcion destroy
    destroy(data){
        return axios.delete(`cargos/${data.id}`);
    }

}