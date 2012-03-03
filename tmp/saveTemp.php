<?php
	$name = $_POST['name'];
	
	while(file_exists($name))
		$name = rand().$name;
	
	move_uploaded_file($_FILES['file']['tmp_name'], $name);

	echo 'http://'.$_SERVER['SERVER_NAME'].str_replace('saveTemp.php', '', $_SERVER['PHP_SELF']).$name;
?>