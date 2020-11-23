<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>

<script src="../vistas/inventario/kardex/funciones.js?<?php echo rand(1, 100) ?>"></script>
<div class="page-content">
 <div class="table-responsive"> 
   <div class="row">
	<div class="col-xs-12">	
            <h2 class="header smaller lighter blue" ><b>REPORTE KARDEX</b></h2>
        </div>
            </div>   
<div class="tabbable">

     <div class="tab-content">
		<div id="home" class="tab-pane fade in active">
                    <div class="table-responsive">
                       <div style="margin-left: 1%;">
                           <div style="width: 80%">
                               <div style="float: left">
                                       <table style="width: 100%" >
                                    <tr>
                                   <td><label>BODEGA</label></td>
                                   <td><input type="text" id="bod" class="form-control" style="width: 80%" placeholder="BODEGA"></td> 
                               </tr>      
                               <tr>
                                   <td><label>CODIGO &nbsp;&nbsp;&nbsp;</label></td>
                                   <td><input type="text" id="cod_k" class="form-control" style="width: 80%" placeholder="CODIGO" onchange="buscarcod()"></td>
                                 
                               </tr> 
                               <tr>
                                   <td><label>DESCRIPCION &nbsp;&nbsp;&nbsp;</label></td>
                                   <td><input type="text" id="des_k" class="form-control" style="width: 100%" placeholder="DESCRIPCION" disabled></td>
                                 
                               </tr> 
                               <tr>
                                   <td><label>COLOR &nbsp;&nbsp;&nbsp;</label></td>
                                   <td>
                                       <select id="color" class="form-control">
                                           <option value="">Todas</option>
                                                  <?php 
                                                  $result = mysqli_query($con,"select * from colores ");
                                                  while ($r = mysqli_fetch_array($result)){
                                                      echo '<option value="'.$r[0].'">'.$r[0].'</option>';
                                                  }
                                                  ?>
                                        </select>
                                   </td>
                               </tr> 
                
                               <tr>
                                   <td>CLASE &nbsp;&nbsp;&nbsp;</td>
                                     <td><input type="text" id="clas_k" class="form-control" style="width: 80%" placeholder="CLASE"></td>
                               </tr> 
                           </table>
                               </div> 
                               <div style="float: right">
                                       <table style="width: 100%">
                               <tr>
                                 <TD>FECHA &nbsp;&nbsp;&nbsp;</TD>
                                 <td><input type="date" id="fec_k" class="form-control" style="width: 80%" placeholder="FECHA" value="<?php echo date("Y-m-01") ?>"></td>
                                 <TD>FECHA &nbsp;&nbsp;&nbsp;</TD>
                                 <td><input type="date" id="fec_f" class="form-control" style="width: 80%" placeholder="FECHA" value="<?php echo date("Y-m-d") ?>"></td>
                               </tr>
                               <tr>
                                   <td><label>USUARIO &nbsp;&nbsp;&nbsp;</label></td>
                                   <td><input type="text" id="usu_k" class="form-control" style="width: 80%" placeholder="USUARIO"></td> 
                               </tr>
                               
                                <tr>
                                <TD>TIPO MOV: &nbsp;&nbsp;&nbsp;</TD>
                                 <td> <select id="tmov_k" class="col-sm-12">
                                   <option value="">TODOS</option>
		                   <option value="ENTRADA">ENTRADA</option>
                                   <option value="SALIDA">SALIDA</option>
	                       </select></td>
                               </tr>
                                <tr>
                                   <td>UBICACION &nbsp;&nbsp;&nbsp;</td>
                                     <td><input type="text" id="ubi_k" class="form-control" style="width: 80%" placeholder="UBICACION"></td>
                               </tr>
                               <tr>
                                <TD>GRUPO: &nbsp;&nbsp;&nbsp;</TD> 
                                   <td><input type="text" id="grup_k" class="form-control" style="width: 80%" placeholder="GRUPO"></td>
                               </tr> 
                                  </table>
                                   <br><br>
                                       <div>
                                          <button class="fa fa-print" onclick="pdf();"> Imprimir</button>
                                           <button class="fa fa-print" onclick="pdf_ubi();"> Imp. con Ubicacion</button>
                                   </div>
                               </div>
                           </div>
                       </div>
                        <br> <br> <br> <br> <br><br> <br> <br><br> <br> <br> 
                 <div id="mostrar_tabla">
                       <br><br>
<!--                        <b><center><img src="../imagenes/load.gif">Cargando Tabla</center></b>-->
                       Sin datos
                 </div>       
                </div>
                    </div><br> 
                       <br>
          </div> 
     </div> 
<br>
<br>

 </div>

</div>


 <?php  }else {
    echo '<script>location.reload();</script>';  
}?>         
