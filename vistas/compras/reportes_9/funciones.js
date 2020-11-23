
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
        $('#h_fech').change(function(){
        mostrar_FEC(1);
      }); 
      $('#n_obs').change(function(){
        mostrar_FEC(1);
      });
      $('#n_fac').change(function(){
        mostrar_FEC(1);
      });
       $('#pen').change(function(){
        mostrar_FEC(1);
      });
});

function mostrar_FEC(page) {
    var n_sol = $("#n_sol").val();
    var cod = $("#n_cod").val();
    var des = $("#n_des").val();
     var pro = $("#n_pro").val();
     var n_fech = $("#n_fech").val();
     var h_fech = $("#h_fech").val();
     var n_obs = $("#n_obs").val();
     var pen = $("#pen").val();
      var fac = $("#n_fac").val();
    $.ajax({
        type: 'GET',
        data: 'sol='+n_sol+'&cod='+cod+'&des='+des+'&pro='+pro+'&n_fech='+n_fech+'&h_fech='+h_fech+'&n_obs='+n_obs+'&pen='+pen+'&fac='+fac+'&page='+page,
        url: '../vistas/compras/reportes_9/lista_sols.php',
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
        url: '../vistas/compras/reportes_9/conversion.php',
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
    var h_fech = $("#h_fech").val();
     var n_obs = $("#n_obs").val();
     var pen = $("#pen").val();
     var fac = $("#n_fac").val();
    window.open('../vistas/compras/reportes_9/print_rep.php?sol='+n_sol+'&cod='+cod+'&des='+des+'&pro='+pro+'&n_fech='+n_fech+'&h_fech='+h_fech+'&n_obs='+n_obs+'&fac='+fac+'&pen='+pen,'_blank');
}
function recibir(id,ped){
    $("#iddet").val(id);
    $("#pedi").val(ped);
    $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',
        url: '../vistas/compras/reportes_9/acciones.php',
        success: function (data) {
            var p = eval(data);
             $("#fac").val(p[0]);
             $("#obs").val(p[1]);
             $("#frec").val(p[2]);
        }
    });
    
}
function recibiradd(){
    var id = $("#iddet").val();
    var fac = $("#fac").val();
    var obs = $("#obs").val();
    var frec = $("#frec").val();
    var rec = $("#rec").val();
     var ped = $("#pedi").val();
    $.ajax({
        type: 'GET',
        data: 'id='+id+'&fac='+fac+'&obs='+obs+'&frec='+frec+'&rec='+rec+'&ped='+ped+'&sw=1',
        url: '../vistas/compras/reportes_9/acciones.php',
        success: function (data) {
            alert(data);
        }
    });
    
}