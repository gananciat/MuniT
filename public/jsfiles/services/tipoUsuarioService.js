//servicios con axios para consumir controladores
tipoUsuarioService = {
    //peticion a funcion index
    getAll() {
        return axios.get(`tipoUsuarios`);
    },

    //peticion a funcion show
    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },

    //peticion a funcion create
    create(data) {
        return axios.post(`tipoUsuarios`, data);
    },

    //peticion a funcion update
    update(data) {
        return axios.put(`tipoUsuarios/${data.id}`,data);
    },

    //peticion a funcion destroy
    destroy(data){
        return axios.delete(`tipoUsuarios/${data.id}`);
    }

}