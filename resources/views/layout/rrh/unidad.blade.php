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
                    <h1 class="box-title">Unidades (departamentos) <button class="btn btn-success btn-md" id="btnagregar" data-toggle="modal" data-target="#nuevo" data-bind="model.unidadController.clearData()" ><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                  <div class="box-tools pull-right">
                  </div>
              </div>
              <!-- /.box-header -->
              <!-- centro -->
              <div class="panel-body table-responsive" id="listadoregistros">
                  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                      <th>Nombre</th>
                      <th>Opciones</th>
                    </thead>
                    <tbody data-bind="dataTablesForEach : {
                            data: model.unidadController.unidads,
                            options: dataTableOptions
                          }">  
                      <tr>
                        <td data-bind="text: nombre"></td>
                        <td width="30%">
                          <span data-toggle="modal" data-target="#puestos">
                              <a data-bind="click: model.unidadController.editCargo" href="#" class="btn btn-info btn-xs" data-toggle="tooltip" title="vizualizar o eliminar puestos laborales"><i class="fa fa-eye"></i> puestos</a>
                          </span>
                          <span data-toggle="modal" data-target="#nuevo">
                              <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.unidadController.editar" data-toggle="tooltip" title="editar"><i class="fa fa-pencil-square-o"></i></a>
                          </span>
                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.unidadController.destroy" data-toggle="tooltip" title="eliminar"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>                          
                    </tbody>
                    <tfoot>
                      <th>Nombre</th>
                      <th>Opciones</th>
                    </tfoot>
                  </table>
              </div>

              <div class="modal fade" id="nuevo" data-backdrop="static">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                      <h4 data-bind="visible:!model.unidadController.editMode()" class="modal-title"> Nuevo Registro</h4>
                      <h4 data-bind="visible:model.unidadController.editMode()" class="modal-title"> Editar Registro</h4>
                    </div>
                    <div class="modal-body">
                      <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" data-bind="with: model.unidadController.unidad">
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="text2">Nombre <span class="text-danger"> *</span></label>
                                <input type="text" id="nombre" name="nombre" placeholder="ingrese nombre" class="form-control"data-bind="value: nombre"
                                     data-error=".errorNombre"
                                     minlength="3" maxlength="25" required>
                              <span class="errorNombre text-danger help-inline"></span>
                          </div>

                          <div data-bind="visible:!model.unidadController.editMode()">
                            <div class="form-group col-sm-6 col-md-6">
                                <label>asignar puestos laborales<span class="text-danger"> *</span></label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <input class="form-control" placeholder="buscar por nombre" data-bind="value: model.unidadController.search, valueUpdate: 'keyup'" autocomplete="off">
                            </div>
                            <div class="row col-md-12 col-sm-12">
                                  <!-- ko foreach: {data: model.unidadController.filterSearch, as: 'c'} -->
                                  <div class="col-sm-4 col-md-4">
                                      <div class="checkbox">
                                          <label>
                                              <input type="checkbox" value="" data-bind="value: c.id, checked: model.unidadController.unidad.cargos()"><span data-bind="text: c.nombre"></span>
                                          </label>
                                      </div>
                                  </div>
                                  <!-- /ko -->

                              </div>
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"><br />
                            <a class="btn btn-primary btn-sm" data-bind="click:  model.unidadController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
                            <a class="btn btn-danger btn-sm" data-bind="click: model.unidadController.cancelar" data-dismiss="modal"><i class="fa fa-undo"></i> Cancelar</a>
                          </div>
                        </form>
                    </div>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-unidadlog -->
              </div>
              <!--Fin centro -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->

<!-- Modal -->
<div id="puestos" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Puestos Laborales <span data-bind="text: model.unidadController.unidad.nombre()"></span></h4>
      </div>
      <div class="modal-body">
        <form name="formularioU" id="formularioU" data-bind="with: model.unidadController.cargo">
          <div class="form-group col-lg-8 col-md-9 col-sm-10 col-xs-10">
                <select id="cargo" name="puesto_laboral" class="form-control show-tick selectpicker" data-live-search="true"  
                        data-bind="selectPicker: true,
                        optionsText: function(cargo) {return cargo.nombre},
                        optionsValue: 'id',
                        value: cargo_id, 
                        selectPickerOptions: { optionsArray: model.unidadController.cargos},
                        optionsCaption: '--selecione puesto laboral--'"
                        data-error=".errorCargo"
                        required>
                </select>
                <span class="errorCargo text-danger help-inline"></span>
            </div><button data-bind="click: model.unidadController.createCargo" class="btn btn-success"> <i class="fa fa-plus-square-o"></i></button>
        </form>
        <div class="col-sm-12 col-md-12">
            <label>detalle de puestos laborales</label>
        </div>
        <div class="panel-body table-responsive" id="listadoregistros">
                  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                      <th>Nombre</th>
                      <th></th>
                    </thead>
                    <tbody> 
                    <!--ko foreach: {data: model.unidadController.unidadCargos, as: 'uc'} --> 
                      <tr>
                        <td data-bind="text: uc.nombre"></td>
                        <td width="10%">
                            <a href="#" class="btn btn-danger btn-xs" data-toggle="tooltip" data-bind="click: model.unidadController.destroyCargo" title="eliminar"><i class="fa fa-minus"></i></a>
                        </td>
                    </tr>   
                    <!-- /ko -->                       
                    </tbody>
                  </table>
              </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> <i class="fa fa-undo"></i> volver</button>
      </div>
    </div>

  </div>
</div>

</div><!-- /.content-wrapper -->
<!--Fin-Contenido-->

<script>
        $(document).ready(function () {
            model.unidadController.initialize();
        });
</script>
@endsection