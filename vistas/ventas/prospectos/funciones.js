$(function(){
    $("#mostrar_tabla").html(mostrar_pros(1));
    $('#cod').change(function(){
        mostrar_pros(1);
    });
    $('#des').change(function(){
        mostrar_pros(1);
    }); 
    $('#est').change(function(){
        mostrar_pros(1);
    }); 
     $('#res').change(function(){
         mostrar_pros(1);
     });
       $('#bus_asesor').change(function(){
         mostrar_pros(1);
     });
          $('#depar').change(function(){
         mostrar_pros(1);
     });
          $('#ciu_b').change(function(){
         mostrar_pros(1);
     });
//     $('#bod_cod').change(function(){
//        inv_buscar_codigo();
//      });
 });  
// function inv_buscar_codigo(){
//     var cod = $("#bod_cod").val();
//      $.ajax({
//             type: 'GET',
//             data: 'cod='+cod+'&sw=4',
//             url: '../vistas/inventario/bodegas/acciones.php',
//         success: function(t) {
//             var t = eval(t);
//              $("#bod_cod").val(cod);
//              $("#id_pros").val(t[0]);
//     $("#pros_nombre").val(t[1]);
//     $("#pros_contruc").val(t[2]);
//     $("#pros_nit").val(t[3]);
//     $("#pros_dep").val(t[4]);
//     $("#pros_ciu").val(t[5]);
//     $("#pros_barrio").val(t[6]);
//     $("#pros_tel").val(t[7]);
//     $("#pros_fase").val(t[8]);
//     $("#pros_estado").val(t[9]);
//     $("#pros_filtrar").val(t[10]);
//         }
//     
//});
// }
    function mostrar_pros(page){
        var cod = $("#cod").val();
        var des = $("#des").val();
        var res = $("#res").val();
        var est = $("#est").val();
        var ases = $("#bus_asesor").val();
        var depp = $("#depar").val();
        var ciub = $("#ciu_b").val();
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&des='+des+'&est='+est+'&res='+res+'&ases='+ases+'&depp='+depp+'&ciub='+ciub+'&page='+page,
                url: '../vistas/ventas/prospectos/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d==='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_pros(){
        var id = $("#id_pros").val();
        var prosnom = $("#pros_nombre").val();
        var pcontruc = $("#pros_contruc").val();
        var prosnit = $("#pros_nit").val();
        var prodep = $("#pros_dep").val();
        var prociu = $("#pros_ciu").val();
        var probarr = $("#pros_barrio").val();
        var protel = $("#pros_tel").val();
        var profase = $("#pros_fase").val();
        var proest = $("#pros_estado").val();
        var prosfil = $("#pros_filtrar").val(); 
        var usuv = $("#usuariov").val(); 
      
    $.ajax({
            type: 'GET',
            data: 'id='+id+'&prosnom='+prosnom+'&pcontruc='+pcontruc+'&prosnit='+prosnit+'&prodep='+prodep+'&prociu='+prociu+'&probarr='+probarr+'&protel='+protel+'&profase='+profase+'&proest='+proest+'&prosfil='+prosfil+'&usuv='+usuv+'&sw=1',
            url: '../vistas/ventas/prospectos/acciones.php', 
            success: function(resultado){
               console.log(resultado)
                $("#id_pros").val(resultado); 
                sweetAlert("Se guardo con exitosamente");
                mostrar_pros(1);
            }
           });
}

function limpiar_pros(){
    $("#id_pros").val('');
    $("#pros_nombre").val('');
    $("#pros_contruc").val('');
    $("#pros_nit").val('');
    $("#pros_dep").val('');
    $("#pros_ciu").val('');
    $("#pros_barrio").val('');
    $("#pros_tel").val('');
    $("#pros_fase").val('');
    $("#pros_estado").val('');
    $("#pros_filtrar").val(''); 
    $("#usuariov").val(''); 
}
function nuevo(){
    $("#lin2").modal("show");
    limpiar_pros();
}

function editar_prose(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/ventas/prospectos/acciones.php', //
            success: function(resultado){
// console.log(resultado);
    var t = eval(resultado);
     $("#id_pros").val(id);
     $("#pros_nombre").val(t[0]);
     $("#pros_contruc").val(t[1]);
     $("#pros_nit").val(t[2]);
     $("#pros_dep").val(t[3]);
     $("#pros_ciu").val(t[4]);
     $("#pros_barrio").val(t[5]);
     $("#pros_tel").val(t[6]);
     $("#pros_fase").val(t[7]);
     $("#pros_estado").val(t[8]);
     $("#usuariov").val(t[9]);
 }
});
}
function cargarmund(){
     var depar = $("#pros_dep").val(); // 
         $.ajax({
            type: 'GET',
            data: 'nombre='+depar+'&sw=5',  //
            url: '../vistas/ventas/prospectos/acciones.php', //
            success: function(resultado){
                $("#pros_ciu").html(resultado);
            }
           }); 
}

 function agregar(id){
    window.open("ventas/prospectos/info.php?id="+id , "CLIENTES", " width= 600 , height=500 ");
}                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              