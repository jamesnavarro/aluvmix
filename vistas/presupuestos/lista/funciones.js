 
$(function(){
     $("#mostrar_listado_p").html(mostrar_lis(1)); 
   
      $("#ite").change(function(){
          mostrar_lis(1);
      });
      $("#codi").change(function(){
          mostrar_lis(1);
      });
      $("#desc").change(function(){
          mostrar_lis(1);
      });
       $("#refe").change(function(){
          mostrar_lis(1);
      });
      $("#line").change(function(){
          mostrar_lis(1);
      });
      $("#ulti").change(function(){
          mostrar_lis(1);
      });
      $("#modi").change(function(){
          mostrar_lis(1);
      });
     
});

function mostrar_lis(page){
         var ite = $("#ite").val();
         var codi = $("#codi").val();
         var desc = $("#desc").val();
         var refe = $("#refe").val();
         var line = $("#line").val();
         var ulti = $("#ulti").val();
         var modi = $("#modi").val();
        $.ajax({
            type: 'GET',
            data: 'page='+page+'&ite='+ite+'&codi='+codi+'&desc='+desc+'&line='+line+'&ulti='+ulti+'&modi='+modi+'&refe='+refe,
            url: 'presupuestos/lista/lista_li.php',
            success: function(resultado){
                 $("#mostrar_listado_p").html(resultado);
            }
  }); 
}
function pre_copiar_producto(idp,cod,sistema,linea){
    var c =  confirm("Esta seguro de copiar el producto?");
    if(c){
        
        if(linea=='Aluminio'){
            var digitado = prompt("Digite el codigo del producto "+linea);
            if(digitado==''){
                alert("Debes de digitar el codigo");
                return false;
            }
        }else{
            digitado = '';
        }
        $.ajax({
            type: 'GET',
            data: 'idp='+idp+'&cod='+cod+'&sistema='+sistema+'&linea='+linea+'&digitado='+digitado+'&sw=4',
            url: 'presupuestos/lista/acciones.php',
            success: function(resu_cod){
                // productos_dos(resu_cod);
                var p = eval(resu_cod);
                  //$("#controlador").html(p[0]);
                  alert(p[1]);
                  if(p[2]==0){
                      productos_dos(p[0]);
                  }else{
                      productos_dos(p[0]);
                  }
                  console.log('resultado: '+resu_cod);
            }
        }); 
    }
}

function pro_addpuesto(){
    var codi = $("#producto").val();
    var puesto = $("#puesto").val();
            $.ajax({
            type: 'GET',
            data: 'codi='+codi+'&puesto='+puesto+'&sw=4',
            url: 'produccion/rutas/acciones.php',
            success: function(resultado){
                 pro_mostrarrutas(codi);

            }
  });

}


function update_iva(id){
     var iva = $("#iva"+id).val();
     
        $.ajax({
            type: 'GET',
            data: 'id='+id+'&iva='+iva+'&sw=6',
            url: 'presupuestos/lista/acciones_1.php',
            success: function(resultado){
                alert(resultado) 
//                 $("#msg").html(resultado);
//                 setTimeout( "jQuery('#msg').hide();", 2000 ); 
            }
           }); 
}





