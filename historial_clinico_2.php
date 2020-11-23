<?php
      include "../modelo/conexion.php";
      require '../modelo/consultar_permisos.php';
      require '../modelo/consulta_ordenes.php';
      require '../modelo/consultar_paciente.php';
//require '../modelo/insertar_consulta.php';
if (isset($_GET['cod'])) {
    $consulta = "select a.*, b.* from actividad a, pacientes b where a.orden_servicio='" . $_GET['cod'] . "' and a.id_paciente=b.id_paciente GROUP BY orden_externa";
    $result = mysql_query($consulta);
    while ($fila = mysql_fetch_array($result)) {
        $name = $fila['nombres'] . ' ' . $fila['apellidos'];
        $id = $fila['id_paciente'];
    }

    
    $consultest = "select * from testmedidas WHERE  id_orden=" . $_GET["cod"] . "";
    $resultest = mysql_query($consultest);
    $filatest = mysql_fetch_array($resultest);
        $idtest = $filatest["id_test"];
        $peso = $filatest["peso"];
        $talla = $filatest["talla"];
        //$imc = $filatest['imc'];
        $p1 = $filatest['p1'];$p2 = $filatest['p2'];$p3 = $filatest['p3'];$p4 = $filatest['p4'];$p5 = $filatest['p5'];$p6 = $filatest['p6'];$p7 = $filatest['p7'];
        $p8 = $filatest['p8'];$p9 = $filatest['p9'];$p10 = $filatest['p10'];$p11 = $filatest['p11'];$p12 = $filatest['p12'];$p13 = $filatest['p13'];$p14 = $filatest['p14'];
        $p15 = $filatest['p15'];$p16 = $filatest['p16'];$p17 = $filatest['p17'];$p18 = $filatest['p18'];$p19 = $filatest['p19'];$p20 = $filatest['p20'];
        $p21 = $filatest['p21'];$p22 = $filatest['p22'];
        $t1 = $filatest['t1'];$t2 = $filatest['t2'];$t3 = $filatest['t3'];$t4 = $filatest['t4'];$t5 = $filatest['t5'];$t6 = $filatest['t6'];$t7 = $filatest['t7'];
        $t8 = $filatest['t8'];$t9 = $filatest['t9'];$t10 = $filatest['t10'];$t11 = $filatest['t11'];$t12 = $filatest['t12'];$t13 = $filatest['t13'];$t14 = $filatest['t14'];
        $t15 = $filatest['t15'];$t16 = $filatest['t16'];$t17 = $filatest['t17'];$t18 = $filatest['t18'];$t19 = $filatest['t19'];$t20 = $filatest['t20'];$t21 = $filatest['t21'];
        $t22 = $filatest['t22'];$t23 = $filatest['t23'];$t24 = $filatest['t24'];$t25 = $filatest['t25'];$t26 = $filatest['t26'];$t27 = $filatest['t27'];$t28 = $filatest['t28'];
        $t29 = $filatest['t29'];$t30 = $filatest['t30'];$t31 = $filatest['t31'];$t32 = $filatest['t32'];$t33 = $filatest['t33'];$t34 = $filatest['t34'];$t35 = $filatest['t35'];
        $t36 = $filatest['t36'];$t37 = $filatest['t37'];$t38 = $filatest['t38'];$t39 = $filatest['t39'];$t40 = $filatest['t40'];$t41 = $filatest['t41'];$t42 = $filatest['t42'];
        $t43 = $filatest['t43'];$t44 = $filatest['t44'];$t45 = $filatest['t45'];$t46 = $filatest['t46'];$t47 = $filatest['t47'];$t48 = $filatest['t48'];$t49 = $filatest['t49'];
        $td1 = $filatest['td1'];$td2 = $filatest['td2'];$td3 = $filatest['td3'];$td4 = $filatest['td4'];$td5 = $filatest['td5'];$td6 = $filatest['td6'];$td7 = $filatest['td7'];
        $td8 = $filatest['td8'];$td9 = $filatest['td9'];$td10 = $filatest['td10'];$td11 = $filatest['td11'];$td12 = $filatest['td12'];$td13 = $filatest['td13'];$td14 = $filatest['td14'];
        $td15 = $filatest['td15'];$td16 = $filatest['td16'];$td17 = $filatest['td17'];$td18 = $filatest['td18'];$td19 = $filatest['td19'];$td20 = $filatest['td20'];$td21 = $filatest['td21'];
        $td22 = $filatest['td22'];$td23 = $filatest['td23'];$td24 = $filatest['td24'];$td25 = $filatest['td25'];$td26 = $filatest['td26'];$td27 = $filatest['td27'];$td28 = $filatest['td28'];
        $td29 = $filatest['td29'];$td30 = $filatest['td30'];$td31 = $filatest['td31'];$td32 = $filatest['td32'];$td33 = $filatest['td33'];$td34 = $filatest['td34'];$td35 = $filatest['td35'];
        $td36 = $filatest['td36'];$td37 = $filatest['td37'];$td38 = $filatest['td38'];$td39 = $filatest['td39'];$td40 = $filatest['td40'];$td41 = $filatest['td41'];$td42 = $filatest['td42'];
        $td43 = $filatest['td43'];$td44 = $filatest['td44'];$td45 = $filatest['td45'];$td46 = $filatest['td46'];$td47 = $filatest['td47'];$td48 = $filatest['td48'];$td49 = $filatest['td49'];
        $ra1 = $filatest['ra1'];$ra2 = $filatest['ra2'];$ra3 = $filatest['ra3'];$ra4 = $filatest['ra4'];$ra5 = $filatest['ra5'];$ra6 = $filatest['ra6'];$ra7 = $filatest['ra7'];
        $ra8 = $filatest['ra8'];$ra9 = $filatest['ra9'];$ra10 = $filatest['ra10'];$ra11 = $filatest['ra11'];$ra12 = $filatest['ra12'];$ra13 = $filatest['ra13'];$ra14 = $filatest['ra14'];
        $ra15 = $filatest['ra15'];$ra16 = $filatest['ra16'];$ra17 = $filatest['ra17'];$ra18 = $filatest['ra18'];$ra19 = $filatest['ra19'];$ra20 = $filatest['ra20'];$ra21 = $filatest['ra21'];
        $ra22 = $filatest['ra22'];$ra23 = $filatest['ra23'];$ra24 = $filatest['ra24'];$ra25 = $filatest['ra25'];$ra26 = $filatest['ra26'];$ra27 = $filatest['ra27'];$ra28 = $filatest['ra28'];
        $ra29 = $filatest['ra29'];$ra30 = $filatest['ra30'];$ra31 = $filatest['ra31'];$ra32 = $filatest['ra32'];$ra33 = $filatest['ra33'];$ra34 = $filatest['ra34'];$ra35 = $filatest['ra35'];
        $ra36 = $filatest['ra36'];$ra37 = $filatest['ra37'];$ra38 = $filatest['ra38'];$ra39 = $filatest['ra39'];$ra40 = $filatest['ra40'];$ra41 = $filatest['ra41'];$ra42 = $filatest['ra42'];
        $ra43 = $filatest['ra43'];$ra44 = $filatest['ra44'];$ra45 = $filatest['ra45'];$ra46 = $filatest['ra46'];$ra47 = $filatest['ra47'];$ra48 = $filatest['ra48'];$ra49 = $filatest['ra49'];
        $ra50 = $filatest['ra50'];$ra51 = $filatest['ra51'];$ra52 = $filatest['ra52'];$ra53 = $filatest['ra53'];$ra54 = $filatest['ra54'];$ra55 = $filatest['ra55'];
        $ta47 = $filatest['ta47'];$ta48 = $filatest['ta48'];$ta49 = $filatest['ta49'];$ta50 = $filatest['ta50'];$ta51 = $filatest['ta51'];$ta52 = $filatest['ta52'];$ta53 = $filatest['ta53'];
        $ta54 = $filatest['ta54'];$ta55 = $filatest['ta55'];
        $rap1 = $filatest['rap1'];$rap2 = $filatest['rap2'];$rap3 = $filatest['rap3'];$rap4 = $filatest['rap4'];$rap5 = $filatest['rap5'];$rap6 = $filatest['rap6'];$rap7 = $filatest['rap7'];
        $rap8 = $filatest['rap8'];$rap9 = $filatest['rap9'];$rap10 = $filatest['rap10'];$rap11 = $filatest['rap11'];$rap12 = $filatest['rap12'];$rap13 = $filatest['rap13'];$rap14 = $filatest['rap14'];
        $rap15 = $filatest['rap15'];$rap16 = $filatest['rap16'];$rap17 = $filatest['rap17'];$rap18 = $filatest['rap18'];$rap19 = $filatest['rap19'];$rap20 = $filatest['rap20'];
        $rap21 = $filatest['rap21'];
        $raf1 = $filatest['raf1'];$raf2 = $filatest['raf2'];$raf3 = $filatest['raf3'];$raf4 = $filatest['raf4'];$raf5 = $filatest['raf5'];$raf6 = $filatest['raf6'];$raf7 = $filatest['raf7'];
        $raf8 = $filatest['raf8'];$raf9 = $filatest['raf9'];$raf10 = $filatest['raf10'];$raf11 = $filatest['raf11'];$raf12 = $filatest['raf12'];$raf13 = $filatest['raf13'];$raf14 = $filatest['raf14'];
        $raf15 = $filatest['raf15'];$raf16 = $filatest['raf16'];$raf17 = $filatest['raf17'];$raf18 = $filatest['raf18'];$raf19 = $filatest['raf19'];$raf20 = $filatest['raf20'];
        $raf21 = $filatest['raf21'];
        $rac1 = $filatest['rac1'];$rac2 = $filatest['rac2'];$rac3 = $filatest['rac3'];$rac4 = $filatest['rac4'];$rac5 = $filatest['rac5'];$rac6 = $filatest['rac6'];$rac7 = $filatest['rac7'];
        $rac8 = $filatest['rac8'];$rac9 = $filatest['rac9'];$rac10 = $filatest['rac10'];$rac11 = $filatest['rac11'];$rac12 = $filatest['rac12'];$rac13 = $filatest['rac13'];$rac14 = $filatest['rac14'];
        $rac15 = $filatest['rac15'];$rac16 = $filatest['rac16'];$rac17 = $filatest['rac17'];$rac18 = $filatest['rac18'];$rac19 = $filatest['rac19'];$rac20 = $filatest['rac20'];
        $rac21 = $filatest['rac21'];
        $part1 = $filatest['part1'];$part2 = $filatest['part2'];$part3 = $filatest['part3'];$part4 = $filatest['part4'];$part5 = $filatest['part5'];$part6 = $filatest['part6'];$part7 = $filatest['part7'];
        $part8 = $filatest['part8'];$part9 = $filatest['part9'];$part10 = $filatest['part10'];$part11 = $filatest['part11'];$part12 = $filatest['part12'];$part13 = $filatest['part13'];$part14 = $filatest['part14'];
        $part15 = $filatest['part15'];$part16 = $filatest['part16'];$part17 = $filatest['part17'];$part18 = $filatest['part18'];
        $tdf1 = $filatest['tdf1'];$tdf2 = $filatest['tdf2'];$tdf3 = $filatest['tdf3'];$tdf4 = $filatest['tdf4'];$tdf5 = $filatest['tdf5'];$tdf6 = $filatest['tdf6'];$tdf7 = $filatest['tdf7'];
        $tm1 = $filatest['tm1'];$tm2 = $filatest['tm2'];$tm3 = $filatest['tm3'];$tm4 = $filatest['tm4'];$tm5 = $filatest['tm5'];
        $marcha1 = $filatest['marcha1'];$marcha2 = $filatest['marcha2'];$marcha3 = $filatest['marcha3'];$marcha4 = $filatest['marcha4'];
        $balanceo1 = $filatest['balanceo1'];$balanceo2 = $filatest['balanceo2'];$balanceo3 = $filatest['balanceo3'];
    
}
?>
<!doctype html>
<html lang="en">

    <head>


        <meta charset="utf-8"/>
        <title>Sistema Integral</title>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
        <script>
            $(function () {
                $("#tabs").tabs();
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function () {
                $("#btnloading").click(function () {
                    $('.mostrarload').css('display', 'block');
                            setTimeout(function () {
                                $(".mostrarload").fadeOut(1500);
                            }, 1000);
		});
                $("#guardar_mc").click(function () {
                    var orden = $("#orden").val();
                    var paciente = $("#paciente").val();
                    var peso = $("#peso").val();
                    var talla = $("#talla").val();
                    //var imc = $("#imc").val;
                    var p1 = $("#pem1").val();var p2 = $("#pem2").val();var p3 = $("#pem3").val();var p4 = $("#pem4").val();
                    var p5 = $("#pem5").val();var p6 = $("#pem6").val();var p7 = $("#pem7").val();var p8 = $("#pem8").val();
                    var p9 = $("#pem9").val();var p10 = $("#pem10").val();var p11 = $("#pem11").val();var p12 = $("#pem12").val();
                    var p13 = $("#pem13").val();var p14 = $("#pem14").val();var p15 = $("#pem15").val();var p16 = $("#pem16").val();
                    var p17 = $("#pem17").val();var p18 = $("#pem18").val();var p19 = $("#pem19").val();var p20 = $("#pem20").val();
                    var p21 = $("#pem21").val();var p22 = $("#pem22").val();
                    
                    var ti1 = $("#ti1").val();var ti2 = $("#ti2").val();var ti3 = $("#ti3").val();var ti4 = $("#ti4").val();
                    var ti5 = $("#ti5").val();var ti6 = $("#ti6").val();var ti7 = $("#ti7").val();var ti8 = $("#ti8").val();
                    var ti9 = $("#ti9").val();var ti10 = $("#ti10").val();var ti11 = $("#ti11").val();var ti12 = $("#ti12").val();
                    var ti13 = $("#ti13").val();var ti14 = $("#ti14").val();var ti15 = $("#ti15").val();var ti16 = $("#ti16").val();
                    var ti17 = $("#ti17").val();var ti18 = $("#ti18").val();var ti19 = $("#ti19").val();var ti20 = $("#ti20").val();
                    var ti21 = $("#ti21").val();var ti22 = $("#ti22").val();var ti23 = $("#ti23").val();var ti24 = $("#ti24").val();
                    var ti25 = $("#ti25").val();var ti26 = $("#ti26").val();var ti27 = $("#ti27").val();var ti28 = $("#ti28").val();
                    var ti29 = $("#ti29").val();var ti30 = $("#ti30").val();var ti31 = $("#ti31").val();var ti32 = $("#ti32").val();
                    var ti33 = $("#ti33").val();var ti34 = $("#ti34").val();var ti35 = $("#ti35").val();var ti36 = $("#ti36").val();
                    var ti37 = $("#ti37").val();var ti38 = $("#ti38").val();var ti39 = $("#ti39").val();var ti40 = $("#ti40").val();
                    var ti41 = $("#ti41").val();var ti42 = $("#ti42").val();var ti43 = $("#ti43").val();var ti44 = $("#ti44").val();
                    var ti45 = $("#ti45").val();var ti46 = $("#ti46").val();var ti47 = $("#ti47").val();var ti48 = $("#ti48").val();
                    var ti49 = $("#ti49").val();
                    var td1 = $("#td1").val();var td2 = $("#td2").val();var td3 = $("#td3").val();var td4 = $("#td4").val();
                    var td5 = $("#td5").val();var td6 = $("#td6").val();var td7 = $("#td7").val();var td8 = $("#td8").val();
                    var td9 = $("#td9").val();var td10 = $("#td10").val();var td11 = $("#td11").val();var td12 = $("#td12").val();
                    var td13 = $("#td13").val();var td14 = $("#td14").val();var td15 = $("#td15").val();var td16 = $("#td16").val();
                    var td17 = $("#td17").val();var td18 = $("#td18").val();var td19 = $("#td19").val();var td20 = $("#td20").val();
                    var td21 = $("#td21").val();var td22 = $("#td22").val();var td23 = $("#td23").val();var td24 = $("#td24").val();
                    var td25 = $("#td25").val();var td26 = $("#td26").val();var td27 = $("#td27").val();var td28 = $("#td28").val();
                    var td29 = $("#td29").val();var td30 = $("#td30").val();var td31 = $("#td31").val();var td32 = $("#td32").val();
                    var td33 = $("#td33").val();var td34 = $("#td34").val();var td35 = $("#td35").val();var td36 = $("#td36").val();
                    var td37 = $("#td37").val();var td38 = $("#td38").val();var td39 = $("#td39").val();var td40 = $("#td40").val();
                    var td41 = $("#td41").val();var td42 = $("#td42").val();var td43 = $("#td43").val();var td44 = $("#td44").val();
                    var td45 = $("#td45").val();var td46 = $("#td46").val();var td47 = $("#td47").val();var td48 = $("#td48").val();
                    var td49 = $("#td49").val();
                    
                    var ra1 = $("input:radio[name=ra1]:checked").val();var ra2 = $("input:radio[name=ra2]:checked").val();
                    var ra3 = $("input:radio[name=ra3]:checked").val();var ra4 = $("input:radio[name=ra4]:checked").val();
                    var ra5 = $("input:radio[name=ra5]:checked").val();var ra6 = $("input:radio[name=ra6]:checked").val();
                    var ra7 = $("input:radio[name=ra7]:checked").val();var ra8 = $("input:radio[name=ra8]:checked").val();
                    var ra9 = $("input:radio[name=ra9]:checked").val();var ra10 = $("input:radio[name=ra10]:checked").val();
                    var ra11 = $("input:radio[name=ra11]:checked").val();var ra12 = $("input:radio[name=ra12]:checked").val();
                    var ra13 = $("input:radio[name=ra13]:checked").val();var ra14 = $("input:radio[name=ra14]:checked").val();
                    var ra15 = $("input:radio[name=ra15]:checked").val();var ra16 = $("input:radio[name=ra16]:checked").val();
                    var ra17 = $("input:radio[name=ra17]:checked").val();var ra18 = $("input:radio[name=ra18]:checked").val();
                    var ra19 = $("input:radio[name=ra19]:checked").val();var ra20 = $("input:radio[name=ra20]:checked").val();
                    var ra21 = $("input:radio[name=ra21]:checked").val();var ra22 = $("input:radio[name=ra22]:checked").val();
                    var ra23 = $("input:radio[name=ra23]:checked").val();var ra24 = $("input:radio[name=ra24]:checked").val();
                    var ra25 = $("input:radio[name=ra25]:checked").val();var ra26 = $("input:radio[name=ra26]:checked").val();
                    var ra27 = $("input:radio[name=ra27]:checked").val();var ra28 = $("input:radio[name=ra28]:checked").val();
                    var ra29 = $("input:radio[name=ra29]:checked").val();var ra30 = $("input:radio[name=ra30]:checked").val();
                    var ra31 = $("input:radio[name=ra31]:checked").val();var ra32 = $("input:radio[name=ra32]:checked").val();
                    var ra33 = $("input:radio[name=ra33]:checked").val();var ra34 = $("input:radio[name=ra34]:checked").val();
                    var ra35 = $("input:radio[name=ra35]:checked").val();var ra36 = $("input:radio[name=ra36]:checked").val();
                    var ra37 = $("input:radio[name=ra37]:checked").val();var ra38 = $("input:radio[name=ra38]:checked").val();
                    var ra39 = $("input:radio[name=ra39]:checked").val();var ra40 = $("input:radio[name=ra40]:checked").val();
                    var ra41 = $("input:radio[name=ra41]:checked").val();var ra42 = $("input:radio[name=ra42]:checked").val();
                    var ra43 = $("input:radio[name=ra43]:checked").val();var ra44 = $("input:radio[name=ra44]:checked").val();
                    var ra45 = $("input:radio[name=ra45]:checked").val();var ra46 = $("input:radio[name=ra46]:checked").val();
                    var ra47 = $("input:radio[name=ra47]:checked").val();var ra48 = $("input:radio[name=ra48]:checked").val();
                    var ra49 = $("input:radio[name=ra49]:checked").val();var ra50 = $("input:radio[name=ra50]:checked").val();
                    var ra51 = $("input:radio[name=ra51]:checked").val();var ra52 = $("input:radio[name=ra52]:checked").val();
                    var ra53 = $("input:radio[name=ra53]:checked").val();var ra54 = $("input:radio[name=ra54]:checked").val();
                    var ra55 = $("input:radio[name=ra55]:checked").val();
                    
                    var ta47 = $("#ta47").val();var ta48 = $("#ta48").val();
                    var ta49 = $("#ta49").val();var ta50 = $("#ta50").val();var ta51 = $("#ta51").val();var ta52 = $("#ta52").val();
                    var ta53 = $("#ta53").val();var ta54 = $("#ta54").val();var ta55 = $("#ta55").val();
                    
                    var rap1 = $("input:radio[name=rap1]:checked").val();var rap2 = $("input:radio[name=rap2]:checked").val();
                    var rap3 = $("input:radio[name=rap3]:checked").val();var rap4 = $("input:radio[name=rap4]:checked").val();
                    var rap5 = $("input:radio[name=rap5]:checked").val();var rap6 = $("input:radio[name=rap6]:checked").val();
                    var rap7 = $("input:radio[name=rap7]:checked").val();var rap8 = $("input:radio[name=rap8]:checked").val();
                    var rap9 = $("input:radio[name=rap9]:checked").val();var rap10 = $("input:radio[name=rap10]:checked").val();
                    var rap11 = $("input:radio[name=rap11]:checked").val();var rap12 = $("input:radio[name=rap12]:checked").val();
                    var rap13 = $("input:radio[name=rap13]:checked").val();var rap14 = $("input:radio[name=rap14]:checked").val();
                    var rap15 = $("input:radio[name=rap15]:checked").val();var rap16 = $("input:radio[name=rap16]:checked").val();
                    var rap17 = $("input:radio[name=rap17]:checked").val();var rap18 = $("input:radio[name=rap18]:checked").val();
                    var rap19 = $("input:radio[name=rap19]:checked").val();var rap20 = $("input:radio[name=rap20]:checked").val();
                    var rap21 = $("input:radio[name=rap21]:checked").val();
                    
                    var rac1 = $("input:radio[name=rac1]:checked").val();var rac2 = $("input:radio[name=rac2]:checked").val();
                    var rac3 = $("input:radio[name=rac3]:checked").val();var rac4 = $("input:radio[name=rac4]:checked").val();
                    var rac5 = $("input:radio[name=rac5]:checked").val();var rac6 = $("input:radio[name=rac6]:checked").val();
                    var rac7 = $("input:radio[name=rac7]:checked").val();var rac8 = $("input:radio[name=rac8]:checked").val();
                    var rac9 = $("input:radio[name=rac9]:checked").val();var rac10 = $("input:radio[name=rac10]:checked").val();
                    var rac11 = $("input:radio[name=rac11]:checked").val();var rac12 = $("input:radio[name=rac12]:checked").val();
                    var rac13 = $("input:radio[name=rac13]:checked").val();var rac14 = $("input:radio[name=rac14]:checked").val();
                    var rac15 = $("input:radio[name=rac15]:checked").val();var rac16 = $("input:radio[name=rac16]:checked").val();
                    var rac17 = $("input:radio[name=rac17]:checked").val();var rac18 = $("input:radio[name=rac18]:checked").val();
                    var rac19 = $("input:radio[name=rac19]:checked").val();var rac20 = $("input:radio[name=rac20]:checked").val();
                    var rac21 = $("input:radio[name=rac21]:checked").val();
                    
                    var raf1 = $("input:radio[name=raf1]:checked").val();var raf2 = $("input:radio[name=raf2]:checked").val();
                    var raf3 = $("input:radio[name=raf3]:checked").val();var raf4 = $("input:radio[name=raf4]:checked").val();
                    var raf5 = $("input:radio[name=raf5]:checked").val();var raf6 = $("input:radio[name=raf6]:checked").val();
                    var raf7 = $("input:radio[name=raf7]:checked").val();var raf8 = $("input:radio[name=raf8]:checked").val();
                    var raf9 = $("input:radio[name=raf9]:checked").val();var raf10 = $("input:radio[name=raf10]:checked").val();
                    var raf11 = $("input:radio[name=raf11]:checked").val();var raf12 = $("input:radio[name=raf12]:checked").val();
                    var raf13 = $("input:radio[name=raf13]:checked").val();var raf14 = $("input:radio[name=raf14]:checked").val();
                    var raf15 = $("input:radio[name=raf15]:checked").val();var raf16 = $("input:radio[name=raf16]:checked").val();
                    var raf17 = $("input:radio[name=raf17]:checked").val();var raf18 = $("input:radio[name=raf18]:checked").val();
                    var raf19 = $("input:radio[name=raf19]:checked").val();var raf20 = $("input:radio[name=raf20]:checked").val();
                    var raf21 = $("input:radio[name=raf21]:checked").val();
                    
                    var part1 = $("#part1").val();var part2 = $("#part2").val();var part3 = $("#part3").val();var part4 = $("#part4").val();
                    var part5 = $("#part5").val();var part6 = $("#part6").val();var part7 = $("#part7").val();var part8 = $("#part8").val();
                    var part9 = $("#part9").val();var part10 = $("#part10").val();var part11 = $("#part11").val();var part12 = $("#part12").val();
                    var part13 = $("#part13").val();var part14 = $("#part14").val();var part15 = $("#part15").val();var part16 = $("#part16").val();
                    var part17 = $("#part17").val();var part18 = $("#part18").val();
                    var tdf1 = $("#tdf1").val();var tdf2 = $("#tdf2").val();var tdf3 = $("#tdf3").val();var tdf4 = $("#tdf4").val();
                    var tdf5 = $("#tdf5").val();var tdf6 = $("#tdf6").val();var tdf7 = $("#tdf7").val();
                    var tm1 = $("#tm1").val();var tm2 = $("#tm2").val();var tm3 = $("#tm3").val();var tm4 = $("#tm4").val();
                    var tm5 = $("#tm5").val();
                    var marcha1 = $("#marcha1").val();var marcha2 = $("#marcha2").val();var marcha3 = $("#marcha3").val();var marcha4 = $("#marcha4").val();
                    
                    var balanceo1 = $("#balanceo1").val();var balanceo2 = $("#balanceo2").val();var balanceo3 = $("#balanceo3").val();

                    $.ajax({
                        type: "GET",
                        url: "../modelo/cargarmotivoconsulta.php?p1=" + p1 + "&p2=" + p2 + "&p3=" + p3 + "&p4=" + p4 + "&p5=" + p5 + "&p6=" + p6 +
                                "&p7=" + p7 + "&p8=" + p8 + "&p9=" + p9 + "&p10=" + p10 + "&p11=" + p11 + "&p12=" + p12 + "&p13=" + p13 + "&p14=" + p14 +
                                "&p15=" + p15 + "&p16=" + p16 + "&p17=" + p17 + "&p18=" + p18 + "&p19=" + p19 + "&p20=" + p20 + "&p21=" + p21 + "&p22=" + p22 +
                                "&ti1=" + ti1 + "&ti2=" + ti2 + "&ti3=" + ti3 + "&ti4=" + ti4 + "&ti5=" + ti5 + "&ti6=" + ti6 +
                                "&ti7=" + ti7 + "&ti8=" + ti8 + "&ti9=" + ti9 + "&ti10=" + ti10 + "&ti11=" + ti11 + "&ti12=" + ti12 + "&ti13=" + ti13 + "&ti14=" + ti14 +
                                "&ti15=" + ti15 + "&ti16=" + ti16 + "&ti17=" + ti17 + "&ti18=" + ti18 + "&ti19=" + ti19 + "&ti20=" + ti20 + "&ti21=" + ti21 + "&ti22=" + ti22 +
                                "&ti23=" + ti23 + "&ti24=" + ti24 + "&ti25=" + ti25 + "&ti26=" + ti26 + "&ti27=" + ti27 + "&ti28=" + ti28 + "&ti29=" + ti29 + "&ti30=" + ti30 +
                                "&ti31=" + ti31 + "&ti32=" + ti32 + "&ti33=" + ti33 + "&ti34=" + ti34 + "&ti35=" + ti35 + "&ti36=" + ti36 + "&ti37=" + ti37 + "&ti38=" + ti38 +
                                "&ti39=" + ti39 + "&ti40=" + ti40 + "&ti41=" + ti41 + "&ti42=" + ti42 + "&ti43=" + ti43 + "&ti44=" + ti44 + "&ti45=" + ti45 + "&ti46=" + ti46 +
                                "&ti47=" + ti47 + "&ti48=" + ti48 + "&ti49=" + ti49 +
                                "&td1=" + td1 + "&td2=" + td2 + "&td3=" + td3 + "&td4=" + td4 + "&td5=" + td5 + "&td6=" + td6 +
                                "&td7=" + td7 + "&td8=" + td8 + "&td9=" + td9 + "&td10=" + td10 + "&td11=" + td11 + "&td12=" + td12 + "&td13=" + td13 + "&td14=" + td14 +
                                "&td15=" + td15 + "&td16=" + td16 + "&td17=" + td17 + "&td18=" + td18 + "&td19=" + td19 + "&td20=" + td20 + "&td21=" + td21 + "&td22=" + td22 +
                                "&td23=" + td23 + "&td24=" + td24 + "&td25=" + td25 + "&td26=" + td26 + "&td27=" + td27 + "&td28=" + td28 + "&td29=" + td29 + "&td30=" + td30 +
                                "&td31=" + td31 + "&td32=" + td32 + "&td33=" + td33 + "&td34=" + td34 + "&td35=" + td35 + "&td36=" + td36 + "&td37=" + td37 + "&td38=" + td38 +
                                "&td39=" + td39 + "&td40=" + td40 + "&td41=" + td41 + "&td42=" + td42 + "&td43=" + td43 + "&td44=" + td44 + "&td45=" + td45 + "&td46=" + td46 +
                                "&td47=" + td47 + "&td48=" + td48 + "&td49=" + td49 +
                                "&ra1=" + ra1 + "&ra2=" + ra2 + "&ra3=" + ra3 + "&ra4=" + ra4 + "&ra5=" + ra5 + "&ra6=" + ra6 +
                                "&ra7=" + ra7 + "&ra8=" + ra8 + "&ra9=" + ra9 + "&ra10=" + ra10 + "&ra11=" + ra11 + "&ra12=" + ra12 + "&ra13=" + ra13 + "&ra14=" + ra14 +
                                "&ra15=" + ra15 + "&ra16=" + ra16 + "&ra17=" + ra17 + "&ra18=" + ra18 + "&ra19=" + ra19 + "&ra20=" + ra20 + "&ra21=" + ra21 + "&ra22=" + ra22 +
                                "&ra23=" + ra23 + "&ra24=" + ra24 + "&ra25=" + ra25 + "&ra26=" + ra26 + "&ra27=" + ra27 + "&ra28=" + ra28 + "&ra29=" + ra29 + "&ra30=" + ra30 +
                                "&ra31=" + ra31 + "&ra32=" + ra32 + "&ra33=" + ra33 + "&ra34=" + ra34 + "&ra35=" + ra35 + "&ra36=" + ra36 + "&ra37=" + ra37 + "&ra38=" + ra38 +
                                "&ra39=" + ra39 + "&ra40=" + ra40 + "&ra41=" + ra41 + "&ra42=" + ra42 + "&ra43=" + ra43 + "&ra44=" + ra44 + "&ra45=" + ra45 + "&ra46=" + ra46 +
                                "&ra47=" + ra47 + "&ra48=" + ra48 + "&ra49=" + ra49 + "&ra50=" + ra50 + "&ra51=" + ra51 + "&ra52=" + ra52 + "&ra53=" + ra53 + "&ra54=" + ra54 +
                                "&ra55=" + ra55 +
                                "&ta47=" + ta47 + "&ta48=" + ta48 + "&ta49=" + ta49 + "&ta50=" + ta50 + "&ta51=" + ta51 + "&ta52=" + ta52 + "&ta53=" + ta53 + "&ta54=" + ta54 +
                                "&ta55=" + ta55 +
                                "&rap1=" + rap1 + "&rap2=" + rap2 + "&rap3=" + rap3 + "&rap4=" + rap4 + "&rap5=" + rap5 + "&rap6=" + rap6 +
                                "&rap7=" + rap7 + "&rap8=" + rap8 + "&rap9=" + rap9 + "&rap10=" + rap10 + "&rap11=" + rap11 + "&rap12=" + rap12 + "&rap13=" + rap13 + "&rap14=" + rap14 +
                                "&rap15=" + rap15 + "&rap16=" + rap16 + "&rap17=" + rap17 + "&rap18=" + rap18 + "&rap19=" + rap19 + "&rap20=" + rap20 + "&rap21=" + rap21 + 
                                "&rac1=" + rac1 + "&rac2=" + rac2 + "&rac3=" + rac3 + "&rac4=" + rac4 + "&rac5=" + rac5 + "&rac6=" + rac6 +
                                "&rac7=" + rac7 + "&rac8=" + rac8 + "&rac9=" + rac9 + "&rac10=" + rac10 + "&rac11=" + rac11 + "&rac12=" + rac12 + "&rac13=" + rac13 + "&rac14=" + rac14 +
                                "&rac15=" + rac15 + "&rac16=" + rac16 + "&rac17=" + rac17 + "&rac18=" + rac18 + "&rac19=" + rac19 + "&rac20=" + rac20 + "&rac21=" + rac21 + 
                                "&raf1=" + raf1 + "&raf2=" + raf2 + "&raf3=" + raf3 + "&raf4=" + raf4 + "&raf5=" + raf5 + "&raf6=" + raf6 +
                                "&raf7=" + raf7 + "&raf8=" + raf8 + "&raf9=" + raf9 + "&raf10=" + raf10 + "&raf11=" + raf11 + "&raf12=" + raf12 + "&raf13=" + raf13 + "&raf14=" + raf14 +
                                "&raf15=" + raf15 + "&raf16=" + raf16 + "&raf17=" + raf17 + "&raf18=" + raf18 + "&raf19=" + raf19 + "&raf20=" + raf20 + "&raf21=" + raf21 + 
                                "&part1=" + part1 + "&part2=" + part2 + "&part3=" + part3 + "&part4=" + part4 + "&part5=" + part5 + "&part6=" + part6 +
                                "&part7=" + part7 + "&part8=" + part8 + "&part9=" + part9 + "&part10=" + part10 + "&part11=" + part11 + "&part12=" + part12 + "&part13=" + part13 + "&part14=" + part14 +
                                "&part15=" + part15 + "&part16=" + part16 + "&part17=" + part17 + "&part18=" + part18 +
                                "&tdf1=" + tdf1 + "&tdf2=" + tdf2 + "&tdf3=" + tdf3 + "&tdf4=" + tdf4 + "&tdf5=" + tdf5 + "&tdf6=" + tdf6 +
                                "&tdf7=" + tdf7 +
                                "&tm1=" + tm1 + "&tm2=" + tm2 + "&tm3=" + tm3 + "&tm4=" + tm4 + "&tm5=" + tm5 + 
                                "&marcha1=" + marcha1 + "&marcha2=" + marcha2 + "&marcha3=" + marcha3 + "&marcha4=" + marcha4 + 
                                "&balanceo1=" + balanceo1 + "&balanceo2=" + balanceo2 + "&balanceo3=" + balanceo3 +
                                "&orden=" + orden + "&paciente=" + paciente + "&peso=" + peso + "&talla=" + talla,
                        success: function (result) {
                            alert(result);
                            if(result == 1){
                                alert('Datos Guardados');
                                $('.mostrarload').css('display', 'block');
                                    setTimeout(function () {
                                    $(".mostrarload").fadeOut(1500);
                                }, 2000);
                                location.href="../controlador/test_medidas.php?cod=<?php echo $_GET['cod']; ?>";
                            }else{
                                alert('Datos No Guardados');
                            }
                        }
                    });
                });
                //Boton Actualizar
                    $("#actualiza_mc").click(function () {
                    var orden = $("#orden").val();
                    var paciente = $("#paciente").val();
                    var peso = $("#peso").val();
                    var talla = $("#talla").val();
                    var test = $("#test").val();
                    //var imc = $("#imc").val;
                    var p1 = $("#pem1").val();var p2 = $("#pem2").val();var p3 = $("#pem3").val();var p4 = $("#pem4").val();
                    var p5 = $("#pem5").val();var p6 = $("#pem6").val();var p7 = $("#pem7").val();var p8 = $("#pem8").val();
                    var p9 = $("#pem9").val();var p10 = $("#pem10").val();var p11 = $("#pem11").val();var p12 = $("#pem12").val();
                    var p13 = $("#pem13").val();var p14 = $("#pem14").val();var p15 = $("#pem15").val();var p16 = $("#pem16").val();
                    var p17 = $("#pem17").val();var p18 = $("#pem18").val();var p19 = $("#pem19").val();var p20 = $("#pem20").val();
                    var p21 = $("#pem21").val();var p22 = $("#pem22").val();
                    var ti1 = $("#ti1").val();var ti2 = $("#ti2").val();var ti3 = $("#ti3").val();var ti4 = $("#ti4").val();
                    var ti5 = $("#ti5").val();var ti6 = $("#ti6").val();var ti7 = $("#ti7").val();var ti8 = $("#ti8").val();
                    var ti9 = $("#ti9").val();var ti10 = $("#ti10").val();var ti11 = $("#ti11").val();var ti12 = $("#ti12").val();
                    var ti13 = $("#ti13").val();var ti14 = $("#ti14").val();var ti15 = $("#ti15").val();var ti16 = $("#ti16").val();
                    var ti17 = $("#ti17").val();var ti18 = $("#ti18").val();var ti19 = $("#ti19").val();var ti20 = $("#ti20").val();
                    var ti21 = $("#ti21").val();var ti22 = $("#ti22").val();var ti23 = $("#ti23").val();var ti24 = $("#ti24").val();
                    var ti25 = $("#ti25").val();var ti26 = $("#ti26").val();var ti27 = $("#ti27").val();var ti28 = $("#ti28").val();
                    var ti29 = $("#ti29").val();var ti30 = $("#ti30").val();var ti31 = $("#ti31").val();var ti32 = $("#ti32").val();
                    var ti33 = $("#ti33").val();var ti34 = $("#ti34").val();var ti35 = $("#ti35").val();var ti36 = $("#ti36").val();
                    var ti37 = $("#ti37").val();var ti38 = $("#ti38").val();var ti39 = $("#ti39").val();var ti40 = $("#ti40").val();
                    var ti41 = $("#ti41").val();var ti42 = $("#ti42").val();var ti43 = $("#ti43").val();var ti44 = $("#ti44").val();
                    var ti45 = $("#ti45").val();var ti46 = $("#ti46").val();var ti47 = $("#ti47").val();var ti48 = $("#ti48").val();
                    var ti49 = $("#ti49").val();
                    var td1 = $("#td1").val();var td2 = $("#td2").val();var td3 = $("#td3").val();var td4 = $("#td4").val();
                    var td5 = $("#td5").val();var td6 = $("#td6").val();var td7 = $("#td7").val();var td8 = $("#td8").val();
                    var td9 = $("#td9").val();var td10 = $("#td10").val();var td11 = $("#td11").val();var td12 = $("#td12").val();
                    var td13 = $("#td13").val();var td14 = $("#td14").val();var td15 = $("#td15").val();var td16 = $("#td16").val();
                    var td17 = $("#td17").val();var td18 = $("#td18").val();var td19 = $("#td19").val();var td20 = $("#td20").val();
                    var td21 = $("#td21").val();var td22 = $("#td22").val();var td23 = $("#td23").val();var td24 = $("#td24").val();
                    var td25 = $("#td25").val();var td26 = $("#td26").val();var td27 = $("#td27").val();var td28 = $("#td28").val();
                    var td29 = $("#td29").val();var td30 = $("#td30").val();var td31 = $("#td31").val();var td32 = $("#td32").val();
                    var td33 = $("#td33").val();var td34 = $("#td34").val();var td35 = $("#td35").val();var td36 = $("#td36").val();
                    var td37 = $("#td37").val();var td38 = $("#td38").val();var td39 = $("#td39").val();var td40 = $("#td40").val();
                    var td41 = $("#td41").val();var td42 = $("#td42").val();var td43 = $("#td43").val();var td44 = $("#td44").val();
                    var td45 = $("#td45").val();var td46 = $("#td46").val();var td47 = $("#td47").val();var td48 = $("#td48").val();
                    var td49 = $("#td49").val();
                    var ra1 = $("input:radio[name=ra1]:checked").val();var ra2 = $("input:radio[name=ra2]:checked").val();
                    var ra3 = $("input:radio[name=ra3]:checked").val();var ra4 = $("input:radio[name=ra4]:checked").val();
                    var ra5 = $("input:radio[name=ra5]:checked").val();var ra6 = $("input:radio[name=ra6]:checked").val();
                    var ra7 = $("input:radio[name=ra7]:checked").val();var ra8 = $("input:radio[name=ra8]:checked").val();
                    var ra9 = $("input:radio[name=ra9]:checked").val();var ra10 = $("input:radio[name=ra10]:checked").val();
                    var ra11 = $("input:radio[name=ra11]:checked").val();var ra12 = $("input:radio[name=ra12]:checked").val();
                    var ra13 = $("input:radio[name=ra13]:checked").val();var ra14 = $("input:radio[name=ra14]:checked").val();
                    var ra15 = $("input:radio[name=ra15]:checked").val();var ra16 = $("input:radio[name=ra16]:checked").val();
                    var ra17 = $("input:radio[name=ra17]:checked").val();var ra18 = $("input:radio[name=ra18]:checked").val();
                    var ra19 = $("input:radio[name=ra19]:checked").val();var ra20 = $("input:radio[name=ra20]:checked").val();
                    var ra21 = $("input:radio[name=ra21]:checked").val();var ra22 = $("input:radio[name=ra22]:checked").val();
                    var ra23 = $("input:radio[name=ra23]:checked").val();var ra24 = $("input:radio[name=ra24]:checked").val();
                    var ra25 = $("input:radio[name=ra25]:checked").val();var ra26 = $("input:radio[name=ra26]:checked").val();
                    var ra27 = $("input:radio[name=ra27]:checked").val();var ra28 = $("input:radio[name=ra28]:checked").val();
                    var ra29 = $("input:radio[name=ra29]:checked").val();var ra30 = $("input:radio[name=ra30]:checked").val();
                    var ra31 = $("input:radio[name=ra31]:checked").val();var ra32 = $("input:radio[name=ra32]:checked").val();
                    var ra33 = $("input:radio[name=ra33]:checked").val();var ra34 = $("input:radio[name=ra34]:checked").val();
                    var ra35 = $("input:radio[name=ra35]:checked").val();var ra36 = $("input:radio[name=ra36]:checked").val();
                    var ra37 = $("input:radio[name=ra37]:checked").val();var ra38 = $("input:radio[name=ra38]:checked").val();
                    var ra39 = $("input:radio[name=ra39]:checked").val();var ra40 = $("input:radio[name=ra40]:checked").val();
                    var ra41 = $("input:radio[name=ra41]:checked").val();var ra42 = $("input:radio[name=ra42]:checked").val();
                    var ra43 = $("input:radio[name=ra43]:checked").val();var ra44 = $("input:radio[name=ra44]:checked").val();
                    var ra45 = $("input:radio[name=ra45]:checked").val();var ra46 = $("input:radio[name=ra46]:checked").val();
                    var ra47 = $("input:radio[name=ra47]:checked").val();var ra48 = $("input:radio[name=ra48]:checked").val();
                    var ra49 = $("input:radio[name=ra49]:checked").val();var ra50 = $("input:radio[name=ra50]:checked").val();
                    var ra51 = $("input:radio[name=ra51]:checked").val();var ra52 = $("input:radio[name=ra52]:checked").val();
                    var ra53 = $("input:radio[name=ra53]:checked").val();var ra54 = $("input:radio[name=ra54]:checked").val();
                    var ra55 = $("input:radio[name=ra55]:checked").val();
                    
                    var ta47 = $("#ta47").val();var ta48 = $("#ta48").val();
                    var ta49 = $("#ta49").val();var ta50 = $("#ta50").val();var ta51 = $("#ta51").val();var ta52 = $("#ta52").val();
                    var ta53 = $("#ta53").val();var ta54 = $("#ta54").val();var ta55 = $("#ta55").val();
                    
                    var rap1 = $("input:radio[name=rap1]:checked").val();var rap2 = $("input:radio[name=rap2]:checked").val();
                    var rap3 = $("input:radio[name=rap3]:checked").val();var rap4 = $("input:radio[name=rap4]:checked").val();
                    var rap5 = $("input:radio[name=rap5]:checked").val();var rap6 = $("input:radio[name=rap6]:checked").val();
                    var rap7 = $("input:radio[name=rap7]:checked").val();var rap8 = $("input:radio[name=rap8]:checked").val();
                    var rap9 = $("input:radio[name=rap9]:checked").val();var rap10 = $("input:radio[name=rap10]:checked").val();
                    var rap11 = $("input:radio[name=rap11]:checked").val();var rap12 = $("input:radio[name=rap12]:checked").val();
                    var rap13 = $("input:radio[name=rap13]:checked").val();var rap14 = $("input:radio[name=rap14]:checked").val();
                    var rap15 = $("input:radio[name=rap15]:checked").val();var rap16 = $("input:radio[name=rap16]:checked").val();
                    var rap17 = $("input:radio[name=rap17]:checked").val();var rap18 = $("input:radio[name=rap18]:checked").val();
                    var rap19 = $("input:radio[name=rap19]:checked").val();var rap20 = $("input:radio[name=rap20]:checked").val();
                    var rap21 = $("input:radio[name=rap21]:checked").val();
                    
                    var rac1 = $("input:radio[name=rac1]:checked").val();var rac2 = $("input:radio[name=rac2]:checked").val();
                    var rac3 = $("input:radio[name=rac3]:checked").val();var rac4 = $("input:radio[name=rac4]:checked").val();
                    var rac5 = $("input:radio[name=rac5]:checked").val();var rac6 = $("input:radio[name=rac6]:checked").val();
                    var rac7 = $("input:radio[name=rac7]:checked").val();var rac8 = $("input:radio[name=rac8]:checked").val();
                    var rac9 = $("input:radio[name=rac9]:checked").val();var rac10 = $("input:radio[name=rac10]:checked").val();
                    var rac11 = $("input:radio[name=rac11]:checked").val();var rac12 = $("input:radio[name=rac12]:checked").val();
                    var rac13 = $("input:radio[name=rac13]:checked").val();var rac14 = $("input:radio[name=rac14]:checked").val();
                    var rac15 = $("input:radio[name=rac15]:checked").val();var rac16 = $("input:radio[name=rac16]:checked").val();
                    var rac17 = $("input:radio[name=rac17]:checked").val();var rac18 = $("input:radio[name=rac18]:checked").val();
                    var rac19 = $("input:radio[name=rac19]:checked").val();var rac20 = $("input:radio[name=rac20]:checked").val();
                    var rac21 = $("input:radio[name=rac21]:checked").val();
                    
                    var raf1 = $("input:radio[name=raf1]:checked").val();var raf2 = $("input:radio[name=raf2]:checked").val();
                    var raf3 = $("input:radio[name=raf3]:checked").val();var raf4 = $("input:radio[name=raf4]:checked").val();
                    var raf5 = $("input:radio[name=raf5]:checked").val();var raf6 = $("input:radio[name=raf6]:checked").val();
                    var raf7 = $("input:radio[name=raf7]:checked").val();var raf8 = $("input:radio[name=raf8]:checked").val();
                    var raf9 = $("input:radio[name=raf9]:checked").val();var raf10 = $("input:radio[name=raf10]:checked").val();
                    var raf11 = $("input:radio[name=raf11]:checked").val();var raf12 = $("input:radio[name=raf12]:checked").val();
                    var raf13 = $("input:radio[name=raf13]:checked").val();var raf14 = $("input:radio[name=raf14]:checked").val();
                    var raf15 = $("input:radio[name=raf15]:checked").val();var raf16 = $("input:radio[name=raf16]:checked").val();
                    var raf17 = $("input:radio[name=raf17]:checked").val();var raf18 = $("input:radio[name=raf18]:checked").val();
                    var raf19 = $("input:radio[name=raf19]:checked").val();var raf20 = $("input:radio[name=raf20]:checked").val();
                    var raf21 = $("input:radio[name=raf21]:checked").val();
                    
                    var part1 = $("#part1").val();var part2 = $("#part2").val();var part3 = $("#part3").val();var part4 = $("#part4").val();
                    var part5 = $("#part5").val();var part6 = $("#part6").val();var part7 = $("#part7").val();var part8 = $("#part8").val();
                    var part9 = $("#part9").val();var part10 = $("#part10").val();var part11 = $("#part11").val();var part12 = $("#part12").val();
                    var part13 = $("#part13").val();var part14 = $("#part14").val();var part15 = $("#part15").val();var part16 = $("#part16").val();
                    var part17 = $("#part17").val();var part18 = $("#part18").val();
                    var tdf1 = $("#tdf1").val();var tdf2 = $("#tdf2").val();var tdf3 = $("#tdf3").val();var tdf4 = $("#tdf4").val();
                    var tdf5 = $("#tdf5").val();var tdf6 = $("#tdf6").val();var tdf7 = $("#tdf7").val();
                    var tm1 = $("#tm1").val();var tm2 = $("#tm2").val();var tm3 = $("#tm3").val();var tm4 = $("#tm4").val();
                    var tm5 = $("#tm5").val();
                    var marcha1 = $("#marcha1").val();var marcha2 = $("#marcha2").val();var marcha3 = $("#marcha3").val();var marcha4 = $("#marcha4").val();
                    
                    var balanceo1 = $("#balanceo1").val();var balanceo2 = $("#balanceo2").val();var balanceo3 = $("#balanceo3").val();
                    $.ajax({
                        type: "POST",
                        url: "../modelo/actualizamotivo.php",
                        data: "p1=" + p1 + "&p2=" + p2 + "&p3=" + p3 + "&p4=" + p4 + "&p5=" + p5 + "&p6=" + p6 +
                                "&p7=" + p7 + "&p8=" + p8 + "&p9=" + p9 + "&p10=" + p10 + "&p11=" + p11 + "&p12=" + p12 + "&p13=" + p13 + "&p14=" + p14 +
                                "&p15=" + p15 + "&p16=" + p16 + "&p17=" + p17 + "&p18=" + p18 + "&p19=" + p19 + "&p20=" + p20 + "&p21=" + p21 + "&p22=" + p22 +
                                "&ti1=" + ti1 + "&ti2=" + ti2 + "&ti3=" + ti3 + "&ti4=" + ti4 + "&ti5=" + ti5 + "&ti6=" + ti6 +
                                "&ti7=" + ti7 + "&ti8=" + ti8 + "&ti9=" + ti9 + "&ti10=" + ti10 + "&ti11=" + ti11 + "&ti12=" + ti12 + "&ti13=" + ti13 + "&ti14=" + ti14 +
                                "&ti15=" + ti15 + "&ti16=" + ti16 + "&ti17=" + ti17 + "&ti18=" + ti18 + "&ti19=" + ti19 + "&ti20=" + ti20 + "&ti21=" + ti21 + "&ti22=" + ti22 +
                                "&ti23=" + ti23 + "&ti24=" + ti24 + "&ti25=" + ti25 + "&ti26=" + ti26 + "&ti27=" + ti27 + "&ti28=" + ti28 + "&ti29=" + ti29 + "&ti30=" + ti30 +
                                "&ti31=" + ti31 + "&ti32=" + ti32 + "&ti33=" + ti33 + "&ti34=" + ti34 + "&ti35=" + ti35 + "&ti36=" + ti36 + "&ti37=" + ti37 + "&ti38=" + ti38 +
                                "&ti39=" + ti39 + "&ti40=" + ti40 + "&ti41=" + ti41 + "&ti42=" + ti42 + "&ti43=" + ti43 + "&ti44=" + ti44 + "&ti45=" + ti45 + "&ti46=" + ti46 +
                                "&ti47=" + ti47 + "&ti48=" + ti48 + "&ti49=" + ti49 +
                                "&td1=" + td1 + "&td2=" + td2 + "&td3=" + td3 + "&td4=" + td4 + "&td5=" + td5 + "&td6=" + td6 +
                                "&td7=" + td7 + "&td8=" + td8 + "&td9=" + td9 + "&td10=" + td10 + "&td11=" + td11 + "&td12=" + td12 + "&td13=" + td13 + "&td14=" + td14 +
                                "&td15=" + td15 + "&td16=" + td16 + "&td17=" + td17 + "&td18=" + td18 + "&td19=" + td19 + "&td20=" + td20 + "&td21=" + td21 + "&td22=" + td22 +
                                "&td23=" + td23 + "&td24=" + td24 + "&td25=" + td25 + "&td26=" + td26 + "&td27=" + td27 + "&td28=" + td28 + "&td29=" + td29 + "&td30=" + td30 +
                                "&td31=" + td31 + "&td32=" + td32 + "&td33=" + td33 + "&td34=" + td34 + "&td35=" + td35 + "&td36=" + td36 + "&td37=" + td37 + "&td38=" + td38 +
                                "&td39=" + td39 + "&td40=" + td40 + "&td41=" + td41 + "&td42=" + td42 + "&td43=" + td43 + "&td44=" + td44 + "&td45=" + td45 + "&td46=" + td46 +
                                "&td47=" + td47 + "&td48=" + td48 + "&td49=" + td49 +
                                "&ra1=" + ra1 + "&ra2=" + ra2 + "&ra3=" + ra3 + "&ra4=" + ra4 + "&ra5=" + ra5 + "&ra6=" + ra6 +
                                "&ra7=" + ra7 + "&ra8=" + ra8 + "&ra9=" + ra9 + "&ra10=" + ra10 + "&ra11=" + ra11 + "&ra12=" + ra12 + "&ra13=" + ra13 + "&ra14=" + ra14 +
                                "&ra15=" + ra15 + "&ra16=" + ra16 + "&ra17=" + ra17 + "&ra18=" + ra18 + "&ra19=" + ra19 + "&ra20=" + ra20 + "&ra21=" + ra21 + "&ra22=" + ra22 +
                                "&ra23=" + ra23 + "&ra24=" + ra24 + "&ra25=" + ra25 + "&ra26=" + ra26 + "&ra27=" + ra27 + "&ra28=" + ra28 + "&ra29=" + ra29 + "&ra30=" + ra30 +
                                "&ra31=" + ra31 + "&ra32=" + ra32 + "&ra33=" + ra33 + "&ra34=" + ra34 + "&ra35=" + ra35 + "&ra36=" + ra36 + "&ra37=" + ra37 + "&ra38=" + ra38 +
                                "&ra39=" + ra39 + "&ra40=" + ra40 + "&ra41=" + ra41 + "&ra42=" + ra42 + "&ra43=" + ra43 + "&ra44=" + ra44 + "&ra45=" + ra45 + "&ra46=" + ra46 +
                                "&ra47=" + ra47 + "&ra48=" + ra48 + "&ra49=" + ra49 + "&ra50=" + ra50 + "&ra51=" + ra51 + "&ra52=" + ra52 + "&ra53=" + ra53 + "&ra54=" + ra54 +
                                "&ra55=" + ra55 +
                                "&ta47=" + ta47 + "&ta48=" + ta48 + "&ta49=" + ta49 + "&ta50=" + ta50 + "&ta51=" + ta51 + "&ta52=" + ta52 + "&ta53=" + ta53 + "&ta54=" + ta54 +
                                "&ta55=" + ta55 +
                                "&rap1=" + rap1 + "&rap2=" + rap2 + "&rap3=" + rap3 + "&rap4=" + rap4 + "&rap5=" + rap5 + "&rap6=" + rap6 +
                                "&rap7=" + rap7 + "&rap8=" + rap8 + "&rap9=" + rap9 + "&rap10=" + rap10 + "&rap11=" + rap11 + "&rap12=" + rap12 + "&rap13=" + rap13 + "&rap14=" + rap14 +
                                "&rap15=" + rap15 + "&rap16=" + rap16 + "&rap17=" + rap17 + "&rap18=" + rap18 + "&rap19=" + rap19 + "&rap20=" + rap20 + "&rap21=" + rap21 + 
                                "&rac1=" + rac1 + "&rac2=" + rac2 + "&rac3=" + rac3 + "&rac4=" + rac4 + "&rac5=" + rac5 + "&rac6=" + rac6 +
                                "&rac7=" + rac7 + "&rac8=" + rac8 + "&rac9=" + rac9 + "&rac10=" + rac10 + "&rac11=" + rac11 + "&rac12=" + rac12 + "&rac13=" + rac13 + "&rac14=" + rac14 +
                                "&rac15=" + rac15 + "&rac16=" + rac16 + "&rac17=" + rac17 + "&rac18=" + rac18 + "&rac19=" + rac19 + "&rac20=" + rac20 + "&rac21=" + rac21 + 
                                "&raf1=" + raf1 + "&raf2=" + raf2 + "&raf3=" + raf3 + "&raf4=" + raf4 + "&raf5=" + raf5 + "&raf6=" + raf6 +
                                "&raf7=" + raf7 + "&raf8=" + raf8 + "&raf9=" + raf9 + "&raf10=" + raf10 + "&raf11=" + raf11 + "&raf12=" + raf12 + "&raf13=" + raf13 + "&raf14=" + raf14 +
                                "&raf15=" + raf15 + "&raf16=" + raf16 + "&raf17=" + raf17 + "&raf18=" + raf18 + "&raf19=" + raf19 + "&raf20=" + raf20 + "&raf21=" + raf21 + 
                                "&part1=" + part1 + "&part2=" + part2 + "&part3=" + part3 + "&part4=" + part4 + "&part5=" + part5 + "&part6=" + part6 +
                                "&part7=" + part7 + "&part8=" + part8 + "&part9=" + part9 + "&part10=" + part10 + "&part11=" + part11 + "&part12=" + part12 + "&part13=" + part13 + "&part14=" + part14 +
                                "&part15=" + part15 + "&part16=" + part16 + "&part17=" + part17 + "&part18=" + part18 +
                                "&tdf1=" + tdf1 + "&tdf2=" + tdf2 + "&tdf3=" + tdf3 + "&tdf4=" + tdf4 + "&tdf5=" + tdf5 + "&tdf6=" + tdf6 +
                                "&tdf7=" + tdf7 +
                                "&tm1=" + tm1 + "&tm2=" + tm2 + "&tm3=" + tm3 + "&tm4=" + tm4 + "&tm5=" + tm5 + 
                                "&marcha1=" + marcha1 + "&marcha2=" + marcha2 + "&marcha3=" + marcha3 + "&marcha4=" + marcha4 + 
                                "&balanceo1=" + balanceo1 + "&balanceo2=" + balanceo2 + "&balanceo3=" + balanceo3 +
                                "&orden=" + orden + "&paciente=" + paciente + "&peso=" + peso + "&talla=" + talla + "&test=" + test,
                        success: function (result) {
                            if(result == 1){
                                alert('Datos Actualizados');
                                $('.mostrarload').css('display', 'block');
                                    setTimeout(function () {
                                    $(".mostrarload").fadeOut(1500);
                                }, 2000);
                                location.href="../controlador/test_medidas.php?cod=<?php echo $_GET['cod']; ?>";
                            }else{
                                alert('Datos No Actualizados');
                            }
                        }
                    });
                });
            })

            function activar(num) {
                document.forms[0].Especifique1.disabled = (num == 0) ? false : true;

            }

            function activar1(num) {
                document.forms[0].Especifique.disabled = (num == 0) ? false : true;

            }
            function activar2(num) {
                document.forms[0].Cuales1.disabled = (num == 0) ? false : true;
                document.forms[0].Cuales2.disabled = (num == 0) ? false : true;
                document.forms[0].Cuales3.disabled = (num == 0) ? false : true;
            }

            function activar3(num) {
                document.forms[0].Cuales4.disabled = (num == 0) ? false : true;
                document.forms[0].Cuales5.disabled = (num == 0) ? false : true;
                document.forms[0].Cuales6.disabled = (num == 0) ? false : true;
            }
            function activar4(num) {
                document.forms[0].Cuales7.disabled = (num == 0) ? false : true;
                document.forms[0].Cuales8.disabled = (num == 0) ? false : true;
                document.forms[0].Cuales9.disabled = (num == 0) ? false : true;
            }
        </script>


        <script language="JavaScript">
<!--

            function enable_text(status)
            {
                status = !status;
                document.insertar_historial.Especifique1.disabled = status;
            }
            //-->
        </script>
        <style>
            body {
                background-color: #D3EDF0;
            }

            article {
                background-color: #F5F6F6;
            }

            p {
                background-color: rgb(255,0,255);
            }
            .ui-widget-content{background:#f9fcfd;}
            .mostrarload{
                padding: 0;
                margin: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,.2);
                position: absolute;
                top: 0;
                left: 0;
                display: none;
                z-index: 10000;
            }
            .mostrarload img{
                margin-top: 10%;
                margin-left: 30%;
            }
            #guardar_mc,#actualiza_mc{
                width: 120px;
                padding: 10px;
                border:0;
                background: #007fff;
                color:#fff;
                font-size: 18px;
                float: right;
                margin-right: 30px;
            }
            #datos{
                font-size: 20px;
                font-weight: bold;
            }
        </style>

    </head>



    <body onload="doScroll()" onunload="window.name = document.body.scrollTop">

        <div class="mostrarload">
            <img src="../imagenes/loading.png" alt=""/>
        </div>
            <!--<button id="btnloading">Loading</button>-->
        <section id="main" class="column">
            <div class="clear"></div>
            
            <?php 
                if (isset($_GET['cod'])) {
                    if(isset($idtest)){
            ?>
            <button id="actualiza_mc">Actualizar</button>
            <?php
                    }else{
            ?>
            <button id="guardar_mc">Guardar</button>
            <?php
                    }
                }
            ?>
            
            <label id="datos">Orden #:</label>
            <label><?php
            if (isset($_GET['cod'])) {
                echo $_GET['cod'];
            } else {
                echo $orde;
            }
            ?></label>
            <input type="hidden" name="orden" id="orden" style="width:40px;" readonly disabled="true" value="<?php
            if (isset($_GET['cod'])) {
                echo $_GET['cod'];
            } else {
                echo $orde;
            }
            ?>">
            <br>
            <input type="hidden" name="test" id="test" style="width:40px;" readonly disabled="true" value="<?php
            if (isset($_GET['cod'])) {
                if(isset($idtest)){
                    echo $idtest;
                }
            }
            ?>">
            <br>
            <label id="datos">Paciente:</label>
            <label><?php
            if (isset($_GET['cod'])) {
                echo $name;
            }
            ?></label>
            <input type="hidden" name="paciente" id="paciente" readonly disabled="true" value="<?php
            if (isset($_GET['cod'])) {
                
                echo $id;
            }
            ?>">


            <br><br>             
            <header><h3>CARACTERÍSTICAS ANTROPOMÉTRICAS </h3></header>
            Peso: <input type="text" name="peso" id="peso" value="<?php
            if (isset($_GET['cod'])) {
                if(isset($idtest)){
                    echo $peso;
                }
            }
            ?>"> 
            Talla: <input type="text" name="talla" id="talla" value="<?php
            if (isset($_GET['cod'])) {
                if(isset($idtest)){
                    echo $talla;
                }
            }
            ?>"> 
           <!-- IMC: <input type="text" name="imc" id="imc"> -->
            <div>

                <div id="tabs">
                    <ul>
                        <li><a href="#tabs-1">Medidas y Rangos</a></li>
                        <li><a href="#tabs-2">Desempeño Muscular y Planos</a></li>
                        <li><a href="#tabs-3">Evaluación de la Marcha</a></li>
                        <li><a href="#tabs-4">Diagnóstico Fisioterapéutico</a></li>	

                    </ul>
                    <div id="tabs-1">
                        <!--<form  action="<?php
                        /*if (isset($_GET['editar'])) {
                            echo '../modelo/editar_consulta.php?edit=' . $id_orden . '';
                        } else {
                            echo '../modelo/insertar_consulta.php?paciente=' . $id . '';
                        }*/
                        ?>" method="post" enctype="multipart/form-data">-->
                            <table>
                                <tr>
                                    <td colspan=3>MEDIDAS PERIMETRALES <hr></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>PERÍMETRO</td>
                                                <td>HEMICUERPO IZQUIERDO </td>
                                                <td>HEMICUERPO DERECHO </td>
                                            </tr>
                                            <tr>
                                                <td>PERIMETRO DE MUÑECA</td>
                                                <td><input type="text" name="pem1" id="pem1" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $p1;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="pem2" id="pem2" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $p2;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr> 
                                            <tr>
                                                <td>DORSO DE MANO </td>
                                                <td><input type="text" name="pem3" id="pem3" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $p3;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="pem4" id="pem4"value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $p4;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr> 
                                            <tr>
                                                <td>PERÍMETRO DE CODO</td>
                                                <td><input type="text" name="pem5" id="pem5" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $p5;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="pem6" id="pem6" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $p6;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>  
                                            <tr>
                                                <td>PERIMETRO DE BRAZO RELAJADO</td>
                                                <td><input type="text" name="pem7" id="pem7" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $p7;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="pem8" id="pem8" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $p8;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>  
                                            <tr>
                                                <td>PERIMETRO DE ANTEBRAZO</td>
                                                <td><input type="text" name="pem9" id="pem9" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $p9;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="pem10" id="pem10" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $p10;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>  
                                            <tr>
                                                <td>PERIMETRO DE MUSLO</td>
                                                <td><input type="text" name="pem11" id="pem11" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $p11;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="pem12" id="pem12" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $p12;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>  
                                            <tr>
                                                <td>PERIMETRO DE RODILLA</td>
                                                <td><input type="text" name="pem13" id="pem13" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $p13;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="pem14" id="pem14" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $p14;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>  
                                            <tr>
                                                <td>PERIMETRO DE PANTORRILLA</td>
                                                <td><input type="text" name="pem15" id="pem15" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $p15;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="pem16" id="pem16" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $p16;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>  
                                            <tr>
                                                <td>PERIMETRO DE TOBILLO</td>
                                                <td><input type="text" name="pem17" id="pem17" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $p17;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="pem18" id="pem18" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $p18;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>  
                                            <tr>
                                                <td>DORSO DEL PIE</td>
                                                <td><input type="text" name="pem19" id="pem19" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $p19;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="pem20" id="pem20" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $p20;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>  
                                            <tr>
                                                <td>PERIMETRO DEL ABDOMEN</td>
                                                <td><input type="text" name="pem21" id="pem21" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $p21;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="pem22" id="pem22" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $p22;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>  
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan=2>RANGOS DE MOVIMIENTO<hr></td>
                                </tr>
                                <tr>
                                    <td colspan=2>
                                        <table style="border-collapse: collapse;" border=1>
                                            <tr>
                                                <td>ESTRUCTURA CORPORAL</td>
                                                <td>MOVIMIENTO </td>
                                                <td>RANGO DE MOVIMIENTO DE REFERENCIA</td>
                                                <td colspan=2>RANGO DE MOVIMIENTO ENCONTRADO</td>
                                            </tr>
                                            <tr>
                                                <td colspan=3>CUELLO</td>
                                                <td>IZQUIERDO</td>
                                                <td>DERECHO</td>
                                            </tr>
                                            <tr >
                                                <td rowspan=4>CUELLO</td>
                                                <td>FLEXIÓN</td><td>0° - 45°</td>
                                                <td><input type="text" name="ti1" id="ti1" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t1;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td1" id="td1" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td1;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr> 
                                            <tr >
                                                <td>EXTENSIÓN</td>
                                                <td>0° - 30°</td>
                                                <td><input type="text" name="ti2" id="ti2" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t2;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td2" id="td2" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td2;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr> 
                                            <tr >
                                                <td>ROTACIÓN</td><td>0° - 60°</td>
                                                <td><input type="text" name="ti3" id="ti3" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t3;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td3" id="td3"value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td3;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr> 
                                            <tr >
                                                <td>INCLINACIÓN</td>
                                                <td>0° - 45°</td>
                                                <td><input type="text" name="ti4" id="ti4" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t4;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td4" id="td4" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td4;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>

                                            <tr >
                                                <td rowspan=5>TRONCO</td>
                                                <td>EXTENSIÓN DE TRONCO</td><td>0° - 25°</td>
                                                <td><input type="text" name="ti5" id="ti5" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t5;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td5" id="td5" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td5;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr> 
                                            <tr >
                                                <td>EXTENSIÓN DE TRONCO PIE</td>
                                                <td>0° - 30°</td>
                                                <td><input type="text" name="ti6" id="ti6" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t6;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td6" id="td6" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td6;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr> 
                                            <tr >
                                                <td>FLEXION</td>
                                                <td>0° - 80°</td>
                                                <td><input type="text" name="ti7" id="ti7" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t7;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td7" id="td7" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td7;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr> 
                                            <tr >
                                                <td>ROTACIÓN</td><td>0° - 45°</td>
                                                <td><input type="text" name="ti8" id="ti8" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t8;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td8" id="td8" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td8;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>
                                            <tr >
                                                <td>INCLINACIÓN </td>
                                                <td>0° - 45°</td>
                                                <td><input type="text" name="ti9" id="ti9" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t9;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td9" id="td9" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td9;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>	
                                            <tr>
                                                <td colspan=3>MIEMBRO SUPERIOR</td>
                                                <td>IZQUIERDO</td>
                                                <td>DERECHO</td>
                                            </tr>
                                            <tr >
                                                <td rowspan=7>HOMBRO</td>
                                                <td>FLEXIÓN</td>
                                                <td>0° - 180°</td>
                                                <td><input type="text" name="ti10" id="ti10" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t10;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td10" id="td10" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td10;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr> 
                                            <tr >
                                                <td>EXTENSIÓN</td>
                                                <td>0° - 45° - 60°</td>
                                                <td><input type="text" name="ti11" id="ti11" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t11;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td11" id="td11" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td11;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr> 
                                            <tr >
                                                <td>ABDUCCION</td>
                                                <td>0° - 180°</td>
                                                <td><input type="text" name="ti12" id="ti12" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t12;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td12" id="td12" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td12;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr> 
                                            <tr >
                                                <td>ADDUCCIÓN</td>
                                                <td>180° - 0°</td>
                                                <td><input type="text" name="ti13" id="ti13" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t13;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td13" id="td13" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td13;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>
                                            <tr >
                                                <td>ADDUCCIÓN PURA</td>
                                                <td>0° - 30°-40</td>
                                                <td><input type="text" name="ti14" id="ti14" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t14;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td14" id="td14" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td14;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>
                                            <tr >
                                                <td>ROTACIÓN INTERNA</td>
                                                <td>0° - 80°</td>
                                                <td><input type="text" name="ti15" id="ti15" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t15;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td15" id="td15" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td15;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>
                                            <tr >
                                                <td>ROTACIÓN EXTERNA</td>
                                                <td>0° - 90°</td>
                                                <td><input type="text" name="ti16" id="ti16" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t16;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td16" id="td16" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td16;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>	

                                            <tr >
                                                <td rowspan=2>CODO</td>
                                                <td>FLEXIÓN</td>
                                                <td>0° - 150°</td>
                                                <td><input type="text" name="ti17" id="ti17" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t17;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td17" id="td17" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td17;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr> 
                                            <tr >
                                                <td>EXTENSIÓN</td>
                                                <td>150° - 0°</td>
                                                <td><input type="text" name="ti18" id="ti18" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t18;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td18" id="td18" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td18;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tR>
                                            <tr >
                                                <td rowspan=2>ANTEBRAZO</td>
                                                <td>SUPINACIÓN </td>
                                                <td>0° - 80° - 90°</td>
                                                <td><input type="text" name="ti19" id="ti19" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t19;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td19" id="td19" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td19;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr> 
                                            <tr >
                                                <td>PRONACIÓN</td>
                                                <td>0° - 80° - 90°</td>
                                                <td><input type="text" name="ti20" id="ti20" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t20;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td20" id="td20" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td20;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>
                                            <tr >
                                                <td rowspan=4>MUÑECA</td>
                                                <td>FLEXIÓN</td>
                                                <td>0° - 80° - 90°</td>
                                                <td><input type="text" name="ti21" id="ti21" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t21;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td21" id="td21" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td21;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr> 
                                            <tr >
                                                <td>EXTENSIÓN</td>
                                                <td>0°  - 70°</td>
                                                <td><input type="text" name="ti22" id="ti22" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t22;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td22" id="td22" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td22;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>	
                                            <tr >
                                                <td>DESVIACIÓN CUBITAL</td>
                                                <td>0° - 40°</td>
                                                <td><input type="text" name="ti23" id="ti23" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t23;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td23" id="td23" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td23;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>	
                                            <tr >
                                                <td>DESVIACIÓN RADIAL</td>
                                                <td>0° - 20°</td>
                                                <td><input type="text" name="ti24" id="ti24" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t24;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td24" id="td24" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td24;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>			

                                            <tr>
                                                <td colspan=3>MIEMBRO INFERIOR</td>
                                                <td>IZQUIERDO</td>
                                                <td>DERECHO</td>
                                            </tr>
                                            <tr >
                                                <td rowspan=7>CADERA</td>
                                                <td>FLEXIÓN</td>
                                                <td>0° - 120°</td>
                                                <td><input type="text" name="ti25" id="ti25" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t25;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td25" id="td25" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td25;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr> 
                                            <tr >
                                                <td>EXTENSIÓN</td>
                                                <td>0° - 20°</td>
                                                <td><input type="text" name="ti26" id="ti26" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t26;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td26" id="td26" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td26;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr> 
                                            <tr >
                                                <td>ABDUCCION</td>
                                                <td>0° - 45°</td>
                                                <td><input type="text" name="ti27" id="ti27" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t27;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td27" id="td27" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td27;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr> 
                                            <tr >
                                                <td>ADDUCCIÓN</td>
                                                <td>45° - 0°</td>
                                                <td><input type="text" name="ti28" id="ti28" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t28;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td28" id="td28" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td28;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>
                                            <tr >
                                                <td>ADDUCCIÓN PURA</td>
                                                <td>0° - 15°-20</td>
                                                <td><input type="text" name="ti29" id="ti29" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t29;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td29" id="td29" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td29;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>
                                            <tr >
                                                <td>ROTACIÓN INTERNA</td>
                                                <td>0° - 45°</td>
                                                <td><input type="text" name="ti30" id="ti30" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t30;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td30" id="td30" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td30;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>
                                            <tr >
                                                <td>ROTACIÓN EXTERNA</td>
                                                <td>0° - 45°</td>
                                                <td><input type="text" name="ti31" id="ti31" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t31;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td31" id="td31" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td31;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>	
                                            <tr >
                                                <td rowspan=2>RODILLA</td>
                                                <td>FLEXIÓN</td>
                                                <td>0° - 135°</td>
                                                <td><input type="text" name="ti32" id="ti32" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t32;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td32" id="td32" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td32;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr> 
                                            <tr >
                                                <td>EXTENSIÓN</td>
                                                <td>135° - 0°</td>
                                                <td><input type="text" name="ti33" id="ti33" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t33;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td33" id="td33" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td33;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>
                                            <tr >
                                                <td rowspan=4>PIE</td>
                                                <td>FLEXIÓN (DORSIFLEXIÓN)</td>
                                                <td>0° - 15° - 20°</td>
                                                <td><input type="text" name="ti34" id="ti34" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t34;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td34" id="td34" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td34;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr> 
                                            <tr >
                                                <td>EXTENSIÓN</td>
                                                <td>0 - 45°</td>
                                                <td><input type="text" name="ti35" id="ti35" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t35;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td35" id="td35" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td35;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>	
                                            <tr >
                                                <td>INVERSIÓN</td>
                                                <td>0° - 40°</td>
                                                <td><input type="text" name="ti36" id="ti36" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t36;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td36" id="td36" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td36;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr> 
                                            <tr >
                                                <td>EVERSIÓN</td>
                                                <td>0° - 20°</td>
                                                <td><input type="text" name="ti37" id="ti37" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t37;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" name="td37" id="td37" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td37;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>	
                                        </table>
                                    </td>
                                </Tr>
                            </table>

                        <!--</form>-->
                    </div>

                    <!-- fin tab1-->
                    <div id="tabs-2">
                        <!--<form  action="<?php
                        /*if (isset($_GET['editar'])) {
                            echo '../modelo/editar_consulta.php?edit=' . $id_orden . '';
                        } else {
                            echo '../modelo/insertar_consulta.php?paciente=' . $id . '';
                        }*/
                        ?>" method="post" enctype="multipart/form-data">-->
                            <table>
                                <tr>
                                    <td colspan=3>DESEMPEÑO MUSCULAR <hr>
                                        <table style="border-collapse: collapse;" border=1>
                                            <tr >
                                                <td >VALOR DE REFRENCIA</td>
                                                <td COLSPAN=2>CRITERIO   DE CALIFICACIÓN</td> 
                                                <td COLSPAN=2>VALOR ENCONTRADO   </td>
                                            </tr>
                                            <tr >
                                                <td colspan=3></td>  
                                                <td >IZQUIERDO </td>
                                                <td >DERECHO
                                                </td> 
                                            </tr> 
                                            <tr >  
                                                <td >5   </td>
                                                <td COLSPAN=2>Arco de movimiento en contra de la gravedad con óptima resistencia
                                                </td>
                                                <td><input type="text" name="ti38" id="ti38" size="4" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t38;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" size="4" name="td38" id="td38" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td38;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr> 
                                            <tr >  
                                                <td >4+  </td>
                                                <td COLSPAN=2>Arco completo de movimiento en contra de la gravedad con muy buena resistencia  </td>
                                                <td><input type="text" name="ti39" id="ti39" size="4" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t39;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" size="4" name="td39" id="td39" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td39;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr> 
                                            <tr >  
                                                <td >4  </td>
                                                <td COLSPAN=2>Arco completo de movimiento en contra de la gravedad</td>
                                                <td><input type="text" name="ti40" id="ti40" size="4" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t40;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" size="4" name="td40" id="td40" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td40;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr> 
                                            <tr >  
                                                <td>  4-  </td>
                                                <td COLSPAN=2>Arco completo de movimiento en contra de la   gravedad con moderada resistencia 
                                                </td>
                                                <td><input type="text" name="ti41" id="ti41" size="4" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t41;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" size="4" name="td41" id="td41" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td41;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr> 
                                            <tr >  
                                                <td >  3+   </td>
                                                <td COLSPAN=2>Arco completo de movimiento en contra de la
                                                    gravedad con regular resistencia
                                                </td>
                                                <td><input type="text" name="ti42" id="ti42" size="4" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t42;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" size="4" name="td42" id="td42" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td42;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr> 
                                            <tr >  
                                                <td >    3   </td>
                                                <td COLSPAN=2>Arco completo de movimiento en contra de la gravedad sin resistencia
                                                </td>
                                                <td><input type="text" name="ti43" id="ti43" size="4" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t43;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" size="4" name="td43" id="td43" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td43;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr> 
                                            <tr >  
                                                <td >  3-
                                                </td>  <td COLSPAN=2>Arco completo de movimiento en contra de la gravedad (75%)
                                                </td>
                                                <td><input type="text" name="ti44" id="ti44" size="4" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t44;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" size="4" name="td44" id="td44" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td44;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>
                                            <tr >  
                                                <td >2+  </td>
                                                <td COLSPAN=2>Arco completo de movimiento eliminando gravedad con resistencia</td>
                                                <td><input type="text" name="ti45" id="ti45" size="4" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t45;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" size="4" name="td45" id="td45" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td45;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>
                                            <tr >
                                                <td ></td>
                                                <td COLSPAN=2>Arco completo de movimiento eliminando gravedad</td>
                                                <td><input type="text" name="ti46" id="ti46" size="4" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t46;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" size="4" name="td46" id="td46" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td46;
                                                        }
                                                    }
                                                    ?>"></td></tr>
                                            <tr >  
                                                <td >  1+  </td>
                                                <td COLSPAN=2>Inicio de movimiento eliminando gravedad</td>
                                                <td><input type="text" name="ti47" id="ti47" size="4" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t47;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" size="4" name="td47" id="td47" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td47;
                                                        }
                                                    }
                                                    ?>"></td></tr>
                                            <tr >  
                                                <td >  1  </td>
                                                <td COLSPAN=2>Contracción muscular  </td>
                                                <td><input type="text" name="ti48" id="ti48" size="4" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t48;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" size="4" name="td48" id="td48" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td48;
                                                        }
                                                    }
                                                    ?>"></td> </tr>
                                            <tr >  
                                                <td >  0  </td>
                                                <td  COLSPAN=2>Sin contracción muscular</td>
                                                <td><input type="text" name="ti49" id="ti49" size="4" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $t49;
                                                        }
                                                    }
                                                    ?>"></td>
                                                <td><input type="text" size="4" name="td49" id="td49" value="<?php
                                                    if (isset($_GET['cod'])) {
                                                        if(isset($idtest)){
                                                            echo $td49;
                                                        }
                                                    }
                                                    ?>"></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan=3>PLANO ANTERIOR <hr>
                                        <table style="border-collapse: collapse;" border=1>
                                            <THEAD>
                                                <tR><td>SEGMENTO CORPORAL</td>
                                                    <td COLSPAN=2>DESCRIPCIÓN DEL HALLAZGO</td>
                                                </tR>
                                            </THEAD>
                                            <TR>
                                                <td ></TD>
                                                <td>SI</td>
                                                <td>NO</td>
                                            </TR>
                                            <TR>
                                                <td colspan=3><b>CABEZA</b></td>
                                            </TR>
                                            <TR>
                                                <td >ROTACION IZQUIERDA</td>
                                                <td><input type="radio" name="ra1" id="ra1" value="si" <?php
                                            if (isset($ra1)) {
                                                if ($ra1 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>> </td>
                                                <td><input type="radio" name="ra1" id="ra1" value="no" <?php
                                            if (isset($ra1)) {
                                                if ($ra1 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                            </TR>
                                            <TR>
                                                <td >ROTACION DERECHA</td>
                                                <td><input type="radio" name="ra2" id="ra2" value="si" <?php
                                            if (isset($ra2)) {
                                                if ($ra2 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra2" id="ra2" value="no" <?php
                                            if (isset($ra2)) {
                                                if ($ra2 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td >INCLINACIÓN IZQUIERDA</td>
                                                <td><input type="radio" name="ra3" id="ra3" value="si" <?php
                                            if (isset($ra3)) {
                                                if ($ra3 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra3" id="ra3" value="no" <?php
                                            if (isset($ra3)) {
                                                if ($ra3 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td >INCLINACIÓN DERECHA</td>
                                                <td><input type="radio" name="ra4" id="ra4" value="si" <?php
                                            if (isset($ra4)) {
                                                if ($ra4 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra4" id="ra4" value="no" <?php
                                            if (isset($ra4)) {
                                                if ($ra4 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td colspan=3><b>SIMETRÍA FACIAL</b></td>
                                            </TR>
                                            <TR>
                                                <td colspan=3><b>HOMBROS</b></td>
                                            </TR>
                                            <TR>
                                                <td >ELEVADOS</td>
                                                <td><input type="radio" name="ra5" id="ra5" value="si" <?php
                                            if (isset($ra5)) {
                                                if ($ra5 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra5" id="ra5" value="no" <?php
                                            if (isset($ra5)) {
                                                if ($ra5 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td >DESCENDIDOS</td>
                                                <td><input type="radio" name="ra6" id="ra6" value="si" <?php
                                            if (isset($ra6)) {
                                                if ($ra6 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra6" id="ra6" value="no" <?php
                                            if (isset($ra6)) {
                                                if ($ra6 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td><b>SIMETRIA DE LOS ANGULOS ENTRE BRAZO Y TRONCO</b></td>
                                                <td></td>
                                                <td></td>
                                            </TR>
                                            <TR>
                                                <td colspan=3><b>PELVIS</b></td>
                                            </TR>
                                            <TR>
                                                <td >ELEVADA</td>
                                                <td><input type="radio" name="ra7" id="ra7" value="si" <?php
                                            if (isset($ra7)) {
                                                if ($ra7 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra7" id="ra7" value="no" <?php
                                            if (isset($ra7)) {
                                                if ($ra7 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td >DESCENDIDA</td>
                                                <td><input type="radio" name="ra8" id="ra8" value="si" <?php
                                            if (isset($ra8)) {
                                                if ($ra8 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra8" id="ra8" value="no" <?php
                                            if (isset($ra8)) {
                                                if ($ra8 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td colspan=3><b>RODILLAS</b></td>
                                            </TR>
                                            <TR>
                                                <td >GENU VALGO</td>
                                                <td><input type="radio" name="ra9" id="ra9" value="si" <?php
                                            if (isset($ra9)) {
                                                if ($ra9 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra9" id="ra9" value="no" <?php
                                            if (isset($ra9)) {
                                                if ($ra9 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td >GENU VARO</td>
                                                <td><input type="radio" name="ra10" id="ra10" value="si" <?php
                                            if (isset($ra10)) {
                                                if ($ra10 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra10" id="ra10" value="no" <?php
                                            if (isset($ra10)) {
                                                if ($ra10 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td colspan=3><b>ROTULAS</b></td>
                                            </TR>
                                            <TR>
                                                <td >HACIA DENTRO</td>
                                                <td><input type="radio" name="ra11" id="ra11" value="si" <?php
                                            if (isset($ra11)) {
                                                if ($ra11 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra11" id="ra11" value="no" <?php
                                            if (isset($ra11)) {
                                                if ($ra11 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td >HACIA AFUERA</td>
                                                <td><input type="radio" name="ra12" id="ra12" value="si" <?php
                                            if (isset($ra12)) {
                                                if ($ra12 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra12" id="ra12" value="no" <?php
                                            if (isset($ra12)) {
                                                if ($ra12 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td colspan=3> <b>PIE</b></td>
                                            </TR>
                                            <TR>
                                                <td >PLANO</td>
                                                <td><input type="radio" name="ra13" id="ra13" value="si" <?php
                                            if (isset($ra13)) {
                                                if ($ra13 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra13" id="ra13" value="no" <?php
                                            if (isset($ra13)) {
                                                if ($ra13 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td >CAVO</td>
                                                <td><input type="radio" name="ra14" id="ra14" value="si" <?php
                                            if (isset($ra14)) {
                                                if ($ra14 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra14" id="ra14" value="no" <?php
                                            if (isset($ra14)) {
                                                if ($ra14 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                        </table></td></tr>

                                <tr>
                                    <td colspan=3>PLANO POSTERIOR <hr>
                                        <table style="border-collapse: collapse;" border=1>
                                            <THEAD>
                                                <tR>
                                                    <td>SEGMENTO CORPORAL</td>
                                                    <td COLSPAN=2>DESCRIPCIÓN DEL HALLAZGO</td>
                                                </tR>
                                            </THEAD>
                                            <TR>
                                                <td >
                                                </TD><td>SI</td>
                                                <td>NO</td>
                                            </TR>
                                            <TR>
                                                <td ><b>CABEZA</b></td>
                                                <td></td><td></td>
                                            </TR>
                                            <TR>
                                                <td >ROTACION IZQUIERDA</td>
                                                <td><input type="radio" name="ra15" id="ra15" value="si" <?php
                                            if (isset($ra15)) {
                                                if ($ra15 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra15" id="ra15" value="no" <?php
                                            if (isset($ra15)) {
                                                if ($ra15 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td >ROTACION DERECHA</td>
                                                <td><input type="radio" name="ra16" id="ra16" value="si" <?php
                                            if (isset($ra16)) {
                                                if ($ra16 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra16" id="ra16" value="no" <?php
                                            if (isset($ra16)) {
                                                if ($ra16 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td >INCLINACIÓN IZQUIERDA</td>
                                                <td><input type="radio" name="ra17" id="ra17" value="si" <?php
                                            if (isset($ra17)) {
                                                if ($ra17 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra17" id="ra17" value="no" <?php
                                            if (isset($ra17)) {
                                                if ($ra17 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td >INCLINACIÓN DERECHA</td>
                                                <td><input type="radio" name="ra18" id="ra18" value="si" <?php
                                            if (isset($ra18)) {
                                                if ($ra18 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra18" id="ra18" value="no" <?php
                                            if (isset($ra18)) {
                                                if ($ra18 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td colspan=3><b>SIMETRÍA FACIAL</b></td>
                                            </TR>
                                            <TR>
                                                <td colspan=3><b>HOMBROS</b></td>
                                            </TR>
                                            <TR>
                                                <td >ELEVADOS</td>
                                                <td><input type="radio" name="ra19" id="ra19" value="si" <?php
                                            if (isset($ra19)) {
                                                if ($ra19 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra19" id="ra19" value="no" <?php
                                            if (isset($ra19)) {
                                                if ($ra19 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td >DESCENDIDOS</td>
                                                <td><input type="radio" name="ra20" id="ra20" value="si" <?php
                                            if (isset($ra20)) {
                                                if ($ra20 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra20" id="ra20" value="no" <?php
                                            if (isset($ra20)) {
                                                if ($ra20 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td><b>SIMETRIA DE LOS ANGULOS ENTRE BRAZO Y TRONCO</b></td>
                                                <td></td>
                                                <td></td>
                                            </TR>
                                            <TR>
                                                <td colspan=3><b>COLUMNA VERTEBRAL</b></td>
                                            </TR>
                                            <TR>
                                                <td >ESCOLIOSIS CERVICAL</td>
                                                <td><input type="radio" name="ra21" id="ra21" value="si" <?php
                                            if (isset($ra21)) {
                                                if ($ra21 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra21" id="ra21" value="no" <?php
                                            if (isset($ra21)) {
                                                if ($ra21 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td >ESCOLIOSIS  DORSAL</td>
                                                <td><input type="radio" name="ra22" id="ra22" value="si" <?php
                                            if (isset($ra22)) {
                                                if ($ra22 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra22" id="ra22" value="no" <?php
                                            if (isset($ra22)) {
                                                if ($ra22 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td >ESCOLIOSIS LUMBAR</td>
                                                <td><input type="radio" name="ra23" id="ra23" value="si" <?php
                                            if (isset($ra23)) {
                                                if ($ra23 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra23" id="ra23" value="no" <?php
                                            if (isset($ra23)) {
                                                if ($ra23 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td colspan=3><b>PELVIS</b></td>
                                            </TR>
                                            <TR>
                                                <td >ELEVADA</td>
                                                <td><input type="radio" name="ra24" id="ra24" value="si" <?php
                                            if (isset($ra24)) {
                                                if ($ra24 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra24" id="ra24" value="no" <?php
                                            if (isset($ra24)) {
                                                if ($ra24 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td >DESCENDIDA</td>
                                                <td><input type="radio" name="ra25" id="ra25" value="si" <?php
                                            if (isset($ra25)) {
                                                if ($ra25 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra25" id="ra25" value="no" <?php
                                            if (isset($ra25)) {
                                                if ($ra25 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td colspan=3><b>RODILLAS</b></td>
                                            </TR>
                                            <TR>
                                                <td >GENU VALGO</td>
                                                <td><input type="radio" name="ra26" id="ra26" value="si" <?php
                                            if (isset($ra26)) {
                                                if ($ra26 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra26" id="ra26" value="no" <?php
                                            if (isset($ra26)) {
                                                if ($ra26 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td >GENU VARO</td>
                                                <td><input type="radio" name="ra27" id="ra27" value="si" <?php
                                            if (isset($ra27)) {
                                                if ($ra27 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra27" id="ra27" value="no" <?php
                                            if (isset($ra27)) {
                                                if ($ra27 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td colspan=3><b>ROTULAS</b></td>
                                            </TR>
                                            <TR>
                                                <td >HACIA DENTRO</td>
                                                <td><input type="radio" name="ra28" id="ra28" value="si" <?php
                                            if (isset($ra28)) {
                                                if ($ra28 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra28" id="ra28" value="no" <?php
                                            if (isset($ra28)) {
                                                if ($ra28 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td >HACIA AFUERA</td>
                                                <td><input type="radio" name="ra29" id="ra29" value="si" <?php
                                            if (isset($ra29)) {
                                                if ($ra29 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra29" id="ra29" value="no" <?php
                                            if (isset($ra29)) {
                                                if ($ra29 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td colspan=3> <b>PIE</b></td>
                                            </TR>
                                            <TR>
                                                <td >SUPINADO</td>
                                                <td><input type="radio" name="ra30" id="ra30" value="si" <?php
                                            if (isset($ra30)) {
                                                if ($ra30 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra30" id="ra30" value="no" <?php
                                            if (isset($ra30)) {
                                                if ($ra30 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td >PRONADO</td>
                                                <td><input type="radio" name="ra31" id="ra31" value="si" <?php
                                            if (isset($ra31)) {
                                                if ($ra31 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra31" id="ra31" value="no" <?php
                                            if (isset($ra31)) {
                                                if ($ra31 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan=3>PLANO LATERAL <hr>
                                        <table style="border-collapse: collapse;" border=1>
                                            <THEAD>
                                                <tR>
                                                    <td>SEGMENTO CORPORAL</td><td COLSPAN=2>DESCRIPCIÓN DEL HALLAZGO</td>
                                                </tR>
                                            </THEAD>
                                            <TR>
                                                <td ></TD>
                                                <td>SI</td>
                                                <td>NO</td>
                                            </TR>
                                            <TR>
                                                <td ><b>CABEZA</b></td>
                                                <td></td><td></td></TR>
                                            <TR>
                                                <td >FLEXIÓN</td>
                                                <td><input type="radio" name="ra32" id="ra32" value="si" <?php
                                            if (isset($ra32)) {
                                                if ($ra32 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra32" id="ra32" value="no" <?php
                                            if (isset($ra32)) {
                                                if ($ra32 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td >EXTENSIÓN</td>
                                                <td><input type="radio" name="ra33" id="ra33" value="si" <?php
                                            if (isset($ra33)) {
                                                if ($ra33 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra33" id="ra33" value="no" <?php
                                            if (isset($ra33)) {
                                                if ($ra33 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td colspan=3><b>SIMETRÍA FACIAL</b></td>
                                            </TR>
                                            <TR>
                                                <td colspan=3><b>HOMBROS</b></td>
                                            </TR>
                                            <TR>
                                                <td >RETRAIDOS</td>
                                                <td><input type="radio" name="ra34" id="ra34" value="si" <?php
                                            if (isset($ra34)) {
                                                if ($ra34 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra34" id="ra34" value="no" <?php
                                            if (isset($ra34)) {
                                                if ($ra34 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td >PROTRUIDOS</td>
                                                <td><input type="radio" name="ra35" id="ra35" value="si" <?php
                                            if (isset($ra35)) {
                                                if ($ra35 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra35" id="ra35" value="no" <?php
                                            if (isset($ra35)) {
                                                if ($ra35 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td><b>SIMETRIA DE LOS ANGULOS ENTRE BRAZO Y TRONCO</b></td>
                                                <td></td><td></td>
                                            </TR>
                                            <TR>
                                                <td colspan=3><b>COLUMNA VERTEBRAL</b></td>
                                            </TR>
                                            <TR>
                                                <td >LORDOSIS CERVICAL</td>
                                                <td><input type="radio" name="ra36" id="ra36" value="si" <?php
                                            if (isset($ra36)) {
                                                if ($ra36 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra36" id="ra36" value="no" <?php
                                            if (isset($ra36)) {
                                                if ($ra36 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td >CIFOSIS  DORSAL</td>
                                                <td><input type="radio" name="ra37" id="ra37" value="si" <?php
                                            if (isset($ra37)) {
                                                if ($ra37 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra37" id="ra37" value="no" <?php
                                            if (isset($ra37)) {
                                                if ($ra37 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td >LORDOSIS LUMBAR</td>
                                                <td><input type="radio" name="ra38" id="ra38" value="si" <?php
                                            if (isset($ra38)) {
                                                if ($ra38 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra38" id="ra38" value="no" <?php
                                            if (isset($ra38)) {
                                                if ($ra38 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td colspan=3><b>ABDOMEN</b></td>
                                            </TR>
                                            <TR>
                                                <td >PROTRUIDO</td>
                                                <td><input type="radio" name="ra39" id="ra39" value="si" <?php
                                            if (isset($ra39)) {
                                                if ($ra39 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra39" id="ra39" value="no" <?php
                                            if (isset($ra39)) {
                                                if ($ra39 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td >RETRAIDO</td>
                                                <td><input type="radio" name="ra40" id="ra40" value="si" <?php
                                            if (isset($ra40)) {
                                                if ($ra40 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra40" id="ra40" value="no" <?php
                                            if (isset($ra40)) {
                                                if ($ra40 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td colspan=3><b>PELVIS</b></td>
                                            </TR>
                                            <TR>
                                                <td >ANTEVERSION</td>
                                                <td><input type="radio" name="ra41" id="ra41" value="si" <?php
                                            if (isset($ra41)) {
                                                if ($ra41 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra41" id="ra41" value="no" <?php
                                            if (isset($ra41)) {
                                                if ($ra41 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td >RETROVERSION</td>
                                                <td><input type="radio" name="ra42" id="ra42" value="si" <?php
                                            if (isset($ra42)) {
                                                if ($ra42 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra42" id="ra42" value="no" <?php
                                            if (isset($ra42)) {
                                                if ($ra42 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td >ROTACION</td>
                                                <td><input type="radio" name="ra43" id="ra43" value="si" <?php
                                            if (isset($ra43)) {
                                                if ($ra43 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra43" id="ra43" value="no" <?php
                                            if (isset($ra43)) {
                                                if ($ra43 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td colspan=3><b>RODILLAS</b></td>
                                            </TR>
                                            <TR>
                                                <td >HIPEREXTENSIÓN</td>
                                                <td><input type="radio" name="ra44" id="ra44" value="si" <?php
                                            if (isset($ra44)) {
                                                if ($ra44 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra44" id="ra44" value="no" <?php
                                            if (isset($ra44)) {
                                                if ($ra44 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td colspan=3> <b>PIE</b>
                                                </td>
                                            </TR>
                                            <TR>
                                                <td >PLANO</td>
                                                <td><input type="radio" name="ra45" id="ra45" value="si" <?php
                                            if (isset($ra45)) {
                                                if ($ra45 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra45" id="ra45" value="no" <?php
                                            if (isset($ra45)) {
                                                if ($ra45 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                            <TR>
                                                <td >CAVO</td>
                                                <td><input type="radio" name="ra46" id="ra46" value="si" <?php
                                            if (isset($ra46)) {
                                                if ($ra46 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                                <td><input type="radio" name="ra46" id="ra46" value="no" <?php
                                            if (isset($ra46)) {
                                                if ($ra46 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                            </TR>
                                        </table>
                                    </td>
                                </tr>
                            </table>	 
                        <!--</form>-->
                    </div>
                    <!-- fin tab 2-->
                    <div id="tabs-3">
                        <header><h3>EVALUACIÓN DE LA MARCHA </h3></header>
                        <!--<form  action="<?php
                        /*if (isset($_GET['editar'])) {
                            echo '../modelo/editar_consulta.php?edit=' . $id_orden . '';
                        } else {
                            echo '../modelo/insertar_consulta.php?paciente=' . $id . '';
                        }*/
                        ?>" method="post" enctype="multipart/form-data">     -->                
                            <fieldset><LEGEND>PERIODO  DE SOPORTE </LEGEND>

                                <table> 
                                    <tr>
                                        <td><label>Tacto del talón con el suelo:</label></td>
                                        <td> <input type="TEXT" name="marcha1" id="marcha1"> </td>
                                    </tr>
                                    <tr>
                                        <td><label>Apoyo completo de la planta del pie:</label></td>
                                        <td><input type="TEXT" name="marcha2" id="marcha2"></td></tr>
                                    <tr>
                                        <td><label>Despegue del talón o retropié:</label></td>
                                        <td><input type="TEXT" name="marcha3" id="marcha3"></td>
                                    </tr>
                                    <tr>
                                        <td><label>Despegue de los dedos o del antepié:</label></td>
                                        <td><input type="TEXT" name="marcha4" id="marcha4"></td>
                                    </tr>    
                                </table>
                            </fieldset>

                            <fieldset><LEGEND>PERIODO DE BALANCEO </LEGEND>
                                <table> 
                                    <tr>
                                        <td><label>Balanceo inicial:</label></td>
                                        <td> <input type="TEXT" name="balanceo1" id="balanceo1"> </td>
                                    </tr>
                                    <tr>
                                        <td><label>Balanceo medio:</label></td>
                                        <td><input type="TEXT" name="balanceo2" id="balanceo2"></td>
                                    </tr>
                                    <tr>
                                        <td><label>Balanceo terminal:</label></td>
                                        <td><input type="TEXT" name="balanceo3" id="balanceo3"></td>
                                    </tr>
                                </table>
                            </fieldset>

                            <fieldset><LEGEND>ALTERACIONES DE LA MARCHA</LEGEND>

                                <table style="border-collapse: collapse;" border=1>
                                    <tr>
                                        <td>TIPO DE ALTERACIÓN EN LA MARCHA</td>
                                        <td>SI</td>
                                        <TD>NO</td>
                                        <td colspan=5>OBSERVACIONES</td>
                                    </tr>   
                                    <tr>
                                        <td colspan=5>POR DÉFICIT DE FUERZA MUSCULAR </td>
                                    </tr>
                                    <tr>
                                        <td>Marcha 	Balanceante (Marcha de pato o ánade)</td>
                                        <td><input type="radio" name="ra47" id="ra47" value="si" <?php
                                            if (isset($ra47)) {
                                                if ($ra47 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>> 
                                        </td>
                                        <TD><input type="radio" name="ra47" id="ra47" <?php
                                            if (isset($ra47)) {
                                                if ($ra47 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> value="no">
                                        </td>
                                        <td colspan=2>
                                            <textarea name="ta47" id="ta47" style="width:600px;">
                                                <?php if (isset($ta47)) echo $ta47; ?>
                                            </textarea>
                                        </td>
                                    </tr>  
                                    <tr>
                                        <td>Marcha de Stepagge</td>
                                        <td><input type="radio" name="ra48" id="ra48" value="si" <?php
                                            if (isset($ra48)) {
                                                if ($ra48 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>> 
                                        </td>
                                        <TD><input type="radio" name="ra48" id="ra48" <?php
                                            if (isset($ra48)) {
                                                if ($ra48 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> value="no">
                                        </td>
                                        <td colspan=2>
                                            <textarea style="width:600px;" id="ta48" name="ta48">
                                                <?php if (isset($ta48)) echo $ta48; ?>
                                            </textarea>
                                        </td>
                                    </tr>  
                                    <tr>
                                        <td>Marcha Hemipléjica</td>
                                        <td><input type="radio" name="ra49" id="ra49" value="si" <?php
                                            if (isset($ra49)) {
                                                if ($ra49 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>> 
                                        </td>
                                        <TD><input type="radio" name="ra49" id="ra49" <?php
                                            if (isset($ra49)) {
                                                if ($ra49 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> value="no">
                                        </td>
                                        <td colspan=2>
                                            <textarea style="width:600px;" id="ta49" name="ta49">
                                                <?php if (isset($ta49)) echo $ta49; ?>
                                            </textarea>
                                        </td>
                                    </tr>  
                                    <tr>
                                        <td>Marcha Paraparésica</td>
                                        <td><input type="radio" name="ra50" id="ra50" value="si" <?php
                                            if (isset($ra50)) {
                                                if ($ra50 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>> 
                                        </td>
                                        <TD><input type="radio" name="ra50" id="ra50" <?php
                                            if (isset($ra50)) {
                                                if ($ra50 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> value="no">
                                        </td>
                                        <td colspan=2>
                                            <textarea style="width:600px;" id="ta50" name="ta50">
                                                <?php if (isset($ta50)) echo $ta50; ?>
                                            </textarea>
                                        </td>
                                    </tr>  
                                    <tr>
                                        <td colspan=5>POR ALTERACIÓN DE LA COORDINACIÓN ENTRE AGONISTAS Y ANTAGONISTAS</td>
                                    </tr>
                                    <tr>
                                        <td>Marcha Atáxica</td>
                                        <td><input type="radio" name="ra51" id="ra51" value="si" <?php
                                            if (isset($ra51)) {
                                                if ($ra51 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>> 
                                        </td>
                                        <TD><input type="radio" name="ra51" id="ra51" <?php
                                            if (isset($ra51)) {
                                                if ($ra51 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> value="no">
                                        </td>
                                        <td colspan=2>
                                            <textarea style="width:600px;" id="ta51" name="ta51">
                                                <?php if (isset($ta51)) echo $ta51; ?>
                                            </textarea>
                                        </td></tr>  
                                    <tr>
                                        <td>Marcha Cerebeloza</td>
                                        <td><input type="radio" name="ra52" id="ra52" value="si" <?php
                                            if (isset($ra52)) {
                                                if ($ra52 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>> 
                                        </td>
                                        <TD><input type="radio" name="ra52" id="ra52" <?php
                                            if (isset($ra52)) {
                                                if ($ra52 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> value="no">
                                        </td>
                                        <td colspan=2>
                                            <textarea style="width:600px;" id="ta52" name="ta52">
                                                <?php if (isset($ta52)) echo $ta52; ?>
                                            </textarea>
                                        </td></tr>  
                                    <tr>
                                        <td>Marcha Vestibular</td>
                                        <td><input type="radio" name="ra53" id="ra53" value="si" <?php
                                            if (isset($ra53)) {
                                                if ($ra53 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>> 
                                        </td>
                                        <TD><input type="radio" name="ra53" id="ra53" <?php
                                            if (isset($ra53)) {
                                                if ($ra53 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> value="no">
                                        </td>
                                        <td colspan=2>
                                            <textarea style="width:600px;" id="ta53" name="ta53">
                                                <?php if (isset($ta53)) echo $ta53; ?>
                                            </textarea>
                                        </td>
                                    </tr>  
                                    <tr>
                                        <td colspan=5>POR CAUSAS FUNCIONALES</td>
                                    </tr>
                                    <tr>
                                        <td>Marcha Antálgica</td>
                                        <td><input type="radio" name="ra54" id="ra54" value="si" <?php
                                            if (isset($ra54)) {
                                                if ($ra54 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>> 
                                        </td>
                                        <TD><input type="radio" name="ra54" id="ra54" <?php
                                            if (isset($ra54)) {
                                                if ($ra54 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> value="no">
                                        </td>
                                        <td colspan=2>
                                            <textarea style="width:600px;" id="ta54" name="ta54">
                                                <?php if (isset($ta54)) echo $ta54; ?>
                                            </textarea>
                                        </td>
                                    </tr>  
                                    <tr>
                                        <td>Marcha Histérica</td>
                                        <td><input type="radio" name="ra55" id="ra55" value="si" <?php
                                            if (isset($ra55)) {
                                                if ($ra55 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>> 
                                        </td>
                                        <TD><input type="radio" name="ra55" id="ra55" <?php
                                            if (isset($ra55)) {
                                                if ($ra55 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> value="no">
                                        </td>
                                        <td colspan=2>
                                            <textarea style="width:600px;" id="ta55" name="ta55">
                                                <?php if (isset($ta55)) echo $ta55; ?>
                                            </textarea>
                                        </td>
                                    </tr>  
                                </table>
                            </fieldset>                                       

                            <fieldset><LEGEND>PRUEBAS DE EXTENSIBILIDAD MUSCULAR PASIVA</LEGEND>

                                <table style="border-collapse: collapse;" border=1>
                                    <tr>
                                        <td rowspan=2>MUSCULOS</td>
                                        <td colspan=6>CRITERIO DE CALIFICACIÓN</td>
                                    </tr>   
                                    <tr>
                                        <td colspan=2>LEVE RETRACCIÓN DE LA MUSCULATURA (10% - 15%)</td>
                                        <td colspan=2>MODERADA RETRACCIÓN DE LA MUSCULATURA (30%)</td>
                                        <td colspan=2>GRAVE RETRACCIÓN DE LA MUSCULATURA (>30%)</td>
                                    </tr>  
                                    <tr>
                                        <td>MUSCULOS DE CABEZA Y CUELLO</td>
                                        <td> 	SI<input type="radio" name="rap1" id="rap1" value="si" <?php
                                            if (isset($rap1)) {
                                                if ($rap1 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td>NO <input type="radio" name="rap1" id="rap1" value="no" <?php
                                            if (isset($rap1)) {
                                                if ($rap1 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td> 	SI<input type="radio" name="rac1" id="rac1" value="si" <?php
                                            if (isset($rac1)) {
                                                if ($rac1 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td>NO<input type="radio" name="rac1" id="rac1" value="no" <?php
                                                if (isset($rac1)) {
                                                    if ($rac1 == 'no') {
                                                        echo 'checked';
                                                    }
                                                }
                                                ?> > 
                                        </td>
                                        <td>SI<input type="radio" name="raf1" id="raf1" value="si" <?php
                                            if (isset($raf1)) {
                                                if ($raf1 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                        <td>NO<input type="radio" name="raf1" id="raf1" value="no" <?php
                                            if (isset($raf1)) {
                                                if ($raf1 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>FLEXORES ANTERIORES</td>
                                        <td> 	SI<input type="radio" name="rap2" id="rap2" value="si" <?php
                                            if (isset($rap2)) {
                                                if ($rap2 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td>NO <input type="radio" name="rap2" id="rap2" value="no" <?php
                                            if (isset($rap2)) {
                                                if ($rap2 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td>SI<input type="radio" name="rac2" id="rac2" value="si" <?php
                                            if (isset($rac2)) {
                                                if ($rac2 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td>NO<input type="radio" name="rac2" id="rac2" value="no" <?php
                                            if (isset($rac2)) {
                                                if ($rac2 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> > 
                                        </td>
                                        <td>	SI<input type="radio" name="raf2" id="raf2" value="si" <?php
                                            if (isset($raf2)) {
                                                if ($raf2 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                        <td> 	NO<input type="radio" name="raf2" id="raf2" value="no" <?php
                                            if (isset($raf2)) {
                                                if ($raf2 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>FLEXORES ANTEROLATERALES</td>
                                        <td> 	SI<input type="radio" name="rap3" id="rap3" value="si" <?php
                                            if (isset($rap3)) {
                                                if ($rap3 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td>NO <input type="radio" name="rap3" id="rap3" value="no" <?php
                                                if (isset($rap3)) {
                                                    if ($rap3 == 'no') {
                                                        echo 'checked';
                                                    }
                                                }
                                                ?>>
                                        </td>
                                        <td>SI<input type="radio" name="rac3" id="rac3" value="si" <?php
                                            if (isset($rac3)) {
                                                if ($rac3 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td> 	NO<input type="radio" name="rac3" id="rac3" value="no" <?php
                                            if (isset($rac3)) {
                                                if ($rac3 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> > 
                                        </td>
                                        <td>	SI<input type="radio" name="raf3" id="raf3" value="si" <?php
                                            if (isset($raf3)) {
                                                if ($raf3 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                        <td> 	NO<input type="radio" name="raf3" id="raf3" value="no" <?php
                                            if (isset($raf3)) {
                                                if ($raf3 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>EXTENSORES POSTEROLATERALES</td>
                                        <td> 	SI<input type="radio" name="rap4" id="rap4" value="si" <?php
                                            if (isset($rap4)) {
                                                if ($rap4 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td>NO <input type="radio" name="rap4" id="rap4" value="no" <?php
                                                if (isset($rap4)) {
                                                    if ($rap4 == 'no') {
                                                        echo 'checked';
                                                    }
                                                }
                                                ?>>
                                        </td>
                                        <td> 	SI<input type="radio" name="rac4" id="rac4" value="si" <?php
                                            if (isset($rac4)) {
                                                if ($rac4 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td> 	NO<input type="radio" name="rac4" id="rac4" value="no" <?php
                                            if (isset($rac4)) {
                                                if ($rac4 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> > 
                                        </td>
                                        <td>	SI<input type="radio" name="raf4" id="raf4" value="si" <?php
                                            if (isset($raf4)) {
                                                if ($raf4 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                        <td> 	NO<input type="radio" name="raf4" id="raf4" value="no" <?php
                                            if (isset($raf4)) {
                                                if ($raf4 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                    </tr> 
                                    <TR>
                                        <TD COLSPAN=7>MUSCULOS DE TRONCO</TD>
                                    </TR>
                                    <tr>
                                        <td>ESPINALES ALTOS</td>
                                        <td> 	SI<input type="radio" name="rap5" id="rap5" value="si" <?php
                                            if (isset($rap5)) {
                                                if ($rap5 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td>NO <input type="radio" name="rap5" id="rap5" value="no" <?php
                                                if (isset($rap5)) {
                                                    if ($rap5 == 'no') {
                                                        echo 'checked';
                                                    }
                                                }
                                                ?>>
                                        </td>
                                        <td> 	SI<input type="radio" name="rac5" id="rac5" value="si" <?php
                                            if (isset($rac5)) {
                                                if ($rac5 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td> 	NO<input type="radio" name="rac5" id="rac5" value="no" <?php
                                            if (isset($rac5)) {
                                                if ($rac5 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> > 
                                        </td>
                                        <td>	SI<input type="radio" name="raf5" id="raf5" value="si" <?php
                                            if (isset($raf5)) {
                                                if ($raf5 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                        <td> 	NO<input type="radio" name="raf5" id="raf5" value="no" <?php
                                            if (isset($raf5)) {
                                                if ($raf5 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>ESPINALES BAJOS</td>
                                        <td> 	SI<input type="radio" name="rap6" id="rap6" value="si" <?php
                                            if (isset($rap6)) {
                                                if ($rap6 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                        <td>NO <input type="radio" name="rap6" id="rap6" value="no" <?php
                                                if (isset($rap6)) {
                                                    if ($rap6 == 'no') {
                                                        echo 'checked';
                                                    }
                                                }
                                                ?>>
                                        </td>
                                        <td> 	SI<input type="radio" name="rac6" id="rac6" value="si" <?php
                                            if (isset($rac6)) {
                                                if ($rac6 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td> 	NO<input type="radio" name="rac6" id="rac6" value="no" <?php
                                            if (isset($rac6)) {
                                                if ($rac6 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> > 
                                        </td>
                                        <td>	SI<input type="radio" name="raf6" id="raf6" value="si" <?php
                                            if (isset($raf6)) {
                                                if ($raf6 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                        <td> 	NO<input type="radio" name="raf6" id="raf6" value="no" <?php
                                            if (isset($raf6)) {
                                                if ($raf6 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                    </tr> 
                                    <TR>
                                        <TD COLSPAN=7>MUSCULOS DE MIEMBRO SUPERIOR</TD>
                                    </TR>
                                    <tr>
                                        <td>DORSAL ANCHO Y ROMBOIDES MAYOR</td>
                                        <td> 	SI<input type="radio" name="rap7" id="rap7" value="si" <?php
                                            if (isset($rap7)) {
                                                if ($rap7 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td>NO <input type="radio" name="rap7" id="rap7" value="no" <?php
                                                if (isset($rap7)) {
                                                    if ($rap7 == 'no') {
                                                        echo 'checked';
                                                    }
                                                }
                                                ?>>
                                        </td>
                                        <td> 	SI<input type="radio" name="rac7" id="rac7" value="si" <?php
                                            if (isset($rac7)) {
                                                if ($rac7 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                        <td> 	NO<input type="radio" name="rac7" id="rac7" value="no" <?php
                                            if (isset($rac7)) {
                                                if ($rac7 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> > </td>
                                        <td>	SI<input type="radio" name="raf7" id="raf7" value="si" <?php
                                            if (isset($raf7)) {
                                                if ($raf7 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> ></td>
                                        <td> 	NO<input type="radio" name="raf7" id="raf7" value="no" <?php
                                            if (isset($raf7)) {
                                                if ($raf7 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>ROTADORES INTERNOS</td>
                                        <td>SI<input type="radio" name="rap8" id="rap8" value="si" <?php
                                            if (isset($rap8)) {
                                                if ($rap8 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td>NO<input type="radio" name="rap8" id="rap8" value="no" <?php
                                                if (isset($rap8)) {
                                                    if ($rap8 == 'no') {
                                                        echo 'checked';
                                                    }
                                                }
                                                ?>>
                                        </td>
                                        <td>SI<input type="radio" name="rac8" id="rac8" value="si" <?php
                                            if (isset($rac8)) {
                                                if ($rac8 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td>NO<input type="radio" name="rac8" id="rac8" value="no" <?php
                                            if (isset($rac8)) {
                                                if ($rac8 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> > 
                                        </td>
                                        <td>SI<input type="radio" name="raf8" id="raf8" value="si" <?php
                                            if (isset($raf8)) {
                                                if ($raf8 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                        <td>NO<input type="radio" name="raf8" id="raf8" value="no" <?php
                                            if (isset($raf8)) {
                                                if ($raf8 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>ROTADORES EXTERNOS</td>
                                        <td> 	SI<input type="radio" name="rap9" id="rap9" value="si" <?php
                                            if (isset($rap9)) {
                                                if ($rap9 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td>NO <input type="radio" name="rap9" id="rap9" value="no" <?php
                                                if (isset($rap9)) {
                                                    if ($rap9 == 'no') {
                                                        echo 'checked';
                                                    }
                                                }
                                                ?>>
                                        </td>
                                        <td> 	SI<input type="radio" name="rac9" id="rac9" value="si" <?php
                                            if (isset($rac9)) {
                                                if ($rac9 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td> 	NO<input type="radio" name="rac9" id="rac9" value="no" <?php
                                            if (isset($rac9)) {
                                                if ($rac9 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> > 
                                        </td>
                                        <td>	SI<input type="radio" name="raf9" id="raf9" value="si" <?php
                                            if (isset($raf9)) {
                                                if ($raf9 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                        <td> 	NO<input type="radio" name="raf9" id="raf9" value="no" <?php
                                            if (isset($raf9)) {
                                                if ($raf9 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>PECTORAL MAYOR</td>
                                        <td> 	SI<input type="radio" name="rap10" id="rap10" value="si" <?php
                                            if (isset($rap10)) {
                                                if ($rap10 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td>NO <input type="radio" name="rap10" id="rap10" value="no" <?php
                                                if (isset($rap10)) {
                                                    if ($rap10 == 'no') {
                                                        echo 'checked';
                                                    }
                                                }
                                                ?>>
                                        </td>
                                        <td> 	SI<input type="radio" name="rac10" id="rac10" value="si" <?php
                                            if (isset($rac10)) {
                                                if ($rac10 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td><td> 	NO<input type="radio" id="rac10" name="rac10" value="no" <?php
                                            if (isset($rac10)) {
                                                if ($rac10 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> > </td><td>	SI<input type="radio" id="raf10" name="raf10" value="si" <?php
                                            if (isset($raf10)) {
                                                if ($raf10 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> ></td><td>NO<input type="radio" name="raf10" id="raf10" value="no" <?php
                                            if (isset($raf10)) {
                                                if ($raf10 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>BICEPS BRAQUIAL</td>
                                        <td> 	SI<input type="radio" name="rap11" id='rap11' value="si" <?php
                                            if (isset($rap11)) {
                                                if ($rap11 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td>NO <input type="radio" name="rap11" id='rap11' value="no" <?php
                                                if (isset($rap11)) {
                                                    if ($rap11 == 'no') {
                                                        echo 'checked';
                                                    }
                                                }
                                                ?>>
                                        </td>
                                        <td> 	SI<input type="radio" name="rac11" id='rac11' value="si" <?php
                                            if (isset($rac11)) {
                                                if ($rac11 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td> 	NO<input type="radio" name="rac11" id='rac11' value="no" <?php
                                            if (isset($rac11)) {
                                                if ($rac11 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> > 
                                        </td>
                                        <td>	SI<input type="radio" name="raf11" id='raf11' value="si" <?php
                                            if (isset($raf11)) {
                                                if ($raf11 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                        <td> 	NO<input type="radio" name="raf11" id='raf11' value="no" <?php
                                            if (isset($raf11)) {
                                                if ($raf11 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>TRICEPS BRAQUIAL</td>
                                        <td> 	SI<input type="radio" name="rap12" id='rap12' value="si" <?php
                                            if (isset($rap12)) {
                                                if ($rap12 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td>NO <input type="radio" name="rap12" id='rap12' value="no" <?php
                                                if (isset($rap12)) {
                                                    if ($rap12 == 'no') {
                                                        echo 'checked';
                                                    }
                                                }
                                                ?>>
                                        </td>
                                        <td> 	SI<input type="radio" name="rac12" id='rac12' value="si" <?php
                                            if (isset($rac12)) {
                                                if ($rac12 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td> 	NO<input type="radio" name="rac12" id='rac12' value="no" <?php
                                            if (isset($rac12)) {
                                                if ($rac12 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> > 
                                        </td>
                                        <td>	SI<input type="radio" name="raf12" id='raf12' value="si" <?php
                                            if (isset($raf12)) {
                                                if ($raf12 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                        <td> 	NO<input type="radio" name="raf12" id="raf12" value="no" <?php
                                            if (isset($raf12)) {
                                                if ($raf12 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>FLEXORES COMUNES SUPERFICIALES Y PROFUNDO DE LOS DEDOS</td>
                                        <td> 	SI<input type="radio" name="rap13" id="rap13" value="si" <?php
                                            if (isset($rap13)) {
                                                if ($rap13 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td>NO <input type="radio" name="rap13" id="rap13" value="no" <?php
                                            if (isset($rap13)) {
                                                if ($rap13 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td> 	SI<input type="radio" name="rac13" id="rac13" value="si" <?php
                                            if (isset($rac13)) {
                                                if ($rac13 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td> 	NO<input type="radio" name="rac13" id="rac13" value="no" <?php
                                            if (isset($rac13)) {
                                                if ($rac13 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> > 
                                        </td>
                                        <td>	SI<input type="radio" name="raf13" id="raf13" value="si" <?php
                                            if (isset($raf13)) {
                                                if ($raf13 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                        <td> 	NO<input type="radio" name="raf13" id="raf13" value="no" <?php
                                            if (isset($raf13)) {
                                                if ($raf13 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>EXTENSORES COMUNES DE LOS DEDOS</td>
                                        <td> 	SI<input type="radio" name="rap14" id="rap14" value="si" <?php
                                            if (isset($rap14)) {
                                                if ($rap14 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td>NO <input type="radio" name="rap14" id="rap14" value="no" <?php
                                                if (isset($rap14)) {
                                                    if ($rap14 == 'no') {
                                                        echo 'checked';
                                                    }
                                                }
                                                ?>>
                                        </td>
                                        <td> 	SI<input type="radio" name="rac14" id="rac14" value="si" <?php
                                            if (isset($rac14)) {
                                                if ($rac14 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td> 	NO<input type="radio" name="rac14" id="rac14" value="no" <?php
                                            if (isset($rac14)) {
                                                if ($rac14 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> > 
                                        </td>
                                        <td>	SI<input type="radio" name="raf14" id="raf14" value="si" <?php
                                            if (isset($raf14)) {
                                                if ($raf14 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                        <td> 	NO<input type="radio" name="raf14" id="raf14" value="no" <?php
                                            if (isset($raf14)) {
                                                if ($raf14 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                    </tr> 
                                    <TR>
                                        <TD COLSPAN=7>MUSCULOS DE MIEMBROS INFERIORES</TD>
                                    </TR>
                                    <tr>
                                        <td>FLEXORES DE CADERA</td>
                                        <td> 	SI<input type="radio" name="rap15" id="rap15" value="si" <?php
                                            if (isset($rap15)) {
                                                if ($rap15 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td>NO <input type="radio" name="rap15" id="rap15" value="no" <?php
                                                if (isset($rap15)) {
                                                    if ($rap15 == 'no') {
                                                        echo 'checked';
                                                    }
                                                }
                                                ?>>
                                        </td>
                                        <td> 	SI<input type="radio" name="rac15" id="rac15" value="si" <?php
                                            if (isset($rac15)) {
                                                if ($rac15 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td> 	NO<input type="radio" name="rac15" id="rac15" value="no" <?php
                                            if (isset($rac15)) {
                                                if ($rac15 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> > 
                                        </td>
                                        <td>	SI<input type="radio" name="raf15" id="raf15" value="si" <?php
                                            if (isset($raf15)) {
                                                if ($raf15 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                        <td> 	NO<input type="radio" name="raf15" id="raf15" value="no" <?php
                                            if (isset($raf15)) {
                                                if ($raf15 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>ISQUITIBIALES</td>
                                        <td> 	SI<input type="radio" name="rap16" id="rap16" value="si" <?php
                                            if (isset($rap16)) {
                                                if ($rap16 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td>NO <input type="radio" name="rap16" id="rap16" value="no" <?php
                                                if (isset($rap16)) {
                                                    if ($rap16 == 'no') {
                                                        echo 'checked';
                                                    }
                                                }
                                                ?>>
                                        </td>
                                        <td> 	SI<input type="radio" name="rac16" id="rac16" value="si" <?php
                                            if (isset($rac16)) {
                                                if ($rac16 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td> 	NO<input type="radio" name="rac16" id="rac16" value="no" <?php
                                            if (isset($rac16)) {
                                                if ($rac16 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> > 
                                        </td>
                                        <td>	SI<input type="radio" name="raf16" id="raf16" value="si" <?php
                                            if (isset($raf16)) {
                                                if ($raf16 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        
                                        </td>
                                        <td> 	NO<input type="radio" name="raf16" id="raf16" value="no" <?php
                                            if (isset($raf16)) {
                                                if ($raf16 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>RECTO ANTERIOR</td>
                                        <td> 	SI<input type="radio" name="rap17" id="rap17" value="si" <?php
                                            if (isset($rap17)) {
                                                if ($rap17 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td>NO <input type="radio" name="rap17" id="rap17" value="no" <?php
                                                if (isset($rap17)) {
                                                    if ($rap17 == 'no') {
                                                        echo 'checked';
                                                    }
                                                }
                                                ?>>
                                        </td>
                                        <td> 	SI<input type="radio" name="rac17" id="rac17" value="si" <?php
                                            if (isset($rac17)) {
                                                if ($rac17 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td> 	NO<input type="radio" name="rac17" id="rac17" value="no" <?php
                                            if (isset($rac17)) {
                                                if ($rac17 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> > 
                                        </td>
                                        <td>	SI<input type="radio" name="raf17" id="raf17" value="si" <?php
                                            if (isset($raf17)) {
                                                if ($raf17 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                        <td> 	NO<input type="radio" name="raf17" id="raf17" value="no" <?php
                                            if (isset($raf17)) {
                                                if ($raf17 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>ROTADORES EXTERNOS</td>
                                        <td> 	SI<input type="radio" name="rap18" id="rap18" value="si" <?php
                                            if (isset($rap18)) {
                                                if ($rap18 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td>NO <input type="radio" name="rap18" id="rap18" value="no" <?php
                                                if (isset($rap18)) {
                                                    if ($rap18 == 'no') {
                                                        echo 'checked';
                                                    }
                                                }
                                                ?>>
                                        </td>
                                        <td> 	SI<input type="radio" name="rac18" id="rac18" value="si" <?php
                                            if (isset($rac18)) {
                                                if ($rac18 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td> 	NO<input type="radio" name="rac18" id="rac18" value="no" <?php
                                            if (isset($rac18)) {
                                                if ($rac18 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> > 
                                        </td>
                                        <td>	SI<input type="radio" name="raf18" id="raf18" value="si" <?php
                                            if (isset($raf18)) {
                                                if ($raf18 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                        <td>NO<input type="radio" name="raf18" id="raf18" value="no" <?php
                                            if (isset($raf18)) {
                                                if ($raf18 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>ROTADORES INTERNOS</td>
                                        <td>SI<input type="radio" name="rap21" id="rap21" value="si" <?php
                                            if (isset($rap21)) {
                                                if ($rap21 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                        <td>NO<input type="radio" name="rap21" id="rap21" value="no" <?php
                                            if (isset($rap21)) {
                                                if ($rap21 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                        <td>SI<input type="radio" name="rac21" id="rac21" value="si" <?php
                                            if (isset($rac21)) {
                                                if ($rac21 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                        <td>NO<input type="radio" name="rac21" id="rac21" value="no" <?php
                                            if (isset($rac21)) {
                                                if ($rac21 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                        <td>SI<input type="radio" name="raf21" id="raf21" value="si" <?php
                                            if (isset($raf21)) {
                                                if ($raf21 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                        <td>NO<input type="radio" name="raf21" id="raf21" value="no" <?php
                                            if (isset($raf21)) {
                                                if ($raf21 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>></td>
                                    </tr> 
                                    <tr>
                                        <td>ADDUCTORES</td>
                                        <td> 	SI<input type="radio" name="rap19" id="rap19" value="si" <?php
                                            if (isset($rap19)) {
                                                if ($rap19 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td>NO <input type="radio" name="rap19" id="rap19" value="no" <?php
                                                if (isset($rap19)) {
                                                    if ($rap19 == 'no') {
                                                        echo 'checked';
                                                    }
                                                }
                                                ?>>
                                        </td>
                                        <td> 	SI<input type="radio" name="rac19" id="rac19" value="si" <?php
                                            if (isset($rac19)) {
                                                if ($rac19 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td> 	NO<input type="radio" name="rac19" id="rac19" value="no" <?php
                                            if (isset($rac19)) {
                                                if ($rac19 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> > 
                                        </td>
                                        <td>	SI<input type="radio" name="raf19" id="raf19" value="si" <?php
                                            if (isset($raf19)) {
                                                if ($raf19 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                        <td> 	NO<input type="radio" name="raf19" id="raf19" value="no" <?php
                                            if (isset($raf19)) {
                                                if ($raf19 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>GEMELOS</td>
                                        <td> 	SI<input type="radio" name="rap20" id="rap20" value="si" <?php
                                            if (isset($rap20)) {
                                                if ($rap20 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td>NO <input type="radio" name="rap20" id="rap20" value="no" <?php
                                                if (isset($rap20)) {
                                                    if ($rap20 == 'no') {
                                                        echo 'checked';
                                                    }
                                                }
                                                ?>>
                                        </td>
                                        <td> 	SI<input type="radio" name="rac20" id="rac20" value="si" <?php
                                            if (isset($rac20)) {
                                                if ($rac20 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                        </td>
                                        <td> 	NO<input type="radio" name="rac20" id="rac20" value="no" <?php
                                            if (isset($rac20)) {
                                                if ($rac20 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> > 
                                        </td>
                                        <td>	SI<input type="radio" name="raf20" id="raf20" value="si" <?php
                                            if (isset($raf20)) {
                                                if ($raf20 == 'si') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                        <td> 	NO<input type="radio" name="raf20" id="raf20" value="no" <?php
                                            if (isset($raf20)) {
                                                if ($raf20 == 'no') {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                        </td>
                                    </tr> 

                                </table>
                            </fieldset>

                            <fieldset><LEGEND>ALTERACIONES DE LA MARCHA</LEGEND>

                                <table style="border-collapse: collapse;" border=1>
                                    <tr>
                                        <td>GRADO</td>
                                        <td>CRITERIO DE CALIFICACIÓN</td>
                                        <TD>DESCRIPCIÓN DEL HALLAZGO lado izquierdo lado derecho</td>
                                    </tr>
                                    <tr>
                                        <td>0</td>
                                        <td>No hay respuesta (flacidez)</td>
                                        <TD>
                                            <textarea style="width:700px;" name="tm1" id="tm1">
                                                <?php if (isset($tm1)) echo $tm1; ?>
                                            </textarea>
                                        </td>
                                    </tr>  
                                    <tr>
                                        <td>1</td>
                                        <td>Respuesta disminuida (hipotonía) </td>
                                        <TD>
                                            <textarea style="width:700px;" name="tm2" id="tm2">
                                                <?php if (isset($tm2)) echo $tm2; ?>
                                            </textarea>
                                        </td>
                                    </tr>  
                                    <tr>
                                        <td>2</td>
                                        <td>Respuesta  normal</td>
                                        <TD>
                                            <textarea style="width:700px;" name="tm3" id="tm3">
                                                <?php if (isset($tm3)) echo $tm3; ?>
                                            </textarea>
                                        </td>
                                    </tr>  
                                    <tr>
                                        <td>3</td>
                                        <td>Respuesta exagerada (leve o moderada hipertonía)</td>
                                        <TD>
                                            <textarea style="width:700px;" name="tm4" id="tm4">
                                                <?php if (isset($tm4)) echo $tm4; ?>
                                            </textarea>
                                        </td>
                                    </tr>  
                                    <tr>
                                        <td>4</td>
                                        <td>Respuesta sostenida (grave hipertonía)</td>
                                        <TD>
                                            <textarea style="width:700px;" name="tm5" id="tm5">
                                                <?php if (isset($tm5)) echo $tm5; ?>
                                            </textarea>
                                        </td>
                                    </tr>  


                                </TABLE>
                            </fieldset>
                            <header><h3>ACTIVIDADES Y PARTICIPACIÓN</h3></header>

                            <table style="border-collapse: collapse;" border=1>
                                <tr>
                                    <td></td>
                                    <td>CATEGORIAS:</td>
                                    <td>Digite de 1 a 7 la valoración</td>
                                </tr>
                                <tr>
                                    <td colspan=3>AUTOCUIDADO</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Alimentación</td>
                                    <td><input type="text" size=2 maxlength=1 name="part1" id="part1" value="<?php if (isset($part1)) echo $part1; ?>"></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Arreglo personal</td>
                                    <td><input type="text" size=2 maxlength=1 name="part2" id="part2" value="<?php if (isset($part2)) echo $part2; ?>"></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Baño</td>
                                    <td><input type="text" size=2 maxlength=1 name="part3" id="part3" value="<?php if (isset($part3)) echo $part3; ?>"></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Vestido hemicuerpo superior</td>
                                    <td><input type="text" size=2 maxlength=1 name="part4" id="part4" value="<?php if (isset($part4)) echo $part4; ?>"></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Vestido hemicuerpo inferior</td>
                                    <td><input type="text" size=2 maxlength=1 name="part5" id="part5" value="<?php if (isset($part5)) echo $part5; ?>"></td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>Aseo Perineal</td>
                                    <td><input type="text" size=2 maxlength=1 name="part6" id="part6" value="<?php if (isset($part6)) echo $part6; ?>"></td>
                                </tr>
                                <tr>
                                    <td colspan=9>CONTROL DE ESFINTER</td>
                                </tr>						
                                <tr>
                                    <td>7</td>
                                    <td>Control de la vejiga</td>
                                    <td><input type="text" size=2 maxlength=1 name="part7" id="part7" value="<?php if (isset($part7)) echo $part7; ?>"></td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>Control del intestino</td>
                                    <td><input type="text" size=2 maxlength=1 name="part8" id="part8" value="<?php if (isset($part8)) echo $part8; ?>"></td>
                                </tr>
                                <tr>
                                    <td colspan=9>TRANSFERENCIAS</td>
                                </tr>						
                                <tr>
                                    <td>9</td>
                                    <td>Traslado de la cama a silla  o silla de ruedas</td>
                                    <td><input type="text" size=2 maxlength=1 name="part9" id="part9" value="<?php if (isset($part9)) echo $part9; ?>"></td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>Traslado en baño</td>
                                    <td><input type="text" size=2 maxlength=1 name="part10" id="part10" value="<?php if (isset($part10)) echo $part10; ?>"></td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td>Traslado en bañera o ducha</td>
                                    <td><input type="text" size=2 maxlength=1 name="part11" id="part11" value="<?php if (isset($part11)) echo $part11; ?>"></td>
                                </tr>
                                <tr>
                                    <td colspan=9>LOCOMOCIÓN</td>
                                </tr>												
                                <tr>
                                    <td>12</td>
                                    <td>Caminar/desplazarse en silla de ruedas</td>
                                    <td><input type="text" size=2 maxlength=1 name="part12" id="part12" value="<?php if (isset($part12)) echo $part12; ?>"></td>
                                </tr>
                                <tr>
                                    <td>13</td>
                                    <td>Subir y bajar escalera</td>
                                    <td><input type="text" size=2 maxlength=1 name="part13" id="part13" value="<?php if (isset($part13)) echo $part13; ?>"></td>
                                </tr>
                                <tr>
                                    <td colspan=9>COMUNICACION</td>
                                </tr>						
                                <tr>
                                    <td>14</td>
                                    <td>Comprensión</td>
                                    <td><input type="text" size=2 maxlength=1 name="part14" id="part14" value="<?php if (isset($part14)) echo $part14; ?>"></td>
                                </tr>
                                <tr>
                                    <td>15</td>
                                    <td>Expresión</td>
                                    <td><input type="text" size=2 maxlength=1 name="part15" id="part15" value="<?php if (isset($part15)) echo $part15; ?>"></td>
                                </tr>
                                <tr>
                                    <td colspan=9>COGNICIÓN SOCIAL</td>
                                </tr>						
                                <tr>
                                    <td>16</td>
                                    <td>Interacción social</td>
                                    <td><input type="text" size=2 maxlength=1 name="part16" id="part16" value="<?php if (isset($part16)) echo $part16; ?>"></td>
                                </tr>
                                <tr>
                                    <td>17</td>
                                    <td>Solución de problemas</td>
                                    <td><input type="text" size=2 maxlength=1 name="part17" id="part17" value="<?php if (isset($part17)) echo $part17; ?>"></td>
                                </tr>
                                <tr>
                                    <td>18</td>
                                    <td>Memoria</td>
                                    <td><input type="text" size=2 maxlength=1 name="part18" id="part18" value="<?php if (isset($part18)) echo $part18; ?>"></td>
                                </tr>
                            </table>
                            <!--<button class="btn btn-info">Guardar</button> 	 -->					 
                        <!--</form>-->
                    </div>
                    <!-- fin tabs 3-->
                    <div id="tabs-4">
                        <header><h3>DIAGNÓSTICO FISIOTERAPÉUTICO</h3></header>
                        <!--<form  action="<?php
                        /*if (isset($_GET['editar'])) {
                            echo '../modelo/editar_consulta.php?edit=' . $id_orden . '';
                        } else {
                            echo '../modelo/insertar_consulta.php?paciente=' . $id . '';
                        }*/
                        ?>" method="post" enctype="multipart/form-data">  -->               
                            <fieldset>
                                <div class="module_content"> 
                                    <table>
                                        <tr>
                                            <td>DEFICIENCIAS:</td>
                                        </tr>
                                        <tr> 
                                            <td><textarea style="width:700px;" rows="8" name="tdf1" id="tdf1"><?php
                                                    if (isset($tdf1)) {
                                                        echo $tdf1;
                                                    }
                                                    ?></textarea> 
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>LIMITACIONES FUNCIONALES:</td>
                                        </tr>
                                        <tr> 
                                            <td><textarea style="width:700px;" rows="8" name="tdf2" id="tdf2"><?php
                                                    if (isset($tdf2)) {
                                                        echo $tdf2;
                                                    }
                                                    ?></textarea> 
                                            </td>
                                            <td></td>
                                        </tr>

                                        <tr>
                                            <td>RESTRICCIONES EN LA PARTICIPACIÓN:</td>
                                        </tr>
                                        <tr> 
                                            <td><textarea style="width:700px;" rows="8" name="tdf3" id="tdf3"><?php
                                                    if (isset($tdf3)) {
                                                        echo $tdf3;
                                                    }
                                                    ?></textarea> 
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>FACTORES CONTEXTUALES:</td>
                                        </tr>
                                        <tr> 
                                            <td><textarea style="width:700px;" rows="8" name="tdf4" id="tdf4"><?php
                                                    if (isset($tdf4)) {
                                                        echo $tdf4;
                                                    }
                                                    ?></textarea> 
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>OBJETIVO DE TRATAMIENTO:</td>
                                        </tr>
                                        <tr> 
                                            <td><textarea style="width:700px;" rows="8" name="tdf5" id="tdf5"><?php
                                                    if (isset($tdf5)) {
                                                        echo $tdf5;
                                                    }
                                                    ?></textarea> 
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>PLAN DE MANEJO:</td>
                                        </tr>
                                        <tr> 
                                            <td><textarea style="width:700px;" rows="8" name="tdf6" id="tdf6"><?php
                                                    if (isset($tdf6)) {
                                                        echo $tdf6;
                                                    }
                                                    ?></textarea> 
                                            </td>
                                            <td></td>
                                        </tr>		

                                        <tr>
                                            <td>RECOMENDACIONES Y OBSERVACIONES :</td>
                                        </tr>
                                        <tr> 
                                            <td><textarea style="width:700px;" rows="8" name="tdf7" id="tdf7"><?php
                                                    if (isset($tdf7)) {
                                                        echo $tdf7;
                                                    }
                                                    ?></textarea> 
                                            </td>
                                            <td></td>
                                        </tr>										 
                                    </table>

                                    <!--<button class="btn btn-info">Guardar</button> 	 -->
                            </fieldset>

                        <!--</form>-->
                    </div>  
                    <!-- Fin tabs 4-->
                </div>
            </div>		
        </section> 
    </form>


</body>

</html>
