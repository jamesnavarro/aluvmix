$(function(){
     $("#mostrar_tabla").html(mostrar_mov(1));
     
    $('#cod').change(function(){
        mostrar_mov(1);
      });
     $('#des').change(function(){
        mostrar_mov(1);
      }); 
      
     $('#res').change(function(){
         mostrar_mov(1);
     });
     $('#mov_cod').change(function(){
        inv_buscar_codigo();
      });
 });  
 function inv_buscar_codigo(){
     var cod = $("#mov_cod").val();
      $.ajax({
        type: 'GET',
        data: 'cod='+cod+'&sw=4',
         url: '../vistas/inventario/movimiento/acciones.php',
         success: function(t) {
             var t = eval(t);
              $("#mov_cod").val(cod);
              $("#mov_nomb").val(t[1]);
              $("#mov_tipo").val(t[2]);
              $("#mov_ultconsec").val(t[3]);               
              $("#mov_codcontab").val(t[4]);
              $("#mov_codfuente").val(t[5]);
              $("#estado_mov").val(t[6]);
              $("#mov_actprod").val(t[7]); 
              $("#mov_actuconta").val(t[8]);
              $("#mov_equivale").val(t[9]);
              $("#centro_c").val(t[10]); 
         }
     
});
 }
    function mostrar_mov(page){
        var cod = $("#cod").val();
        var des = $("#des").val();
        var res = $("#res").val();
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&des='+des+'&res='+res+'&page='+page,
                url: '../vistas/inventario/movimiento/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
    
   function guardar_mov(){
        var movcod = $("#mov_cod").val();
        var movnomb = $("#mov_nomb").val();
        var movtipo = $("#mov_tipo").val();
        var movultconsec = $("#mov_ultconsec").val();
        var movcodcontab = $("#mov_codcontab").val();
        var movcodfuente = $("#mov_codfuente").val();
        var estadomov = $("#estado_mov").val();
        var movactprod = $("#mov_actprod").val(); 
        var movactuconta = $("#mov_actuconta").val();
        var movaequiv= $("#mov_equivale").val();
        var centro_c= $("#centro_c").val();
        
        
        
         if (movcod===''){
            alert('') 
            $("#mov_cod").focus();
            return false;
        }
         if (movnomb===''){
            alert('') 
            $("#mov_nomb").focus();
            return false;
        }
         if (movtipo===''){
            alert('') 
            $("#mov_tipo").focus();
            return false;
        }
         if (movultconsec===''){
            alert('') 
            $("#mov_ultconsec").focus();
            return false;
        }
        
         
       $.ajax({
            type: 'GET',
            data: 'movcod='+movcod+'&movnomb='+movnomb+'&movtipo='+movtipo+'&movultconsec='+movultconsec+'&movcodcontab='+movcodcontab+'&&movcodfuente='+movcodfuente+'&estadomov='+estadomov+'&movactprod='+movactprod+'&movactuconta='+movactuconta+'&movaequiv='+movaequiv+'&centro_c='+centro_c+'&sw=1',
            url: '../vistas/inventario/movimiento/acciones.php', 
            success: function(resultado){
               alert("Se guardo con exito"+(resultado));
                mostrar_mov(1);
            }
           });
}

function limpiar_mov(){
    $("#mov_cod").val('');
    $("#mov_nomb").val('');
    $("#mov_tipo").val('');
    $("#mov_ultconsec").val('');
//        var movestado = $("#mov_estado").val();
    $("#mov_codcontab").val('');
    $("#mov_codfuente").val('');
    $("#estado_mov").val('');
    $("#mov_actprod").val(''); 
    $("#mov_actuconta").val('');
    $("#mov_equivale").val('');
    $("#centro_c").val('');
}
function nuevo(){
    $("#lin2").modal("show");
    limpiar_mov();
}

function editar_mov(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/inventario/movimiento/acciones.php', //
            success: function(resultado){
    var t = eval(resultado);
    
       $("#mov_cod").val(t[0]);
       $("#mov_nomb").val(t[1]);
       $("#mov_tipo").val(t[2]);
       $("#mov_ultconsec").val(t[3]);
       $("#mov_codcontab").val(t[4]);
       $("#mov_codfuente").val(t[5]);
       $("#estado_mov").val(t[6]);
       $("#mov_actprod").val(t[7]); 
       $("#mov_actuconta").val(t[8]);
       $("#mov_equivale").val(t[9]);  
       $("#centro_c").val(t[10]); 
 }
});
}

function buscar_codcon(contabilidad){
    window.open("../popup/contables/index.php?cotis="+contabilidad,"muestra","width=900, height=600")  
}
function pasar_contabl(des){
    $("#mov_codcontab").val(des);
}
    
    function buscar_codfuente(fuente){
   window.open("../popup/fuente/index.php?cotis="+fuente,"muestra","width=900, height=600")  
}
function pasar_contablf(cod){
    $("#mov_codfuente").val(cod);
}
     function upiva(cod){
        var iva = $("#iva"+cod).val();
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&iva='+iva+'&sw=5',
                url: '../vistas/inventario/movimiento/acciones.php',
            success: function(d){
                alert("Se actualizo con exito");
            }
        });
    }