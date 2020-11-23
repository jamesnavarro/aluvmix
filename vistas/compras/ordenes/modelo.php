<?php
include '../../../modelo/conexioni.php';
session_start();
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('H:i:s',time() - 3600*date('I'));
$fecha_hoy = date("Y-m-d").' '.$hora;
$date = date("Y-m-d");

switch ($_GET['sw']) {
        case 1:
            $col = $_GET['col'];
            $id = $_GET['id'];
            $texto = $_GET['texto'];
            $input = "'".$col.$id."'";
            if($col=='col_col'){
                $input = '<select id="caja'.$col.$id.'" onchange="upord('.$id.','.$input.')">';
                $input .= '<option value="'.$texto.'">'.$texto.'</option>';
                $resu = mysqli_query($con,"select * from colores");
                          while($r = mysqli_fetch_array($resu)){
                          $input.= '<option value="'.$r[0].'">'.$r[0].'</option>';
                          }
                $input .= '</select>';                            
            }elseif($col=='col_und'){
                $input = '<select id="caja'.$col.$id.'" class="form-control" onchange="upord('.$id.','.$input.')">
                                                <option value="Und">Und</option>
                                                <option value="Mts">Mts</option>
                                                <option value="Kg">Kg</option>
                                                <option value="M2">M2</option>
                                                <option value="Cm">Cm</option>
                                                <option value="Gl">Gl</option>
                                                <option value="Ml">Ml</option>
                                                <option value="Kl">Kl</option>
                                            </select>';
            }else{
                $input = '<input type="text" id="caja'.$col.$id.'" value="'.$texto.'" onchange="upord('.$id.','.$input.')">';
            }
            echo $input;
            
          break;  
        case 2:
            $col = $_GET['col'];
            $id = $_GET['id'];
            $texto = $_GET['texto'];
            if($col=='col_col'.$id){
                $columna = 'color';
                $columna2 = '';
            }elseif($col=='col_med'.$id){
                $columna = 'medida';
                $columna2 = '';
            }elseif($col=='col_can'.$id){
                $columna = 'cantidad';
                $columna2 = 'cantidad_pend='.$texto.' , ';
                
            }elseif($col=='col_und'.$id){
                $columna = 'undmed';
                $columna2 = '';
            }else{
                $columna = 'precio';
                $columna2 = '';
            }
            $ver = mysqli_query($con,"update orden_compra_detalle set $columna2 $columna = '$texto', mod_use='".$_SESSION['k_username']."' where id_oc_de='$id' ");
            if($ver){
                echo '<b><font color="red">error al editar'.mysqli_error($con).'</font></b>';
            }else{
                echo '<b><font color="green">Se edito con exito</font></b>';
            }
            break;
        case 3:
            $cor = $_GET['cor'];
            $ord = $_GET['ord'];
            $query = mysqli_query($con, "SELECT cod_ter FROM `orden_compra` where codigo='$ord' ");
            $r = mysqli_fetch_array($query);
            $ter = $r[0];
            $msg = mysqli_query($con, "update cont_terceros set correo_ter='$cor' where cod_ter='$ter' ");
            $ver = mysqli_error($con);
            echo $ver.'-'.$msg.'-'.$ter;
            break;
        case 4:
            $idord = $_GET['idord'];
            $idsol = $_GET['idsol'];
            $orden = $_GET['orden'];
            mysqli_query($con,"update orden_compra_detalle set codigo_orden='0',orden_anulada='$orden' where id_oc_de='$idord' ");
//            mysqli_query($con,"update solicitudes_item set codigo_orden='0' where solicitud='$idsol' ");
            
            break;
        case 5:
            $idord = $_GET['idord'];
            mysqli_query($con,"update orden_compra set estado='Anulado' where codigo='$idord' ");
            mysqli_query($con,"update orden_compra_detalle set codigo_orden='0',orden_anulada='$idord' where codigo_orden='$idord' ");
           
        echo 'Se anulo con exito la orden '.$idord. mysqli_error($con);
            break;
}
	

?>