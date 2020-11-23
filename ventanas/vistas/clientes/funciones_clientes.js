 
$(function() {
     $("#mostrar_tabla").html(mostrar_clientes(1));
    
     $('#clientes').change(function(){
             mostrar_clientes(1);  
     });
     $('#documento').change(function(){
             mostrar_clientes(1);
     });
     $('#direccion').change(function(){
             mostrar_clientes(1);  
     });
     $('#telefono').change(function(){
             mostrar_clientes(1);
     });
     $('#fecha_ter').change(function(){
             mostrar_clientes(1);
     });
     
      $('#verifi').change(function(){
             validar();
     });

     
});
function mostrar_clientes(page){
     var nom= $("#clientes").val();
     var doc = $("#documento").val();
     var dir = $("#direccion").val();
     var tel = $("#telefono").val();
     
        $.ajax({
            type: 'GET',
            data: 'nom_ter='+nom+'&doc_ter='+doc+'&dir_ter='+dir+'&telfijo_ter='+tel+'&page='+page,
            url: '../vistas/clientes/lista_clientes.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado); 
            }
           });
     
}
function nuevo(){
    $("#FormularioProducto").modal("show");
}
function guardar_clientes(){ 
     var id = $("#id_ter").val(); 
     var tp = $("#ccn").val();
     var nm = $("#nomb").val();
     var ndoc = $("#numero").val();
     var veri= $("#verifi").val();
     var dr = $("#dire").val();
     var tl = $("#tele").val();
     var mv = $("#mov").val();
     var mun = $("#muni").val();
     var ciu = $("#ciud").val();
     var pai = $("#pais").val();
     var fc = $("#fecha").val();
     var mai = $("#email").val();
     var cont = $("#conta").val();
     var esta = $("#stado").val();
      
    if(tp===''){
        alert("seleccione el tipo de documento");
        $("#ccn").focus();
        return false;
    }
      if(nm===''){
        alert("ingrese el nombre");
        $("#nomb").focus();
        return false;
    }
    if(ndoc===''){
        alert("digite el numero");
        $("#numero").focus();
        return false;
    }
     if(veri===''){
        alert("digite codigo");
        $("#verifi").focus();
        return false;
    }
      if(dr===''){
        alert("debe escribir la direccion");
        $("#dire").focus();
        return false;
    }
      if(tl===''){
        alert("digite numero de telefono");
        $("#tele").focus();
        return false;
    }
      if(mv===''){
        alert("digite numero celular");
        $("#mov").focus();
        return false;
    }
       if(mun===''){
        alert("seleccione el municipio");
        $("#muni").focus();
        return false;
    }
       if(ciu===''){
        alert("selecciona la ciudad");
        $("#ciud").focus();
        return false;
    }
       if(pai===''){
        alert("selecciona el pais");
        $("#pais").focus();
        return false;
    }
    if(fc===''){
        alert("debe escojer la fecha");
        $("#fecha").focus();
        return false;
    }
    if(mai===''){
        alert("digite el correo electronico");
        $("#email").focus();
        return false; 
    }
    
           if(esta===''){
        alert("selecciona estado");
        $("#stado").focus();
        return false; 
    }
  
        $.ajax({
            type: 'GET',
            data: 'imp='+id+'&tip='+tp+'&nmb='+nm+'&ndc='+ndoc+'&ver='+veri+'&dr='+dr+'&tl='+tl+'&mvv='+mv+'&mn='+mun+'&cci='+ciu+'&ps='+pai+'&fc='+fc+'&ml='+mai+'&cnt='+cont+'&esto='+esta+'&sw=1',  //se pasan todas las variables con el sw en 1 "sw=1" 
            url: '../vistas/clientes/acciones_clientes.php',
            success: function(resultado){
                alert(resultado);
                $("#id_ter").val(resultado);
                alert("Se guardo con exito");
                mostrar_clientes(1);
            }
           });
}

function limpiar_formulario(){
    $("#cod").val('');
    $("#usuario").val('');
    $("#clave").val('');
    $("#nombrex").val('');
    $("#estado").val('');
}

function editar(id){
  
    $("#FormularioProducto").modal("show");
  
     $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=2',  //
            url: '../vistas/clientes/acciones_clientes.php', //
            success: function(resultado){
    var t = eval(resultado);
    var id = $("#id_ter").val(t[0]); 
   $("#nomb").val(t[1]);
   $("#ccn").val(t[2]);
   $("#numero").val(t[3]);
   $("#verifi").val(t[4]);
   $("#dire").val(t[5]);
   $("#tele").val(t[6]);
   $("#mov").val(t[7]);
   $("#muni").val(t[8]);
   $("#ciud").val(t[9]);
   $("#pais").val(t[10]);
   $("#fecha").val(t[11]);
   $("#email").val(t[12]);
   $("#conta").val(t[13]);
   $("#stado").val(t[14]);
   
 }
           });
}

function borrar(id){
     var page = $("#page").val();
     var c = confirm("Esta seguro de eliminar este usuario?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/clientes/acciones_clientes.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_clientes(page);
            }
           });
       }
}
function cargarmun(){
     var depar = $("#ciud").val(); // 
         $.ajax({
            type: 'GET',
            data: 'nombre='+depar+'&sw=4',  //
            url: '../vistas/clientes/acciones_clientes.php', //
            success: function(resultado){
                $("#muni").html(resultado);
            }
           }); 
}

function validar(){
	
	verifi=$('#verifi').val();

	if (verifi.length>1){
            alert('minimo 1 caracteres');
                $('#verifi').val('');
		return false;
	}
	else { 
		return true;
	}
}

function caracteresCorreoValido(){
    var email = $("#email").val();
    var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
    if (caract.test(email) == false){
        alert("digite un correo valido");
        $("#email").val('').focus();
        return false;
    }else{

        return true;
    }
} 

