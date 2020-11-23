<?php include '../../../modelo/conexioni.php'; ?>
<?php
$request=mysqli_query($con,'select count(*) from sis_contacto where id_obra="'.$_GET['id_obra'].'" ');
if($request){
	$request = mysqli_fetch_row($request);
	$num_items = $request[0];
}else{
	$num_items = 0;
}
$rows_by_page = 5;

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
                                        <td style="text-align: center;background: #C6C6C6" colspan="6">CONTACTOS DE LA OBRA</td> 
                                    </tr>
</table> 
<div style="float: left">
<?php
if($page>1){?>
	<a href="javascript:void(0)" onclick="lista_contactos(1);"><img src="../../images/a1.png"></a>
	<a href="javascript:void(0)" onclick="lista_contactos(<?php echo $page - 1;?>);"><img src="../../images/a11.png"></a>
<?php
}else{
	?><img src="../../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="javascript:void(0)" onclick="lista_contactos(<?php echo $page + 1;?>);"><img src="../../images/p1.png"></a>
	<a href="javascript:void(0)"  onclick="lista_contactos(<?php echo $last_page;?>);"><img src="../../images/p11.png"></a>
<?php
}else{
	?><img src="../../images/nex.png">    <?php 
}
echo 'Cantidad de Contactos: '.$num_items; 
?><input type="hidden" id="page" value="<?php echo $page; ?>">
</div>   <div style="float: right"></div><br><hr>
<table class="table table-bordered table-striped table-hover" id="">
                                    <tr>
                                        <th style="text-align: center">Nombre del Contacto </th>
                                        <th style="text-align: center">Cel / Tel. </th>
                                        <th style="text-align: center">Cargo</th>
                                        <th style="text-align: center">Area</th>
                                        <th style="text-align: center">Email</th>
                                        <th style="text-align: center">Acciones </th>
                                    </tr>
                                    <tr id="nuevo_contacto">
                                        <th>
                                            <input type="hidden" class="form-control" id="idp"  value="" disabled/>
                                            <input type="hidden" class="form-control" id="idc"  value="" disabled/>
                                            <input type="" id="nom" placeholder="" style="width:100%">
                                        </th>
                                        <th>
                                            <input type="" id="tel" placeholder="" style="width:100%"></th>
                                        <th><input type="" id="cargo" placeholder="" style="width:100%"></th>
                                        <th><input type="" id="area" placeholder="" style="width:100%"></th>
                                        <th><input type="" id="email" placeholder="" style="width:100%"></th>
                                        <th><input type="button"  onclick="add_contacto()" id="btn" placeholder="" value="Guardar"></th>
                                    </tr>
                                    <?php
                                    $contactos = mysqli_query($con,"select * from sis_contacto where id_obra=".$_GET['id_obra']." ".$limit);
                                    while($c = mysqli_fetch_array($contactos)){
                                        echo '<tr>';
                                        echo '<td>'.$c[1].' '.$c[2].'</td>';
                                        echo '<td>'.$c[13].' '.$c[15].'</td>';
                                        echo '<td>'.$c[7].'</td>';
                                        echo '<td>'.$c[8].'</td>';
                                        echo '<td>'.$c[26].'</td>';
                                        echo '<td><button onclick="new_contacto('.$c[0].');">Editar</button></td>';
                                    }
                                    ?>
                                </table>
