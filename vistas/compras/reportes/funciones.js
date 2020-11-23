
$(function () {
    mostrar_FEC(1);
    $('#n_sol').change(function(){
        mostrar_FEC(1);
      });
     $('#n_cod').change(function(){
        mostrar_FEC(1);
      }); 
       $('#n_pro').change(function(){
        mostrar_FEC(1);
      });
     $('#n_des').change(function(){
        mostrar_FEC(1);
      }); 
         $('#n_fech').change(function(){
        mostrar_FEC(1);
      }); 
      $('#n_obs').change(function(){
        mostrar_FEC(1);
      });
});

function mostrar_FEC(page) {
    var n_sol = $("#n_sol").val();
    var cod = $("#n_cod").val();
    var des = $("#n_des").val();
     var pro = $("#n_pro").val();
     var n_fech = $("#n_fech").val();
     var n_obs = $("#n_obs").val();
    $.ajax({
        type: 'GET',
        data: 'sol='+n_sol+'&cod='+cod+'&des='+des+'&pro='+pro+'&n_fech='+n_fech+'&n_obs='+n_obs+'&page='+page,
        url: '../vistas/compras/reportes/lista_sols.php',
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
        url: '../vistas/compras/reportes/conversion.php',
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

function printer(){
    var n_sol = $("#n_sol").val();
    var cod = $("#n_cod").val();
    var des = $("#n_des").val();
    var pro = $("#n_pro").val();
    var n_fech = $("#n_fech").val();  
    var n_obs = $("#n_obs").val();
    window.open('../vistas/compras/reportes/print_rep.php?sol='+n_sol+'&cod='+cod+'&des='+des+'&pro='+pro+'&n_fech='+n_fech+'&n_obs='+n_obs,'_blank');
}