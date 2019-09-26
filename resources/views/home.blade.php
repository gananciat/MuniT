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
                          <h1 class="box-title">Dashboard </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body">
                      
                    <div class="row">
                      <div class="col-md-4">
                        <div class="small-box bg-green">
                          <div class="inner">
                            <h3>{{ count($contratos_activo) }}</h3>
                            <p>Contratos Activos</p>
                          </div>
                          <div class="icon">
                            <i class="fa fa-file-pdf-o"></i>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="small-box bg-red">
                          <div class="inner">
                            <h3>{{ count($contratos_inactivo) }}</h3>
                            <p>Contratos Inactivos</p>
                          </div>
                          <div class="icon">
                            <i class="fa fa-file-pdf-o"></i>
                          </div>                          
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="small-box bg-aqua">
                          <div class="inner">
                            <h3>{{ count($contratos) }}</h3>
                            <p>Contratos realizados</p>
                          </div>
                          <div class="icon">
                            <i class="fa fa-file-pdf-o"></i>
                          </div>                          
                        </div>
                      </div>                      
                    </div>                    
                      <div class="row">
                        <div class="col-md-12"> 
                          <h1 class="box-title text-center">Contratos realizados en el año {{ date('Y') }} </h1>
                          <div class="chart-area">
                              <canvas id="graficaContratosMeses"></canvas>
                          </div>                        
                        </div>
                        <br>
                        <div class="col-md-12"> 
                          <h1 class="box-title text-center">Cantidad de personal contrado por unidad </h1>
                          <div class="chart-area">
                              <canvas id="graficaUnidadCargo"></canvas>
                          </div>                        
                        </div>  
                        <br>
                        <div class="col-md-6" style="text-align:center;"> 
                          <h1 class="box-title text-center">Cantidad de empleados por estado </h1>
                          <div class="chart-area text-center">
                              <canvas id="graficaEstadoEmpleado"></canvas>
                          </div>                        
                        </div>    
                        <div class="col-md-6" style="text-align:center;"> 
                          <h1 class="box-title text-center">Cantidad de tipo de contratos realizados </h1>
                          <div class="chart-area">
                              <canvas id="graficaTipoContrato"></canvas>
                          </div>                        
                        </div>                                                                  
                      </div>

                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->

  <script src="{{ asset('js/Chart.min.js') }}"></script>
