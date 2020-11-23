<?php
include('../../../../../modelo/conexioni.php');
$cod = $_GET['cod'];
$request=mysqli_query($con,"SELECT poriva,porfte FROM intercxp where codigo='".$cod."'");
$req = mysqli_fetch_row($request);
$p = array();
$p[0]= $req[0];
$p[1]= $req[1];
echo json_encode($p);
   
            
