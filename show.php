<!DOCTYPE html>
<html>
<head>
<title>The New Bottol Creation System</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen, print" />
</head>

<body>

<div id="giveusfeedback-side">
	<span><a href="#"></a></span>
</div>

<div id="header">
	<img src="img/fakeadminbar.png" alt="">
</div>

<?php 

$id = $_GET['id'];

$conn=mysql_connect('localhost','root','root') or die ("db_connect error");
$var="SELECT topic_title FROM sharabelcom.wp_bb_topics WHERE topic_id='$id'";
$query= mysql_query($var, $conn) or die ("db_query error");
while ($values=mysql_fetch_array($query)) {
	$titolo=$values["topic_title"];
}
?>

<div id="container">
	<div id="content">
		<div id="bottoltitle-wrapper">
			<h2 class="bottoltitle"><?php echo $titolo; ?></h2>
		</div>
		
		<!-- contenuto bottiglia -->

		<?php 

		for ($i=1; $i<=10 ; $i++) { 

			$var="SELECT * FROM sharabelcom.topic_component_resources WHERE topic_id='$id' AND component_position='$i'";
			$query= mysql_query($var, $conn) or die ("db_query error");
			if(mysql_num_rows($query)==0){
				break;
			}
			while ($values=mysql_fetch_array($query)) {
				$template_id=$values["template_id"];
				$resource_position=$values["resource_position"];
				$resource_type=$values["resource_type"];
				$resource=$values["resource"];
				echo $template_id.' - '.$resource_position.' - '.$resource_type.'<br/>';
			}
		}
		?>


		<!-- fine bottiglia -->

	</div>
	<div id="sidebar">
		<div id="box1" class="sidebox">
			<p>You have created</p>
			<p class="sidemetrics">1</p>
			<p>Bottols so far</p>
		</div>
		<div id="box2" class="sidebox">
			<p>You have</p>
			<p class="sidemetrics">49</p>
			<p>new Bottols remaining</p>
		</div>
	</div>
</div>
<div id="footer">
	<p id="footlinks">
	    <a href="#">How It Works</a> <span>&bull;</span>
	    <a href="#">Blog</a> <span>&bull;</span>
	    <a href="#">FAQ</a> <span>&bull;</span>
	    <a href="#">Contact Us</a> <span>&bull;</span>
	    <a href="#">About</a> <span>&bull;</span>
	    <a href="#">Terms</a> <span>&bull;</span>
	    <a href="#">Privacy</a>
	</p>
	<p id="copyright">&copy; 2012 bottol.com - All Rights Reserved.</p>
</div>

</body>

</html>