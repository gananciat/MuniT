//servicios con axios para consumir controladores
documentoContratoService = {
    //peticion a funcion index
    getAll() {
        return axios.get(`documentoContratos`);
    },

    //peticion a funcion show
    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },

    //peticion a funcion create
    create(data) {
        return axios.post(`documentoContratos`, data,
            { headers: 
                {'Content-Type': 'multipart/form-data' }
            }
        );
    },

    //peticion a funcion update
    update(data) {
        return axios.put(`documentoContratos/${data.id}`,data);
    },

    //peticion a funcion destroy
    destroy(data){
        return axios.delete(`documentoContratos/${data.id}`);
    }

}