//controller que se encarga de interactuar con la vista y con los servicios axios
model.userController = {

    user: {
        id: ko.observable(null),
        empleado_id: ko.observable(null),
        tipo_usuario_id: ko.observable(null),
        email: ko.observable(""),
        password: ko.observable(""),
        password_confirmation: ko.observable("")
    },

    users: ko.observableArray([]),
    tipoUsuarios: ko.observableArray([]),
    empleados: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.userController.user;
        form.id(data.id);
        form.empleado_id(data.empleado_id);
        $('#empleado_id').selectpicker('refresh');
        form.tipo_usuario_id(data.tipo_usuario_id);
        $('#tipo_usuario').selectpicker('refresh');
        form.email(data.email);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.userController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },
   //limpiar formulario
    clearData: function(){
       let self = model.userController;

        Object.keys(self.user).forEach(function(key,index) {
          if(typeof self.user[key]() === "string") 
            self.user[key]("")
          else if (typeof self.user[key]() === "boolean") 
            self.user[key](true)
          else if (typeof self.user[key]() === "number") 
            self.user[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.userController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.userController;

     //validar formulario
        if (!model.validateForm('#formulario')) { 
            return;
        }

        self.user.id() === null ? self.create() : self.update()
    },
//crear o editar registro, segun condicion if.
    create: function () {
        let self = model.userController;

        var validator = $("#formulario").validate({
            rules: {
                password: "required",
                password_confirmation: {
                    equalTo: "#password"
                }
            },
            messages: {
                password: "la contraseña es obligatoria",
                confirmpassword: " Las contraseñas no coinciden"
            }
        });


        if (!validator.form()) {
            return
        }

        var data = self.user;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        userService.create(dataParams)
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
        let self = model.userController;
        var data = self.user;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        userService.update(dataParams)
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
        let self= model.userController;
        bootbox.confirm({ 
            title: "eliminar user",
            message: "¿Esta seguro que quiere eliminar " + data.email + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    userService.destroy(data)
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
        let self = model.userController;
        self.volverIndex();

        model.clearErrorMessage('#formulario');
    },
//funcion para cancelar registro
    volverIndex(){
        let self = model.userController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },
//funcion para volver al index, resetea variables de bandera
    getTipoUsuarios: function(){
        var self = model.userController;
        //llamada al servicio
        tipoUsuarioService.getAll()
        .then(r => {
            self.tipoUsuarios(r.data);
        })
        .catch(r => {});
    },

    //funcion para volver al index, resetea variables de bandera
    getEmpleados: function(){
        var self = model.userController;
        //llamada al servicio
        empleadoService.getAll()
        .then(r => {
            self.empleados(r.data);
        })
        .catch(r => {});
    },

    getAll: function(){
        let self = model.userController;
        //llamada al servicio
        userService.getAll()
        .then(r => {
            self.users(r.data);
            self.getEmpleados();
        })
        .catch(r => {});
    },
//archivo que se ejecuta al inicio cuando se carga la vista, lista todos los registros
    initialize: function () {
        var self = model.userController;

        //llamada al servicio
        self.getAll();

        self.getTipoUsuarios();
    }
};