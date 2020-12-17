//----------------------------------- Modulo de Almacenes---------------------------
$(function() {
tabla_sucursales(1);
     // 4- Buscar en la tabla
        $('#buscar_empleado').change(function(){
		MostrarUsuarios2(1);
	});
});

function tabla_sucursales(page){
    var cod = $("#buscar_empleado").val();
    if(cod==''){
        cod='*';
    }else{
        cod=cod;
    }
    //alert(cod);
    $("#page").val(page);
    $("#mostrar_sucursales").html('<tr><td colspan="2">Cargando>>>>> </td>');
      $.ajax({
          type:'GET',
          url:'http://172.16.0.30:8989/api/MAELOTE/'+cod+'/'+page+'/50',
          dataType: 'json',
          success: function(da){

              render = "";
              $.each(da, function(i, item) {
                render+= showRow(i,item);
              });
              $('#mostrar_sucursales').html(render);
          }
        
      });
  }
  function showRow(i, dev){
 var p = "'"+dev.LOT_CODIGO+"'";
  var v = "'"+dev.LOT_NOMBRE+"'";
  var row = '<tr>'+
              '<td><a href="#" onclick="pasarsuc('+p+','+v+')">'+dev.LOT_CODIGO+'</a></td></tr>';
  return row;

}
function pasarsuc(cod){
    var id = $("#pos").val();
    window.opener.$("#col"+id).val(cod);
    window.opener.updateitemped(id);
    window.close();
}

