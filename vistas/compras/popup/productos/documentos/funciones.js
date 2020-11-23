//----------------------------------- Modulo de Almacenes---------------------------
$(function() {
MostrarUsuarios2(1);
     // 4- Buscar en la tabla
        $('#buscar_empleado').change(function(){
		
		MostrarUsuarios2(1);
	});
});

function MostrarUsuarios2(page){
    var nombre = $('#buscar_empleado').val();
		$.ajax({
				type: 'GET',
				data: 'page='+page+'&nombre='+nombre,
				url: '../productos/documentos/mostrar_tabla.php',
				success: function(data){
						$('#usuarios').html(data);
						
				}
			});
		return false;
}
function bus_cod_fom(cod){
   
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
              $("#anchoxa").val(p.INV_ANCHO); 
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

