<?php
include('../../modelo/conexion.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id_liss'];
            $subnom=$_GET['nomsubs'];
            $subvl=$_GET['valsubs'];
            $subano=$_GET['anosubs'];
            $subtra=$_GET['transubs'];
            $linsub=$_GET['slineass'];
          

            if($id==''){
               
                $ver=mysqli_query($con,"insert into  sublineas (`descripcion_sl`,`precio_kg`,`anonisado`,`transporte`,`id_linea`) values ('$subnom','$subvl','$subano','$subtra','$linsub' )");
                
                $query = mysqli_query($con,"select max(id_sublineas) from sublineas");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_sublineas)'];
                echo $ultimo;
            }
            else{
             
                mysqli_query($con,"update sublineas set descripcion_sl='$subnom',precio_kg='$subvl',anonisado='$subano',transporte='$subtra',id_linea='$linsub' where id_sublineas='$id'");
              
                echo $id;
            }
            
        break;
        case 2:
            $id=$_GET['id'];
            $query = mysqli_query($con,"SELECT * FROM sublineas where id_sublineas='$id' "); //consultA modificada por navabla
            $fila = mysqli_fetch_array($query);
            $p = array();
            $p[0]=$fila['id_sublineas']; 
            $p[1]=$fila['descripcion_sl'];
            $p[2]=$fila['precio_kg']; 
            $p[3]=$fila['anonisado'];
            $p[4]=$fila['transporte']; 
            $p[5]=$fila['id_linea'];
          
            echo json_encode($p); 
            exit();
       break;
   
    case 3:
          
            $id=$_GET['id'];
            $query = mysqli_query($con,"delete from sublineas where id_sublineas='$id' ");
            
    break;
}

