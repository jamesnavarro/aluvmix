 
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
function guardar_cotn(){ 
     var id_pronuen = $("#id_pronue").val(); 
     var lineaprodn = $("#lineaprod").val();
     var codnupron = $("#codnupro").val();
     var ancnupn = $("#ancnup").val();
     var nom_pronuen = $("#nom_pronue").val();
     var alt_nuepn = $("#alt_nuep").val();
     var ref_pronuen = $("#ref_pronue").val();
     var kit_nuen = $("#kit_nue").val();
     var perfo_pronuen = $("#perfo_pronue").val();
     var boque_nuepn = $("#boque_nuep").val();
     var alcu_pronue = $("#alcu_pronue").val();
     var alven_nuepn = $("#alven_nuep").val();
     var modn_nuepn = $("#modn_nuep").val();
     var ancf_pronuen = $("#ancf_pronue").val();
     var alvendos_nuep = $("#alvendos_nuep").val();
     var lami_nuepn = $("#lami_nuep").val();
     var ancmax_pronuen = $("#ancmax_pronue").val();
     var altmax_nuepn = $("#altmax_nuep").val();
     var ok_id = $("#id_ok").val();
     var apro_id = $("#apro_id").val();
     var aproba_id = $("#aprobado_id").val();
     var revi_id = $("#id_revi").val();
     var actu_id = $("#id_actu").val();
     
        
    if(codnupron===''){
        sweetAlert("codigo del producto");
        $("#codnupro").focus();
        return false;
    }
     if(nom_pronuen===''){
        sweetAlert("nombre del producto");
        $("#nom_pronue").focus();
        return false;
    }
     if(ref_pronuen===''){
        sweetAlert("referencia");
        $("#ref_pronue").focus();
        return false;
    }
  
        $.ajax({
            type: 'GET',
            data: 'idcotn='+id_pronuen+'&lineaprodnc='+lineaprodn+'&codnupronc='+codnupron+'&ancnupnc='+ancnupn+'&nom_pronuenc='+nom_pronuen+'&alt_nuepnc='+alt_nuepn+'&ref_pronuenc='+ref_pronuen+'&kit_nuenc='+kit_nuen+'&perfo_pronuenc='+perfo_pronuen+'&boque_nuepnc='+boque_nuepn+'&alcu_pronuec='+alcu_pronue+'&alven_nuepnc='+alven_nuepn+'&modn_nuepnc='+modn_nuepn+'&ancf_pronuenc='+ancf_pronuen+'&alvendos_nuepc='+alvendos_nuep+'&lami_nuepnc='+lami_nuepn+'&ancmax_pronuenc='+ancmax_pronuen+'&altmax_nuepnc='+altmax_nuepn+'&ok_idk='+ok_id+'&apr_id='+apro_id+'&id_aproba='+aproba_id+'&revisar_id='+revi_id+'&id_aactu='+actu_id+'&sw=1',
            url: '../vistas/crear_cot/acciones.php', 
            success: function(resultado){
                $("#id_pronue").val(resultado); 
                sweetAlert("Se guardo con exito");
                mostrar_tabla(1);
            }
           });
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




