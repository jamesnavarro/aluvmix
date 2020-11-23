<?php
include('../../../modelo/conexioni.php');

session_start();
if(isset($_SESSION['k_username'])){ 
    
?>
<script src="../vistas/inventario/captura/funciones.js?<?php echo rand(1,100) ?>"></script>
<script>
$(document).ready(function(){
    editar_captura(<?php echo $_GET['id']; ?>);
}); 
</script>
 <div class="tab-content">   
     <form class="bg-info">
             
            <div class="form-row">
                <div class="form-row">
                 <div class="form-group col-md-6"> 
                    <label for="message-text" class="col-form-label">Radicado:</label>
                    <input type="text" class="form-control" id="rad_cap" disabled>
                 </div>
                 <div class="form-group col-md-6">
                  <label for="message-text" class="col-form-label">Fecha de proceso:</label>
                  <input type="text" class="form-control" value="<?php echo date("Y-m-d"); ?>" id="fec_cap" disabled />
                 </div>
                </div>
          
                  <div class="form-row">
                  <div class="form-group col-md-1">
                    <label for="message-text" class="col-form-label">Bodega</label>
                    <input  type="text" onclick="bus_bod();" class="form-control" id="al_cap"> 
                  </div>
                      <div class="form-group col-md-3">
                    <label for="message-text" class="col-form-label">Nombre</label>
                     <input type="text" class="form-control" id="alm_cap">
                  </div>
                      <div class="form-group col-md-2">
                    <label for="message-text" class="col-form-label">Sede</label>
                     <input type="text" class="form-control" id="sede">
                  </div>
                   <div class="form-group col-md-6">
                    <label for="message-text" class="col-form-label">Capturar por</label>
                       <select id="proc_cap" class="form-control">
                            <option value=""></option>
                            <option value="Grupo">Grupo</option>
                            <option value="Linea">Linea</option>
                        </select>
                  </div>
               
            </div>
         <div class="form-row">
                  
              <div class="form-group col-md-4">
                        <label for="message-text" class="col-form-label">Registrado por</label>
                        <input  type="text" class="form-control" id="usu_cap" value="<?php echo $_SESSION["k_username"]; ?>" disabled> 
                  </div>
                    <div class="form-group col-md-2">
                        <label for="message-text" class="col-form-label">Estado</label>
                          <select id="est_cap" class="form-control" disabled>
                               <option value=""></option>
                               <option value="0">En proceso</option>
                               <option value="1">Guardado</option>
                           </select>
                  </div>
                <div class="form-group col-md-6">
                    <br>
                    <label class="col-sm-12 control-label no-padding-lefht" for="form-field-2"></label>
                    <button type="button" class="btn btn-info" id="save" onclick="guardar_captura()">Continuar</button>
                           <button type="button" class="btn btn-danger" onclick="inv_cap_inv(0);">Nuevo</button>
                           <span id="imp"></span>
                           <span id="liq"></span>
                           <a href="../vistas/inventario/captura/exportarexcel.php?idc=<?php echo $_GET['id']; ?>">
                               <button type="button" class="btn btn-info">Exportar Excel</button>
                           </a>
                  </div>
         </div>
         
              </div>
         
        </form>

                       
                  
                       
                     <table class="table table-hover">
                      
                         
                          <tr class="bg-info">
                         
                              <th onclick="productos();">CODIGO <img onclick="productos();" src="../imagenes/zoom.png" style="cursor:pointer"></th>
                              <th>DESCRIPCION</th>         
                              <th NOWRAP>UNID MEDIDA</th>
                              <th>COLOR</th>
                              <th>MEDIDA</th>
                              <th>CANTIDAD</th>
                              <th>UBICACION</th>
                              <TH>OPCIONES</TH>
                           </tr>
                  
                                    <tbody id="mostrar_capturas">
                                    </tbody>
                           
                      
                       </table>  
           
                
                     
                   </div>
               </div>
        </div> 
  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Colores => <input type="text" id="codtemp" disabled ></h4>
      </div>
      <div class="modal-body" >
          <div style="padding: 16px;margin-bottom: 30px;max-height: 300px;overflow-y: auto;">
          <ul>
        <?php
        include('../../../modelo/conexioni.php');
        $query = mysqli_query($con, "select * from colores ");
        while ($row = mysqli_fetch_array($query)) {
            $color= "'".$row[0]."'";
            echo '<li><a href="#" onclick="pasarcol('.$color.')"  data-dismiss="modal">'.$row[0].'</a></li>';
        }
        ?>
              </ul>
              </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
        
         
         <?php  }else {

    echo '<script>location.reload();</script>';
    
}?>   
  
     

      





