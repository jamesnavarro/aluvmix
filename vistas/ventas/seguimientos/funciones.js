 $(function(){
     $("#mostrar_tabla").html(mostrar_seguimientos(1)); 
      $('#fechas').change(function(){
        mostrar_seguimientos(1);
 }); 
});

function guardar_segui(){ 
     var ra = $("#rad_seg").val();
//     if (ra!==''){
//         alert('ya esta cotizacion tiene seguimiento');
//         return false;
//     }
     var id = $("#id_seg").val();
     var nom = $("#nomb_obra").val();
     var no= $("#nom_cli").val();
     var dire = $("#dir_obra").val();
     var direc = $("#dir_cli").val();
     var te = $("#tel_obra").val();
     var dep = $("#depa_cli").val();
     var dp = $("#depa_obra").val();
     var ciu = $("#ciu_cli").val();
     var cid = $("#ciu_obra").val();
     var cont = $("#conta_cli").val();
     var encar = $("#encar_obra").val(); 
     var tlf = $("#tel_cli").val();
     var ana = $("#analis_obra").val();
     var contc = $("#cont_clie").val();
     var va = $("#vali_obra").val();
     var ema = $("#emai_cli").val();
     var pag = $("#pag_obra").val();
     var vendr = $("#vend_cli").val();
     var prec = $("#prec_seg").val();
     var iva = $("#iva_seg").val();
     var cedu = $("#ced_temp").val();
     var nombr = $("#nom_temp").val();
     var exp = $("#exp_tem").val();
     var fe = $("#fecha_temp").val();
     var se = $("#desc_seg").val();
     var reg_sis = $("#regis_se").val();
     var fec_sis = $("#fecha_seg").val();
     var ncot = $("#num_cot_s").val();
     var vercot = $("#ver_s").val();
     var estad_cseg = $("#estad_csegui").val();
     var linsegg = $("#linea_seguim").val();
     var adic = $("#adicional").val();
     var fechasis = $("#fecha_sis").val();
     if(adic===''){
         alert("¡Debes de seleccionar si es adicional o no!");
         $("#adicional").focus();
         return false;
     }
      $("#btn_guardar").attr("disabled",true);
 
        $.ajax({
            type: 'GET',
            data: 'radi='+ra+'&seg_ids='+id+'&nom_oo='+nom+'&nom_cc='+no+'&dir_oo='+encodeURIComponent(dire)+'&dir_cc='+encodeURIComponent(direc)+'&tell='+encodeURIComponent(te)+'&dep_cc='+dep+'&dep_oo='+dp+'&ciu_cc='+ciu+'&ciu_oo='+cid+'&conta_cc='+cont+'&encar_oo='+encar+'&tel_cc='+tlf+'&anali_oo='+ana+'&cont_cc='+contc+'&vali_oo='+va+'&email_cc='+encodeURIComponent(ema)+'&pag_oo='+pag+'&vend_cc='+vendr+'&prec_ss='+encodeURIComponent(prec)+'&iva_see='+iva+'&ced_tt='+cedu+'&nom_tt='+encodeURIComponent(nombr)+'&exp_tt='+exp+'&fecha_tt='+fe+'&desc_see='+se+'&reg_sist='+reg_sis+'&fec_sist='+fec_sis+'&ncott='+ncot+'&vercott='+vercot+'&estad_csegg='+estad_cseg+'&linseggs='+linsegg+'&adics='+adic+'&fechasiss='+fechasis+'&sw=1',
            url: '../../ventas/seguimientos/acciones.php', 
            success: function(resultado){
                $("#rad_seg").val(resultado); 
                alert("Se guardo seguimiento con exito");
                 $("#btn_guardar").attr("disabled",true);
                mostrar_segui(1);
            }
           });
}

 function mostrar_seguimientos(page){
    var ra = $("#id_seg").val();
    var cha = $("#fechas").val();
 
        $.ajax({
            type: 'GET',
            data: 'page='+page+'&nuefecha='+cha+'&rad='+ra,
            url: '../../ventas/seguimientos/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
  }); 
}

function guardar_seguimientos(){
    var prin = $("#id_prin").val();
    var segui_c = $("#seguim_cot").val();
    var radic = $("#id_seg").val();
    var rad = $("#rad_seg").val();
    if (rad===''){
        alert('No se encontro cotizacion para hacer seguimiento debe guardar la cotizacion primero'); 
        return false;
    }
    var reg = $("#regis_se_nu").val();
    var fec = $("#fecha_seg_nu").val();
     if(segui_c===''){
         alert("¡El campo esta vacio!");
         $("#seguim_cot").focus();
         return false;
     }
       $("#btn_guardard").attr("disabled",true);
    $.ajax({
            type: 'GET',
            data: 'pr='+prin+'&segui_cc='+segui_c+'&radics='+radic+'&regg='+reg+'&fecc='+fec+'&sw=2',
            url: '../../ventas/seguimientos/acciones.php', 
            success: function(resultado){
                $("#id_prin").val(resultado); 
                alert("Se guardo con exito");
                 $("#btn_guardard").attr("disabled",false);
               mostrar_seguimientos(1);
            }
           });
}

function editar(id){
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=3',  //
        url: '../../ventas/seguimientos/acciones.php', //
        success: function(resultado){
  var p = eval(resultado);
 $("#id_prin").val(p[0]);
 $("#seguim_cot").val(p[1]); 
 
 }
 });
}

function guardar_esta_cot(){
     var est_nu = $("#estad_csegui_nu").val();
     var rad = $("#rad_seg").val();
     $.ajax({
        type: 'GET',
        data: 'id='+rad+'&estado='+est_nu+'&sw=4',  //
        url: '../../ventas/seguimientos/acciones.php', //
        success: function(resultado){
alert('se cambio satisfactoriamente el estado de la cotizacion');
 }
 });
}

function limpiar_seguimiento(){
     $("#id_prin").val(''); 
      $("#seguim_cot").val(''); 
}
 
function nuevo(){
    limpiar_seguimiento();
}

function ver_repor(repor){
     window.open("../../ventas/seguimientos/reportes.php?cotis"+repor,"muestrare","width=900, height=600")
}

function embudo(){
     window.open("../../../obras/vistas/?id=index","ire","width=900, height=600")
}

function borrars(id){
     var c = confirm("Se eliminara este seguimiento de la cotizacion desea continuar?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=6',  //
            url: '.../../ventas/seguimientos/acciones.php', //
            success: function(resultado){
                alert("se elimino con exito");
                mostrar_seguimientos(1);
            }
           });
       }
}
 
 
function cot(cotizaciones){
     window.open("../../vistas/?id=new_fac&cot="+cotizaciones+"&cli=0","muestrados","width=1000, height=600");
}
 
