var cot;
function Desglose(){
     $("#cot").val(window.opener.$("#idcot").val());
                $("#idcot").val(window.opener.$("#idcot").val());
                cot = window.opener.$("#idcot").val();
                    jsShowWindowLoad('Procesando datos..');
                 var ref = $("#ref").val();
                 var descr = $("#descr").val();
                 var perfil = $("#perfil").val();
                $.ajax({
                        type:'GET',
                        data:'cot='+cot+'&ref='+ref+'&descr='+descr+'&perfil='+perfil+'&sw=2',
                        url:'desglose_acciones.php',
                        success : function(d){
                            $("#formperfiles").html(d);
                            lista_desglose(cot);
                            lista_desglose_mat(cot);
                            lista_desglose_vid(cot);
                        }
                     });
}
function modificarcod(n){
    var ref = $("#ref"+n).val();
    var col = $("#col"+n).val();
    var med = $("#med"+n).val();
    var cod = ref+'-'+col+''+med.substring(0,2);
     
    $("#cod"+n).val(cod);
}
function adddesg(cot){
    $("input[name=item]:checked").each(function(){
				var n = $(this).attr("id");
                                var ref = $("#ref"+n).val();
                                var tipo = $("#tipo"+n).val();
                                var med = $("#med"+n).val();
                                var cod = $("#cod"+n).val();
                                var can = $("#can"+n).val();
                                var item = $("#item"+n).val();
                                var col = $("#col"+n).val();
//                                $.post("pasarbodega.php",{id:id, cod:cod,precios:precios,costo:costo}, function(){ });
                                $.ajax({
                                        type:'GET',
                                        data:'cot='+cot+'&ref='+ref+'&cod='+cod+'&can='+can+'&med='+med+'&item='+item+'&tipo='+tipo+'&col='+col+'&sw=1',
                                        url:'desglose_acciones.php',
                                        success : function(d){
                                            console.log(d);
                                        }
                                     });
			});
               Desglose();
}
function adddesgmat(cot){
    $("input[name=itemmat]:checked").each(function(){
				var n = $(this).attr("id");
                                var ref = $("#ref"+n).val();
                                var tipo = $("#tipo"+n).val();
                                var para = $("#para"+n).val();
                                var cod = $("#cod"+n).val();
                                var can = $("#can"+n).val();
                                var item = $("#item"+n).val();
                                var col = $("#col"+n).val();
            
                                $.ajax({
                                        type:'GET',
                                        data:'cot='+cot+'&ref='+ref+'&cod='+cod+'&can='+can+'&para='+para+'&item='+item+'&tipo='+tipo+'&col='+col+'&sw=1.1',
                                        url:'desglose_acciones.php',
                                        success : function(d){
                                            console.log(d);
                                        }
                                     });
			});
               Desglose();
}
function adddesgvid(cot){
    $("input[name=itemv]:checked").each(function(){
				var n = $(this).attr("id");
                                var ref = $("#ref"+n).val();
                                var tipo = $("#tipo"+n).val();
                                var med = $("#med"+n).val();
                                var cod = $("#cod"+n).val();
                                var can = $("#can"+n).val();
                                var item = $("#item"+n).val();
                                var col = $("#col"+n).val();
            
                                $.ajax({
                                        type:'GET',
                                        data:'cot='+cot+'&ref='+ref+'&cod='+cod+'&can='+can+'&med='+med+'&item='+item+'&tipo='+tipo+'&col='+col+'&sw=1.2',
                                        url:'desglose_acciones.php',
                                        success : function(d){
                                            console.log(d);
                                        }
                                     });
			});
               Desglose();
}
function lista_desglose(cot){
    $.ajax({
                                        type:'GET',
                                        data:'cot='+cot+'&sw=3',
                                        url:'desglose_acciones.php',
                                        success : function(d){
                                            $("#mostrar_desglose_mat").html(d);
                                        }
                                     });
}
function lista_desglose_vidrios(cot){
    $.ajax({
                                        type:'GET',
                                        data:'cot='+cot+'&sw=3.1',
                                        url:'desglose_acciones.php',
                                        success : function(d){
                                            $("#mostrar_desglose_vid").html(d);
                                        }
                                     });
}
function lista_desglose_accesorios(cot){
    $.ajax({
                                        type:'GET',
                                        data:'cot='+cot+'&sw=3.2',
                                        url:'desglose_acciones.php',
                                        success : function(d){
                                            $("#mostrar_desglose_acc").html(d);
                                        }
                                     });
}
function lista_desglose_mat(cot){
    $.ajax({
                                        type:'GET',
                                        data:'cot='+cot+'&sw=4',
                                        url:'desglose_acciones.php',
                                        success : function(d){
                                            $("#forminsumos").html(d);
                                        }
                                     });
}
function lista_desglose_sol(cot){
    $.ajax({
                                        type:'GET',
                                        data:'cot='+cot+'&sw=6',
                                        url:'desglose_acciones.php',
                                        success : function(d){
                                            $("#mostrar_desglose_sol").html(d);
                                        }
                                     });
}

