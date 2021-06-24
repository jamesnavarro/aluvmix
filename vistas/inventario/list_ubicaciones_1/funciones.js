 $(function(){
     mostrar_ubicedit(1);
     
    $('#codigo').change(function(){
        mostrar_ubicedit(1);
      });
     $('#ubi_b').change(function(){
        mostrar_ubicedit(1);
      });
       $('#color_b').change(function(){
        mostrar_ubicedit(1);
      });
       $('#med_b').change(function(){
        mostrar_ubicedit(1);
      }); 
       $('#bod_bn').change(function(){
        mostrar_ubicedit(1);
      });
      $('#fec_b').change(function(){
        mostrar_ubicedit(1);
      });
      $('#stock').change(function(){
        mostrar_ubicedit(1);
      });
    
 });  
 
    function mostrar_ubicedit(page){
        var codigo = $("#codigo").val();
         var ubi_b = $("#ubi_b").val();
          var color_b = $("#color_b").val();
           var med_b = $("#med_b").val();
            var bod_bn = $("#bod_bn").val();
             var sto = $("#stock").val();
             var fec = $("#fec_b").val();
        $.ajax({
                type:'GET',
                 data: 'cod='+codigo+'&ubi_b='+ubi_b+'&color_b='+color_b+'&med_b='+med_b+'&bod_bn='+bod_bn+'&sto='+sto+'&fec='+fec+'&page='+page,
                url: '../vistas/inventario/list_ubicaciones_1/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
    function traslado(idi){
        $.ajax({
                type:'GET',
                 data: 'id='+idi+'&sw=1',
                url: '../vistas/inventario/list_ubicaciones_1/acciones.php',
            success: function(d){
                var p = eval(d);
                $("#upid").val(idi);
                $("#upcod").val(p[0]);
                $("#upcol").val(p[4]);
                $("#upmed").val(p[5]);
                $("#upubi").val(p[1]);
                $("#upcan").val(p[2]);
                $("#upbod").val(p[3]);
                $("#decan").val(p[2]);
            }
        });
        
    }
    function valcan(){
        var ca1 = $("#upcan").val();
        var ca2 = $("#decan").val();
        if(ca2==''){
            alert("Debe de digitar la cantidad a trasladar");
            $("#decan").focus();
            return false;
        }else if(ca2>ca1){
            alert("La cantidad digitada supera al stock");
            $("#decan").val('');
            $("#decan").focus();
            return false;
        }
    }
  function buscarubi() {
    var sede = 'GALAPA';
    var id = $("#upid").val();
    window.open("../vistas/inventario/movimientos/ubicaciones_beta.php?sede="+sede+"&id="+id, "Ubicaciones", "width=1600px , height=600px");
}
function pasar_ubicacion(ref,id){
    $("#deubi").val(ref);
}
  function trasladarubi(){
      var c = confirm("Estas seguro de hacer este traslado?");
              var id = $("#upid").val();
              var cod =  $("#upcod").val();
              var col =  $("#upcol").val();
              var med = $("#upmed").val();
              var oubi = $("#upubi").val();
              var ocan = $("#upcan").val();
              var bod = $("#upbod").val();
              var dcan = $("#decan").val();
              var dubi = $("#deubi").val();
              if(c){
        $.ajax({
                type:'GET',
                 data: 'id='+id+'&cod='+cod+'&col='+col+'&med='+med+'&oubi='+oubi+'&ocan='+ocan+'&bod='+bod+'&dcan='+dcan+'&dubi='+dubi+'&sw=2',
                url: '../vistas/inventario/list_ubicaciones_1/acciones.php',
            success: function(d){
                alert(d);
                $("#ModalCambiar").modal('hide');
                mostrar_ubicedit(1);
                
            }
        });
              }
        
    }
    function verlist(idi){
        $.ajax({
                type:'GET',
                 data: 'id='+idi+'&sw=3',
                url: '../vistas/inventario/list_ubicaciones_1/acciones.php',
            success: function(d){
                $("#mostrar_movubi").html(d);
            }
        });
        
    }
    function crear(idu,cod,col,med,bod,can,ubi){
        $("#act_idu").val(idu);
        $("#act_cod").val(cod);
        $("#act_col").val(col);
        $("#act_med").val(med);
        $("#act_bod").val(bod);
        $("#can_actual").val(can);
        $("#act_ubi").val(ubi);
    }
    function generar(){
        var idu = $("#act_idu").val();
        var cod = $("#act_cod").val();
        var col = $("#act_col").val();
        var med = $("#act_med").val();
        var bod = $("#act_bod").val();
        var sto = $("#can_actual").val();
        var ubi = $("#act_ubi").val();
       var can = $("#can_act").val();
       var tipo = $("#act_tipo").val();
       if(tipo==''){
           alert('Debes de seleccionar el tipo de movimientos');
           $("#act_tipo").focus();
              return false;
       }
       if(can=='' || can==0){
           alert('Debes de digitar un valor valido');
           $("#can_act").focus();
              return false;
       }
       if(tipo=='SALIDA'){
           if(parseInt(can)>parseInt(sto)){
              alert('La cantidad digitada es mayor a la cantidad actual');
              $("#can_act").val('');
              $("#can_act").focus();
              return false;
           }
       }
       $.ajax({
                type:'GET',
                 data: 'idu='+idu+'&cod='+cod+'&col='+col+'&med='+med+'&bod='+bod+'&sto='+sto+'&ubi='+ubi+'&can='+can+'&tipo='+tipo+'&sw=5',
                url: '../vistas/inventario/list_ubicaciones_1/acciones.php',
            success: function(d){
                $("#can_act").val('');
                $("#act_tipo").val('');
                alert(d);
                mostrar_ubicedit(1);
                 $("#ModalCrear").modal('hide');
            }
        });
       
    }
    function editaru(bod,cod,col,med,ubi,can){
        var c = confirm("Estas seguro de editar las cantidades segun el saldo?");
        if(c)
       $.ajax({
                type:'GET',
                 data: 'bod='+bod+'&cod='+cod+'&col='+col+'&med='+med+'&ubi='+ubi+'&can='+can+'&sw=4',
                url: '../vistas/inventario/list_ubicaciones_1/acciones.php',
            success: function(d){
                alert(d);
                 mostrar_ubicedit($("#page").val());
            }
        }); 
    }
    function bus_cod_fom(){
    var cod = $("#upcod").val();
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
              $("#upcol").val(p.INV_LOTE);
              $("#upmed").val(p.INV_UBICA);  
              consultarstock();
          }
      }).fail( function( jqXHR, textStatus, errorThrown ) {
             alert( 'Este codigo no esta registrado en fom plus\n Comuniquese con el area de inventario para crear el producto' );
//           $("#est"+ced).html('');
             return false;
        });
  }
  function consultarstock(){
    var cod = $("#upcod").val();
    var col = $("#upcol").val();
    var bod = $("#upbod").val();
    var med = $("#upmed").val();

      $.ajax({
          type:'GET',
          //data: JSON.stringify(datos),
          url:'http://172.16.0.30:8989/api/Inventarios/GetSaldoRefLoteUbica/'+bod+'/'+cod+'/'+col+'/'+med+'',
          contentType: 'application/json',
          success: function(da){
             var p = eval(da);
              $("#stoact").val(p.CanAct);       
          }
      }).fail( function( jqXHR, textStatus, errorThrown ) {
             alert( 'Este codigo no esta registrado en fom plus\n Comuniquese con el area de inventario para crear el producto' );
//           $("#est"+ced).html('');
             return false;
        });
  }