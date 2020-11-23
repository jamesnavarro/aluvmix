
$(function () {
    $("#mostrar_tabla2").html(mostrar_cot(1));

    $('#n_sol').change(function(){
        mostrar_cot(1);
      });
     $('#area_s').change(function(){
        mostrar_cot(1);
      }); 
       $('#fec_s').change(function(){
        mostrar_cot(1);
      });
     $('#usu_s').change(function(){
        mostrar_cot(1);
      }); 
      $('#est').change(function(){
        mostrar_cot(1);
      }); 
      //estord
      $('#estord').change(function(){
        mostrar_cot(1);
      });
});

function mostrar_cot(page) {
    var n_sol = $("#n_sol").val();
    var area_s = $("#area_s").val();
    var fec_s = $("#fec_s").val();
    var usu_s = $("#usu_s").val();
     var est = $("#est").val();
      var ord = $("#estord").val();
    $.ajax({
        type: 'GET',
        data: 'n_sol='+n_sol+'&area_s='+area_s+'&fec_s='+fec_s+'&usu_s='+usu_s+'&est='+est+'&ord='+ord+'&page='+page,
        url: '../vistas/compras/cotizaciones/lista_sols.php',
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
        url: '../vistas/compras/cotizaciones/conversion.php',
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

