<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id'];
            $desc_inst=$_GET['desc_inst'];
            $sis_inst=$_GET['sis_inst'];
            $vt1=$_GET['vt1'];
            $vt2=$_GET['vt2'];
            $por_of=$_GET['por_of'];
            $por_ayu=$_GET['por_ayu'];
            $est_precio=$_GET['est_precio'];
            $inst_usu=$_GET['inst_usu'];
            $fech_inst=$_GET['fech_inst'];    
            $unid_inst=$_GET['unid_inst']; 
            $parafis_inst=$_GET['parafis_inst'];
           
            if($id==''){
                $ver=mysqli_query($con, "insert into precios_instalaciones (`nom_insta`,`sistema_insta`,`total_1`,`total_2`,`porcen_ofi`,`porcen_ayu`,`estado_insta`,`registra`,`fecha`,`umb`,`parafiscales`)" 
                        . "values ('$desc_inst','$sis_inst','$vt1','$vt2','$por_of','$por_ayu','$est_precio','$inst_usu','$fech_inst','$unid_inst','$parafis_inst')");
                echo mysqli_error($con);
                $query = mysqli_query($con,"select max(id_precios) from precios_instalaciones");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_precios)'];
                echo $ultimo;
                $id = $ultimo;
            }
            else{
                mysqli_query($con,"update precios_instalaciones set nom_insta='$desc_inst', sistema_insta='$sis_inst', total_1='$vt1', total_2='$vt2', porcen_ofi='$por_of', porcen_ayu='$por_ayu', estado_insta='$est_precio' , registra='$inst_usu', fecha='$fech_inst', umb='$unid_inst', parafiscales='$parafis_inst'  where id_precios='$id'");
                echo $id;
            }
            $query = mysqli_query($con, "select sistema from precios_instalaciones_sistemas where id_precios='".$id."' ");
                $sistema = '';
                while($s = mysqli_fetch_array($query)){
                  $sistema = $sistema.$s[0].'-';
                }
                mysqli_query($con,"update precios_instalaciones set gruposistemas='$sistema' where id_precios='$id'");
            break;
             case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM precios_instalaciones where id_precios='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array(); 
                 $p[0]=$fila['id_precios'];
                 $p[1]=$fila['nom_insta'];
                 $p[2]=$fila['sistema_insta'];
                 $p[3]=$fila['total_1']; 
                 $p[4]=$fila['total_2'];
                 $p[5]=$fila['porcen_ofi'];
                 $p[6]=$fila['porcen_ayu'];
                 $p[7]=$fila['estado_insta'];
                 $p[8]=$fila['registra'];
                 $p[9]=$fila['fecha'];
                 $p[10]=$fila['umb'];
                 $p[11]=$fila['parafiscales'];
                      
          
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = ("delete from precios_instalaciones where id_precios='$id' ");
            break;
            case 4:
                 $id=$_GET['cod'];
                $query = mysqli_query($con,"SELECT * FROM servicios_c where id='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array(); 
                 $p[0]=$fila['id'];
                 $p[1]=$fila['descripcion_s'];
                 $p[2]=$fila['valor_unidad']; 
                 $p[3]=$fila['estado'];
          
                 
            echo json_encode($p); 
            exit();
            break;
        case 5:
            $codigo = $_GET['codigo'];
            $sis = $_GET['sis'];
            $result = mysqli_query($con, "select count(id_precios) from precios_instalaciones_sistemas where id_precios='$codigo' and sistema='$sis' ");
            $r = mysqli_fetch_array($result);
            if($r[0]==0){
               mysqli_query($con, "insert into  precios_instalaciones_sistemas (id_precios,sistema) values ('$codigo','$sis')");
               
                
                
            }
            $query = mysqli_query($con, "select sistema from precios_instalaciones_sistemas where id_precios='".$codigo."' ");
                $sistema = '';
                while($s = mysqli_fetch_array($query)){
                  $sistema = $sistema.$s[0].'-';
                }
                mysqli_query($con,"update precios_instalaciones set gruposistemas='$sistema' where id_precios='$codigo'");
            
            break;
         case 6:
            $codigo = $_GET['codigo'];
            $result = mysqli_query($con,"select * from precios_instalaciones_sistemas where id_precios='$codigo' ");
             while($r = mysqli_fetch_array($result)){
                 echo '<tr>'
                 . '<td>'.$r[1].'</td>'
                 . '<td>'.$r[2].'</td>'
                 . '<td><button onclick="del_sis('.$r[0].','.$codigo.')">-</button></td>'
                 . '</tr>';
            }
            break;
            case 7:
            $id=$_GET['id'];
            $idk=$_GET['idp'];
            $query = mysqli_query($con,"delete from precios_instalaciones_sistemas where idks='$id' ");
            $query2 = mysqli_query($con, "select sistema from precios_instalaciones_sistemas where id_precios='".$idk."' ");
                $sistema = '';
                while($s = mysqli_fetch_array($query2)){
                  $sistema = $sistema.$s[0].'-';
                }
                mysqli_query($con,"update precios_instalaciones set gruposistemas='$sistema' where id_precios='$idk'");
            
            break;
            case 8:
               $id=$_GET['id'];
               $est=$_GET['est'];
            if($est==0){
                $est_kit='1';
            }else{
                $est_kit='0';
            }
            mysqli_query($con,"update precios_instalaciones set estado_insta='$est_kit' where id_precios='$id'");
        $query = mysqli_query($con, "select sistema from precios_instalaciones_sistemas where id_precios='".$id."' ");
                $sistema = '';
                while($s = mysqli_fetch_array($query)){
                  $sistema = $sistema.$s[0].'-';
                }
                mysqli_query($con,"update precios_instalaciones set gruposistemas='$sistema' where id_precios='$id'");
            break;
     
}