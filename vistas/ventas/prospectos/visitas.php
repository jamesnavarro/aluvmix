<?php include '../../../modelo/conexioni.php'; ?>
<?php
$request=mysqli_query($con,'select count(*) from actividad where id_seleccionado="'.$_GET['id_obra'].'" ');
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
                                        <td style="text-align: center;background: #C6C6C6" colspan="6">TAREAS DE LA OBRA</td> 
                                    </tr>
</table> 
<div style="float: left">
<?php
if($page>1){?>
	<a href="javascript:void(0)" onclick="lista_visitas(1);"><img src="../../images/a1.png"></a>
	<a href="javascript:void(0)" onclick="lista_visitas(<?php echo $page - 1;?>);"><img src="../../images/a11.png"></a>
<?php
}else{
	?><img src="../../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="javascript:void(0)" onclick="lista_visitas(<?php echo $page + 1;?>);"><img src="../../images/p1.png"></a>
	<a href="javascript:void(0)" onclick="lista_visitas(<?php echo $last_page;?>);"><img src="../../images/p11.png"></a>
<?php
}else{
	?><img src="../../images/nex.png">    <?php 
}
echo 'Cantidad de Visitas: '.$num_items; 
?><input type="hidden" id="page2" value="<?php echo $page; ?>">
</div>   <div style="float: right"><button onclick="new_visita();">Programar</button></div><br><hr>
<table class="table table-bordered table-striped table-hover" id="">
                                    <tr>
                                        <th style="text-align: center">Nombre del Asunto</th>
                                        <th style="text-align: center">Lugar </th>
                                        <th style="text-align: center">Fecha Inicio</th>
                                        <th style="text-align: center">Tipo</th>
                                        <th style="text-align: center">Estado</th>
                                        <th style="text-align: center">Acciones </th>
                                    </tr>
                                    <?php
                                    $contactos = mysqli_query($con,"select * from actividad where id_seleccionado=".$_GET['id_obra']." ".$limit);
                                    while($c = mysqli_fetch_array($contactos)){
                                        echo '<tr>';
                                        echo '<td>'.$c[1].'</td>';
                                        echo '<td>'.$c[2].'</td>';
                                        echo '<td>'.$c[4].' al '.$c[5].'</td>';
                                        echo '<td>'.$c[16].'</td>';
                                        echo '<td>'.$c[9].'</td>';
                                        echo '<td><button onclick="new_visita('.$c[0].');">Editar</button></td>';
                                    }
                                    ?>
                                </table>

