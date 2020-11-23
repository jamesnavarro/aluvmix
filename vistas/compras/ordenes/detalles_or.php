<?php
 session_start();
    if(!isset($_SESSION['k_username'])){ 
       echo '<script>alert("Su sesion caduco");location.href="../index.php";</script>';
        }
        //1048298457 
?>

<script src="../vistas/compras/solicitudes/funciones.js?<?php echo rand(1, 100) ?>"></script>

<div class="panel panel-info">
		<div class="panel-heading" id="infos">
                    <h4><i class="glyphicon glyphicon-check"></i>
                        <table style="width: 100%">
                            <tr>
                                <td>Asunto :</td>
                                <td><input type="text" id="asunto" style="width: 300px"></td>
                                <td rowspan="2"><textarea id="cuerpo" placeholder="Notas del correo" class="form-control"></textarea></td>
                            </tr>
                            <tr>
                                <td>Correo:</td>
                                <td><input type="email" id="cor" style="width: 300px" onchange="updatecorreo()"></td>
                            </tr>
                        </table>
                        <br>
                        <input type="hidden" id="orden" style="width: 200px">
                        
                        <button onclick="enviar_orden()">Enviar Email a Proveedor</button>
                        <button onclick="fom_saveoc2()">¡</button>
                        <button class="btn btn-inverse" onclick="printerop();" ><i class="glyphicon glyphicon-print"></i></button>
                        Orden de Compra Fom <input type="text" id="fom" style="width: 200px" disabled>
                    </h4>
		</div>
		<div class="panel-body">
      <div class="container" style="margin-top: 1%;box-shadow: 0 0 25px #438EB9;width: 97%">
          <div id="contex">
            <div style="width: 40%;float: left;">
            <b>No. Orden: <label style="color: #438EB9;margin-left: 2%;font-weight: bold;" id="ord"></label></b><br>
            <b>Fecha de creación: <label style="color: #438EB9;margin-left: 2%;font-weight: bold;" id="fecc"></label></b><br>
            <b>Empresa: <label style="color: #438EB9;margin-left: 2%;font-weight: bold;" id="emp"></label></b><br>
            <b>Bodega: <label style="color: #438EB9;margin-left: 2%;font-weight: bold;" id="bod"></label></b><br>
          </div>
          <div style="width: 40%;float: left;">
            <b>Creado por: <label style="color: #438EB9;margin-left: 2%;font-weight: bold;" id="crp"></label></b>
            <br>
            <b>Estado: <label style="color: red;margin-left: 2%;font-weight: bold;" id="est"></label></b><br>
            <b>Proveedor: <label style="color: red;margin-left: 2%;font-weight: bold;" id="prove"></label></b><br>
             <b>Centro de costo: <label style="color: red;margin-left: 2%;font-weight: bold;" id="cen"></label></b><br>
          </div>
          </div>
            <div style="width: 20%;float: left;">
              <div id="wait"></div>
              <div id="listo"></div>
              <input type="hidden" id="ordenz">
            </div>
        </div>
		   <br><br>
                          <!-- CONTENIDO DENTRO DE TABINDEX -->
                             <table class="table table-hover">
                                <tr class="bg-info">
                                      <th>CODIGO</th> 
                                      <th>REFERENCIA</th> 
                                      <th>DESCRIPCION</th>  
                                      <th>COLOR</th>
                                      <th>MEDIDA</th>
                                      <th>CANT</th>
                                      <th>UND</th>
                  	                  <th>PRECIO UND</th>
                                      <th>TOTAL</th>
                                </tr>
                               <tbody id="mostrar_tabla_products">
                               </tbody>
                            </table>
                          <span id="msg"></span>
                          <!-- FIN DE CONTENIDO -->
		</div>
</div>
