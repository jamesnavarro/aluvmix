
$(function () {
    mostrar_FEC(1);

    $('#n_sol').change(function(){
        mostrar_FEC(1);
      });
     $('#area_s').change(function(){
        mostrar_FEC(1);
      }); 
       $('#fec_s').change(function(){
        mostrar_FEC(1);
      });
     $('#usu_s').change(function(){
        mostrar_FEC(1);
      }); 
      $('#est').change(function(){
        mostrar_FEC(1);
      }); 
      //estord
      $('#estord').change(function(){
        mostrar_FEC(1);
      });
       $('#n_are').change(function(){
        mostrar_FEC(1);
      });
     
       $('#n_des').change(function(){
        mostrar_FEC(1);
      });
});

function mostrar_FEC(page) {
    var n_sol = $("#n_sol").val();
    var area_s = $("#n_are").val();
    var des = $("#n_des").val();
    $.ajax({
        type: 'GET',
        data: 'sol='+n_sol+'&area='+area_s+'&desc='+des+'&page='+page,
        url: '../vistas/compras/gestion_time/lista_sols.php',
        success: function (d) {
            $("#mostrar_tabla2").html(d);
            if (d == 'error') {
                location.href = '../index.php';
            }
        }
    });
}
 function cargadatos(id) {
    $('.modal-backdrop').remove();
    $('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    $.ajax({
        type: 'GET',
        url: '../vistas/compras/gestion_time/conversion.php',
        success: function (data) {
            $('#encabezado').html('Lista de productos');
            $('#controlador').html(data);
            $('#cargar').html('');
            
            $('#solicitd').val(id);
            configbutton(id);
            Updaprobar(id);
            mostrar_tabl2(id);
        }
    });
    }

