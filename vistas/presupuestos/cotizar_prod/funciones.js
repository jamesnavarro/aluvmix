 
$(function(){
     $("#mostrar_tabla").html(mostrar_cotn(1)); 
});
 
function mostrar_cotn(page){
    
        $.ajax({
            type: 'GET',
            data: 'page='+page,
            url: '../vistas/crear_cot/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
  }); 
}
function guardar_prodcdos(){ 
     var idp= $("#id_pro").val();
     var siste = $("#sistema").val(); 
     var ancgeneral= $("#anc_general").val();
     var archi = $("#archivo").val();
     var tipos = $("#tipo").val();
     var algenera = $("#alt_gener").val();
     var descrip = $("#descripcion").val();
     var alrejilla = $("#alt_rejilla").val();
     var refer = $("#referencia").val();
     var confi = $("#configuracion").val();
     var conftext = $("#confi_text").val();
     var cant = $("#cantidad").val();
     var tipvid = $("#tipo_vid").val();
     var espsorvi = $("#espesor_vid").val();
     var tipriel = $("#tipo_riel").val();
     var alfa = $("#tipo_alfa").val();
     var ancmed = $("#ancho_med").val();
     var ancmm = $("#ancho_mm").val();
     var tipreji = $("#tipo_rejilla").val();
     var allmed = $("#alto_med").val();
     var altmm = $("#alto_mm").val();
     var tipcie = $("#tipo_cie").val();
     var cuerf = $("#cuerpo_fij").val();
     
        
    if(siste===''){
        sweetAlert("codigo del producto");
        $("#sistema").focus();
        return false;
    }
      if(ancgeneral===''){
        sweetAlert("codigo del producto");
        $("#anc_general").focus();
        return false;
    }
      if(archi===''){
        sweetAlert("codigo del producto");
        $("#archivo").focus();
        return false;
    }
      if(tipos===''){
        sweetAlert("codigo del producto");
        $("#tipo").focus();
        return false;
    }
      if(algenera===''){
        sweetAlert("codigo del producto");
        $("#alt_gener").focus();
        return false;
    }
     if(descrip===''){
        sweetAlert("nombre del producto");
        $("#descripcion").focus();
        return false;
    }
     if(alrejilla===''){
        sweetAlert("referencia");
        $("#alt_rejilla").focus();
        return false;
    }
      if(refer===''){
        sweetAlert("codigo del producto");
        $("#referencia").focus();
        return false;
    }
      if(confi===''){
        sweetAlert("codigo del producto");
        $("#configuracion").focus();
        return false;
    }
      if(conftext===''){
        sweetAlert("codigo del producto");
        $("#confi_text").focus();
        return false;
    }
        if(cant===''){
        sweetAlert("codigo del producto");
        $("#cantidad").focus();
        return false;
    }
        if(tipvid===''){
        sweetAlert("codigo del producto");
        $("#tipo_vid").focus();
        return false;
    }
        if(espsorvi===''){
        sweetAlert("codigo del producto");
        $("#espesor_vid").focus();
        return false;
    }
        if(tipriel===''){
        sweetAlert("codigo del producto");
        $("#tipo_riel").focus();
        return false;
    }
         if(alfa===''){
        sweetAlert("codigo del producto");
        $("#tipo_alfa").focus();
        return false;
    }
         if(ancmed===''){
        sweetAlert("codigo del producto");
        $("#ancho_med").focus();
        return false;
    }
          if(ancmm===''){
        sweetAlert("codigo del producto");
        $("#ancho_mm").focus();
        return false;
    }
          if(tipreji===''){
        sweetAlert("codigo del producto");
        $("#tipo_rejilla").focus();
        return false;
    }
          if(allmed===''){
        sweetAlert("codigo del producto");
        $("#alto_med").focus();
        return false;
    }
        if(altmm===''){
        sweetAlert("codigo del producto");
        $("#alto_mm").focus();
        return false;
    }
    if(tipcie===''){
        sweetAlert("codigo del producto");
        $("#tipo_cie").focus();
        return false;
    }
    if(cuerf===''){
        sweetAlert("codigo del producto");
        $("#cuerpo_fij").focus();
        return false;
    }
  
        $.ajax({
            type: 'GET',
            data: 'idp='+idp+'&siste='+siste+'&ancgeneral='+ancgeneral+'&archi='+archi+
                  '&tipos='+tipos+'&algenera='+algenera+'&descrip='+descrip+'&alrejilla='+alrejilla+
                  '&refer='+refer+'&confi='+confi+'&conftext='+conftext+
                  '&cant='+cant+'&tipvid='+tipvid+'&espsorvi='+espsorvi+
                  '&tipriel='+tipriel+'&alfa='+alfa+'&ancmed='+ancmed+
                  '&ancmm='+ancmm+'&tipreji='+tipreji+'&allmed='+allmed+'&altmm='+altmm+'&tipcie='+tipcie+
                  '&cuerf='+cuerf+'&sw=1',
            url: '../vistas/crear_cot/acciones.php', 
            success: function(resultado){
                $("#id_pro").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_tabla(1);
            }
           });
}
function Formularioaluminio(){
   
}
function limpiar_cotn(){
 $("#id_pronue").val(''); 
 $("#lineaprod").val('');
 $("#codnupro").val('');
 $("#ancnup").val('');
 $("#nom_pronue").val('');
 $("#alt_nuep").val('');
 $("#ref_pronue").val('');
 $("#kit_nue").val('');
 $("#perfo_pronue").val('');
 $("#boque_nuep").val('');
 $("#alcu_pronue").val('');
 $("#alven_nuep").val('');
 $("#modn_nuep").val('');
 $("#ancf_pronue").val('');
 $("#alvendos_nuep").val('');
 $("#lami_nuep").val('');
 $("#ancmax_pronue").val('');
 $("#altmax_nuep").val('');
 $("#id_ok").val('');
 $("#btn_ok").html('');
 $("#apro_id").html('');
 $("#btn_apro").html('');
 $("#aprobado_id").html('');
 $("#btn_aproba").html('');
 $("#id_revi").html('');
 $("#btn_rev").html('');
 $("#id_actu").html('');
 $("#btn_actua").html('');
}

