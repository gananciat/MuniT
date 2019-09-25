//archivo js interactua directamente con la vista y con los servicios de axios
model.diaController = {

    dia: {
        id: ko.observable(null),
        nombre: ko.observable(""),
        abreviatura: ko.observable("")
    },

    dias: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.diaController.dia;
        form.id(data.id);
        form.nombre(data.nombre);
        form.abreviatura(data.abreviatura);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.diaController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    //limpiar data del formulario
    clearData: function(){
       let self = model.diaController;

        Object.keys(self.dia).forEach(function(key,index) {
          if(typeof self.dia[key]() === "string") 
            self.dia[key]("")
          else if (typeof self.dia[key]() === "boolean") 
            self.dia[key](true)
          else if (typeof self.dia[key]() === "number") 
            self.dia[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.diaController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    //funcion para validar formulario, manda a llamar create or update
    createOrEdit(){
        let self = model.diaController;
     //validar formulario
        if (!model.validateForm('#formulario')) { 
            return;
        }

        self.dia.id() === null ? self.create() : self.update()
    },

    //funcion para crear nuevo registro, hace la peticion al service
    create: function () {
        let self = model.diaController;
        var data = self.dia;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        diaService.create(dataParams)
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
        let self = model.diaController;
        var data = self.dia;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        diaService.update(dataParams)
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
        let self= model.diaController;
        bootbox.confirm({ 
            title: "eliminar dia",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    diaService.destroy(data)
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

    //funcion para cancelar y volver al grid
    cancelar: function () {
        let self = model.diaController;
        self.volverIndex();

        model.clearErrorMessage('#formulario');
    },

    //resetea las variables bandera, y vuelve al index
    volverIndex(){
        let self = model.diaController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

    //primera funcion a ejecutarse, lista todos los registros
    initialize: function () {
        var self = model.diaController;

        //llamada al servicio
        diaService.getAll()
        .then(r => {
            self.dias(r.data);
        })
        .catch(r => {});
    }
};