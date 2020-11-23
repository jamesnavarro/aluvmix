<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>

<script src="../vistas/presupuestos/conexiones/funciones.js?<?php echo rand(1,100) ?>"></script>
<div class="page-content">
 <div class="table-responsive"> 
   <div class="row">
	<div class="col-xs-12">	
            <h2 class="header smaller lighter blue" ><b>Cargar datos</b></h2>
        </div>
            </div>   
<div class="tabbable">
     <div class="tab-content">
		<div id="home" class="tab-pane fade in active">
                    <div class="table-responsive">
                       <div style="margin-left: 1%; margin-top: 1%;">
                         
                       </div>
                        <br>
                        
                        
                         <div id="mostrar_tabla">
        <br><br>
        <b><center><img src="../imagenes/load.gif">Cargando datos</center></b>
    </div>       
                </div>
                    </div>
    
                  
                        </div>

 </div>

</div>
</div>  

 <?php  }else {
    echo '<script>location.reload();</script>';  
}?>         
