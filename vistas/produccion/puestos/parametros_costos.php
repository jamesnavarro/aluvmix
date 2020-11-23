<?php
include '../../../modelo/conexioni.php';
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
        <title>Parametros de Costos</title>
        <meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
                <link href="../../../css/estilo.css" rel="stylesheet">
                <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="../../assets/css/fonts.googleapis.com.css" />
                <script src="../../../js/jquery.min.js"></script>
                <script src="../../../js/sweetalert.min.js"></script>
                <link rel="stylesheet" type="text/css" href="../../../js/sweetalert.css">
                     <script src="funciones.js"></script>

    </head>
    <body onload="mostrar_actividad()">
        <div class="page-content">
            <div>
                Puesto de Tabajo: <input type="text" id="puesto"  disabled value="<?php echo $_GET['id']; ?>"> 
                <button onclick="window.close()">Cerrar</button> <span id="msg"></span><br>
                Actividad :
                <select id="act" >
                    <option value="">Seleccione</option>
                    <?php
                    $result = mysqli_query($con, "select * from clases_actividad where act_activo=0 ");
                    while($r = mysqli_fetch_array($result)){
                        echo '<option value="'.$r[0].'">'.$r[1].' x '.$r[4].'</option>';
                    }
                    ?>
                   
                </select>
                Valor : <input type="text" id="valor" value="">  <button onclick="agregar_act()">Agregar</button>
            </div>
           
            <div style="border: 1px solid #307ECC;box-shadow: 0 0 5px #307ECC;" class="col-xs-12">
           
  
                <div class="datagrid">
                    <table class="table table-bordered table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                           <th>Descripcion</th>
                                            <th>Umb</th>
                                           <th>Valor estandar</th>
                                            <th>Opciones</th>
                                       </tr>
                                       
                            </thead>
                        <tbody id="mostrar_actividad">
                            
                        </tbody>
                    </table>
                         
                </div>
                
            </div>
            
        </div>
        <script src="../../assets/js/jquery-2.1.4.min.js"></script>
		<script src="../../assets/js/bootstrap.min.js"></script>

	
    </body>
</html>

