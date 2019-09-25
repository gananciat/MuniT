//controller que se encarga de interactuar con la vista y con los servicios axios
model.municipioController = {

    municipio: {
        id: ko.observable(null),
        nombre: ko.observable(""),
        departamento_id: ko.observable(null)
    },

    municipios: ko.observableArray([]),
    departamentos: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.municipioController.municipio;
        form.id(data.id);
        form.nombre(data.nombre);
        form.departamento_id(data.departamento_id);
        $('#departamento').selectpicker('refresh');
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.municipioController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },
   //limpiar formulario
    clearData: function(){
       let self = model.municipioController;

        Object.keys(self.municipio).forEach(function(key,index) {
          if(typeof self.municipio[key]() === "string") 
            self.municipio[key]("")
          else if (typeof self.municipio[key]() === "boolean") 
            self.municipio[key](true)
          else if (typeof self.municipio[key]() === "number") 
            self.municipio[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.municipioController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.municipioController;
     //validar formulario
        if (!model.validateForm('#formulario')) { 
            return;
        }

        self.municipio.id() === null ? self.create() : self.update()
    },
//crear o editar registro, segun condicion if.
    create: function () {
        let self = model.municipioController;
        var data = self.municipio;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        municipioService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
            $('#nuevo').modal('hide');
            self.volverIndex();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },
//crear registro, manda a llamar el create del service
     update: function () {
        let self = model.municipioController;
        var data = self.municipio;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        municipioService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            $('#nuevo').modal('hide');
            self.volverIndex();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

    //funcion para actualizar
    destroy: function (data) {
        let self= model.municipioController;
        bootbox.confirm({ 
            title: "eliminar municipio",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    municipioService.destroy(data)
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
//funcion para eliminar registro
    cancelar: function () {
        let self = model.municipioController;
        self.volverIndex();

        model.clearErrorMessage('#formulario');
    },
//funcion para cancelar registro
    volverIndex(){
        let self = model.municipioController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },
//funcion para volver al index, resetea variables de bandera
    getDepartamentos(){
        var self = model.municipioController;
        //llamada al servicio
        departamentoService.getAll()
        .then(r => {
            self.departamentos(r.data);
        })
        .catch(r => {});
    },
//archivo que se ejecuta al inicio cuando se carga la vista, lista todos los registros
    initialize: function () {
        var self = model.municipioController;

        //llamada al servicio
        municipioService.getAll()
        .then(r => {
            self.municipios(r.data);
        })
        .catch(r => {});

        self.getDepartamentos();
    }
};