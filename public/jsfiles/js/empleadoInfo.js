//controller que se encarga de interactuar con la vista y con los servicios axios
model.empleadoInfoController = {
    empleado: {
        id: ko.observable(null),
        nombre_completo: ko.observable(""),
        edad: ko.observable(""),
        fecha_ingreso: ko.observable(""),
        departamento: ko.observable(""),
        cargo: ko.observable(""),
        avatar: ko.observable(""),
        dpi: ko.observable(""),
        estado_civil: ko.observable(""),
        nit: ko.observable(""),
        genero: ko.observable(""),
        direccion: ko.observable(""),
        profesion: ko.observable(""),
        estado: ko.observable(""),
        email: ko.observable(""),
        telefonos: ko.observableArray([])
    },

    usuario: {
        id: ko.observable(null),
        email: ko.observable(""),
        rol: ko.observable(""),
        old_password: ko.observable(""),
        password: ko.observable(""),
        password_confirmation: ko.observable("")
    },

    contratos: ko.observableArray([]),
    showUser: ko.observable(false),
    userLogged: ko.observable(null),

    setEmpleado: function(empleado){
        let self = model.empleadoInfoController;
        var nombre2 = empleado.nombre2 !== null ? empleado.nombre2 : '';
        var apellido2 = empleado.apellido2 !== null ? empleado.apellido2 : '';

        self.empleado.id(empleado.id);
        self.empleado.nombre_completo(empleado.nombre1+' '+nombre2+' '+empleado.apellido1+' '+apellido2);
        self.empleado.dpi(empleado.dpi);
        self.empleado.nit(empleado.nit);
        self.empleado.avatar(empleado.avatar);
        self.empleado.estado_civil(empleado.estado_civil.nombre);
        self.empleado.edad(moment().diff(empleado.nacimiento, 'years',false));
        empleado.genero === 'M' ? self.empleado.genero('Masculino') : self.empleado.genero('Femenino');
        self.empleado.direccion(empleado.direccion+', '+empleado.municipio.nombre+', '+empleado.municipio.departamento.nombre);
        self.empleado.profesion(empleado.profesion);
        self.empleado.telefonos(empleado.telefonos);
        self.empleado.estado(empleado.estado);
        self.empleado.email(empleado.email);

        empleado.contratos.forEach(function(c){
            if(!c.vencido && c.deleted_at === null){
                self.empleado.cargo(c.unidad_cargo.cargo.nombre);
                self.empleado.departamento(c.unidad_cargo.unidad.nombre);
            }
        })

         

        if(empleado.usuario !== null){
            self.usuario.email(empleado.usuario.email);
            self.usuario.id(empleado.usuario.id);
            self.usuario.rol(empleado.usuario.tipo_usuario.nombre);  

            if(self.userLogged() === empleado.usuario.id){
                self.showUser(true);    
            }
        }

        self.contratos(empleado.contratos);
    },

    cancelar: function(){
        let self = model.empleadoInfoController;
        self.usuario.old_password("");
        self.usuario.password("");
        self.usuario.password_confirmation("");
        model.clearErrorMessage('#changeForm');
    },

    cambiar: function(){
        let self = model.empleadoInfoController;
        var validator = $("#changeForm").validate({
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

        var data = self.usuario;
        var dataParams = ko.toJS(data);
        userService.cambiarContraseña(dataParams)
        .then(r => {
            toastr.info('contraseña modificada con éxito','exito')
            self.cancelar();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

//archivo que se ejecuta al inicio cuando se carga la vista, lista todos los registros
    initialize: function (id) {
        var self = model.empleadoInfoController;
        //llamada al servicio
        empleadoService.get(id)
        .then(r => {
            self.setEmpleado(r.data)
        })
        .catch(r => {});
    }
};