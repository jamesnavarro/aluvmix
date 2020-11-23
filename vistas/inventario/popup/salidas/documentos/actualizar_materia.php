<?php
include('../../../../../modelo/conexionv1.php');
session_start();

            $orden = $_POST['orden'];
            $rad = $_POST['rad'];
            $can = $_POST['can'];
            $pcan = $_POST['pcan'];
             $idcot = $_POST['idcot'];
            $id = $_POST['id'];//update orden_compra_detalle                   
            $des=$_POST['des'];//?
            $col=$_POST['col'];//?
            $med=$_POST['med'];//?

            $pre=$_POST['pre'];//?
            $cod=$_POST['cod'];//?
            $almori=$_POST['bod'];
  
            mysqli_query($con2,"update desgloses_material set cantdespachada=cantdespachada+'$can' where id_desglose='$id' and id_cot='$idcot' ");
            echo mysqli_error($con2).' =';
             
                      
               echo '$idcot='.$idcot.' iddes='.$id;
