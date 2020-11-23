<?php
include '../../../../../modelo/conexioni.php';
include '../../../../../modelo/conexion.php';
session_start();
date_default_timezone_set("America/Bogota" ) ; 
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
// JPARDOQ  27961
//       //Cannot add or update a child row: a foreign key constraint fails (`aluvmix`.`mov_inventario`, CONSTRAINT `mov_inventario_ibfk_2` FOREIGN KEY (`cod_empresa`) REFERENCES `inf_empresa` (`cod_empresa`))0
        
           case 1:
               $rad = $_GET['rad'];
               $cod = $_GET['cod'];
               $query = mysqli_query($con,"select * from mov_detalle_ubi where id_ref_mov='$rad' ");
               while($r = mysqli_fetch_array($query)){
                   echo '<tr><td>'.$r['codigo_pro'].'</td><td>'.$r['ubicacion'].'</td><td>'.$r['cantidad_mov'].'</td>';
               }
               
               break;
        
           case 2:
               $cod = $_GET['cod'];
               $loc = $_GET['loc'];
               $color = $_GET['color'];
               $med = $_GET['med'];
               $sto = $_GET['sto'];
               $pre = $_GET['pre'];
               $i = $_GET['i'];
               $sql = mysqli_query($con,"SELECT a.codigo_pro,b.descripcion,a.color_ubi,a.ubicacion,b.alto,a.costo_ultimo,stock_ubi,a.id_ru FROM relacion_ubicaciones a, productos_var b where a.codigo_pro=b.codigo and a.stock_ubi!=0 and b.codigo= '".$cod."' and a.bod_codigo='$loc' and a.color_ubi='$color'  ".$limit);
		$item = 0;
			if(mysqli_num_rows($sql)>0){
				while($mostrar = mysqli_fetch_array($sql)){
                                        $stc=0;
					$item = $item+1;
                                        $ubi = "'".$mostrar['ubicacion']."'";
                                       echo '<tr>
                                                <td>'.$mostrar['descripcion'].'</td>'
                                                . '<td><input type="text" id="ub'.$mostrar['id_ru'].'" value="'.$mostrar['ubicacion'].'" style="width:50px" disabled></td>'
                                                . '<td><input type="text" id="st'.$mostrar['id_ru'].'" value="'.$mostrar['stock_ubi'].'" style="width:50px" disabled></td>'
                                               . '<input type="hidden" id="color'.$mostrar['id_ru'].'" value="'.$mostrar['color_ubi'].'" style="width:50px">'
                                               . '<input type="hidden" id="cas'.$mostrar['id_ru'].'" value="'.$_GET['can'].'" style="width:50px" disabled></td>'
                                               . '<td> <button class="btn btn-success" onclick="seleccionarubi('.$ubi.','.$i.')"  data-dismiss="modal" aria-label="Close">Seleccionar</button> </td>'; }
			}else{
                            $cod = "'".$cod."'";
                            $color = "'".$color."'";
                            $med = "'".$med."'";
                            $sto = "'".$sto."'";
                            $bod = "'".$loc."'";
                            $pre = "'".$pre."'";
                            
				echo '<tr><td colspan="5">Deseas actualizar la ubicacion de esta referencia?'
                            . '<input type="text" value="" id="ubi" onclick="ubicaciones()" style="width:80px" placeholder="Ubicacion">'
                                        . '<button onclick="agregarubi('.$cod.','.$color.','.$med.','.$sto.','.$bod.','.$pre.')">Si</button> '
                    
                            . '<tr>'
                                        . '<td><input type="text" disabled id="a" style="width:80px" value="'.$cod.'">'
                                        . '<td><input type="text" disabled id="b" style="width:80px" value="'.$color.'">'
                                        . '<td><input type="text" disabled id="c" style="width:80px" value="'.$med.'">'
                                        . '<td><input type="text" disabled id="c" style="width:80px" value="'.$bod.'">'
                                        . '<td><input type="text" disabled id="c" style="width:80px" value="'.$sto.'">'
                                        . ' </td></tr>';
			}
               
               break;
           case 3:
               $cod = $_GET['cod'];
               $loc = $_GET['loc'];
               $color = $_GET['color'];
               $med = $_GET['med'];
               $sto = $_GET['sto'];
               $ubi = $_GET['ubi'];
               $pre = $_GET['pre'];
               mysqli_query($con,"INSERT INTO `relacion_ubicaciones` (`id_ru`, `codigo_pro`, `ubicacion`, `stock_ubi`, `fecha_ult_sal`, `ultimo_usuario`, `bod_codigo`, `cod_empresa`, `costo_ultimo`, `color_ubi`, `medida`)"
                       . " VALUES (NULL, '$cod', '$ubi', '$sto', '".date("Y-m-d")."', '".$_SESSION['k_username']."', '$loc', 'TEMPLADOS', '$pre', '$color', '$med')");
               
               break;
           case 4;
                $cod = $_GET['cod'];
               $loc = $_GET['loc'];
               $color = $_GET['color'];
               $med = $_GET['med'];
               $sto = $_GET['sto'];
               $ubi = $_GET['ubi'];
               $pre = $_GET['pre'];
               $result = mysqli_query($con, "SELECT sum(stock_ubi) FROM `relacion_ubicaciones` where codigo_pro='$cod' and bod_codigo='$loc' and color_ubi='$color' ");
                $r = mysqli_fetch_row($result);
                $saldo = $r[0];
                if($saldo!==$sto){
                    $result2 = mysqli_query($con, "SELECT id_ru FROM `relacion_ubicaciones` where codigo_pro='$cod' and bod_codigo='$loc' and color_ubi='$color' ");
                   $row = mysqli_fetch_row($result2);
                    $id = $row[0];
                    if($id==null){
                        mysqli_query($con,"INSERT INTO `relacion_ubicaciones` (`id_ru`, `codigo_pro`, `ubicacion`, `stock_ubi`, `fecha_ult_sal`, `ultimo_usuario`, `bod_codigo`, `cod_empresa`, `costo_ultimo`, `color_ubi`, `medida`)"
                       . " VALUES (NULL, '$cod', 'A1', '$sto', '".date("Y-m-d")."', '".$_SESSION['k_username']."', '$loc', 'TEMPLADOS', '$pre', '$color', '$med')");
                        
                    }else{
                        mysqli_query($con,"update relacion_ubicaciones set stock_ubi='$sto' where id_ru='$id'  ");
                        
                    }
                    echo 'SI';
                }else{
                    echo 'NO';
                }
               
               break;
               
    
}

