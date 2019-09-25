//controller que se encarga de interactuar con la vista y con los servicios axios
model.cargoController = {

    cargo: {
        id: ko.observable(null),
        nombre: ko.observable(""),
        atribucion: ko.observable(""),
        atribuciones: ko.observableArray([])
    },

    cargos: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.cargoController.cargo;
        form.id(data.id);
        form.nombre(data.nombre);
        form.atribuciones(data.atribuciones);
    },

  //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.cargoController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    //limpiar formulario
    clearData: function(){
       let self = model.cargoController;

        Object.keys(self.cargo).forEach(function(key,index) {
          if(typeof self.cargo[key]() === "string") 
            self.cargo[key]("")
          else if (typeof self.cargo[key]() === "boolean") 
            self.cargo[key](true)
          else if (typeof self.cargo[key]() === "number") 
            self.cargo[key](null)
        });

        self.cargo.atribuciones([]);
    },


   //editar registros del formulario
    editar: function (data){
        let self = model.cargoController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

//crear o editar registro, segun condicion if.
    createOrEdit(){
        let self = model.cargoController;
        if(self.cargo.atribuciones().length === 0){
            toastr.error('no se ha especificado ninguna atribucion','error')
            return
        }
     //validar formulario
        if (!model.validateForm('#formulario')) { 
            return;
        }

        self.cargo.id() === null ? self.create() : self.update()
    },

//crear registro, manda a llamar el create del service
    create: function () {
        let self = model.cargoController;
        var data = self.cargo;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        cargoService.create(dataParams)
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
        let self = model.cargoController;
        var data = self.cargo;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        cargoService.update(dataParams)
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
        let self= model.cargoController;
        bootbox.confirm({ 
            title: "eliminar cargo",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    cargoService.destroy(data)
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
        let self = model.cargoController;
        self.volverIndex();

        model.clearErrorMessage('#formulario');
    },

//funcion para volver al index, resetea variables de bandera
    volverIndex(){
        let self = model.cargoController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

    addAtribucion(){
        let self = model.cargoController;
        var atribucion = self.cargo.atribucion();
        self.cargo.atribuciones.push(
            {descripcion: atribucion}
        );
        self.cargo.atribucion("")
    },

    removeAtribucion(atribucion){
        let self = model.cargoController
        var i = self.cargo.atribuciones().indexOf(atribucion);
        self.cargo.atribuciones.splice(i,1);
    },

//archivo que se ejecuta al inicio cuando se carga la vista, lista todos los registros
    initialize: function () {
        var self = model.cargoController;

        //llamada al servicio
        cargoService.getAll()
        .then(r => {
            self.cargos(r.data);
        })
        .catch(r => {});
    }
};