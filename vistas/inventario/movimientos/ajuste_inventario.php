<?php
   include '../../../modelo/conexioni.php';
   session_start();
   if(!isset($_SESSION['k_username'])){
       echo '<script>window.close();</script>';
   }
   $userk=$_SESSION['k_username'];
   $date= date("Y-m-d");
   ?>
<!DOCTYPE html>
<html>
  <head>
        <meta charset="UTF-8">
        <title>Ajuste de inventario</title>
        <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="../../assets/css/jquery-ui.custom.min.css" />
        <link rel="stylesheet" href="../../assets/css/jquery.gritter.min.css" />
        <link rel="stylesheet" href="../../assets/css/fonts.googleapis.com.css" />
        <link rel="stylesheet" href="../../assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
        <link rel="stylesheet" href="../../assets/css/ace-skins.min.css" />
        <link rel="stylesheet" href="../../assets/css/ace-rtl.min.css" />
        <link rel="stylesheet" href="../../assets/css/chosen.min.css" />
        <link rel="stylesheet" href="../../assets/css/bootstrap-datepicker3.min.css" />
        <link rel="stylesheet" href="../../assets/css/bootstrap-timepicker.min.css" />
        <link rel="stylesheet" href="../../assets/css/daterangepicker.min.css" />
        <link rel="stylesheet" href="../../assets/css/bootstrap-datetimepicker.min.css" />
        <link rel="stylesheet" href="../../assets/css/bootstrap-colorpicker.min.css" />
        <link href="../../../css/estilo.css" rel="stylesheet">
        <script src="funciones.js"></script>
  </head>
    <body>
          <div>
              <h3>DOCUMENTO DE AJUSTE DE INVENTARIO</h3>
          </div>
          <div class="border">
              <fieldset>
                  <div class="form">
                      <br>
                 <div class="tab-content" id="">
                     <div id="detalle" class="tab-pane fade in active">
                         <table class="tbl-registro" width="100%">
                             <tr>
                                 <td>Tipo Movimiento:</td>
                                 <td><input type="text" id="doc" value="1012" readonly style="width: 45px"><input type="text" id="ndoc" style="width: 200px" placeholder="Descripcion" value="AJUSTE DE INVENTARIO" disabled></td>
                                 <td>Fecha</td>
                                 <td><input type="text" id="FecReg" style="width: 120px" value="<?php echo $date;?>" disabled> <span id="es"></span></td>
                                 <td>Radicado</td>
                                 <td><input type="text" id="rad" style="width: 80px" value="" disabled><input type="hidden" id="radicado" style="width: 80px" disabled></td>
                             </tr>
                             <tr>
                                 <td>Centro de Costo:</td>
                                 <td><input type="text" id="cc" style="width: 40px"><img src="../../images/buscar.png" onclick="inv_centro_costo_popup();" style="cursor: pointer"> <input type="text" id="centro" style="width: 200px" placeholder="Descripcion" disabled></td>
                                
                                 <td></td>
                                 <td></td>
                            
                             </tr>
                             <tr>
                                 <td>Observaciones</td>
                                 <td colspan="5"><input type="text" id="obs" style="width: 100%" ></td>
                             </tr>
                             <tr>
                                  <td>Referencia Producto</td>
                                  <td><input type="text" id="refe" style="width: 80px"></td>
                                  
                             </tr>
                             <tr>
                                 <td><button type="button" id="continuar" onclick="llea();"><img src="../../images/play.png"> Continuar</button></td>
                             </tr> 
                         </table>
                         
                         <div id="hiddentab2">
                          <div style="width: 45%;padding: 2%;color: blue;float: left;">
                            <b style="color: red;">Ajuste de la Disonible:</b>
                            <input type="number" id="ajsd"><br><button onclick="cardisp();" style="margin-right: 5%;font-weight: bold;">Cargar</button><button onclick="desdisp();" style="font-weight: bold;">Descargar</button>
                           <h5><b>Stock Total: </b><p id="Total"></p></h5>
                            <input type="hidden" id="dips" value="0"><h5><b>Stock Disponible: </b><p id="Disponible"></p></h5>
                             <h5><b>Stock Reserva: </b><p id="Reserva"></p></h5>
                         </div>
                         <div style="width: 45%;padding: 2%;color: blue;float: left;">
                           <h5><b>Lista de Bodegas</b></h5>
                            <table width="100%" class="table">
                             <tr bgcolor="#F2F2F2">
                                 <th>Bodega</th>
                                 <th style="padding-left: 5%;">Cantidad</th>
                                 <th style="text-align: center;">Descarga</th>
                                 <th></th>
                             </tr>
                            <tbody id="result_reserves">
                            </tbody>
                         </table>
                         </div>
                         </div>
                             <br><hr>
                     </div>
                 </div>
                  </div><hr>
                  </fieldset>
                </div>
                <script src="../../assets/js/jquery-2.1.4.min.js"></script>
                <script src="../../assets/js/bootstrap.min.js"></script>
          
          <script>

              function cardisp() {
                var   ref = document.getElementById('refe').value;
                var valor = document.getElementById('ajsd').value;
                 var refe = document.getElementById('refe').value;
                if(valor!='' && ref!=''){
                    $.post("acciones_reservas.php", {"carga_disp":valor,"refe":refe}, function(data){
                                if(data.sucess==1){
                                  alert('Se realizo operacion con exito.');
                                  recargar_values();
                                  document.getElementById('ajsd').value='';
                                }else{
                                  alert('no llego');
                                }
                    },"json");
                }else{
                    alert('Digite valor a manipular!');
                }
              }

              function desdisp() {
                var x1=parseInt(document.getElementById('dips').value);
                var x2=parseInt(document.getElementById('ajsd').value);
                if(x2>x1){
                  alert('No puede descarga un valor superior a stock de bodega');
                  document.getElementById('ajsd').value='';
                }else{
                      var valor = document.getElementById('ajsd').value;
                      var refe = document.getElementById('refe').value;
                      if(valor!='' && refe!=''){
                        $.post("acciones_reservas.php", {"descarga_disp":valor,"refe":refe}, function(data){
                                      if(data.sucess==1){
                                        alert('Se realizo operacion con exito.');
                                        recargar_values();
                                        document.getElementById('ajsd').value='';
                                      }else{
                                        alert('no llego');
                                      }
                        },"json");
                      }else{
                         alert('Digite valor a manipular!');
                      }
                }
              }

              function desc_obra(id) {
                disp=document.getElementById('dips').value;
                if(disp==0){
                  var cant = parseInt(document.getElementById('X'+id).value);
                  var bodega = document.getElementById('loc'+id).value;
                  var refe = document.getElementById('refe').value;
                  $.post("acciones_reservas.php", {"des_obra":"1","cant":cant,"bodega":bodega,"refe":refe}, function(data){
                        if(data.sucess==1){
                          alert('Se realizo operacion con exito');
                          recargar_values();
                        }else{
                          alert(data.sucess);
                        }
                    },"json");
                }else{
                  alert('No puedes descargar ya que en la disponible hay existencias!');
                }
              }

              function comprobarC(id) {
                var x1=parseInt(document.getElementById('CV'+id).value);
                var x2=parseInt(document.getElementById('X'+id).value);
                if(x2>x1){
                  alert('No puede descarga un valor superior a stock de bodega');
                  document.getElementById('X'+id).value='';
                }
              }

              $("#refe").keyup(function(){
                    var ref=$("#refe").val();
                    $.post("acciones_reservas.php", {"resm":ref}, function(data){
                        if(data.result==1){
                          document.getElementById('Total').innerHTML=data.general;
                          document.getElementById('dips').value=data.disponible;
                          document.getElementById('Disponible').innerHTML=data.disponible;
                          document.getElementById('Reserva').innerHTML=data.reservado;
                          cargarListaRes(ref);
                        }else{
                          document.getElementById('Total').innerHTML='';
                          document.getElementById('dips').value=0;
                          document.getElementById('Disponible').innerHTML='';
                          document.getElementById('Reserva').innerHTML='';
                        }
                    },"json");
              });

              function recargar_values() {
                var ref=$("#refe").val();
                    $.post("acciones_reservas.php", {"resm":ref}, function(data){
                        if(data.result==1){
                          document.getElementById('Total').innerHTML=data.general;
                          document.getElementById('dips').value=data.disponible;
                          document.getElementById('Disponible').innerHTML=data.disponible;
                          document.getElementById('Reserva').innerHTML=data.reservado;
                          cargarListaRes(ref);
                        }else{
                          document.getElementById('Total').innerHTML='';
                          document.getElementById('dips').value=0;
                          document.getElementById('Disponible').innerHTML='';
                          document.getElementById('Reserva').innerHTML='';
                        }
                    },"json");
              }

              function cargarListaRes(ref) {
                $.ajax({
                        type: 'POST',
                        data: 'lisrem=' + ref,
                        url: 'acciones_reservas.php',
                        success: function (d) {
                            $("#result_reserves").html(d);
                            if (d == 'error') {
                                location.href = '../index.php';
                            }
                        }
                    });
              }
          </script>
    </body>
</html>
