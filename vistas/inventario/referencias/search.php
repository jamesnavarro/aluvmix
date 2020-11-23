<?php
if (isset($_GET['term'])){
define('DB_SERVER', 'localhost');
define('DB_USER', 'virtuald_templad');
define('DB_PASSWORD', '20031123003');
define('DB_NAME', 'aluvmix');
	$return_arr = array();
	try {
	    $conn = new PDO("mysql:host=".DB_SERVER.";port=3306;dbname=".DB_NAME, DB_USER, DB_PASSWORD);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    
	    $stmt = $conn->prepare('SELECT pro_referencia FROM productos WHERE pro_referencia LIKE :term');
	    $stmt->execute(array('term' => '%'.$_GET['term'].'%'));
	    
	    while($row = $stmt->fetch()) {
	        $return_arr[] =  $row['pro_referencia'];
	    }

	} catch(PDOException $e) {
	    echo 'ERROR: ' . $e->getMessage();
	}


    /* Toss back results as json encoded array. */
    echo json_encode($return_arr);
}
if (isset($_POST['ref'])) {
	include '../../../modelo/conexioni.php';
	$sql =mysqli_query($con,"SELECT * FROM productos WHERE pro_referencia='".$_POST['ref']."'");
	while($fila=mysqli_fetch_array($sql)){
		$data = array("sucess" => '1',"nom" =>$fila["pro_nombre"],"und" =>$fila["pro_undmed"],"clas" =>$fila["clase"],"grup" =>$fila["grupo"],"lin" =>$fila["linea"],"ruta" => $fila["ruta_img"],"sistema" => $fila["sistema"]);
        echo json_encode($data);
	}
}

if (isset($_POST['refx'])) {
	include '../../../modelo/conexioni.php';
	$sql =mysqli_query($con,"SELECT * FROM productos_var WHERE codigo='".$_POST['ref']."'");
	while($fila=mysqli_fetch_array($sql)){
		$data = array("sucess" => '1',"nom" =>$fila["pro_nombre"],"und" =>$fila["pro_undmed"],"clas" =>$fila["clase"],"grup" =>$fila["grupo"],"lin" =>$fila["linea"]);
        echo json_encode($data);
	}
}

?>