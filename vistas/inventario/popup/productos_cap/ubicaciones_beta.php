<?php
   include '../../../../modelo/conexioni.php';
   session_start();
   date_default_timezone_set("America/Bogota" ) ; 
	$hora = date('H:i:s',time() - 3600*date('I'));
	$fecha_hoy = date("Y-m-d").' '.$hora;
	$date = date("Y-m-d");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sistema de Ubicaciones</title>
       <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css" />
       <link rel="stylesheet" href="../../../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
       <link rel="stylesheet" href="../../../assets/css/jquery-ui.custom.min.css" />
       <link rel="stylesheet" href="../../../assets/css/jquery.gritter.min.css" />
       <link rel="stylesheet" href="../../../assets/css/fonts.googleapis.com.css" />
       <link rel="stylesheet" href="../../../assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
       <link rel="stylesheet" href="../../../assets/css/ace-skins.min.css" />
       <link rel="stylesheet" href="../../../assets/css/ace-rtl.min.css" />
       <link rel="stylesheet" href="../../../assets/css/chosen.min.css" />
       <link rel="stylesheet" href="../../../assets/css/bootstrap-datepicker3.min.css" />
       <link rel="stylesheet" href="../../../assets/css/bootstrap-timepicker.min.css" />
       <link rel="stylesheet" href="../../../assets/css/daterangepicker.min.css" />
       <link rel="stylesheet" href="../../../assets/css/bootstrap-datetimepicker.min.css" />
       <link rel="stylesheet" href="../../../assets/css/bootstrap-colorpicker.min.css" />
       <link href="../../../css/estilo.css" rel="stylesheet">
       <script src="funciones.js"></script>
        
    </head>
    <body style="margin: 5%">
        <h4 id=""><b style="color: black; font-size: 20px;">UBICACIONES DE  &nbsp;<?php echo $_GET['sede'] ?></b></h4>
        <table class="table table-bordered" style="background-color: #438EB9;color: black;">
             <tr class="bg-info">
                 <th><b>UBI</b></th> 
                 <th class="center">1</th>
                 <th class="center">2</th>
                 <th class="center">3</th>
                 <th class="center">4</th>
                 <th class="center">5</th>
                 <th class="center">6</th>
                 <th class="center">7</th>
                 <th class="center">8</th>
                 <th class="center">9</th>
                 <th class="center">10</th>
                 <th class="center">11</th>
                 <th class="center">12</th>
                 <th class="center">13</th>
                 <th class="center">14</th>
                 <th class="center">15</th>
                 <th class="center">16</th>
                 <th class="center">17</th>
                 <th class="center">18</th>
                 <th class="center">19</th>
                 <th class="center">20</th>
             </tr>
                 <tbody id="mostrar_dados">
                               		<?php
                                        $sede = $_GET['sede'];
                               			$sql=mysqli_query($con, "SELECT columna, COUNT(columna) FROM `ubicaciones` WHERE codigo_cp='$sede' GROUP BY columna");
                               			while ( $row=mysqli_fetch_assoc($sql)) {
                               				echo '<tr>';
                               				echo '<td class="bg-info">'.$row['columna'].'</td>';
                               				for ($i=1; $i <= $row['COUNT(columna)']; $i++) { 
                                        $send="'".strtoupper(trim($row['columna'].$i))."'";
                                        $codigo= "'".$_GET['cod']."'";
                                        echo '<td><div class="radio">
                                                  <label>
                                                  <input name="form-field-radio" type="radio" class="ace input-lg tooltip-error" onclick="sedin('.$send.','.$codigo.')" title="" data-original-title="Top Danger">
                                                  <span class="lbl bigger-120 tooltip-error" data-rel="tooltip" data-placement="top" title="" data-original-title="'.$row['columna'].$i.'"></span>
                                                  </label>
                                                  </div></td>';
                                      }
                                      echo '</tr>';
                               			}
                               		?>
                               </tbody>
        </table><br><br>

<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse display">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-210">
<script type="text/javascript">
  function sedin(ref,cod) {
    window.opener.$("#ubi"+cod).val(ref);
    window.close();
  }
