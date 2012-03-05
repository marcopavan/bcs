<?php
	echo base64_encode(file_get_contents($_FILES['file']['tmp_name']));
?>