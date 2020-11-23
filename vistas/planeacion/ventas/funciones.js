var idglobal;
var idcompuesto;
var linea;
var cotizacion;
$(function() {

        $("#doc").keyup(function () {
            buscar_ced();			
            });
        $("#proa").change(function () {
           mostrar_ajustes(1);           
        });
        $("#espa").change(function () {
           mostrar_ajustes(1);           
        });
        $("#v_color").change(function () {
            var m = $("#v_med").val();
            if(m==='1'){
              $("#v_med_real").val(1);
              $("#v_can").focus();
            }else{
              $("#v_med_real").focus();
            }
        });
        $("#v_med_real").change(function () {
           $("#v_can").focus();    
        }); 
        $("#v_can").change(function () {
            $("#v_por").attr("disabled", false); 
            $("#v_por").focus();
            calcular_perfil();
        });
        $("#v_por").change(function () {
            $("#btn_ven").attr("disabled", false).focus();
            var max = $("#v_max").val();
            var por = $("#v_por").val();
            if(parseInt(por) < parseInt(max)){
            alert("El descuento permitido para este articulo es de "+max+" % ");
            $("#v_por").val('').focus();
            return false;

            }
            calcular_perfil();
        });
        //2. buscar codigo del producto

        //ventana emergente de ciudades x municipio
        $("#ciu").click(function () {
            var ciu = $("#ciu").val();
            var dep = $("#dep").val();
            if(dep===''){
              alert("Debe escojer el departamento");
              $("#dep").focus();
              return false;
            }
            window.open("../popup/municipios/?muni="+dep,"terceros","width=600,height=600");
        });
        //saltos de casilla de texto
        $("#ancho").change(function () {
            $("#alto").focus();

        });
        $("#ser").change(function () {
        $("#alto").focus();
        var ser = $("#ser").val();
        var cot = $("#idcot").val();
        var max = $("#max").val();
        if(ser==='0'){
        var t = max * (-1);
        if(t > 40){
           $("#desc").val(max);
        }else{
           $("#desc").val('');
        }
        $("#desc").attr("disabled", false);
        }else{
        $("#desc").val('0');
        $("#desc").attr("disabled", true);
        }
        if(cot!==''){
        mostrar_items(cot);
        }

        });
        $("#doc").change(function () {
            var idc = $("#idc").val();
            if(idc!==''){
                $("#continuar").attr("disabled", false);
            }else{
                $("#continuar").attr("disabled", true);
            }
        });
        $("#alto").change(function () {
            $("#cantidad").focus(); 
        });
        $("#cantidad").change(function () {
             var per = $("#per").val();
            if(per=='Si'){
               $("#perforacion").focus();
            }else{
               $("#ubicacion").focus();
            }
        });
        $("#ubicacion").change(function () {
            $("#observacion").focus(); 
        });
        $("#observacion").change(function () {
            $("#laminas").focus(); 
        });
        $("#perforacion").change(function () {
            var per = $("#boquetes").val();
            if(per=='Si'){
               $("#boquetes").focus();
            }else{
               $("#laminas").focus();
            }
        });
        $("#boquetes").change(function () {
            $("#laminas").focus();
        });
        $("#ubicacion").change(function () {
            $("#observacion").focus();
        });
  
        $("#cod").change(function () {
            var idp = $("#idp").val();
            if(idp!==''){
              $("#vid").focus();
            }
        });
        $("#desc").change(function () {
        var desc = $("#desc").val();
        var piva = $("#pivaOut").val();
        var max = $("#max").val();
        var ser = $("#ser").val();
        if(ser==='0'){
        if( parseInt(desc) < parseInt(max) ){
        alert("Supera el descuento maximo autorizado para el cliente. ");
        $("#desc").val('0');
        return false;
        }
        }
        cot();
        });
        $("#espesor").change(function () {
            ajuste_referencias();
        });
        $("#ajuste").change(function () {
        var a = $("#precio").val();
        var b = $("#ajuste").val();
        var c = parseInt(a) + parseInt(b);
        $("#unidad").val(c);
        });
        $("#unidad").change(function () {
        var a = $("#precio").val();
        var b = $("#unidad").val();
        var c = parseInt(b) - parseInt(a);
        $("#ajuste").val(c);
        });
        $("#laminas").change(function () {
              var c = confirm("Desea seguir con la cotizacion del item?");
              if(c){ 
                  save_item();
                  $("#ubicacion").focus();  
              }
        });
        $("#instalacion").change(function () {
           insumos();
        });
        
        $("#pelicula").change(function () {
             var pel = $("#pelicula").val();
             var und = $("#und_peli").val();
             var mt = $("#mtc_peli").val();
             var desp = $("#desperdicio_acc").val();
             if(pel=='Una Cara'){
                 tope = und * mt;
                 $('#result_tr').show('show');
             }else if(pel=='Dos Cara'){
                 tope = und * mt * 2;
                 $('#result_tr').show('show');
             }else{
                 tope = 0;
                 $('#result_tr').hide('hide');
             }
              var porcentaje = (100 - desp)/100;
              tope = tope;
               dtope = tope / porcentaje;
             $("#tot_peli").val(tope.toFixed(2));
             $("#tot_peli_desp").val(dtope.toFixed(2));
             totalizar();
        });

});
function laminas_items(){
    var lam = $("#laminas").val();
    var cod = $("#codigo0").val();
    var des = $("#descripcion0").val();
    var ancho = $("#ancho").val();
    var alto = $("#alto").val();
    var cant = $("#cantidad").val();
    var per = $("#perforacion").val();
    var boq = $("#boquetes").val();
    var lamx = $("#lam").val();
    var pelicula = $("#pelicula").val();
    var inter = $("#interlayer").val();
    var espa = $("#espaciadores").val();
    var desp = $("#desperdicio").val();
    var despalu = $("#desperdicio_al").val();
    var despacc = $("#desperdicio_acc").val();
    var despesp = $("#desperdicio_esp").val();
    var despint = $("#desperdicio_int").val();
    var inst = $("#instalacion").val();
    var est = $("#estado").val();
    var item = $("#item").val();
    if(cod==''){
        alert("Debes de seleccionar el items principal");
         $("#codigo").val('').focus();
        return false;
    }
    if(ancho==''){
        alert("Debes de digitar el ancho");
         $("#ancho").val('').focus();
        return false;
    }
    if(alto==''){
        alert("Debes de sdigitar el alto");
         $("#alto").val('').focus();
        return false;
    }
    if(parseInt(lam)>parseInt(lamx)){
        alert("El maximo de laminas permitidos son "+lamx);
        $("#laminas").val('').focus();
        return false;
    }
    $.ajax({
        type:'GET',
        data:'lam='+lam+'&cod='+cod+'&est='+est+'&item='+item+'&inst='+inst+'&despesp='+despesp+'&despint='+despint+'&desp='+desp+'&despalu='+despalu+'&despacc='+despacc+'&inter='+inter+'&espa='+espa+'&des='+des+'&ancho='+ancho+'&alto='+alto+'&cant='+cant+'&per='+per+'&boq='+boq+'&pelicula='+pelicula,
        url:'laminas.php',
                    success : function(t){
                        $("#formlaminas").html(t);
                        $("#costos").html('');
                        insumos();
                       
                    }
    });
}
function insumos(){
         var lam = $("#laminas").val();
    var cod = $("#codigo0").val();
    var des = $("#descripcion0").val();
    var ancho = $("#ancho").val();
    var alto = $("#alto").val();
    var cant = $("#cantidad").val();
    var per = $("#perforacion").val();
    var boq = $("#boquetes").val();
    var lamx = $("#lam").val();
    var pelicula = $("#pelicula").val();
    var inter = $("#interlayer").val();
    var espa = $("#espaciadores").val();
    var desp = $("#desperdicio").val();
    var despalu = $("#desperdicio_al").val();
    var despacc = $("#desperdicio_acc").val();
    var inst = $("#instalacion").val();
    if(cod==''){
        alert("Debes de seleccionar el items principal");
         $("#codigo").val('').focus();
        return false;
    }
    if(ancho==''){
        alert("Debes de digitar el ancho");
         $("#ancho").val('').focus();
        return false;
    }
    if(alto==''){
        alert("Debes de sdigitar el alto");
         $("#alto").val('').focus();
        return false;
    }
    if(parseInt(lam)>parseInt(lamx)){
        alert("El maximo de laminas permitidos son "+lamx);
        $("#laminas").val('').focus();
        return false;
    }
    $.ajax({
        type:'GET',
        data:'lam='+lam+'&cod='+cod+'&inst='+inst+'&desp='+desp+'&despalu='+despalu+'&despacc='+despacc+'&inter='+inter+'&espa='+espa+'&des='+des+'&ancho='+ancho+'&alto='+alto+'&cant='+cant+'&per='+per+'&boq='+boq+'&pelicula='+pelicula,
        url:'insumos.php',
                    success : function(t){
                        $("#forminsumos").html(t);
                         totalizar();
                    }
    });
}
function congelar_item(){
        totalizar();
        var cot = $("#cot").val();
         var lam = $("#laminas").val();
        var cod = $("#codigo0").val();
        var des = $("#descripcion_final").val();
        var des0 = $("#descripcion0").val();
        var ancho = $("#ancho").val();
        var alto = $("#alto").val();
        var cant = $("#cantidad").val();
        var per = $("#perforacion").val();
        var boq = $("#boquetes").val();
        var pelicula = $("#pelicula").val();
        var carton = $("#carton").val();
        var desp = $("#desperdicio").val();
        var despalu = $("#desperdicio_al").val();
        var despacc = $("#desperdicio_acc").val();
        var despesp = $("#desperdicio_esp").val();
        var despint = $("#desperdicio_int").val();
        var inst = $("#instalacion").val();
        var ubc = $("#ubicacion").val();
        var obse = $("#observacion").val();
        var tipo = $("#tipos").val();
        var desc = $("#descuento").val();
        var precio = $("#subtotal").val();
        var estado = $("#estado").val();
        var item = $("#item").val();
        var comision = $("#comision").val();
        var reposicion = $("#reposicion").val();
        var imprevisto = $("#imprevisto").val();
        var utilidad = $("#utilidad").val();
    
    $.ajax({
            post:'GET',
            data:'cod='+cod+'&des='+encodeURIComponent(des)+'&des0='+encodeURIComponent(des0)+'&estado='+estado+'&item='+item+'&cot='+cot+'&lam='+lam+'&ubc='+ubc+'&obse='+obse+'&itemx='+tipo+'&pelicula='+pelicula+'&carton='+carton+'&inst='+inst+'&despvid='+desp+'&despalu='+despalu+'&despacc='+despacc+'&cot='+cot+'&ancho='+ancho+'&alto='+alto+'&cant='+cant+'&per='+per+'&boq='+boq+'\
&desc='+desc+'&precio='+precio+'&despesp='+despesp+'&despint='+despint+'&utilidad='+utilidad+'&sw=31',
            url:'acciones.php',
            success:function(a){
                var p = eval(a);
               $("#estado").val('Guardado');
      
               window.opener.mostrar_items(cot);
            } 
        });

}
function traz(n){
     var cod = $("#codigo"+n).val();
     $.ajax({
        type:'GET',
        data:'cod='+cod+'&sw=24',
        url:'acciones.php',
                    success : function(t){
                        $("#Trazabilidad").html(t);
                    }
    });
}

