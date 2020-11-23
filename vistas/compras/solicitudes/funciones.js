
//TABLAS DE ITEMS DE SOLICITUD
$(function () {
    $("#mostrar_tabla").html(mostrar_line(1));
    $("#stock").change(function(){
        var c = $(this).val();
        var precio = $("#precio").val();
        $("#tot").val(c*precio);
    });
});

function mostrar_line(page) {
    $.ajax({
        type: 'GET',
        url: '../vistas/compras/solicitudes/lista_items.php',
        success: function (d){
            $("#mostrar_tabla").html(d);
            if (d == 'error') {
                location.href = '../index.php';
            }
        }
    });
}
//TABLAS DE SOLICITUDES DE COMPRA
$(function () {
    $("#mostrar_tabla2").html(mostrar_table(1));

    $('#n_sol').change(function(){
        mostrar_table(1);
      });
     $('#area_s').change(function(){
        mostrar_table(1);
      }); 
       $('#fec_s').change(function(){
        mostrar_table(1);
      });
     $('#usu_s').change(function(){
        mostrar_table(1);
      }); 
      $('#est').change(function(){
        mostrar_table(1);
      }); 
      //estord
      $('#estord').change(function(){
        mostrar_table(1);
      });
});

function mostrar_table(page) {
    var n_sol = $("#n_sol").val();
    var area_s = $("#area_s").val();
    var fec_s = $("#fec_s").val();
    var usu_s = $("#usu_s").val();
     var est = $("#est").val();
      var ord = $("#estord").val();
    $.ajax({
        type: 'GET',
        data: 'n_sol='+n_sol+'&area_s='+area_s+'&fec_s='+fec_s+'&usu_s='+usu_s+'&est='+est+'&ord='+ord+'&page='+page,
        url: '../vistas/compras/solicitudes/lista_sols.php',
        success: function (d) {
            $("#mostrar_tabla2").html(d);
            if (d == 'error') {
                location.href = '../index.php';
            }
        }
    });
}

function configbutton(x) {
   //var x=document.getElementById('idorden').value;
       $.post("../vistas/compras/solicitudes/guardar_solicitud.php", {"solix":x}, function(data){
           var acceso;
         
                    if(data.acceso=='1'){
                        acceso = '';
                    }else{
                        acceso = 'disabled';
                    }
              if(data.sucess=='1'){
                if(data.estado=='aprobado'){
                  document.getElementById('wait').innerHTML='';
//                  if(data.fom!=''){
//                      document.getElementById('listo').innerHTML='Orden Compra: '+data.fom;
//                  }else{
                      document.getElementById('listo').innerHTML='<button onclick="entrega();" class="btn btn-danger btn-sm" '+acceso+' id="btnorden" ><i class="ace-icon fa fa-check"></i>Generar Orden</button>';
//                   }
                 
                }else if(data.estado=='Anulado'){
                  document.getElementById('wait').innerHTML='';
                  document.getElementById('listo').innerHTML='';
                }else{
                 document.getElementById('wait').innerHTML='';
                  document.getElementById('listo').innerHTML='<button onclick="aprobar();" class="btn btn-success btn-sm" '+acceso+' ><i class="ace-icon fa fa-check"></i>Aprobar Solicitud</button>';
                }                
              }
              else{
                alert('Error al intentar buscar solicitud!..');
              }
           },"json");
}

//TABLAS DE CONVERSION A ORDEN DE COMPRA

function mostrar_tabl2(page){
    $.ajax({
        type: 'POST',
        data: 'ids=' + page,
        url: '../vistas/compras/solicitudes/lista_conver_orden.php',
        success: function (d) {
            $("#mostrar_tabla_generacion").html(d);
            if (d == 'error') {
                location.href = '../index.php';
            }
        }
    });
}

