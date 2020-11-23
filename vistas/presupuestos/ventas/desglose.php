<?php
session_start();
if(!isset($_SESSION['k_username'])){
    echo '<script>window.close();</script>';
}
include '../../../modelo/conexioni.php';

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
<head>
    <head>
        <meta charset="UTF-8">
        <title>Desglose de Materiales</title>
<!--                        <link href="../../../css/estilo.css" rel="stylesheet">-->
                <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="../../assets/css/fonts.googleapis.com.css" />
                <script src="../../../js/jquery.min.js"></script>
                <script src="../../../js/sweetalert.min.js"></script>
                <link rel="stylesheet" type="text/css" href="../../../js/sweetalert.css">
                <link rel="stylesheet" href="stilo.css" />
                <script src="loading.js" type="text/javascript"></script>
                <script src="desglose.js" type="text/javascript"></script>
        <style>
    .content-box-blue {
        padding-left: 10px;
background-color: #ECECEC;
border: 1px solid #afcde3;
height: 200px;
width: 200px;
}
.loader {
  border: 20px solid #f3f3f3;
  border-radius: 50%;
  border-top: 20px solid #3498db;
  width: 15px;
  height: 15px;
  -webkit-animation: spin 1s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  80% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
	#WindowLoad
{
    position:fixed;
    top:0px;
    left:0px;
    z-index:3200;
    filter:alpha(opacity=65);
   -moz-opacity:65;
    opacity:0.65;
    background:#7E7E7E;
}
</style>
    </head>
    <body class="bordes" onload="openCity(event, 'Formulario');Desglose();">
        <div class="tab">
    
  <button class="tablinks" onclick="openCity(event, 'Formulario')" ><i class="glyphicon glyphicon-list-alt"></i> Descripcion Tecnica</button>
  <button class="tablinks" onclick="openCity(event, 'otros');lista_desglose(<?php echo $_GET['idc']; ?>)" ><i class="glyphicon glyphicon-th"></i> Desglose Inventario</button>
  <button class="tablinks" onclick="openCity(event, 'services');lista_desglose_sol(<?php echo $_GET['idc']; ?>)" ><i class="glyphicon glyphicon-flag"></i> Desglose Solicitud</button>
</div>
       
        <div id="Formulario" class="tabcontent active">
           <fieldset>
            <legend>DT</legend>
               <table id="simple-table" class="table  table-bordered table-hover">
                      <tr>
                           <th style="text-align:center;background: #438EB9" colspan="12">Perfiles Ventaneria</th>
                      </tr>
                      <tr class="bg-info" align="center">

                      <th>Referencia</th>
                      <th>Descripcion</th>
                      <th>Lado</th>
                      <th nowrap>Codigo</th>
                      <th nowrap>Medida Und</th>
                      <th nowrap>Cantidad</th>
                      <th nowrap>Medida T</th>
                      <th>Perfil.</th>
                      <th>Perfiles.</th>
                      <th>Agregar.</th>
<!--                        <th>Editar</th>
                      <th>Eliminar</th>-->
                 </tr>
                 <tr>
                     <td><input type="text" id="ref" class="form-control" onchange="Desglose()" style="width:100px"></td>
                     <td><input type="text" id="descr" class="form-control" onchange="Desglose()"></td>
                     <td><input type="text" id="perfil" class="form-control" value="6000" onchange="Desglose()" style="width:100px"></td>
                 </tr>
                 <tbody id="formperfiles">
                     
                 </tbody>

               </table> 


                      <table id="simple-table" class="table  table-bordered table-hover">
                          <tr>
                           <th style="text-align:center;background: #438EB9" colspan="12">Reparto de Materiales</th>
                      </tr>
                 <tr class="bg-info" align="center">
                      <th>Referencia</th>
                      <th>Descripcion</th>
                      <th>Color</th>
                       <th>Codigo</th>
                       <th>Cantidad</th>
                      <th>Tipo</th>
                      <th>Cant Total</th>
                      <th>Agregar</th>

                 </tr>
                 
            <tbody id="forminsumos">
                
            </tbody>

           </table>
        </fieldset>
        </div>
        <div id="otros" class="tabcontent">
            <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a data-toggle="tab" href="#alu"><h6><B>Desglose de Aluminio</B></h6></a></li>
                    <li id="marcar2"><a data-toggle="tab" href="#vid" onclick="lista_desglose_vidrios(<?php echo $_GET['idc']; ?>)"><h6><B>Desglose de Vidrio</B></h6></a></li>
                    <li id="marcar2"><a data-toggle="tab" href="#acc" onclick="lista_desglose_accesorios(<?php echo $_GET['idc']; ?>)"><h6><B>Desglose de Acceosrios</B></h6></a></li>
            </ul>
             <div class="tab-content">
                 <div id="alu" class="tab-pane fade in active">
                     <button class="btn btn-info"><a href="detallado.php?idc=<?php echo $_GET['idc']; ?>&alu"> <i class="fa fa-file-excel-o"></i> Exportar excel </a></button>
                       <table id="simple-table" class="table  table-bordered table-hover">
                           <tr>
                               <th  style="text-align:center;background: #438EB9" colspan="9">Desglose de Aluminio</th></tr>
                                      <tr class="bg-info" align="center">
                                          <th nowrap>#</th>
                                          <th nowrap>Ventana</th>
                                          <th nowrap>Codigo</th>
                                          <th>Referencia</th>
                                          <th>Descripcion</th>     
                                          <th>Color</th>
                                          
                                          <th nowrap>Cantidad</th>
                                          <th nowrap>Medida </th>


                                     </tr>
                                     <tbody id="mostrar_desglose_mat">

                                     </tbody>
                         </table>
                 </div>
                 <div id="vid" class="tab-pane fade in">
                      <button class="btn btn-info"><a href="detallado.php?idc=<?php echo $_GET['idc']; ?>&vid"> <i class="fa fa-file-excel-o"></i> Exportar excel </a></button>
                      <table id="simple-table" class="table  table-bordered table-hover">
                           <tr>
                               <th  style="text-align:center;background: #438EB9" colspan="9">Desglose de Vidrio</th></tr>
                                      <tr class="bg-info" align="center">
                                          <th nowrap>#</th>
                                          <th nowrap>Ventana</th>
                                          <th nowrap>Codigo</th>
                                          <th>Referencia</th>
                                          <th>Descripcion</th>     
                                          <th>Color</th>
                                          <th nowrap>Cantidad</th>
                                          <th nowrap>Medida </th>


                                     </tr>
                                     <tbody id="mostrar_desglose_vid">

                                     </tbody>
                         </table>
                 </div>
                 <div id="acc" class="tab-pane fade in">
                      <button class="btn btn-info"><a href="detallado.php?idc=<?php echo $_GET['idc']; ?>&acc"> <i class="fa fa-file-excel-o"></i> Exportar excel </a></button>
                        <table id="simple-table" class="table  table-bordered table-hover">
                           <tr>
                               <th  style="text-align:center;background: #438EB9" colspan="9">Desglose de Acessorios</th></tr>
                                      <tr class="bg-info" align="center">
                                          <th nowrap>#</th>
                                          <th nowrap>Ventana</th>
                                          <th nowrap>Codigo</th>
                                          <th>Referencia</th>
                                          <th>Descripcion</th>     
                                          <th>Color</th>
                                          <th nowrap>Cantidad</th>
                                          <th nowrap>Medida </th>


                                     </tr>
                                     <tbody id="mostrar_desglose_acc">

                                     </tbody>
                         </table>
                 </div>
              </div>
             
        </div>
         <div id="services" class="tabcontent">
             <table id="simple-table" class="table  table-bordered table-hover">
       <tr><th  style="text-align:center;background: #438EB9" colspan="9">Desglose de Materiales Agrupado</th></tr>
                  <tr class="bg-info" align="center">
                      <th nowrap>#</th>
                      <th nowrap>Codigo</th>
                      <th>Referencia</th>
                      <th>Descripcion</th>     
                      <th>Color</th>
                      <th nowrap>Cantidad</th>
                      <th nowrap>Medida </th>
                      
                      
                 </tr>
                 <tbody id="mostrar_desglose_sol">
                     
                 </tbody>
               </table>
        </div>
        <hr>

                   <script src="../../assets/js/bootstrap.min.js"></script>
                <script src="../../assets/js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="../../assets/js/bootstrap.min.js"></script>
		<script src="../../assets/js/ace-elements.min.js"></script>
		<script src="../../assets/js/ace.min.js"></script>
		<script type="text/javascript" src="../../assets/js/jquery-ui.min.js"></script>
		<script src="../../assets/js/jquery-ui.custom.min.js"></script>
		<script src="../../assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="../../assets/js/bootbox.js"></script>
		<script src="../../assets/js/jquery.easypiechart.min.js"></script>
		<script src="../../assets/js/jquery.gritter.min.js"></script>
		<script src="../../assets/js/spin.js"></script>   
    </body>
</html>
<!-- modal de porcentajes -->

<script>
function openCity(evt, cityName) {
    var item = $("#item").val();
    
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>