function dt(n){
          var cod = $("#codigo"+n).val();
    var codv = $("#codvidrio"+n).val();
    var ancho = $("#ancho"+n).val();
    var alto = $("#alto"+n).val();
    var can = $("#can"+n).val();
    var per = $("#per"+n).val();
    var boq = $("#boq"+n).val();
        var desp = $("#desp"+n).val();
     $.ajax({
        type:'GET',
        data:'cod='+cod+'&codv='+codv+'&desp='+desp+'&per='+per+'&boq='+boq+'&can='+can+'&ancho='+ancho+'&alto='+alto,
        url:'calculos_vidrios_ver.php',
                    success : function(t){
                        $("#costos").html(t);
                    }
    });
}
function dt_calculo(n){
     var cod = $("#codigo"+n).val();
    var codv = $("#codvidrio"+n).val();
    var ancho = $("#ancho"+n).val();
    var alto = $("#alto"+n).val();
    var can = $("#can"+n).val();
    var per = $("#per"+n).val();
    var boq = $("#boq"+n).val();
    var desp = $("#desp"+n).val();

     $.ajax({
        type:'GET',
        data:'cod='+cod+'&codv='+codv+'&desp='+desp+'&per='+per+'&boq='+boq+'&can='+can+'&ancho='+ancho+'&alto='+alto+'&sw=0',
        url:'calculos_vidrios.php',
                    success : function(t){
                        ////console.log('mano de obra '+t);
                        var p = eval(t);
                        $("#und"+n).val(p[1]);
                        $("#tot"+n).val(p[2]);
                        $("#tiva"+n).val(p[3]);
                        $("#tmob"+n).val(p[5]);
                        $("#totdes"+n).val(p[6]);
                        $("#gtot"+n).val(p[7]);
                        dt_sumar();
                        save_vidrio(n);
                    }
    });
}
function dt_sumar(){
    
    var total = 0;
    var tund = 0;
    var stotal = 0;
    var tmob = 0;
    var tt = 0;
    var gtot=0;
       $("input[name=item]:checked").each(function(){
				var id = $(this).attr("id");
                                var und = $("#und"+id).val();
                                var tot = $("#tot"+id).val();
                                var tiva = $("#tiva"+id).val();
                                 var mob = $("#tmob"+id).val();
 
                                 var gtota = $("#gtot"+id).val();
                                 var totdes = $("#totdes"+id).val();

                                
                                tund = parseInt(tund) + parseInt(und);
                                stotal = parseInt(stotal) + parseInt(tot);
                                total = parseInt(total) + parseInt(tiva);
                                tmob = parseInt(tmob) + parseInt(mob);
                                
                                tt = parseInt(tt) + parseInt(totdes);
                                 gtot = parseInt(gtot) + parseInt(gtota);
		});
                $("#tund").val(tund);
                $("#ttot").val(stotal);
                $("#ttiva").val(total);
                $("#tmob").val(tmob);
                 $("#gtot").val(gtot);
                 $("#totdes").val(tt);
                $("#costos").html('');
    
}
function update_costo_item(){

           $("input[name=item]:checked").each(function(){
				var n = $(this).attr("id");
                                
                                dt_calculo(n);
		});
                totalizar();
}

