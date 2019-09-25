//controller que se encarga de interactuar con la vista y con los servicios axios
model.prestacionController = {

    prestacion: {
        id: ko.observable(null),
        nombre: ko.observable("")
    },

    prestacions: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.prestacionController.prestacion;
        form.id(data.id);
        form.nombre(data.nombre);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.prestacionController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },
   //limpiar formulario
    clearData: function(){
       let self = model.prestacionController;

        Object.keys(self.prestacion).forEach(function(key,index) {
          if(typeof self.prestacion[key]() === "string") 
            self.prestacion[key]("")
          else if (typeof self.prestacion[key]() === "boolean") 
            self.prestacion[key](true)
          else if (typeof self.prestacion[key]() === "number") 
            self.prestacion[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.prestacionController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },
//crear o editar registro, segun condicion if.
    createOrEdit(){
        let self = model.prestacionController;
     //validar formulario
        if (!model.validateForm('#formulario')) { 
            return;
        }

        self.prestacion.id() === null ? self.create() : self.update()
    },
//crear registro, manda a llamar el create del service
    create: function () {
        let self = model.prestacionController;
        var data = self.prestacion;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        prestacionService.create(dataParams)
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
        let self = model.prestacionController;
        var data = self.prestacion;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        prestacionService.update(dataParams)
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
        let self= model.prestacionController;
        bootbox.confirm({ 
            title: "eliminar prestacion",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    prestacionService.destroy(data)
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
        let self = model.prestacionController;
        self.volverIndex();

        model.clearErrorMessage('#formulario');
    },
    
//funcion para volver al index, resetea variables de bandera
    volverIndex(){
        let self = model.prestacionController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },
//archivo que se ejecuta al inicio cuando se carga la vista, lista todos los registros
    initialize: function () {
        var self = model.prestacionController;

        //llamada al servicio
        prestacionService.getAll()
        .then(r => {
            self.prestacions(r.data);
        })
        .catch(r => {});
    }
};