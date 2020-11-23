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
        <title>Reserva de materiales</title>
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
            <h3>GENERAR RESERVA DE MATERIAL PARA OBRAS</h3>
        </div><hr>
        <div class="border">
            <fieldset>
                <div class="form">
                    <br>
               <div class="tab-content" id="">
                   <div id="detalle" class="tab-pane fade in active">
                       <table class="tbl-registro" width="100%">
                           <tr>
                               <td>Tipo Movimiento:</td>
                               <td><input type="text" id="doc" value="R001" style="width: 40px" readonly><input type="text" id="ndoc" style="width: 200px" placeholder="Descripcion" value="RESERVA DE MATERIAL" readonly></td>
                               <td>Bodega:</td> 
                               <td><input type="text" id="loc" style="width: 40px">
                                  <img src="../../images/buscar.png" onclick="inv_bodega_popup2();cargaddatos();" style="cursor: pointer" id="kill"> <input type="text" id="nloc" style="width: 200px" placeholder="Descripcion" readonly></td>
                           </tr>
                           
                           <tr>
                               <td><button type="button" id="continuar" onclick="view();"><img src="../../images/play.png"> Generar</button></td>
                           </tr> 
                        </table><br>
                       <center><div id="tabhiddenxx"><table width="100%" id="">
                           <tr bgcolor="#F2F2F2">
                               <th class="center">CODIGO</th>
                               <th class="center">DESCRIPCION</th>
                               <th class="center">COLOR</th>
                               <th class="center">MEDIDA</th>
                               <th class="center">CANTIDAD</th>
                               <th class="center">PRECIO UNID</th>
                               <th class="center"></th>
                           </tr>
                            <tr bgcolor="#F2F2F2" id="hidden_add">
                               <td ><input type="text" id="coder" onclick="inv_mov_prores();"></td>
                               <td><input type="text" id="des" readonly></td>
                               <td><input type="text" id="col" readonly></td>
                               <td><input type="text" id="med" readonly></td>
                               <td><label><input type="text" id="can"></label></td>
                               <td><input type="text" id="pre" readonly></td>
                               <td><button onclick="cargar_resmate();"><b>Reservar</b></button></td>
                           </tr>
                       </table></div></center><hr>
                       <center><div><table width="100%" id="">
                           <tr bgcolor="#F2F2F2">
                               <TH>CODIGO</TH>
                               <TH>OBRA</TH>
                               <TH>CANTIDAD RESERVADA</TH>
                               <TH>BODEGA</TH>
                               <th class="center"></th>
                           </tr>
                          <tbody id="mostrar_movi_res">
              </tbody>
                       </table></div></center>
                           <br><hr>
                           <textarea id="nota" style="width:100%;" placeholder="Nota:"></textarea>
                           
                   </div><br>
               </div>
                </div>
                </fieldset>


            <span id="mensaje"></span>
              </div>
              <script src="../../assets/js/jquery-2.1.4.min.js"></script>
              <script src="../../assets/js/bootstrap.min.js"></script>
        
                            <script>

                              function delet_res(id) {
                                var cant=document.getElementById('C'+id).value;
                                var product=document.getElementById('P'+id).value;
                                 $.post("acciones_reservas.php", {"delete":id,"cant":cant,"produ":product}, function(data){
                                            if(data.result==1){
                                              alert('Se realizo operacion con exito.');
                                              carga_list_res();
                                            }else{
                                              alert('No pudo eliminarse este item -> Pro_Stock');
                                            }
                                      },"json");
                              }
                            document.getElementById('tabhiddenxx').style.visibility='hidden';
                             function cargaddatos(cod) {
                              carga_list_rest(cod);
                             }
                             function view() {
                              var x=document.getElementById('loc').value;
                              if(x!=''){
                                document.getElementById('tabhiddenxx').style.visibility='visible';
                                document.getElementById('kill').style.visibility='hidden';
                                document.getElementById('loc').disabled=true;
                                document.getElementById('obs').disabled=true;
                              }else{
                                alert('Debe seleccionar bodega primero!');
                              }
                             }
                            
                            </script>
    </body>
</html>
