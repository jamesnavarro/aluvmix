 $(function(){
     $("#mostrar_tabla").html(mostrar_captura(1));
       $('#cod').change(function(){
             mostrar_captura(1);
     }); 
     $('#fecha_r').change(function(){
             mostrar_captura(1);
     });
       $('#c_bod').change(function(){
             mostrar_captura(1);
     });
       $('#nom_alm').change(function(){
             mostrar_captura(1);
     });
       $('#lin_a').change(function(){
             mostrar_captura(1);
     });
   
 });  

    function mostrar_captura(page){
         var cod =$("#cod").val();
         var fecha =$("#fecha_r").val();
         var c_bod =$("#c_bod").val();
         var nom_alm =$("#nom_alm").val();
         var lin_a =$("#lin_a").val();
        $.ajax({
                type:'GET',
                data:'cod='+cod+'&fecha='+fecha+'&c_bod='+c_bod+'&nom_alm='+nom_alm+'&lin_a='+lin_a+'&page='+page,
                url: '../vistas/inventario/captura/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_captura(){
         var rad_cap =$("#rad_cap").val();
         var fec_cap =$("#fec_cap").val();
         var al_cap =$("#al_cap").val();
         var alm_cap =$("#alm_cap").val();
         var proc_cap =$("#proc_cap").val();
         var usu_cap =$("#usu_cap").val();    
         var est_cap =$("#est_cap").val();
         var sede =$("#sede").val();
         if(est_cap==1){
             alert("Ya este documento se encuentra guardado.");
             return false;
         }
           
            
        $.ajax({
                type:'GET',
                data:'rad_cap='+rad_cap+'&sede='+sede+'&fec_cap='+fec_cap+'&al_cap='+al_cap+'&alm_cap='+alm_cap+'&proc_cap='+proc_cap+'&usu_cap='+usu_cap+'&est_cap='+est_cap+'&sw=1',
                url: '../vistas/inventario/captura/acciones.php',
           success: function(resultado){
               var p = eval(resultado);
               $("#rad_cap").val(p[0]);
                if(est_cap==0){
                   sweetAlert("Se guardo con exito."+p[1]);
                 
                }else{
                      alert("Se ha generado el documento .\n ingrese ahora los productos.");
                }
              
                $("#save").html('Guardar');
                inv_cap_inv(p[0]);
            }
           });
}

function limpiar_captura(){
        $("#rad_cap").val('');
        $("#al_cap").val('');
        $("#alm_cap").val('');
        $("#proc_cap").val('');
        $("#est_cap").val('');
}
function nuevo(){
    limpiar_captura();
}

function editar_captura(id){ 
    if(id!==0){
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/inventario/captura/acciones.php', //
            success: function(resultado){
            var t = eval(resultado);
        $("#rad_cap").val(t[0]);
        $("#fec_cap").val(t[1]);
        $("#al_cap").val(t[2]);
        $("#alm_cap").val(t[3]);
        $("#proc_cap").val(t[4]); 
        $("#usu_cap").val(t[5]);   
        $("#est_cap").val(t[6]);
         $("#sede").val(t[7]);
         
        console.log(t[6]);
        if(t[0]!=0 || t[0]!=null){
            $("#save").html('Guardar');
            $("#al_cap").attr("disabled", true);
            $("#alm_cap").attr("disabled", true);
           
        }else{
            $("#save").html('Continuar');
        }
        if(t[6]==1){
             $("#liq").html(t[8]);
             $("#imp").html('<button type="button" class="btn btn-info" onclick="impcap();"><i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i></button>');
        }
         MostrarCapturas();
        
 }
});
    }
}
function impcap(){
    var idc = $("#rad_cap").val();
    window.open("../vistas/inventario/captura/printer.php?idc="+idc ,"Printer", " width=900 , height=500 ");
}
function preliq(){
    var idc = $("#rad_cap").val();
    window.open("../vistas/inventario/captura/liq.php?idc="+idc ,"Printer", " width=1000 , height=1000 ");
}
function exportarexcel(){
    var idc = $("#rad_cap").val();
    var est = $("#est_cap").val();
 
    window.open("../vistas/inventario/captura/exportarexcel.php?idc="+idc ,"Printerex", " width=300 , height=300 ");
    
}
function bus_bod(){
    window.open("../popup/bodegas/index.php" ,"BODEGAS", " width=900 , height=500 ");
}
function pasar_bodega(cod,nom,sede){
                $("#al_cap").val(cod);
                $("#alm_cap").val(nom);
                 $("#sede").val(sede);
}
function borrarcap(id){
    var idc = $("#rad_cap").val();
     var est = $("#est_cap").val();
     if(est==1){
         alert("No puedes borrar el items");
         return false;
     }
    var c = confirm("Esta seguro de eliminar este items?");
    if(c){
        $.ajax({
				type: 'GET',
				data: 'id='+id+'&sw=10',
				url: '../vistas/inventario/captura/acciones.php',
				success: function(data){
						MostrarCapturas(idc);
				}
			});
    }
}
// AQUI COMIENZAN LAS FUNCIONES DE LISTADO DE LOS ITEM DE CAPTURA INVENTARIO 

function productos(){ 
       var c = $("#rad_cap").val();
       if(c==''){
           alert('Debes de generar el documento primero');
           return false;
       }
        window.open("../vistas/inventario/popup/productos_cap/producto.php", "Productos", "width=1000px , height=500px");
        
}
function MostrarCapturas(){
    var rad_cap = $('#rad_cap').val();
		$.ajax({
				type: 'GET',
				data: 'idc='+rad_cap+'&sw=9',
				url: '../vistas/inventario/captura/acciones.php',
				success: function(data){
						$('#mostrar_capturas').html(data);
				}
			});
		return false;
}
function actualizarinv(){
    var sede = window.opener.$('#sede').val();
    var bod = window.opener.$('#al_cap').val();
    var idc = window.opener.$('#rad_cap').val();
    var c = confirm("Esta seguro de actualizar el inventario?");
    if(c){
		$.ajax({
				type: 'GET',
				data: 'sede='+sede+'&almori='+bod+'&idc='+idc+'&sw=11',
				url: 'acciones.php',
				success: function(data){
						alert("Se genero el documento "+data+" con exito");
                                                location.reload();
				}
			});
                    }
}
function buscarcolor(cod){
    $("#codtemp").val(cod);
    
}
function pasarcol(col){
    var cod = $("#codtemp").val();
    $("#cap_col"+cod).val(col);
    $.ajax({
				type: 'GET',
				data: 'cod='+cod+'&col='+col+'&sw=13',
				url: '../vistas/inventario/captura/acciones.php',
				success: function(data){
                                        alert("Se edito con exito");
                                         $("#myModal").modal('hide');
				}
			});
   
    
}