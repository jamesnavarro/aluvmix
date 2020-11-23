 $(function(){
     $("#mostrar_tabla").html(mostrar_usu(1));
     
    $('#cod').change(function(){
        mostrar_usu(1);
     });
     $('#des').change(function(){
        mostrar_usu(1);
     }); 
        $('#est').change(function(){
        mostrar_usu(1);
      }); 
     $('#res').change(function(){
         mostrar_usu(1);
     });
      $('#res').change(function(){
         mostrar_usu(1);
     });
       $('#tipod').change(function(){
         mostrar_usu(1);
     });
     $('#nombre_user').change(function(){
        inv_buscar_codigo();
      });
 });  
 function inv_buscar_codigo(){
     var cod = $("#nombre_user").val();
      $.ajax({
        type: 'GET',
        data: 'cod='+cod+'&sw=4',
         url: '../vistas/contabilidad/usuarios/acciones.php',
         success: function(t) {
      var p = eval(t);
     $("#nombre_user").val(cod);
     $("#id_usuario").val(p[0]);
     $("#codbarra_user").val(p[2]);
     $("#numcedula_user").val(p[4]);
     $("#correo_user").val(p[5]);
     $("#administrador_user").val(p[6]);
     $("#nomcompleto_user").val(p[7]);
     $("#apellido_user").val(p[8]); 
     $("#estado_user").val(p[9]); 
     $("#cargo_usu").val(p[10]);
     $("#area_user").val(p[11]); 
     $("#telefono_user").val(p[12]); 
     $("#movil_user").val(p[13]); 
     $("#direccion_user").val(p[14]);
     $("#pais_user").val(p[15]); 
     $("#user_dep").val(p[16]);
     $("#user_muni").val(p[17]);
     $("#sede_user").val(p[18]);
     $("#rol_user").val(p[19]);
     $("#empresa_user").val(p[20]);
     $("#sangre_user").val(p[21]);
     $("#ruta_user").val(p[22]);
         }
});
 }
    function mostrar_usu(page){
        var cod = $("#cod").val();
        var des = $("#des").val();
        var res = $("#res").val();
        var est = $("#est").val();
        var tpd = $("#tipod").val();
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&des='+des+'&est='+est+'&res='+res+'&tpd='+tpd+'&page='+page,
                url: '../vistas/contabilidad/usuarios/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_usu(){
        var id = $("#id_usuario").val();
        var nombreuser = $("#nombre_user").val();
        var codbarrauser = $("#codbarra_user").val();
        var contraseñauser = $("#contraseña_user").val();
        var numcedulauser = $("#numcedula_user").val();
        var correouser = $("#correo_user").val();
        var administradoruser = $("#administrador_user").val();
        var nomcompletouser = $("#nomcompleto_user").val();
        var apellidouser = $("#apellido_user").val(); 
        var estadouser = $("#estado_user").val(); 
        var cargous = $("#cargo_usu").val();
        var areauser= $("#area_user").val(); 
        var telefonouser= $("#telefono_user").val(); 
        var moviluser= $("#movil_user").val(); 
        var direccionuser = $("#direccion_user").val();
        var paisuser= $("#pais_user").val(); 
        var userdep = $("#user_dep").val();
        var usermuni = $("#user_muni").val();
        var sedeuser = $("#sede_user").val();
        var roluser = $("#rol_user").val();
        var empresauser = $("#empresa_user").val();
        var sangreuser = $("#sangre_user").val();
        var rutauser = $("#ruta_user").val();
        var user_fom = $("#user_fom").val();
        
        if(nombreuser===''){
        alert("Ingrese el usuario");
        $("#nombre_user").focus();
        return false;
        }
         
       if(numcedulauser===''){
        alert("Ingrese el numero de documento¡");
        $("#numcedula_user").focus();
        return false;
        }
         if(nomcompletouser===''){
        alert("Nombre¡");
        $("#nomcompleto_user").focus();
        return false;
        }
          if(apellidouser===''){
        alert("Apellido¡");
        $("#apellido_user").focus();
        return false;
        }
          if(cargous===''){
        alert("cargo");
        $("#cargo_usu").focus();
        return false;
        }
          if(areauser===''){
        alert("area¡");
        $("#area_user").focus();
        return false;
        }
       
           $.ajax({
            type: 'GET',
            data: 'id='+id+'&nombreuser='+nombreuser+'&codbarrauser='+codbarrauser+'&contraseñauser='+contraseñauser+'&numcedulauser='+numcedulauser+'&correouser='+correouser+
                   '&administradoruser='+administradoruser+'&nomcompletouser='+nomcompletouser+'&apellidouser='+apellidouser+'&estadouser='+estadouser+'&cargous='+cargous+
                   '&areauser='+areauser+'&telefonouser='+telefonouser+'&moviluser='+moviluser+'&direccionuser='+direccionuser+'&paisuser='+paisuser+'&userdep='+userdep+'&usermuni='+usermuni+
                   '&sedeuser='+sedeuser+'&roluser='+roluser+'&empresauser='+empresauser+'&sangreuser='+sangreuser+'&rutauser='+rutauser+'&user_fom='+user_fom+'&sw=1',
            url: '../vistas/contabilidad/usuarios/acciones.php', 
            success: function(resultado){
                console.log(resultado)
                $("#id_usuario").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_usu(1);
            }
           });
}

