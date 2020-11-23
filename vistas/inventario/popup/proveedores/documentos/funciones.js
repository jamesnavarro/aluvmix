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
				url: '../proveedores/documentos/mostrar_tabla.php',
				success: function(data){
						$('#usuarios').html(data);
						
				}
			});
		return false;
}
function verificar(){
    var ced = $('#buscar_empleado').val();
    $.ajax({
          type:'GET',
          url:'http://172.16.0.30:8989/api/MAECXP/'+ced,
          contentType: 'application/json',
          success: function(da){
            
             var p = eval(da);
              console.log('Resultado: '+p.CLI_NOMBRE);
             $('#resultado').val(p.CLI_NOMBRE);
          }
      });
}

function pasar(cod,nom){

   $.ajax({
          type:'GET',
          url:'http://172.16.0.30:8989/api/MAECXP/'+cod,
          contentType: 'application/json',
          success: function(da){
             var p = eval(da);
             var est = da.CLI_ACTIVO;
             var act = da.CLI_CODICA;
             if(est=='1'){
                 alert('¡Este tercero se encuentra inactivo!');
                 return false;
             }
             window.opener.document.getElementById("nombrepro").value=cod;
             window.opener.document.getElementById("nterc").value=nom;
             console.log('tp: '+da.CLI_TIPCTA);
             var n;var i;
             if(da.CLI_CONRET==true){
                 n = 1;
             }else{
                 n = 0;
             }
             if(da.CLI_CONICA==true){
                 i = 1;
             }else{
                 i = 0;
             }
             window.opener.document.getElementById("sret").value=n;
             window.opener.document.getElementById("sica").value=i;
             window.opener.document.getElementById("sact").value=act;
             window.opener.document.getElementById("codcue").value=da.CLI_TIPCTA;
             //alert(da.CLI_TIPCTA);
             buscartipocuenta(da.CLI_TIPCTA);
             
          }
        }).fail( function( jqXHR, textStatus, errorThrown ) {
             alert( 'Cliente no encontrado en fomplus' );
//           $("#est"+ced).html('');
             return false;
        });
   
}
function buscartipocuenta(cod){
    $.ajax({
                type: 'GET',
                data: 'cod='+cod,
                url: '../proveedores/documentos/buscartp.php',
                success: function(data){
                    var p = eval(data);
                    //alert(data);
                    window.opener.document.getElementById("siva").value=p[0];
                     
                    window.close();
                }
        });
}
