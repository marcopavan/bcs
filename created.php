<!DOCTYPE html>
<html>
<head>
<title>The New Bottol Creation System</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen, print" />
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
				$query= mysql_query($var, $conn) or die ("db_query error");
				while ($values=mysql_fetch_array($query)) {
					$id=$values["topic_id"];
					$titolo=$values["topic_title"];
				?>	

				<tr id="<?php echo $id; ?>">
					<td><?php echo $id; ?></td>
					<td><a href="http://<?php echo $db_domain; ?>/show.php?id=<?php echo $id; ?>"><?php echo $titolo; ?></a></td>
					<td><input type="button" id="remove_button" value="Remove" onclick="removeBottol(<?php echo $id; ?>);"/></td>
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