function planilla(){
     var t_alu = 0;
     var t_vid = $("#ttot").val();
     var t_acc = $("#tacc").val();
     var t_mob = $("#tmob").val();
     var t_ins = 0;
     var t_pol = $("#tot_peli").val();
     var gt = $("#subtotal").val();
     var desp = $("#desperdicio").val();
     var despalu = $("#desperdicio_al").val();
     var despacc = $("#desperdicio_acc").val();
     var despace = $("#desperdicio_ace").val();
     var totdesvid = $("#totdes").val();
     var total_comp_desp = $("#total_comp_desp").val();
     var total_comp = $("#total_comp").val();
     
     var item = $("#item").val();
     var cot = $("#cot").val();
     var utilidad = $("#utilidad").val();

     
     window.open("../costos/planilla_costo.php?item="+item+"&utilidad="+utilidad+"&cot="+cot+"&gt="+gt+"&total_comp="+total_comp+"&totdesvid="+totdesvid+"&total_comp_desp="+total_comp_desp+"&desp="+desp+"&despalu="+despalu+"&despacc="+despacc+"&despace="+despace+"&t_alu="+t_alu+"&t_vid="+t_vid+"&t_acc="+t_acc+"&t_mob="+t_mob+"&t_ins="+t_ins+"&t_pol="+t_pol,"Planilla","width=1200,height=800");
}
function planilla_total(){
     var idcot = $("#idcot").val();
     var gt = $("#subgrantotal").val();
     
     window.open("planeacion/ventas/reporte_costos.php?gt="+gt+"&idcot="+idcot,"terceros","width=1200,height=800");
}
function totalizarx(){
    var t1 = $("#ttot").val();
    var t2 = 0;
    var t3 = 0;
    var t4 = $("#tot_peli").val();
    var t5 = $("#tacc").val();
    var t6 = $("#total_comp").val();
    var tp = $("#tp").val(); //porcentaje totales 
    var d = ($("#descuento").val()/100);


                total = parseFloat(t1) + parseFloat(t2) + parseFloat(t3) + parseFloat(t4) + parseFloat(t5) + parseFloat(t6);
                totalpor = total;// * (tp/100)
                //total = parseFloat(total) + parseFloat(totalpor);
                totaldes = total * d;
                totalr = total + totaldes;
                ////console.log(totaldes);
                iva = (totalr * 0.19);
                gt = (totalr + iva);
           
                 
                 $("#gran_descuento").val(totaldes.toFixed(2));
                $("#gran_iva").val(iva.toFixed(2));
                $("#gran_totalpagar").val(gt.toFixed(2));
                $("#gran_subtotal").val(total.toFixed(2));
             
                 calcular_planilla();
    
}
function totalizarbk(){
     var t_alu = 0;
     var t_vid = $("#ttot").val();
     var t_acc = parseFloat($("#total_comp").val()) + parseFloat($("#tacc").val());
     var t_mob = $("#tmob").val();
     var t_ins = 0;
     var t_pol = $("#tot_peli").val();
     var gt = $("#subtotal2").val();
     var d = ($("#descuento").val()/100);
     var desp = $("#desperdicio").val();
     var despalu = $("#desperdicio_al").val();
     var despacc = $("#desperdicio_acc").val();
     var despace = $("#desperdicio_ace").val(); // desperdicio_esp
     
     
             $.ajax({
                    type:'GET',
                    data:'gt='+gt+'&desp='+desp+'&despalu='+despalu+'&despacc='+despacc+'&despace='+despace+'&t_alu='+t_alu+'&t_vid='+t_vid+'&t_acc='+t_acc+'&t_mob='+t_mob+'&t_ins='+t_ins+'&t_pol='+t_pol,
                    url:'calculo_costo.php',
                    success : function(t){
                          $("#subtotal").val(t);
                           totaldes = t * d;
                           totalr = parseFloat(t) + parseFloat(totaldes);
                           ////console.log(totaldes);
                           iva = (totalr * 0.19);
                           gt = parseFloat(totalr + iva);
                          $("#tdescuento").val(totaldes.toFixed(2));
                           $("#subtotal2").val(totalr.toFixed(2));
                           $("#iva").val(iva.toFixed(2));
                           $("#gran_total").val(gt.toFixed(2));
                           
                           total = parseFloat(t_alu) + parseFloat(t_vid-t_mob) + parseFloat(t_acc) + parseFloat(t_mob) + parseFloat(t_ins) + parseFloat(t_pol);
                           $("#totalcosto").val(total.toFixed(2));
                    }
                });
     
     //window.open("../costos/planilla_costo.php?gt="+gt+"&t_alu="+t_alu+"&t_vid="+t_vid+"&t_acc="+t_acc+"&t_mob="+t_mob+"&t_ins="+t_ins+"&t_pol="+t_pol,"terceros","width=1200,height=800");
}
function totalizar(){
     var t_alu = 0;
     var t_vid = $("#ttot").val(); //total costo vidrio
     var totdesvid = $("#totdes").val();  // vidrio mas desperdicio
     
     var t_acc = $("#tacc").val(); // total costo de accesorios
     var t_mob = $("#tmob").val(); // total de mano de obra
     var t_ins = 0;
     var t_pol = $("#tot_peli").val(); // total de pelicula
     var gt = $("#subtotal").val();
     var desp = $("#desperdicio").val();    // x no
     var despalu = $("#desperdicio_al").val();// x no
     var despacc = $("#desperdicio_acc").val();// x no
     var despace = $("#desperdicio_ace").val();// x no
     var utilidad = $("#utilidad").val();
     var total_espa = $("#total_comp").val(); // costo de espaciadores e interlayer
     var total_espa_desp = $("#total_comp_desp").val(); // espaciadores  + desperdicio
     
     var d = ($("#descuento").val()/100);
     var item = $("#item").val();

     // gt="+gt+"&total_comp="+total_comp+"&totdesvid="+totdesvid+"&total_comp_desp="+total_comp_desp+"&desp="+desp+"&despalu="+despalu+"&despacc="+despacc+"&despace="+despace+"&t_alu="+t_alu+"&t_vid="+t_vid+"&t_acc="+t_acc+"&t_mob="+t_mob+"&t_ins="+t_ins+"&t_pol="+t_pol
             $.ajax({
                    type:'GET',
                    data:'gt='+gt+'&item='+item+'&utilidad='+utilidad+'&total_espa='+total_espa+'&totdesvid='+totdesvid+'&total_espa_desp='+total_espa_desp+'&desp='+desp+'&despalu='+despalu+'&despacc='+despacc+'&despace='+despace+'&t_alu='+t_alu+'&t_vid='+t_vid+'&t_acc='+t_acc+'&t_mob='+t_mob+'&t_ins='+t_ins+'&t_pol='+t_pol,
                    url:'calculo_costo.php',
                    success : function(t){
                          $("#subtotal").val(t);
                           totaldes = t * d;
                           totalr = parseFloat(t) + parseFloat(totaldes);
                           ////console.log(totaldes);
                           iva = (totalr * 0.19);
                           gt = parseFloat(totalr + iva);
                          $("#tdescuento").val(totaldes.toFixed(2));
                           $("#subtotal2").val(totalr.toFixed(2));
                           $("#iva").val(iva.toFixed(2));
                           $("#gran_total").val(gt.toFixed(2));
                           
                           total = parseFloat(t_alu) + parseFloat(t_vid) + parseFloat(t_acc) + parseFloat(t_mob) + parseFloat(t_ins)+ parseFloat(t_pol) + parseFloat(total_espa);
                           $("#totalcosto").val(total.toFixed(2));
                    }
                });
     //congelar_item();
     //window.open("../costos/planilla_costo.php?gt="+gt+"&t_alu="+t_alu+"&t_vid="+t_vid+"&t_acc="+t_acc+"&t_mob="+t_mob+"&t_ins="+t_ins+"&t_pol="+t_pol,"terceros","width=1200,height=800");
}
function agregar_ven(){
    var cot = $("#idcot").val();
    var cod = $("#v_cod").val();
    var id = $("#v_id").val();
    var descri = $("#v_des").val();
    var col = $("#v_color").val();
    var med = $("#v_med_real").val();
    var can = $("#v_can").val();
    var pre = $("#v_vund").val();
    var pre_r = $("#v_vund_real").val();
    var neto = $("#v_vtot").val();
    var tota = $("#v_pagar").val();
    var des = $("#v_por").val();
    var m = $("#v_med").val();
    
    if(cot===''){
        alert("Debes llenar los datos para generar la cotizacion.");
        return false;
    }
    if(cod===''){
        alert("Debes de escoger un producto.");
        return false;
    }
    if(col===''){
        alert("Debes de escoger un color.");
        return false;
    }
    if(can===''){
        alert("Debes de digitar la cantidad.");
        return false;
    }
    if(des===''){
        alert("Debes de digitar el porcentaje");
        return false;
    }
    $("#btn_ven").attr("disabled", true).html("<img src='../imagenes/load.gif'> Cargando..");
    $.ajax({
                    type:'GET',
                    data:'cot='+cot+'&cod='+cod+'&id='+id+'&descri='+descri+'&col='+col+'&med='+med+'&pre='+pre+'&can='+can+'&pre_r='+pre_r+'&neto='+neto+'&tota='+tota+'&des='+des+'&m='+m+'&sw=20',
                    url:'../vistas/planeacion/ventas/acciones.php',
                    success : function(t){
                          alert("Se ha guardado con exito .."+t);
                          mostrar_ventas();
                          limpiar_vnt();
                          $("#btn_ven").attr("disabled", false).html("Agregar");
                    }
                });
}
function mostrar_ventas(){
    var cot = $("#idcot").val();
        $.ajax({
                    type:'GET',
                    data:'cot='+cot+'&sw=21',
                    url:'../vistas/planeacion/ventas/acciones.php',
                    success : function(t){
                          $("#mostrar_ventas").html(t);
                    }
                });
}
function limpiar_vnt(){
 
   $("#v_cod").val('');
   $("#v_id").val('');
   $("#v_des").val('');
   $("#v_color").val('');
   $("#v_med_real").val('');
   $("#v_can").val('');
   $("#v_vund").val('');
   $("#v_vund_real").val('');
   $("#v_vtot").val('');
   $("#v_pagar").val('');
   $("#v_por").val('');
   $("#v_med").val('');
   $("#btn_buscar_vnt").focus();
}
function del_ventas(id){
    var c = confirm("Esta seguro de eliminar este registro ? ");
    if(c){
        $("#btn_del_ven").attr("disabled", true).html("<img src='../imagenes/load.gif' style='width:20px'> Eliminando..");
            $.ajax({
                    type:'GET',
                    data:'id='+id+'&sw=22',
                    url:'../vistas/planeacion/ventas/acciones.php',
                    success : function(t){
                        if(t==='1'){
                            alert("se ha eliminado con exito ");
                        }else{
                            alert("Ocurrio un error, intentelo de nuevo ");
                        }
                          mostrar_ventas();
                    }
                });
            }
}
function calcular_perfil(){
    var can = $("#v_can").val();
    var pre = $("#v_vund").val();
    var med = $("#v_med_real").val();
    var des = $("#v_por").val();
    var m = $("#v_med").val();
    if(m==='1'){
        var medr = 1;
    }else{
       var medr = med / 1000;
    }
    var n = medr * parseInt(pre);
    $("#v_vund_real").val(n);
    
    t = n * can;
    d = t * (des / 100);
    tot = parseInt(t) + parseInt(d);
    iva = tot * 0.19;
    total = parseInt(tot) + parseInt(iva);
    $("#v_vtot").val(tot);
    $("#v_pagar").val(total);
}
function ajustar(){
                var pre = $("#precio").val();
                var aju = $("#ajuste").val();
                var und = $("#unidad").val();
                var ref = $("#ref").val();
                var esp = $("#espesor").val();
                if(ref==''){
                    alert("Seleccione alguna referencia");
                    $("#ref").focus();
                    return false;
                }
                if(esp==''){
                    alert("Seleccione algun espesor");
                    $("#espesor").focus();
                    return false;
                }
                if(pre==''){
                    alert("Digite el precio");
                    $("#precio").focus();
                    return false;
                }
                $.ajax({
                    type:'GET',
                    data:'pre='+pre+'&aju='+aju+'&und='+und+'&ref='+ref+'&esp='+esp+'&sw=12',
                    url:'acciones.php',
                    success : function(t){
                        if(t==1){
                            alert("Se ha agregado exitosamente ");
                        }else{
                            alert("Se ha actualizado exitosamente ");
                        }
                        var pre = $("#precio").val('');
                        var aju = $("#ajuste").val('');
                        var und = $("#unidad").val('');
                        mostrar_ajustes(1); 
                        
                        
                    }
                });
}
function mostrar_ajustes(page){
           var a = $("#proa").val();
      var b = $("#espa").val();
     $.ajax({
                    type:'GET',
                    data:'pro='+a+'&esp='+b+'&sw=13',
                    url:'acciones.php',
                    success : function(t){
                         $("#mostrar_tabla").html(t);
                        
                    }
                });
}
function eliminar(id){
        var con = confirm("Esta seguro de eliminar este item?");
        if(con){
            $.ajax({
                type:'GET',
                data:'id='+id+'&sw=16',
                url:'acciones.php',
                success : function(){
                    alert("Se elimino correctamente.");
                    mostrar_ajustes(1);
                }
            });
        }
    }

function datos_ventas(des,id,ref,med,pre,max){
    $("#v_cod").val(ref);
    $("#v_des").val(des);
    $("#v_id").val(id);
    $("#v_vund").val(pre);
    $("#v_med").val(med);
    $("#v_max").val(max);
    $("#v_color").focus();
    $("#v_can").attr("disabled", false);
}

