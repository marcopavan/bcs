<!DOCTYPE html>
<html>
<head>
<title>The New Bottol Creation System</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen, print" />
<link rel="stylesheet" href="js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script type="text/javascript" language="javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$("a.img_fancy").fancybox();
	});
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

<?php 

$id = $_GET['id'];

$conn=mysql_connect($db_host,$db_user,$db_psw) or die ("db_connect error");
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
		<div id="blocks_content">
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
				<div class="block">
					<?php
					switch ($template_id) {
						case 1:
							?>
							<div class="resize small">
							<?php
								switch ($resource_type[0]) {
									case 't':
										?>
										<div class="default_text">
										<?php
										echo $resource[0];
										?>
										</div>
										<?php
										break;
									case 'i':
									if ($resource[0]) {
									?>
										<a class="img_fancy" href="<?php echo $resource[0]; ?>">
											<img class="dropped_img" src="<?php echo $resource[0]; ?>"/>
										</a>
									<?php
									}
										break;
									case 'v':
									if ($resource[0]) {
									?>
										<div class="video content_inserted">
											<iframe src="<?php echo $resource[0]; ?>" frameborder="0" allowfullscreen></iframe>
										</div>
									<?php
									}
										break;
									case 'e':
									if ($resource[0]) {
									?>
										<div class="generic_link content_inserted">
											<div class="embed">
												<?php echo $resource[0]; ?>
											</div>
										</div>
									<?php
									}
										break;
								}
							?>
							</div>
							<div class="fixed"></div>
							<?php
							break;
						case 2:
							?>
							<div class="resize medium">
							<?php
								switch ($resource_type[0]) {
									case 't':
										?>
										<div class="default_text">
										<?php
										echo $resource[0];
										?>
										</div>
										<?php
										break;
									case 'i':
									if ($resource[0]) {
									?>
										<a class="img_fancy" href="<?php echo $resource[0]; ?>">
											<img class="dropped_img" src="<?php echo $resource[0]; ?>"/>
										</a>
									<?php
									}
										break;
									case 'v':
									if ($resource[0]) {
									?>
										<div class="video content_inserted">
											<iframe src="<?php echo $resource[0]; ?>" frameborder="0" allowfullscreen></iframe>
										</div>
									<?php
									}
										break;
									case 'e':
									if ($resource[0]) {
									?>
										<div class="generic_link content_inserted">
											<div class="embed">
												<?php echo $resource[0]; ?>
											</div>
										</div>
									<?php
									}
										break;
								}
							?>
							</div>
							<div class="fixed"></div>
							<?php
							break;
						case 3:
							?>
							<div class="resize large">
							<?php
								switch ($resource_type[0]) {
									case 't':
										?>
										<div class="default_text">
										<?php
										echo $resource[0];
										?>
										</div>
										<?php
										break;
									case 'i':
									if ($resource[0]) {
									?>
										<a class="img_fancy" href="<?php echo $resource[0]; ?>">
											<img class="dropped_img" src="<?php echo $resource[0]; ?>"/>
										</a>
									<?php
									}
										break;
									case 'v':
									if ($resource[0]) {
									?>
										<div class="video content_inserted">
											<iframe src="<?php echo $resource[0]; ?>" frameborder="0" allowfullscreen></iframe>
										</div>
									<?php
									}
										break;
									case 'e':
									if ($resource[0]) {
									?>
										<div class="generic_link content_inserted">
											<div class="embed">
												<?php echo $resource[0]; ?>
											</div>
										</div>
									<?php
									}
										break;
								}
							?>
							</div>
							<div class="fixed"></div>
							<?php
							break;
						case 4:
							?>
							<div class="resize largest">
							<?php
								switch ($resource_type[0]) {
									case 't':
										?>
										<div class="default_text">
										<?php
										echo $resource[0];
										?>
										</div>
										<?php
										break;
									case 'i':
									if ($resource[0]) {
									?>
										<a class="img_fancy" href="<?php echo $resource[0]; ?>">
											<img class="dropped_img" src="<?php echo $resource[0]; ?>"/>
										</a>
									<?php
									}
										break;
									case 'v':
									if ($resource[0]) {
									?>
										<div class="video content_inserted">
											<iframe src="<?php echo $resource[0]; ?>" frameborder="0" allowfullscreen></iframe>
										</div>
									<?php
									}
										break;
									case 'e':
									if ($resource[0]) {
									?>
										<div class="generic_link content_inserted">
											<div class="embed">
												<?php echo $resource[0]; ?>
											</div>
										</div>
									<?php
									}
										break;
									case 'w':
									if ($resource[0]) {
									?>
										<div class="webPage content_inserted" style="height: 600px;">
											<iframe src="<?php echo $resource[0]; ?>" frameborder="0"></iframe>
										</div>
									<?php
									}
										break;
									case 'd':
									if ($resource[0]) {
									?>
										<iframe src="http://docs.google.com/gview?url=<?php echo $resource[0]; ?>" frameborder="0" id="document_frame" style="height: 600px; width: 100%;"></iframe>
									<?php
									}
										break;
								}
							?>
							</div>
							<div class="fixed"></div>
							<?php
							break;
						case 5:
							?>
							<div class="medium">
								<?php
								$key = array_search(1,$resource_position);
									switch ($resource_type[$key]) {
										case 't':
											?>
											<div class="default_text">
											<?php
											echo $resource[$key];
											?>
											</div>
											<?php
											break;
										case 'i':
										if ($resource[$key]) {
										?>
											<a class="img_fancy" href="<?php echo $resource[$key]; ?>">
												<img class="dropped_img" src="<?php echo $resource[$key]; ?>"/>
											</a>
										<?php
										}
											break;
										case 'v':
										if ($resource[$key]) {
										?>
											<div class="video content_inserted">
												<iframe src="<?php echo $resource[$key]; ?>" frameborder="0" allowfullscreen></iframe>
											</div>
										<?php
										}
											break;
										case 'e':
										if ($resource[$key]) {
										?>
											<div class="generic_link content_inserted">
												<div class="embed">
													<?php echo $resource[$key]; ?>
												</div>
											</div>
										<?php
										}
											break;
									}
								?>
							</div>
							<div class="medium">
								<?php
								$key = array_search(2,$resource_position);
									switch ($resource_type[$key]) {
										case 't':
											?>
											<div class="default_text">
											<?php
											echo $resource[$key];
											?>
											</div>
											<?php
											break;
										case 'i':
										if ($resource[$key]) {
										?>
											<a class="img_fancy" href="<?php echo $resource[$key]; ?>">
												<img class="dropped_img" src="<?php echo $resource[$key]; ?>"/>
											</a>
										<?php
										}
											break;
										case 'v':
										if ($resource[$key]) {
										?>
											<div class="video content_inserted">
												<iframe src="<?php echo $resource[$key]; ?>" frameborder="0" allowfullscreen></iframe>
											</div>
										<?php
										}
											break;
										case 'e':
										if ($resource[$key]) {
										?>
											<div class="generic_link content_inserted">
												<div class="embed">
													<?php echo $resource[$key]; ?>
												</div>
											</div>
										<?php
										}
											break;
									}
								?>
							</div>
							<div class="fixed"></div>
							<?php
							break;
						case 6:
							?>
							<div class="small">
								<?php
								$key = array_search(1,$resource_position);
									switch ($resource_type[$key]) {
										case 't':
											?>
											<div class="default_text">
											<?php
											echo $resource[$key];
											?>
											</div>
											<?php
											break;
										case 'i':
										if ($resource[$key]) {
										?>
											<a class="img_fancy" href="<?php echo $resource[$key]; ?>">
												<img class="dropped_img" src="<?php echo $resource[$key]; ?>"/>
											</a>
										<?php
										}
											break;
										case 'v':
										if ($resource[$key]) {
										?>
											<div class="video content_inserted">
												<iframe src="<?php echo $resource[$key]; ?>" frameborder="0" allowfullscreen></iframe>
											</div>
										<?php
										}
											break;
										case 'e':
										if ($resource[$key]) {
										?>
											<div class="generic_link content_inserted">
												<div class="embed">
													<?php echo $resource[$key]; ?>
												</div>
											</div>
										<?php
										}
											break;
									}
								?>
							</div>
							<div class="small">
								<?php
								$key = array_search(2,$resource_position);
									switch ($resource_type[$key]) {
										case 't':
											?>
											<div class="default_text">
											<?php
											echo $resource[$key];
											?>
											</div>
											<?php
											break;
										case 'i':
										if ($resource[$key]) {
										?>
											<a class="img_fancy" href="<?php echo $resource[$key]; ?>">
												<img class="dropped_img" src="<?php echo $resource[$key]; ?>"/>
											</a>
										<?php
										}
											break;
										case 'v':
										if ($resource[$key]) {
										?>
											<div class="video content_inserted">
												<iframe src="<?php echo $resource[$key]; ?>" frameborder="0" allowfullscreen></iframe>
											</div>
										<?php
										}
											break;
										case 'e':
										if ($resource[$key]) {
										?>
											<div class="generic_link content_inserted">
												<div class="embed">
													<?php echo $resource[$key]; ?>
												</div>
											</div>
										<?php
										}
											break;
									}
								?>
							</div>
							<div class="small">
								<?php
								$key = array_search(3,$resource_position);
									switch ($resource_type[$key]) {
										case 't':
											?>
											<div class="default_text">
											<?php
											echo $resource[$key];
											?>
											</div>
											<?php
											break;
										case 'i':
										if ($resource[$key]) {
										?>
											<a class="img_fancy" href="<?php echo $resource[$key]; ?>">
												<img class="dropped_img" src="<?php echo $resource[$key]; ?>"/>
											</a>
										<?php
										}
											break;
										case 'v':
										if ($resource[$key]) {
										?>
											<div class="video content_inserted">
												<iframe src="<?php echo $resource[$key]; ?>" frameborder="0" allowfullscreen></iframe>
											</div>
										<?php
										}
											break;
										case 'e':
										if ($resource[$key]) {
										?>
											<div class="generic_link content_inserted">
												<div class="embed">
													<?php echo $resource[$key]; ?>
												</div>
											</div>
										<?php
										}
											break;
									}
								?>
							</div>
							<div class="fixed"></div>
							<?php
							break;
						case 7:
							?>
							<div class="small">
								<?php
								$key = array_search(1,$resource_position);
									switch ($resource_type[$key]) {
										case 't':
											?>
											<div class="default_text">
											<?php
											echo $resource[$key];
											?>
											</div>
											<?php
											break;
										case 'i':
										if ($resource[$key]) {
										?>
											<a class="img_fancy" href="<?php echo $resource[$key]; ?>">
												<img class="dropped_img" src="<?php echo $resource[$key]; ?>"/>
											</a>
										<?php
										}
											break;
										case 'v':
										if ($resource[$key]) {
										?>
											<div class="video content_inserted">
												<iframe src="<?php echo $resource[$key]; ?>" frameborder="0" allowfullscreen></iframe>
											</div>
										<?php
										}
											break;
										case 'e':
										if ($resource[$key]) {
										?>
											<div class="generic_link content_inserted">
												<div class="embed">
													<?php echo $resource[$key]; ?>
												</div>
											</div>
										<?php
										}
											break;
									}
								?>
							</div>
							<div class="large">
								<?php
								$key = array_search(2,$resource_position);
									switch ($resource_type[$key]) {
										case 't':
											?>
											<div class="default_text">
											<?php
											echo $resource[$key];
											?>
											</div>
											<?php
											break;
										case 'i':
										if ($resource[$key]) {
										?>
											<a class="img_fancy" href="<?php echo $resource[$key]; ?>">
												<img class="dropped_img" src="<?php echo $resource[$key]; ?>"/>
											</a>
										<?php
										}
											break;
										case 'v':
										if ($resource[$key]) {
										?>
											<div class="video content_inserted">
												<iframe src="<?php echo $resource[$key]; ?>" frameborder="0" allowfullscreen></iframe>
											</div>
										<?php
										}
											break;
										case 'e':
										if ($resource[$key]) {
										?>
											<div class="generic_link content_inserted">
												<div class="embed">
													<?php echo $resource[$key]; ?>
												</div>
											</div>
										<?php
										}
											break;
									}
								?>
							</div>
							<div class="fixed"></div>
							<?php
							break;
						case 8:
							?>
							<div class="large">
								<?php
								$key = array_search(1,$resource_position);
									switch ($resource_type[$key]) {
										case 't':
											?>
											<div class="default_text">
											<?php
											echo $resource[$key];
											?>
											</div>
											<?php
											break;
										case 'i':
										if ($resource[$key]) {
										?>
											<a class="img_fancy" href="<?php echo $resource[$key]; ?>">
												<img class="dropped_img" src="<?php echo $resource[$key]; ?>"/>
											</a>
										<?php
										}
											break;
										case 'v':
										if ($resource[$key]) {
										?>
											<div class="video content_inserted">
												<iframe src="<?php echo $resource[$key]; ?>" frameborder="0" allowfullscreen></iframe>
											</div>
										<?php
										}
											break;
										case 'e':
										if ($resource[$key]) {
										?>
											<div class="generic_link content_inserted">
												<div class="embed">
													<?php echo $resource[$key]; ?>
												</div>
											</div>
										<?php
										}
											break;
									}
								?>
							</div>
							<div class="small">
								<?php
								$key = array_search(2,$resource_position);
									switch ($resource_type[$key]) {
										case 't':
											?>
											<div class="default_text">
											<?php
											echo $resource[$key];
											?>
											</div>
											<?php
											break;
										case 'i':
										if ($resource[$key]) {
										?>
											<a class="img_fancy" href="<?php echo $resource[$key]; ?>">
												<img class="dropped_img" src="<?php echo $resource[$key]; ?>"/>
											</a>
										<?php
										}
											break;
										case 'v':
										if ($resource[$key]) {
										?>
											<div class="video content_inserted">
												<iframe src="<?php echo $resource[$key]; ?>" frameborder="0" allowfullscreen></iframe>
											</div>
										<?php
										}
											break;
										case 'e':
										if ($resource[$key]) {
										?>
											<div class="generic_link content_inserted">
												<div class="embed">
													<?php echo $resource[$key]; ?>
												</div>
											</div>
										<?php
										}
											break;
									}
								?>
							</div>
							<div class="fixed"></div>
							<?php
							break;
					}
					?>
				</div>
			<?php
		}
		?>
	</div>

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