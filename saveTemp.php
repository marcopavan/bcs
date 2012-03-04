<?php
	include('db_config.php');
	$name = $_POST['name'];
	
	while(file_exists('tmp/'.$name))
		$name = rand().$name;
	
	move_uploaded_file($_FILES['file']['tmp_name'], 'tmp/'.$name);

	echo 'http://'.$db_domain.'/tmp/'.$name;
?>