function agregar_item(){
         var idp = $("#idp").val();
         var idc = $("#idc").val();
         var cot = $("#idcot").val();
         var idv = $("#idv").val();
         var idv2 = $("#idvh2").val();
         var idv3 = $("#idvh3").val();
         var idv4 = $("#idvh4").val();
         var ancho = $("#ancho").val();
         var alto = $("#alto").val();
         var cant = $("#cant").val();
         var per = $("#per").val();
         var boq = $("#boq").val();
         var desc = $("#desc").val();
         var rep = $("#rep").val();
         var pel = $("#pel").val();
         var ins = $("#ins").val();
         var p4 = $("#p4").val();
         var p5 = $("#p5").val();
         var p6 = $("#p6").val();
         var p7 = $("#p7").val();
         var ubc = $("#ubc").val();
         var obse = $("#obse").val();
         var ajuste = $("#ajuste").val();
         var adi = $("#adi_per_boq").val();
         if(cot===''){
            alert("debes llenar los datos del cliente para poder agregar los items");
            $("#doc").val();
            return false;
         }
        if(ancho===''){
             alert("Digite el ancho del vidrio");
             $("#ancho").focus();
             return false;
         }
         if(alto===''){
             alert("Digite el alto del vidrio");
             $("#alto").focus();
             return false;
         }
         if(cant===''){
             alert("Digite la cantidad de vidrios");
             $("#cant").focus();
             return false;
         }
         if(per===''){
             alert("Digite las cantidades de Perforaciones");
             $("#per").focus();
             return false;
         }
         if(boq===''){
             alert("Digite las cantidades de Boquete");
             $("#boq").focus();
             return false;
         }
         if(desc===''){
             alert("Digite el descuento para el cliente, si no lo tiene solicitelo al jefe de ventas.");
             $("#desc").focus();
             return false;
         }
        var precio = $("#pretotal").val();
                var ct = $("#ct").val();
        //alert(precio);
        $("#boton").html(" <img src='../images/load.gif'>Agregando.. ");
        $.ajax({
            post:'GET',
            data:'ref='+idp+'&ct='+ct+'&ajuste='+ajuste+'&adi='+adi+'&ubc='+ubc+'&obse='+obse+'&pelicula='+pel+'&install='+ins+'&precio='+precio+'&desc='+desc+'&cot='+cot+'&idc='+idc+'&p4='+p4+'&p5='+p5+'&p6='+p6+'&p7='+p7+'&vid='+idv+'&vid2='+idv2+'&vid3='+idv3+'&vid4='+idv4+'&ancho='+ancho+'&alto='+alto+'&cant='+cant+'&per='+per+'&boq='+boq+'&desc='+desc+'&rep='+rep+'&sw=5',
            url:'../vistas/ventas/acciones.php',
            success:function(a){
               //alert(a);
               //alert(p[4]+' - '+p[5]+' - '+p[6]+' - '+p[7]);
               
               clear_items();
               mostrar_items(cot);
            } 
        });
}
function pre(){
    var cot = $("#idcot").val();
    mostrar_items(cot);
}
function buscar_ced(){
    var doc = $("#doc").val();
            $.ajax({
            post:'GET',
            data:'doc='+doc+'&sw=1',
            url:'../vistas/planeacion/ventas/acciones.php',
            success:function(d){
                var p = eval(d);
                $("#idc").val(p[0]);
                $("#cli").val(p[7]);
                $("#dir").val(p[2]);
                $("#tel").val(p[3]);
                $("#dep").val(p[8]);
                $("#ciu").val(p[9]);
                $("#max").val(p[11]);
                var t = p[11] * (-1);
                if(t > 40){
                    $("#desc").val(p[11]);
                }else{
                    $("#desc").val(0);
                }
                
                if(p[11]!=='0'){
                    $("#desc").attr("disabled", false);
                }else{
                    $("#desc").attr("disabled", true);
                }
                if(p[0]==null){
                    $("#idc").focus();
                }else{
                    $("#ser").focus();
                }
            } 
        });
}
function cot(){
        var idp = $("#idp").val();
        var idv = $("#idv").val();
        var idvh2 = $("#idvh2").val();
        var idvh3 = $("#idvh3").val();
        var idvh4 = $("#idvh4").val();
        var ancho = $("#ancho").val();
        var alto = $("#alto").val();
        var cant = $("#cant").val();
        var per = $("#per").val();
        var boq = $("#boq").val();
        var desc = $("#desc").val();
        var des = $("#des").val();
        var rep = $("#rep").val();
        var pel = $("#pel").val();
        var ins = $("#ins").val();
        var desc = $("#desc").val();
        var hoja = $("#hoja").val();
        var ajuste = $("#ajuste").val();
        //alert(hoja);
        $.ajax({
            post:'GET',
            data:'ref='+idp+'&pelicula='+pel+'&install='+ins+'&hoja='+hoja+'&des='+des+'&desc='+desc+'&vid='+idv+'&vid2='+idvh2+'&vid3='+idvh3+'&vid4='+idvh4+'&ancho='+ancho+'&alto='+alto+'&cant='+cant+'&per='+per+'&boq='+boq+'&desc='+desc+'&rep='+rep+'&sw=3',
            url:'../vistas/planeacion/ventas/acciones.php',
            success:function(d){
                //alert(d);
               var p = eval(d);
               
               $("#pretotal").val(p[0]);
               $("#preund").val(p[2]);
               $("#piva").val(p[3]);
               $("#pivaOut").val(p[3]);
               //parametros para ingresar a la base de datos
               $("#p4").val(p[4]);
               $("#p5").val(p[5]);
               $("#p6").val(p[6]);
               $("#p7").val(p[7]);
                $("#ajuste").val(p[10]);
                
               $("#preund_desc").val(p[11]);
               $("#pretotal_desc").val(p[12]);
               $("#adi_per_boq").val(p[13]);
               //$("#msj").html(p[13]); // este alert sirve para visualizar las variables 
               sumaritem();
               //alert(p[10]);
            } 
        });
}
function ajuste_referencias(){
        var idp = $("#ref").val();
        var idv = $("#espesor").val();
        var idvh2 = 0;
        var idvh3 = 0;
        var idvh4 = 0;
        var ancho = 1000;
        var alto = 1000;
        var cant = 1;
        var per = 0;
        var boq = 0;
        var desc = 0;
        var rep = 1;
        var pel = 'No Aplica';
        var ins = 'No';
        var desc = 0;
        var hoja = 1;
        
        $.ajax({
            post:'GET',
            data:'ref='+idp+'&pelicula='+pel+'&install='+ins+'&hoja='+hoja+'&des='+desc+'&vid='+idv+'&vid2='+idvh2+'&vid3='+idvh3+'&vid4='+idvh4+'&ancho='+ancho+'&alto='+alto+'&cant='+cant+'&per='+per+'&boq='+boq+'&desc='+desc+'&rep='+rep+'&sw=18',
            url:'../vistas/planeacion/ventas/acciones.php',
            success:function(d){
                //alert(d);
               var p = eval(d);
               $("#precio").val(p[2]);
               verificar(idp,idv);
            } 
        });
}
function recalcular(ref,vid,id){
        var idp = ref;
        var idv = vid;
        var idvh2 = 0;
        var idvh3 = 0;
        var idvh4 = 0;
        var ancho = 1000;
        var alto = 1000;
        var cant = 1;
        var per = 0;
        var boq = 0;
        var desc = 0;
        var rep = 1;
        var pel = 'No Aplica';
        var ins = 'No';
        var desc = 0;
        var hoja = 1;
        
        $.ajax({
            post:'GET',
            data:'ref='+idp+'&pelicula='+pel+'&install='+ins+'&hoja='+hoja+'&des='+desc+'&vid='+idv+'&vid2='+idvh2+'&vid3='+idvh3+'&vid4='+idvh4+'&ancho='+ancho+'&alto='+alto+'&cant='+cant+'&per='+per+'&boq='+boq+'&desc='+desc+'&rep='+rep+'&sw=18',
            url:'../vistas/planeacion/ventas/acciones.php',
            success:function(d){
                //alert(d);
               var p = eval(d);
               var a = $("#a"+id).val(p[2]);
               var c = $("#c"+id).val();
               var b = parseInt(c) - parseInt(p[2]);
               $("#b"+id).val(b);
               actualizar_precio(id,p[2],c,b);
            } 
        });
}
function ajuste_manual(id){
  
    var a = $("#a"+id).val();
    var c = $("#c"+id).val();
    var b = parseInt(c) - parseInt(a);
     $("#b"+id).val(b);
     actualizar_precio(id,a,c,b);
//    success: function(){
//        b = parseInt(c) - parseInt(a);
//        $("#b"+id).val(b);
//    }
}
function actualizar_precio(id,cos,pre,aju){
    $.ajax({
            post:'GET',
            data:'id='+id+'&cos='+cos+'&pre='+pre+'&aju='+aju+'&sw=19',
            url:'../vistas/planeacion/ventas/acciones.php',
            success:function(dd){
               $("#por"+id).html(dd);
                $("#ok"+id).html('<img src="../../images/ok.png">');
            } 
        });
}
function verificar(pro, vid){
  
            $.ajax({
            post:'GET',
            data:'ref='+pro+'&vid='+vid+'&sw=17',
            url:'../vistas/planeacion/ventas/acciones.php',
            success:function(d){
  
                if(d>0){
                     alert("Este producto con el espesor ya existe");
                     $("#des_ref").val('');
                     $("#espesor").val('');
                     $("#precio").val('');
                     return false;
                }
        
            } 
        });
}

