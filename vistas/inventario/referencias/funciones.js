//PRIMERA TABLA CONTROLER INDEX
$(function(){
     $("#mostrar_tabla").html(mostrar_line(1));
     
    $('#cod').change(function(){
        mostrar_line(1);
      });
     $('#des').change(function(){
        mostrar_line(1);
      }); 
        $('#est').change(function(){
        mostrar_line(1);
      }); 
     $('#res').change(function(){
         mostrar_line(1);
     });
     $('#fcod').change(function(){
        inv_buscar_codigo();
      });
 });  
 function inv_buscar_codigo(){
     var cod = $("#fcod").val();
      $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&sw=4',
                url: '../vistas/inventario/referencias/acciones.php',
         success: function(t) {
             var t = eval(t);
              $("#fcod").val(cod);
              $("#fdes").val(t[1]);
              $("#fres").val(t[2]); 
              $("#fest").val(t[3]);
         }
     
});
 }
    function mostrar_line(page){
        var cod = $("#cod").val();
        var des = $("#des").val();
         var res = $("#res").val();
        var est = $("#est").val();
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&des='+des+'&est='+est+'&res='+res+'&page='+page,
                url: '../vistas/inventario/referencias/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }

function actualiza_dados(id) {
    $.ajax({
        type: 'POST',
        data: 'ref='+id,
        url: '../vistas/inventario/referencias/lista_dados.php',
        success: function (d) {
            $("#mostrar_dados").html(d);
            if (d == 'error') {
                location.href = '../index.php';
            }
        }
    });
}

function eliminar_dado(id,ref) {
    $.post("../vistas/inventario/referencias/eliminar_general.php", { "deldado": id }, function (data) {
        if (data.sucess == 1) {
            actualiza_dados(ref);
        }
        else {
            alert('Error al intentar Eliminar el Dado!');
        }
    }, "json");
}

   function guardar_lin(){
        var cod = $("#fcod").val();
        var des = $("#fdes").val();
        var res = $("#fres").val();
        var est = $("#fest").val();
        if (cod===''){
            alert('debe ingresar la descripcion') 
            $("#desc_lin").focus();
            return false;
        }
        if (des===''){
            alert('debe ingresar la descripcion') 
            $("#desc_lin").focus();
            return false;
         }
    $.ajax({
            type: 'GET',
            data: 'cod='+cod+'&des='+des+'&res='+res+'&est='+est+'&sw=1',
            url: '../vistas/inventario/referencias/acciones.php', 
            success: function(resultado){
            
               alert("Se guardo con exito");
                mostrar_line(1);
            }
           });
}

function limpiar_lin(){
  $("#fcod").val('');
  $("#fdes").val('');
  $("#fres").val(''); 
  $("#fest").val('');
}
function nuevo(){
    $("#lin2").modal("show");
    limpiar_lin();
}
// FIN INDEX ONE TABLE
$(function(){
     $("#mostrar_tabla2").html(mostrar_line2(1));
     
    $('#cod2').change(function(){
        mostrar_line2(1);
      });
       $('#ref2').change(function(){
        mostrar_line2(1);
      });
     $('#des2').change(function(){
        mostrar_line2(1);
      }); 
        $('#est').change(function(){
        mostrar_line2(1);
      }); 
     $('#est2').change(function(){
         mostrar_line2(1);
     });
     $('#fcod').change(function(){
        inv_buscar_codigo();
      });
         $('#codxa').change(function(){
      });
        buscar_cod();
 });  
 function inv_buscar_codigo2(){
     var cod = $("#fcod").val();
      $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&sw=4',
                url: '../vistas/inventario/referencias/acciones.php',
         success: function(t) {
             var t = eval(t);
              $("#fcod").val(cod);
              $("#fdes").val(t[1]);
              $("#fres").val(t[2]); 
              $("#fest").val(t[3]);
         }
     
});
 }
