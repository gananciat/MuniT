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
                    <h1 class="box-title">Tipo de usuarios</h1>
                  <div class="box-tools pull-right">
                  </div>
              </div>
              <!-- /.box-header -->
              <!-- centro -->
              <div class="panel-body table-responsive" id="listadoregistros">
                  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="bg-info">
                      <th>Nombre</th>
                    </thead>
                    <tbody>  
                      <!--ko foreach: {data: model.tipoUsuarioController.tipoUsuarios, as: 't'} --> 
                      <tr>
                        <td data-bind="text: t.nombre"></td>
                        <!--<td width="10%">
                            <a data-toggle="modal" data-target="#nuevo" href="#" class="btn btn-warning btn-xs" data-bind="click: model.tipoUsuarioController.editar" data-toggle="tooltip" title="editar"><i class="fa fa-pencil-square-o"></i></a>

                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.tipoUsuarioController.destroy" data-toggle="tooltip" title="eliminar"><i class="fa fa-trash-o"></i></a>
                        </td>-->
                    </tr>  
                    <!-- /ko -->                        
                    </tbody>
                  </table>
              </div>

              <div class="modal fade" id="nuevo" data-backdrop="static">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                      <h4 data-bind="visible:!model.tipoUsuarioController.editMode()" class="modal-title"> Nuevo Registro</h4>
                      <h4 data-bind="visible:model.tipoUsuarioController.editMode()" class="modal-title"> Editar Registro</h4>
                    </div>
                    <div class="modal-body">
                      <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" data-bind="with: model.tipoUsuarioController.tipoUsuario">

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="text2">Nombre <span class="text-danger"> *</span></label>
                                <input type="text" id="nombre" name="nombre" placeholder="ingrese nombre" class="form-control"data-bind="value: nombre"
                                     data-error=".errorNombre"
                                     minlength="3" maxlength="25" required>
                              <span class="errorNombre text-danger help-inline"></span>
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <a class="btn btn-primary btn-sm" data-bind="click:  model.tipoUsuarioController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
                            <a class="btn btn-danger btn-sm" data-bind="click: model.tipoUsuarioController.cancelar" data-dismiss="modal"><i class="fa fa-undo"></i> Cancelar</a>
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
            model.tipoUsuarioController.initialize();
        });
</script>
@endsection