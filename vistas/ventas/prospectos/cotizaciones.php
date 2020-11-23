
<?php include '../../../modelo/conexioni.php';?>
<?php
$request=mysqli_query($con,'select count(*) from cotizaciones_prospectos where id_obra="'.$_GET['id_obra'].'" ');
if($request){
	$request = mysqli_fetch_row($request);
	$num_items = $request[0];
}else{
	$num_items = 0;
}
$rows_by_page = 10;

$last_page = ceil($num_items/$rows_by_page);

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}


$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
?>
<table class="table table-bordered table-striped table-hover" id="">
                                    <tr>
                                        <td style="text-align: center;background: #C6C6C6" colspan="6">COTIZACIONES DE LA OBRA</td> 
                                    </tr>
</table> 
<div style="float: left">
<?php
if($page>1){?>
	<a href="javascript:void(0)" onclick="lista_cotizaciones(1);"><img src="../../images/a1.png"></a>
	<a href="javascript:void(0)" onclick="lista_cotizaciones(<?php echo $page - 1;?>);"><img src="../../images/a11.png"></a>
<?php
}else{
	?><img src="../../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="javascript:void(0)" onclick="lista_cotizaciones(<?php echo $page + 1;?>);"><img src="../../images/p1.png"></a>
	<a href="javascript:void(0)"  onclick="lista_cotizaciones(<?php echo $last_page;?>);"><img src="../../images/p11.png"></a>
<?php
}else{
	?><img src="../../images/nex.png">    <?php 
}
echo 'Cantidad de Cotizaciones: '.$num_items.' <span id="imagenes"></span>'; 
?><input type="hidden" id="page4" value="<?php echo $page; ?>">
</div><br><hr>
<form id="subida_cot">
<table class="table table-bordered table-striped table-hover" id="">
                                    <tr>
                                        <th style="text-align: center">Numero de cotizacion</th>
                                        <th style="text-align: center">Analista</th>
                                        <th style="text-align: center">Asesor </th>
                                        <th style="text-align: center">Fecha Cotizada </th>
                                        <th style="text-align: center">Estado </th>
                                        <th style="text-align: center">PDF </th>
                                        <th style="text-align: center">Acciones </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <input type="hidden" class="form-control" id="idcot" name="idcot"  value=""/>
                                            <input type="hidden" class="form-control" id="obrac" name="obrac"  value="<?php echo $_GET['id_obra']; ?>" />
                                            <input type="text"   class="form-control"   id="numero" name="numero" value="" /></th>
                                        <th>
                                     <select id="analista" name="analista" class="form-control">
                                     <option value="">Seleccione Analista</option>
                      <?php
                         $asignados4 = mysqli_query($con,"select * from usuarios where cargo='Presupuesto' ");
                         while($a = mysqli_fetch_array($asignados4)){
                             echo '<option value="'.$a['usuario'].'">'.$a['nombre'].' '.$a['apellido'].'</option>';
                         }
                      ?>0
                      </select></th>
                       <th>
                           <select id="asesor" name="asesor" class="form-control">
                            <option value="">Seleccione Asesor</option>
                              <?php
                                $asignados5 = mysqli_query($con,"select * from usuarios where area='Ventas' ");
                                while($a = mysqli_fetch_array($asignados5)){
                                echo '<option value="'.$a['usuario'].'">'.$a['nombre'].' '.$a['apellido'].'</option>';
                                }
                              ?>
                            </select>
                       </th>
                        <th><input type="date" id="obs_cot" name="obs_cot"  class="form-control"/></th>
                        <th><input type="text" id="est_cot" name="est_cot"  class="form-control"/></th>
                        <th><input type="text" id="foto" name="foto" placeholder="link del pdf" class="form-control"/></th>
                        <th><input type="button" value="Agregar" id="loadi" onclick="new_cotizacion();"/></th>
                    </tr>
                                    <?php
                                    $contactos = mysqli_query($con,"select * from cotizaciones_prospectos where id_obra=".$_GET['id_obra']." ".$limit);
                                    while($c = mysqli_fetch_array($contactos)){
                                        echo '<tr>';
                                        echo '<td>'.$c[2].'</td> ';
                                        echo '<td>'.$c[5].'</td> ';
                                        echo '<td>'.$c[6].'</td> ';
                                        echo '<td>'.$c[9].'</td> ';
                                        echo '<td>'.$c[7].'</td> ';
                                        echo '<td><a href="info.php?id='.$_GET['id_obra'].'&archivo_cot='.$c[4].'">'.$c[4].'</a> ';
                                        echo '<td><button onclick="editar_cotizacion('.$c[0].');" type="button">Editar</button></td>';
                                    }
                                    ?>
                                </table>  </form>