function mostrar_line2(page){
        var cod = $("#cod2").val();
        var des = $("#des2").val();
        var res = $("#ref2").val();
        var est = $("#est2").val();
        $.ajax({
                type: 'GET',
                data: 'cod2='+cod+'&des2='+des+'&est='+est+'&res='+res+'&page='+page,
                url: '../vistas/inventario/referencias/lista2.php',
            success: function(d){
                $("#mostrar_tabla2").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
}
function guardar_lin2(){
        var cod = $("#fcod").val();
        var des = $("#fdes").val();
        var res = $("#fres").val();
        var est = $("#fest").val();
        if (cod===''){
            alert('debe ingresar la descripcion') 
            $("#desc_lin").focus();
            return false;
        }
        if (des===''){
            alert('debe ingresar la descripcion') 
            $("#desc_lin").focus();
            return false;
         }
    $.ajax({
            type: 'GET',
            data: 'cod='+cod+'&des='+des+'&res='+res+'&est='+est+'&sw=1',
            url: '../vistas/inventario/referencias/acciones.php', 
            success: function(resultado){
               alert("Se guardo con exito");
                mostrar_line2(1);
            }
           });
}

function limpiar_lin2(){
  $("#fcod").val('');
  $("#fdes").val('');
  $("#fres").val(''); 
  $("#fest").val('');
}
function nuevo2(){
    $("#lin2").modal("show");
    limpiar_lin();
}
function buscar_cod(){
       var cod = $("#codxa").val();
       $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&sw=1',
                url: '../vistas/inventario/referencias/acciones.php',
         success: function(t) {
             var t = eval(t);
              $("#codxa").val(cod);
              $("#refxa").val(t[1]);
              $("#nomxa").val(t[2]); 
              $("#artxa").val(t[3]);
              $("#colxa").val(t[4]);
              $("#anchoxa").val(t[5]); 
              $("#altoxa").val(t[6]);
              $("#espxa").val(t[7]);
              $("#arexa").val(t[8]); 
              $("#pesxa").val(t[9]);
              $("#stc_max").val(t[10]); 
              $("#stc_min").val(t[11]);
              $("#stc_seg").val(t[12]); 
              $("#cospa").val(t[13]);
              $("#obsxa").val(t[14]);  
              $("#cla_xa").val(t[15]);  
              $("#gru_xa").val(t[16]);  
              $("#iva_xa").val(t[17]); 
              $("#poriva_xa").val(t[18]); 
              $("#und_xa").val(t[19]); 
         }
     });
}
function ver_colores(){
    window.open("../vistas/inventario/popup/existencias/colores.php","Colores"," width=500px , height=400px ");
}
function bus_cod_fom(){
    var cod = $("#codxa").val();
    if(cod==''){
        alert("Digite el codigo!");
        $("#codxa").focus();
        return false;
    }
      $.ajax({
          type:'GET',
          //data: JSON.stringify(datos),
          url:'http://172.16.0.30:8989/api/MAEINV/'+cod,
          contentType: 'application/json',
          success: function(da){
             var p = eval(da);
              console.log('Resultado: '+p.INV_IVA);
               $("#codxa").val(cod);
              $("#refxa").val(p.INV_CODIGO);
              $("#nomxa").val(p.INV_NOMBRE); 
              $("#artxa").val('INVENTARIO');
              $("#colxa").val(p.INV_LOTE);
              $("#anchoxa").val(p.INV_UBICA); 
              $("#altoxa").val(p.INV_ALTO);
              $("#espxa").val(p.INV_LARGO);
              if(p.INV_IVA==true){
                   $("#iva_xa").val('true'); 
              }else{
                   $("#iva_xa").val('false'); 
              }
             
              $("#poriva_xa").val(p.INV_EQUIVA);
              $("#pesxa").val(p.INV_PESO);
              $("#stc_max").val(p.INV_STCMAX); 
              $("#stc_min").val(p.INV_STCMIN);
              $("#stc_seg").val(p.INV_STCMIN); 
              $("#cospa").val(p.INV_VALCOM);
              $("#obsxa").val(p.INV_CODOPE);  
              $("#cla_xa").val(p.INV_CLASE);  
              $("#gru_xa").val(p.INV_GRUPO);  
         
//              $("#poriva_xa").val(p.INV_BASIVA); 
              //$("#iva_xa").val(p.INV_IVA); 
             
          }
      }).fail( function( jqXHR, textStatus, errorThrown ) {
             alert( 'Este codigo no esta registrado en fom plus\n Comuniquese con el area de inventario para crear el producto' );
//           $("#est"+ced).html('');
             return false;
        });
  }