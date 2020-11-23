<?php
include 'conexion.php';
session_start();
$us = $_GET['usuario'];
$cl = md5($_GET['clave']);
$query = mysqli_query($con,"select * from usuarios where usuario='".$us."' and password='".$cl."' ");
$col = mysqli_fetch_array($query);
if($col){
    echo '1';
    $_SESSION['k_username'] = $col['usuario'];
    $_SESSION['nom'] = $col['nombre'].' '.$col['apellido'];
    $_SESSION['car'] = $col['cargo'];
    $_SESSION['id_usuario'] = $col['id_user'];
    
}else{
    echo '0';
}


