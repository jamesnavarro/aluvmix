<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $cod=$_GET['teridentifi'];
            $tercodveri=$_GET['tercodverif'];
            $ternombr=$_GET['ternombre'];
            $tertip=$_GET['tertipo'];
            $terdireccio=$_GET['terdireccion'];
            $tertelefon=$_GET['tertelefono'];
            $termovi=$_GET['termovil'];
            $terde=$_GET['terdep'];
            $termun=$_GET['termuni'];
            $pais=$_GET['terpais'];
            $nacido=$_GET['terfnacido'];
            $correot=$_GET['tercorreo'];
            $contac=$_GET['tercontacto'];
            $alumi=$_GET['terdesalum'];
            $vidrio=$_GET['terdesvidrio'];
            $acero=$_GET['terdesacero'];
            $estad=$_GET['terestado'];
            $especial=$_GET['tercliespeci'];
            $terretefuent=$_GET['terretefuente'];
            $tereteica=$_GET['terreteica'];
            $terreteivt=$_GET['terreteiva'];
            $terretcre=$_GET['terretcree'];
            $teraseso=$_GET['terasesor'];
            $tipcli=$_GET['tipocliente'];
           
            $result = mysqli_query($con,"select count(*) from cont_terceros where cod_ter='$cod' ");
            $f = mysqli_fetch_array($result);
            
            if($f[0]==0){
                $ver=mysqli_query($con,"insert into cont_terceros (`cod_ter`,`nom_ter`,`doc_ter`,`dir_ter`,`telfijo_ter`,`telmovil_ter`,`municipio_ter`,'ciudad_ter',`pais_ter`,`fecnac_ter`,`correo_ter`,`cont_ter`,`pal`,`pvi`,`pac`,`estado_ter`,`especial`,`fuente`,`ica`,`iva`,`cree`,`vendedor`,`tipo_ter`) "
                                            . "values ('$cod','$tercodveri','$ternombr','$tertip','$terdireccio','$tertelefon','$termovi','$terde','$termun','$pais','$nacido','$correot','$contac','$alumi','$vidrio','$acero','$estad','$especial','$terretefuent','$tereteica','$terreteivt','$terretcre','$teraseso','$tipcli')");
            }
            else{
                mysqli_query($con,"update cont_terceros set nom_ter='$ternombr', doc_ter='$tertip', dir_ter='$terdireccio', telfijo_ter='$tertelefon', telmovil_ter='$termovi', municipio_ter='$terde',  ciudad_ter='$termun',  pais_ter='$pais',  fecnac_ter='$nacido',  correo_ter='$correot',  cont_ter='$contac',  pal='$alumi',  pvi='$vidrio',  pac='$acero',  estado_ter='$estad',  especial='$especial',  fuente='$terretefuent',  ica='$tereteica', iva='$terreteivt', cree='$terretcre', vendedor='$teraseso', tipo_ter='$tipcli' where cod_ter='$cod'");
                echo $id;
            }
            
            break;
                case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM cont_terceros where cod_ter='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['cod_ter'];
                 $p[1]=$fila['digiver_ter'];
                 $p[2]=$fila['nom_ter'];
                 $p[3]=$fila['doc_ter'];
                 $p[4]=$fila['dir_ter'];
                 $p[5]=$fila['telfijo_ter'];
                 $p[6]=$fila['telmovil_ter'];
                 $p[7]=$fila['municipio_ter'];
                 $p[8]=$fila['ciudad_ter'];
                 $p[9]=$fila['pais_ter'];
                 $p[10]=$fila['fecnac_ter'];
                 $p[11]=$fila['correo_ter'];
                 $p[12]=$fila['cont_ter'];
                 $p[13]=$fila['pal'];
                 $p[14]=$fila['pvi'];
                 $p[15]=$fila['pac'];
                 $p[16]=$fila['estado_ter'];
                 $p[17]=$fila['especial'];
                 $p[18]=$fila['fuente'];
                 $p[19]=$fila['ica'];
                 $p[20]=$fila['iva'];
                 $p[21]=$fila['cree'];
                 $p[22]=$fila['vendedor']; 
                 $p[23]=$fila['tipo_ter'];
   
                    
        
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query =  ("delete from cont_terceros where cod_ter='$id' ");
            break;
        case 4:
                 $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM cont_terceros where cod_ter='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['cod_ter'];
                 $p[1]=$fila['digiver_ter'];
                 $p[2]=$fila['nom_ter'];
                 $p[3]=$fila['doc_ter'];
                 $p[4]=$fila['dir_ter'];
                 $p[5]=$fila['telfijo_ter'];
                 $p[6]=$fila['telmovil_ter'];
                 $p[7]=$fila['municipio_ter'];
                 $p[8]=$fila['ciudad_ter'];
                 $p[9]=$fila['pais_ter'];
                 $p[10]=$fila['fecnac_ter'];
                 $p[11]=$fila['correo_ter'];
                 $p[12]=$fila['cont_ter'];
                 $p[13]=$fila['pal'];
                 $p[14]=$fila['pvi'];
                 $p[15]=$fila['pac'];
                 $p[16]=$fila['estado_ter'];
                 $p[17]=$fila['especial'];
                 $p[18]=$fila['fuente'];
                 $p[19]=$fila['ica'];
                 $p[20]=$fila['iva'];
                 $p[21]=$fila['cree'];
                 $p[22]=$fila['vendedor']; 
                 $p[23]=$fila['tipo_ter'];
            echo json_encode($p); 
            exit();
            break;
            

            case 5: 
             $id=$_GET['nombre'];
             $consulta = mysqli_query($con, "SELECT * FROM `departamentos` where nombre_dep='$id'");
                            while($f = mysqli_fetch_array($consulta)){ 
                                echo '<option value="'.$f['nombre_mun'].'">'.$f['nombre_mun'].'</option>';
                            }
            
            break;
}