//CARGA PREVVIA DE DATOS EN EL MODAL DE ACUERDO A ID DE PRODUCTO
function previusedit(id) {
            var r = confirm("Desea Editar Este Item?");
            if (r == true) {
                 $.post("../vistas/compras/solicitudes/info.php", {"ref":id}, function(data){
                       if(data.sucess==1){
                         if(data.cod)
                             $("#codigod").val(data.cod);
                           else
                             $("#codigod").val("");
                           if(data.nom)
                             $("#nombred").val(data.nom);
                           else
                             $("#nombred").val("");
                           if(data.col)
                             $("#colord").val(data.col);
                           else
                             $("#colord").val("");
                           if(data.med)
                             $("#medidasd").val(data.med);
                           else
                             $("#medidasd").val("");
                           if(data.pre)
                             $("#preciod").val(data.pre);
                           else
                             $("#preciod").val("");
                            if(data.cant)
                             $("#stockd").val(data.cant);
                           else
                             $("#stockd").val("");
                         if(data.undmed)
                             $("#medd").val(data.undmed);
                           else
                             $("#medd").val("");
                         if(data.obs_item)
                             $("#obs_sol2").val(data.obs_item);
                           else
                             $("#obs_sol2").val("");
                            document.getElementById("edita").value  = id;
                            $("#editarProducto").modal();           
                      }else{
                            alert('Error no se pudo procesar esta operación');
                      }
                  },"json");
            }else{
             $('#nuevoProducto').modal('hide');
            }
    }
//INSERCION DE PRODUCTOS EN SOLICITUD
    function agregapro(){
        document.getElementById("codigo").value='';
        document.getElementById("nombre").value='';
        document.getElementById("color").value='';
        document.getElementById("medidas").value='';
        document.getElementById("stock").value='';
        document.getElementById("precio").value='';
        $("#nuevoProducto").modal();
    }
//VIGILANCIA BOTON DE GUARDADO ENVIO DE DATOS
    $(document).ready(function(){
    $("#guardar_solicitud_c").click(function(){
        var cod = $("#codigo").val();
        var nom = $("#nombre").val();
        var pre = $("#precio").val();
        var can = $("#stock").val();
        var iva = $("#iva").val();
        if(cod==''){
            alert("Debes de seleccionar el codigo");
             $("#codigo").focus();
             return false;
        }
        if(nom==''){
            alert("Debes de digitar el nombre");
             $("#nombre").focus();
             return false;
        }
        if(pre==''){
            alert("Debes de digitar el precio");
             $("#precio").focus();
             return false;
        }
        if(can==''){
            alert("Debes de digitar la cantidad");
             $("#stock").focus();
             return false;
        }
        
      $.post("../vistas/compras/solicitudes/guardar_solicitud.php", {"items":"1","cod":$("#codigo").val(),"nom":$("#nombre").val(),"col":$("#color").val(),"med":$("#medidas").val(),"stk":$("#stock").val(),"pre":$("#precio").val(),"undmed":$("#med").val(),"obs_sol":$("#obs_sol").val(),"iva":$("#iva").val()}, function(data){
          if(data.sucess==1){
           mostrar_line(1);
           confirma();
          }
          else{
            alert('Error al intentar Guardar el producto!');
          }
      },"json");
    })
  });

//CONFIRMACION SI DESEA SEGUIR AGREGANDO PRODUCTOS A LA SOLICITUD
    function confirma() {
            var r = confirm("Desea Agregar mas Productos?");
            if (r == true) {
               document.getElementById("codigo").value='';
               document.getElementById("nombre").value='';
               document.getElementById("color").value='';
               document.getElementById("medidas").value='';
               document.getElementById("stock").value='';
               document.getElementById("precio").value='';
               
               document.getElementById("tot").value='';
               document.getElementById("med").value='';
               document.getElementById("obs_sol").value='';
            } else {
                $('#nuevoProducto').modal('hide');
            }
    }

