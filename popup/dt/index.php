<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
         <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
        <title>Sistemas</title>
        <meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
                <link href="../../css/estilo.css" rel="stylesheet">
                <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="stylesheet" href="../../vistas/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../../vistas/assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="../../vistas/assets/css/fonts.googleapis.com.css" />
                <script src="../../js/jquery.min.js"></script>
                <script src="../../js/sweetalert.min.js"></script>
                <link rel="stylesheet" type="text/css" href="../../js/sweetalert.css">
                <script src="funciones.js?<?php echo rand(1,100) ?>"></script>
<script language="javascript" type="text/javascript">
function pasar_accesorio(cod,nom){
    console.log(cod,nom);
   window.opener.pasar_accsel(cod,nom);
   window.close();
}
function pasar_dt(cod,des,lam){
    window.opener.obtener_dt(cod,des,<?php echo $_GET['n'] ?>,lam);
    window.opener.$("#cantidad").focus();
    window.close();
}
</script>       
</head>
<body>
    <div>
        <h3>Lista de Materiales</h3>
    </div>
<div class="datagrid">
                       <table class="table table-bordered table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Codigo</th>
                                        <th>Descripcion</th>
                                        <th>Sistema</th>
                                        <th>Diseño</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <th><input type="text" id="item" style="width: 50px"  placeholder="item"></th>
                                        <th><input type="text" id="cod" style="width: 100%"  placeholder="codigo"></th>
                                        <th><input type="text" id="des" style="width: 100%" autofocus placeholder="Descripcion"></th>
                                        <th><input type="text" id="sis" style="width: 100%"  placeholder="Sistema"><input type="hidden" id="ref"  style="width: 100%" placeholder="Referencia" value="<?php echo $_GET['linea'] ?>"></th>
                                        <th>-</th>
                                    </tr>
                                <tbody id="usuarios">
                                    
                                </tbody>
                       </table>

     
       </div>       
</body>
</html>

         

                              
                                