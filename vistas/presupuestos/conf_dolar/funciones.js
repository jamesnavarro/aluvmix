 
$(function(){
     $("#mostrar_tabla").html(mostrar_doll(1)); 
   
      $("#val_doll").change(function(){
          calcular_precio();
      });
      $("#val_doll").change(function(){
          calcular_precio();
      });
      $("#Vari_prima").change(function(){
          calcular_precio();
      });
 
});
 function calcular_precio(){
        var dolar = $("#prec_doll").val();
        var lma = $("#val_doll").val();
        var prima = $("#Vari_prima").val();
        var total = ((dolar * lma) + parseInt(prima)).toFixed(2);
        $("#pre_actu").val(total).attr("readonly", "readonly");
    }
function mostrar_doll(page){
    
        $.ajax({
            type: 'GET',
            data: 'page='+page,
            url: '../vistas/presupuestos/conf_dolar/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
  }); 
}
function guardar_doll(){ 
     var idl = $("#id_doll").val(); 
     var valdol = $("#val_doll").val();
     var precdol = $("#prec_doll").val();
     var varipri = $("#Vari_prima").val();
     var preact = $("#pre_actu").val();
     var fechactu = $("#fech_actual").val();
    if(valdol===''){
        sweetAlert("valor");
        $("#val_doll").focus();
        return false;
    }
     if(precdol===''){
        sweetAlert("precio");
        $("#prec_doll").focus();
        return false;
    }
     if(varipri===''){
        sweetAlert("variable prima");
        $("#Vari_prima").focus();
        return false;
    }
     if(preact===''){
        sweetAlert("pre_actu");
        $("#pre_actu").focus();
        return false;
    }
        $.ajax({
            type: 'GET',
            data: 'idll='+idl+'&valdoll='+valdol+'&precdoll='+precdol+'&varipril='+varipri+'&preactl='+preact+'&fechactul='+fechactu+'&sw=1',
            url: '../vistas/presupuestos/conf_dolar/acciones.php', 
            success: function(resultado){
                $("#id_doll").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_doll(1);
            }
           });
}

function limpiar_doll(){
   $("#id_doll").val(''); 
   $("#val_doll").val('');
   $("#prec_doll").val('');
   $("#Vari_prima").val('');
   $("#pre_actu").val('');
}

function nuevo(){
    limpiar_doll();
}

function editar(id){
    $("#marcar1").attr("class","");
    $("#marcar2").attr("class","active");
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/presupuestos/conf_dolar/acciones.php', //
        success: function(resultado){
  var p = eval(resultado);
   $("#id_doll").val(p[0]);
   $("#val_doll").val(p[1]);
   $("#prec_doll").val(p[2]);
   $("#Vari_prima").val(p[3]);
   $("#pre_actu").val(p[4]);
   $("#fech_actual").val(p[5]);
 }
 });
}

function borrar(id){
     var c = confirm("Esta seguro de eliminar esta referencia?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/presupuestos/conf_dolar/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_doll(1);
            }
           });
       }
}





