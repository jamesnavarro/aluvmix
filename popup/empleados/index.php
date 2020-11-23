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
            <script src="../js/jquery.js"></script>
<link href="estilo.css" rel="stylesheet">
                <script src="funciones.js?<?php echo rand(1,100) ?>"></script>
    <script language="javascript" type="text/javascript">
      function pasar2(cod,des,crgo,sala){
        console.log(cod,des,crgo);
        window.opener.$("#cedula").val(cod);
        window.opener.$("#nombre").val(des);
        window.opener.$("#cargo").val(crgo);
        window.opener.$("#salario").val(sala);
        window.close();
      }
     </script>

         
</head>
<body>
    <div>
        <h3>Lista de Empleados</h3>
    </div>
<div class="datagrid">
                       <table class="table table-bordered table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>Cedula</th>
                                        <th>Nombre</th>
                                        <th>Cargo</th>
                                    </tr>
                                </thead>
                                <tr>
                                     <th><input type="text" id="cod" autofocus placeholder="codigo"></th>
                                     <th><input type="text" id="des" autofocus placeholder="nombre"></th>
                                     <th><input type="text" id="crgo" autofocus placeholder="cargo"></th>
              
                                    </tr>
                                <tbody id="usuario">
                                    
                                </tbody>
                       </table>
       </div>       
</body>
</html>

         

                              
                                