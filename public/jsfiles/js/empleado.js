//controller que se encarga de interactuar con la vista y con los servicios axios
model.empleadoController = {
    empleado: {
        id: ko.observable(null),
        dpi: ko.observable(""),
        nit: ko.observable(""),
        nombre1: ko.observable(""),
        nombre2: ko.observable(""),
        apellido1: ko.observable(""),
        apellido2: ko.observable(""),
        nacimiento: ko.observable(""),
        email: ko.observable(""),
        avatar: ko.observable(""),
        estado: ko.observable(false),
        municipio_id: ko.observable(null),
        estado_civil_id: ko.observable(null),
        direccion: ko.observable(null),
        telefonos: ko.observableArray([]),
        telefono: ko.observable(""),
        image_file: ko.observable(""),
        genero: ko.observable(""),
        profesion:ko.observable("")
    },

    flags: {
        showPersonal: ko.observable(false),
        showContacto: ko.observable(false)
    },

    empleados: ko.observableArray([]),
    departamentos: ko.observableArray([]),
    estadoCiviles: ko.observableArray([]),
    municipios: ko.observableArray([]),
    departamento: ko.observable(null),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    generos: [{ nombre: 'Masculino', valor: 'M' }, { nombre: 'Femenino', valor: 'F' }],


    //mapear funcion para editar
    map: function (data) {
        let self = model.empleadoController;
        var form = self.empleado;
        form.id(data.id);
        form.dpi(data.dpi);
        form.nit(data.nit);
        form.nombre1(data.nombre1);
        form.nombre2(data.nombre2);
        form.apellido1(data.apellido1);
        form.apellido2(data.apellido2);
        self.setMunicipios(data.municipio.departamento);
        $('#departamento').selectpicker('refresh');
        form.municipio_id(data.municipio_id);
        $('#municipio').selectpicker('refresh');
        form.estado_civil_id(data.estado_civil_id);
        $('#estado_civil').selectpicker('refresh');
        form.email(data.email);
        form.telefonos(data.telefonos);
        form.direccion(data.direccion);
        form.estado(data.estado);
        form.avatar(data.avatar);
        form.nacimiento(data.nacimiento);
        form.genero(data.genero);
        form.profesion(data.profesion);
    },

  //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.empleadoController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
       self.flags.showPersonal(true);
    },

    //limpiar formulario
    clearData: function(){
        let self = model.empleadoController;
        var form = self.empleado;
        form.id(null);
        form.dpi("");
        form.nit("");
        form.nombre1("");
        form.nombre2("");
        form.apellido1("");
        form.apellido2("");
        form.municipio_id(null);
        form.estado_civil_id(null);
        form.email("");
        form.telefonos("");
        form.direccion("");
        form.estado(false);
        form.avatar("");
        form.nacimiento("");
        self.municipios([]);
        self.empleado.telefonos([]);
    },


   //editar registros del formulario
    editar: function (data){
        let self = model.empleadoController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

//crear o editar registro, segun condicion if.
    createOrEdit(){
        let self = model.empleadoController;
                if(self.empleado.telefonos().length === 0){
            toastr.error("debe ingresar al menos un numero de teléfono","error");
            return
        }
     //validar formulario
        if (!model.validateForm('#formulario')) { 
            return;
        }

        self.empleado.id() === null ? self.create() : self.update()
    },

//crear registro, manda a llamar el create del service
    create: function () {
        let self = model.empleadoController;
        var data = self.empleado;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        empleadoService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
            self.volverIndex();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

    //funcion para actualizar registro
     update: function () {
        let self = model.empleadoController;
        var data = self.empleado;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        empleadoService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            self.volverIndex();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

//funcion para eliminar registro
    destroy: function (data) {
        let self= model.empleadoController;
        bootbox.confirm({ 
            title: "eliminar empleado",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    empleadoService.destroy(data)
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
    cambiarEstado: function (data) {
        let self= model.empleadoController;
        var title = data.estado ? 'desactivar' : 'activar';
        data.estado = !data.estado;

        bootbox.confirm({ 
            title: title+" empleado",
            message: "¿Esta seguro que quiere " +title+' ' +data.nombre1 +' '+data.apellido1 +"?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    empleadoService.cambiarEstado(data)
                    .then(r => {
                        toastr.info("registro actualizado con éxito",'éxito');
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
        let self = model.empleadoController;
        self.volverIndex();

        model.clearErrorMessage('#formulario');
    },

//funcion para volver al index, resetea variables de bandera
    volverIndex(){
        let self = model.empleadoController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

    //image user profile
    PreviewAvatar: function () {
        let self = model.empleadoController;
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("avatar").files[0]);

        oFReader.onload = function (oFREvent) {
            self.empleado.image_file = oFREvent.target.result;
            document.getElementById("previewAvatar").src = oFREvent.target.result;
        };
    },

    addTelefono(){
        let self = model.empleadoController;
        var numero = self.empleado.telefono();
        self.empleado.telefonos.push({telefono: numero});
        self.empleado.telefono("")
    },

    removeTelefono(telefono){
        let self = model.empleadoController
        var i = self.empleado.telefonos().indexOf(telefono);
        self.empleado.telefonos.splice(i,1);
    },

    getDepartamentos: function(){
        let self = model.empleadoController;
        //llamada al servicio
        departamentoService.getAll()
        .then(r => {
            self.departamentos(r.data);
        })
        .catch(r => {});
    },

    setMunicipios: function(departamento){
        let self = model.empleadoController;
        self.departamentos().forEach(function(d){
            if(d.id == departamento.id){
                self.municipios(d.municipios);
            }
        })
    },

    getEstadosCiviles(){
        let self = model.empleadoController;
        //llamada al servicio
        estadoCivilService.getAll()
        .then(r => {
            self.estadoCiviles(r.data);
        })
        .catch(r => {});
    },

    showFormulario: function(flag){
        let self = model.empleadoController;

        if (!model.validateForm('#formulario')) { 
            toastr.error("por favor los campos del formulario anterior","error");
            return;
        }

        Object.keys(self.flags).forEach(function(key,index) {
            self.flags[key](false)
            if(key === flag){
                self.flags[key](true)
            }
        })
    },

//archivo que se ejecuta al inicio cuando se carga la vista, lista todos los registros
    initialize: function () {
        var self = model.empleadoController;

        //llamada al servicio
        empleadoService.getAll()
        .then(r => {
            self.empleados(r.data);
        })
        .catch(r => {});

        self.getDepartamentos();
        self.getEstadosCiviles();
    }
};
