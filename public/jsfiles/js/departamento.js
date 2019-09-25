//controller que se encarga de interactuar con la vista y con los servicios axios
model.departamentoController = {

    departamento: {
        id: ko.observable(null),
        nombre: ko.observable("")
    },

    departamentos: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.departamentoController.departamento;
        form.id(data.id);
        form.nombre(data.nombre);
    },

  //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.departamentoController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    //limpiar formulario
    clearData: function(){
       let self = model.departamentoController;

        Object.keys(self.departamento).forEach(function(key,index) {
          if(typeof self.departamento[key]() === "string") 
            self.departamento[key]("")
          else if (typeof self.departamento[key]() === "boolean") 
            self.departamento[key](true)
          else if (typeof self.departamento[key]() === "number") 
            self.departamento[key](null)
        });
    },


   //editar registros del formulario
    editar: function (data){
        let self = model.departamentoController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

//crear o editar registro, segun condicion if.
    createOrEdit(){
        let self = model.departamentoController;
     //validar formulario
        if (!model.validateForm('#formulario')) { 
            return;
        }

        self.departamento.id() === null ? self.create() : self.update()
    },

//crear registro, manda a llamar el create del service
    create: function () {
        let self = model.departamentoController;
        var data = self.departamento;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        departamentoService.create(dataParams)
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
        let self = model.departamentoController;
        var data = self.departamento;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        departamentoService.update(dataParams)
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
        let self= model.departamentoController;
        bootbox.confirm({ 
            title: "eliminar departamento",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    departamentoService.destroy(data)
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
        let self = model.departamentoController;
        self.volverIndex();

        model.clearErrorMessage('#formulario');
    },

//funcion para volver al index, resetea variables de bandera
    volverIndex(){
        let self = model.departamentoController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

//archivo que se ejecuta al inicio cuando se carga la vista, lista todos los registros
    initialize: function () {
        var self = model.departamentoController;

        //llamada al servicio
        departamentoService.getAll()
        .then(r => {
            self.departamentos(r.data);
        })
        .catch(r => {});
    }
};