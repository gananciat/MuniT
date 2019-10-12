<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'> 
    <title>Historial del Empleado</title>
    <style>
      #contenido {
        font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
      }
      #table {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #000;
      }
      #th {
        font-size: 12px;
        text-align: center;
        vertical-align: center;
        border-collapse: collapse;
        padding: 0.3em;
      }
      #td {
        vertical-align: center;
        align-content: center;
        font-size: 10px;
        border-top: 1px solid #000;
        padding: 0.3em;
        border-collapse: collapse;
        white-space:initial;
      }       
      section {
        background: grey;
        border-radius:50%;
      }
      td {
        vertical-align: center;
        align-content: center;
        font-size: 10px;
        white-space:initial;
      }      
      caption {
        padding: 0.3em;
        background: #eee;
      }
      th {
        background: #eee;
      }  
      head {
        text-align: center;
        align-content: center;
        align-items: center;
      }
      #titulo {
        text-align: center;
        text-transform: uppercase;
        font-size: 24px;
      }
      #subtitulo {
        text-align: center;
        font-size: 18px;
      }    
      footer {
        text-align: right;
        font-size: 10px;
      }  
      address {
        font-size: 12px;
      }
      #tableP {
        width: 100%;
        padding-left: 1%;
        padding-right: 1%;
      }
    </style>
</head>
<body id="contenido">
  <head>
    <div id="titulo">
      HISTORIAL LARABORAL DEL EMPLEADO <br> <strong>{{ $data['empleado'] }}</strong>
    </div>
    <div id="subtitulo">
      FECHA DEL REPORTE {{ date('d/m/Y') }}
    </div>    
  </head>
  <br><br>
  <section>

    <table id="tableP">
      <tbody>
        <tr>
          <td style="text-align:left;">
            <address>
              <strong>Empleado </strong> {{ $data['empleado'] }}
            </address>  
          </td>
          <td style="text-align:center;">
            <address>
              <strong>DPI </strong> {{ $data['dpi'] }}
            </address>  
          </td> 
          <td style="text-align:right;">
            <address>
              <strong>NIT </strong> {{ $data['nit'] }}
            </address>  
          </td>                 
        </tr>
      </tbody>
    </table>

    <table id="tableP">
      <tbody>
        <tr>
          <td style="text-align:left;">
            <address>
              <strong>Dirección </strong> {{ $data['direccion'] }}
            </address>  
          </td>
          <td style="text-align:right;">
            <address>
              <strong>Sexo </strong> {{ $data['genero'] }}
            </address>  
          </td>          
        </tr>  
      </tbody>    
    </table>

    <table id="tableP">
      <tbody>
        <tr>
          <td style="text-align:left;">
            <address>
              <strong>Profesión </strong> {{ $data['profesion'] }}
            </address>  
          </td>        
        </tr>  
      </tbody>    
    </table>  
    
    <table id="tableP">
      <tbody>
        <tr>
          <td style="text-align:left;">
            <address>
              <strong>Estado Civil </strong> {{ $data['estado_civil'] }}
            </address>  
          </td>  
          <td style="text-align:center;">
            <address>
              <strong>Fecha de Nacimiento </strong> {{ $data['nacimiento'] }}
            </address>  
          </td> 
          <td style="text-align:right;">
            <address>
              <strong>Edad </strong> {{ $data['edad'] }}
            </address>  
          </td>           
          <td style="text-align:right;">
            <address>
              <strong>Correo Electrónico </strong> {{ $data['email'] }}
            </address>  
          </td>                           
        </tr>  
      </tbody>    
    </table>  
    <table id="tableP">
      <tbody>
        <tr>
          <td style="text-align:left;">
            <address>
              <strong>Número de Teléfono </strong> {{ $data['telefonos'] }}
            </address>  
          </td>                          
        </tr>  
      </tbody>    
    </table>       
  </section>
  <br><br>
  <div>
    <table id="table">
      <thead>
        <tr>
          <th id="th">No. Contrato</th>
          <th id="th">Contrato</th>
          <th id="th">Inicio</th>
          <th id="th">Fin</th>
          <th id="th">Monto Total</th>
          <th id="th">Cargo</th>
          <th id="th">Unidad</th>
          <th id="th">Vencido</th>
          <th id="th">Anulado</th>
        </tr>
      </thead>
      <tbody>
        @foreach($contratos as $data)
        <tr>
          <td style="text-align: center;" id="td">{{ $data->no_contrato }}</td>
          <td style="text-align: left;" id="td">{{ $data->tipo_contrato->nombre.' - '.$data->tipo_contrato->numero }}</td>
          <td style="text-align: center;" id="td">{{ date('d/m/Y', strtotime($data->fecha_inicio)) }}</td>
          <td style="text-align: center;" id="td">
            @if($data->fecha_fin != null)
              {{ date('d/m/Y', strtotime($data->fecha_fin)) }}
            @else
              Indefinido
            @endif              
          </td>
          <td style="text-align: right;" id="td">Q 
            @if($data->monto > 0)
              {{ number_format($data->monto) }}
            @else
              {{ number_format($data->salario) }}
            @endif              
          </td>
          <td style="text-align: left;" id="td">{{ $data->unidad_cargo->cargo->nombre }}</td>
          <td style="text-align: left;" id="td">{{ $data->unidad_cargo->unidad->nombre }}</td>
          <td style="text-align: center;" id="td">
            @if($data->vencido)   
              SI   
            @else
              NO
            @endif
          </td>
          <td style="text-align: center;" id="td">
            @if(!is_null($data->fecha_anulado))
              SI
            @else
              NO
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <footer>
    <strong>{{ $usuario->nombre1.' '.$usuario->apellido1 }}</strong>
  </footer>
</body>
</html>