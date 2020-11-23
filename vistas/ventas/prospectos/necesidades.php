<script> 
    $(function() {
      $('#subida').submit(function(){
		var idn = $('#idn').val();
                var tso = $('#tso').val();
                var asunto = $('#necesidad').val();
		var comprobar = $('#foto').val().length;
		if(asunto!==''){		
			var formulario = $('#subida');	
			var datos = formulario.serialize();		
			var archivos = new FormData();			
			var url = 'subir_foto.php';		
			for (var i = 0; i < (formulario.find('input[type=file]').length); i++) { 			
               	        archivos.append((formulario.find('input[type="file"]:eq('+i+')').attr("name")),((formulario.find('input[type="file"]:eq('+i+')')[0]).files[0]));		 
      		 	}	
			$.ajax({			
				url: url+'?'+datos,			
				type: 'POST',			
				contentType: false, 			
            	                data: archivos,			
               	                processData:false,
                                beforeSend : function (){
                                    $("#btn4").attr("disabled", true);
                                    $('#imagenes').html('<img width="20px" src="../../images/guardando.gif">');
                                },
				success: function(data){
                                    
                                        $('#foto').focus();
                                        if(data==='1'){
                                            $('#imagenes').html('<font color="green">Se cargo con exito</font>').show(200).delay(2500).hide(200);
                                        }else{
                                            $('#imagenes').html('<b>No se cargo correctamente</b>').show(200).delay(2500).hide(200);
                                        }
                                        lista_necesidad2(1);
                                        $('#subida')[0].reset();
					return false;
                                       
				}
			});
			return false;
		}else{
                      if(idn===''){
			alert('Cargue los archivo y verifique llenar el asunto');
                        }
			return false;
		}
	});
        });
        function lista_necesidad2(page){
    var id_obra = $("#id_obra").val();
 
            $.ajax({
				type: 'GET',
                                data:'page='+page+'&id_obra='+id_obra,
				url: '../../vistas/ventas/necesidades.php',
				success: function(d){
                                   
                                    $('#mostrar_necesidades').html(d);  
				}
			});
}
    </script>
<?php include '../../../modelo/conexioni.php'; ?>
<?php
$request=mysqli_query($con,'select count(*) from necesidades where id_obra="'.$_GET['id_obra'].'" ');
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


$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
?>
<table class="table table-bordered table-striped table-hover" id="">
                                    <tr>
                                        <td style="text-align: center;background: #C6C6C6" colspan="6">NECESIDADES DE LA OBRA</td> 
                                    </tr>
</table> 
<div style="float: left">
<?php
if($page>1){?>
	<a href="javascript:void(0)" onclick="lista_necesidad(1);"><img src="../../images/a1.png"></a>
	<a href="javascript:void(0)" onclick="lista_necesidad(<?php echo $page - 1;?>);"><img src="../../images/a11.png"></a>
<?php
}else{
	?><img src="../../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="javascript:void(0)" onclick="lista_necesidad(<?php echo $page + 1;?>);"><img src="../../images/p1.png"></a>
	<a href="javascript:void(0)"  onclick="lista_necesidad(<?php echo $last_page;?>);"><img src="../../images/p11.png"></a>
<?php
}else{
	?><img src="../../images/nex.png">    <?php 
}
echo 'Cantidad de Necesidad: '.$num_items.' <span id="imagenes"></span>'; 
?><input type="hidden" id="page4" value="<?php echo $page; ?>">
</div>   <div style="float: right"><button onclick="new_necesidad();">Nueva Necesidad</button></div><br><hr>
 <form id="subida">
<table class="table table-bordered table-striped table-hover" id="">
                                    <tr>
                                        <th style="text-align: center">Descripcion de la necesidad</th>
                                        <th style="text-align: center">Archivos </th>
                                        <th style="text-align: center">Acciones </th>
                                    </tr>
                     

                                    <tr>
                                        <th><input type="hidden" class="form-control" id="idn" name="idn"  value="" />
                                            <input type="hidden" class="form-control" id="tso" name="tso"  value="<?php echo $_GET['id_obra']; ?>" />
                                            <textarea style="width:100%" id="necesidad" name="necesidad"></textarea></th>
                                        <th><input type="file" id="foto" name="foto" accept=".jpeg,.png,./rar,.zip,.jpg"/></th>
                                        <th><input type="submit" value="Agregar" id="loadi"/></th>
                                    


                                   
                                    </tr>
                                    <?php
                                    $contactos = mysqli_query($con,"select * from necesidades where id_obra=".$_GET['id_obra']." ".$limit);
                                    while($c = mysqli_fetch_array($contactos)){
                                        echo '<tr>';
                                        echo '<td>'.$c[1].' <br>Reg: '.$c[4].' '.$c[5].'</td><td><a href="info.php?id='.$_GET['id_obra'].'&archivo='.$c[2].'">'.$c[2].'</a> ';
              
                                        echo '<td><button onclick="new_necesidad('.$c[0].');">Editar</button></td>';
                                    }
                                    ?>
                                </table>  </form>