function limpiar_usu(){
     $("#id_usuario").val('');
     $("#nombre_user").val('');
     $("#codbarra_user").val('');
     $("#contraseña_user").val('');
     $("#numcedula_user").val('');
     $("#correo_user").val('');
     $("#administrador_user").val('');
     $("#nomcompleto_user").val('');
     $("#apellido_user").val(''); 
     $("#estado_user").val(''); 
     $("#cargo_usu").val('');
     $("#area_user").val(''); 
     $("#telefono_user").val(''); 
     $("#movil_user").val(''); 
     $("#direccion_user").val('');
     $("#pais_user").val('Colombia'); 
     $("#user_dep").val('');
     $("#user_muni").val('');
     $("#sede_user").val('');
     $("#rol_user").val('');
     $("#empresa_user").val('');
     $("#sangre_user").val('');
     $("#ruta_user").val(''); 
     $("#user_fom").val('');
}     
function nuevo(){
    $("#lin2").modal("show");
    limpiar_usu();
}

function editar_usu(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
         $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/contabilidad/usuarios/acciones.php', //
        success: function(resultado){
       var p = eval(resultado);
     $("#id_usuario").val(p[0]);
     $("#nombre_user").val(p[1]);
     $("#codbarra_user").val(p[2]);
     $("#numcedula_user").val(p[4]);
     $("#correo_user").val(p[5]);
     $("#administrador_user").val(p[6]);
     $("#nomcompleto_user").val(p[7]);
     $("#apellido_user").val(p[8]); 
     $("#estado_user").val(p[9]); 
     $("#cargo_usu").val(p[10]);
     $("#area_user").val(p[11]); 
     $("#telefono_user").val(p[12]); 
     $("#movil_user").val(p[13]); 
     $("#direccion_user").val(p[14]);
     $("#pais_user").val(p[15]); 
     $("#user_dep").val(p[16]);
     $("#user_muni").val(p[17]);
     $("#sede_user").val(p[18]);
     $("#rol_user").val(p[19]);
     $("#empresa_user").val(p[20]);
     $("#sangre_user").val(p[21]);
     $("#ruta_user").val(p[22]); 
     $("#user_fom").val(p[23]);
 }
 });
}
function cargarmund(){
     var depar = $("#user_dep").val(); // 
         $.ajax({
            type: 'GET',
            data: 'nombre='+depar+'&sw=5',  //
            url: '../vistas/contabilidad/usuarios/acciones.php', //
            success: function(resultado){
                $("#user_muni").html(resultado);
            }
           }); 
}

function roles(){
     var depar = $("#user_dep").val(); // 
         $.ajax({
            type: 'GET',
            data: 'nombre='+depar+'&sw=5',  //
            url: '../vistas/contabilidad/usuarios/acciones.php', //
            success: function(resultado){
                $("#user_muni").html(resultado);
            }
           }); 
}
function roluser(id){
  $("#modalrol").modal('show');
          $.ajax({
              type: 'GET',
              data:'id='+id+'&sw=6',
              url: '../vistas/contabilidad/usuarios/acciones.php',
              success: function(d){
                $('#ver_roles').html(d);
              }
      });   
}
function addrol(id){
          $.ajax({
              type: 'GET',
              data:'id='+id+'&sw=7',
              url: '../vistas/contabilidad/usuarios/acciones.php',
              success: function(d){
                 //alert(id);
                
              }
      });   
}
function upest(id){
          $.ajax({
              type: 'GET',
              data:'id='+id+'&sw=8',
              url: '../vistas/contabilidad/usuarios/acciones.php',
              success: function(d){
                 //alert(id);
                
              }
      });   
}
   
