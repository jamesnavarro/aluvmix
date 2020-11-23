<?php
   include('../../../modelo/conexionv1.php');
?>
<script src="../vistas/produccion/puestos/funciones.js"></script>

<div class="tabbable" style="margin-bottom: 25px;">

        <div class="tab-content">
         <div id="lin1" class="tab-pane fade in active">
             
             
    <table class="table table-hover">
       <tr class="bg-info">

                <th>Codigo</th> 
                <th>Puesto de trabajo</th>
                <th>Linea</th>
                <th>Trazabilidad</th>
                <th>Centro Produccion</th>
                <th>Centro Costo</th>
                <th>Ult Modificacion</th>
                <th>Por Usuario</th>
                <th>Estado</th>
                <th>Precios</th>
                <th>Editar</th>
        </tr>
        <tr>
            <td><input type="text" id="cod" placeholder="Codigo" class="col-xs-10 col-sm-12"/></td>
            <td><input type="text" id="pue" placeholder="Puesto" class="col-xs-10 col-sm-12"/></td> 
            <td><input type="text" id="lin" placeholder="Linea" class="col-xs-10 col-sm-12"/></td> 
            <td><select id="tra" disabled><option value="">Todos</option><option value="0">Manual</option><option value="1">Automatica</option></select></td> 
            <td><input type="text" id="cp" disabled placeholder="CP" class="col-xs-10 col-sm-12"/></td> 
            <td><input type="text" id="cc" disabled placeholder="CC" class="col-xs-10 col-sm-12"/></td>
            <td><input type="text" disabled placeholder="" class="col-xs-10 col-sm-12"/></td> 
            <td><input type="text" disabled placeholder="" class="col-xs-10 col-sm-12"/></td>
            <td><select id="est"><option value="">Todos</option><option value="0">Activo</option><option value="1">No activo</option></select></td>
              <td></td>
             <td></td>

        </tr>
 <tbody id="mostrar_tabla">
          
     </tbody>
</table>
         </div>
  
         
          <div id="lin2" class="tab-pane fade in">
              
              <ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marcax">
	   <a data-toggle="tab" href="#linx">
              <h6><B>Datos basicos</B></h6>
           </a>
        </li>
           <li id="marcay">
               <a data-toggle="tab" href="#liny"><h6><B>Configuracion</B></h6></a>
           </li>
        </ul>
               <div class="tab-content">
               <div id="linx" class="tab-pane fade in active">
                <div class="modal-header">
                  <h4 class="modal-title">Formulario</h4>
                  </div>
               
                   <div class="form-horizontal" role="form">
                   <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Codigo</label>
                    <div class="col-sm-9">
                    <input type="text" id="fcod" placeholder="digite el codigo" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Puesto de Trabajo </label>
                    <div class="col-sm-9">
                    <input type="text" id="fdes" placeholder="descripcion" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                     <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Linea </label>
                    <div class="col-sm-9">
                        <select id="flin">
                            <option value="">Seleccione</option>
                            <option value="Vidrio">Vidrio</option>
                            <option value="Aluminio">Aluminio</option>
                            <option value="Acero">Acero</option>
                        </select>
                    </div>
                    </div>
                       <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Trazabilidad </label>
                    <div class="col-sm-9">
                        <select id="ftra">
                            <option value=""></option>
                            <option value="0">Manual</option>
                            <option value="1">Automatico</option>
                        </select>
                    </div>
                    </div>
                       <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Estado </label>
                    <div class="col-sm-9">
                        <select id="fest">
                            <option value=""></option>
                            <option value="0">Activo</option>
                            <option value="1">No activo</option>
                        </select>
                    </div>
                    </div>
                       <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Centro de Costo</label>
                    <div class="col-sm-9">
                        <input type="text" id="fcc" placeholder="cod" class="col-xs-2 col-sm-1" onclick="pop_centro()"/> 
                    <input type="text" id="fncc" placeholder="descripcion centro de costo" class="col-xs-8 col-sm-5" />
                    </div>
                    </div>
                       <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Centro Produccion </label>
                    <div class="col-sm-9">
                        <select id="fcp" >
                            <option value="">Seleccione</option>
                            <?php
