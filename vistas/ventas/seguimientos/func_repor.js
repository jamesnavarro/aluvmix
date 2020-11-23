 $(function(){
     $("#mostrar_tabla").html(mostrar_reportes(1)); 
      $('#coti').change(function(){
        mostrar_reportes(1);
      }); 
       $('#nombre').change(function(){
        mostrar_reportes(1);
      }); 
       $('#fecha').change(function(){
        mostrar_reportes(1);
      }); 
      $('#asesor').change(function(){
        mostrar_reportes(1);
      }); 
       $('#estado_cs').change(function(){
        mostrar_reportes(1);
      }); 
        $('#linea_segui').change(function(){
        mostrar_reportes(1);
      }); 
      $('#valor').change(function(){
        mostrar_reportes(1);
      }); 
      $('#filtro').change(function(){
        mostrar_reportes(1);
      });
         $('#fecfin').change(function(){
        mostrar_reportes(1);
      }); 
});
  
function mostrar_reportes(page){
    var ncot = $("#coti").val();
    var nom = $("#nombre").val();
    var fec = $("#fecha").val();
    var ase = $("#asesor").val();
    var est = $("#estado_cs").val();
    var lin = $("#linea_segui").val();
    var valor = $("#valor").val();
    var filtro = $("#filtro").val();
    var ffin = $("#fecfin").val();
    console.log(nom);
    $.ajax({
        type: 'GET',
        data: 'ncotc='+ncot+'&nomc='+nom+'&fecc='+fec+'&asee='+ase+'&filtro='+filtro+'&estc='+est+'&valor='+valor+'&linss='+lin+'&ffinn='+ffin+'&page='+page,
        url: 'lista_repor.php',
        success: function(resultado){
        $("#mostrar_tabla").html(resultado);
        }
  }); 
}

function ver(cotizacion){
     window.open("../../vistas/seguimientos/index.php?cotis="+cotizacion, "muestra","width=1100, height=600");
}
   
function cot(cotizaciones){
     window.open("../presupuesto/cotizaciones/?id=new_fac&cot="+cotizaciones+"&cli=0","muestrados","width=1000, height=600");
}
  
function borrar(id,id_co){
     var c = confirm("Esta seguro de eliminar este seguimiento?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&id_cot='+id_co+'&sw=5',  //
            url: '../vistas/ventas/seguimientos/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_reportes(1);
            }
           });
       }
}

  function pasar(ra,id){
      $("#rad").val(id);
      $("#id_s").val(ra);
      limpiar();
  }
  
  function guardar_seguimientos(){
    var prin = $("#id_prin").val();
    var segui_c = $("#seguim_cot").val();
    var rad = $("#rad").val();
    var radic = $("#id_s").val();

    if (rad===''){
        alert('No se encontro cotizacion para hacer seguimiento debe guardar la cotizacion primero'); 
        return false;
    }
    
    if (segui_c===''){
        alert('Escribe algo..!'); 
        return false;
    }
    var reg = $("#regis_se_nu").val();
    var fec = $("#fecha_seg_nu").val();
    var p = $("#page").val();
//       $("#btn_guardard").attr("disabled",true);
console.log(prin+' - '+segui_c+' - '+rad+' - '+radic);
    $.ajax({
            type: 'GET',
            data: 'pr='+prin+'&segui_cc='+segui_c+'&radics='+radic+'&regg='+reg+'&fecc='+fec+'&sw=2',
            url: '../vistas/ventas/seguimientos/acciones.php', 
            success: function(resultado){
                $("#id_prin").val(resultado); 
                alert("Se guardo con exito");
                $("#btn_guardard").attr("disabled",false);
                 mostrar_reportes(p);
            }
           });
}
function limpiar(){
    $("#id_prin").val('');
    $("#seguim_cot").val('');

}
  
  
  
  
  
  
  
  
  
  
  