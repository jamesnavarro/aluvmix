<?php
session_start();
include "modelo/conexioni.php";
function quitar($mensaje)
{
	$nopermitidos = array("'",'\\','<','>',"\"");

	$mensaje = str_replace($nopermitidos, "", $mensaje);

	return $mensaje;

}

if(trim($_POST["username"]) != "" && trim($_POST["password"]) != "")

{

	$usuario = strtolower(htmlentities($_POST["username"], ENT_QUOTES));

	$password = md5($_POST["password"]);

	$result = mysqli_query($con,'SELECT * FROM usuarios WHERE usuario=\''.$usuario.'\'');

	if($row = mysqli_fetch_array($result)){

		if($row["password"] == $password){
			$_SESSION["k_username"] = $row['usuario'];
                        $_SESSION["id_user"] = $row['id_user'];
                        $_SESSION["admin"] = $row['administrador'];
                        $_SESSION["email"] = $row['email']; 
                        $_SESSION["area"] = $row['area']; 
                        $_SESSION["sede_user"] =  $row['sede'];
                        $_SESSION["empresa"] =  'TEMPLADOS';
		        $_SESSION["nombre"] = $row['nombre'].' '.$row['apellido'];
                        $sql = "UPDATE `usuarios` SET `online` = '1', ingreso='".date("Y-m-d").' '.$hora."'  WHERE `id_user` = ".$row['id_user'].";";
                        mysqli_query($con,$sql, $conexion);
                        if(isset($_SESSION['k_username'])){
			if($_SESSION["admin"]=='Si'){
                            header("location:vistas/?id=stad");}else{
                                if($_SESSION['area']=='Produccion'){
                                    header("location:vistas/?id=mi_area");
                                }else{
                                    header("location:vistas/?id=stad");
                                }
                            }
                        }else {
                            echo 'usted no se ha logueado';
//                        header("location:index.php");

                            echo '<a href="index.php">Iniciar sesion</a></p>';
                        }

		}else{
			echo '<script lanquage="javascript">alert("El usuario o la contrase\u00f1as son incorrectos");location.href="index.php"</script>';

		}

	}else{

		header("location:index.php");

	}

	mysqli_free_result($result);

}else{

	echo '<script lanquage="javascript">alert("Por favor digite el usuario y la contrase\u00f1a");location.href="index.php"</script>';

}

mysqli_close();

?>