//                            $result = mysqli_query($con2, "select * from centroproduccion where cp_activo=0");
//                            while($r = mysqli_fetch_array($result)){
//                                echo '<option value="'.$r[0].'">'.$r[0].' - '.$r[1].'</option>';
//                            }
                            
                            ?>
                          
                        </select>
                    </div>
                    </div>

                   
                       
                     <div class="form-actions">
                     <label class="col-sm-5 control-label no-padding-right" for="form-field-2"> </label>
                     <button type="button" class="btn btn-success" onclick="guardar_lin()">Guardar</button>
                     <button type="button" class="btn btn-danger" onclick="limpiar_lin()">Nuevo
                      <i data-dismiss="modal"></i></button>
                    </div>
                    </div>
               </div>
                <div id="liny" class="tab-pane fade in">
                <div class="form-horizontal" role="form">
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Produccion x mes</label>
                    <div class="col-sm-9">
                       <input type="text" id="fpro" placeholder="Valor" class="col-xs-2 col-sm-2"/> 
                        <select id="fumb4" class="col-xs-2 col-sm-2">
                            <option value="">Seleccione</option>
                            <option value="m2">m2</option>
                            <option value="ml">ml</option>
                            <option value="und">und</option>
                            <option value="hh">hh</option>
                            <option value="kg">kg</option>
                        </select>
                    </div>
                    </div>
                        <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Unidad de Cobro Variable $</label>
                    <div class="col-sm-9">
                       <input type="text" id="fund" placeholder="Valor" class="col-xs-2 col-sm-2"/>  
                       <button onclick="pro_costoconf()"> <img src="../imagenes/cambiar.png"> </button>
               
                    </div>
                    </div>
                       <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Parametro de Mano de Obra</label>
                    <div class="col-sm-9">
                       <input type="text" id="fmo" placeholder="Valor" class="col-xs-2 col-sm-2"/>  
                       <button onclick="pro_costomo()"> <img src="../imagenes/cambiar.png"> </button>
               
                    </div>
                    </div>
                       <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Parametro de CIF</label>
                    <div class="col-sm-9">
                       <input type="text" id="fcif" placeholder="Valor" class="col-xs-2 col-sm-2"/>  
                       <button onclick="pro_costocif()"> <img src="../imagenes/cambiar.png"> </button>
               
                    </div>
                    </div>
                       <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Parametro Maquinaria</label>
                    <div class="col-sm-9">
                       <input type="text" id="fmaq" placeholder="Valor" class="col-xs-2 col-sm-2"/>  
                       <button onclick="pro_costomaq()"> <img src="../imagenes/cambiar.png"> </button>
               
                    </div>
                    </div>
                    
                      <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Agua</label>
                    <div class="col-sm-9">
                    <input type="text" id="agua_p" placeholder="descripcion" class="col-xs-10 col-sm-2" />%
                    </div>
                    </div>
                     <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Luz</label>
                    <div class="col-sm-9">
                    <input type="text" id="luz_p" placeholder="descripcion" class="col-xs-10 col-sm-2" />%
                    </div>
                    </div>
                     <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Gas</label>
                    <div class="col-sm-9">
                    <input type="text" id="gas_p" placeholder="descripcion" class="col-xs-10 col-sm-2" />%
                    </div>
                    </div>
                     <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Internet</label>
                    <div class="col-sm-9">
                    <input type="text" id="int_p" placeholder="descripcion" class="col-xs-10 col-sm-2" />%
                    </div>
                    </div>
                    
                      <div class="form-actions">
                     <label class="col-sm-5 control-label no-padding-right" for="form-field-2"> </label>
                     <button type="button" class="btn btn-success" onclick="guardar_lin()">Guardar</button>
                     <button type="button" class="btn btn-danger" onclick="limpiar_lin()">Nuevo
                      <i data-dismiss="modal"></i></button>
                    </div>  
                    </div>          
            </div> 
               </div>
                   </div>
               </div>
        </div> 
    <div id="ModalPrecios" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Configuracion de precios por area <input type="text" id="idarea" disabled style="width: 40px"></h4>
      </div>
      <div class="modal-body">
          <p id="titulomodal"></p> 
          <select id="idpue">
                            <option value="">Seleccione</option>
                            <?php
              
                            $resw = mysqli_query($con2, "SELECT * FROM `puestos` ");
                            while ($row = mysqli_fetch_array($resw)) {
                                echo '<option value="'.$row[0].'">'.$row[4].' - '.$row[3].'</option>';
                            }
                            ?>
                        </select>
          <button type="button" class="btn btn-primary" onclick="addprecio()">Relaciona Puesto</button>
          <table style="width:100%">
              <tr>
                  <th>SEDE</th>
                  <th>M.OBRA</th>
                  <th>UM MO</th>
                  <th>MAQ</th>
                  <th>UM MA</th>
                  <th>CIF</th>
                  <th>UM CF</th>   
                  <th>OPCION</th>
              </tr>
                        <tbody id="mostrar_precio">
                            
                        </tbody>
          </table>
      </div>
      <div class="modal-footer">
          
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>   
         
         
         
  
     

      





