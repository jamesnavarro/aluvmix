$(function(){
     mostrar(1); 
     
});
function mostrar(page){
    var nombre = $("#nombre").val();
        var par = $("#parametro").val();
    var ref = $("#ref").val();
        $.ajax({
            type: 'GET',
            data: 'page='+page+'&ref='+ref+'&par='+par+'&nombre='+nombre,
            url: 'listado.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
                 console.log(nombre);
            }
         }); 
} 
function pasar_variable(nombre){
    window.opener.obtener_refe(nombre);
    window.close();
}
function addref(){
    var par = $("#modulo").val();
    var ref = $("#referencia").val();
    var des = $("#descuento").val();
    if(par==''){
        alert("Seleccione el modulo");
        $("#modulo").focus();
        return false;
    }
    if(ref==''){
        alert("Seleccione el referencia");
        $("#referencia").focus();
        return false;
    }
    if(des==''){
        alert("Seleccione el descuento");
        $("#descuento").focus();
        return false;
    }
    $.ajax({
        type:'GET',
        data:'par='+par+'&ref='+ref+'&des='+des,
        url:'acciones.php',
        success : function(res){
            alert(res);
            mostrar(1); 
            $("#modulo").val('');
            $("#referencia").val('');
            $("#descuento").val('');
        }
    });
}
function limpiar_cajas(){
    $("#ids").val('');
    $("#sistema").val('');
}
function subir(id, nom){
    $("#ids").val(id);
    $("#sistema").val(nom);
}
function delref(id){
    var c = confirm("Esta seguro de eliminar este items?");
    if(c){
     $.ajax({
        type:'GET',
        data:'id='+id,
        url:'borrar.php',
        success : function(res){
            alert("Se elimino con exito");
            mostrar(1); 
            $("#modulo").val('');
            $("#referencia").val('');
            $("#descuento").val('');
        }
    });
    }
}
function addsistema(ref){
    $("#idref").val(ref);
    mostrar_sistemas(ref);
}
function mostrar_sistemas(ref){

        $.ajax({
            type: 'GET',
            data: 'ref='+ref,
            url: 'listado_sistema.php',
            success: function(resultado){
                 $("#mostrar_sistemas").html(resultado);
                 
            }
         }); 
} 
function add_sistema(){
    var id = $("#idref").val();
    var sis = $("#sis").val();
    
    $.ajax({
            type: 'GET',
            data: 'id='+id+'&sis='+sis,
            url: 'add_sistema.php',
            success: function(resultado){
                 alert(resultado);
                 mostrar_sistemas(id);
    
                 $("#sis").val('');
            }
         });
    
}
function delrefsis(id){
     var c = confirm("Esta seguro de eliminar este items?");
      var ref = $("#idref").val();
    if(c){
     $.ajax({
        type:'GET',
        data:'id='+id,
        url:'borrar_sis.php',
        success : function(res){
            alert("Se elimino con exito");
           mostrar_sistemas(ref);
           
        }
    });
    }
}
function abrir(){
    window.open('../../../presupuestos/popup/cuentas/?linea=Aluminio','referencias','width=600px , height=500px');
}
function enviar_referencia(r,d){
    $("#referencia").val(r);
}
