<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>
       <link rel="stylesheet" href="../../bootstrap-3.3.7/dist/css/bootstrap.min.css">
        <script src="../../js/jquery.min.js"></script>
        <script src="../../bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
<script src="funciones.js?<?php echo rand(1,100) ?>"></script>
<div class="container">
<div class="table-responsive"> 
            <table  style="width: 100%">
                <tr>
                    <td><input type="text" id="buscador" class="form-control" placeholder="Buscar por cedula o nombre"></td> 
         
            </table>
     <div id="mostrar_tabla"> 
         Cargando <img src="../../imagenes/loadin.gif">
     </div>
    <input type="hidden" id="id" class="form-control" value="<?php echo $_GET['id']; ?>" placeholder="Buscar por cedula o nombre">
    </div>
</div> 

<?php  }else {
    echo '<script>location.reload();</script>';
}?>         