function terceros(){
    
    window.open("../popup/terceros/","terceros","width=800,height=600");
}
function update_ced(){
     var idc = $("#idc").val();
    window.open("../vistas/planeacion/ventas/index.php?id="+idc,"terceros","width=300,height=300");
}
function cliente_info(id,nom,dir,con,tel,cel,ema,doc,dep,mun,ven,ubi,ciud,muni,pvi){
    $("#cli").val(nom);
    $("#doc").val(doc);
    $("#dir").val(dir);
    $("#tel").val(tel);
    $("#dep").val(dep);
    $("#ciu").val(mun);
    $("#dir").val(ubi);
    $("#dir").val(ubi);
     $("#max").val(pvi);
    var idc = $("#idc").val(id);
    if(id!==''){
        $("#continuar").attr("disabled", false);
    }else{
         $("#continuar").attr("disabled", true);
    }
}
function municipio(ciu){
    $("#ciu").val(ciu);
}
function referencias(){
    window.open("../vistas/lista_vidrios.php?linea=Vidrio","terceros","width=800,height=600");
}
function buscare(cod,id,des,per,boq,lam){
    $("#cod").val(cod);
    $("#idp").val(id);
    $("#des").val(des);
    
    if(per==='1'){
        $("#per").attr("disabled", false);
        $("#per").val('');
    }else{
        $("#per").attr("disabled", true);
        $("#per").val(per);
    }
    if(boq==='1'){
        $("#boq").attr("disabled", false);
         $("#boq").val('');
    }else{
        $("#boq").attr("disabled", true);
        $("#boq").val(boq);
    }
    //console.log("laminas: "+lam);
     if(parseInt(lam) > 1 ){
         window.open("../vistas/cantidad.php","x","width=400 , height=200 ");
                  
                
                }else{
                    $("#vidrios").html('<input type="hidden" id="idv"><input type="text" id="vid" style="width: 80px" onclick="vidrios();"> <input type="hidden" id="idvh2"><input type="hidden" id="vidh2" style="width: 20px" onclick="vidrioss2();"> <input type="hidden" id="idvh3"><input type="hidden" id="vidh3" style="width: 20px" onclick="vidrioss3();"> <input type="hidden" id="idvh4"><input type="hidden" id="vidh4" style="width: 20px" onclick="vidrioss4();">');
                    $("#hoja").val('1');
                }
}


function clear_items(){
     $("#cod").val('').focus();
    $("#idp").val('');
    $("#des").val('');
    $("#per").val('');
    $("#boq").val('');
     $("#idv").val('');
    $("#vid").val('');
    $("#idvh2").val('');
    $("#vidh2").val('');
    $("#idvh3").val('');
    $("#vidh3").val('');
    $("#idvh4").val('');
    $("#vidh4").val('');
    $("#hoja").val('');
    $("#ancho").val('');
    $("#alto").val('');
    $("#cant").val('');
    $("#preund").val('');
    $("#pretotal").val('');
    $("#piva").val('');
    $("#pivaOut").val('');
    $("#p4").val('');
    $("#p5").val('');
    $("#p6").val('');
    $("#p7").val('');
    $("#ajuste").val('');
    $("#rep").val('1');
    $("#per").val('');
    $("#boq").val('');
    $("#ubc").val('');
    $("#obse").val('');
    
}
function generar(){
     var idc = $("#idc").val();
     var cot = $("#idcot").val();
     var doc = $("#doc").val();
      var dep = $("#dep").val();
      var ciu = $("#ciu").val();
       var ase = $("#ase").val();
        var ana = $("#ana").val();
         var dir = encodeURIComponent($("#dir").val());
          var ent = $("#ent").val();
         var obra = encodeURIComponent($("#obra").val());
          var obs = encodeURIComponent($("#obs").val());
         var exp = $("#ser").val();
         var pag = $("#pag").val();
          var tel = $("#tel").val();
           var iva = $("#iva").val();
          var despvid = $("#desperdicio").val();
          var despalu = $("#desperdicio_al").val();
          var despacc = $("#desperdicio_acc").val();
          var despace = $("#desperdicio_ace").val();
          var despesp = $("#desperdicio_esp").val();
          var despint = $("#desperdicio_int").val();
          
          var utilidad = $("#utilidad").val();
          
          if(idc===''){
              alert("Debes escojer el cliente");
              $("#doc").focus();
              return false;
          }
          if(exp===''){
              alert("Debes seleccionar el tipo de servicio");
              $("#ser").focus();
              return false;
          }
         $("#continuar").attr("disabled",true);
         $("#doc").attr("disabled",true);
         if(cot!==''){
             var save = confirm("Esta seguro de congelar esta cotizacion. \n Antes de congelar la cotizacion verifique que la informacion este bien.");
             if(!save){
                 return false;
             }
         }
      $.ajax({
            type:'GET',
            data:'idc='+idc+'&despvid='+despvid+'&iva='+iva+'&utilidad='+utilidad+'&despalu='+despalu+'&despacc='+despacc+'&despace='+despace+'&despesp='+despesp+'&despint='+despint+'&dep='+dep+'&ciu='+ciu+'&ana='+ana+'&ase='+ase+'&tel='+tel+'&dir='+dir+'&cot='+cot+'&ent='+ent+'&obra='+obra+'&obs='+obs+'&exp='+exp+'&pag='+pag+'&sw=6',
            url:'../vistas/planeacion/ventas/acciones.php',
            success:function(res){
                //console.log(res);
              var p = eval(res);
              if(exp==1){
                $("#porcentaje").attr("disabled",true);
              }
              $("#sear").attr("disabled",true);
              $("#ser").attr("disabled",true);
               
                var est = p[3];
               if(est==='En proceso'){
               $("#idcot").val(p[0]);
               $("#cot").val(p[1]);
               $("#ver").val(p[2]);
               $("#est").val(p[3]);
               $("#guardar").attr("disabled", false);
               $("#agregar_item").attr("disabled", false);
               $("#msg").html('<img src="../imagenes/ledrojo.gif"><font color="red"> Sin Congelar</font>');
           }else{
               $("#est").val(p[3]);
                $("#guardar").attr("disabled",true);
                $("#ser").attr("disabled",true);
                $("#acte").attr("disabled",true);
                $("#agregar_item").attr("disabled", true);
                $("#formulario").html("");
                $("#msg").html('<img src="../imagenes/ok.png"><font color="green"> Congelado</font>');
                mostrar_items(cot);
           }
            } 
        });
}
function mostrar_items(cot){
    var  ser = $("#ser").val();
     var  est = $("#est").val();
      $.ajax({
            post:'GET',
            data:'cot='+cot+'&ser='+ser+'&est='+est+'&sw=7',
            url:'../vistas/planeacion/ventas/acciones.php',
            success:function(a){
                $("#boton").html('<button onclick="agregar_item();" id="bot" disabled>Agregar</button>');
               $("#mostrar_lineas").html(a);
              
            } 
        });
}
function validar_vidrios(){
    var cot = $("#idcot").val();
    $.ajax({
        type:'GET',
        data:'cot='+cot+'&sw=36',
        url:'../vistas/planeacion/ventas/acciones.php',
        success : function(r){
            //console.log(r);
            var p = eval(r);
            if(p[0]==='disabled'){
                      $("#desperdicio").attr("disabled", true);
                      $("#desperdicio_al").attr("disabled", true);
                      $("#desperdicio_acc").attr("disabled", true);
                      $("#desperdicio_ace").attr("disabled", true);
                      $("#desperdicio_esp").attr("disabled", true);
                      $("#desperdicio_int").attr("disabled", true);
                      $("#utilidad").attr("disabled", true);
                  }else{
                      $("#desperdicio").attr("disabled", false);
                      $("#desperdicio_al").attr("disabled", false);
                      $("#desperdicio_acc").attr("disabled", false);
                      $("#desperdicio_ace").attr("disabled", false);
                      $("#desperdicio_esp").attr("disabled", false);
                      $("#desperdicio_int").attr("disabled", false);
                      $("#utilidad").attr("disabled", false);
                  }
                   $("#mensajes").html(p[1]);
        }
    });
}
function del_item(item, id){
    var cot = $("#idcot").val();
     con = confirm("Esta seguro de quitar este items?");
     if(con){
         $("#boton"+item).html(" <img src='../images/load.gif'>Eliminando.. ");
      $.ajax({
            post:'GET',
            data:'id='+id+'&sw=8',
            url:'../vistas/planeacion/ventas/acciones.php',
            success:function(a){
               mostrar_items(cot);
              
            } 
        });
    }else{
        return false;
    }
}
function rep_item(item, id){
    var cot = $("#idcot").val();
    var rep = $("#rep"+item).val();
     var ct = $("#ct").val();
     con = confirm("Esta seguro de repetir este items?..");
     if(con){
         $("#boton"+item).html(" <img src='../images/load.gif'>Duplicando.. ");
      $.ajax({
            post:'GET',
            data:'id='+id+'&ct='+ct+'&rep='+rep+'&sw=9',
            url:'../vistas/planeacion/ventas/acciones.php',
            success:function(a){
                console.log(a);
               mostrar_items(cot);
              
            } 
        });
    }else{
        return false;
    }
} 
function lista_vidrios(item){
     window.open("../combos/lista_vidrios.php?item="+item,"terceros","width=500,height=400");
}
function lista_vidrios2(item){
     window.open("../combos/lista_vidrios_1.php?item="+item,"terceros","width=500,height=400");
}
function lista_vidrios3(item){
     window.open("../combos/lista_vidrios_2.php?item="+item,"terceros","width=500,height=400");
}
function lista_vidrios4(item){
     window.open("../combos/lista_vidrios_3.php?item="+item,"terceros","width=500,height=400");
}
function sumaritem(){
    var ct = $("#ct").val();
    gt = 0;ctt = 0;
    for(i=1;i<=ct;i++){
        var piva = $("#piva"+i).val();
        var cant = $("#cant"+i).val();
        gt = parseInt(gt) + parseInt(piva);
        ctt = parseInt(ctt) + parseInt(cant);
    }
    $("#grantotal").val(gt);
    $("#cantotal").val(ctt);
    
}
function save_item(){
    var cot = $("#cot").val();
     var lam = $("#laminas").val();
    var cod = $("#codigo0").val();
    var des = $("#descripcion_final").val();
    var des0 = $("#descripcion0").val();
    var ancho = $("#ancho").val();
    var alto = $("#alto").val();
    var cant = $("#cantidad").val();
    var per = $("#perforacion").val();
    var boq = $("#boquetes").val();
    var pelicula = $("#pelicula").val();
    var carton = $("#carton").val();
    var desp = $("#desperdicio").val();
    var despalu = $("#desperdicio_al").val();
    var despacc = $("#desperdicio_acc").val();
    var inst = $("#instalacion").val();
    var ubc = $("#ubicacion").val();
    var obse = $("#observacion").val();
    var item = $("#tipos").val();
    var desc = $("#descuento").val();
    var precio = $("#subtotal").val();
    var estado = $("#estado").val();
    var item = $("#item").val();
    var comision = $("#comision").val();
    var reposicion = $("#reposicion").val();
    var imprevisto = $("#imprevisto").val();
    var utilidad = $("#utilidad").val();
    $.ajax({
            post:'GET',
            data:'cod='+cod+'&des='+encodeURIComponent(des)+'&des0='+encodeURIComponent(des0)+'&estado='+estado+'&item='+item+'&cot='+cot+'&lam='+lam+'&ubc='+ubc+'&obse='+obse+'&item='+item+'&pelicula='+pelicula+'&carton='+carton+'&inst='+inst+'&despvid='+desp+'&despalu='+despalu+'&despacc='+despacc+'&cot='+cot+'&ancho='+ancho+'&alto='+alto+'&cant='+cant+'&per='+per+'&boq='+boq+'&desc='+desc+'&precio='+precio+'&comision='+comision+'&reposicion='+reposicion+'&imprevisto='+imprevisto+'&utilidad='+utilidad+'&sw=27',
            url:'acciones.php',
            success:function(a){
                var p = eval(a);
               $("#estado").val('En proceso');
               $("#item").val(p[0]);
               window.opener.idglobal=p[0];
               laminas_items();
            } 
        });
    
}

