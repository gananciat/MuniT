//servicios con axios para consumir controladores
empleadoService = {
    //peticion a funcion index
    getAll() {
        return axios.get(`empleados`);
    },

    //peticion a funcion show
    get(id) {
        let self = this;
        return axios.get(`empleados/${id}`);
    },

    //peticion a funcion create
    create(data) {
        return axios.post(`empleados`, data);
    },

    //peticion a funcion update
    update(data) {
        return axios.put(`empleados/${data.id}`,data);
    },

    //peticion a funcion destroy
    destroy(data){
        return axios.delete(`empleados/${data.id}`);
    },

    //peticion a funcion cambiarEstado
    cambiarEstado(data) {
        return axios.put(`empleados_cambiar_estado/${data.id}`,data);
    },

}