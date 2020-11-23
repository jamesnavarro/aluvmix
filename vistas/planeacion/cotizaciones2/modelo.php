<?php
include '../../../modelo/conexion_multiple.php';
session_start();
if(isset($_SESSION['k_username'])){
$fecha = date("Y-m-d H:i:s");
switch ($_GET['sw']){
 
   
    case 1:
        $ced = $_GET['ced'];
        $nom = $_GET['nom'];
        $cuenta = $_GET['cuenta'];
        $dire = $_GET['dire'];
        $zona = $_GET['zona'];
        $tel = $_GET['tel'];
        $ema = $_GET['ema'];
        $ven = $_GET['ven'];
        $mun = substr($_GET['zona'],-3);
            $dem = substr($_GET['zona'],0,2);
             $consulta2= "SELECT nombre_dep,nombre_mun FROM virtuald_templadosa.departamentos where cod_dep='".$dem."' and cod_mun='$mun' ";  
             $result2=  mysqli_query($con_duos,$consulta2);
             $fi=  mysqli_fetch_array($result2);               
               $valor1=$fi['nombre_dep'];      
               $valor2=$fi['nombre_mun']; 
             
             $consulta3= "SELECT usuario FROM virtuald_templadosa.usuarios where cedula='".$ven."'  ";  
             $resulv=  mysqli_query($con_duos,$consulta3);
             $ve=  mysqli_fetch_array($resulv);               
               $usuario=$ve['usuario'];
                                                     
                 
                                                        
        
        $query = mysqli_query($con_duos,"SELECT count(cod_ter) FROM virtuald_templadosa.cont_terceros where cod_ter='$ced'");
        $fila = mysqli_fetch_array($query);
        if($fila[0]==0){
            
             $sql = "INSERT INTO virtuald_templadosa.cont_terceros (pvi,cod_ter, nom_ter, doc_ter, digiver_ter, dir_ter, telfijo_ter, telmovil_ter, ciudad_ter, municipio_ter, correo_ter, cont_ter, vendedor)";
             $sql .= "VALUES ('0','" . $ced . "','" . $nom . "','Nit','','" . $dire . "','" . $tel . "','','" . $valor1 . "','" . $valor2 . "','" . $ema . "','','" .$usuario. "')";
             $ver = mysqli_query($con_duos,$sql);
             echo '1. no encontrado virtual'.mysqli_error($con_duos);
        }else{
            echo 'existe';
        }
        
        $querya = mysqli_query($con_duos,"SELECT count(cod_ter) FROM aluvmixv3.cont_terceros where cod_ter='$ced'");
        $fil = mysqli_fetch_array($querya);
        if($fil[0]==0){
            
             $sql = "INSERT INTO aluvmixv3.cont_terceros (pvi,cod_ter, nom_ter, doc_ter, digiver_ter, dir_ter, telfijo_ter, telmovil_ter, ciudad_ter, municipio_ter, correo_ter, cont_ter, vendedor)";
             $sql .= "VALUES ('0','" . $ced . "','" . $nom . "','Nit','','" . $dire . "','" . $tel . "','','" . $valor1 . "','" . $valor2 . "','" . $ema . "','','" .$usuario. "')";
             $ver = mysqli_query($con_duos,$sql);
             echo '2. no encontrado alum'.mysqli_error($con_duos);
        }else{
            echo 'existe';
        }
        
        
        break;
}
}
//32783657-4
