//servicios con axios para consumir controladores
departamentoService = {
    //peticion a funcion index
    getAll() {
        return axios.get(`departamentos`);
    },

    //peticion a funcion show
    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },

    //peticion a funcion create
    create(data) {
        return axios.post(`departamentos`, data);
    },

    //peticion a funcion update
    update(data) {
        return axios.put(`departamentos/${data.id}`,data);
    },

    //peticion a funcion destroy
    destroy(data){
        return axios.delete(`departamentos/${data.id}`);
    }

}