<?php
include('../../../modelo/conexioni.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['idm'];
            $codm=$_GET['codmatm'];
            $desma=$_GET['descmam'];
            $rema=$_GET['refmam'];
            $canma=$_GET['cantmam'];
            $manda=$_GET['dadomam'];
            $manpes=$_GET['pesomam'];
            $magru=$_GET['grupmam'];
            $manmedi=$_GET['medimam'];
            $manuni=$_GET['unimam'];
            $maval=$_GET['valmam'];
            $manau=$_GET['aummam'];
            $utipor=$_GET['porutm'];
            $mades=$_GET['desmam'];
            if($id==''){
                $ver=mysqli_query($con,"insert into referencias (`codigo`,`descripcion`,`referencia`,`cantidad_e`,`dado`,`peso`,`grupo`,`medida`,`und_medida`,`costo_mt`,`aumento`,`utilidad`,`max_desc`) values ('$codm','$desma','$rema','$canma','$manda','$manpes','$magru','$manmedi','$manuni','$maval','$manau','$utipor','$mades')");
                
                $query = mysqli_query($con,"select max(id_referencia) from referencias");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_referencia)'];
                echo $ultimo;
            }
            else{
             
                mysqli_query($con,"update referencias set codigo='$codm',descripcion='$desma',referencia='$rema',cantidad_e='$canma',dado='$manda',peso='$manpes',grupo='$magru',medida='$manmedi',und_medida='$manuni',costo_mt='$maval',aumento='$manau',utilidad='$utipor',max_desc='$mades' where id_referencia='$id'");
                echo $id;
            }
            
        break;
        case 2:
            $id=$_GET['id'];
            $query = mysqli_query($con,"SELECT * FROM referencias where id_referencia='$id' "); //consultA modificada por navabla
            $fila = mysqli_fetch_array($query);
            $p = array();
            $p[0]=$fila['id_referencia']; 
            $p[1]=$fila['codigo'];
            $p[2]=$fila['descripcion'];
            $p[3]=$fila['referencia'];
            $p[4]=$fila['cantidad_e'];
            $p[5]=$fila['dado'];
            $p[6]=$fila['peso']; 
            $p[7]=$fila['grupo'];
            $p[8]=$fila['medida'];
            $p[9]=$fila['und_medida'];
            $p[10]=$fila['costo_mt'];
            $p[11]=$fila['aumento'];
            $p[12]=$fila['utilidad'];
            $p[13]=$fila['max_desc'];
            echo json_encode($p); 
            exit();
            break;
   
        case 3:
          
            $cod=$_GET['cod'];
             $area=$_GET['area'];
              $areat=$_GET['areat'];
              $peso=$_GET['peso'];
             mysqli_query($con, "update productos_var set peso='$peso', area='$area',areat='$areat' where referencia='$cod' ");
        
            break;
        case 4:
             $id=$_GET['id'];
             $linea=$_GET['linea'];
             if($linea=='Aluminio'){
                 $cadena = $id;
                 $pieces = explode("-", $cadena);
                 $ref = substr($pieces[1],-2);
                 $med = $ref.'00';
                  mysqli_query($con, "update productos_var set linea='$linea',  ancho='$med' where codigo='$id' "); // se quito referencia='$pieces[0]',
             }else{
                  mysqli_query($con, "update productos_var set linea='$linea' where codigo='$id' ");
             }
            
             echo 'Se edito con exito';
            break;
        
        
         
      
}

