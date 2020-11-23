<?php
include('../../modelo/conexion.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['imp'];
            $tipo=$_GET['tip'];
            $bmn=$_GET['nmb'];
            $cdn=$_GET['ndc'];
            $erv=$_GET['ver'];
            $rd=$_GET['dr'];
            $lt=$_GET['tl'];
            $vvm=$_GET['mvv'];
            $nm=$_GET['mn'];
            $icc=$_GET['cci'];
            $sp=$_GET['ps'];
            $cf=$_GET['fc'];
            $lm=$_GET['ml'];
            $tnc=$_GET['cnt'];
            $sto=$_GET['esto'];
            if($id==''){
               
                $ver=mysqli_query($con,"insert into cont_terceros (`cod_ter`,`nom_ter`,`doc_ter`,`digiver_ter`,`dir_ter`,`telfijo_ter`,`telmovil_ter`,`municipio_ter`,`ciudad_ter`,`pais_ter`,`fecnac_ter`,`correo_ter`,`cont_ter`,`estado_ter`) values ('$cdn','$bmn','$tipo','$erv','$rd','$lt','$vvm','$nm','$icc','$sp','$cf','$lm','$tnc','$sto')");
               
                $query = mysqli_query($con,"select max(id_ter) from cont_terceros");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_ter)'];
                
            }else{
                
                mysqli_query($con,"update cont_terceros set cod_ter='$cdn',nom_ter='$bmn',doc_ter='$tipo',digiver_ter='$erv',dir_ter='$rd',telfijo_ter='$lt',telmovil_ter='$vvm',municipio_ter='$nm', ciudad_ter='$icc', pais_ter='$sp',fecnac_ter='$cf', correo_ter='$lm', cont_ter='$tnc', estado_ter='$sto' where id_ter='$id' ");
               
            }
            
        break;
        case 2:
          
            $id=$_GET['id'];
            $query = mysqli_query($con,"select * from cont_terceros where id_ter='$id' ");
            $fila = mysqli_fetch_array($query);
          
            $p = array();
            $p[0]=$fila['id_ter']; 
            $p[1]=$fila['nom_ter'];
            $p[2]=$fila['doc_ter'];
            $p[3]=$fila['cod_ter'];
            $p[4]=$fila['digiver_ter'];
            $p[5]=$fila['dir_ter'];
            $p[6]=$fila['telfijo_ter'];
            $p[7]=$fila['telmovil_ter'];
            $p[8]=$fila['municipio_ter'];
            $p[9]=$fila['ciudad_ter'];
            $p[10]=$fila['pais_ter'];
            $p[11]=$fila['fecnac_ter'];
            $p[12]=$fila['correo_ter'];
            $p[13]=$fila['cont_ter'];
            $p[14]=$fila['estado_ter'];
            echo json_encode($p); 
            exit();
            break;
        case 3:
           
            $id=$_GET['id'];
          
            $query = mysqli_query($con,"delete from cont_terceros where id_ter='$id' ");
            
            break;
        
        case 4: 
             $id=$_GET['nombre'];
             $consulta = mysqli_query($con,"SELECT * FROM `departamentos` where nombre_dep='$id'");
                            while($f = mysqli_fetch_array($consulta)){
                                echo '<option value="'.$f['nombre_mun'].'">'.$f['nombre_mun'].'</option>'; 
                            }
            
            break;
        
}

