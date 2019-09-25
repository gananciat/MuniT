//controller que se encarga de interactuar con la vista y con los servicios axios
model.tipoUsuarioController = {

    tipoUsuario: {
        id: ko.observable(null),
        nombre: ko.observable("")
    },

    tipoUsuarios: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.tipoUsuarioController.tipoUsuario;
        form.id(data.id);
        form.nombre(data.nombre);
    },

  //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.tipoUsuarioController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    //limpiar formulario
    clearData: function(){
       let self = model.tipoUsuarioController;

        Object.keys(self.tipoUsuario).forEach(function(key,index) {
          if(typeof self.tipoUsuario[key]() === "string") 
            self.tipoUsuario[key]("")
          else if (typeof self.tipoUsuario[key]() === "boolean") 
            self.tipoUsuario[key](true)
          else if (typeof self.tipoUsuario[key]() === "number") 
            self.tipoUsuario[key](null)
        });
    },


   //editar registros del formulario
    editar: function (data){
        let self = model.tipoUsuarioController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

//crear o editar registro, segun condicion if.
    createOrEdit(){
        let self = model.tipoUsuarioController;
     //validar formulario
        if (!model.validateForm('#formulario')) { 
            return;
        }

        self.tipoUsuario.id() === null ? self.create() : self.update()
    },

//crear registro, manda a llamar el create del service
    create: function () {
        let self = model.tipoUsuarioController;
        var data = self.tipoUsuario;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        tipoUsuarioService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
           $('#nuevo').modal('hide');
            self.volverIndex();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

    //funcion para actualizar registro
     update: function () {
        let self = model.tipoUsuarioController;
        var data = self.tipoUsuario;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        tipoUsuarioService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            $('#nuevo').modal('hide');
            self.volverIndex();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

//funcion para eliminar registro
    destroy: function (data) {
        let self= model.tipoUsuarioController;
        bootbox.confirm({ 
            title: "eliminar tipoUsuario",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    tipoUsuarioService.destroy(data)
                    .then(r => {
                        toastr.info("registro eliminado éxito",'éxito');
                        self.volverIndex();
                    })
                    .catch(r => {
                        toastr.error(r.response.data.error)
                    });
                }
            }
        })
    },

//funcion para cancelar registro
    cancelar: function () {
        let self = model.tipoUsuarioController;
        self.volverIndex();

        model.clearErrorMessage('#formulario');
    },

//funcion para volver al index, resetea variables de bandera
    volverIndex(){
        let self = model.tipoUsuarioController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

//archivo que se ejecuta al inicio cuando se carga la vista, lista todos los registros
    initialize: function () {
        var self = model.tipoUsuarioController;

        //llamada al servicio
        tipoUsuarioService.getAll()
        .then(r => {
            self.tipoUsuarios(r.data);
        })
        .catch(r => {});
    }
};