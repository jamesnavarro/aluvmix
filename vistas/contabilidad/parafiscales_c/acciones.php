<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id'];
            $descrip_paraf=$_GET['descrip_paraf'];
            $instala_paraf=$_GET['instala_paraf'];
            $fabri_paraf=$_GET['fabri_paraf'];
           
            if($id==''){
                $ver=mysqli_query($con,"insert into parafiscales (`descripcion_p`,`Instaladores`,`Fabricantes`)"
                        . "values ('$descrip_paraf','$instala_paraf','$fabri_paraf')");
                echo mysqli_error($con);
                $query = mysqli_query($con,"select max(id_para) from parafiscales");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_para)'];
                echo $ultimo;
            }
            else{
                mysqli_query($con,"update parafiscales set descripcion_p='$descrip_paraf', Instaladores='$instala_paraf', Fabricantes='$fabri_paraf' where id_para='$id'");
                echo $id;
            }
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM parafiscales where id_para='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array(); 
                 $p[0]=$fila['id_para'];
                 $p[1]=$fila['descripcion_p'];
                 $p[2]=$fila['Instaladores']; 
                 $p[3]=$fila['Fabricantes'];
            echo json_encode($p); 
            exit();
            break;
        
            case 3:
               $id=$_GET['id'];
               $query = ("delete from parafiscales where id_para='$id'");
            break;
        
            case 4:
                 $id=$_GET['cod'];
                $query = mysqli_query($con,"SELECT * FROM parafiscales where id_para='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array(); 
                  $p[0]=$fila['id_para'];
                 $p[1]=$fila['descripcion_p'];
                 $p[2]=$fila['Instaladores']; 
                 $p[3]=$fila['Fabricantes'];              
            echo json_encode($p); 
            exit();
            break;
     
}