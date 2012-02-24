<?php
	$name = $_POST['name'];
	$base64 = $_POST['base64'];

	while(file_exists($name))
		$name = rand().$name;
	
	file_put_contents($name, base64_decode($base64));

	echo 'http://'.$_SERVER['SERVER_NAME'].str_replace('saveTemp.php', '', $_SERVER['PHP_SELF']).$name;
?>