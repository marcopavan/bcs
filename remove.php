<?php
include('db_config.php');
$id = $_POST['id'];
$conn=mysql_connect($db_host,$db_user,$db_psw) or die ("db_connect error");
$var="DELETE FROM sharabelcom.wp_bb_topics WHERE topic_id='$id'";
$query= mysql_query($var, $conn) or die ("db_query error");
$var="DELETE FROM sharabelcom.topic_component_resources WHERE topic_id='$id'";
$query= mysql_query($var, $conn) or die ("db_query error");
?>