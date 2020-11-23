//----------------------------------- Modulo de Almacenes---------------------------
$(function() {
tabla_sucursales(1);
     // 4- Buscar en la tabla
        $('#buscar_empleado').change(function(){
		MostrarUsuarios2(1);
	});
});

function tabla_sucursales(page){
    var cod = window.opener.$("#nombrepro").val();
    if(cod==''){
        cod='*';
    }else{
        cod=cod;
    }
    //alert(cod);
    $("#page").val(page);
    $("#mostrar_sucursales").html('<tr><td colspan="2">Cargando '+cod+'<img src="../../../images/load.gif"></td>');
      $.ajax({
          type:'GET',
          url:'http://172.16.0.30:8989/api/CONTACTOCXC/'+cod+'/'+page+'/50',
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
 var p = "'"+dev.CON_CEDULA+"'";
  var row = '<tr>'+
              '<td>'+dev.CON_CEDULA+'</td><td>'+dev.CON_CODIGO+'</td>\n\
               <td><a href="#" onclick="pasarsuc('+p+')">'+dev.CON_NOMBRE+'</a></td></tr>';
  return row;

}
function pasarsuc(cod){
    window.opener.$("#sucursal").val(cod);
    window.close();
}