function save_vidrio(n){

    var cot = $("#cot").val();
     var lam = $("#laminas").val();
    var cod = $("#codvidrio"+n).val();
    var traz = $("#codigo"+n).val();
    var des0 = $("#descripcion"+n).val();
    var des = $("#desvidrio"+n).val();
    var ancho = $("#ancho").val();
    var alto = $("#alto").val();
    var cant = $("#can"+n).val();
    var per = $("#perforacion").val();
    var boq = $("#boquetes").val();
    var pelicula = $("#pelicula").val();
    var carton = $("#carton").val();
    var desp = $("#desp"+n).val();
    var despalu = $("#desperdicio_al").val();
    var despacc = $("#desperdicio_acc").val();
    var inst = $("#instalacion").val();
    var ubc = $("#ubicacion").val();
    var obse = $("#observacion").val();
    var itemv = $("#item"+n).val();
    var desc = $("#descuento").val();
    var precio = $("#tot"+n).val();
    var estado = $("#estado").val();
    var item = $("#item").val();
    var idlam = $("#idlam"+n).val();
    var comision = $("#comision").val();
    var reposicion = $("#reposicion").val();
    var imprevisto = $("#imprevisto").val();
    var utilidad = $("#utilidad").val();
    var mobt = $("#tmob"+n).val();
    
    $.ajax({
            post:'GET',
            data:'cod='+cod+'&traz='+traz+'&mob='+mobt+'&des='+encodeURIComponent(des)+'&des0='+encodeURIComponent(des0)+'&estado='+estado+'&idlam='+idlam+'&item='+item+'&cot='+cot+'&lam='+lam+'&ubc='+ubc+'&obse='+obse+'&itemv='+itemv+'&pelicula='+pelicula+'&carton='+carton+'&inst='+inst+'&despvid='+desp+'&despalu='+despalu+'&despacc='+despacc+'&cot='+cot+'&ancho='+ancho+'&alto='+alto+'&cant='+cant+'&per='+per+'&boq='+boq+'&desc='+desc+'&precio='+precio+'&comision='+comision+'&reposicion='+reposicion+'&imprevisto='+imprevisto+'&utilidad='+utilidad+'&sw=28',
            url:'acciones.php',
            success:function(a){
                var p = eval(a);
               $("#idlam"+n).val(p[0]);
               //console.log('error '+a);
               totalizar();
            } 
        });   
}
function imprimir(){ 
      var cot = $("#idcot").val();
      var ct = $("#ct").val();
      var col = $("#columnas").val();
     if(cot!==''){
    window.open("planeacion/ventas/imprimir_vidrios.php?cot="+cot+"&total_item="+ct+"&col="+col+"&ciudad=Barranquilla","Imprimir","width=1200,height=800");
     }
}

