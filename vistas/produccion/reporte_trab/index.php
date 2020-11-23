<?php
   include '../../../modelo/conexionv1.php';
?>
<script src="../vistas/produccion/reporte_trab/funciones.js?v=<?php rand(1,100) ?>"></script>

<center><table style="width: 98%">
        <tr class="bg-info"><th colspan="2" style="text-align:center;"><h4><B>REPORTE DE TRABAJO</B></h4></th></tr>
        <tr>
    <td>
<table style="width:100%">
             
            
             <tr class="bg-info">
                <th>AREA</th> 
                <TD>
                    <select id="area" class="col-xs-9 col-sm-18" onchange="BuscarGrupo()">
                                          <option value="">Seleccione</option>
			                  <?php
                                                $consulta2= "SELECT * FROM `subproceso`";                     
                                                $re=  mysqli_query($con2,$consulta2);
                                                while($fila=  mysqli_fetch_array($re)){
                                                $valor1=$fila['nombre_subpro'];
                                                echo"<option value=".$fila['id_subpro'].">".$valor1."</option>";
                                                }
                                           ?>
                                   
		                </select>
                </TD>
        </tr>
         <tr class="bg-info">
                <th>GRUPO</th> 
                <TD>  <select id="grupo" class="col-xs-9 col-sm-18"  onchange="BuscarDetGrupo()">
                            <option value="">Seleccione</option>
                            </select></TD>
        </tr>
       <tr class="bg-info">
                <th>FECHA INICIAL</th> 
                <TD><input type="date" id="inicio" value="<?php echo date("Y-m-d") ?>" placeholder="" class="col-xs-30 col-sm-20"/></TD>
        </tr>
         <tr class="bg-info">
                <th>FECHA FINAL</th> 
                <td nowrap><input type="date" id="fin" value="<?php echo date("Y-m-d") ?>"  class="col-xs-30 col-sm-20"/>
                </td>
        </tr>
        <tr class="bg-info">
                <th>OPF</th> 
                <td nowrap><input type="text" id="opf"  class="col-xs-30 col-sm-20"/>&nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-info" onclick="GenerarReporte()" id="boton1">Buscar</button>   
                </td>
        </tr>   
</table>
    </td>
    
 <td>
    <table style="width:100%">
       <tr class="bg-info"><th colspan="4" style="text-align:center;"><h4><B>GRUPOS</B></h4></th></tr>
       <tr class="bg-info">
       <th>ID &nbsp;</th> 
       <th>OPERARIO</th> 
       <th>ESTADO</th> 
       <th>INC.</th> 
                
           </tr>
           <tbody id="detallegrupo">
               
           </tbody>
               
        
        </table>
    </td>
        <tr><td colspan="2">
    <table style="width:100%">
        <tr>
            <td colspan="2">
                <tr class="bg-success">
             <th>VALOR AYUDANTE</th>
             <td colspan="2"><input type="text" id="vl_ayu" placeholder="" class="col-xs-50 col-sm-40" disabled/></td>
            <th>VALOR OFICIAL</th>
            <td><input type="text" id="vl_ofi" placeholder="" class="col-xs-50 col-sm-40" disabled/></td>
            <td><input type="text" id="tipo" placeholder="" class="col-xs-50 col-sm-40" disabled/></td>
        </tr>
           
           
    </table>
                 </td>
        </tr>
    </table></center>
   
  
    <BR>
    
<center>
    <table style="width: 97%">
        <tr class="bg-info"><th colspan="11" style="text-align:center;"><h4><B>INFORMACION TOTAL</B></h4></th></tr>
        <tr class="bg-info">
            <th>UND</th>
            <th>MT2</th>
            <th>ML</th>
            <th>PER</th>
            <th>BOQ</th>
            <th>PESO KG</th>
           
            <th>T.AYU</th>
            <th>T.OFI</th>
            <th>-</th>
        </tr>
        <tbody id="mostrarreporte">
            
        </tbody>
    </table>
    <br><hr>
    <table style="width: 97%">
        <tr class="bg-info"><th colspan="11" style="text-align:center;"><h4><B>INFORMACION DETALLADA</B></h4></th></tr>
        <tr class="bg-info">
            <th>OPF</th>
            <th>UND</th>
            <th>MT2</th>
            <th>ML</th>
            <th>PER</th>
            <th>BOQ</th>
            <th>PESO KG</th>
             <th>FECHA REGISTRO</th>
              <th>-</th>
        </tr>

        <tbody id="mostrarreportedetallado">
            
        </tbody>
    </table>
</center>
       
         
    <div class="modal fade" id="Formulario" role="dialog">
     <div class="modal-dialog"> 
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Registro de Inasistencia</h4>
        </div>
            <div class="modal-body">
                <table style="width:100%">
                   
                    <tr>
                        <th>Fecha Registro</th>  
                        <th>Registrado por</th>
                        <th>Motivos</th>
                     </tr>
                     <tbody id="mostrar_incapacidad">
                         
                     </tbody>
                  
                
                </table>    
            </div>
    
      </div>
    </div>
     </div>     
<div class="modal fade" id="modaltrabajo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registro de trabajo Items: <b></b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table style="width:100%">
              <tr bgcolor="#fefefe">
                  <th>Orden</th>
                  <th>Area</th>
                  <th>Grupo</th>
                  <th>Fecha</th>
                  
              </tr>
              <tbody id="mostrar_trabajo">
                  
              </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
 
      </div>
    </div>
  </div>
</div>         
  
     

      





