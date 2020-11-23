<?php
include 'conexion.php';
session_start();
switch ($_GET['sw']) {
            case 0:
                    $pro = $_GET['pro'];
                    $ref = $_GET['ref'];
                    $lado = $_GET['lado'];
                    $can = $_GET['can'];
                    $med = $_GET['med'];
                    $id = $_GET['id'];
                    if($id==''){
                    mysqli_query($con,"insert into desgloses (medida_des,id_producto, id_referencia, lado, cantidad) values ('$med','$pro','$ref','$lado','$can');");
                    }else{
                        mysqli_query($con,"update desgloses set medida_des='$med',id_referencia='$ref',lado='$lado', cantidad='$can'   where id_desglose=$id ");
                    }
        break;
            case 1:
            mysqli_query($con,"DELETE FROM desgloses WHERE id_desglose='".$_GET['id']."' ");
        break;
            case 2:
                    $request=mysqli_query($con,"SELECT * FROM desgloses a, referencias b where a.id_referencia=b.id_referencia and a.id_producto=".$_GET['cod']." ");
   
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="tabla2">';

             $table = $table.'<thead >';
            $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="10%">'.'Codigo'.'</th>';
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Referencia'.'</th>';
              $table = $table.'<th width="10%">'.'Dado'.'</th>';
              $table = $table.'<th width="10%">'.'Lado'.'</th>'; 
              $table = $table.'<th width="10%">'.'medida'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Segmentos'.'</th>';
              $table = $table.'<th>Editar</th>';
              $table = $table.'<th>Eliminar</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $ta =0;
	while($row=mysqli_fetch_array($request))
	{    
            if($row['lado']=='Horizontal'){
                if($row['medida_des']==3){$med = $_GET['anchura'];}
                if($row['medida_des']==4){$med = $_GET['anchura_v_c'];}
                if($row['medida_des']==6){$med = $_GET['ancho'];}
            
            }else{
                if($row['medida_des']==2){$med = $_GET['altura'];}
                if($row['medida_des']==1){$med = $_GET['altura_v_c'];}
                if($row['medida_des']==5){$med = $_GET['alto'];}
            }
            
            $table = $table.'<tr>'
                    . '<td width="10%">'.$row['codigo'].'</a></td>'
                    . '<td width="40%">'.$row['descripcion'].'</td>'
                    . '<td width="10%">'.$row['referencia'].'</td>'
                    . '<td width="10%">'.$row['dado'].'</td>'
                    . '<td width="10%">'.$row['lado'].'</td>'
                    . '<td width="10%">'.$med.' mm . </td>'
                    . '<td width="10%">'.$row["cantidad"].'<font></a></td>'
                    . '<td><a  href="#tab3"  data-toggle="tab" onclick="up_desglose('.$row["id_desglose"].','.$_GET['cod'].');"><button>Editar</button></a></td>'
                    . '<td><a href="javascript:void(0)" onclick="del_desglose('.$row["id_desglose"].','.$_GET['cod'].');"><button>Eliminar</button></a></td></tr>';   
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
  
}
        
        
        break;
            case 3:
                    $cod = $_GET['cod'];
                    $des = $_GET['des'];
                    $request=mysqli_query($con,"SELECT * FROM desgloses a, referencias b where a.id_referencia=b.id_referencia and a.id_desglose=".$des." ");
                    $r = mysqli_fetch_array($request);
                    $p = array();
                    $p[0] = $r['id_desglose'];
                    $p[1] = $r['id_referencia'];
                    $p[2] = $r['lado'];
                    $p[3] = $r['cantidad'];
                    $p[4] = $r['medida_des'];
                    $p[5] = $r['descripcion'];
                    $p[6] = $r['referencia'];
                    $p[7] = $r['id_producto'];
                    
                    echo json_encode($p);
                    exit();
                break;
            case 4:
                    $id = $_GET['id'];
                    $ok = $_GET['ok'];
                    if($ok==0){
                        $o = 1;
                    }else{
                        $o = 0;
                    }
                    mysqli_query($con,"update producto set ok='$o'  where id_p=$id ");
                    
                     echo '<button id="ok" type="button" onclick="okr('.$id.','.$o.')">'.$led.' Ok</button>';
                break;
                case 5:
                    $id = $_GET['id'];
                    $ok = $_GET['ok'];
                    if($ok==0){
                        $o = 1;
                    }else{
                        $o = 0;
                    }
                    mysqli_query($con,"update producto set estado_producto='$o' , anulado_por='".$_SESSION['k_username']."'  where id_p=$id ");
                    
                     if($o==0){
             $btn = '<font color="green">Producto Activo</font>';
         }else{
             $btn = '<font color="red">Producto Inactivo</font>';
         }
                     echo '<button id="est" type="button" onclick="anular('.$id.','.$o.')">'.$btn.'</button>';
                break;
                    
}

