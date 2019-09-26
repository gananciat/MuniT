//servicios con axios para consumir reportes
repoteService = {
  //peticion a funcion get
      get(id) {
          let self = this;
          return self.axios.get(`${self.baseUrl}/${id}`);
      },
}