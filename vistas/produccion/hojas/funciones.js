 $(function(){
     $("#mostrar_tabla").html(mostrar_burros(1));
     
     $('#tipo').change(function(){
             mostrar_burros(1);
     });   
     $('#opf').change(function(){
             mostrar_burros(1);
     }); 
     $('#ped').change(function(){
             mostrar_burros(1);
     }); 
     $('#cli').change(function(){
             mostrar_burros(1);
     }); 
     $('#ord').change(function(){
             mostrar_burros(1);
     });
     $('#fec').change(function(){
             mostrar_burros(1);
     });
    
 });  

    function mostrar_burros(page){
          var tipo =$("#tipo").val();
          var opf =$("#opf").val();
           var ped =$("#ped").val();
           var cli =$("#cli").val();
           var ord =$("#ord").val();
            var fec =$("#fec").val();
        $.ajax({
                type:'GET',
                data:'tipo='+tipo+'&opf='+opf+'&ped='+ped+'&cli='+cli+'&ord='+ord+'&fec='+fec+'&page='+page,
                url: '../vistas/produccion/hojas/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_burros(){
        var id_bur = $("#id_bur").val();
        var descrip_bur = $("#descrip_bur").val();
        var esta_b = $("#esta_b").val();   
        var planta_b = $("#planta_b").val(); 
     
       $.ajax({
            type: 'GET',
            data: 'id='+id_bur+'&descrip_bur='+descrip_bur+'&esta_b='+esta_b+'&planta_b='+planta_b+'&sw=1',
            url: '../vistas/produccion/hojas/acciones.php', 
           success: function(resultado){
                console.log(resultado)
                $("#id_bur").val(resultado); 
                sweetAlert("Se ha guardo con exito");
                mostrar_burros(1);
            }
           });
}

function limpiar_burros(){
        $("#id_bur").val('');
        $("#descrip_bur").val('');
        $("#esta_b").val('');
        $("#planta_b").val(''); 
        
}
function nuevo(){
    limpiar_burros();
}

function editar_burros(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/produccion/hojas/acciones.php', //
            success: function(resultado){
            var t = eval(resultado);
            $("#id_bur").val(t[0]);
            $("#descrip_bur").val(t[1]);
            $("#esta_b").val(t[2]);
            $("#planta_b").val(t[3]);
 }
});
}
function verhoja(){
    var id =$("#idop").val();
    window.open("../vistas/produccion/hojas/hoja_costos.php?id="+id,"Hoja de Costos","width=800px, height=600px");  
}
function verhoja2(){
     var id =$("#idop").val();
    window.open("../vistas/produccion/hojas/hoja_costos_desglose.php?id="+id,"Hoja de Costos 2","width=800px, height=600px");  
}
function verhoja3(){
     var id =$("#idop").val();
    window.open("../vistas/produccion/hojas/hoja_costos_presupuestado.php?id="+id,"Hoja de Costos 2","width=800px, height=600px");  
}
function verhoja4(){
     var id =$("#idop").val();
    window.open("../vistas/produccion/hojas/comparativo.php?id="+id,"Hoja de Costos 4","width=800px, height=600px");  
}
function generarhoja(){
     var id =$("#idop").val();
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=1',  //
            url: '../vistas/produccion/hojas/acciones.php', //
            success: function(resultado){
                var t = eval(resultado);
               window.open("../../../cotizacionv2/vistas/?id=generar_dt&item="+t[0]+"&can="+t[1],"Hoja de Costos 2","width=800px, height=600px");  
            }
           });
    
}
function modalbuscar(){
        var fi =$("#bfi").val();
        var ff =$("#bff").val();
        var det =$("#btipo").val();
        var ord =$("#bord").val();
    window.open("../vistas/produccion/hojas/hoja_costos_rango.php?fi="+fi+"&ff="+ff+"&det="+det+"&ord="+ord,"Hoja de Costos","width=800px, height=600px");  
}
function opciones(op,opf){
    $("#idop").val(op);
    $("#op").val(opf);
}

function ver_cotizacion(cot,linea){
             window.open('../vistas/planeacion/cotizaciones/pedido.php?cot='+cot+'&linea='+linea,'seg1','width=1300px,height=700');  
        }
