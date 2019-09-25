//servicios con axios para consumir controladores
userService = {
    //peticion a funcion index
    getAll() {
        return axios.get(`users`);
    },

    //peticion a funcion show
    get(id) {
        let self = this;
        return axios.get(`users`);
    },

    //peticion a funcion create
    create(data) {
        return axios.post(`users`, data);
    },

//peticion a funcion create
    cambiarContraseña(data) {
        return axios.post(`users_change_password`, data);
    },
    //peticion a funcion update
    update(data) {
        return axios.put(`users/${data.id}`,data);
    },

    //peticion a funcion destroy
    destroy(data){
        return axios.delete(`users/${data.id}`);
    }

}