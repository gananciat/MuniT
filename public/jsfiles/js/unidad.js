//archivo controller, interactua con la vista, y con los servicios axios
model.unidadController = {

    unidad: {
        id: ko.observable(null),
        nombre: ko.observable(""),
        cargos: ko.observableArray([])
    },

    cargo: {
        id: ko.observable(null),
        cargo_id: ko.observable(null),
        unidad_id: ko.observable(null)
    },

    unidads: ko.observableArray([]),
    cargos: ko.observableArray([]),
    unidadCargos: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    search: ko.observable(""),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        let self = model.unidadController;
        var form = self.unidad;
        form.id(data.id);
        form.nombre(data.nombre);

        self.setCargos(data.cargos);
    },

    //seteamos prestaciones para editar
    setCargos(cargos){
        let self = model.unidadController;
        self.unidad.cargos([])
        //seteamos los presupuestos a los usuarios
        cargos.forEach(function(c){
            self.unidad.cargos.push(c.id);
        });
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.unidadController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

//limpia los dataos del formulario
    clearData: function(){
       let self = model.unidadController;

        Object.keys(self.unidad).forEach(function(key,index) {
          if(typeof self.unidad[key]() === "string") 
            self.unidad[key]("")
          else if (typeof self.unidad[key]() === "boolean") 
            self.unidad[key](true)
          else if (typeof self.unidad[key]() === "number") 
            self.unidad[key](null)
        });

        self.unidad.cargos([]);
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.unidadController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

//crear o editar formulario
    createOrEdit(){
        let self = model.unidadController;
     //validar formulario
        if (!model.validateForm('#formulario')) { 
            return;
        }

        self.unidad.id() === null ? self.create() : self.update()
    },

    //funcion para crear un nuevo registro, llama al servicio
    create: function () {
        let self = model.unidadController;
        var data = self.unidad;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        unidadService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
           $('#nuevo').modal('hide');
            self.volverIndex();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

    //funcion para crear un nuevo registro unidad cargos, llama al servicio
    createCargo: function () {
        let self = model.unidadController;
        var data = self.cargo;
        var dataParams = ko.toJS(data);

        if (!model.validateForm('#formularioU')) { 
            return;
        }

        if(self.validateExistsCargo(dataParams.cargo_id)){
            toastr.error('puesto laboral ya fue asignado a este departamento','error')
            return;
        }
        //llamada al servicio
        unidadCargoService.create(dataParams)
        .then(r => {
           toastr.info('cargo fue agregado con éxito','exito')  
           self.getUnidadCargos(dataParams.unidad_id)
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

    validateExistsCargo(id){
        let self = model.unidadController;
        var exists = false;
        self.unidadCargos().forEach(function(c){
            if(c.id === id){
                exists = true;
            }
        })

        return exists;
    },

//funcion para actualizar registro
     update: function () {
        let self = model.unidadController;
        var data = self.unidad;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        unidadService.update(dataParams)
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
        let self= model.unidadController;
        bootbox.confirm({ 
            title: "eliminar unidad",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    unidadService.destroy(data)
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

    //funcion para eliminar registro unidad cargos
    destroyCargo: function (data) {
        let self= model.unidadController;
        console.log(data)
        bootbox.confirm({ 
            title: "eliminar unidad",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + " del departamento?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    unidadCargoService.destroy(data)
                    .then(r => {
                        toastr.info("cargo eliminado éxito",'éxito');
                         self.getUnidadCargos(data.pivot.unidad_id)
                    })
                    .catch(r => {
                        toastr.error(r.response.data.error)
                    });
                }
            }
        })
    },

//funcion para cancelar opcion
    cancelar: function () {
        let self = model.unidadController;
        self.volverIndex();

        model.clearErrorMessage('#formulario');
    },

//funcion para volver al index
    volverIndex: function(){
        let self = model.unidadController;
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

    editCargo(data){
        let self = model.unidadController;
        self.cargo.unidad_id(data.id);
        self.map(data);
        self.getUnidadCargos(data.id);
    },

    //obtener cargos
    getUnidadCargos: function(id){
        let self = model.unidadController;
        //llamada al servicio
        unidadService.getCargos(id)
        .then(r => {
            self.unidadCargos(r.data);
        })
        .catch(r => {});
    },

//archivo controller, interactua con la vista, y con los servicios axios
    initialize: function () {
        var self = model.unidadController;

        //llamada al servicio
        unidadService.getAll()
        .then(r => {
            self.unidads(r.data);
        })
        .catch(r => {});

        self.getCargos();
    }
};

model.unidadController.filterSearch = ko.computed(function () {
    let self = model.unidadController;
    var q = self.search();

    return self.cargos().filter(function (i) {
        return i.nombre.toLowerCase().indexOf(q) >= 0;
    });
});