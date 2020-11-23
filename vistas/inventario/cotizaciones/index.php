 <?php 
include '../../../modelo/conexionv1.php'; 
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="inventario/cotizaciones/funciones.js?<?php echo rand(1,100) ?>"></script>
 <div class="tab-content">
                    <div class="table-responsive">
                         <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 
                        <table class="table">
			<thead>
			<tr class="bg-info">
			<th width="5%">ALU</th>
                        <th width="5%">ACC</th>
                        <th width="5%">VID</th>
			<th width="5%">COTIZACION</th>
			<th width="15%">CLIENTE</th>
			<th width="30%" nowrap>NOMBRE DE LA OBRA</th>
			<th width="30%">FECH REGISTRO</th>
	
       
			<th class="hidden-phone">ESTADO</th>
			
			</tr>
                        <tr>
                            <td>-</td><td>-</td><td>-</td>
                            <td><input type="text" id="cot" autofocus autocomplete="off" class="span12" placeholder="####" value="" style="width: 100%"/></td>
                            <td><input type="text"  autocomplete="off" class="span12" id="nom" placeholder="Nombre del cliente" value="" style="width: 100%"/></td>
                            <td><input type="text" autocomplete="off" class="span12" id="obr" placeholder="Obra" value="" style="width: 100%"/></td>
                            <td><input type="date" autocomplete="off"  id="freg" placeholder="" value="" style="width: 100%"/></td>

                            
                                
                          <input type="hidden" autocomplete="off" class="span12" id="se" placeholder="" value="" style="width: 100%"/>
                               <input type="hidden" autocomplete="off" class="span12" id="reg" placeholder="" value="" style="width: 100%"/>
                            </td>
                            <input type="hidden" autocomplete="off" class="span12" id="precio" placeholder="" value="" style="width: 100%"/></td>
                            <td>
                                <select id="estado" name="estado" class="span4" required>
                                     <option value="">Estado</option>
                                     <option value="En proceso">En proceso</option>
                                     <option value="Pedido por aprobar">por aprobar</option>
                                     <option value="Aprobado">Aprobado</option>
                                </select>
                            </td>
                         
                            </tr>
		
                               <tbody id="cotizacione"> 
                               </tbody>
                        </table>
		    </div>
           </div>
       </div>

 <?php  }else {
      echo '<script>alert("Su sesion caduco");location.href="../index.php";</script>';
}?>         