$(function(){
     $("#mostrar_tabla").html(mostrar_line(1));
     
    $('#cod').change(function(){
        mostrar_line(1);
      });
     $('#pue').change(function(){
        mostrar_line(1);
      }); 
        $('#est').change(function(){
        mostrar_line(1);
      }); 
     $('#lin').change(function(){
         mostrar_line(1);
     });
     $('#tra').change(function(){
         mostrar_line(1);
     });
     $('#tra').change(function(){
         mostrar_line(1);
     });
     $('#cc').change(function(){
         mostrar_line(1);
     });
     $('#cp').change(function(){
         mostrar_line(1);
     });
     $('#fcod').change(function(){
        inv_buscar_codigo();
      });
       $('#mano').change(function(){
        $("#por").focus();
      });
      $('#cedula').change(function(){
        buscar_empleado();
      });
      $('#por').change(function(){
        var por = $(this).val();
        var sal = $("#salario").val();
        var total = (por/100) * sal;
        $("#valor").val(total);
        $("#agregar").focus();
      });
 });  
 function inv_buscar_codigo(){
     var cod = $("#fcod").val();
      $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&sw=4',
                url: '../vistas/produccion/puestos/acciones.php',
         success: function(t) {
             var t = eval(t);
                $("#fcod").val(cod);
                $("#fdes").val(t[1]);
                $("#flin").val(t[2]); 
                $("#fest").val(t[3]);
                $("#fcc").val(t[4]);
                $("#ftra").val(t[5]);
                $("#fcp").val(t[6]);
                $("#fncc").val(t[7]);
                $("#fmo").val(t[8]);
                $("#fumb1").val(t[9]);
                $("#fmaq").val(t[10]);
                $("#fumb2").val(t[11]);
                $("#fcif").val(t[12]);
                $("#fumb3").val(t[13]);
                $("#fund").val(t[14]);
                $("#fpro").val(t[15]);
              $("#fumb4").val(t[16]);
                 $("#agua_p").val(t[17]);
     $("#luz_p").val(t[18]);
     $("#gas_p").val(t[19]);
     $("#int_p").val(t[20]);
         }
     
});
 }
 function buscar_empleado(){
     var ced = $("#cedula").val();
      $.ajax({
                type: 'GET',
                data: 'id='+ced+'&sw=2',
                url: '../../contabilidad/empleados/acciones.php',
         success: function(t) {
             var t = eval(t);
                $("#cedula").val(t[1]);
                $("#nombre").val(t[3]);
                $("#cargo").val(t[9]); 
                $("#salario").val(t[16]);  
                if(t[3]!==''){
                    $("#mano").focus();
                }else{
                    $("#cedula").focus();
                }
         }
     
});
 }
 
 
    function mostrar_line(page){
        var cod = $("#cod").val();
        var des = $("#pue").val();
         var lin = $("#lin").val();
        var tra = $("#tra").val();
        var cp = $("#cp").val();
        var cc = $("#cc").val();
         var est = $("#est").val();
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&des='+des+'&est='+est+'&lin='+lin+'&tra='+tra+'&cp='+cp+'&cc='+cc+'&page='+page,
                url: '../vistas/produccion/puestos/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
    function agregar_por_mo(){
        var cedula = $("#cedula").val();
        var nombre = $("#nombre").val();
        var cargo = $("#cargo").val();
        var mano = $("#mano").val();
        var cp = $("#cp").val();
        var por = $("#por").val();
        var salario = $("#salario").val();
        var valor = $("#valor").val();
        var puesto = $("#puesto").val();
        if(cedula==''){
            alert("Campo requerido");
            $("#cedula").focus();
            return false;
        }
        if(cedula==''){
            alert("Campo requerido");
            $("#cedula").focus();
            return false;
        }
        if(mano==''){
            alert("Campo requerido");
            $("#mano").focus();
            return false;
        }
        if(por==''){
            alert("Campo requerido");
            $("#por").focus();
            return false;
        }
         $.ajax({
                type: 'GET',
                data: 'cedula='+cedula+'&nombre='+nombre+'&cargo='+cargo+'&mano='+mano+'&cp='+cp+'&cp='+cp+'&por='+por+'&salario='+salario+'&valor='+valor+'&puesto='+puesto+'&sw=9',
                url: 'acciones.php',
            success: function(d){
                alert(d);
                mostrar_mo();
                limpiar_mo();
                $("#cedula").focus();
                

            }
        });
    }
    function limpiar_mo(){
        $("#cedula").val('');
        $("#nombre").val('');
        $("#cargo").val('');
        $("#mano").val('');
        $("#por").val('');
        $("#salario").val('');
        $("#valor").val('');

    }
   function guardar_lin(){
            var cod = $("#fcod").val();
            var des = $("#fdes").val();
            var lin = $("#flin").val();
            var est = $("#fest").val();
            var tra = $("#ftra").val();
            var cc = $("#fcc").val();
            var cp = $("#fcp").val();
            var mo =  $("#fmo").val();
            var umb1 =  $("#fumb1").val();
            var maq =  $("#fmaq").val();
            var umb2 =  $("#fumb2").val();
            var cif = $("#fcif").val();
            var umb3 =  $("#fumb3").val();
            var und =  $("#fund").val();
            var pro =  $("#fpro").val();
            var umb4 = $("#fumb4").val();
            
            var aguap =  $("#agua_p").val();
            var luzp =  $("#luz_p").val();
            var gasp =  $("#gas_p").val();
            var intp = $("#int_p").val();


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
            data: 'cod='+cod+'&des='+des+'&lin='+lin+'&est='+est+'&tra='+tra+'&cc='+cc+'&cp='+cp+'\
                 &mo='+mo+'&umb1='+umb1+'&maq='+maq+'&umb2='+umb2+'&cif='+cif+'&umb3='+umb3+'&und='+und+
                 '&pro='+pro+'&umb4='+umb4+'&aguap='+aguap+'&luzp='+luzp+'&gasp='+gasp+'&intp='+intp+'&sw=1',
            url: '../vistas/produccion/puestos/acciones.php', 
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
  $("#fcc").val('');
  $("#fncc").val('');
  $("#fcp").val('');

     $("#fmo").val('');
     $("#fumb1").val('');
     $("#fmaq").val('');
     $("#fumb2").val('');
     $("#fcif").val('');
     $("#fumb3").val('');
     $("#fund").val('');
     $("#fpro").val('');
     $("#fumb4").val('');
     
     $("#agua_p").val('');
     $("#luz_p").val('');
     $("#gas_p").val('');
     $("#int_p").val('');
}
function nuevo(){
    $("#lin2").modal("show");
    limpiar_lin();
}
function pasar_centro(cod,des){
    $("#fcc").val(cod);
     $("#fncc").val(des);
}
function editar_lin(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
    $("#marca3").attr("class","");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/produccion/puestos/acciones.php', //
            success: function(resultado){
    var t = eval(resultado);
     $("#fcod").val(t[0]);
     $("#fdes").val(t[1]);
     $("#flin").val(t[2]); 
     $("#fest").val(t[3]);
     $("#fcc").val(t[4]);
     $("#ftra").val(t[5]);
     $("#fcp").val(t[6]);
     $("#fncc").val(t[7]);
     $("#fmo").val(t[8]);
     $("#fumb1").val(t[9]);
     $("#fmaq").val(t[10]);
     $("#fumb2").val(t[11]);
     $("#fcif").val(t[12]);
     $("#fumb3").val(t[13]);
     $("#fund").val(t[14]);
     $("#fpro").val(t[15]);
     $("#fumb4").val(t[16]);
     $("#agua_p").val(t[17]);
     $("#luz_p").val(t[18]);
     $("#gas_p").val(t[19]);
     $("#int_p").val(t[20]);
 }
});
}
function pro_costoconf(){
     var id = $("#fcod").val();
    if(id==''){
        alert("Debes ingresar el puesto de trabajo");
        return false;
    }
    window.open("produccion/puestos/parametros_costos.php?id="+id+"","Parametros","width=800px , height=600px");
}
function pro_costomo(){
     var id = $("#fcod").val();
     var cp = $("#fcp").val();
    if(id==''){
        alert("Debes ingresar el puesto de trabajo");
        return false;
    }
    window.open("produccion/puestos/parametros_mo.php?id="+id+"&cp="+cp,"Parametros","width=800px , height=600px");
}
function pro_costocif(){
     var id = $("#fcod").val();
    if(id==''){
        alert("Debes ingresar el puesto de trabajo");
        return false;
    }
    window.open("produccion/puestos/parametros_cif.php?id="+id+"","Parametros","width=800px , height=600px");
}
function pro_costomaq(){
     var id = $("#fcod").val();
    if(id==''){
        alert("Debes ingresar el puesto de trabajo");
        return false;
    }
    window.open("produccion/puestos/parametros_maq.php?id="+id+"","Parametros","width=800px , height=600px");
}
 function pro_buscar_codigo(){
     var cod = $("#cedula").val();
      $.ajax({
        type: 'GET',
        data: 'cod='+cod+'&sw=4',
         url: '../../contabilidad/empleados/acciones.php',
         success: function(t) {
             console.log(t);
             var t = eval(t);
     $("#nombre").val(t[2]);
     $("#cargo").val(t[9]); 
     $("#sueldo").val(t[10]);
     if(t[3]){
         $("#por").focus();
     }

         }
     
});
 }
  function agregar_act(){
          var cos = $("#valor").val();
          var pue = $("#puesto").val();
          var act = $("#act").val();
          if(cos==''){
               $("#msg").html('<font color="red">Debes  de agregar un valor</font>').show(200).delay(2000).hide(200);
               $("#act").focus();
               return false;
          }
           $.ajax({
               type: 'GET',
               data: 'cod='+act+'&cos='+cos+'&pue='+pue+'&sw=6',
               url: 'acciones.php', //
                 success: function(t) {
                      console.log(t);
                      $("#msg").html('<font color="green">Se agrego con exito</font>').show(200).delay(2000).hide(200);
                      mostrar_actividad();
                      
                 }
     
});
 }
 function add_actividad(cod){
          var cos = $("#valor"+cod).val();
          var pue = $("#puesto").val();
          if(cos==''){
               $("#msg").html('<font color="red">Debes  de agregar un valor</font>').show(200).delay(2000).hide(200);
               $("#valor"+cod).focus();
               return false;
          }
           $.ajax({
               type: 'GET',
               data: 'cod='+cod+'&cos='+cos+'&pue='+pue+'&sw=6',
               url: 'acciones.php', //
                 success: function(t) {
                      console.log(t);
                      $("#msg").html('<font color="green">Se agrego con exito</font>').show(200).delay(2000).hide(200);
                      mostrar_actividad();
                      
                 }
     
});
 }
  function del_actividad(cod){
  
  var c = confirm("Esta seguro de eliminar este items?");
  if(c)
           $.ajax({
               type: 'GET',
               data: 'cod='+cod+'&sw=7',
               url: 'acciones.php', //
                 success: function(t) {
                      console.log(t);
                      $("#msg").html('<font color="green">Se elimino con exito</font>').show(200).delay(2000).hide(200);
                      mostrar_actividad();
                      
                 }
     
});
 }
 function del_mo(cod){
  
  var c = confirm("Esta seguro de eliminar este items?");
  if(c)
           $.ajax({
               type: 'GET',
               data: 'cod='+cod+'&sw=10',
               url: 'acciones.php', //
                 success: function(t) {
                      console.log(t);
                      $("#msg").html('<font color="green">Se elimino con exito</font>').show(200).delay(2000).hide(200);
                      mostrar_mo();
                      
                 }
     
});
 }
 function mostrar_actividad(){
      var pue = $("#puesto").val();
           $.ajax({
               type: 'GET',
               data: 'pue='+pue+'&sw=5',
               url: 'acciones.php', //
                 success: function(t) {
                      $("#mostrar_actividad").html(t);
                      var valor = $("#valort").val();
                      window.opener.$("#fund").val(valor);
                 }
     
});
 }
 function mostrar_mo(){
      var pue = $("#puesto").val();
           $.ajax({
               type: 'GET',
               data: 'pue='+pue+'&sw=8',
               url: 'acciones.php', //
                 success: function(t) {
                     
                      $("#mostrar_mo").html(t);
                      var valor = $("#valort").val();
                      window.opener.$("#fmo").val(valor);
                 }
     
});
 }
 function up_mo(id){
      var por = $("#por"+id).val();
      var sal = $("#salario"+id).val();
           $.ajax({
               type: 'GET',
               data: 'por='+por+'&id='+id+'&sal='+sal+'&sw=11',
               url: 'acciones.php', //
                 success: function(t) {      
                      mostrar_mo();
                      
                 }
     
});
 }
