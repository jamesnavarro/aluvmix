//PRIMERA TABLA CONTROLER INDEX
$(function(){
   //mostrar_line2(1);

    $('#cod2').change(function(){
        mostrar_line2(1);
      });
     $('#des2').change(function(){
        mostrar_line2(1);
      }); 
        $('#est2').change(function(){
        mostrar_line2(1);
      }); 
     $('#refe2').change(function(){
         mostrar_line2(1);
     });
     $('#col2').change(function(){
         mostrar_line2(1);
     });

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
                url: '../vistas/inventario/materiales/lista2.php',
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
                url: '../vistas/inventario/materiales/acciones.php',
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
function con_fom_cod(){
    var cod = $("#fechav").val();
    $("#mostrar_tabla2").html('<tr><td colspan="2">Cargando<img src="../images/load.gif"></td>');
      $.ajax({
          type:'GET',
          url:'http://172.16.0.30:8989/api/MAEINV/Cambios/'+cod,
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
      consultar_cod_alu(dev.INV_REFER,i);
  var row = '<tr id="v'+i+'">'+
              '<td>'+dev.INV_REFER+'\
<input type="hidden" id="cod'+i+'" value="'+dev.INV_REFER+'">\n\
<input type="hidden" id="ref'+i+'" value="'+dev.INV_CODIGO+'">\n\
<input type="hidden" id="nom'+i+'" value="'+dev.INV_NOMBRE+'">\n\
<input type="hidden" id="col'+i+'" value="'+dev.INV_LOTE+'">\n\
<input type="hidden" id="gru'+i+'" value="'+dev.INV_GRUPO+'">\n\
<input type="hidden" id="cla'+i+'" value="'+dev.INV_CLASE+'">\n\
<input type="hidden" id="und'+i+'" value="'+dev.INV_UNDMED+'">\n\
<input type="hidden" id="emp'+i+'" value="'+dev.INV_NOMEMP+'">\n\
<input type="hidden" id="anc'+i+'" value="'+dev.INV_ANCHO+'">\n\
<input type="hidden" id="alt'+i+'" value="'+dev.INV_ALTO+'">\n\
<input type="hidden" id="lar'+i+'" value="'+dev.INV_LARGO+'">\n\
<input type="hidden" id="pre'+i+'" value="'+dev.INV_VALCOM+'">\n\
<input type="hidden" id="med'+i+'" value="'+dev.INV_UBICA+'">\n\
<input type="hidden" id="iva'+i+'" value="'+dev.INV_IVA+'">\n\
<input type="hidden" id="aiva'+i+'" value="'+dev.INV_PORIVA+'">\n\
<input type="hidden" id="use'+i+'" value="'+dev.INV_CODOPE+'">\n\
</td>'+
              '<td>'+dev.INV_CODIGO+'</td>'+
              '<td>'+dev.INV_NOMBRE+'</td>'+
              '<td>'+dev.INV_LOTE+'</td>'+
              '<td>'+dev.INV_VERSIO+'</td>'+
              '<td style="text-align:center"><input type="checkbox" name="item" id="'+i+'" value="'+dev.INV_REFER+'"></td>\n\
</tr>';
  return row;

}
function consultar_cod_alu(cod,dev){
    $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&sw=1',
                url: '../vistas/inventario/materiales/acciones.php',
         success: function(t) {
             var t = eval(t);
            
              if(t[0]!=null){
                  $("#v"+dev).html('');
              }else{
                  
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
        
        function agregar_cod_alu(){
            var c = confirm("Esta seguro de sincronizar los productos desde fomplus?");
            if(c){
            $("input[name=item]:checked").each(function(){
				var id = $(this).attr("id");
                                var cod = $("#cod"+id).val();
                                var ref = $("#ref"+id).val();
                                var nom = $("#nom"+id).val();
                                 var col = $("#col"+id).val();
                                 var anc = $("#anc"+id).val();
                                 var alt = $("#alt"+id).val();
                                 var lar = $("#lar"+id).val();
                                 var gru = $("#gru"+id).val();
                                 var cla = $("#cla"+id).val();
                                 var pre = $("#pre"+id).val();
                                 var und = $("#und"+id).val();
                                 var emp = $("#emp"+id).val();
                                 var med = $("#med"+id).val();
                                 var iva = $("#iva"+id).val();
                                 var aiva = $("#aiva"+id).val();
                                 var use = $("#use"+id).val();
                                 $.ajax({
                                        type: 'GET',
                                        data: 'col='+col+'&anc='+anc+'&alt='+alt+'&lar='+lar+'&gru='+gru+'\
                                         &cod='+cod+'&ref='+ref+'&nom='+nom+'&cla='+cla+'&pre='+pre+'&und='+und+'&emp='+emp+'\
                                         &med='+med+'&iva='+iva+'&aiva='+aiva+'&use='+use+'&sw=2',
                                        url: '../vistas/inventario/materiales/acciones.php',
                                        success: function(t) {
                                            console.log(cod +' : '+t);
                                            $("#v"+cod).html('');
                                        }
                                    });

		});
            }
         
        }