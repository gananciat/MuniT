//servicios con axios para consumir controladores
estadoCivilService = {
    getAll() {
        return axios.get(`estadoCivils`);
    },
//peticion a funcion get
    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },
//peticion a funcion create
    create(data) {
        return axios.post(`estadoCivils`, data);
    },
//peticion a funcion update
    update(data) {
        return axios.put(`estadoCivils/${data.id}`,data);
    },
//peticion a funcion destroy
    destroy(data){
        return axios.delete(`estadoCivils/${data.id}`);
    }

}