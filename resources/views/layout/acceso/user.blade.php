@extends('layout.main_layout')
@section('content')

<!--Contenido-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">        
  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                    <h1 class="box-title">Usuarios <button class="btn btn-success btn-md" id="btnagregar" data-toggle="modal" data-target="#nuevo" data-bind="model.userController.clearData()" ><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                  <div class="box-tools pull-right">
                  </div>
              </div>
              <!-- /.box-header -->
              <!-- centro -->
              <div class="panel-body table-responsive" id="listadoregistros">
                  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                      <th>Empleado</th>
                      <th>Correo electronico</th>
                      <th>Rol</th>
                      <th>Opciones</th>
                    </thead>
                    <tbody data-bind="dataTablesForEach : {
                            data: model.userController.users,
                            options: dataTableOptions
                          }">  
                      <tr>
                        <td data-bind="text: empleado.nombre1+' '+empleado.apellido1"></td>
                        <td data-bind="text: email"></td>
                        <td data-bind="text: tipo_usuario.nombre"></td>
                        <td width="10%">
                            <a data-toggle="modal" data-target="#nuevo" href="#" class="btn btn-warning btn-xs" data-bind="click: model.userController.editar" data-toggle="tooltip" title="editar"><i class="fa fa-pencil-square-o"></i></a>

                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.userController.destroy" data-toggle="tooltip" title="eliminar"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>                          
                    </tbody>
                    <tfoot>
                      <th>Empleado</th>
                      <th>Correo electronico</th>
                      <th>Rol</th>
                      <th>Opciones</th>
                    </tfoot>
                  </table>
              </div>

              <div class="modal fade" id="nuevo" data-backdrop="static">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                      <h4 data-bind="visible:!model.userController.editMode()" class="modal-title"> Nuevo Registro</h4>
                      <h4 data-bind="visible:model.userController.editMode()" class="modal-title"> Editar Registro</h4>
                    </div>
                    <div class="modal-body">
                      <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" data-bind="with: model.userController.user">
                          <div data-bind="visible:!model.userController.editMode()" class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="text2">Contraseña <span class="text-danger"> *</span></label>
                                <input type="password" id="password" name="password" placeholder="ingrese contrase{a" class="form-control"data-bind="value: password"
                                     data-error=".errorPassword"
                                     minlength="6" maxlength="25" required>
                              <span class="text-danger errorPassword help-inline"></span>
                          </div>
                          <div data-bind="visible:!model.userController.editMode()" class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="text2">Confirmar contraseña <span class="text-danger"> *</span></label>
                                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="ingrese correo electronico" class="form-control"data-bind="value: password_confirmation"
                                     data-error=".errorConfirmation"
                                     minlength="6" maxlength="25" required>
                              <span class="text-danger errorConfirmation help-inline"></span>
                          </div>
                          <div data-bind="visible:!model.userController.editMode()" class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <label for="empleado">Empleado<span class="text-danger"> *</span></label>
                                  <select id="empleado" class="form-control show-tick selectpicker" data-live-search="true"  
                                          data-bind="selectPicker: true,
                                          optionsText: function(empleado) {return empleado.nombre1+' '+empleado.apellido1},
                                          optionsValue: 'id',
                                          value: empleado_id, 
                                          selectPickerOptions: { optionsArray: model.userController.empleados},
                                          optionsCaption: '--selecione empleado--'"
                                          data-error=".errorEmpleado"
                                          required>
                                  </select>
                                  <span class="errorDepartamento text-danger help-inline"></span>
                                </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="empleado">Rol <span class="text-danger"> *</span></label>
                                <select id="empleado" class="form-control show-tick selectpicker" data-live-search="true"  
                                        data-bind="selectPicker: true,
                                        optionsText: function(tipo_usuario) {return tipo_usuario.nombre},
                                        optionsValue: 'id',
                                        value: tipo_usuario_id, 
                                        selectPickerOptions: { optionsArray: model.userController.tipoUsuarios},
                                        optionsCaption: '--selecione rol--'"
                                        data-error=".errorTipo"
                                        required>
                                </select>
                                <span class="errorTipo text-danger help-inline"></span>
                              </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <a class="btn btn-primary btn-sm" data-bind="click:  model.userController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
                            <a class="btn btn-danger btn-sm" data-bind="click: model.userController.cancelar" data-dismiss="modal"><i class="fa fa-undo"></i> Cancelar</a>
                          </div>
                        </form>
                    </div>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!--Fin centro -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->

</div><!-- /.content-wrapper -->
<!--Fin-Contenido-->

<script>
        $(document).ready(function () {
            model.userController.initialize();
        });
</script>
@endsection