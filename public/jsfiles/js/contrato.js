//controller que se encarga de interactuar con la vista y con los servicios axios
model.contratoController = {

    contrato: {
        id: ko.observable(null),
        no_contrato: ko.observable(""),
        empleado_id: ko.observable(null),
        tipo_contrato_id: ko.observable(null),
        unidad_cargo: ko.observable(null),
        unidad_cargo_id: ko.observable(null),
        fecha_inicio: ko.observable(""),
        fecha_fin: ko.observable(""),
        salario: ko.observable(""),
        primer_salario: ko.observable(null),
        monto: ko.observable(""),
        cantidad_pagos: ko.observable(null),
        isPrimerPago: ko.observable(false)
    },


    empleado: {
        id: ko.observable(null),
        nombre_completo: ko.observable(""),
        edad: ko.observable(""),
        nit: ko.observable(""),
        dpi: ko.observable(""),
        avatar: ko.observable(null),
        estado_civil: ko.observable(""),
        genero: ko.observable("")
    },

    contratos: ko.observableArray([]),
    empleados: ko.observableArray([]),
    tipo_contratos: ko.observableArray([]),
    departamentos: ko.observableArray([]),
    cargos: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    empleadoInfo: ko.observable(false),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],

    //mapear funcion para editar
    map: function (data) {
        var form = model.contratoController.contrato;
        form.id(data.id);
        form.nombre(data.nombre);
    },

  //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.contratoController;
       self.clearData();
       self.contrato.no_contrato(moment().year()+'-'+(self.contratos().length+1))
       self.insertMode(true);
       self.gridMode(false);
    },

    //limpiar formulario
    clearData: function(){
       let self = model.contratoController;

        Object.keys(self.contrato).forEach(function(key,index) {
          if(typeof self.contrato[key]() === "string") 
            self.contrato[key]("")
          else if (typeof self.contrato[key]() === "boolean") 
            self.contrato[key](false)
          else if (typeof self.contrato[key]() === "number") 
            self.contrato[key](null)
        });
    },


   //editar registros del formulario
    editar: function (data){
        let self = model.contratoController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

//crear o editar registro, segun condicion if.
    createOrEdit(){
        let self = model.contratoController;
        self.contrato.empleado_id(self.empleado.id());

        if(self.validarFechas(self.contrato.fecha_inicio(), self.contrato.fecha_fin())){
            toastr.error('la fecha fin debe ser mayor a fecha de inicio','error');
            return;
        }
     //validar formulario
        if (!model.validateForm('#formulario')) { 
            return;
        }

        self.contrato.id() === null ? self.create() : self.update()
    },

//crear registro, manda a llamar el create del service
    create: function () {
        let self = model.contratoController;
        var data = self.contrato;
        var dataParams = ko.toJS(data);
        dataParams.unidad_cargo_id = dataParams.unidad_cargo.id;
        console.log(dataParams);
        if(dataParams.empleado_id === "" || dataParams.empleado_id === null){
            toastr.error("debe seleccionar un empleado","error");
            return;
        }

        //llamada al servicio
        contratoService.create(dataParams)
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
        let self = model.contratoController;
        var data = self.contrato;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        contratoService.update(dataParams)
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
        let self= model.contratoController;
        bootbox.confirm({ 
            title: "eliminar contrato",
            message: "¿Esta seguro de anular contrato " + data.no_contrato + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    contratoService.destroy(data)
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
        let self = model.contratoController;
        self.volverIndex();

        model.clearErrorMessage('#formulario');
    },

//funcion para volver al index, resetea variables de bandera
    volverIndex(){
        let self = model.contratoController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

    //obtener empleados
    getEmpleados: function(){
        let self = model.contratoController;
        //llamada al servicio
        empleadoService.getAll()
        .then(r => {
            r.data.forEach(function(item){
                if(item.estado === 0){
                    self.empleados.push(item);
                }
            })
            console.log(self.empleados());
        })
        .catch(r => {});
    },

    setEmpleado: function(empleado){
        let self = model.contratoController;

        if(self.validarContratoEmpleado(empleado.id)){
            toastr.error("empleado aun cuenta con contrato activo, por favor seleccione otro","error");
            return;
        }
        self.empleado.id(empleado.id);
        self.empleado.nombre_completo(empleado.nombre1+' '+empleado.apellido1);
        self.empleado.dpi(empleado.dpi);
        self.empleado.nit(empleado.nit);
        self.empleado.avatar(empleado.avatar);
        self.empleado.estado_civil(empleado.estado_civil.nombre);
        self.empleado.edad(moment().diff(empleado.nacimiento, 'years',false));
        empleado.genero === 'M' ? self.empleado.genero('Masculino') : self.empleado.genero('Femenino');

        $("#select_empleado").modal('hide');
        self.empleadoInfo(true);
    },

    //obtener departamentos
    getDepartamentos: function(){
        let self = model.contratoController;
        //llamada al servicio
        unidadService.getAll()
        .then(r => {
            self.departamentos(r.data);
        })
        .catch(r => {});
    },

    //obtener tipos de contrato
    getTipoContratos: function(){
        let self =model.contratoController;
        //llamada al servicio
        tipoContratoService.getAll()
        .then(r => {
            self.tipo_contratos(r.data);
        })
        .catch(r => {});
    },

    //setear monto de contrato
    setMonto: function(){
        let self = model.contratoController;
        var a = self.contrato.salario();
        var b = self.contrato.isPrimerPago() ? self.contrato.cantidad_pagos()-1 : self.contrato.cantidad_pagos();
        var c = 0;
        self.contrato.isPrimerPago() ? c = self.contrato.primer_salario() : self.contrato.primer_salario(0);
        self.contrato.monto((a*b)+parseFloat(c));
    },

    //validar empleado con contrato activo
    validarContratoEmpleado: function(empleado_id){
        let self = model.contratoController;
        var is_activo = false;
        self.contratos().forEach(function(item){
            if(item.empleado_id === empleado_id && !item.vencido && item.deleted_at === null){
                is_activo = true;
            }
        })
        return is_activo;
    },

    validarFechas: function(fecha_inicio, fecha_fin){
        if(fecha_inicio >= fecha_fin){
            return true;
        }
        return false;
    },

    initializeDocumentos: function(contrato){
        let self = model.contratoController;
        model.documentoContratoController.initialize(contrato.id);
    },

//archivo que se ejecuta al inicio cuando se carga la vista, lista todos los registros
    initialize: function () {
        var self = model.contratoController;

        //llamada al servicio
        contratoService.getAll()
        .then(r => {
            self.contratos(r.data);
        })
        .catch(r => {});

        self.getEmpleados();
        self.getDepartamentos();
        self.getTipoContratos();
    }
}

/*model.contratoController.isPrimerPago.showInputPrimerPago = ko.computed({
          
});*/