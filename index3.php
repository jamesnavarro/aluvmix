<?php 
include '../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
?>
<!DOCTYPE html>
<html lang="sp">
    <head>
        <title>Modulo de cartera</title>
          <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="stylesheet" href="../bootstrap-3.3.7/dist/css/bootstrap.min.css">
        <script src="../js/jquery.min.js"></script>
        <script src="../bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../css/stilo.css">
        <script src="../js/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../js/sweetalert.css">
        <script src="../controlador/control.js"></script>
        
    </head>
    <body>
<!--        este el menu del encabezado-->
<nav class="navbar navbar-inverse" role="navigation">
               <div class="container">
                     <div class="navbar-header">
                         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                             <span class="sr-only"></span>
                             <span class="icon-bar"></span>
                             <span class="icon-bar"></span>
                             <span class="icon-bar"></span>
                         </button>
                         <a class="navbar-brand" href="#"><img src="../imagenes/templado.png" width="90px"></a>
                    </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav" id="menu">
                    <li><a href="#pendientes" onclick="pendientes();"> Contratos </a></li>
                    <li>
                        <a href="#Actividades" onclick="actividades();">
                            <i class="fa fa-calculator"></i>
                            Llamadas
                            <span class="badge badge-warning" id="msg_llamadas"></span>
                        </a>
                      
                    </li>
                    <li><a href="#clientes" onclick="clientes();">Clientes</a></li>
                    <li><a href="#contactos" onclick="contactos();">Contactos</a></li>
                    <li><a href="#cotizaciones" onclick="cotizaciones();">Cotizaciones</a></li>
                    <ul class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Facturacion <b class="caret"></b></a>
                        
                        
                        
                        
                    </ul>
                    
                    
<!--                     <ul>
                      <li><a href="#remisiones" onclick="remisiones();">Remisiones de pedido</a></li>
                      <li><a href="#fact_remisiones" onclick="fact_remisiones();">fact.Remisiones</a></li> 
                    </ul>-->
                    
         
                    
                    
                     <li><a href="#">Documentos<span class="flecha">&#9660</span></a>
                    <ul>
                      <li><a href="#facts_ventas" onclick="facts_ventas();">Factura de ventas</a></li>
                       <li><a href="#remisiones" onclick="remisiones();">Factura de remisiones</a></li>
                    </ul>
                    </li>
                    <li><a href="../../cartera/aprobacion.php">Aprobaciones</a></li>
                    
<!--                    <li><a href="#ordenes_produccion" onclick="ordenes_produccion();">Ordenes De Produccion</a></li>-->
<!--                    <li><a href="#op_terminadas" onclick="op_terminadas();">OP Terminadas</a></li>-->
                    
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#op_terminadas"> <div id="msg"> Msg </div></a></li>
                    <li><a href="../../principal/salir.php"><span class="glyphicon glyphicon-user"></span> Salir</a></li>
                </ul>
            </div>
           </div>

           
       </nav>
        <div class="container">
            <br>
               <b>Bienvenid@ <?php  echo $_SESSION['k_username']; ?></b>
            <div id="encabezado">
               <b><h2>Embudo de Cartera</h2></b> 
            </div>
            <div id="mostrar_contenido">
                <center>
                    <img src="../imagenes/cartera.jpg" width="100%">
                </center>
            </div> 
        </div><br><br><br><br><br><br><br><br>
<div class="footer">
    <p><b>Copyright (R) 2017 | Templado S.A | Usuario: 
            <input type="text" id="user_general" value="<?php echo $_SESSION['k_username'] ?>" style="height: 18px; width: 80px" disabled>
            |  Fecha <input type="text"  id="fecha_general" value="<?php echo date("Y-m-d"); ?>" disabled  style="height: 18px; width: 100px">
             <span id="hora"></span>
            </b> 
    </p>
</div>

    </body>
</html>
<?php  }else {header("location:../index.php");} ?>
