@extends('layout.main_layout')
@section('content')

<!--Contenido-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">        
  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-md-12">
            <div class="box box-primary" data-bind="visible:model.empleadoController.gridMode()">
              <div class="box-header with-border">
                    <h1 class="box-title">empleados <button class="btn btn-success btn-md" id="btnagregar" data-bind="click: model.empleadoController.nuevo" ><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                  <div class="box-tools pull-right">
                  </div>
              </div>
              <!-- /.box-header -->
              <!-- centro -->
              <div class="panel-body table-responsive" id="listadoregistros">
                  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                      <th>Foto</th>
                      <th>Nombres</th>
                      <th>Dpi</th>
                      <th>Nit</th>
                      <th>Estado</th>
                      <th>Opciones</th>
                    </thead>
                    <tbody data-bind="dataTablesForEach : {
                            data: model.empleadoController.empleados,
                            options: dataTableOptions
                          }">  
                      <tr>
                        <td><img class="profile-user-img img-responsive img-circle" style=" height:90px;" data-bind="attr:{src: (avatar !== null && avatar !== '' ? '/img/'+avatar : emptyLogo)}" /></td>
                        <td data-bind="text: nombre1+' '+apellido1"></td>
                        <td data-bind="text: dpi"></td>
                        <td data-bind="text: nit"></td>
                        <td><span class="label" data-bind="text: (estado === 1 ? 'Activo' : 'Inactivo'), css: (estado === 1 ? 'label-primary' : 'label-danger')"></span></td>
                        <td width="15%">

                          <a data-toggle="tooltip" title="ver información" class="btn btn-info btn-xs" data-bind="attr: { href: '/perfil?id='+id }"><i class="fa fa-eye"></i></a>

                            <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.empleadoController.editar" data-toggle="tooltip" title="editar"><i class="fa fa-pencil-square-o"></i></a>

                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.empleadoController.destroy" data-toggle="tooltip" title="eliminar"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>                          
                    </tbody>
                    <tfoot>
                      <th>Foto</th>
                      <th>Nombre</th>
                      <th>Dpi</th>
                      <th>Nit</th>
                      <th>Estado</th>
                      <th>Opciones</th>
                    </tfoot>
                  </table>
              </div>
              <!--Fin centro -->
            </div><!-- /.box -->
        </div>
        <div class="col-md-12">
          <div class="box box-info" data-bind="visible:model.empleadoController.insertMode()">
              <div class="panel-body">
                <div class="box-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                  <h4 data-bind="visible:!model.empleadoController.editMode()" class="modal-title"> Nuevo Registro</h4>
                  <h4 data-bind="visible:model.empleadoController.editMode()" class="modal-title"> Editar Registro</h4>
                </div>
            <div class="col-md-12">
              <!-- Custom Tabs -->
                 <div class="row">
                  <div class="col-md-12">
                    <a class="btn btn-primary btn-flat btn-xs" data-bind="click: function(data, event) { model.empleadoController.showFormulario('showPersonal', data, event) }"> <i class="fa fa-info"></i> datos personales</a>
                    <a class="btn btn-warning btn-flat btn-xs" data-bind="click: function(data, event) { model.empleadoController.showFormulario('showContacto', data, event) }"> <i class="fa fa-map-marker"></i> Datos de contacto</a>
                  </div>
                </div>

              <form name="formulario" id="formulario" data-bind="with: model.empleadoController.empleado">
                <div class="tab-content content">
                  <div data-bind="visible: model.empleadoController.flags.showPersonal()" id="personal">

                  <div class="col-md-12">
                    <h1 class="box-title"> Datos personales</h1>
                  </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label for="avatar">Foto</label>
                      <input accept="image/x-png,image/gif,image/jpeg" type="file" class="form-control"
                           id="avatar" dane="avatar" placeholder="ingrese foto" value="avatar" data-bind="event:{ change: model.empleadoController.PreviewAvatar}"><br />
                        <div class="box box-primary box-solid text-info">
                          <img class="img-responsive pad" data-bind="attr:{src: (avatar() !== null ? ( avatar() !== '' ? '/img/'+avatar() : emptyLogo ) : emptyLogo)}" style="height: 300px; width: 100%" id="previewAvatar" src="#" alt="fotografia" />
                        </div>
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label for="dpi">DPI <span class="text-danger"> *</span></label>
                            <input type="text" id="dpi" name="dpi" placeholder="ingrese dpi" class="form-control" data-bind="value: dpi"
                                 data-error=".errorDpi"
                                 minlength="3" maxlength="25" required>
                          <span class="errorDpi text-danger help-inline"></span>
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label for="nit">NIT <span class="text-danger"> *</span></label>
                            <input type="number" id="nit" name="nit" placeholder="ingrese nit" class="form-control"data-bind="value: nit"
                                 data-error=".errorNit"
                                 minlength="3" maxlength="15" required>
                          <span class="errorNit text-danger help-inline"></span>
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label for="text2">Primer Nombre <span class="text-danger"> *</span></label>
                            <input type="text" id="nombre" name="nombre" placeholder="ingrese nombre1" class="form-control" data-bind="value: nombre1"
                                 data-error=".errorNombre"
                                 minlength="3" maxlength="25" required>
                          <span class="errorNombre text-danger help-inline"></span>
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label for="nombre2">Segundo nombre</label>
                            <input type="text" id="nombre2" name="nombre2" placeholder="ingrese nombre" class="form-control" data-bind="value: nombre2">
                      </div>

                      <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label for="apellido1">Primer Apellido <span class="text-danger"> *</span></label>
                            <input type="text" id="apellido1" name="apellido1" placeholder="ingrese primer apellido" class="form-control" data-bind="value: apellido1"
                                 data-error=".errorApellido"
                                 minlength="3" maxlength="25" required>
                          <span class="errorApellido text-danger help-inline"></span>
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label for="apellido2">Segundo Apellido</label>
                            <input type="text" id="apellido2" name="apellido2" placeholder="ingrese segundo apellido" class="form-control" data-bind="value: apellido2">
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label for="fecha_nacimiento">Fecha de nacimiento <span class="text-danger"> *</span></label>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" placeholder="ingrese primer apellido" class="form-control"data-bind="value: nacimiento"
                                 data-error=".errorFecha"
                                 minlength="3" maxlength="25" required>
                          <span class="errorFecha text-danger help-inline"></span>
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label for="estado_civil">Estado civil <span class="text-danger"> *</span></label>
                            <select id="estado_civil" class="form-control show-tick selectpicker" data-live-search="true"  
                              data-bind="selectPicker: true,
                              optionsText: function(estado) {return estado.nombre},
                              optionsValue: 'id',
                              value: estado_civil_id, 
                              selectPickerOptions: { optionsArray: model.empleadoController.estadoCiviles},
                              optionsCaption: '--selecione estado civil--'"
                              data-error=".errorEstado"
                              required>
                                  </select>
                          <span class="errorEstado text-danger help-inline"></span>
                      </div>
                      <div class="col-lg-4">
                        <label for="text2">Genero</label>
                           <select class="form-control" id="rol" data-bind="options: model.empleadoController.generos, optionsText: 'nombre', optionsValue: 'valor',
                           optionsCaption: '--seleccione--',
                           value: genero" 
                           data-error=".errorGenero"
                          required></select>
                          <span class="errorGenero text-danger help-inline"></span>
                        </div>
                        <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label for="apellido1">Profesión <span class="text-danger"> *</span></label>
                            <input type="text" id="profesion" name="apellido1" placeholder="ingrese profesion" class="form-control" data-bind="value: profesion"
                                 data-error=".errorProfesion"
                                 minlength="5" maxlength="500" required>
                          <span class="errorProfesion text-danger help-inline"></span>
                      </div>
                  </div>
                  
                  <!-- /.tab-pane -->
                  <div data-bind="visible: model.empleadoController.flags.showContacto()" id="contacto">

                      <div class="col-md-12 col-lg-12 col-sm-12">
                        <h1 class="box-title"> Datos de contacto</h1>
                      </div>
                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label for="email">Correo electronico <span class="text-danger"> *</span></label>
                            <input type="email" id="email" name="email" placeholder="ingrese correo electronico" class="form-control"data-bind="value: email"
                                 data-error=".errorEmail"
                                 minlength="3" maxlength="25" required>
                          <span class="errorEmail text-danger help-inline"></span>
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                              <label for="departamento">Departamento<span class="text-danger"> *</span></label>
                                  <select id="departamento" name="departamento" class="form-control show-tick selectpicker" data-live-search="true"  
                                          data-bind="selectPicker: true,
                                          optionsText: function(departamento) {return departamento.nombre},
                                          optionsValue: 'municipios',
                                          value: model.empleadoController.municipios, 
                                          selectPickerOptions: { optionsArray: model.empleadoController.departamentos},
                                          optionsCaption: '--selecione departamento--'">
                                  </select>
                                </div>
                      <div data-bind="if: model.empleadoController.municipios() !== undefined" class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label for="municipio">Municipio <span class="text-danger"> *</span></label>
                            <select id="municipio" name="departamento" class="form-control show-tick selectpicker" data-live-search="true"  
                              data-bind="selectPicker: true,
                              optionsText: function(municipio) {return municipio.nombre},
                              optionsValue: 'id',
                              value: municipio_id, 
                              selectPickerOptions: { optionsArray: model.empleadoController.municipios},
                              optionsCaption: '--selecione municipio--'"
                              data-error=".errorMunicipio"
                              required>
                            </select>
                          <span class="errorMunicipio text-danger help-inline"></span>
                      </div>
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label for="text2">Dirección especifica <span class="text-danger"> *</span></label>
                            <input type="text" id="direccion" name="direccion" placeholder="ingrese direccion" class="form-control"data-bind="value: direccion"
                                 data-error=".errorDireccion"
                                 minlength="3" maxlength="50" required>
                          <span class="errorDireccion text-danger help-inline"></span>
                      </div>
                      <div class="form-group col-lg-4 col-md-4">
                            <label> telefonos</label>
                            <div class="input-group input-group-md">
                              <input type="text" class="form-control" data-bind="value: telefono">
                                  <span class="input-group-btn">
                                    <button data-bind="click: model.empleadoController.addTelefono" type="button" class="btn btn-success btn-flat"> <i class="fa fa-plus"></i></button>
                                  </span>
                            </div>
                        </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label> telefonos agregados</label>
                            <table class="table table-responsive table-bordered table-hover">
                              <thead class="box box-primary">
                                <tr>
                                  <th>Telefono</th>
                                </tr>
                              </thead>
                              <tbody>
                                <!-- ko foreach: {data: model.empleadoController.empleado.telefonos, as: 'a'} -->
                                <tr>
                                  <td data-bind="text: a.telefono"></td>
                                  <td><a href="#" class="btn btn-danger btn-xs" data-bind="click: model.empleadoController.removeTelefono" data-toggle="tooltip" title="remover"><i class="fa fa-minus"></i></a></td>
                                </tr>
                                <!-- /ko -->
                                <tr data-bind="if: model.empleadoController.empleado.telefonos().length === 0">
                                  <td class="text-center"> ningun telefono agregado</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>

                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <a class="btn btn-primary btn-sm" data-bind="click:  model.empleadoController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
                        <a class="btn btn-danger btn-sm" data-bind="click: model.empleadoController.cancelar"><i class="fa fa-undo"></i> Cancelar</a>
                      </div>
                  </div>
                </div>

                </form>
                <!-- /.tab-content -->
            </div>
              </div>
        </div><!-- /.col -->
        </div>
    </div><!-- /.row -->
</section><!-- /.content -->

</div><!-- /.content-wrapper -->
<!--Fin-Contenido-->

<script>
        $(document).ready(function () {
            model.empleadoController.initialize();
        });
</script>
@endsection