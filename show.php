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

			$template_id=0;
			$resource_position=array();
			$resource_type=array();
			$resource=array();

			while ($values=mysql_fetch_array($query)) {
				$template_id=$values["template_id"];
				$resource_position[].=$values["resource_position"];
				$resource_type[].=$values["resource_type"];
				$resource[].=$values["resource"];
			}
			?>
			<div id="blocks_content">
				<div class="block">
					<?php
					switch ($template_id) {
						case 1:
							?>
							<div class="largest">
								<?php echo $resource[0]; ?>
							</div>
							<?php
							break;
						case 2:
							?>
							<div class="largest">
								<img class="dropped_img" src="<?php echo $resource[0]; ?>"/>
							</div>
							<?php
							break;
						case 3:
							?>
							<div class="largest">
								<div class="video">
									<iframe src="<?php echo $resource[0]; ?>" frameborder="0" allowfullscreen></iframe>
								</div>
							</div>
							<?php
							break;
						case 4:
							?>
							<div class="largest">
								<div class="generic_link">
									<div class="embed">
										<?php echo $resource[0]; ?>
									</div>
								</div>
							</div>
							<?php
							break;
						case 5:
							?>
							<div class="largest">
								<div class="webPage" style="height: 600px;">
									<iframe src="<?php echo $resource[0]; ?>" frameborder="0"></iframe>
								</div>
							</div>
							<?php
							break;
						case 6:
							?>
							<div class="largest">
								<iframe src="<?php echo $resource[0]; ?>" frameborder="0" id="document_frame" style="height: 600px; width: 100%;"></iframe>
							</div>
							<?php
							break;
						case 7:
							?>
							<div class="medium">
								<?php
								$key = array_search(1,$resource_position);
									switch ($resource_type[$key]) {
										case 't':
											echo $resource[$key];
											break;
										case 'i':
										?>
											<img class="dropped_img" src="<?php echo $resource[$key]; ?>"/>
										<?php
											break;
										case 'v':
										?>
											<div class="video">
												<iframe src="<?php echo $resource[$key]; ?>" frameborder="0" allowfullscreen></iframe>
											</div>
										<?php
											break;
										case 'e':
										?>
											<div class="generic_link">
												<div class="embed">
													<?php echo $resource[$key]; ?>
												</div>
											</div>
										<?php
											break;
									}
								?>
							</div>
							<div class="medium">
								<?php
								$key = array_search(2,$resource_position);
									switch ($resource_type[$key]) {
										case 't':
											echo $resource[$key];
											break;
										case 'i':
										?>
											<img class="dropped_img" src="<?php echo $resource[$key]; ?>"/>
										<?php
											break;
										case 'v':
										?>
											<div class="video">
												<iframe src="<?php echo $resource[$key]; ?>" frameborder="0" allowfullscreen></iframe>
											</div>
										<?php
											break;
										case 'e':
										?>
											<div class="generic_link">
												<div class="embed">
													<?php echo $resource[$key]; ?>
												</div>
											</div>
										<?php
											break;
									}
								?>
							</div>
							<?php
							break;
						case 8:
							?>
							<div class="small">
								<?php
								$key = array_search(1,$resource_position);
									switch ($resource_type[$key]) {
										case 't':
											echo $resource[$key];
											break;
										case 'i':
										?>
											<img class="dropped_img" src="<?php echo $resource[$key]; ?>"/>
										<?php
											break;
										case 'v':
										?>
											<div class="video">
												<iframe src="<?php echo $resource[$key]; ?>" frameborder="0" allowfullscreen></iframe>
											</div>
										<?php
											break;
										case 'e':
										?>
											<div class="generic_link">
												<div class="embed">
													<?php echo $resource[$key]; ?>
												</div>
											</div>
										<?php
											break;
									}
								?>
							</div>
							<div class="small">
								<?php
								$key = array_search(2,$resource_position);
									switch ($resource_type[$key]) {
										case 't':
											echo $resource[$key];
											break;
										case 'i':
										?>
											<img class="dropped_img" src="<?php echo $resource[$key]; ?>"/>
										<?php
											break;
										case 'v':
										?>
											<div class="video">
												<iframe src="<?php echo $resource[$key]; ?>" frameborder="0" allowfullscreen></iframe>
											</div>
										<?php
											break;
										case 'e':
										?>
											<div class="generic_link">
												<div class="embed">
													<?php echo $resource[$key]; ?>
												</div>
											</div>
										<?php
											break;
									}
								?>
							</div>
							<div class="small">
								<?php
								$key = array_search(3,$resource_position);
									switch ($resource_type[$key]) {
										case 't':
											echo $resource[$key];
											break;
										case 'i':
										?>
											<img class="dropped_img" src="<?php echo $resource[$key]; ?>"/>
										<?php
											break;
										case 'v':
										?>
											<div class="video">
												<iframe src="<?php echo $resource[$key]; ?>" frameborder="0" allowfullscreen></iframe>
											</div>
										<?php
											break;
										case 'e':
										?>
											<div class="generic_link">
												<div class="embed">
													<?php echo $resource[$key]; ?>
												</div>
											</div>
										<?php
											break;
									}
								?>
							</div>
							<?php
							break;
						case 9:
							?>
							<div class="small">
								<?php
								$key = array_search(1,$resource_position);
									switch ($resource_type[$key]) {
										case 't':
											echo $resource[$key];
											break;
										case 'i':
										?>
											<img class="dropped_img" src="<?php echo $resource[$key]; ?>"/>
										<?php
											break;
										case 'v':
										?>
											<div class="video">
												<iframe src="<?php echo $resource[$key]; ?>" frameborder="0" allowfullscreen></iframe>
											</div>
										<?php
											break;
										case 'e':
										?>
											<div class="generic_link">
												<div class="embed">
													<?php echo $resource[$key]; ?>
												</div>
											</div>
										<?php
											break;
									}
								?>
							</div>
							<div class="large">
								<?php
								$key = array_search(2,$resource_position);
									switch ($resource_type[$key]) {
										case 't':
											echo $resource[$key];
											break;
										case 'i':
										?>
											<img class="dropped_img" src="<?php echo $resource[$key]; ?>"/>
										<?php
											break;
										case 'v':
										?>
											<div class="video">
												<iframe src="<?php echo $resource[$key]; ?>" frameborder="0" allowfullscreen></iframe>
											</div>
										<?php
											break;
										case 'e':
										?>
											<div class="generic_link">
												<div class="embed">
													<?php echo $resource[$key]; ?>
												</div>
											</div>
										<?php
											break;
									}
								?>
							</div>
							<?php
							break;
						case 10:
							?>
							<div class="large">
								<?php
								$key = array_search(1,$resource_position);
									switch ($resource_type[$key]) {
										case 't':
											echo $resource[$key];
											break;
										case 'i':
										?>
											<img class="dropped_img" src="<?php echo $resource[$key]; ?>"/>
										<?php
											break;
										case 'v':
										?>
											<div class="video">
												<iframe src="<?php echo $resource[$key]; ?>" frameborder="0" allowfullscreen></iframe>
											</div>
										<?php
											break;
										case 'e':
										?>
											<div class="generic_link">
												<div class="embed">
													<?php echo $resource[$key]; ?>
												</div>
											</div>
										<?php
											break;
									}
								?>
							</div>
							<div class="small">
								<?php
								$key = array_search(2,$resource_position);
									switch ($resource_type[$key]) {
										case 't':
											echo $resource[$key];
											break;
										case 'i':
										?>
											<img class="dropped_img" src="<?php echo $resource[$key]; ?>"/>
										<?php
											break;
										case 'v':
										?>
											<div class="video">
												<iframe src="<?php echo $resource[$key]; ?>" frameborder="0" allowfullscreen></iframe>
											</div>
										<?php
											break;
										case 'e':
										?>
											<div class="generic_link">
												<div class="embed">
													<?php echo $resource[$key]; ?>
												</div>
											</div>
										<?php
											break;
									}
								?>
							</div>
							<?php
							break;
					}
					?>
				</div>
			</div>
			<?php
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