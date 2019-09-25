//servicios con axios para consumir controladores
diaService = {
    //peticion a funcion get
    getAll() {
        return axios.get(`dias`);
    },

//peticion a funcion get
    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },

//peticion a funcion create
    create(data) {
        return axios.post(`dias`, data);
    },

//peticion a funcion update
    update(data) {
        return axios.put(`dias/${data.id}`,data);
    },
    
//peticion a funcion destroy
    destroy(data){
        return axios.delete(`dias/${data.id}`);
    }

}