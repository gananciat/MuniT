//servicios con axios para consumir controladores
prestacionService = {
//peticion a funcion index
    getAll() {
        return axios.get(`prestacions`);
    },
//peticion a funcion get
    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },
//peticion a funcion create
    create(data) {
        return axios.post(`prestacions`, data);
    },
//peticion a funcion update
    update(data) {
        return axios.put(`prestacions/${data.id}`,data);
    },
//peticion a funcion destroy
    destroy(data){
        return axios.delete(`prestacions/${data.id}`);
    }

}