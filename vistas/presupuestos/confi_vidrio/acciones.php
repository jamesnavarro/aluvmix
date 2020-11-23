<?php
include('../../../modelo/conexioni.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['idv'];
            $codi=$_GET['codiviv'];
            $colvis=$_GET['colviv'];
            $revi=$_GET['refviv'];
            $espvi=$_GET['espeiv'];
            $alcos=$_GET['vicostv'];
            $desc=$_GET['desc'];
            if($id==''){
                $ver=mysqli_query($con,"insert into tipo_vidrio (`descripcion_inventario`,`codigo_vid`,`color_v`,`referencia_vid`,`espesor_v`,`costo_v`)"
                        . " values ('$desc','$codi','$colvis','$revi','$espvi','$alcos')");
                
                $query = mysqli_query($con,"select max(id_vidrio) from tipo_vidrio");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_vidrio)'];
                echo $ultimo;
            }
            else{
             
                mysqli_query($con,"update tipo_vidrio set descripcion_inventario='$desc',codigo_vid='$codi',color_v='$colvis',referencia_vid='$revi',espesor_v='$espvi',costo_v='$alcos' where id_vidrio='$id'");
                echo $id;
            }
            
        break;
        case 2:
            $id=$_GET['id'];
            $query = mysqli_query($con,"SELECT * FROM tipo_vidrio where codigo_vid='$id' "); //consultA modificada por navabla
            $fila = mysqli_fetch_array($query);
            $p = array();
            $p[0]=$fila['id_vidrio']; 
            $p[1]=$fila['codigo_vid'];
            $p[2]=$fila['color_v'];
            $p[3]=$fila['referencia_vid'];
            $p[4]=$fila['espesor_v'];
            $p[5]=$fila['costo_v'];
            
            $query2 = mysqli_query($con,"SELECT * FROM productos_var where codigo='$id' "); //consultA modificada por navabla
            $fila2 = mysqli_fetch_array($query2);
            $p[6]=$fila2['descripcion'];
            echo json_encode($p); 
            exit();
            break;
   
        case 3:
          
            $id=$_GET['id'];
        
            $query = mysqli_query($con,"delete from tipo_vidrio where id_vidrio='$id' ");
            
            break;
        
        
          case 4:
        $id= $_GET["id"];
        $est= $_GET["est"];

        mysqli_query($con,"update tipo_vidrio set estado='$est', modi='".$_SESSION['k_username']."' where id_vidrio='$id' ");
        echo $_SESSION['k_username'];

        break;
      
}

