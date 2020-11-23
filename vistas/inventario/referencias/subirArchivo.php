<?php
	if ( 0 < $_FILES['file']['error'] ) 
	{
		echo 'Error: ' . $_FILES['file']['error'] . '<br>';
	}
	else
	{
		move_uploaded_file($_FILES['file']['tmp_name'], '../product_images/' . $_FILES['file']['name']);
		echo "¡¡El archivo se ha subido correctamente!!";
	}
?>