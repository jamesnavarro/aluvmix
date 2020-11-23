<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/presupuestos/crear_per/funciones.js?<?php echo rand(1,100) ?>"></script>
<script type="text/javascript">
	function marcar(source) 
	{
		checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
		for(i=0;i<checkboxes.length;i++) //recoremos todos los controles
		{
			if(checkboxes[i].type == "checkbox") //solo si es un checkbox entramos
			{
				checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
			}
		}
	}
</script>
<div class="page-content">
 <div class="table-responsive"> 
<br>
<div class="col-xs-12">	
      <h3 class="header smaller lighter blue" ><b>Listado de Materiales</b></h3>
 </div>
<div class="tabbable">
<ul class="nav nav-tabs" id="myTab">
	<li class="active" id="marcar1">
	   <a data-toggle="tab" href="#home">
              <h6><B>MASTER DE MATERIALES</B></h6>
           </a>
        </li>
        <li id="marcar2">
               <a data-toggle="tab" href="#Vidrio" onclick="mostrar_vidrios(1)"><h6><B>Vidrio</B></h6></a>
           </li>
           <li id="marcar2">
               <a data-toggle="tab" href="#Aluminio" onclick="mostrar_aluminio(1)"><h6><B>Aluminio</B></h6></a>
           </li>
           <li id="marcar2">
               <a data-toggle="tab" href="#Acero" onclick="mostrar_acero(1)"><h6><B>Acero</B></h6></a>
           </li>
           <li id="marcar2">
               <a data-toggle="tab" href="#Accesorios" onclick="mostrar_accesorios(1)"><h6><B>Accesorios</B></h6></a>
           </li>
           <li id="flotantes">
               <a data-toggle="tab" href="#Flotantes" onclick="mostrar_flotantes(1)"><h6><B>Flotantes</B></h6></a>
           </li>
        </ul>
     <div class="tab-content">
          <div>
                           <select id="linea">
                               <option value="">Seleccione</option>
                               <option value="Vidrio">Vidrio</option>
                               <option value="Aluminio">Aluminio</option>
                               <option value="Acero">Acero</option>
                               <option value="Accesorios">Accesorios</option>
                               <option value="Flotantes">Flotantes</option>
                           </select>
               <button class="btn-warning" onclick="asignarcion()">Pasar Categoria</button>
                          
              
                       </div>
		<div id="home" class="tab-pane fade in active">
                    <div class="table-responsive">
                       
                        <br>
                        <div class="table-responsive">  
       <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 
            <div style="margin-left: 1%; margin-top: 1%;float: left">
               
                <button class="btn-app" onclick="pre_update_productos();">1. Sincronizar con fomplus</button>
                <button class="btn-app" onclick="pre_conefom();" id="sinc">2. Guardar Sincronizar</button>
                <span id="loading"></span>
                <div class="progress pos-rel" id="barra1" data-percent="0%">
                    <div class="progress-bar" id="barra" style="width:0%;"></div>
		</div>
                    
                          
              
                       </div>
          
  <table class="table">
    <tr class="bg-info">  
                <th>Codigo</th>
                <th>Descripcion</th>
                <th>Referencia</th>
                <th>Color</th>
                <th>Costo Promedio</th>
                <th><input type="checkbox" name="item"  onclick="marcar(this);"></th>
              
               
    </tr>   
    <tr class="bg-info">  
        <th><input type="text" id="codigo" style="width:100%"></th>
                <th><input type="text" id="descripcion" style="width:100%"></th>
                <th><input type="text" id="referencia" style="width:100%"></th>
                <th><input type="text" id="" disabled style="width:100%"></th>
                <th><input type="text" id="" disabled style="width:100%"></th>
                <th>-</th>
                
              
               
    </tr> 
    <tbody id="mostrar_tabla">

    </tbody>  
  </table>
           </div>
                    </div>
                </div>
                    </div>
         <br>
                    <div id="Vidrio" class="tab-pane fade in">
                   <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 
                            <div class="table-responsive">  
       <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 

  <table class="table">
    <tr class="bg-info">  
                <th>Codigo</th>
                <th>Descripcion</th>
                <th>Referencia</th>
                <th>Color</th>
                <th>Costo Promedio</th>
                <th>Registrado por</th>
                 <th><input type="checkbox" name="item"  onclick="marcar(this);"></th>
              
               
    </tr>   
    <tr class="bg-info">  
        <th><input type="text" id="codigo_vid" style="width:100%"></th>
                <th><input type="text" id="descripcion_vid" style="width:100%"></th>
                <th><input type="text" id="referencia_vid" style="width:100%"></th>
                <th><input type="text" id="" disabled style="width:100%"></th>
                <th><input type="text" id="" disabled style="width:100%"></th>
                <th>-</th><th>-</th>
              
               
    </tr> 
    <tbody id="mostrar_vidrios">

    </tbody>  
  </table>
           </div>
                    </div>
                         </div>
                        <br>
                       </div>
                       <div id="Aluminio" class="tab-pane fade in">
                   <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 
                            <div class="table-responsive">  
       <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 

  <table class="table">
    <tr class="bg-info">  
                <th>Codigo</th>
                <th>Descripcion</th>
                <th>Referencia</th>
                <th>Color</th>
                <th>Costo Promedio</th>
                <th>Peso</th>
                <th>Perimetro</th>
                <th>Perimetro T.</th>
                <th><input type="checkbox" name="item"  onclick="marcar(this);"></th>
               
    </tr>   
    <tr class="bg-info">  
        <th><input type="text" id="codigo_alu" style="width:100%"></th>
                <th><input type="text" id="descripcion_alu" style="width:100%"></th>
                <th><input type="text" id="referencia_alu" style="width:100%"></th>
                <th><input type="text" id="" disabled style="width:100%"></th>
                <th><input type="text" id="" disabled style="width:100%"></th>
                <th>-</th>
                <th>-</th>
                <th>
                    <select id="agrupado" style="width:100%">
                        <option value="0">Agrupado</option>
                        <option value="1">Detallado</option>
                    </select>
                </th>
                 <th>-</th>
              
               
    </tr> 
    <tbody id="mostrar_aluminios">

    </tbody>  
  </table>
           </div>
                    </div>
                         </div>
                        <br>
                       </div>
                    <div id="Accesorios" class="tab-pane fade in">
                   <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 
                            <div class="table-responsive">  
       <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 

  <table class="table">
    <tr class="bg-info">  
                <th>Codigo</th>
                <th>Descripcion</th>
                <th>Referencia</th>
                <th>Color</th>
                <th>Costo Promedio</th>
                <th>Registrado por</th>
                <th><input type="checkbox" name="item"  onclick="marcar(this);"></th>
              
               
    </tr>   
    <tr class="bg-info">  
        <th><input type="text" id="codigo_acc" style="width:100%"></th>
                <th><input type="text" id="descripcion_acc" style="width:100%"></th>
                <th><input type="text" id="referencia_acc" style="width:100%"></th>
                <th><input type="text" id="" disabled style="width:100%"></th>
                <th><input type="text" id="" disabled style="width:100%"></th>
                <th>-</th>
                 <th>-</th>
              
               
    </tr> 
    <tbody id="mostrar_accesorios">

    </tbody>  
  </table>
           </div>
                    </div>
                         </div>
                        <br>
                       </div>
                        <div id="Acero" class="tab-pane fade in">
                   <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 
                            <div class="table-responsive">  
       <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 

  <table class="table">
    <tr class="bg-info">  
                <th>Codigo</th>
                <th>Descripcion</th>
                <th>Referencia</th>
                <th>Color</th>
                <th>Costo Promedio</th>
                <th>Registrado por</th>
              <th><input type="checkbox" name="item"  onclick="marcar(this);"></th>
               
    </tr>   
    <tr class="bg-info">  
        <th><input type="text" id="codigo_ace" style="width:100%"></th>
                <th><input type="text" id="descripcion_ace" style="width:100%"></th>
                <th><input type="text" id="referencia_ace" style="width:100%"></th>
                <th><input type="text" id="" disabled style="width:100%"></th>
                <th><input type="text" id="" disabled style="width:100%"></th>
                <th>-</th>
                 <th>-</th>
              
               
    </tr> 
    <tbody id="mostrar_acero">

    </tbody>  
  </table>
           </div>
                    </div>
                         </div>
                        <br>
                       </div>
         <div id="Flotantes" class="tab-pane fade in">
                    <div class="table-responsive">
                       
                        <br>
                        <div class="table-responsive">  
       <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 
            <div style="margin-left: 1%; margin-top: 1%;float: left">
         
                       </div>

  <table class="table">
    <tr class="bg-info">  
                <th>Codigo</th>
                <th>Descripcion</th>
                <th>Referencia</th>
                <th>Color</th>
                <th>Costo Promedio</th>
                <th><input type="checkbox" name="item"  onclick="marcar(this);"></th>
              
               
    </tr>   
    <tr class="bg-info">  
        <th><input type="text" id="fcodigo" style="width:100%"></th>
                <th><input type="text" id="fdescripcion" style="width:100%"></th>
                <th><input type="text" id="freferencia" style="width:100%"></th>
                <th><input type="text" id="" disabled style="width:100%"></th>
                <th><input type="text" id="" disabled style="width:100%"></th>
                <th>-</th>
              
               
    </tr> 
    <tbody id="mostrar_tabla_flotantes">

    </tbody>  
  </table>
           </div>
                    </div>
                </div>
                    </div>
                       <br>
                         </div> 
                  
                        </div>
 </div>

</div>
 </div> 
</div>
 <?php  }else {
    echo '<script>location.reload();</script>';  
}?>         
