<!DOCTYPE html>
<html>
<head>
<title>The New Bottol Creation System</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen, print" />
<script type="text/javascript" language="javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript">
	function removeBottol(id) {
		$('#'+id).remove();
		$.post("remove.php", { id: id});

   	}
</script>
</head>

<body>

<?php
include('db_config.php');

// scrivo nel db tutti i dati della bottiglia e al sua struttura
if(isset($_POST['submit_bottol'])) {

	$topic_title=$_POST['topic_title'];
	$topic_subtitle=$_POST['topic_subtitle'];

	$conn=mysql_connect($db_host,$db_user,$db_psw) or die ("db_connect error");
	$var="INSERT INTO sharabelcom.wp_bb_topics (topic_title,topic_subtitle) VALUES ('$topic_title','$topic_subtitle')";
	$query= mysql_query($var, $conn) or die ("db_query error 1");

	$var="SELECT topic_id FROM sharabelcom.wp_bb_topics ORDER BY topic_id DESC LIMIT 1";
	$query= mysql_query($var, $conn) or die ("db_query error 2");
	while ($values=mysql_fetch_array($query)) {
		$topic_id=$values['topic_id'];
	}

	for ($i=1; $i<=10 ; $i++) {
		if(!$_POST['element'.$i.'_component_position']) {
			break;
		}
		$component_position=$_POST['element'.$i.'_component_position'];
		$template_id=$_POST['element'.$i.'_template_id'];
		$resource_position=$_POST['element'.$i.'_resource_position'];
		$resource_type=$_POST['element'.$i.'_resource_type'];
		$resource=addslashes($_POST['element'.$i.'_resource']);

		$conn=mysql_connect($db_host,$db_user,$db_psw) or die ("db_connect error");
		$var="INSERT INTO sharabelcom.topic_component_resources (topic_id,component_position,template_id,resource_position,resource_type,resource) VALUES ('$topic_id','$component_position','$template_id','$resource_position','$resource_type','$resource')";
		$query= mysql_query($var, $conn) or die ("db_query error 3-".$i);
	}
}

// fine scrittura sul db

?>

<div id="giveusfeedback-side">
	<span><a href="#"></a></span>
</div>

<div id="header">
	<img src="img/fakeadminbar.png" alt="">
	<a id="adminbar_new" href="<?php echo 'http://'.$db_domain; ?>" title="Created A New Bottol"></a>
	<a id="adminbar_created" href="<?php echo 'http://'.$db_domain.'/created.php'; ?>" title="Createed Bottols"></a>
</div>
<div id="container">
	<div id="content">
		<h2 class="pagetitle">Created Bottols</h2>
		
		<!-- tabella con tutte le bottiglie create -->

		<table id="createdbottols">
			<thead>
				<tr>
					<th id="bottolid">ID</th>
					<th id="bottoltitle">Title</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$conn=mysql_connect($db_host,$db_user,$db_psw) or die ("db_connect error");
				$var="SELECT * FROM sharabelcom.wp_bb_topics";
				$query= mysql_query($var, $conn) or die ("db_query error 4");
				while ($values=mysql_fetch_array($query)) {
					$id=$values["topic_id"];
					$titolo=$values["topic_title"];
				?>	

				<tr id="<?php echo $id; ?>">
					<td><?php echo $id; ?></td>
					<td><a href="http://<?php echo $db_domain; ?>/show.php?id=<?php echo $id; ?>"><?php echo $titolo; ?></a></td>
					<td><input type="button" class="remove_button" value="Remove" onclick="removeBottol(<?php echo $id; ?>);"/></td>
				</tr>

				<?php } ?>
				
			</tbody>
		</table>

		<!-- fine tabella -->

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