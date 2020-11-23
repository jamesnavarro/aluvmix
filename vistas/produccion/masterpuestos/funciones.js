 $(function(){
     $("#mostrar_tabla").html(mostrar_burros(1));
     
        $('#sede').change(function(){
             mostrar_burros(1);
     });   
          $('#nombre').change(function(){
             mostrar_burros(1);
     }); 
    
 });  

    function mostrar_burros(page){
          var nom =$("#nombre").val();
          var sede =$("#sede").val();
        $.ajax({
                type:'GET',
                data:'nom='+nom+'&sede='+sede+'&page='+page,
                url: '../vistas/produccion/masterpuestos/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_burros(){
        var id_bur = $("#id_bur").val();
        var descrip_bur = $("#descrip_bur").val();
        var esta_b = $("#esta_b").val();   
        var planta_b = $("#planta_b").val(); 
     
       $.ajax({
            type: 'GET',
            data: 'id='+id_bur+'&descrip_bur='+descrip_bur+'&esta_b='+esta_b+'&planta_b='+planta_b+'&sw=1',
            url: '../vistas/produccion/masterpuestos/acciones.php', 
           success: function(resultado){
                console.log(resultado)
                $("#id_bur").val(resultado); 
                sweetAlert("Se ha guardo con exito");
                mostrar_burros(1);
            }
           });
}

function limpiar_burros(){
        $("#id_bur").val('');
        $("#descrip_bur").val('');
        $("#esta_b").val('');
        $("#planta_b").val(''); 
        
}
function nuevo(){
    limpiar_burros();
}

function editar_puestoss(id){

     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/produccion/masterpuestos/acciones.php', //
            success: function(resultado){
            var t = eval(resultado);
 
              var id = $("#idpue").val(t[0]);
            var nom = $("#vno").val(t[3]);
            var sede = $("#vsede").val(t[4]);
            var mo = $("#vmo").val(t[5]);
            var um1 = $("#um1").val(t[6]);
            var ma = $("#vma").val(t[7]);
            var um2 = $("#um2").val(t[8]);
            var ci = $("#vci").val(t[9]);
            var um3 =  $("#um3").val(t[10]);
 }
});
}
 function addprecio(){
            var id = $("#idpue").val();
            var nom = $("#vno").val();
            var sede = $("#vsede").val();
            var mo = $("#vmo").val();
            var um1 = $("#um1").val();
            var ma = $("#vma").val();
            var um2 = $("#um2").val();
            var ci = $("#vci").val();
            var um3 =  $("#um3").val();
        if (sede===''){ 
            alert('debes de seleccionar la sede');
            $("#vsede").focus();
            return false;
        }
        if (nom===''){ 
            alert('debes de digitar el nombre del puesto');
            $("#vsede").focus();
            return false;
        }
        if (mo===''){
            alert('Digita el valor de la mano de obra'); 
            $("#vmo").focus();
            return false;
         }
         if (um1===''){
            alert('Selecciona la unidad de medida de la mano de obra'); 
            $("#um1").focus();
            return false;
         }
         if (ma===''){
            alert('Digita el valor de la maquinaria'); 
            $("#vma").focus();
            return false;
         }
         if (um2===''){
              alert('Selecciona la unidad de medida de la maquinaria'); 
            $("#um2").focus();
            return false;
         }
         if (ci===''){
            alert('Digita el valor del CIF'); 
            $("#vci").focus();
            return false;
         }
         if (um3===''){
              alert('Selecciona la unidad de medida deL cif'); 
            $("#um3").focus();
            return false;
         }
    $.ajax({
            type: 'GET',
            data: 'id='+id+'&sede='+sede+'&nom='+nom+'&mo='+mo+'&um1='+um1+'&ma='+ma+'&um2='+um2+'&ci='+ci+'&um3='+um3+'&sw=5',
            url: '../vistas/produccion/masterpuestos/acciones.php', 
            success: function(resultado){
            
               alert(resultado);
              mostrar_burros(1);
               $("#vsede").val('');
               $("#vmo").val('');
               $("#um1").val('');
               $("#vma").val('');
               $("#um2").val('');
               $("#vci").val('');
               $("#um3").val('');
               $("#vno").val('');
            }
           });
}

