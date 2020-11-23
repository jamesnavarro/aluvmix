<?php 
include '../../../modelo/conexioni.php';
session_start();
            $id=$_GET['id'];
            $query = mysqli_query($con,"select *,a.vendedor from informacion_obras a, cont_terceros b, cotizacion c where a.id_ter = b.id_ter and a.numero_cot = c.numero_cotizacion  and a.id_inf='$id' ");
            $fila = mysqli_fetch_array($query);
            $p[0]=$fila['id_inf'];
            $p[1]=$fila['nombre_obra'];
            $p[2]=$fila['nom_ter']; 
            $p[3]=$fila['obj_contra'];
            $p[4]=$fila['vendedor'];
            $p[5]=$fila['cor_obra'];
            $p[6]=$fila['sup_obra'];
            $p[7]=$fila['instalacion']; 
            $p[8]=$fila['numero_cotizacion'];
            $p[9]=$fila['valor_cont'];
            $p[10]=$fila['val_antici'];
            $p[11]=$fila['saldo'];
            $p[12]=$fila['for_pag'];
            $p[13]=$fila['otros'];
            $p[14]=$fila['recibe_cont'];
            $p[15]=$fila['num_pedido'];
            $p[16]=$fila['version'];
            $p[17]=$fila['fecha_pago'];
            $p[18]=$fila['observaciones'];
            $p[19]=$fila['estado_cont'];
            $p[20]=$fila['id_ter']; 
            $p[21]=$fila['num_pedido']; 
            $p[22]=$fila['registrado_por']; 
            $p[23]=$fila['fecha_registro_obrac'];
            $p[24]=$fila['limite_pago_c'];
            if(isset($_GET['descargar'])){
            $filename = $_GET['descargar'];
             // Ahora guardamos otra variable con la ruta del archivo
             $file = "../../archivos/".$filename;
             // Aquí, establecemos la cabecera del documento
             header("Content-Description: Descargar imagen");
             header("Content-Disposition: attachment; filename=$filename");
             header("Content-Type: application/force-download");
             header("Content-Length: " . filesize($file));
             header("Content-Transfer-Encoding: binary");
             readfile($file);
              return;
    }
    
?>
<!DOCTYPE html>
<html lang="sp">
    <head>

        <title>Modulo de cartera</title>
          <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../../bootstrap-3.3.7/dist/css/bootstrap.min.css">
        <script src="../../../js/jquery.min.js"></script>
        <script src="../../../bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../css/stilo.css">
                <script src="../../../js/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../../../js/sweetalert.css">
        <script src="funciones.js"></script>
        <script>
            $(document).ready(function(){
               mostrar_documentos(); 
               mostrar_loscontactos();
               mostrar_llamadas();
               mostrar_cotizaciones_cont();
               mostrar_nueva_fact();
            });
            </script>
    </head>
    <body onload="window.print()">
   <div class="jumbotron text-center">
  <h1><?php echo $p[1]; ?></h1>
  <p><?php echo $p[2]; ?></p> 
  <P>#CONTRATO <?php echo $p[8]; ?></P>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-6">
        <div class="alert alert-info">
            <strong>Obj. Contrato:</strong><?php echo $p[3]; ?>
        </div>
      <p><b>Vendedor : </b><?php echo $p[4]; ?></p>
      <p><b>Cordinador de Obra:</b> <?php echo $p[5]; ?></p>
      <p><b>Supervisor de Obra:</b> <?php echo $p[6]; ?></p>
      <p><b>Instaladores:</b> <?php echo $p[7]; ?></p>
      <p><b>Registrado por:</b> <?php echo $p[22]; ?></p>
      
    </div>
    <div class="col-sm-3">
        
      <?php if($p[14]=='CON FIRMA'){ ?>
      <div class="alert alert-success">
            <strong>Contrato: <?php echo $p[14]; ?> </strong> 
      </div>
      <?php }ELSE{ ?>
      <div class="alert alert-danger">
           <strong>Contrato: <?php echo $p[14]; ?> </strong> 
      </div>
      
      <?php } ?>
      <p><b>Fecha Registro:</b><?php echo $p[23]; ?></p>
      <p><b>Radicado No.:</b><?php echo $id; ?></p>
      <p><b>Cotizacion No.:</b><?php echo $p[8].'.'.$p[16]; ?></p>
      <p><b>Pedido No.:</b><?php echo $p[21]; ?></p>
    </div>
    <div class="col-sm-3">
     <?php if($p[19]=='C'){ ?>
      <div class="alert alert-success">
            <strong>Estado del contrato: CANCELADO </strong> 
      </div>
      <?php }ELSE{ ?>
      <div class="alert alert-danger">
       <strong>Estado del contrato: NO CANCELADO </strong> 
      </div>
      <p><b>Fecha Cobro: </b><?php echo $p[17]; ?></p>
      <?php } ?>
      <p><b>Forma Pago: </b><?php echo $p[12]; ?></p>
      <p><b>Valor Total: </b>$ <?php echo number_format($p[9]); ?></p>
      <p><b>Anticipo ...:</b> $ <?php echo number_format($p[10]); ?></p>
      <p><b>Saldo........: </b>$ <?php echo number_format($p[11]); ?></p>
      <input type="hidden" id="saldo_total" value="<?php echo $p[11]; ?>">
         </div>
    </div>
      <div class="row">
          <div class="col-sm-12">
              <p><b>Observaciones:</b> <br><?php echo $p[18]; ?></p>
         </div>
      </div>
    <hr> 
  
 </body>
</html>
