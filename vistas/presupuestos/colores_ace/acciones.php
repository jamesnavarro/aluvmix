<?php
include('../../../modelo/conexioni.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            $codigo=$_GET['codigo'];
            $descripcion=$_GET['descripcion'];
            $est_ace=$_GET['est_ace'];
            if($codigo==''){
               
                mysqli_query($con,"insert into colores_acc (color,estado) values ('$descripcion','$est_ace')"); 
                echo mysqli_insert_id($con);
                
            }
            else{
             
                mysqli_query($con,"update colores_acc set color='$descripcion', estado='$est_ace' where id_color='$codigo'");
                echo $codigo;
            }
            
        break;
        case 2:
            $id=$_GET['id'];
            $query = mysqli_query($con,"SELECT * FROM colores_acc where id_color='$id' "); //consultA modificada por navabla
            $fila = mysqli_fetch_array($query);
            $p = array();
            $p[0]=$fila[0]; 
            $p[1]=$fila[1];
            $p[2]=$fila[2];
            echo json_encode($p); 
            exit();
       break;
   
    case 3:
          //980042420085
            $id=$_GET['id'];
            $query = mysqli_query($con,"delete from colores_acc where id_color='$id' ");
            
    break;
        case 4:
            $codigo=$_GET['codigo'];
            $cod_pro=$_GET['ref'];
            $des_pro=$_GET['des'];
            $can_pro=$_GET['can'];
            mysqli_query($con,"insert into  receta_kits_items (idkit,codigo_pro,descripcion_pro,cantidad) values ('$codigo','$cod_pro','$des_pro','$can_pro')"); 
            echo mysqli_insert_id($con);
            
            $result = mysqli_query($con,"select costo_promedio from productos_var  where codigo='$cod_pro' ");
            $r = mysqli_fetch_array($result);
            $costo = $r[0];

            break;
        case 5:
            $codigo=$_GET['codigo'];
            $result = mysqli_query($con,"select * from receta_kits_items a, productos_var b where a.codigo_pro=b.codigo and a.idkit='$codigo' ");
            $costo=0;
            while($r = mysqli_fetch_array($result)){
                $costo +=$r['costo_promedio'];
                echo '<tr>';
                echo '<td>'.$r[2].'</td><td>'.$r[3].'</td><td>'.$r[4].'</td><td style="text-align:right">$ '.number_format($r['costo_promedio']).'</td><td><button onclick="delkititem('.$r[0].')">-</button></td>';
            }
            echo '<tr><td colspan="3"></td><td style="text-align:right">'.number_format($costo).'</td><td></td>';
             mysqli_query($con,"update receta_kits set valor='$costo' where idkit='$codigo' ");
            
            break;
        case 6:
            $id=$_GET['id'];
            $query = mysqli_query($con,"delete from receta_kits_items where id='$id' ");
            
            
            break;
        case 7:
            $codigo = $_GET['codigo'];
            $sis = $_GET['sis'];
            mysqli_query($con, "insert into  receta_kits_sistemas (idkit,sistema) values ('$codigo','$sis')");
            
            
            break;
        case 8:
            $codigo = $_GET['codigo'];
            $result = mysqli_query($con,"select * from receta_kits_sistemas where idkit='$codigo' ");
             while($r = mysqli_fetch_array($result)){
                 echo '<tr>'
                 . '<td>'.$r[1].'</td>'
                 . '<td>'.$r[2].'</td>'
                 . '<td><button onclick="del_sis('.$r[0].')">-</button></td>'
                 . '</tr>';
            }
            break;
            case 9:
            $id=$_GET['id'];
            $query = mysqli_query($con,"delete from receta_kits_sistemas where idks='$id' ");
            
            
            break;
}

