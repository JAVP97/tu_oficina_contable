<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
              <title>#{{$data->id}}</title>  
              <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
              <style>
                body{
                  font-size: 11px;
                }
                .border-top {
                    border-top: 1px solid #000000 !important;
                }
                .border {
                  border: 1px solid #000000 !important;
                }
              </style>
    </head>
    <body class="container-fluid">
      <table width="100%">
        <tr>
          <td width="20%" style="padding-right: 20px"><img src="https://www.bcasual.cl/wp-content/uploads/2019/09/logo-bcasual.jpg" alt="" style="width:150px"></td>
          <td>
            <table>
              <tr>
                <th style="color:red">Cliente: NOMBREEEEEE</th>
              </tr>
              <tr>
                <th style="color:#3e3676">Teléfono:</th>
                <td>to</td>
              </tr>
              <tr>
                <th style="color:#3e3676">E-mail:</th>
                <td>xxxxxx</td>
              </tr>
            </table>
          </td>
          <td width="35%" style="border:3px solid red;color:red;font-size:20px">
            <table width="100%" style="text-align: center">
              <tr>
                <td>Cotización</td>
              </tr>
              <tr>
                <th>45545</th>
              </tr>
              <tr>
                <td>1</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <br>
      <div style="float: right">
        <span><strong>Fecha Emisión</strong> {{$data->created_at->format('d, M Y')}}</span>
      </div>
      <table width="50%" style="border:2px solid black;">
        <tr> {{-- Primero --}}
          <th style="padding: 10px 0 0 10px;color: #3e3676">SEÑOR(ES):</th>
          <td>sr</td>
        </tr>
        <tr>
          <th style="padding: 0 0 0 10px;color: #3e3676">R.U.T:</th>
          <td>000000000</td>
        </tr>
        <tr> {{-- Ultimo --}}
          <th style="padding: 0 0 0 10px;color: #3e3676">GIRO:</th>
          <td>dfdfdfd</td>
        </tr>
        <tr>
          <th style="padding: 0 0 0 10px;color: #3e3676">DIRECCION:</th>
          <td>000000000</td>
        </tr>
        <tr>
          <th style="padding: 0 0 0 10px;color: #3e3676">COMUNA:</th>
          <td>000000000</td>
        </tr>
        <tr>
          <th style="padding: 0 0 0 10px;color: #3e3676">CIUDAD:</th>
          <td>000000000</td>
        </tr>
        <tr>
          <th style="padding: 0  0 10px 10px;color: #3e3676">CONTACTO:</th>
          <td>000000000</td>
        </tr>
      </table>
      <br>
      <table  style="font-size: 10px;width:100%">
        <thead class="text-center">
          <tr style="color: #3e3676; border:1px solid black">
            <th style="border-right:1px solid black">Codigo</th>
            <th style="border-right:1px solid black">Descripcion</th>
            <th style="border-right:1px solid black">Cantidad</th>
            <th style="border-right:1px solid black">Precio</th>
            <th style="border-right:1px solid black">%Impoto Adic.</th>
            <th style="border-right:1px solid black">%Desc.</th>
            <th style="border-right:1px solid black">Valor</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
          </tr>
        </tbody>
      </table>


      </body>



      </html>