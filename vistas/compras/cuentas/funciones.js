$(function(){
     $("#mostrar_tabla").html(mostrar_cxp(1));
     
    $('#cod').change(function(){
        mostrar_cxp(1);
      });
     $('#des').change(function(){
        mostrar_cxp(1);
      }); 
      
     $('#res').change(function(){
         mostrar_cxp(1);
     });
     $('#cod_cxp').change(function(){
        inv_buscar_codigo();
      });
 });  
 function inv_buscar_codigo(){
     var cod = $("#cod_cxp").val();
      $.ajax({
        type: 'GET',
        data: 'cod='+cod+'&sw=4',
         url: '../vistas/compras/cuentas/acciones.php',
         success: function(t) {
             var t = eval(t);
              $("#cod_cxp").val(cod);
               
       $("#nom_cxp").val(t[1]);
       $("#cta_cxp").val(t[2]);
       $("#rete_cxp").val(t[3]);
       $("#reteiva_cxp").val(t[4]);
       $("#reteica_cxp").val(t[5]);
       $("#porc_rete").val(t[6]);
       $("#por_iva").val(t[7]);
       $("#por_ica").val(t[8]);
       $("#base_cxp").val(t[9]);
       }
     
});
 }
    function mostrar_cxp(page){
        var cod = $("#cod").val();
        var des = $("#des").val();
        var res = $("#res").val();
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&des='+des+'&res='+res+'&page='+page,
                url: '../vistas/compras/cuentas/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                location.href='../index.php';
                }
            }
        });
    }
    
   function guardar_cxp(){
        var codcxp = $("#cod_cxp").val();
        var nomcxp = $("#nom_cxp").val();
        var ctacxp = $("#cta_cxp").val();
        var retecxp = $("#rete_cxp").val();
        var reteivacxp = $("#reteiva_cxp").val();
        var reteicacxp = $("#reteica_cxp").val();
        var porcrete = $("#porc_rete").val();
        var poriva = $("#por_iva").val(); 
        var porica = $("#por_ica").val();
        var basecxp= $("#base_cxp").val();
         if (codcxp===''){
            alert('') 
            $("#cod_cxp").focus();
            return false;
        }
         if (nomcxp===''){
            alert('') 
            $("#nom_cxp").focus();
            return false;
        }
         if (ctacxp===''){
            alert('') 
            $("#cta_cxp").focus();
            return false;
        }
         if (retecxp===''){
            alert('') 
            $("#rete_cxp").focus();
            return false;
        }
            if (basecxp===''){
            alert('') 
            $("#base_cxp").focus();
            return false;
        }
        
        $.ajax({
            type: 'GET',
            data: 'codcxp='+codcxp+'&nomcxp='+nomcxp+'&ctacxp='+ctacxp+'&retecxp='+retecxp+'&reteivacxp='+reteivacxp+'&reteicacxp='+reteicacxp+'&porcrete='+porcrete+'&poriva='+poriva+'&porica='+porica+'&basecxp='+basecxp+'&sw=1',
            url: '../vistas/compras/cuentas/acciones.php', 
            success: function(resultado){
               alert("Se guardo con exito"+(resultado));
                mostrar_cxp(1);
            }
           });
}

function limpiar_cxp(){
   $("#cod_cxp").val('');
   $("#nom_cxp").val('');
   $("#cta_cxp").val('');
   $("#rete_cxp").val('');
   $("#reteiva_cxp").val('');
   $("#reteica_cxp").val('');
   $("#porc_rete").val('');
   $("#por_iva").val(''); 
   $("#por_ica").val('');
   $("#base_cxp").val('');
}
function nuevo(){
    $("#lin2").modal("show");
    limpiar_cxp();
}

function editar_cxp(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/compras/cuentas/acciones.php', //
            success: function(resultado){
       var t = eval(resultado);
       $("#cod_cxp").val(t[0]);
       $("#nom_cxp").val(t[1]);
       $("#cta_cxp").val(t[2]);
       $("#rete_cxp").val(t[3]);
       $("#reteiva_cxp").val(t[4]);
       $("#reteica_cxp").val(t[5]);
       $("#porc_rete").val(t[6]);
       $("#por_iva").val(t[7]);
       $("#por_ica").val(t[8]);
       $("#base_cxp").val(t[9]);
 }
});
}
//function buscar_codcon(contabilidad){
//    window.open("../popup/contables/index.php?cotis="+contabilidad,"muestra","width=900, height=600")  
//}
//function pasar_contabl(des){
//    $("#mov_codcontab").val(des);
//}
//    
//    function buscar_codfuente(fuente){
//   window.open("../popup/fuente/index.php?cotis="+fuente,"muestra","width=900, height=600")  
//}
//function pasar_contablf(cod){
//    $("#mov_codfuente").val(cod);
//}
//     function upiva(cod){
//        var iva = $("#iva"+cod).val();
//        $.ajax({
//                type: 'GET',
//                data: 'cod='+cod+'&iva='+iva+'&sw=5',
//                url: '../vistas/inventario/movimiento/acciones.php',
//            success: function(d){
//                alert("Se actualizo con exito");
//            }
//        });
//    }