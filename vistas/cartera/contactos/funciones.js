 $(function(){
     $("#mostrar_tabla").html(mostrar_contac(1));
     
    $('#cod').change(function(){
        mostrar_contac(1);
      });
    
    
 });  

    function mostrar_contac(page){
        var cod = $("#cod").val();
       
        $.ajax({
                type:'GET',
                data:'cod='+cod+'&page='+page,
                url: '../vistas/cartera/contactos/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
   function guardar_cont(){
        var id = $("#id_cont").val();
        var contnombre = $("#cont_nombre").val();
        var telcont = $("#tel_cont").val();
        var emailcont = $("#email_cont").val();
        var cargcarg = $("#carg_carg").val();
        var sugercont = $("#suger_cont").val();
        var ccc = $("#cedula").val();
        var cli = $("#cliente").val();
        var usucrea = $("#usu_creo").val(); 
        var fcrea = $("#fecha_creo").val();
        
      
       $.ajax({
            type: 'GET',
            data: 'id='+id+'&contnombre='+contnombre+'&telcont='+telcont+'&emailcont='+emailcont+'&cargcarg='+cargcarg+
                  '&sugercont='+sugercont+'&ccc='+ccc+'&usucrea='+usucrea+'&fcrea='+fcrea+'&sw=1',
            url: '../vistas/cartera/contactos/acciones.php', 
           success: function(resultado){
                console.log(resultado)
                $("#id_cont").val(resultado); 
                sweetAlert("Se ha guardo con exito");
                mostrar_contac(1);
            }
           });
}

function limpiar_cont(){
        $("#id_cont").val('');
        $("#cont_nombre").val('');
        $("#tel_cont").val('');
        $("#email_cont").val('');
        $("#carg_carg").val('');
        $("#suger_cont").val('');
        $("#cedula").val('');
        $("#cliente").val('');
      
}
function nuevo(){
    $("#lin2").modal("show");
    limpiar_cont();
}

function editar_cont(id){
    $("#marca1").attr("class","");
    $("#marca2").attr("class","active");
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/cartera/contactos/acciones.php', //
            success: function(resultado){
    var t = eval(resultado);
     
        $("#id_cont").val(t[0]);
        $("#cont_nombre").val(t[1]);
        $("#tel_cont").val(t[2]);
        $("#email_cont").val(t[3]);
        $("#carg_carg").val(t[4]);
        $("#suger_cont").val(t[5]);
        $("#cedula").val(t[6]);
        $("#cliente").val(t[7]);
        $("#usu_creo").val(t[8]); 
        $("#fecha_creo").val(t[9]);
        
 }
});
}
function cargarmund(){
     var depar = $("#ter_dep").val(); // 
         $.ajax({
            type: 'GET',
            data: 'nombre='+depar+'&sw=5',  //
            url: '../vistas/cartera/contactos/acciones.php', //
            success: function(resultado){
                $("#ter_muni").html(resultado);
            }
           }); 
}

function buscarcliente(id){
    window.open("../popup/terceros/" , "CLIENTES", " width= 600 , height=500 ");
}
function pasar_tercero(user,nombre,idt){
    $("#cedula").val(idt);
    $("#cliente").val(nombre);
}