function nuevo(){
    window.location.href='../vistas/sala_ventas.php';
}
function porcentajes(){
      var cot = $("#idcot").val();
      var cli = $("#idc").val();
     window.open("../vistas/porcentajes.php?cot="+cot+"&cli="+cli+"","Porcentajes","width=1200,height=800");
    
}
function porcentajes_ventas(){
      var cot = $("#idcot").val();
      var cli = $("#idc").val();
      var max = $("#max").val();
     window.open("../vistas/porcentajes.php?cot="+cot+"&cli="+cli+"&max="+max,"Porcentajes","width=1200,height=800");
    
}
function vendedor(usu){
    $("#ase").val(usu);
}
function obtener_usuario(nombre){
    $("#ase").val(nombre);
}
function obtener_municipio(nombre){
    $("#ciu").val(nombre);
}
function pasar_tercero(cod,nom,idt,dir,tel,ciu,mun,des){
                $("#idc").val(idt);
                $("#cli").val(nom);
                $("#dir").val(dir);
                $("#tel").val(tel);
                $("#dep").val(mun);
                $("#ciu").val(ciu);
                $("#max").val(des);
                $("#doc").val(cod);
}
function pre_cotizar(id){
    linea = $("#flinea").val();
    cotizacion = $("#idcot").val();
    var est = $("#est").val();
    var max = $("#max").val();
    if(est!=='En proceso'){
        alert("No puedes agregar items.");
        return false;
    }
    idglobal = id;
    idcompuesto = 0;
    
    //console.log(idglobal);
    if(linea=='Vidrio'){
          window.open("../vistas/planeacion/ventas/formulario.php","Cotizador","width=1400,height=800");
    }else{
          window.open("../vistas/planeacion/ventas/aluminio.php","Cotizador","width=1400,height=800");
    }

}
function pre_cotizar_editar(id,linea){
    var cot = $("#idcot").val();
    var est = $("#est").val();
    var max = $("#max").val();
    if(est!=='En proceso'){
        alert("No puedes agregar items.");
        return false;
    }
    idglobal = id;
    //console.log(idglobal);
    if(linea=='Vidrio'){
          window.open("../vistas/planeacion/ventas/formulario.php","Cotizador"+id+"","width=1400,height=800", "_blank");
    }else{
          window.open("../vistas/planeacion/ventas/aluminio.php","Cotizador"+id+"","width=1400,height=800", "_blank");
    }

}
function DatosBasicos(){
                $("#cot").val(window.opener.$("#idcot").val());
                $("#linea").val(window.opener.$("#flinea").val());
                $("#descuento").val(window.opener.$("#max").val());
                $("#item").val(window.opener.idglobal);
                 $("#compuesto").val(window.opener.idcompuesto);
                var item = window.opener.idglobal;
                if(item!==''){
                $.ajax({
                    post:'GET',
                    data:'item='+item+'&sw=32',
                    url:'acciones.php',
                    success:function(a){
                        //console.log(a);
                        var p = eval(a);
                        
                        pasar_datos_dt(p[2]);
                            $("#codigo0").val(p[2]);
                            var lam = $("#laminas").val(p[9]);
                            var des = $("#descripcion_final").val(p[3]);
                            var ancho = $("#ancho").val(p[6]);
                            var alto = $("#alto").val(p[7]);
                            var cant = $("#cantidad").val(p[8]);
                            var per = $("#perforacion").val(p[10]);
                            var boq = $("#boquetes").val(p[11]);
                            var pelicula = $("#pelicula").val(p[12]);
                            if(p[12]=='Una Cara'){
                                  $('#result_tr').show('show');
                            }else if(p[12]=='Dos Cara'){
                                 $('#result_tr').show('show');
                            }else{
                                 $('#result_tr').hide('hide');
                            }
                           
                            var carton = $("#carton").val(p[13]);
                            var desp = $("#desperdicio").val(p[27]);
                            var despalu = $("#desperdicio_al").val(p[28]);
                            var despacc = $("#desperdicio_acc").val(p[29]);
                            var inst = $("#instalacion").val(p[19]);
                            var ubc = $("#ubicacion").val(p[16]);
                            var obse = $("#observacion").val(p[17]);
                            var item = $("#tipos").val(p[18]);
                            var desc = $("#descuento").val(p[21]);
                            var precio = $("#subtotal").val(p[20]);
                            var estado = $("#estado").val(p[26]);
                            $("#utilidad").val(p[34]);
                            laminas_items();
                        
                        
                        
                    }
                });
            }
                
                
}
function obtener_variables(){
    var idcot = window.opener.$("#idcot").val();
    alert("obteniendo datos "+idcot);

}
function get_referencias(n){
     linea = $("#linea").val();
    window.open("../../../popup/dt/?linea="+linea+'&n='+n,"Referencias","width=900,height=600");
}
function form_vidrio(i){
    var cod = $("#codigo").val();
    if(cod==''){
        alert("Debes de seleccionar el codigo principal.");
        return false;
        
    }
    window.open("../../../popup/tipo_vidrios/?n="+i,"Tipos","width=900,height=600");
}
function pasar_vidrio(cod,de,n){
     $("#codvidrio"+n).val(cod);
      $("#desvidrio"+n).val(de);
       dt_calculo(n);
       concatenar();
       if(n==0){
           $("#ancho").focus();
       }
      
       
}
function concatenar(){
    var des = $("#descripcion0").val();
    var dest = '';
    var codigo = '';
    $("input[name=item]:checked").each(function(){
                     var id = $(this).attr("id");
                     var de = $("#desvidrio"+id).val();
                     var cod = $("#codigo"+id).val();
                      var descripcion = $("#descripcion"+id).val();
                     if(codigo==''){
                         dest = descripcion + ' '+ de;
                     }else{
                         dest = dest + '+ '+ descripcion + ' '+ de;
                     }
                     codigo = cod;                  
		});
     conca = dest; 
    $("#descripcion_final").val(conca);
    
}
function obtener_dt(cod,des,n){
    if(n==0){
        pasar_datos_dt(cod);
    }
        $("#codigo"+n).val(cod);
         $("#descripcion"+n).val(des);
         dt_calculo(n);
         
}
function pasar_datos_dt(id){
    $.ajax({
            type: 'GET',
            data:'id='+id+'&sw=2',
            url: '../productos_dos/acciones.php',
            success: function(resultado){
                
                var p = eval(resultado);
                        $("#id_pro").val(p[0]);
                        $("#idp").val(id);
                        $("#foto").attr("disabled",false);
                        $("#loadi").attr("disabled",false);
                    $("#codigo0").val(id);
                    $("#linea").val(p[1]);
                    $("#referencia").val(p[6]);
                    $("#sistema").val(p[30]); 
                    $("#anc_general").val(p[3]);
                    $("#imagen").html(p[28]);
                    $("#tipo").val(p[31]);
                    $("#alt_gener").val(p[5]);
                    $("#hojas").val(p[12]);
                    $("#alt_rejilla").val(p[10]);
                    $("#referencia").val(p[6]);
                    $("#configuracion").val(p[32]);
                    $("#cantidad").val();
                    $("#tipo_vid").val('');
                    $("#espesor_vid").val(p[33]);
                    $("#tipo_riel").val(p[34]);
                    $("#tipo_alfa").val(p[35]);
                    $("#ancho_max").val(p[16]);
                    $("#descripcion0").val(p[4]);
                    $("#tipo_rejilla").val(p[38]);
                    $("#alto_max").val(p[17]);
                    $("#tipo_cie").val(p[36]);
                    $("#cuerpo_fij").val(p[37]);
                    $("#per").val(p[8]);
                    $("#boq").val(p[9]);
                    if(p[8]=='No'){
                        $("#perforacion").val('0').attr("disabled",true);
                    }else{
                        $("#perforacion").val('0').attr("disabled",false);
                    }
                    if(p[9]=='No'){
                        $("#boquetes").val('0').attr("disabled",true);
                    }else{
                        $("#boquetes").val('0').attr("disabled",false);
                    }
                    $("#lam").val(p[15]);
                    $("#espaciadores").val(p[39]);
                    $("#interlayer").val(p[40]);
//console.log(p[31]);
            }
           });

}
function precios_interlayer(n){
    var item = $("#item").val();
    var cot = $("#cot").val();
    var idins = $("#idins"+n).val();
     var cod = $("#inter"+n).val();
     var des = $("#desp_mat"+n).val();
     var dtx = $("#codigo0").val();
     var can = $("#cantidad").val();
     var ancho = $("#ancho").val();
     var alto = $("#alto").val();
     var tipo = $("#tipomat"+n).val();
     //console.log(dtx);
             $.ajax({
            post:'GET',
            data:'cod='+cod+'&dt='+dtx+'&tipo='+tipo+'&item='+item+'&cot='+cot+'&idins='+idins+'&can='+can+'&n='+n+'&ancho='+ancho+'&alto='+alto+'&desp='+des+'&extra=No&sw=25',
            url:'acciones.php',
            success:function(a){
                var p = eval(a);
               $("#und_int"+n).val(p[0]);
               $("#tot_int"+n).val(p[1]);
               $("#mtc_int"+n).val(p[2]);
               $("#med_int"+n).val(p[3]);
               $("#iteme"+n).val(p[5]);
               $("#idpp"+n).val(p[6]);
               $("#idins"+n).val(p[7]);
                $("#tot_desp"+n).val(p[8]);
               //console.log(p[4]);
               sumar_interlayer();
               totalizar();
            } 
        });
    }
    function sumar_interlayer(){
        var tt = 0;
        var td = 0;
         $("input[name=item2]:checked").each(function(){
				var n = $(this).attr("id");
                                var tot = $("#tot_int"+n).val();
                                var totdes = $("#tot_desp"+n).val();
                                tt = parseFloat(tt) + parseFloat(tot);
                                 td = parseFloat(td) + parseFloat(totdes);
                               
		});
               $("#total_comp").val(tt);
                $("#total_comp_desp").val(td);
    }
