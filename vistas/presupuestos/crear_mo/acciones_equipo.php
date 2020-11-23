<?php
include('../../../modelo/conexioni.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            $idquip=$_GET['id_equip'];
            $re_fe=$_GET['refequin'];
            $des_eq=$_GET['desequin'];
            $val_eq=$_GET['valequin'];
            $equi_cal=$_GET['calequin'];
            $equi_dia=$_GET['diasequin'];
            $num_di=$_GET['numequin'];

            if($id==''){
               
                $ver=mysqli_query($con,"insert into referencia_ma (`referencia`,`descripcion_ma`,`porcentaje_ma`,`calcular`,`dias`,`cant_dias`) values ('$re_fe','$des_eq','$val_eq','$equi_cal','$equi_dia','$num_di')");
                
                $query = mysqli_query($con,"select max(id_ref_ma) from referencia_ma");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_ref_ma)'];
                echo $ultimo;
            }
            else{
             
                mysqli_query("update referencia_ma set referencia='$re_fe',descripcion_ma='$des_eq',porcentaje_ma='$val_eq',calcular='$equi_cal',dias='$equi_dia',cant_dias='$num_di' where id_ref_mo='$id'");
              
                echo $id;
            }
            
        break;
        case 2:
            $id=$_GET['id'];
            $query = mysqli_query("SELECT * FROM referencia_ma where id_ref_ma='$id' "); //consultA modificada por navabla
            $fila = mysqli_fetch_array($query);
            $p = array();
            $p[0]=$fila['id_ref_ma']; 
            $p[1]=$fila['referencia'];
            $p[2]=$fila['descripcion_ma'];
            $p[3]=$fila['porcentaje_ma'];
            $p[4]=$fila['calcular'];
            $p[5]=$fila['dias'];
            $p[6]=$fila['cant_dias'];
            echo json_encode($p); 
            exit();
       break;
   
        case 3:
          
            $id=$_GET['id'];
        
            $query = mysqli_query("delete from referencia_ma where id_ref_ma='$id' ");
            
            break;
      
}

