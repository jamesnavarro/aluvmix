$(function(){
     mostrar(1); 
});
function mostrar(page){
    var nombre = $("#nombrex").val();
        $.ajax({
            type: 'GET',
            data: 'page='+page+'&nombre='+nombre,
            url: 'listado.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
                 console.log(nombre);
            }
         }); 
}
function pasar_variable(nombre){
    window.opener.obtener_espesor(nombre);
    window.close();
}
function add_sistema(){
    var id = $("#ids").val();
    var sis = $("#sistema").val();
    if(sis===''){
        alert("Debes de llenar este campo");
        $("#sistema").focus();
        return false;
    }
    $.ajax({
        type:'GET',
        data:'id='+id+'&sis='+sis,
        url:'acciones.php',
        success : function(res){
            alert(res);
            mostrar(1);
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


