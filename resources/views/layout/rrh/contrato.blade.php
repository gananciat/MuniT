@extends('layout.main_layout')
@section('content')

<!--Contenido-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">        
  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-md-12" data-bind="visible:model.contratoController.gridMode()">
            <div class="box box-primary">
              <div class="box-header with-border">
                    <h1 class="box-title">contratos <button class="btn btn-success btn-md" id="btnagregar" data-bind="click: model.contratoController.nuevo" ><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                  <div class="box-tools pull-right">
                  </div>
              </div>
              <!-- /.box-header -->
              <!-- centro -->
              <div class="panel-body table-responsive" id="listadoregistros">
                  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                      <th>No. contrato</th>
                      <th>Dpi/Empleado</th>
                      <th>Renglon</th>
                      <th>Monto Final(Q)</th>
                      <th>Fecha inicio / Fin</th>
                      <th>Estado</th>
                      <th>Opciones</th>
                    </thead>
                    <tbody data-bind="dataTablesForEach : {
                            data: model.contratoController.contratos,
                            options: dataTableOptions
                          }">  
                      <tr>
                        <td data-bind="text: no_contrato"></td>
                        <td data-bind="text: empleado.dpi+' - '+empleado.nombre1+' '+empleado.apellido1"></td>
                        <td data-bind="text: tipo_contrato.numero"></td>
                        <td data-bind="text: formatCurrency(parseFloat(monto).toFixed(2))"></td>
                        <td data-bind="text: moment(fecha_inicio).format('DD/MM/YYYY')+' - '+moment(fecha_fin).format('DD/MM/YYYY')"></td>
                        <td>
                          <span class="label" data-bind="text: (deleted_at !== null ? 'Anulado' : (vencido === 0 ? 'Activo' : 'Vencido')), css: (deleted_at !== null ? 'label-danger' : (vencido === 0 ? 'label-success' : 'label-danger'))"></span>
                        </td>
                        <td width="10%" data-bind="if: deleted_at === null && vencido === 0"><span data-toggle="tooltip" title="adjuntar documentos"><a data-toggle="modal" data-target="#documento" class="btn btn-primary btn-xs"> <i class="fa fa-file-archive-o" data-bind="click: model.contratoController.initializeDocumentos"></i></a></span>
                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.contratoController.destroy" data-toggle="tooltip" title="anular contrato"><i class="fa fa-ban"></i></a>
                        </td>
                    </tr>                          
                    </tbody>
                    <tfoot>
                      <th>No. contrato</th>
                      <th>Dpi/Empleado</th>
                      <th>Renglon</th>
                      <th>Monto (Q)</th>
                      <th>Fecha inicio / Fin</th>
                      <th>Estado</th>
                      <th>Opciones</th>
                    </tfoot>
                  </table>
              </div>
            </div><!-- /.box -->
          </div><!-- /.row -->

              <div class="col-md-12">
                <div class="box box-info" data-bind="visible:model.contratoController.insertMode()">
                    <div class="panel-body">
                      <div class="box-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span></button>
                        <h4 data-bind="visible:!model.contratoController.editMode()" class="modal-title"> Nuevo Registro</h4>
                        <h4 data-bind="visible:model.contratoController.editMode()" class="modal-title"> Editar Registro</h4>
                      </div>
                  <div class="col-md-12">
                    <div class="row">
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <label for="empleado">Empleado <span class="text-danger"> *</span></label>
                          <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#select_empleado"><i class="fa fa-plus-square-o"></i> seleccione</a>
                        </div>
                      <div class="col-md-12" data-bind="with: model.contratoController.empleado, visible: model.contratoController.empleadoInfo()">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user">
                          <!-- Add the bg color to the header using any of the bg-* classes -->
                          <div class="widget-user-header bg-aqua-active">
                            <h3 class="widget-user-username" data-bind="text: nombre_completo"></h3>
                            <h5 class="widget-user-desc" data-bind="text: dpi"></h5>
                            <h5 class="widget-user-desc" data-bind="text: genero"></h5>
                          </div>
                          <div class="widget-user-image">
                            <img class="img-responsive img-circle" style="height: 100px;" data-bind="attr:{src: (avatar() !== null && avatar() !== '' ? '/img/'+avatar() : emptyLogo)}" />
                          </div>
                          <div class="box-footer">
                            <div class="row">
                              <div class="col-sm-4 border-right">
                                <div class="description-block">
                                  <h5 class="description-header">edad</h5>
                                  <span class="description-text" data-bind="text: edad() +' años'"></span>
                                </div>
                                <!-- /.description-block -->
                              </div>
                              <!-- /.col -->
                              <div class="col-sm-4 border-right">
                                <div class="description-block">
                                  <h5 class="description-header">no. nit</h5>
                                  <span class="description-text" data-bind="text: nit"></span>
                                </div>
                                <!-- /.description-block -->
                              </div>
                              <!-- /.col -->
                              <div class="col-sm-4">
                                <div class="description-block">
                                  <h5 class="description-header">Estado civil</h5>
                                  <span class="description-text" data-bind="text: estado_civil"></span>
                                </div>
                                <!-- /.description-block -->
                              </div>
                              <!-- /.col -->
                            </div>
                            <!-- /.row -->
                          </div>
                        </div>
                        <!-- /.widget-user -->
                      </div>
                    </div>
                    <form name="formulario" id="formulario" data-bind="with: model.contratoController.contrato">
                      <div class="row">
                        <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-6">
                            <label for="text2">Número <span class="text-danger"> *</span></label>
                                <input type="text" id="nombre" name="nombre" class="form-control"data-bind="value: no_contrato"
                                     data-error=".errorNumero"
                                     minlength="3" maxlength="25" required readonly>
                              <span class="errorNumero text-danger help-inline"></span>
                          </div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <label for="estado_civil">Renglon contrato <span class="text-danger"> *</span></label>
                            <select id="tipo_contrato" class="form-control show-tick selectpicker" data-live-search="true"  
                              data-bind="selectPicker: true,
                              optionsText: function(tipo) {return tipo.numero+' - '+tipo.nombre},
                              optionsValue: 'id',
                              value: tipo_contrato_id, 
                              selectPickerOptions: { optionsArray: model.contratoController.tipo_contratos},
                              optionsCaption: '--selecione renglon--'"
                              data-error=".errorTipo"
                              required>
                                  </select>
                          <span class="errorTipo text-danger help-inline"></span>
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label for="estado_civil">Departamento <span class="text-danger"> *</span></label>
                            <select id="unidad" class="form-control show-tick selectpicker" data-live-search="true"  
                              data-bind="selectPicker: true,
                              optionsText: function(depto) {return depto.nombre},
                              optionsValue: 'cargos',
                              value: model.contratoController.cargos, 
                              selectPickerOptions: { optionsArray: model.contratoController.departamentos},
                              optionsCaption: '--selecione departamento--'"
                              data-error=".errorDepto"
                              required>
                            </select>
                          <span class="errorDepto text-danger help-inline"></span>
                      </div>
                        
                      <div data-bind="if: model.contratoController.cargos() !== undefined" class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <label for="puesto">Puesto <span class="text-danger"> *</span></label>
                            <select id="estado_civil" class="form-control show-tick selectpicker" data-live-search="true"  
                              data-bind="selectPicker: true,
                              optionsText: function(cargo) {return cargo.nombre},
                              optionsValue: 'pivot',
                              value: unidad_cargo, 
                              selectPickerOptions: { optionsArray: model.contratoController.cargos},
                              optionsCaption: '--selecione puesto--'"
                              data-error=".errorCargo"
                              required>
                            </select>
                          <span class="errorCargo text-danger help-inline"></span>
                      </div>
                      </div>
                      <div class="row">
                        
                        <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                          <label for="fecha_nacimiento">Fecha de inicio <span class="text-danger"> *</span></label>
                              <input type="date" id="fecha_nacimiento" name="fecha_inicio" placeholder="ingrese fecha inicio" class="form-control" data-bind="value: fecha_inicio"
                                   data-error=".errorFecha"
                                   minlength="3" maxlength="25" required>
                            <span class="errorFecha text-danger help-inline"></span>
                        </div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                          <label for="fecha_nacimiento">Fecha fin <span class="text-danger"> *</span></label>
                              <input type="date" id="fecha_fin" name="fecha_inicio" placeholder="ingrese fecha fin" class="form-control" data-bind="value: fecha_fin"
                                   data-error=".errorFechaFin"
                                   minlength="3" maxlength="25" required>
                            <span class="errorFechaFin text-danger help-inline"></span>
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xs-12">
                          <label for="fecha_nacimiento">Cantidad pagos <span class="text-danger"> *</span></label>
                              <input type="number" id="cantidad" name="fecha_inicio" placeholder="ingrese cantidad depagos" class="form-control" data-bind="value: cantidad_pagos, event:{change: model.contratoController.setMonto}"
                                   data-error=".errorCantidadPagos" required>
                            <span class="errorFechaFin text-danger help-inline"></span>
                        </div>

                        <div class="form-group col-md-2 col-lg-2">
                            <p class="bold">primer pago: <input type="checkbox" data-bind="checked: isPrimerPago, event:{change: model.contratoController.setMonto}" /></p>
                        </div>
                        <div data-bind="if: isPrimerPago()" class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-12">
                          <label for="primer_pago">Primer pago</label>
                              <input type="number" id="primer_pago" name="salario" placeholder="primer pago" class="form-control" data-bind="value: primer_salario, event:{change: model.contratoController.setMonto}">
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                          <label for="fecha_nacimiento">Pago mensual <span class="text-danger"> *</span></label>
                              <input type="number" id="salario" name="salario" placeholder="ingrese monto mensual" class="form-control" data-bind="value: salario, event:{change: model.contratoController.setMonto}"
                                   data-error=".errorSalario" required>
                            <span class="errorSalario text-danger help-inline"></span>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label for="primer_pago">Monto total de contrato</label>
                              <input type="number" id="monto" name="monto" class="form-control" data-bind="value: monto"
                                   data-error=".erorrMonto" required readonly>
                            <span class="erorrMonto text-danger help-inline"></span>
                        </div>
                      </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <a class="btn btn-primary btn-sm" data-bind="click:  model.contratoController.createOrEdit, visible: model.contratoController.empleadoInfo()"><i class="fa fa-save"></i> Guardar</a>
                          <a class="btn btn-danger btn-sm" data-bind="click: model.contratoController.cancelar"><i class="fa fa-undo"></i> Cancelar</a>
                        </div>

                      </form>
                      <!-- /.tab-content -->
                  </div>
                    </div>
              </div><!-- /.col -->
                    <!--Fin centro -->
        </div><!-- /.col -->
  </section><!-- /.content -->

