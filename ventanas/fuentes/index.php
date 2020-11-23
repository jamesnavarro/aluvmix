<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>
    <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<script src="../../js/jquery.js"></script>
<script src="../../js/myjava.js"></script>
<link href="../../css/estilo.css" rel="stylesheet">
<script src="funciones.js?<?php echo rand(1,100) ?>"></script>
<div class="container">
<div class="table-responsive"> 
            <table  style="width: 100%">
                <tr>
                    <td><input type="text" id="buscador" class="form-control" placeholder="codigo o referencia"></td> 
         
            </table>
     <div class="datagrid" id="mostrar_tabla"> 
     </div>
    <input type="hidden" id="id" class="form-control" value="<?php echo $_GET['id']; ?>" placeholder="Buscar por cedula o nombre">
    </div>
</div> 

<?php  }else {
    header("location:../index.php");
}?>         