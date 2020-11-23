<?php
include "../../../modelo/conexioni.php";
      $line= $_GET['line'];
      $page= $_GET['page'];
       $request = mysqli_query($con,"SELECT count(*) FROM producto where linea like '%".$line."%'  ");

           if($request){
  $request = mysqli_fetch_row($request);
  $num_items = $request[0];
        }else{
  $num_items = 0;
        }
          $rows_by_page = 1;

           $last_page = ceil($num_items/$rows_by_page);

             if(isset($_GET['page'])){
                 $page = $_GET['page'];
             }else{
                 $page = 1;
                }
                $pag = '';
                if($page>1){
                        $pag =  $pag.'<img src="../imagenes/at1.png"  onclick="mostrar_uno(1)" style="cursor: pointer;">';
                        $pag =  $pag.'<img src="../imagenes/at2.png"  onclick="mostrar_uno('.($page-1).')" style="cursor: pointer;">';
              }else{
                        $pag =  $pag.'<img src="../imagenes/at1.png"> <img src="../imagenes/at2.png">';
                }
                        $pag =  $pag.'(ITEM <input type="text" id="page" value="'.$page.'" onchange="verite()" style="width: 30px; height: 30px" > DE '.$last_page.')';
                if($page<$last_page){
                        $pag =  $pag.'<img src="../imagenes/sig1.png"  onclick="mostrar_uno('.($page+1).')" style="cursor: pointer;">';
                        $pag =  $pag.'<img src="../imagenes/sig2.png" onclick="mostrar_uno('.$last_page.')" style="cursor: pointer;">';
                }else{
                        $pag =  $pag.'<img src="../imagenes/sig1.png"> <img src="../imagenes/sig2.png">';
                }
               $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
  
$result2 = mysqli_query($con, "SELECT * FROM producto where linea like '%".$line."%' order by id_p asc  ".$limit);
while ($fila = mysqli_fetch_array($result2)) {
        $codigo = $fila['codigo'];
}
$p = array();
$p[0] = $pag;
$p[1] = $codigo;
echo json_encode($p);