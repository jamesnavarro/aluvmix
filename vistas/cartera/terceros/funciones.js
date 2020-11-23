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
      
        $('#btn_guardar').click(function(){
             guardar_contacto();  
     });
          $('#bac_guardar').click(function(){
             guardar_actividad();  
     });
 });  
 function inv_buscar_codigo(){
     var cod = $("#ter_identifi").val();
      $.ajax({
        type: 'GET',
        data: 'cod='+cod+'&sw=4',
         url: '../vistas/cartera/terceros/acciones.php',
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
                url: '../vistas/cartera/terceros/lista.php',
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
            url: '../vistas/cartera/terceros/acciones.php', 
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
            url: '../vistas/cartera/terceros/acciones.php', //
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
            url: '../vistas/cartera/terceros/acciones.php', //
            success: function(resultado){
                $("#ter_muni").html(resultado);
            }
           }); 
}
function mostrar_llamadas(){
     var id_cliente = $("#id_cliente").val();
        $.ajax({
            type: 'GET',
            data: '&id_cliente='+id_cliente,
            url: 'lista_nuevacti.php',
            success: function(resultado){
                 $("#mostrar_llamadas").html(resultado);
            }
           }); 
}
function mostrar_loscontactos(){
     var id_cliente = $("#id_cliente").val();
  
        $.ajax({
            type: 'GET',
            data: 'id_cliente='+id_cliente,
            url: 'lista_nuecontac.php',
            success: function(resultado){
                 $("#mostrar_loscontactos").html(resultado);
            }
           }); 
}

 function formcontac(){
    $("#Modalcont").modal("show"); 
    //limpiar_loscont();
}
 function formllamada(){
    $("#FormularioAgenda").modal("show");
    limpiar_nuacti(); 
 }
function editar_act_nue(id){
    $("#FormularioAgenda").modal("show"); 
    $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=13',  //
            url: '../contratos/acciones.php', 
            success: function(datos){
                var p= eval(datos);
                var id_nue_a = $("#id_a_nuevo").val(p[0]); 
                var moti_nue= $("#motivo_nue").val(p[1]);
                var des_nu= $("#descrip_nueva").val(p[2]);
                var fech_nue = $("#fec_ini_nueva").val(p[3]);
                if(p[4]=='Completada'){
                   $("#est_llamada_nu").attr("disabled",true);
               }else{
                   $("#est_llamada_nu").attr("disabled",false);
               }
                var est_nue = $("#est_llamada_nu").val(p[4]);
                var tipo_nuev = $("#tip_llamada_nue").val(p[5]);
                var cont_nuevo = $("#contacto_lla").val(p[6]);
                var nom_nuevact = $("#nombre_contacto_lla").val(p[7]);
                var hor_nuev= $("#hra_nueva").val(p[8]);
                var alarnuev= $("#alarma_nueva").val(p[9]);
 }
           });
}
function editar_loscontactos(id){
    $("#Modalcont").modal("show"); 
    $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=9',  //
            url: '../contratos/acciones.php', 
            success: function(datos){
                var p = eval(datos);
                var id_consecont = $("#consecu_contacto").val(p[0]); 
                var nameconta= $("#nom_contact").val(p[1]);
                var tl_contac = $("#tel_contact").val(p[2]);
                var mail_contac= $("#mail_contac").val(p[3]);
                var carg_contac = $("#cargo_contact").val(p[4]);
                var sug_cont = $("#sug_contact").val(p[5]);
                var por_contac = $("#regis_contac").val(p[6]);
                var fec_conta= $("#fecha_reg_contac").val(p[7]);
                //var su_relacion= $("#la_Relacion").val(p[8]);

            }
           });
}


function programar(id,nombre){
    window.open("cartera/terceros/detalles.php?id="+id+"&name="+nombre , "Llamadas", " width= 900 , height=500 ");
}

 function limpiar_nuacti(){

                var id_n = $("#id_a_nuevo").val(''); 
                var mot= $("#motivo_nue").val('');
                var fec = $("#fec_ini_nueva").val('');
                var hor= $("#hra_nueva").val('');
                var use = $("#asig_nueva").val();
                var ala = $("#alarma_nueva").val();
                var des = $("#descrip_nueva").val('');
                var tip= $("#tip_llamada_nue").val('Saliente');
                var est= $("#est_llamada_nu").val('Planificada');
                var idco= $("#contacto_lla").val('');
                var con= $("#nombre_contacto_lla").val('');

                var obra = $("#radicado_doc").val('');

}