function nuevo(){
    limpiar_cotn();
}

function editar(id){
    $("#marcar1").attr("class","");
    $("#marcar2").attr("class","active");
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/conf_dolar/acciones.php', //
        success: function(resultado){
  var p = eval(resultado);

 $("#id_pronue").val(p[0]); 
 $("#lineaprod").val(p[1]);
 $("#codnupro").val(p[2]);
 $("#ancnup").val(p[3]);
 $("#nom_pronue").val(p[4]);
 $("#alt_nuep").val(p[5]);
 $("#ref_pronue").val(p[6]);
 $("#kit_nue").val(p[7]);
 $("#perfo_pronue").val(p[8]);
 $("#boque_nuep").val(p[9]);
 $("#alcu_pronue").val(p[10]);
 $("#alven_nuep").val(p[11]);
 $("#modn_nuep").val(p[12]);
 $("#ancf_pronue").val(p[13]);
 $("#alvendos_nuep").val(p[14]);
 $("#lami_nuep").val(p[15]);
 $("#ancmax_pronue").val(p[16]);
 $("#altmax_nuep").val(p[17]);
 $("#id_ok").val(p[18]);
 $("#btn_ok").html(p[19]);
 $("#apro_id").html(p[20]);
 $("#btn_apro").html(p[21]);
 $("#aprobado_id").html(p[22]);
 $("#btn_aproba").html(p[23]);
 $("#id_revi").html(p[24]);
 $("#btn_rev").html(p[25]);
 $("#id_actu").html(p[26]);
 $("#btn_actua").html(p[27]);
 }
 });
}

function borrar(id){
     var c = confirm("Esta seguro de eliminar esta referencia?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/conf_dolar/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_doll(1);
            }
           });
       }
}
function okr(id,ok){
    var con = confirm("Estas seguro de que revisaste este items?");
    if(con){
        $.ajax({
        type:'GET',
        data:'id='+id+'&ok='+ok+'&sw=4',
        url:'../vistas/crear_cot/acciones.php',
        success : function(d){
            alert("Se Reviso con exito");
            $("#id_ok").html(d);
            consultar_prod(id);
        }
    });
    }
}
function anular(id,ok){
    var con = confirm("Estas seguro de cambiar el estado este producto?");
    if(con){
        $.ajax({
        type:'GET',
        data:'id='+id+'&ok='+ok+'&sw=5',
        url:'../vistas/crear_cot/acciones.php',
        success : function(d){
            alert("Se guardo con exito");
            $("#apro_id").html(d);
            consultar_prod(id);
        }
    });
    }
}

function aprobado(id,ok){
    var con = confirm("Se ha modificado la DT");
    if(con){
        $.ajax({
        type:'GET',
        data:'id='+id+'&ok='+ok+'&sw=6',
        url:'../vistas/crear_cot/acciones.php',
        success : function(d){
            alert("Se guardo con exito");
            $("#aprobado_id").html(d);
            consultar_prod(id);
        }
    });
    }
}
function revisar(id,ok){
    var con = confirm("Se ha modificado la DT");
    if(con){
        $.ajax({
        type:'GET',
        data:'id='+id+'&ok='+ok+'&sw=7',
        url:'../vistas/crear_cot/acciones.php',
        success : function(d){
            alert("Se guardo con exito");
            $("#id_revi").html(d);
            consultar_prod(id);
        }
    });
    }
}
function actualizado(id,ok){
    var con = confirm("Se ha modificado la DT");
    if(con){
        $.ajax({
        type:'GET',
        data:'id='+id+'&ok='+ok+'&sw=8',
        url:'../vistas/crear_cot/acciones.php',
        success : function(d){
            alert("Se guardo con exito");
            $("#id_actu").html(d);
            consultar_prod(id);
        }
    });
    }
}

function sel(c){
formu=document.forms['formulario'];
caracteres=c.length;
if(caracteres!=0){
for (x=0;x<formu['ref_mo'].options.length;x++){
if(formu['ref_mo'].options[x].value.slice(0,caracteres)==c){
formu['ref_mo'].selectedIndex=x;
formu['ref_mo'].style.visibility="visible";
break;
}else{
formu['ref_mo'].style.visibility="hidden";
}
}
}else{
formu['ref_mo'].style.visibility="hidden";

}
}
function historial(id){
    window.open("../vistas/historial.php?cod="+id,"Historial","width= 800px , height=600px");
}


$(document).ready(function(){
    var pro = $("#pro_des").val();
   $("#mostrar_desgloses").load(desgloses(pro));

   $("#ref").click(function () {
   	window.open("../popup/cuentas.php","Registro","width=600 , height=600 ");
   });
});




