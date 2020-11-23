 
$(function(){
     $("#mostrar_tabla").html(mostrar_ma(1)); 
     
      $('#codigo').change(function(){
         mostrar_ma(1);  
     });
     $('#descripcion').change(function(){
         mostrar_ma(1);  
     });
     $('#referencia').change(function(){
         mostrar_ma(1);  
     });
     //++++
       $('#codigo_vid').change(function(){
         mostrar_vidrios(1);  
     });
     $('#descripcion_vid').change(function(){
         mostrar_vidrios(1);  
     });
     $('#referencia_vid').change(function(){
         mostrar_vidrios(1);  
     });
     //+++
       $('#codigo_alu').change(function(){
         mostrar_aluminio(1);  
     });
     $('#descripcion_alu').change(function(){
         mostrar_aluminio(1);  
     });
     $('#referencia_alu').change(function(){
         mostrar_aluminio(1);  
     });
     $('#agrupado').change(function(){
         mostrar_aluminio(1);  
     });
     //****
     $('#codigo_ace').change(function(){
         mostrar_acero(1);  
     });
     $('#descripcion_ace').change(function(){
         mostrar_acero(1);  
     });
     $('#referencia_ace').change(function(){
         mostrar_acero(1);  
     });
     //*
     $('#codigo_acc').change(function(){
         mostrar_accesorios(1);  
     });
     $('#descripcion_acc').change(function(){
         mostrar_accesorios(1);  
     });
     $('#referencia_acc').change(function(){
         mostrar_accesorios(1);  
     });
     
     
 
});
function mostrar_ma(page){
     var cod = $("#codigo").val();
      var des = $("#descripcion").val();
       var ref = $("#referencia").val();

        $.ajax({
            type: 'GET',
            data: 'page='+page+'&cod='+cod+'&des='+des+'&ref='+ref,
            url: '../vistas/presupuestos/crear_per/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
  }); 
}
function mostrar_vidrios(page){
     var cod = $("#codigo_vid").val();
      var des = $("#descripcion_vid").val();
       var ref = $("#referencia_vid").val();

        $.ajax({
            type: 'GET',
            data: 'page='+page+'&cod='+cod+'&des='+des+'&ref='+ref,
            url: '../vistas/presupuestos/crear_per/vidrios.php',
            success: function(resultado){
                 $("#mostrar_vidrios").html(resultado);
            }
  }); 
}
function mostrar_acero(page){
     var cod = $("#codigo_ace").val();
      var des = $("#descripcion_ace").val();
       var ref = $("#referencia_ace").val();

        $.ajax({
            type: 'GET',
            data: 'page='+page+'&cod='+cod+'&des='+des+'&ref='+ref,
            url: '../vistas/presupuestos/crear_per/aceros.php',
            success: function(resultado){
                 $("#mostrar_acero").html(resultado);
            }
  }); 
}
function mostrar_accesorios(page){
     var cod = $("#codigo_acc").val();
      var des = $("#descripcion_acc").val();
       var ref = $("#referencia_acc").val();

        $.ajax({
            type: 'GET',
            data: 'page='+page+'&cod='+cod+'&des='+des+'&ref='+ref,
            url: '../vistas/presupuestos/crear_per/accesorios.php',
            success: function(resultado){
                 $("#mostrar_accesorios").html(resultado);
            }
  }); 
}
function mostrar_aluminio(page){
     var cod = $("#codigo_alu").val();
      var des = $("#descripcion_alu").val();
       var ref = $("#referencia_alu").val();
       var gro = $("#agrupado").val();
        $.ajax({
            type: 'GET',
            data: 'page='+page+'&cod='+cod+'&des='+des+'&ref='+ref+'&gro='+gro,
            url: '../vistas/presupuestos/crear_per/aluminios.php',
            success: function(resultado){
                 $("#mostrar_aluminios").html(resultado);
            }
  }); 
}
function mostrar_flotantes(page){
     var cod = $("#fcodigo").val();
      var des = $("#fdescripcion").val();
       var ref = $("#freferencia").val();

        $.ajax({
            type: 'GET',
            data: 'page='+page+'&cod='+cod+'&des='+des+'&ref='+ref,
            url: '../vistas/presupuestos/crear_per/flotantes.php',
            success: function(resultado){
                 $("#mostrar_tabla_flotantes").html(resultado);
            }
  }); 
}
function guardar_ma(){ 
     var id = $("#id_ma").val(); 
     var codmat = $("#cod_mat").val();
     var descma = $("#desc_ma").val();
     var refma = $("#ref_ma").val();
     var cantma = $("#cant_mat").val();
     var dadoma = $("#dado_ma").val();
     var pesoma = $("#peso_ma").val();
     var grupma = $("#grup_ma").val();
     var medima = $("#medida_ma").val();
     var unima = $("#uni_ma").val();
     var valma = $("#valor").val();
     var aumma = $("#aumento_m").val();
     var porut = $("#por_utili").val();
     var desma = $("#desc_maximo").val();
     
   if(codmat===''){
        sweetAlert("codigo");
        $("#cod_mat").focus();
        return false;
    }
    if(descma===''){
        sweetAlert("descripcion");
        $("#desc_ma").focus();
        return false;
    }
     if(refma===''){
        sweetAlert("referencia");
        $("#ref_ma").focus();
        return false;
    }
     if(cantma===''){
        sweetAlert("cantidad");
        $("#cant_mat").focus();
        return false;
    }
      if(dadoma===''){
        sweetAlert("dado");
        $("#dado_ma").focus();
        return false;
    }
     if(pesoma===''){
        sweetAlert("peso");
        $("#peso_ma").focus();
        return false;
    }
     if(grupma===''){
        sweetAlert("grupo");
        $("#grup_ma").focus();
        return false;
    }
     if(medima===''){
        sweetAlert("medida");
        $("#medida_ma").focus();
        return false;
    }
     if(unima===''){
        sweetAlert("unidad");
        $("#uni_ma").focus();
        return false;
    }
     if(valma===''){
        sweetAlert("valor");
        $("#valor").focus();
        return false;
    }
     if(aumma===''){
        sweetAlert("porcentaje");
        $("#aumento").focus();
        return false;
    }
     if(porut===''){
        sweetAlert("porcentaje de utilidad");
        $("#por_utili").focus();
        return false;
    }
     if(desma===''){
        sweetAlert("Descuento maximo");
        $("#desc_maximo").focus();
        return false;
    }
    
        $.ajax({
            type: 'GET',
            data: 'idm='+id+'&codmatm='+codmat+'&descmam='+descma+'&refmam='+refma+'&cantmam='+cantma+'&dadomam='+dadoma+'&pesomam='+pesoma+'&grupmam='+grupma+'&medimam='+medima+'&unimam='+unima+'&valmam='+valma+'&aummam='+aumma+'&porutm='+porut+'&desmam='+desma+'&sw=1',
            url: '../vistas/presupuestos/crear_per/acciones.php', 
            success: function(resultado){
                $("#id_ma").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_ma(1);
            }
           });
}
function limpiar_ma(){
    $("#id_ma").val(''); 
    $("#cod_mat").val('');
    $("#desc_ma").val('');
    $("#ref_ma").val('');
    $("#cant_mat").val('');
    $("#dado_ma").val('');
    $("#peso_ma").val('');
    $("#grup_ma").val('');
    $("#medida_ma").val('');
    $("#uni_ma").val('');
    $("#valor").val('');
    $("#aumento_m").val('');
    $("#por_utili").val('');
    $("#desc_maximo").val('');
}

