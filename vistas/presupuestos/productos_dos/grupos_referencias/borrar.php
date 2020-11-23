<?php
include('../../../../modelo/conexioni.php');
session_start();
  $id = $_GET['id'];
  
   mysqli_query($con,"delete from grupos_referencia where id='$id' ");

