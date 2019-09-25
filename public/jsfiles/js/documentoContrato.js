//controller que se encarga de interactuar con la vista y con los servicios axios
model.documentoContratoController = {

    documentoContrato: {
        id: ko.observable(null),
        doc: ko.observable(""),
        contrato_id: ko.observable(null),
        tipo_documento_id: ko.observable(null)
    },

    documentoContratos: ko.observableArray([]),
    tipoDocumentos: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.documentoContratoController.documentoContrato;
        form.id(data.id);
        form.contrato_id(data.contrato_id);
        form.tipo_documento_id(data.tipo_documento_id);
        form.doc(data.doc);
    },

  //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.documentoContratoController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    //limpiar formulario
    clearData: function(){
       let self = model.documentoContratoController;

       let form = self.documentoContrato;
       form.tipo_documento_id(null);
       form.doc("");
       document.getElementById("doc").value = "";
    },


   //editar registros del formulario
    editar: function (data){
        let self = model.documentoContratoController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

//crear o editar registro, segun condicion if.
    createOrEdit(){
        let self = model.documentoContratoController;
     //validar formulario
        if (!model.validateForm('#form_doc')) { 
            return;
        }

        self.documentoContrato.id() === null ? self.create() : self.update()
    },

//crear registro, manda a llamar el create del service
    create: function () {
        let self = model.documentoContratoController;
        var data = self.documentoContrato;
        var dataParams = ko.toJS(data);

        dataParams.doc = document.getElementById('doc').files[0];
        // input where the files were uploaded to
        var formData = self.getFormData(dataParams);

        //llamada al servicio
        documentoContratoService.create(formData)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
           $('#documento').modal('hide'); 
           self.clearData();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

    getFormData: function(object) {
        const formData = new FormData();
        Object.keys(object).forEach(key => formData.append(key, object[key]));
        return formData;
    },

    /*funcion para actualizar registro
     update: function () {
        let self = model.documentoContratoController;
        var data = self.documentoContrato;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        documentoContratoService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            $('#nuevo').modal('hide');
            self.volverIndex();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },*/

//funcion para eliminar registro
    destroy: function (data) {
        let self= model.documentoContratoController;
        bootbox.confirm({ 
            title: "eliminar documentoContrato",
            message: "¿Esta seguro que quiere eliminar documento" + data.tipo_documento.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    documentoContratoService.destroy(data)
                    .then(r => {
                        toastr.info("registro eliminado éxito",'éxito');
                        self.initialize(data.contrato_id);
                        self.clearData();
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
        let self = model.documentoContratoController;
        self.clearData();

        model.clearErrorMessage('#form_doc');
    },

//funcion para volver al index, resetea variables de bandera
    volverIndex(contrato_id){
        let self = model.documentoContratoController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true);
        self.clearData();
        self.initialize(contrato_id);
    },

    getTipoDocumentos: function(){
        let self = model.documentoContratoController;
        //llamada al servicio
        tipoDocumentoService.getAll()
        .then(r => {
            self.tipoDocumentos(r.data);
        })
        .catch(r => {});
    },

    //documento, preview
    setDoc: function () {
        let self = model.documentoContratoController;
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("doc").files[0]);

        oFReader.onload = function (oFREvent) {
            self.documentoContrato.documento = oFREvent.target.result;
        };
    },

//archivo que se ejecuta al inicio cuando se carga la vista, lista todos los registros
    initialize: function (contrato_id) {
        var self = model.documentoContratoController;
        self.documentoContrato.contrato_id(contrato_id);

        //llamada al servicio
        contratoService.getDocs(contrato_id)
        .then(r => {
            self.documentoContratos(r.data);
        })
        .catch(r => {});

        self.getTipoDocumentos();
    }
};