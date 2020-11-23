<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="../traz.ico">
    <title>Buscar Producto</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="../js/jquery.js"></script>
<link href="estilo.css" rel="stylesheet">
<script src="../productos_cap/documentos/funciones.js?<?php echo rand(1,100) ?>"></script>
<script language="javascript" type="text/javascript">
function pasar(cod,stc,des,col,med,cos){
   window.opener.document.getElementById("coder").value=cod;
   window.opener.document.getElementById("des").value=des;
   window.opener.document.getElementById("col").value=col;
   window.opener.document.getElementById("med").value=med;
   window.opener.document.getElementById("pre").value=cos;
   window.opener.document.getElementById("stc").value=stc;
   window.opener.$("#can").focus();
   window.close();
}
</script>

         
</head>
<body>
    <div>
        <h3>Lista de Productos</h3>
    </div>

Buscar:<input type="text" id="buscar_empleado" autofocus placeholder="Descripcion ó Codigo">
 | Referencia:<input type="text" id="referencia" autofocus placeholder="Referencia">  | Color:<input type="text" id="color" autofocus placeholder="Color"><br>
<div class="datagrid" id="usuarios">
     
       </div>     
</body>
</html>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Colores => <input type="text" id="codtemp" disabled ></h4>
      </div>
      <div class="modal-body" >
          <div style="padding: 16px;margin-bottom: 30px;max-height: 300px;overflow-y: auto;">
          <ul>
        <?php
        include('../../../../modelo/conexioni.php');
        $query = mysqli_query($con, "select * from colores ");
        while ($row = mysqli_fetch_array($query)) {
            $color= "'".$row[0]."'";
            echo '<li><a href="#" onclick="pasarcol('.$color.')"  data-dismiss="modal">'.$row[0].'</a></li>';
        }
        ?>
              </ul>
              </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
         

                              
                                