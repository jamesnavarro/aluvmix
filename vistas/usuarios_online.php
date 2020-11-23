<?php
if(isset($_GET['use'])){
include '../modelo/conexion.php';
session_start();
}
if(!isset($_SESSION['id_user'])){
    echo '<script>alert("Su session ha caducado.");location.href="../index.php";</script>';
}
   $ip = $_SESSION['id_user'];
   $ahora = time();
   $limite = $ahora-5*60;
   $ssql = "delete from control_ip where fecha < ".$limite;
   mysqli_query($conexion,$ssql);
   $ssql = "select ip, fecha from control_ip where ip = '$ip'";
   $result = mysqli_query($conexion,$ssql);
   if (mysqli_num_rows($result) != 0) 
       $ssql = "update control_ip set fecha = ".$ahora." where ip = '$ip'";
   else $ssql = "insert into control_ip (ip, fecha) values ('$ip', $ahora)";
   mysqli_query($conexion,$ssql);
 $query = mysqli_query($conexion,"select direccion from seguridad_ip where direccion='".$_SERVER['REMOTE_ADDR']."' ");
$r = mysqli_fetch_array($query);
if($r[0]){
    mysqli_query($conexion,"update seguridad_ip set lugar = '".$_SESSION["k_username"]."' where direccion='".$_SERVER['REMOTE_ADDR']."' ");
}else{
    mysqli_query($conexion,"inser into seguridad_ip (direccion, lugar) values ('".$_SERVER['REMOTE_ADDR']."','Resurgir') ");
}

$request=mysqli_query($conexion,"SELECT nombre,apellido,id_user FROM usuarios a, control_ip b where a.id_user=b.ip  order by nombre asc ");    
if($request){
//    echo'<hr>';
             echo '<table style="font-size:9px">';

             echo '<thead >';
             echo '<tr BGCOLOR="#C3D9FF">';
                        
            
             echo '<th width="50%">'.'Usuarios Online'.'</th>';
             echo '<th  width="10%">'.'Online'.'</th>';
             echo '</tr>';
             echo '</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request))
	{       
           
           $sql2m = "SELECT count(*) FROM mensajes where visto=0 and id_emisor='".$row["id_user"]."' and id_receptor='".$_SESSION['id_user']."' ";
           $fi =mysqli_fetch_array(mysqli_query($conexion,$sql2m));
           if($fi[0]!=0){
               $led ='';
               $ms = $fi[0];
           }else{
               $led ='<img src="../images/ok.png">';$ms = '';
           } 
           ?>
           <tr><td width="50%">
                   <font color="white"> <a href="<?php echo 'http://172.16.0.40/cotizacion/club/?id=msg&cod='.$row["id_user"].'&est' ?>"  target="_blank" onClick="window.open(this.href, this.target, 'width=500,height=620'); return false;"><?php echo substr($row["nombre"].' '.$row["apellido"],0,19) ?></a></font></td>
               <td class="hidden-phone"><?php echo $led; ?>
                   <a href="#" data-toggle="dropdown" onclick="ver();">
                            <span class="badge"><?php echo $ms; ?></span>
                            
                        </a></td>
           </tr>   
          <?php
	}
        
        
	echo '</table>';
   

        
     
}
?>
  
  

                         
