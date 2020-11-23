 $(function(){
     $("#mostrar_tabla").html(mostrar_procesos(1));
     
        $('#area_b').change(function(){
             mostrar_procesos(1);
     });   
          $('#puesto_b').change(function(){
             mostrar_procesos(1);
     }); 
             $('#sede_b').change(function(){
             mostrar_procesos(1);
     }); 
    
 });  

    function mostrar_procesos(page){
          var area_b =$("#area_b").val();
          var puesto_b =$("#puesto_b").val();
          var sede_b =$("#sede_b").val();
        $.ajax({
                type:'GET',
                data:'areab='+area_b+'&puestob='+puesto_b+'&sedeb='+sede_b+'&page='+page,
                url: '../vistas/produccion/proc_trabajo/lista.php',
            success: function(d){
                $("#mostrar_tabla").html(d);
                if(d=='error'){
                    location.href='../index.php';
                }
            }
        });
    }
  