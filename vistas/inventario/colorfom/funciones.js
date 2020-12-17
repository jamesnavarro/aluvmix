//PRIMERA TABLA CONTROLER INDEX
$(function(){
   con_fom_cod(1);

 });  

function mostrar_line2(page){
        var cod = $("#cod2").val();
        var des = $("#des2").val();
        var col = $("#col2").val();
        var est = $("#est2").val();
        var ref = $("#refe2").val();
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&des='+des+'&est='+est+'&ref='+ref+'&col='+col+'&page='+page,
                url: '../vistas/inventario/colorfom/lista2.php',
            success: function(d){
                $("#mostrar_tabla2").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
}
function buscar_cod(){
       var cod = $("#codxa").val();
       $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&sw=1',
                url: '../vistas/inventario/colorfom/acciones.php',
         success: function(t) {
             var t = eval(t);
              $("#codxa").val(cod);
              $("#refxa").val(t[1]);
              $("#nomxa").val(t[2]); 
              $("#artxa").val(t[3]);
              $("#colxa").val(t[4]);
              $("#anchoxa").val(t[5]); 
              $("#altoxa").val(t[6]);
              $("#espxa").val(t[7]);
              $("#arexa").val(t[8]); 
              $("#pesxa").val(t[9]);
              $("#stc_max").val(t[10]); 
              $("#stc_min").val(t[11]);
              $("#stc_seg").val(t[12]); 
              $("#cospa").val(t[13]);
              $("#obsxa").val(t[14]);  
              $("#cla_xa").val(t[15]);  
              $("#gru_xa").val(t[16]);  
         }
     });
}
function paginacion(p){
    var page = $("#page").val();
    var t = parseInt(page) + parseInt(p);
    if(t==0){
        con_fom_cod(1);
    }else{
        con_fom_cod(t);
        $("#page").val(t);
    }
    
}
function con_fom_cod(page){
    var cod = $("#buscar").val();
    if(cod==''){
        cod='*';
    }else{
        cod=cod;
    }
    $("#page").val(page);
    $("#mostrar_tabla2").html('<tr><td colspan="2">Cargando<img src="../images/load.gif"></td>');
      $.ajax({
          type:'GET',
          url:'http://172.16.0.30:8989/api/MAELOTE/'+cod+'/'+page+'/100',
          dataType: 'json',
          success: function(da){
            
              //console.log('Resultado: '+da);
              render = "";
              $.each(da, function(i, item) {
                //console.log(item);
                render+= showRow(i,item);
              });
              $('#mostrar_tabla2').html(render);
          }
        
      });
  }
  function showRow(i, dev){
      consultar_cod_alu(dev.LOT_CODIGO);
  var row = '<tr id="v'+dev.LOT_CODIGO+'">'+
              '<td>'+dev.LOT_CODIGO+'\
<input type="hidden" id="ced'+dev.LOT_CODIGO+'" value="'+dev.LOT_CODIGO+'">\
</td>'+

              '<td style="text-align:center" id="ch'+dev.LOT_CODIGO+'"><input type="checkbox" name="item" id="'+dev.LOT_CODIGO+'" value="'+dev.LOT_CODIGO+'"></td>\n\
</tr>';
  return row;

}
function consultar_cod_alu(cod){
    
          $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&sw=1',
                url: '../vistas/inventario/colorfom/acciones.php',
                success: function(t) {
                   var t = eval(t);
                  
                      if(t[0]!=null){
                           $("#ch"+cod).html('');
                      }
         }
     });
}
function marcar(source) 
	{
		checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
		for(i=0;i<checkboxes.length;i++) //recoremos todos los controles
		{
			if(checkboxes[i].type == "checkbox") //solo si es un checkbox entramos
			{
				checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
			}
		}
	}
        
        function agregar_cod_pro(){
            var c = confirm("Esta seguro de sincronizar los proveedores desde fomplus?");
            if(c){
            $("input[name=item]:checked").each(function(){
				var id = $(this).attr("id");
                                var ced = $("#ced"+id).val();
                                var nom = $("#nom"+id).val();
                                var tel = $("#tel"+id).val();
                                 var ema = $("#ema"+id).val();
                             var use = $("#use"+id).val();
                                 $.ajax({
                                        type: 'GET',
                                        data: 'ced='+ced+'&nom='+nom+'&tel='+tel+'&ema='+ema+'&use='+use+'&sw=2',
                                        url: '../vistas/inventario/colorfom/acciones.php',
                                        success: function(t) {
                                            console.log(ced+' : '+t);
                                            $("#ch"+ced).html('');
                                        }
                                    });

		});
            }
         
        }
        