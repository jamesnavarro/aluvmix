<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/planeacion/orden/funciones_rep.js?<?php echo rand(1,100) ?>"></script>
 <div class="tab-content">
                    <div class="table-responsive">
                         <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 
                        <table class="table">
			<thead>
			<tr class="bg-info">
                            <th width="5%">Tipo Orden</th>
			    <th width="5%">ORDEN</th>
                        
			    <th width="5%">DOCUMENTO</th>
			    <th width="15%" nowrap>NOMBRE DE CLIENTE</th>
			    <th>FECHA REGISTRO</th>
                            <th>PEDIDO</th>
			    <th class="hidden-phone">USUARIO</th>
                            <th class="hidden-phone">ESTADO</th>
	                    <th class="hidden-phone">OPCIONES</th>
			</tr>
                        <tr>
                            <td><select id="tip" name="estado" class="span2" style="width:50px" onchange="mostrarCot()">
                                     <option value="5">5. Externa con Desc</option> 
                                     <option value="8">8. Externa Sin Desc</option> 
                                     <option value="9">9. Ordenes Propias</option> 
                                </select></td>
                            <td><input type="text" id="doc"  onchange="mostrarCot()" class="span12" placeholder="####" value="" style="width: 100%"/></td>
                            <td><input type="hidden" id="cot" onchange="mostrarCot()" class="span12"  value="" style="width: 100%"/></td>
                            <td><input type="hidden"  onchange="mostrarCot()"  class="span12" id="doc" placeholder="" value="" style="width: 100%"/></td>
                            <td><input type="hidden"  onchange="mostrarCot()"  class="span12" id="cli" placeholder="" value="" style="width: 100%"/></td>
                            <td><input type="hidden"  onchange="mostrarCot()" class="span12" id="obr" placeholder="" value="" style="width: 100%"/></td>
                            <td></td>
                           <td></td>
                           <td></td>
                     
                        </tr>
                      <tbody id="cotizacione">
                      </tbody>
                      <tr><td colspan="8">
                                <img src="images/at2.png"  onclick="paginacion(-1)" style="cursor: pointer;">
                                     Pagina: <input type="text" id="page" placeholder="" value="1"  disabled style="width: 30px"/>
                                     <img src="images/sig2.png" onclick="paginacion(1)" style="cursor: pointer;">
                                     <input type="hidden" id="tamano" placeholder="" value="10"  disabled/>
                         </td>
                       </tr>
                    </table>
		</div>
           </div>
       </div>

 <?php  }else {
      echo '<script>alert("Su sesion caduco");location.href="../index.php";</script>';
}?>         