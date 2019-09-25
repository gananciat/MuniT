//controller que se encarga de interactuar con la vista y con los servicios axios
model.unidadCargoController = {

    unidadCargo: {
        id: ko.observable(null),
        cargo_id: ko.observable(null),
        unidad_id:ko.observable(null)
    },

    unidadCargos: ko.observableArray([]),
    cargos: ko.observable([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.unidadCargoController.unidadCargo;
        form.id(data.id);
        form.cargo_id(data.cargo_id);
        form.unidad_id(data.unidad_id);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.unidadCargoController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },
   //limpiar formulario
    clearData: function(){
       let self = model.unidadCargoController;

        Object.keys(self.unidadCargo).forEach(function(key,index) {
          if(typeof self.unidadCargo[key]() === "string") 
            self.unidadCargo[key]("")
          else if (typeof self.unidadCargo[key]() === "boolean") 
            self.unidadCargo[key](true)
          else if (typeof self.unidadCargo[key]() === "number") 
            self.unidadCargo[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.unidadCargoController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },
//crear o editar registro, segun condicion if.
    createOrEdit(){
        let self = model.unidadCargoController;
     //validar formulario
        if (!model.validateForm('#formularioU')) { 
            return;
        }

        self.create()
    },
//crear registro, manda a llamar el create del service
    create: function () {
        let self = model.unidadCargoController;
        var data = self.unidadCargo;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        unidadCargoService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },
    //funcion para actualizar
     update: function () {
        let self = model.unidadCargoController;
        var data = self.unidadCargo;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        unidadCargoService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

//funcion para eliminar registro
    destroy: function (data) {
        let self= model.unidadCargoController;
        bootbox.confirm({ 
            title: "eliminar unidadCargo",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    unidadCargoService.destroy(data)
                    .then(r => {
                        toastr.info("puesto laboral ah sido removido éxito",'éxito');
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
        let self = model.unidadCargoController;

        model.clearErrorMessage('#formularioU');
    },
    
//funcion para volver al index, resetea variables de bandera
    volverIndex(){
        let self = model.unidadCargoController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

    //obtener cargos
    getCargos: function(){
        let self = model.unidadController;
        //llamada al servicio
        cargoService.getAll()
        .then(r => {
            self.cargos(r.data);
        })
        .catch(r => {});
    },
//archivo que se ejecuta al inicio cuando se carga la vista, lista todos los registros
    initialize: function () {
        var self = model.unidadCargoController;

        self.getCargos();
    }
};