function agregar_compuesto(){
    var item = $("#item").val();
    var cot = $("#cot").val();
    var idins = $("#idins").val();
     var cod = $("#extra_comp").val();
     var des = $("#despacc").val();
     var dtx = $("#codigo0").val();
     var can = $("#cantidad").val();
     var ancho = $("#ancho").val();
     var alto = $("#alto").val();
     //console.log(dtx);
             $.ajax({
            post:'GET',
            data:'cod='+cod+'&dt='+dtx+'&item='+item+'&cot='+cot+'&idins='+idins+'&can='+can+'&ancho='+ancho+'&alto='+alto+'&desp='+des+'&extra=Si&sw=25',
            url:'acciones.php',
            success:function(a){
                var p = eval(a);
               $("#precio_unidad").val(p[0]);
               $("#precio_total").val(p[1]);
               $("#mtc_int_comp").val(p[2]);
               $("#med_int_comp").val(p[3]);
               $("#idins").val(p[7]);
               //console.log(p[4]);
               alert('Sa agrego con exito');
               extras_comp();
               totalizar();
            } 
        });
    }
    function limpiar_form_extra(){
         $("#idins").val('');
         $("#extra_comp").val('');
         //$("#extra_codigo").val('');
         $("#extra_comp").val('');
         $("#mtc_int_comp").val('');
         $("#precio_unidad").val('');
         $("#precio_total").val('');
         $("#modalmasacc").modal('hide');
    }
    function extras_comp(){
        var dtx = $("#item").val();
        var can = $("#cantidad").val();
        $.ajax({
             post:'GET',
             data:'dtx='+dtx+'&can='+can+'&sw=29',
             url:'acciones.php',
             success : function(r){
                 //console.log('paso '+dtx+' - '+r);
                 $("#mostrar_comp_extra").html(r);
             }
         });
    }
    function mas_acc(n){
        var tesp = $("#totalesp").val();
        $("#modalmasacc").modal('show');
         var item = $("#iteme"+n).val();
         var inter = $("#inter"+n).val();
         $("#extra_item").val(item);
         $("#extra_codigo").val(inter);
         var idpp = $("#idpp"+n).val();
          var codigo = $("#codigo0").val();
          //console.log(idpp);
         $.ajax({
             post:'GET',
             data:'codigo='+codigo+'&codigoitem='+inter+'&item='+item+'&idpp='+idpp+'&sw=26',
             url:'acciones.php',
             success : function(r){
                 $("#extra_comp").html(r);
             }
         });
         
    }
    function borrar_comp(id){
         var item = $("#item").val();
         var c = confirm("Esta seguro de eliminar este item?");
         if(c){
            $.ajax({
                 post:'GET',
                 data:'id='+id+'&sw=30',
                 url:'acciones.php',
                 success : function(r){
                     DatosBasicos();
                 }
             });
       }
    }
    function calcular_item(n,item,gen){
        var cant = $("#cant"+n).val();
        var ancho = $("#ancho"+n).val();
        var alto = $("#alto"+n).val();
        var per = $("#per"+n).val();
        var boq = $("#boq"+n).val();
        var desc = $("#desc"+n).val();
        var cod = $("#cod"+n).val();
        var itemv = $("#tipo"+n).val();
        var ubc = $("#ubc"+n).val();
        var obse = $("#obse"+n).val();
        var por_vid = $("#desperdicio").val();
        var por_alu = $("#desperdicio_al").val();
        var por_acc =$("#desperdicio_acc").val();
        var por_ace= $("#desperdicio_ace").val();
        var por_esp =$("#desperdicio_esp").val();
        var por_int= $("#desperdicio_int").val();
        var utilidad= $("#utilidad").val();
        var pel = $("#pel").val();
        var ins = $("#ins").val();

        //alert(por_vid);
        $.ajax({
                 post:'GET',
                 data:'item='+item+'&utilidad='+utilidad+'&gen='+gen+'&ubc='+ubc+'&por_esp='+por_esp+'&por_int='+por_int+'&obse='+obse+'&itemv='+itemv+'&cod='+cod+'&pel='+pel+'&ins='+ins+'&cant='+cant+'&ancho='+ancho+'&alto='+alto+'&per='+per+'&boq='+boq+'&desc='+desc+'&por_vid='+por_vid+'&por_alu='+por_alu+'&por_acc='+por_acc+'&por_ace='+por_ace,
                 url:'planeacion/ventas/calcular_general.php',
                 success : function(r){
                   //console.log(r);
                   var p = eval(r);
                   
                   
                   
                   $("#pud"+n).val(p[0]);
                   $("#ptd"+n).val(p[1]);
                   $("#piva"+n).val(p[2]);
                   sumar_item_cot();
                 }
             });
        
    }
        function update_costo_por_item(){
            if(!navigator.onLine){
                alert('uff sin conexion :(');
                return false;
            }
            
            var cant = $("#cantidad").val();
            var ancho = $("#ancho").val();
            var alto = $("#alto").val();
            var per = $("#perforacion").val();
            var boq = $("#boquetes").val();
            var desc = $("#descripcion_final").val();
            var cod = $("#codigo0").val();
            var itemv = $("#tipos").val();
            var ubc = $("#ubicacion").val();
            var obse = $("#observacion").val();
            var por_vid = $("#desperdicio").val();
            var por_alu = $("#desperdicio_al").val();
            var por_acc =$("#desperdicio_acc").val();
            var por_ace= $("#desperdicio_ace").val();
            var por_esp =$("#desperdicio_esp").val();
            var por_int= $("#desperdicio_int").val();
            var pel = $("#pelicula").val();
            var ins = $("#instalacion").val();
            var comision = $("#comision").val();
            var reposicion = $("#reposicion").val();
            var imprevisto = $("#imprevisto").val();
            var utilidad = $("#utilidad").val();
            var item = $("#item").val();
            var cot = $("#cot").val();
            if(item===''){
                return false;
            }
            idglobal=item;
            $.ajax({
                     post:'GET',
                     data:'item='+item+'&ubc='+ubc+'&por_esp='+por_esp+'&por_int='+por_int+'&obse='+obse+'&itemv='+itemv+'&cod='+cod+'&pel='+pel+'&ins='+ins+'&cant='+cant+'&ancho='+ancho+'&alto='+alto+'&per='+per+'&boq='+boq+'&desc='+desc+'&comision='+comision+'&reposicion='+reposicion+'&imprevisto='+imprevisto+'&utilidad='+utilidad+'&por_vid='+por_vid+'&por_alu='+por_alu+'&por_acc='+por_acc+'&por_ace='+por_ace,
                     url:'calcular_general.php',
                     success : function(r){
                        window.opener.mostrar_items(cot);
                       var p = eval(r);
                       //console.log('resultado calculo general: '+p[3]);
                       DatosBasicos();
                     }
                 });
        
    }
    function update_costo_general(){
         var idcot = $("#idcot").val();
         var por_vid = $("#desperdicio").val();
         var por_alu = $("#desperdicio_al").val();
         var por_acc =$("#desperdicio_acc").val();
         var por_ace= $("#desperdicio_ace").val();
         var por_esp =$("#desperdicio_esp").val();
         var por_int= $("#desperdicio_int").val();
         var utilidad= $("#utilidad").val();
              $.ajax({
                 post:'GET',
                 data:'idcot='+idcot+'&utilidad='+utilidad+'&por_vid='+por_vid+'&por_alu='+por_alu+'&por_acc='+por_acc+'&por_ace='+por_ace+'&por_int='+por_int+'&por_esp='+por_esp+'&sw=33',
                 url:'planeacion/ventas/acciones.php',
                 success : function(r){
                     //console.log(r);
                 }
             });
         
    }
    function totalizar_2(){
     var t_alu = 0;
     var t_vid = $("#ttot").val();
     var t_acc = parseFloat($("#total_comp").val()) + parseFloat($("#tacc").val());
     var t_mob = 0;
     var t_ins = 0;
     var t_pol = $("#tot_peli").val();
     var gt = $("#subtotal2").val();
     var d = ($("#descuento").val()/100);
     var item = $("#item").val();
             $.ajax({
                    type:'GET',
                    data:'gt='+gt+'&item='+item+'&t_alu='+t_alu+'&t_vid='+t_vid+'&t_acc='+t_acc+'&t_mob='+t_mob+'&t_ins='+t_ins+'&t_pol='+t_pol,
                    url:'calculo_costo.php',
                    success : function(t){
                          $("#subtotal").val(t);
                           totaldes = t * d;
                           totalr = parseFloat(t) + parseFloat(totaldes);
                           //console.log(totaldes);
                           iva = (totalr * 0.19);
                           gt = parseFloat(totalr + iva);
                          $("#tdescuento").val(totaldes.toFixed(2));
                           $("#subtotal2").val(totalr.toFixed(2));
                           $("#iva").val(iva.toFixed(2));
                           $("#gran_total").val(gt.toFixed(2));
                    }
                });
     
     //window.open("../costos/planilla_costo.php?gt="+gt+"&t_alu="+t_alu+"&t_vid="+t_vid+"&t_acc="+t_acc+"&t_mob="+t_mob+"&t_ins="+t_ins+"&t_pol="+t_pol,"terceros","width=1200,height=800");
}
    function sumar_item_cot(){
            var total = 0;
            var stotal = 0;
            var can = 0;
            var id = $("#ct").val();
      for(i=1; i<=id; i++){
				
                                var tot = $("#ptd"+i).val();
                                var tiva = $("#piva"+i).val();
                                can = parseFloat(can) + parseFloat($("#cant"+i).val());
                                stotal = parseFloat(stotal) + parseFloat(tot);
                                total = parseFloat(total) + parseFloat(tiva);
		};
                $("#subgrantotal").val(stotal);
                $("#grantotal").val(total);
                 $("#cantotal").val(can);
                 
                 $("#gran_subtotal").val(stotal);
                  $("#gran_iva").val((total-stotal).toFixed(2));
                $("#gran_totalpagar").val(total);
                 
    }
      function update_costo(gen){
          if(!navigator.onLine){
                alert('uff sin conexion :(');
                return false;
            }
            
          var ca = $("#ct").val();
          for(i=1; i<=ca; i++){
              var id = $("#idtem"+i).val();
              calcular_item(i,id,gen);
              
          }
          
      }
      function sumar_p(){
           var a = $("#comision").val();
            var b = $("#reposicion").val();
             var c = $("#imprevisto").val();
              var d = $("#utilidad").val();
              var t = parseFloat(a) + parseFloat(b)+parseFloat(c)+parseFloat(d);
              $("#tp").val(t);
      }
function tabla_espaciadores(n){ 
      var cod = $("#codigo0").val();
      window.open("../popup/interlayer/index.php?cod="+cod+"&num="+n,"Imprimir","width=900,height=600");
}
function obtener_inter(cod,des,n,tipo){
    $("#inter"+n).val(cod);
    $("#interdes"+n).val(des);
    $("#tipomat"+n).val(tipo);
    var por_esp =$("#desperdicio_esp").val();
    var por_int= $("#desperdicio_int").val();
    if(tipo=='espaciadores'){
        $("#desp_mat"+n).val(por_esp);
    }else{
        $("#desp_mat"+n).val(por_int);
    }
    
    precios_interlayer(n);
    
}
function camiva(){
    var iva = $("#iva").val();
    var idcot = $("#idcot").val();
    $.ajax({
                 post:'GET',
                 data:'idcot='+idcot+'&iva='+iva+'&sw=37',
                 url:'planeacion/ventas/acciones.php',
                 success : function(r){
                     mostrar_items(idcot);
                 }
             });
}
function generar_aprobar(){
    var cot = $("#idcot").val();
    var c = confirm("Esta seguro de generar el pedido?");
    if(c){
        $.ajax({
                 post:'GET',
                 data:'cot='+cot+'&sw=1',
                 url:'planeacion/ventas/modelo.php',
                 success : function(r){
                     alert(r);
                     cargar_cotizacion_pla(cot);
                 }
             });
    }
}
 function generar_orden_produccion(){
     var ped = $("#ped").val();
     $("#pednum").val(ped);
    $("#modalorden").modal('show');

}    
function generarorden(){
    var ped = $("#ped").val();
    var cot = $("#idcot").val();
    var opf = $("#opf").val();
    
    if(opf==''){
        alert("¡Debes de digitar la orden de fom!");
        $("#opf").focus();
        return false;
    }
    var c = confirm("Esta seguro de generar la orden de produccion?");
    if(c){
    $("#modalorden").modal('hide');
    $.ajax({
                 post:'GET',
                 data:'cot='+cot+'&ped='+ped+'&opf='+opf+'&sw=2',
                 url:'planeacion/ventas/modelo.php',
                 success : function(r){
                     var p = eval(r);
                     console.log(p);
                     alert('Se ha generado la Orden de Produccion No.'+p[0]);
                     ver_orden(p[1],p[0]);
                 }
             });
         }

}

