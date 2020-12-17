<?php
 include('../../../modelo/conexioni.php');
 session_start();
 if(!isset($_SESSION['k_username'])){
       echo '<script>window.close();</script>';
   }
?>
<script src="../vistas/inventario/colorfom/funciones.js?<?php echo rand(1,9999) ?>"></script>
<div class="tabbable">

  <div class="tab-content">
   <div id="messages" class="tab-pane fade active in">
     <input type="text" id="buscar" placeholder="" value="" class="form-control"/>
     <button class="btn btn-danger" onclick="con_fom_cod(1);">
       <i class="ace-icon fa fa-plus"></i> Buscar
        </button>
           <br><br>
              <!-- CONTENIDO DENTRO DE TABINDEX2 -->
                <table class="table table-hover">
                   <tr class="bg-info">

		   <th>NOMBRE DEL COLOR</th>

                 <th><input type="checkbox" name="item" onclick="marcar(this)"</th>
                   </tr>
                 <tbody id="mostrar_tabla2">
                 </tbody>
              <tr><td colspan="4">
                  <img src="images/at2.png"  onclick="paginacion(-1)" style="cursor: pointer;">
                       Pagina: <input type="text" id="page" placeholder="" value="1"  disabled style="width: 30px"/>
                       <img src="images/sig2.png" onclick="paginacion(1)" style="cursor: pointer;">
                       <input type="hidden" id="tamano" placeholder="" value="10"  disabled/>
                       </td><td colspan="1"><button onclick="agregar_cod_pro()" class="btn btn-success"> Sincronizar Codigos </button></td></tr>
                            </table>
                            <!-- FIN DE CONTENIDO -->
                        </div>
                    </div>
                  </div>
   
  <!--  INSERTAR PRODUCTO  -->



     

      





