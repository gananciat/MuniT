//servicios con axios para consumir controladores
municipioService = {
//peticion a funcion index
    getAll() {
        return axios.get(`municipios`);
    },
//peticion a funcion get
    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },
//peticion a funcion create
    create(data) {
        return axios.post(`municipios`, data);
    },
//peticion a funcion update
    update(data) {
        return axios.put(`municipios/${data.id}`,data);
    },
//peticion a funcion destroy
    destroy(data){
        return axios.delete(`municipios/${data.id}`);
    }

}