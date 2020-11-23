<?php
include('conexioni.php');
session_start();

//roles de usuarios
$query_roles_user = mysqli_query($con,"select modulo, acceso,submodulo FROM roles where id_user= '".$_SESSION["id_user"]."' ");
$modulo_user[] = '';
$acces_user[] = '';
$submodulo_user[] ='';
while($rr = mysqli_fetch_array($query_roles_user)){
	$modulo_user[] = $rr[0];
	$acces_user[] = $rr[1];
        $submodulo_user[] = $rr[2];
}