</script>

  <!--[if !IE]> -->
    <script src="../../../assets/js/jquery-2.1.4.min.js"></script>

    <!-- <![endif]-->

    <!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
    <script type="text/javascript">
      if('ontouchstart' in document.documentElement) document.write("<script src='../../../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
    </script>
    <script src="../../../assets/js/bootstrap.min.js"></script>

    <!-- page specific plugin scripts -->

    <!--[if lte IE 8]>
      <script src="assets/js/excanvas.min.js"></script>
    <![endif]-->
    <script src="../../../assets/js/jquery-ui.custom.min.js"></script>
    <script src="../../../assets/js/jquery.ui.touch-punch.min.js"></script>
    <script src="../../../assets/js/bootbox.js"></script>
    <script src="../../../assets/js/jquery.easypiechart.min.js"></script>
    <script src="../../../assets/js/jquery.gritter.min.js"></script>
    <script src="../../../assets/js/spin.js"></script>

    <!-- ace scripts -->
    <script src="../../../assets/js/ace-elements.min.js"></script>
    <script src="../../../assets/js/ace.min.js"></script>

    <!-- inline scripts related to this page -->
    <script type="text/javascript">
      jQuery(function($) {
        /**
        $('#myTab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
          //console.log(e.target.getAttribute("href"));
        })
          
        $('#accordion').on('shown.bs.collapse', function (e) {
          //console.log($(e.target).is('#collapseTwo'))
        });
        */
        
        $('#myTab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
          //if($(e.target).attr('href') == "#home") doSomethingNow();
        })
      
        
        /**
          //go to next tab, without user clicking
          $('#myTab > .active').next().find('> a').trigger('click');
        */
      
      
        $('#accordion-style').on('click', function(ev){
          var target = $('input', ev.target);
          var which = parseInt(target.val());
          if(which == 2) $('#accordion').addClass('accordion-style2');
           else $('#accordion').removeClass('accordion-style2');
        });
        
        //$('[href="#collapseTwo"]').trigger('click');
      
      
        $('.easy-pie-chart.percentage').each(function(){
          $(this).easyPieChart({
            barColor: $(this).data('color'),
            trackColor: '#EEEEEE',
            scaleColor: false,
            lineCap: 'butt',
            lineWidth: 8,
            animate: ace.vars['old_ie'] ? false : 1000,
            size:75
          }).css('color', $(this).data('color'));
        });
      
        $('[data-rel=tooltip]').tooltip();
        $('[data-rel=popover]').popover({html:true});
      
      
        $('#gritter-regular').on(ace.click_event, function(){
          $.gritter.add({
            title: 'This is a regular notice!',
            text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="blue">magnis dis parturient</a> montes, nascetur ridiculus mus.',
            image: 'assets/images/avatars/avatar1.png', //in Ace demo ./dist will be replaced by correct assets path
            sticky: false,
            time: '',
            class_name: (!$('#gritter-light').get(0).checked ? 'gritter-light' : '')
          });
      
          return false;
        });
      
        $('#gritter-sticky').on(ace.click_event, function(){
          var unique_id = $.gritter.add({
            title: 'This is a sticky notice!',
            text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="red">magnis dis parturient</a> montes, nascetur ridiculus mus.',
            image: 'assets/images/avatars/avatar.png',
            sticky: true,
            time: '',
            class_name: 'gritter-info' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
          });
      
          return false;
        });
      
      
        $('#gritter-without-image').on(ace.click_event, function(){
          $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'This is a notice without an image!',
            // (string | mandatory) the text inside the notification
            text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="orange">magnis dis parturient</a> montes, nascetur ridiculus mus.',
            class_name: 'gritter-success' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
          });
      
          return false;
        });
      
      
        $('#gritter-max3').on(ace.click_event, function(){
          $.gritter.add({
            title: 'This is a notice with a max of 3 on screen at one time!',
            text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="green">magnis dis parturient</a> montes, nascetur ridiculus mus.',
            image: 'assets/images/avatars/avatar3.png', //in Ace demo ./dist will be replaced by correct assets path
            sticky: false,
            before_open: function(){
              if($('.gritter-item-wrapper').length >= 3)
              {
                return false;
              }
            },
            class_name: 'gritter-warning' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
          });
      
          return false;
        });
      
      
        $('#gritter-center').on(ace.click_event, function(){
          $.gritter.add({
            title: 'This is a centered notification',
            text: 'Just add a "gritter-center" class_name to your $.gritter.add or globally to $.gritter.options.class_name',
            class_name: 'gritter-info gritter-center' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
          });
      
          return false;
        });
        
        $('#gritter-error').on(ace.click_event, function(){
          $.gritter.add({
            title: 'This is a warning notification',
            text: 'Just add a "gritter-light" class_name to your $.gritter.add or globally to $.gritter.options.class_name',
            class_name: 'gritter-error' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
          });
      
          return false;
        });
          
      
        $("#gritter-remove").on(ace.click_event, function(){
          $.gritter.removeAll();
          return false;
        });
          
      
        ///////
      
      
        $("#bootbox-regular").on(ace.click_event, function() {
          bootbox.prompt("What is your name?", function(result) {
            if (result === null) {
              
            } else {
              
            }
          });
        });
          
        $("#bootbox-confirm").on(ace.click_event, function() {
          bootbox.confirm("Are you sure?", function(result) {
            if(result) {
              //
            }
          });
        });
        
      /**
        $("#bootbox-confirm").on(ace.click_event, function() {
          bootbox.confirm({
            message: "Are you sure?",
            buttons: {
              confirm: {
               label: "OK",
               className: "btn-primary btn-sm",
              },
              cancel: {
               label: "Cancel",
               className: "btn-sm",
              }
            },
            callback: function(result) {
              if(result) alert(1)
            }
            }
          );
        });
      **/
        
      
        $("#bootbox-options").on(ace.click_event, function() {
          bootbox.dialog({
            message: "<span class='bigger-110'>I am a custom dialog with smaller buttons</span>",
            buttons:
            {
              "success" :
               {
                "label" : "<i class='ace-icon fa fa-check'></i> Success!",
                "className" : "btn-sm btn-success",
                "callback": function() {
                  //Example.show("great success");
                }
              },
              "danger" :
              {
                "label" : "Danger!",
                "className" : "btn-sm btn-danger",
                "callback": function() {
                  //Example.show("uh oh, look out!");
                }
              }, 
              "click" :
              {
                "label" : "Click ME!",
                "className" : "btn-sm btn-primary",
                "callback": function() {
                  //Example.show("Primary button");
                }
              }, 
              "button" :
              {
                "label" : "Just a button...",
                "className" : "btn-sm"
              }
            }
          });
        });
      
      
      
        $('#spinner-opts small').css({display:'inline-block', width:'60px'})
      
        var slide_styles = ['', 'green','red','purple','orange', 'dark'];
        var ii = 0;
        $("#spinner-opts input[type=text]").each(function() {
          var $this = $(this);
          $this.hide().after('<span />');
          $this.next().addClass('ui-slider-small').
          addClass("inline ui-slider-"+slide_styles[ii++ % slide_styles.length]).
          css('width','125px').slider({
            value:parseInt($this.val()),
            range: "min",
            animate:true,
            min: parseInt($this.attr('data-min')),
            max: parseInt($this.attr('data-max')),
            step: parseFloat($this.attr('data-step')) || 1,
            slide: function( event, ui ) {
              $this.val(ui.value);
              spinner_update();
            }
          });
        });
      
      
      
        //CSS3 spinner
        $.fn.spin = function(opts) {
          this.each(function() {
            var $this = $(this),
              data = $this.data();
      
            if (data.spinner) {
            data.spinner.stop();
            delete data.spinner;
            }
            if (opts !== false) {
            data.spinner = new Spinner($.extend({color: $this.css('color')}, opts)).spin(this);
            }
          });
          return this;
        };
      
        function spinner_update() {
          var opts = {};
          $('#spinner-opts input[type=text]').each(function() {
            opts[this.name] = parseFloat(this.value);
          });
          opts['left'] = 'auto';
          $('#spinner-preview').spin(opts);
        }
      
      
      
        $('#id-pills-stacked').removeAttr('checked').on('click', function(){
          $('.nav-pills').toggleClass('nav-stacked');
        });
      
        
        
        
        
        
        ///////////
        $(document).one('ajaxloadstart.page', function(e) {
          $.gritter.removeAll();
          $('.modal').modal('hide');
        });
      
      });
    </script>
</body>
</html>