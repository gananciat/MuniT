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
                    <h1 class="box-title">municipios <button class="btn btn-success btn-md" id="btnagregar" data-toggle="modal" data-target="#nuevo" data-bind="model.municipioController.clearData()" ><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                  <div class="box-tools pull-right">
                  </div>
              </div>
              <!-- /.box-header -->
              <!-- centro -->
              <div class="panel-body table-responsive" id="listadoregistros">
                  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                      <th>Nombre</th>
                      <th>Departamento</th>
                      <th>Opciones</th>
                    </thead>
                    <tbody data-bind="dataTablesForEach : {
                            data: model.municipioController.municipios,
                            options: dataTableOptions
                          }">  
                      <tr>
                        <td data-bind="text: nombre"></td>
                        <td data-bind="text: departamento.nombre"></td>
                        <td width="10%">
                            <a data-toggle="modal" data-target="#nuevo" href="#" class="btn btn-warning btn-xs" data-bind="click: model.municipioController.editar" data-toggle="tooltip" title="editar"><i class="fa fa-pencil-square-o"></i></a>

                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.municipioController.destroy" data-toggle="tooltip" title="eliminar"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>                          
                    </tbody>
                    <tfoot>
                      <th>Nombre</th>
                      <th>Departamento</th>
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
                      <h4 data-bind="visible:!model.municipioController.editMode()" class="modal-title"> Nuevo Registro</h4>
                      <h4 data-bind="visible:model.municipioController.editMode()" class="modal-title"> Editar Registro</h4>
                    </div>
                    <div class="modal-body">
                      <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" data-bind="with: model.municipioController.municipio">

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="text2">Nombre municipio <span class="text-danger"> *</span></label>
                                <input type="text" id="nombre" name="nombre" placeholder="ingrese nombre" class="form-control"data-bind="value: nombre"
                                     data-error=".errorNombre"
                                     minlength="3" maxlength="25" required>
                              <span class="errorNombre text-danger help-inline"></span>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <label for="departamento">Departamento<span class="text-danger"> *</span></label>
                                  <select id="departamento" class="form-control show-tick selectpicker" data-live-search="true"  
                                          data-bind="selectPicker: true,
                                          optionsText: function(departamento) {return departamento.nombre},
                                          optionsValue: 'id',
                                          value: departamento_id, 
                                          selectPickerOptions: { optionsArray: model.municipioController.departamentos},
                                          optionsCaption: '--selecione departamento--'"
                                          data-error=".errorDepartamento"
                                          required>
                                  </select>
                                  <span class="errorDepartamento text-danger help-inline"></span>
                                </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <a class="btn btn-primary btn-sm" data-bind="click:  model.municipioController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
                            <a class="btn btn-danger btn-sm" data-bind="click: model.municipioController.cancelar" data-dismiss="modal"><i class="fa fa-undo"></i> Cancelar</a>
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
            model.municipioController.initialize();
        });
</script>
@endsection