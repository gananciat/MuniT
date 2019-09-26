//servicios con axios para consumir graficas
graficaService = {
  //peticion a funcion get
      get(id) {
          let self = this;
          return self.axios.get(`${self.baseUrl}/${id}`);
      },
}