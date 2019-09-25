//servicios con axios para consumir controladores
contratoService = {
    //peticion a funcion index
    getAll() {
        return axios.get(`contratos`);
    },

    //peticion a funcion show
    get(id) {
        let self = this;
        return axios.get(`contratos/${id}`);
    },

    //peticion a funcion getdocs
    getDocs(id) {
        let self = this;
        return axios.get(`contratos_docs/${id}`);
    },

    //peticion a funcion create
    create(data) {
        return axios.post(`contratos`, data);
    },

    //peticion a funcion update
    update(data) {
        return axios.put(`contratos/${data.id}`,data);
    },

    //peticion a funcion destroy
    destroy(data){
        return axios.delete(`contratos/${data.id}`, data);
    }

}