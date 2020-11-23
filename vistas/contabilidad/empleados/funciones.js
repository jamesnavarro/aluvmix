 $(function(){
     $("#mostrar_tabla").html(mostrar_emp(1));
     
    $('#cod').change(function(){
        mostrar_emp(1);
      });
     $('#des').change(function(){
        mostrar_emp(1);
      }); 
        $('#est').change(function(){
        mostrar_emp(1);
      }); 
     $('#res').change(function(){
         mostrar_emp(1);
     });
      $('#res').change(function(){
         mostrar_emp(1);
     });
       $('#tipod').change(function(){
         mostrar_emp(1);
     });
     $('#identifi_emp').change(function(){
        inv_buscar_codigo();
      });
 });  
 function inv_buscar_codigo(){
     var cod = $("#identifi_emp").val();
      $.ajax({
        type: 'GET',
        data: 'cod='+cod+'&sw=4',
         url: '../vistas/contabilidad/empleados/acciones.php',
         success: function(t) {
             var t = eval(t);
     $("#identifi_emp").val(cod);
     $("#tipodoc_emp").val(t[0]);
     $("#codigo_emp").val(t[2]);
     $("#nombre_emp").val(t[3]);
     $("#direcc_emp").val(t[4]);
     $("#telefono_emp").val(t[5]);
     $("#movil_emp").val(t[6]);
     $("#correo_emp").val(t[7]);
     $("#costoa_emp").val(t[8]); 
     $("#cargo_emp").val(t[9]); 
     $("#salaactu_emp").val(t[10]);
     $("#estado_emp").val(t[11]); 
     $("#emp_dep").val(t[12]); 
     $("#emp_muni").val(t[13]); 
     $("#registro_emp").val(t[14]);
     $("#modificacion_emp").val(t[15]); 
               
       
         }
     
});
 }
    function mostrar_emp(page){
        var cod = $("#cod").val();
        var des = $("#des").val();
        var res = $("#res").val();
        var est = $("#est").val();
        var tpd = $("#tipod").val();
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&des='+des+'&est='+est+'&res='+res+'&tpd='+tpd+'&page='+page,
                url: '../vistas/contabilidad/empleados/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_emp(){
        var tipodocemp = $("#tipodoc_emp").val();
        var identifiemp = $("#identifi_emp").val();
        var codigoemp = $("#codigo_emp").val();
        var nombreemp = $("#nombre_emp").val();
        var direccemp = $("#direcc_emp").val();
        var telefonoemp = $("#telefono_emp").val();
        var movilemp = $("#movil_emp").val();
        var correoemp = $("#correo_emp").val();
        var costoaemp = $("#costoa_emp").val(); 
        var cargoemp = $("#cargo_emp").val(); 
        var salaactuemp = $("#salaactu_emp").val();
        var estadoemp= $("#estado_emp").val(); 
        var empdep= $("#emp_dep").val(); 
        var empmuni= $("#emp_muni").val(); 
        var registroemp = $("#registro_emp").val();
        var modificacionemp= $("#modificacion_emp").val(); 
        
       $.ajax({
            type: 'GET',
            data: 'tipodocemp='+tipodocemp+'&identifiemp='+identifiemp+'&codigoemp='+codigoemp+'&nombreemp='+nombreemp+'&direccemp='+direccemp+
                  '&telefonoemp='+telefonoemp+'&movilemp='+movilemp+ '&correoemp='+correoemp+'&costoaemp='+costoaemp+
                  '&cargoemp='+cargoemp+'&salaactuemp='+salaactuemp+'&estadoemp='+estadoemp+'&empdep='+empdep+'&empmuni='+empmuni+'&registroemp='+registroemp+'&modificacionemp='+modificacionemp+'&sw=1',
            url: '../vistas/contabilidad/empleados/acciones.php', 
            success: function(resultado){
                console.log(resultado);
               alert("Se guardo con exito");
                mostrar_emp(1);
            }
           });
}

function limpiar_emp(){
     $("#tipodoc_emp").val('');
     $("#identifi_emp").val('');
     $("#codigo_emp").val('');
     $("#nombre_emp").val('');
     $("#direcc_emp").val('');
     $("#telefono_emp").val('');
     $("#movil_emp").val('');
     $("#correo_emp").val('');
     $("#costoa_emp").val(''); 
     $("#cargo_emp").val(''); 
     $("#salaactu_emp").val('');
     $("#estado_emp").val(''); 
     $("#emp_dep").val(''); 
     $("#emp_muni").val(''); 
     $("#registro_emp").val('');
     $("#modificacion_emp").val(''); 
}
function nuevo(){
    $("#lin2").modal("show");
    limpiar_emp();
}

function editar_emp(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/contabilidad/empleados/acciones.php', //
            success: function(resultado){
                console.log(resultado);
    var t = eval(resultado);
     
     $("#tipodoc_emp").val(t[0]);
     $("#identifi_emp").val(t[1]);
     $("#codigo_emp").val(t[2]);
     $("#nombre_emp").val(t[3]);
     $("#direcc_emp").val(t[4]);
     $("#telefono_emp").val(t[5]);
     $("#movil_emp").val(t[6]);
     $("#correo_emp").val(t[7]);
     $("#costoa_emp").val(t[8]); 
     $("#cargo_emp").val(t[9]); 
     $("#salaactu_emp").val(t[10]);
     $("#estado_emp").val(t[11]); 
     $("#emp_dep").val(t[12]); 
     $("#emp_muni").val(t[13]); 
     $("#registro_emp").val(t[14]);
     $("#modificacion_emp").val(t[15]); 
       
}
});

}
function cargarmund(){
     var depar = $("#emp_dep").val(); // 
         $.ajax({
            type: 'GET',
            data: 'nombre='+depar+'&sw=5',  //
            url: '../vistas/contabilidad/empleados/acciones.php', //
            success: function(resultado){
                $("#emp_muni").html(resultado);
            }
           }); 
}

   
