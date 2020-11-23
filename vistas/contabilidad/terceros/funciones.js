 $(function(){
     $("#mostrar_tabla").html(mostrar_ter(1));
     
    $('#cod').change(function(){
        mostrar_ter(1);
      });
     $('#des').change(function(){
        mostrar_ter(1);
      }); 
        $('#est').change(function(){
        mostrar_ter(1);
      }); 
     $('#res').change(function(){
         mostrar_ter(1);
     });
      $('#res').change(function(){
         mostrar_ter(1);
     });
       $('#tipod').change(function(){
         mostrar_ter(1);
     });
     $('#ter_identifi').change(function(){
        inv_buscar_codigo();
      });
 });  
 function inv_buscar_codigo(){
     var cod = $("#ter_identifi").val();
      $.ajax({
        type: 'GET',
        data: 'cod='+cod+'&sw=4',
         url: '../vistas/contabilidad/terceros/acciones.php',
         success: function(t) {
             var t = eval(t);
              $("#ter_identifi").val(cod);
                    
        $("#ter_codverif").val(t[1]);
        $("#ter_nombre").val(t[2]);
        $("#ter_tipo").val(t[3]);
        $("#ter_direccion").val(t[4]);
        $("#ter_telefono").val(t[5]);
        $("#ter_movil").val(t[6]);
        $("#ter_dep").val(t[7]);
        $("#ter_muni").val(t[8]); 
        $("#ter_pais").val(t[9]);
        $("#ter_fnacido").val(t[10]);
        $("#ter_correo").val(t[11]); 
        $("#ter_contacto").val(t[12]);
        $("#ter_desalum").val(t[13]);
        $("#ter_desvidrio").val(t[14]); 
        $("#ter_desacero").val(t[15]);
        $("#ter_estado").val(t[16]);
        $("#ter_cliespecial").val(t[17]); 
        $("#ter_retefuente").val(t[18]);
        $("#ter_reteica").val(t[19]);
        $("#ter_reteiva").val(t[20]); 
        $("#ter_retcree").val(t[21]);
        $("#ter_asesor").val(t[22]);
        $("#tipo_cliente").val(t[23]);
         }
     
});
 }
    function mostrar_ter(page){
        var cod = $("#cod").val();
        var des = $("#des").val();
        var res = $("#res").val();
        var est = $("#est").val();
        var tpd = $("#tipod").val();
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&des='+des+'&est='+est+'&res='+res+'&tpd='+tpd+'&page='+page,
                url: '../vistas/contabilidad/terceros/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_ter(){
        var teridentifi = $("#ter_identifi").val();
        var tercodverif = $("#ter_codverif").val();
        var ternombre = $("#ter_nombre").val();
        var tertipo = $("#ter_tipo").val();
        var terdireccion = $("#ter_direccion").val();
        var tertelefono = $("#ter_telefono").val();
        var termovil = $("#ter_movil").val();
        var terdep = $("#ter_dep").val();
        var termuni = $("#ter_muni").val(); 
        var terpais = $("#ter_pais").val();
        var terfnacido= $("#ter_fnacido").val();
        var tercorreo = $("#ter_correo").val(); 
        var tercontacto = $("#ter_contacto").val();
        var terdesalum= $("#ter_desalum").val();
        var terdesvidrio = $("#ter_desvidrio").val(); 
        var terdesacero = $("#ter_desacero").val();
        var terestado= $("#ter_estado").val();
        var tercliespeci = $("#ter_cliespecial").val(); 
        var terretefuente = $("#ter_retefuente").val();
        var terreteica= $("#ter_reteica").val();
        var terreteiva = $("#ter_reteiva").val(); 
        var terretcree = $("#ter_retcree").val();
        var terasesor= $("#ter_asesor").val();
        var tipocliente= $("#tipo_cliente").val();
      
       $.ajax({
            type: 'GET',
            data: 'teridentifi='+teridentifi+'&tercodverif='+tercodverif+'&ternombre='+ternombre+'&tertipo='+tertipo+'&terdireccion='+terdireccion+
                  '&tertelefono='+tertelefono+'&termovil='+termovil+ '&terdep='+terdep+'&termuni='+termuni+
                  '&terpais='+terpais+'&terfnacido='+terfnacido+'&tercorreo='+tercorreo+'&tercontacto='+tercontacto+
                  '&terdesalum='+terdesalum+'&terdesvidrio='+terdesvidrio+'&terdesacero='+terdesacero+
                  '&terestado='+terestado+'&tercliespeci='+tercliespeci+'&terretefuente='+terretefuente+
                  '&terreteica='+terreteica+'&terreteiva='+terreteiva+'&terretcree='+terretcree+'&terasesor='+terasesor+'&tipocliente='+tipocliente+'&sw=1',
            url: '../vistas/contabilidad/terceros/acciones.php', 
            success: function(resultado){
                console.log(resultado);
               alert("Se guardo con exito");
                mostrar_ter(1);
            }
           });
}

function limpiar_ter(){
        $("#ter_identifi").val('');
        $("#ter_codverif").val('');
        $("#ter_nombre").val('');
        $("#ter_tipo").val('');
        $("#ter_direccion").val('');
        $("#ter_telefono").val('');
        $("#ter_movil").val('');
        $("#ter_dep").val('');
        $("#ter_muni").val(''); 
        $("#ter_pais").val('');
        $("#ter_fnacido").val('');
        $("#ter_correo").val(''); 
        $("#ter_contacto").val('');
        $("#ter_desalum").val('');
        $("#ter_desvidrio").val(''); 
        $("#ter_desacero").val('');
        $("#ter_estado").val('');
        $("#ter_cliespecial").val(''); 
        $("#ter_retefuente").val('');
        $("#ter_reteica").val('');
        $("#ter_reteiva").val(''); 
        $("#ter_retcree").val('');
        $("#ter_asesor").val('');
        $("#tipo_cliente").val('');
}
function nuevo(){
    $("#lin2").modal("show");
    limpiar_ter();
}

function editar_ter(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/contabilidad/terceros/acciones.php', //
            success: function(resultado){
    var t = eval(resultado);
     
        $("#ter_identifi").val(t[0]);
        $("#ter_codverif").val(t[1]);
        $("#ter_nombre").val(t[2]);
        $("#ter_tipo").val(t[3]);
        $("#ter_direccion").val(t[4]);
        $("#ter_telefono").val(t[5]);
        $("#ter_movil").val(t[6]);
        $("#ter_dep").val(t[7]);
        $("#ter_muni").val(t[8]); 
        $("#ter_pais").val(t[9]);
        $("#ter_fnacido").val(t[10]);
        $("#ter_correo").val(t[11]); 
        $("#ter_contacto").val(t[12]);
        $("#ter_desalum").val(t[13]);
        $("#ter_desvidrio").val(t[14]); 
        $("#ter_desacero").val(t[15]);
        $("#ter_estado").val(t[16]);
        $("#ter_cliespecial").val(t[17]); 
        $("#ter_retefuente").val(t[18]);
        $("#ter_reteica").val(t[19]);
        $("#ter_reteiva").val(t[20]); 
        $("#ter_retcree").val(t[21]);
        $("#ter_asesor").val(t[22]);
        $("#tipo_cliente").val(t[23]);
 }
});
}
function cargarmund(){
     var depar = $("#ter_dep").val(); // 
         $.ajax({
            type: 'GET',
            data: 'nombre='+depar+'&sw=5',  //
            url: '../vistas/contabilidad/terceros/acciones.php', //
            success: function(resultado){
                $("#ter_muni").html(resultado);
            }
           }); 
}

   