function usuario(){
    window.open("../../../popup/empleados/index.php" ,"USUARIOS", " width=900 , height=500 ");
}
function pasar_usuario(cod,des){
    $("#fcc").val(cod);
     $("#fncc").val(des);
}

 function mostrar_cif(id){
      
           $.ajax({
               type: 'GET',
               data: 'id='+id+'&sw=12',
               url: 'acciones.php', //
               success: function(t) {      
                      $("#mostrar_cif").html(t);
                      
                 }
     
});
 }
 
 
 
 
 
 
 
  function mostrar_maq(id){
      
           $.ajax({
               type: 'GET',
               data: 'id='+id+'&sw=13',
               url: 'acciones.php', //
               success: function(t) {      
                      $("#mostrar_maq").html(t);
                      
                 }
     
});
 }

 function verprecio(id,des){
      $("#titulomodal").html(des);
      $("#idarea").val(id);
      mostrarprecio(id);
 }
 function mostrarprecio(id){
           $.ajax({
               type: 'GET',
               data: 'id='+id+'&sw=14',
               url: '../vistas/produccion/puestos/acciones.php', //
               success: function(t) {      
                      $("#mostrar_precio").html(t);
                      
                 }
        });
 }
 function addprecio(){
            var id = $("#idpue").val();
            var idarea = $("#idarea").val();

        if (id===''){ 
            alert('debes de seleccionar el puesto');
            $("#idpue").focus();
            return false;
        }

    $.ajax({
            type: 'GET',
            data: 'id='+id+'&idarea='+idarea+'&sw=15',
            url: '../vistas/produccion/puestos/acciones.php', 
            success: function(resultado){
            
               alert(resultado);
              mostrarprecio(idarea);
               $("#idpue").val('');

            }
           });
}
 function delprecio(id){
      var idarea = $("#idarea").val();
           $.ajax({
               type: 'GET',
               data: 'id='+id+'&sw=16',
               url: '../vistas/produccion/puestos/acciones.php', //
               success: function(t) {      
                      alert(t);
                       mostrarprecio(idarea);
                 }
        });
 }
 