<script>

    var ejecuto = false;    
    $(function() {
        if(ejecuto === false)
        {
            ejecuto = true;
            $.get('grafica/contratos/mes', function(data){
                cargar_informacion_grafica_contratos_meses(data.grafica,data.label);
            });      
            
            $.get('grafica/contratos/unidad_argo', function(data){
                cargar_informacion_grafica_contratos_unidades_cargos(data.grafica,data.label);
            });     
            
            $.get('grafica/contratos/estado_empleado', function(data){
                cargar_informacion_grafica_contratos_estado_empleado(data.grafica,data.label);
            });  
            
            $.get('grafica/contratos/tipos_contratos', function(data){
                cargar_informacion_grafica_contratos_tipo_contrato(data.grafica,data.label);
            });            
        }
    })

    function cargar_informacion_grafica_contratos_meses(dato_grafica, label_grafica)
    {
        var ctx = document.getElementById("graficaContratosMeses").getContext("2d");

        window.chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(231,233,237)'
        }; 


        gradientChartOptionsConfiguration =  {
            maintainAspectRatio: false,
            legend: {
                display: false
            },

            tooltips: {
                backgroundColor: '#fff',
                titleFontColor: '#333',
                bodyFontColor: '#666',
                bodySpacing: 4,
                xPadding: 12,
                mode: "nearest",
                intersect: 0,
                position: "nearest"
            },

            responsive: true,

            scales:{
                yAxes: [{
                    ticks: {
                        suggestedMin:0,
                        padding: 20,
                        fontColor: "#9a9a9a"
                    }
                }],
            }             
        };

        var data = {
            labels: label_grafica,
            datasets: [{
                label: "Contratos",
                backgroundColor: [
                    window.chartColors.red,
                    window.chartColors.orange,
                    window.chartColors.yellow,
                    window.chartColors.green,
                    window.chartColors.blue,
                ],                  
                fill: true,
                borderColor: '#d058b6',
                borderWidth: 2,
                data: dato_grafica,
            }]
        };  

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: gradientChartOptionsConfiguration
        });                      
    }  

    function cargar_informacion_grafica_contratos_unidades_cargos(dato_grafica, label_grafica)
    {
        var ctx = document.getElementById("graficaUnidadCargo").getContext("2d");

        window.chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(231,233,237)'
        }; 


        gradientChartOptionsConfiguration =  {
            maintainAspectRatio: false,
            legend: {
                display: false
            },

            tooltips: {
                backgroundColor: '#fff',
                titleFontColor: '#333',
                bodyFontColor: '#666',
                bodySpacing: 4,
                xPadding: 12,
                mode: "nearest",
                intersect: 0,
                position: "nearest"
            },

            responsive: true,

            scales:{
                yAxes: [{
                    ticks: {
                        suggestedMin:0,
                        padding: 20,
                        fontColor: "#9a9a9a"
                    }
                }],
            }             
        };

        var data = {
            labels: label_grafica,
            datasets: [{
                label: "Empleados en la unidad",
                backgroundColor: [
                    window.chartColors.red,
                    window.chartColors.orange,
                    window.chartColors.yellow,
                    window.chartColors.green,
                    window.chartColors.blue,
                ],                  
                fill: true,
                borderColor: '#d058b6',
                borderWidth: 2,
                data: dato_grafica,
            }]
        };  

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: gradientChartOptionsConfiguration
        });                      
    }    

    function cargar_informacion_grafica_contratos_estado_empleado(dato_grafica, label_grafica)
    {
        var ctx = document.getElementById("graficaEstadoEmpleado").getContext("2d");

        window.chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(231,233,237)'
        };        

        gradientChartOptionsConfiguration =  {
            legend: {
                display: true,
                labels: {
                    padding: 20
                },
            },

            tooltips: {
                backgroundColor: '#fff',
                titleFontColor: '#333',
                bodyFontColor: '#666',
                bodySpacing: 4,
                xPadding: 12,
                mode: "nearest",
                intersect: 0,
                position: "nearest"
            },
            responsive: true,           
        };

        var data = {
            labels: label_grafica,
            datasets: [{
                label: "Empleados",
                backgroundColor: [
                    window.chartColors.red,
                    window.chartColors.orange,
                    window.chartColors.yellow,
                    window.chartColors.green,
                    window.chartColors.blue,
                ],                
                data: dato_grafica,
            }]
        };  

        var myChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: gradientChartOptionsConfiguration
        });                      
    }     

    function cargar_informacion_grafica_contratos_tipo_contrato(dato_grafica, label_grafica)
    {
        var ctx = document.getElementById("graficaTipoContrato").getContext("2d");

        window.chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(231,233,237)'
        };        

        gradientChartOptionsConfiguration =  {
            legend: {
                display: true,
                labels: {
                    padding: 20
                },
            },

            tooltips: {
                backgroundColor: '#fff',
                titleFontColor: '#333',
                bodyFontColor: '#666',
                bodySpacing: 4,
                xPadding: 12,
                mode: "nearest",
                intersect: 0,
                position: "nearest"
            },
            responsive: true,           
        };

        var data = {
            labels: label_grafica,
            datasets: [{
                label: "Contratos",
                backgroundColor: [
                    window.chartColors.red,
                    window.chartColors.orange,
                    window.chartColors.yellow,
                    window.chartColors.green,
                    window.chartColors.blue,
                ],                
                data: dato_grafica,
            }]
        };  

        var myChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: gradientChartOptionsConfiguration
        });                      
    }     
</script>  
  @endsection