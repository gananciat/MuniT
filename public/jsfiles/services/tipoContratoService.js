//servicios con axios para consumir controladores
tipoContratoService = {
//peticion a funcion index
    getAll() {
        return axios.get(`tipoContratos`);
    },
//peticion a funcion get
    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },
//peticion a funcion create
    create(data) {
        return axios.post(`tipoContratos`, data);
    },
//peticion a funcion update
    update(data) {
        return axios.put(`tipoContratos/${data.id}`,data);
    },
//peticion a funcion destroy
    destroy(data){
        return axios.delete(`tipoContratos/${data.id}`);
    }

}