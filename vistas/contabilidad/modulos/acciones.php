<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id_mod'];
            $nombartN=$_GET['mod_nomb'];
            $estartN=$_GET['estado_mod'];
             $submenu =$_GET['submenu'];
           
            if($id==''){
                $ver=mysqli_query($con, "insert into modulos (`modulo`,`estado`,`submenu`) "
                                                . "values ('$nombartN','$estartN','$submenu')");
                echo mysqli_error($con);
                $query = mysqli_query($con,"select max(id_modulo) from modulos");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_modulo)'];
                echo $ultimo;
            }
            else{
               
                mysqli_query($con,"update modulos set modulo='$nombartN', estado='$estartN', submenu='$submenu' where id_modulo='$id'");
                echo $id;
            }
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM modulos where id_modulo='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['id_modulo']; 
                 $p[1]=$fila['modulo'];
                 $p[2]=$fila['estado'];
                 $p[3]=$fila['submenu'];
               
               
        
            echo json_encode($p); 
            exit();
            break;
        case 3:
            $sub = $_GET['mod'];
            $request_ac = mysqli_query($con,"SELECT * FROM modulos where submenu='".$sub."' " );
	   
            while($fila=mysqli_fetch_array($request_ac))
	    {
                
                echo '<tr>'
                        . '<td>'.$fila['id_modulo'].'</td>'
                        . '<td>'.$fila['modulo'].'</td>'
                        . '<td><button onclick="mostrarsub('.$MOD.')">+</button>'.$fila['submenu'].'</td>' 
                        . '<td><img src="'.$estado.'"></td>'
                        . '<td><a data-toggle="tab" href="#lin2"><button onclick="editar_mod('.$fila['id_modulo'].')" ><img src="images/modificar.png"></button></a>'
                        . '</td>';
            }
            break;
          
       
            }