function guardar_contacto(){ 
                var id_conse = $("#consecu_contacto").val(); 
                var namecon= $("#nom_contact").val();
                var tl_co = $("#tel_contact").val();
                var mail_con= $("#mail_contac").val();
                var carg_con = $("#cargo_contact").val();
                var sug_con = $("#sug_contact").val();
                var por_cont = $("#regis_contac").val();
                var fec_cont= $("#fecha_reg_contac").val();
                var se_relaci= $("#la_Relacion").val();

     if(namecon===''){
        sweetAlert("nombre!");
        $("#nom_contact").focus();
        return false;
    }
    if(tl_co===''){
        sweetAlert("telefono");
        $("#tel_contact").focus();
        return false;
    }
     if(mail_con===''){
        sweetAlert("email");
        $("#mail_contac").focus();
        return false;
     }
      if(carg_con===''){
        sweetAlert("numero de pedido");
        $("#cargo_contact").focus();
        return false;
     }
 
        $.ajax({
            type: 'GET',
            data: 'id_nuevocont='+id_conse+'&nom_nuevocon='+namecon+'&tel_nuevocont='+tl_co+'&emai_nuevocont='+mail_con+'&carg_nuevocont='+carg_con+'&suge_nuevocon='+sug_con+'&guardo_nuevo='+por_cont+'&fech_nuevocont='+fec_cont+
                  '&cruse_relaci='+se_relaci+'&sw=6',
            url: 'acciones.php', 
            success: function(resultado){
                $("#consecu_contacto").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_loscontactos(1);
            }
           });
}
function guardar_actividad(){ 
                var id_n = $("#id_a_nuevo").val(); 
                var mot= $("#motivo_nue").val();
                var fec = $("#fec_ini_nueva").val();
                var hor= $("#hra_nueva").val();
                var use = $("#asig_nueva").val();
                var ala = $("#alarma_nueva").val();
                var des = $("#descrip_nueva").val();
                var tip= $("#tip_llamada_nue").val();
                var est= $("#est_llamada_nu").val();
                var idco= $("#contacto_lla").val();
                var con= $("#nombre_contacto_lla").val();
                var rel= $("#relacion_con").val();
                var obra = $("#radicado_doc").val();
                if(est==='Completada'){
         sweetAlert("Upss, ya no puedes editar esta informacion, crea una nueva llamada !");
         return false;
     }
     
     if(mot===''){
        sweetAlert("Digite el asunto!");
        $("#motivo_nue").focus();
        return false;
    }
    if(fec===''){
        sweetAlert("Seleccione la fecha");
        $("#fec_ini_nueva").focus();
        return false;
     }
      if(hor===''){
        sweetAlert("Seleccione la hora");
        $("#hra_nueva").focus();
        return false;
     }
    if(use===''){
        sweetAlert("Seleccione el usuario");
        $("#asig_nueva").focus();
        return false;
    }
    if(id_n!==''){
      if(des===''){
        sweetAlert("Digite la respuesta del cliente");
        $("#descrip_nueva").focus();
        return false;
    }}
       if(tip===''){
        sweetAlert("Digite tipo de llamada");
        $("#tip_llamada_nue").focus();
        return false;
    }
       if(est===''){
        sweetAlert("Digite estado de la llamada");
        $("#est_llamada_nu").focus();
        return false;
    }
    if(idco===''){
        sweetAlert("Seleccione el contacto");
        $("#nombre_contacto_lla").focus();
        return false;
    }
     $("#bac_guardar").attr("disabled", true );
        $.ajax({
            type: 'GET',
            data: 'id_lla='+id_n+'&asunto='+mot+'&fecha='+fec+'&hora='+hor+'&asi='+use+'&aviso='+ala+'&desc='+des+'&llamada='+tip+
                  '&est_lla='+est+'&id_con='+idco+'&nom_con='+con+'&rel='+rel+'&obra='+obra+'&sw=7',
            url: 'acciones.php', 
            success: function(resultado){
                $("#id_a_nuevo").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_llamadas();
                $("#bac_guardar").attr("disabled", false );
            }
           });
}




function buscar_contacto(id){
    window.open("../../../ventanas/contactos/index.php?id="+id , "CLIENTES", " width= 600 , height=500 ");
}


 function obtener_contacto(id, nombre){
    $("#contacto_lla").val(id);
    $("#nombre_contacto_lla").val(nombre);
}
//function validar_lla(){
//      var des_nu= $("#descrip_nueva").val();
//      if(des_nu!==''){
//          $("#est_llamada_nu").val('Completada');
//      }
//}