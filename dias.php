<?php
 $fecha_i = '01/08/2018';
 $fecha_f = '30/08/2018';
    $begin = new DateTime($fecha_i);
    $end = new DateTime($fecha_f);
    $end = $end->modify( '+1 day' );
    $interval = new DateInterval('P1D');
    $daterange = new DatePeriod($begin, $interval ,$end);

    foreach($daterange as $date){

    if(date('l', strtotime($date->format("d-m-Y"))) == 'Sunday' || date('l', strtotime($date->format("d-m-Y"))) == 'Saturday'){
        print 'Fin de Semana: '.$date->format("d-m-Y")."<br>";
    } else {
        print 'Semana: '.$date->format("d-m-Y")."<br>"; 
    }
}

