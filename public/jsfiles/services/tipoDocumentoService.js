//servicios con axios para consumir controladores
tipoDocumentoService = {
//peticion a funcion index 
    getAll() {
        return axios.get(`tipoDocumentos`);
    },
//peticion a funcion get
    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },
//peticion a funcion create
    create(data) {
        return axios.post(`tipoDocumentos`, data);
    },
//peticion a funcion update
    update(data) {
        return axios.put(`tipoDocumentos/${data.id}`,data);
    },
//peticion a funcion destroy
    destroy(data){
        return axios.delete(`tipoDocumentos/${data.id}`);
    }

}