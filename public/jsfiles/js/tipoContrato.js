//archivo controller, interactua con la vista, y con los servicios axios
model.tipoContratoController = {

    tipoContrato: {
        id: ko.observable(null),
        nombre: ko.observable(""),
        numero: ko.observable(""),
        descripcion: ko.observable(""),
        prestaciones: ko.observableArray([])
    },

    tipoContratos: ko.observableArray([]),
    prestaciones: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        let self = model.tipoContratoController;
        var form = self.tipoContrato;
        form.id(data.id);
        form.nombre(data.nombre);
        form.numero(data.numero);
        form.descripcion(data.descripcion);

        self.setPrestaciones(data.prestaciones);
    },

    //seteamos prestaciones para editar
    setPrestaciones(prestaciones){
        let self = model.tipoContratoController;
        self.tipoContrato.prestaciones([])
        //seteamos los presupuestos a los usuarios
        prestaciones.forEach(function(p){
            self.tipoContrato.prestaciones.push(p.id);
        });
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.tipoContratoController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

//limpia los dataos del formulario
    clearData: function(){
       let self = model.tipoContratoController;
        Object.keys(self.tipoContrato).forEach(function(key,index) {
          if(typeof self.tipoContrato[key]() === "string") 
            self.tipoContrato[key]("")
          else if (typeof self.tipoContrato[key]() === "boolean") 
            self.tipoContrato[key](true)
          else if (typeof self.tipoContrato[key]() === "number") 
            self.tipoContrato[key](null)
        });

        self.tipoContrato.prestaciones([]);
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.tipoContratoController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

//crear o editar formulario
    createOrEdit(){
        let self = model.tipoContratoController;
     //validar formulario
        if (!model.validateForm('#formulario')) { 
            return;
        }

        self.tipoContrato.id() === null ? self.create() : self.update()
    },

    //funcion para crear un nuevo registro, llama al servicio
    create: function () {
        let self = model.tipoContratoController;
        var data = self.tipoContrato;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        tipoContratoService.create(dataParams)
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
        let self = model.tipoContratoController;
        var data = self.tipoContrato;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        tipoContratoService.update(dataParams)
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
        let self= model.tipoContratoController;
        bootbox.confirm({ 
            title: "eliminar tipoContrato",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    tipoContratoService.destroy(data)
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

//funcion para cancelar opcion
    cancelar: function () {
        let self = model.tipoContratoController;
        self.volverIndex();

        model.clearErrorMessage('#formulario');
    },

//funcion para volver al index
    volverIndex: function(){
        let self = model.tipoContratoController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

//funcion para check o uncheck todas las prestacions
    checkAllPrestaciones: function(){
        let self = model.tipoContratoController;
        var checked = $('#checkall').prop('checked');
        if(checked){
            self.prestaciones().forEach(function(p){
                self.tipoContrato.prestaciones.push(p.id);
            });
        }else{
            self.tipoContrato.prestaciones([])
        }
    },

    getPrestaciones: function(){
        let self = model.tipoContratoController;
        //llamada al servicio
        prestacionService.getAll()
        .then(r => {
            self.prestaciones(r.data);
        })
        .catch(r => {});
    },
//archivo controller, interactua con la vista, y con los servicios axios
    initialize: function () {
        var self = model.tipoContratoController;

        //llamada al servicio
        tipoContratoService.getAll()
        .then(r => {
            self.tipoContratos(r.data);
        })
        .catch(r => {});

        self.getPrestaciones();
    }
};