<div class="modal fade" id="select_empleado" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        Lista de empleados <a class="btn-xs pull-right"><i class="fa fa-close" data-dismiss="modal"></i></a>
      </div>
      <div class="modal-body">
        <div class="panel-body table-responsive" id="listadoregistrosempl">
        <table id="tbllistadoempl" class="table table-striped table-bordered table-condensed table-hover">
          <thead>
            <th>Foto</th>
            <th>Nombres</th>
            <th>Dpi</th>
            <th>Nit</th>
            <th></th>
          </thead>
          <tbody data-bind="dataTablesForEach : {
                  data: model.contratoController.empleados,
                  options: dataTableOptions
                }">  
            <tr>
              <td><img class="profile-user-img img-responsive img-circle" style=" height:50px;" data-bind="attr:{src: (avatar !== null && avatar !== '' ? '/img/'+avatar : emptyLogo)}" /></td>
              <td data-bind="text: nombre1+' '+apellido1"></td>
              <td data-bind="text: dpi"></td>
              <td data-bind="text: nit"></td>
              <td width="15%">
                <a href="#" data-bind="click: model.contratoController.setEmpleado" class="btn btn-primary btn-xs" data-toggle="tooltip" title="seleccionar"><i class="fa fa-check"></i> selecionar</a>
              </td>
          </tr>                          
          </tbody>
          <tfoot>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Dpi</th>
            <th>Nit</th>
            <th></th>
          </tfoot>
        </table>
  </div>
      </div>
      </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="documento" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        Documentos <a class="btn-xs pull-right"><i class="fa fa-close" data-dismiss="modal"></i></a>
      </div>
      <div class="modal-body">
        <div class="panel-body table-responsive" id="listadocs">
          
          <form id="form_doc" name="form_doc" data-bind="with: model.documentoContratoController.documentoContrato">
          <div class="row">
            <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <label for="estado_civil">Tipo documento <span class="text-danger"> *</span></label>
                  <select id="tipo_documento" class="form-control show-tick selectpicker" data-live-search="true"  
                    data-bind="selectPicker: true,
                    optionsText: function(tipo) {return tipo.nombre},
                    optionsValue: 'id',
                    value: tipo_documento_id, 
                    selectPickerOptions: { optionsArray: model.documentoContratoController.tipoDocumentos},
                    optionsCaption: '--selecione tipo documento--'"
                    data-error=".errorTipo"
                    required>
                  </select>
                <span class="errorTipo text-danger help-inline"></span>
            </div>
            <div class="form-group col-lg-8 col-md-8 col-sm-12 col-xs-12">
              <label for="estado_civil">Documento <span class="text-danger"> *</span></label>
              <input type="file" class="form-control"
                           id="doc" dane="doc" placeholder="ingrese documento" value="doc" data-bind="event:{ change: model.documentoContratoController.setDoc}" accept="application/pdf,application">
                <span class="errorDocumento text-danger help-inline"></span>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-12">
              <div>
                <a class="btn btn-success btn-sm" data-bind="click: model.documentoContratoController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
                <a class="btn btn-danger btn-sm" data-bind="click: model.documentoContratoController.cancelar"><i class="fa fa-eraser"></i> Cancelar</a>
              </div>
            </div>
          </div><br />
          </form>
          <table id="tbldocs" class="table table-striped table-bordered table-condensed table-hover">
              <thead>
                <th>Documento</th>
                <th></th>
              </thead>
              <tbody data-bind="dataTablesForEach : {
                      data: model.documentoContratoController.documentoContratos,
                      options: dataTableOptions
                    }">  
                <tr>
                  <td data-bind="text: tipo_documento.nombre"></td>
                  <td><a target="_blank" class="btn btn-primary btn-xs" data-bind="attr: { href: '/documentos/'+doc }"> <i class="fa fa-eye"></i> </a>
                    <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.documentoContratoController.destroy" data-toggle="tooltip" title="eliminar documento"><i class="fa fa-trash-o"></i></a></td>
              </tr>                          
              </tbody>
              <tfoot>
                <th>Tipo documento</th>
                <th></th>
              </tfoot>
            </table>
        </div>
      </div>
      </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

</div><!-- /.content-wrapper -->
<!--Fin-Contenido-->

<script>
        $(document).ready(function () {
            model.contratoController.initialize();
        });
</script>
@endsection