function nuevo(){
    limpiar_ma();
}

function editar_ma(id){
    $("#marcar1").attr("class","");
    $("#marcar2").attr("class","active");
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/presupuestos/crear_per/acciones.php', //
        success: function(resultado){
  var p = eval(resultado);
    $("#id_ma").val(p[0]); 
    $("#cod_mat").val(p[1]);
    $("#desc_ma").val(p[2]);
    $("#ref_ma").val(p[3]);
    $("#cant_mat").val(p[4]);
    $("#dado_ma").val(p[5]);
    $("#peso_ma").val(p[6]);
    $("#grup_ma").val(p[7]);
    $("#medida_ma").val(p[8]);
    $("#uni_ma").val(p[9]);
    $("#valor").val(p[10]);
    $("#aumento_m").val(p[11]);
    $("#por_utili").val(p[12]);
    $("#desc_maximo").val(p[13]);
 }
 });
}

function borrar(id){
     var c = confirm("Esta seguro de eliminar esta vidrio?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/presupuestos/crear_per/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_ma(1);
            }
           });
       }
}
function actuaper(id){
    var peso = $("#peso"+id).val();
    var area = $("#area"+id).val();
    var areat = $("#areat"+id).val();
    console.log(peso);
    $.ajax({
        type: 'GET',
        data: 'cod='+id+'&peso='+peso+'&area='+area+'&areat='+areat+'&sw=3',
        url: '../vistas/presupuestos/crear_per/acciones.php',
        success: function(res){
            $('#msg').html(res);
        }
    });
}
function asignarcion(){
  var linea = $("#linea").val();
  var conf =  confirm("Esta seguro de categorizar estos items?");
    if(conf){
//        if(linea===''){
//            alert('Seleccione la linea');
//            return false;
//        }
			$("input[name=item]:checked").each(function(){
				var id = $(this).attr("id");
                                $.ajax({
                                    type:'GET',
                                    data:'id='+id+'&linea='+linea+'&sw=4',
                                    url:'../vistas/presupuestos/crear_per/acciones.php',
                                success:function(d){
                                   console.log(d);
                                    mostrar_ma(1);
				}
                                });
                                
			});
                        
                 
                    }
                
		return false;
}



