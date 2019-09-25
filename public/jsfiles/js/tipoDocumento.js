//controller que se encarga de interactuar con la vista y con los servicios axios
model.tipoDocumentoController = {

    tipoDocumento: {
        id: ko.observable(null),
        nombre: ko.observable("")
    },

    tipoDocumentos: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.tipoDocumentoController.tipoDocumento;
        form.id(data.id);
        form.nombre(data.nombre);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.tipoDocumentoController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },
   //limpiar formulario
    clearData: function(){
       let self = model.tipoDocumentoController;

        Object.keys(self.tipoDocumento).forEach(function(key,index) {
          if(typeof self.tipoDocumento[key]() === "string") 
            self.tipoDocumento[key]("")
          else if (typeof self.tipoDocumento[key]() === "boolean") 
            self.tipoDocumento[key](true)
          else if (typeof self.tipoDocumento[key]() === "number") 
            self.tipoDocumento[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.tipoDocumentoController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },
//crear o editar registro, segun condicion if.
    createOrEdit(){
        let self = model.tipoDocumentoController;
     //validar formulario
        if (!model.validateForm('#formulario')) { 
            return;
        }

        self.tipoDocumento.id() === null ? self.create() : self.update()
    },
//crear registro, manda a llamar el create del service
    create: function () {
        let self = model.tipoDocumentoController;
        var data = self.tipoDocumento;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        tipoDocumentoService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
           $('#nuevo').modal('hide');
            self.volverIndex();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },
    //funcion para actualizar
     update: function () {
        let self = model.tipoDocumentoController;
        var data = self.tipoDocumento;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        tipoDocumentoService.update(dataParams)
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
        let self= model.tipoDocumentoController;
        bootbox.confirm({ 
            title: "eliminar tipoDocumento",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    tipoDocumentoService.destroy(data)
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
        let self = model.tipoDocumentoController;
        self.volverIndex();

        model.clearErrorMessage('#formulario');
    },
//funcion para volver al index, resetea variables de bandera
    volverIndex(){
        let self = model.tipoDocumentoController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },
//funcion que se ejecuta al inicio cuando se carga la vista, lista todos los registros
    initialize: function () {
        var self = model.tipoDocumentoController;

        //llamada al servicio
        tipoDocumentoService.getAll()
        .then(r => {
            self.tipoDocumentos(r.data);
        })
        .catch(r => {});
    }
};