//OPEN DE MODAL DE GUARDADO DE SOLICITUD COMO ORDEN SOL
  function generar(){
      $("#guarda_sol").modal();
  }
 function enviar_email(sol,area,nota,tipo,num,fec,gen){
     window.open("http://aluvmix.softmediko.com/correo.php?sol="+sol+"&area="+area+"&nota="+nota+"&tipo="+tipo+"&numero="+num+"&fecha="+fec+"&gen="+gen,"form","width=100px, height=100px");
 }
 
//ENVIO DE DATOS PARA GUARDAR LA SOLICITUD MGUTIERREZ
  $(document).ready(function(){
    $("#generar_solicitud_c").click(function(){
        if($("#areax").val()==''){
            alert("Debes de seleccionar el area.");
            $("#areax").focus();
            return false;
        }
        
            if($("#notas").val()==''){
            alert("Detalle de la solicitud.");
            $("#notas").focus();
            return false;
        }
        
        
        
        
        
        
        if($("#date").val()==''){
            alert("¡Debes de seleccionar la fecha de cuando lo necesitas!.");
            $("#date").focus();
            return false;
        }
      $.post("../vistas/compras/solicitudes/guardar_solicitud.php", {"orden":"1","area":$("#areax").val(),"fech":$("#date").val(),"notas":$("#notas").val(),"relax":$("#relax").val(),"num":$("#numero").val(),"arc":$("#resu").val()}, function(data){
          if(data.sucess==1){
           $('#guarda_sol').modal('hide');
           mostrar_line(1);
           comp_list_solicitudes();
           enviar_email(data.sol,$("#areax").val(),$("#notas").val(),$("#relax").val(),$("#numero").val(),$("#date").val(),$("#generado").val());
          }
          else{
            alert('Error al intentar Guardar el producto!');
          }
      },"json");
    })
  });

  //EDICION DE ITEMSS DE LA SOLICITUD

  $(document).ready(function(){
    $("#editable").click(function(){
      $.post("../vistas/compras/solicitudes/guardar_solicitud.php", {"edit":"1","edt":$("#edita").val(),"stk":$("#stockd").val(),"pre":$("#preciod").val(),"undmed":$("#medd").val(),"obs_sol2":$("#obs_sol2").val()}, function(data){
          if(data.sucess==1){
           mostrar_line(1);
           $('#editarProducto').modal('hide');
          }
          else{
            alert('Error al intentar Editar el producto!');
          }
      },"json");
    })
  });

  function eliminar_items(id) {
     var r = confirm("Desea Eliminar este Producto?");
            if (r == true) {
              $.post("../vistas/compras/solicitudes/guardar_solicitud.php", {"delitem":id}, function(data){
                 if(data.sucess==1){
                    mostrar_line(1);
                 }else{
                    alert('Error al intentar Eliminar el producto!');
                 }   
                },"json"); 
            }
    }

    function cargadatos(id) {
    $('.modal-backdrop').remove();
    $('#cargar').html('<img src="../images/guardando.gif"> Cargando.......');
    $.ajax({
        type: 'GET',
        url: '../vistas/compras/solicitudes/conversion.php',
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

    function verifica(id) {
      var nuevo=parseInt(document.getElementById('cnew'+id).value);
      var real=parseInt(document.getElementById('creal'+id).value);
      if(nuevo>real){
        alert('Tamaño excedio el limite de cantidad solicitada');
        document.getElementById('cnew'+id).value='';
      }
    }

    function crearitemc(id,sol) {
       var x=parseFloat(document.getElementById('cnew'+id).value);
       var precio = parseFloat(document.getElementById('pre'+id).value);
       var und = document.getElementById('und'+id).value;
       if(x!='' && x>0){
          $.post("../vistas/compras/solicitudes/guardar_solicitud.php", {"send":"1","cant":$("#cnew"+id).val(),"sol":sol,"id":id,"pre":precio,"und":und}, function(data){
              if(data.sucess==1){
                 mostrar_tabl2(sol);
              }
              else{
                alert('Error al intentar convertir!');
              }
           },"json");
       }else{
          alert('Valor enviado es incorrecto.!!');
       }
    }
    //GUARDAR ORDEN COMPRA CONVIERTER ITEMS A ORDEN YA DEFINIDA mostrar_tabla_products
    $(document).ready(function(){
    $("#guar_orden_co").click(function(){
      generar_ord();
    });
  });
  function generar_ord(){
    if($("#sede").val()=='' || $("#nombrepro").val()=='' || $("#nterc").val()=='' || $("#loc").val()=='' || $("#ant").val()=='' || $("#fechan").val()=='' || $("#cencosto").val()=='' || $("#observ").val()==''){
       $("#request").html('<img src="../vistas/images/no.png" align="left"><h5 style="color: red;"><b> Verifique que los campos esten llenos he intente nuevamente</b></h5>');
    }else{
      $.ajax({
          type:'POST',
          data:'ord=1&ordenx='+$("#ordenc").val()+'&soli='+$("#solicitd").val()+'&sed='+$("#sede").val()+'&cod_ter='+$("#nombrepro").val()+'&nom_ter='+$("#nterc").val()+'&bod='+$("#loc").val()+'&ordfom='+$("#ordenfom").val()+'&cencosto='+$("#cencosto").val()+'&observ='+$("#observ").val()+'&iva='+$("#siva").val()+'&ret='+$("#sret").val()+'&cue='+$("#codcue").val()+'&retica='+$("#sica").val()+'&codica='+$("#sact").val()+'&tipo='+$("#tipo_f").val(),
          url:'../vistas/compras/solicitudes/guardar_solicitud.php',
          success: function(data){
              //debugger;
              console.log(data);
              var c = eval(data);
              $("#ordenc").val(c[1]);
              PasarItemsOrden(c[1]);
              if(c[2]==0){
                  alert('Guardada con exito. se genero la orden No.'+c[1]+' t:'+c[3]);
              }else{
                  alert('Se edito con exito');
              }
              
              fom_saveoc(c[1]);
              //comp_list_ordenes();
              cargadatos($("#solicitd").val());
              
          }
      });
    }
  }
  //wf-t7005tp
  function PasarItemsOrden(ord){
      var soli =  $("#solicitd").val();

      $("input[name=item]:checked").each(function(){
	     var id = $(this).attr("id");
             $.ajax({
                    type:'GET',
                    data:'ord='+ord+'&soli='+soli+'&id='+id+'&sw=6',
                    url:'../vistas/compras/solicitudes/acciones.php',
                    success: function(da){
                       $("#columna").html('Ord:'+ord);
                    }
                    });    
                   
       });
       $("#itemsel").val();
  }
  function vali(id){
      var c = $("#"+id).is(":checked");

      var con = $("#itemsel").val();
      var t;
      if(c==true){
          t = parseInt(con) + 1;
      }else{
          t = parseInt(con) - 1;
      }
      $("#itemsel").val(t);
  }
  function fom_saveoc(ord){
     console.log('datos recibido '+ord);
      $.ajax({
          type:'GET',
          dataType: "json",
          data:'ord='+ord+'&sw=1',
          url:'../vistas/compras/solicitudes/acciones.php',
          success: function(da){
             debugger;
             console.log(da);
             pasar_saveoc(da,ord);
          }
      });
  }
 function fom_saveoc2(){
     var ord = $("#orden").val();
     var c = confirm("Esta seguro de guardar la orden en fomplus?.");
     if(c){
      $.ajax({
          type:'GET',
          dataType: "json",
          data:'ord='+ord+'&sw=1',
          url:'../vistas/compras/solicitudes/acciones.php',
          success: function(da){
              debugger;
             
             pasar_saveoc(da,ord);
          }
      });
  }
  }
  function pasar_saveoc(datos,ord){  

      $.ajax({
          type:'POST',
          data: JSON.stringify(datos),
          url:'http://172.16.0.30:8989/api/Compras',
          contentType: 'application/json',
          success: function(da){
              debugger;
             var p = eval(da);
              console.log('Resultado: '+p.DocumentoFomplus+' orden ='+ord);
             pasar_num_oc(p.DocumentoFomplus,ord);
          }
      });
  }
  function pasar_num_oc(fom,ord){
      $.ajax({
          type:'GET',
          dataType: "json",
          data:'ord='+ord+'&fom='+fom+'&sw=4',
          url:'../vistas/compras/solicitudes/acciones.php',
          success: function(da){
             console.log('save: '+da+' ord: '+ord);
             
          }
      });
  }
  //APROBACION DE SOLICITUDES PAREA GENERACION DE ORDENES

  function aprobar() {
  var por = $("#por").val();
  var ct = $("#ct").val();
         if(por===''){
           alert("Quien autoriza ?");
           $("#por").focus();
           return false;
         }
         if(ct==='0'){
           alert("Debes de aprobar por lo menos un items");
           return false;
         }
         
    var sol=document.getElementById('solicitd').value;
     $.post("../vistas/compras/solicitudes/guardar_solicitud.php", {"aprobar":"1","soli":$("#solicitd").val(),"por":$("#por").val()}, function(data){
              if(data.sucess==1){
                alert('Solicitud aprobada con exito');
                configbutton();
                Updaprobar();
              }
              else{
                alert('Error al intentar aprobar!');
              }
           },"json");
  }

   //APROBACION DE SOLICITUDES PAREA GENERACION DE ORDENES
  function Updaprobar(x) {
   //var x=document.getElementById('idorden').value;
   //alert('solicitud: '+x);
       $.post("../vistas/compras/solicitudes/guardar_solicitud.php", {"enca":x}, function(data){
                  document.getElementById('nsol').innerHTML=data.sol;
                  document.getElementById('fecc').innerHTML=data.fecc;
                  document.getElementById('areas').innerHTML=data.area;
                  document.getElementById('fece').innerHTML=data.fece;
                  document.getElementById('crp').innerHTML=data.user;
                  document.getElementById('nota').innerHTML=data.notas;
                  document.getElementById('rel').innerHTML=data.rel;
                  document.getElementById('ncon').innerHTML=data.con;
                  $('#idorden').val(data.sol);
                  $('#archivo').html(data.arc);
                  $('#por').val(data.por);
                  if(data.por!==''){
                       $('#por').attr("disabled",true);
                  }else{
                      $('#por').attr("disabled",false);
                  }
                  if(data.acceso==='0'){
                       $('#aprove').attr("disabled",true);
                  }else{
                      $('#aprove').attr("disabled",false);
                  }
                  $('#est').val(data.estado);
                  if(data.user2==''){
                    document.getElementById('aprove').innerHTML='Sin aprobar';
                  }else{
                    document.getElementById('aprove').innerHTML=data.user2;
                  }
              
           },"json");
}
function AnularSol(){
    var est = $("#est").val();
//    if(est=='En Proceso'){
        var c = confirm("Esta seguro de anular esta solicitud");
        if(c){
        $.ajax({
          type:'POST',
          data:'anular=1&ordenx='+$("#idorden").val(),
          url:'../vistas/compras/solicitudes/guardar_solicitud.php',
          success: function(data){
              alert(data);
              $("#est").val('Anulado');
          }
      });
        }
   
}

 function pdf(){
     var id = $("#idorden").val();
      window.open("../vistas/compras/solicitudes/pdf.php?id="+id , "resumen", " width= 800 , height=600 ");
}
function pdf2(id){
      window.open("../vistas/compras/solicitudes/pdf.php?id="+id , "resumen", " width= 1200 , height=600 ");
}
 function pdf3(){
     var id = $("#idorden").val();
      window.open("../vistas/compras/solicitudes/pdfxgrupo.php?id="+id , "resumen", " width= 800 , height=600 ");
}
function buscartc(){
    var cod =$("#codcue").val();
    $.ajax({
        type:'GET',
        data:'cod='+cod+'&sw=3',
        url:'../vistas/compras/solicitudes/acciones.php',
        success : function(d){
            $("#nomcue").val(d);
        }
    });
}
function upprecio(id,sol){
    var pre = $("#pre"+id).val();
    $.ajax({
        type:'GET',
        data:'id='+id+'&pre='+pre+'&sw=5',
        url:'../vistas/compras/solicitudes/acciones.php',
        success:function(d){
            alert(d);
             mostrar_tabl2(sol);
        }
    });
}
function tutoria(id){
    window.open("../vistas/compras/solicitudes/tutorial_solicitud.php?archivo="+id,"visualiza","width=800px,height=600px");  
}
function subir(id){
		var formulario = $('#subida');	
		var datos = formulario.serialize();		
		var archivos = new FormData();	
		var url = '../vistas/compras/solicitudes/subirarchivos.php';		
		for (var i = 0; i < (formulario.find('input[type=file]').length); i++) { 			
               	archivos.append((formulario.find('input[type="file"]:eq('+i+')').attr("name")),((formulario.find('input[type="file"]:eq('+i+')')[0]).files[0]));		 
      		}	
		$.ajax({			
			url: url+'?'+datos,			
			type: 'POST',			
			contentType: false, 			
            	        data: archivos,			
               	        processData:false,
			success: function(data){
                           console.log(data);
                           $('#resu').val(data);
			}
			});
			return false;
		
}
function verpro(id){
    $("#modalpro").modal('show');
   
    $.ajax({
        type:'GET',
        data:'id='+id+'&sw=7',
        url:'../vistas/compras/solicitudes/acciones.php',
        success:function(d){
           $("#mostrarpro").html(d);
        }
    });
}
function editarsol(id,can) {
    var user = $("#user_general").val();
    if(user=='admin' || user=='MGUTIERREZ' || user=='YTURIZO' || user=='CEXTERIOR'){
        var di = '';
    }else{
        var di = 'disabled';
    }
     $("#col_col"+id).html('<input type="text" id="cx" value="'+can+'" onchange="upsol('+id+')" style="width:50px" '+di+'>');   
}
function upsol(id){
    var cx = $("#cx").val();
    var cp = $("#creal"+id).val();
    var cok = $("#tamaño"+id).val();
    if(cp==0){
        alert("Ya no puedes editar la cantidad, la cantidad pendiente es igual a 0 ");
        mostrar_tabl2($("#solicitd").val());
        return false;
    }
    $.ajax({
        type: 'GET',
        data: 'id='+id+'&cx='+cx+'&cp='+cp+'&sw=8',
        url: '../vistas/compras/solicitudes/acciones.php',
        success: function (d) {
            mostrar_tabl2($("#solicitd").val());
            alert("Se edito con exito la cantidad ");
        }
    });
}
function buscarcod(){
    var cod = $("#codigo").val();
    if(cod==''){
        alert("Digite el codigo!");
        $("#codigo").focus();
        return false;
    } 

      $.ajax({
          type:'GET',
          //data: JSON.stringify(datos),
          url:'http://172.16.0.30:8989/api/MAEINV/'+cod,
          contentType: 'application/json',
          success: function(da){
                document.getElementById("codigo").value=cod;
                document.getElementById("nombre").value=da.INV_NOMBRE;
                document.getElementById("color").value=da.INV_LOTE;
	        document.getElementById("medidas").value=da.INV_UBICA;
                document.getElementById("precio").value=da.INV_VALCOM;
                document.getElementById("med").value=da.INV_UNDMED;
                document.getElementById("iva").value=da.INV_IVA;
                $("#stock").focus();
          }
      }).fail( function( jqXHR, textStatus, errorThrown ) {
             alert( 'Este codigo no esta registrado en fom plus\n Comuniquese con el area de inventario para crear el producto' );
//           $("#est"+ced).html('');
             return false;
        });
}
// call3 43 con 43 hotel rivera del mar.
function duplicar(sol,can){
    
    var c =  prompt("Digite la cantidad a dividir");
    if(c){
    if(c=='' || c==0){
        alert("Digite una cantidad");
        return false;
    }
    if(c>=can){
        alert("la cantidad digitada es mayor o igual");
        return false;
    }
    var id = $("#idorden").val();
    $.ajax({
        type: 'GET',
        data: 'id='+id+'&c='+c+'&can='+can+'&sol='+sol+'&sw=9',
        url: '../vistas/compras/solicitudes/acciones.php',
        success: function (d) {
            mostrar_tabl2($("#idorden").val());
            alert("Se ha dividido el items con exito "+d);
        }
    });
    }
    
}
function upcodigo(sol){
     $("#modalup").modal('show');
     $.ajax({
        type: 'GET',
        data: 'sol='+sol+'&sw=10',
        url: '../vistas/compras/solicitudes/acciones.php',
        success: function (d) {
            var p = eval(d);
            $("#fcod").val(p[0]);
            $("#fdes").val(p[1]);
            $("#fcol").val(p[2]);
            $("#fmed").val(p[3]);
            $("#fcan").val(p[4]);
            $("#fapr").val(p[5]); 
            $("#fpre").val(p[6]); 
            $("#fid").val(sol);
        }
    });
}
function buscarcod2(){
    var cod = $("#fcod").val();
    if(cod==''){
        alert("Digite el codigo!");
        $("#fcod").focus();
        return false;
    } 

      $.ajax({
          type:'GET',
          //data: JSON.stringify(datos),
          url:'http://172.16.0.30:8989/api/MAEINV/'+cod,
          contentType: 'application/json',
          success: function(da){
             
                document.getElementById("fcod").value=cod;
                document.getElementById("fdes").value=da.INV_NOMBRE;
                document.getElementById("fcol").value=da.INV_LOTE;
	        document.getElementById("fmed").value=da.INV_UBICA;
                document.getElementById("fpre").value=da.INV_VALCOM;
//                document.getElementById("med").value=da.INV_UNDMED;
//                document.getElementById("iva").value=da.INV_IVA;
//                $("#stock").focus();
                
 
          }
      }).fail( function( jqXHR, textStatus, errorThrown ) {
             alert( 'Este codigo no esta registrado en fom plus\n Comuniquese con el area de inventario para crear el producto' );
//           $("#est"+ced).html('');
             return false;
        });
}
function savecambios(){
        var id = $("#fid").val();
        var cod = $("#fcod").val();
        var des = $("#fdes").val();
        var col = $("#fcol").val();
        var med = $("#fmed").val();
        var can = $("#fcan").val();
        var apr = $("#fapr").val(); 
        var prec = $("#fpre").val(); 
        $.ajax({
        type: 'GET',
        data: 'id='+id+'&cod='+cod+'&des='+des+'&col='+col+'&med='+med+'&can='+can+'&apr='+apr+'&pre='+prec+'&sw=11',
        url: '../vistas/compras/solicitudes/acciones.php',
        success: function (d) {
            alert(d);
            mostrar_tabl2($("#solicitd").val());
        }
    });
}

function borrar(id){
     var c = confirm("Esta seguro de eliminar este item?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=12',  //
            url: '../vistas/compras/solicitudes/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_table(1);
            }
           });
       }
}
function borraritems(){
     var c = confirm("Esta seguro de eliminar este item?");
      var id = $("#fid").val();
      var sol = $("#solicitd").val();
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=12',  //
            url: '../vistas/compras/solicitudes/acciones.php', //
            success: function(resultado){
                alert(resultado);
                
                mostrar_tabl2(sol);
            }
           });
       }
}

