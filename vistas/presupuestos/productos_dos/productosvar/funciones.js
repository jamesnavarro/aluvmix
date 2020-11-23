$(function(){
     mostrar(1); 
});
function mostrar(page){
    var nombre = $("#nombrex").val();
        var par = $("#parametro").val();
    var ref = $("#codigo").val();
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
function pre_addparametro(cod,sel){
    var par = $("#parametro").val();
    var ref = $("#codigo").val();
    var can = $("#can"+cod).val();
     console.log(can);
    $.ajax({
        type:'GET',
        data:'cod='+cod+'&par='+par+'&ref='+ref+'&can='+can+'&sel='+sel,
        url:'acciones.php',
        success : function(res){
            alert(res);
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


