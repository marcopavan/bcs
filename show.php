<?php
function format_bytes($a_bytes) {
    if ($a_bytes < 1024) {
        return $a_bytes .' B';
    } elseif ($a_bytes < 1048576) {
        return round($a_bytes / 1024, 2) .' KB';
    } elseif ($a_bytes < 1073741824) {
        return round($a_bytes / 1048576, 2) . ' MB';
    } elseif ($a_bytes < 1099511627776) {
        return round($a_bytes / 1073741824, 2) . ' GB';
    } elseif ($a_bytes < 1125899906842624) {
        return round($a_bytes / 1099511627776, 2) .' TB';
    } elseif ($a_bytes < 1152921504606846976) {
        return round($a_bytes / 1125899906842624, 2) .' PB';
    } elseif ($a_bytes < 1180591620717411303424) {
        return round($a_bytes / 1152921504606846976, 2) .' EB';
    } elseif ($a_bytes < 1208925819614629174706176) {
        return round($a_bytes / 1180591620717411303424, 2) .' ZB';
    } else {
        return round($a_bytes / 1208925819614629174706176, 2) .' YB';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>The New Bottol Creation System</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen, print" />
<link rel="stylesheet" href="js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script type="text/javascript" language="javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="js/audio_player.js"></script>

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
				<div class="block" style="min-height: 0px;">
					<?php
					switch ($template_id) {
						case 1:
							?>
							<div class="resize small" style="min-height: 0px;">
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
									case 'a':
									if ($resource[0]) {
										$musicname=explode("/", $resource[0]);
									?>
										<div class="audio">
											<div class="dropped_div">
											<p class="player" rel="<?php echo $i.$resource_position[0]; ?>">
												<span class="playtoggle"></span>
												<span class="song_name"><?php echo $musicname[5]; ?></span>
												<span class="gutter">
													<span class="loading"></span>
													<span class="handle" class="ui-slider-handle"></span>
												</span>
												<span class="timeleft"></span>
												<audio>
													<source src="<?php echo $resource[0]; ?>" type="audio/mp3"></source>
											    </audio>
											</p>
											</div>
										</div>
									<?php
									}
										break;
									case 'f':
									if ($resource[0]) {
										$filename=explode("/", $resource[0]);
										$ext= explode(".",$resource[0]);
									?>
										<div class="file content_inserted">
											<div class="dropped_div">
												<div class="attachment_info">
													<a href="<?php echo $resource[0]?>">
														<span class="extension"><?php echo end($ext); ?></span>
														<img class="file_icon" src="img/file_icon_lightblue.png"/>
													</a>
												</div>
												<p><strong><?php echo $filename[5]; ?></strong> - <?php echo format_bytes(filesize("tmp/".$filename[5])) ?></p>
											</div>
										</div>
									<?php
									}
								}
							?>
							</div>
							<div class="fixed"></div>
							<?php
							break;
						case 2:
							?>
							<div class="resize medium" style="min-height: 0px;">
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
									case 'a':
									if ($resource[0]) {
										$musicname=explode("/", $resource[0]);
									?>
										<div class="audio">
											<div class="dropped_div">
											<p class="player" rel="<?php echo $i.$resource_position[0]; ?>">
												<span class="playtoggle"></span>
												<span class="song_name"><?php echo $musicname[5]; ?></span>
												<span class="gutter">
													<span class="loading"></span>
													<span class="handle" class="ui-slider-handle"></span>
												</span>
												<span class="timeleft"></span>
												<audio>
													<source src="<?php echo $resource[0]; ?>" type="audio/mp3"></source>
											    </audio>
											</p>
											</div>
										</div>
									<?php
									}
										break;
									case 'f':
									if ($resource[0]) {
										$filename=explode("/", $resource[0]);
										$ext= explode(".",$resource[0]);
									?>
										<div class="file content_inserted">
											<div class="dropped_div">
												<div class="attachment_info">
													<a href="<?php echo $resource[0]?>">
														<span class="extension"><?php echo end($ext); ?></span>
														<img class="file_icon" src="img/file_icon_lightblue.png"/>
													</a>
												</div>
												<p><strong><?php echo $filename[5]; ?></strong> - <?php echo format_bytes(filesize("tmp/".$filename[5])) ?></p>
											</div>
										</div>
									<?php
									}	
								}
							?>
							</div>
							<div class="fixed"></div>
							<?php
							break;
						case 3:
							?>
							<div class="resize large" style="min-height: 0px;">
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
									case 'a':
									if ($resource[0]) {
										$musicname=explode("/", $resource[0]);
									?>
										<div class="audio">
											<div class="dropped_div">
											<p class="player" rel="<?php echo $i.$resource_position[0]; ?>">
												<span class="playtoggle"></span>
												<span class="song_name"><?php echo $musicname[5]; ?></span>
												<span class="gutter">
													<span class="loading"></span>
													<span class="handle" class="ui-slider-handle"></span>
												</span>
												<span class="timeleft"></span>
												<audio>
													<source src="<?php echo $resource[0]; ?>" type="audio/mp3"></source>
											    </audio>
											</p>
											</div>
										</div>
									<?php
									}
										break;
									case 'f':
									if ($resource[0]) {
										$filename=explode("/", $resource[0]);
										$ext= explode(".",$resource[0]);
									?>
										<div class="file content_inserted">
											<div class="dropped_div">
												<div class="attachment_info">
													<a href="<?php echo $resource[0]?>">
														<span class="extension"><?php echo end($ext); ?></span>
														<img class="file_icon" src="img/file_icon_lightblue.png"/>
													</a>
												</div>
												<p><strong><?php echo $filename[5]; ?></strong> - <?php echo format_bytes(filesize("tmp/".$filename[5])) ?></p>
											</div>
										</div>
									<?php
									}
								}
							?>
							</div>
							<div class="fixed"></div>
							<?php
							break;
						case 4:
							?>
							<div class="resize largest" style="min-height: 0px;">
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
									case 'a':
									if ($resource[0]) {
										$musicname=explode("/", $resource[0]);
									?>
										<div class="audio">
											<div class="dropped_div">
											<p class="player" rel="<?php echo $i.$resource_position[0]; ?>">
												<span class="playtoggle"></span>
												<span class="song_name"><?php echo $musicname[5]; ?></span>
												<span class="gutter">
													<span class="loading"></span>
													<span class="handle" class="ui-slider-handle"></span>
												</span>
												<span class="timeleft"></span>
												<audio>
													<source src="<?php echo $resource[0]; ?>" type="audio/mp3"></source>
											    </audio>
											</p>
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
										<iframe src="http://docs.google.com/gview?url=<?php echo $resource[0]; ?>&embedded=true" frameborder="0" id="document_frame" style="height: 600px; width: 100%;"></iframe>
									<?php
									}
										break;
									case 'f':
									if ($resource[0]) {
										$filename=explode("/", $resource[0]);
										$ext= explode(".",$resource[0]);
									?>
										<div class="file content_inserted">
											<div class="dropped_div">
												<div class="attachment_info">
													<a href="<?php echo $resource[0]?>">
														<span class="extension"><?php echo end($ext); ?></span>
														<img class="file_icon" src="img/file_icon_lightblue.png"/>
													</a>
												</div>
												<p><strong><?php echo $filename[5]; ?></strong> - <?php echo format_bytes(filesize("tmp/".$filename[5])) ?></p>
											</div>
										</div>
									<?php
									}
								}
							?>
							</div>
							<div class="fixed"></div>
							<?php
							break;
						case 5:
							?>
							<div class="medium" style="min-height: 0px;">
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
										case 'a':
										if ($resource[$key]) {
											$musicname=explode("/", $resource[$key]);
										?>
											<div class="audio">
												<div class="dropped_div">
												<p class="player" rel="<?php echo $i.$resource_position[$key]; ?>">
													<span class="playtoggle"></span>
													<span class="song_name"><?php echo $musicname[5]; ?></span>
													<span class="gutter">
														<span class="loading"></span>
														<span class="handle" class="ui-slider-handle"></span>
													</span>
													<span class="timeleft"></span>
													<audio>
														<source src="<?php echo $resource[$key]; ?>" type="audio/mp3"></source>
												    </audio>
												</p>
												</div>
											</div>
										<?php
										}
											break;
										case 'f':
										if ($resource[$key]) {
											$filename=explode("/", $resource[$key]);
											$ext= explode(".",$resource[$key]);
										?>
											<div class="file content_inserted">
												<div class="dropped_div">
													<div class="attachment_info">
														<a href="<?php echo $resource[$key]?>">
															<span class="extension"><?php echo end($ext); ?></span>
															<img class="file_icon" src="img/file_icon_lightblue.png"/>
														</a>
													</div>
													<p><strong><?php echo $filename[5]; ?></strong> - <?php echo format_bytes(filesize("tmp/".$filename[5])) ?></p>
												</div>
											</div>
										<?php
										}
									}
								?>
							</div>
							<div class="medium" style="min-height: 0px;">
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
										case 'a':
										if ($resource[$key]) {
											$musicname=explode("/", $resource[$key]);
										?>
											<div class="audio">
												<div class="dropped_div">
												<p class="player" rel="<?php echo $i.$resource_position[$key]; ?>">
													<span class="playtoggle"></span>
													<span class="song_name"><?php echo $musicname[5]; ?></span>
													<span class="gutter">
														<span class="loading"></span>
														<span class="handle" class="ui-slider-handle"></span>
													</span>
													<span class="timeleft"></span>
													<audio>
														<source src="<?php echo $resource[$key]; ?>" type="audio/mp3"></source>
												    </audio>
												</p>
												</div>
											</div>
										<?php
										}
											break;
										case 'f':
										if ($resource[$key]) {
											$filename=explode("/", $resource[$key]);
											$ext= explode(".",$resource[$key]);
										?>
											<div class="file content_inserted">
												<div class="dropped_div">
													<div class="attachment_info">
														<a href="<?php echo $resource[$key]?>">
															<span class="extension"><?php echo end($ext); ?></span>
															<img class="file_icon" src="img/file_icon_lightblue.png"/>
														</a>
													</div>
													<p><strong><?php echo $filename[5]; ?></strong> - <?php echo format_bytes(filesize("tmp/".$filename[5])) ?></p>
												</div>
											</div>
										<?php
										}	
									}
								?>
							</div>
							<div class="fixed"></div>
							<?php
							break;
						case 6:
							?>
							<div class="small" style="min-height: 0px;">
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
										case 'a':
										if ($resource[$key]) {
											$musicname=explode("/", $resource[$key]);
										?>
											<div class="audio">
												<div class="dropped_div">
												<p class="player" rel="<?php echo $i.$resource_position[$key]; ?>">
													<span class="playtoggle"></span>
													<span class="song_name"><?php echo $musicname[5]; ?></span>
													<span class="gutter">
														<span class="loading"></span>
														<span class="handle" class="ui-slider-handle"></span>
													</span>
													<span class="timeleft"></span>
													<audio>
														<source src="<?php echo $resource[$key]; ?>" type="audio/mp3"></source>
												    </audio>
												</p>
												</div>
											</div>
										<?php
										}
											break;
										case 'f':
										if ($resource[$key]) {
											$filename=explode("/", $resource[$key]);
											$ext= explode(".",$resource[$key]);
										?>
											<div class="file content_inserted">
												<div class="dropped_div">
													<div class="attachment_info">
														<a href="<?php echo $resource[$key]?>">
															<span class="extension"><?php echo end($ext); ?></span>
															<img class="file_icon" src="img/file_icon_lightblue.png"/>
														</a>
													</div>
													<p><strong><?php echo $filename[5]; ?></strong> - <?php echo format_bytes(filesize("tmp/".$filename[5])) ?></p>
												</div>
											</div>
										<?php
										}
									}
								?>
							</div>
							<div class="small" style="min-height: 0px;">
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
										case 'a':
										if ($resource[$key]) {
											$musicname=explode("/", $resource[$key]);
										?>
											<div class="audio">
												<div class="dropped_div">
												<p class="player" rel="<?php echo $i.$resource_position[$key]; ?>">
													<span class="playtoggle"></span>
													<span class="song_name"><?php echo $musicname[5]; ?></span>
													<span class="gutter">
														<span class="loading"></span>
														<span class="handle" class="ui-slider-handle"></span>
													</span>
													<span class="timeleft"></span>
													<audio>
														<source src="<?php echo $resource[$key]; ?>" type="audio/mp3"></source>
												    </audio>
												</p>
												</div>
											</div>
										<?php
										}
											break;
										case 'f':
										if ($resource[$key]) {
											$filename=explode("/", $resource[$key]);
											$ext= explode(".",$resource[$key]);
										?>
											<div class="file content_inserted">
												<div class="dropped_div">
													<div class="attachment_info">
														<a href="<?php echo $resource[$key]?>">
															<span class="extension"><?php echo end($ext); ?></span>
															<img class="file_icon" src="img/file_icon_lightblue.png"/>
														</a>
													</div>
													<p><strong><?php echo $filename[5]; ?></strong> - <?php echo format_bytes(filesize("tmp/".$filename[5])) ?></p>
												</div>
											</div>
										<?php
										}	
									}
								?>
							</div>
							<div class="small" style="min-height: 0px;">
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
										case 'a':
										if ($resource[$key]) {
											$musicname=explode("/", $resource[$key]);
										?>
											<div class="audio">
												<div class="dropped_div">
												<p class="player" rel="<?php echo $i.$resource_position[$key]; ?>">
													<span class="playtoggle"></span>
													<span class="song_name"><?php echo $musicname[5]; ?></span>
													<span class="gutter">
														<span class="loading"></span>
														<span class="handle" class="ui-slider-handle"></span>
													</span>
													<span class="timeleft"></span>
													<audio>
														<source src="<?php echo $resource[$key]; ?>" type="audio/mp3"></source>
												    </audio>
												</p>
												</div>
											</div>
										<?php
										}
											break;
										case 'f':
										if ($resource[$key]) {
											$filename=explode("/", $resource[$key]);
											$ext= explode(".",$resource[$key]);
										?>
											<div class="file content_inserted">
												<div class="dropped_div">
													<div class="attachment_info">
														<a href="<?php echo $resource[$key]?>">
															<span class="extension"><?php echo end($ext); ?></span>
															<img class="file_icon" src="img/file_icon_lightblue.png"/>
														</a>
													</div>
													<p><strong><?php echo $filename[5]; ?></strong> - <?php echo format_bytes(filesize("tmp/".$filename[5])) ?></p>
												</div>
											</div>
										<?php
										}
									}
								?>
							</div>
							<div class="fixed"></div>
							<?php
							break;
						case 7:
							?>
							<div class="small" style="min-height: 0px;">
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
										case 'a':
										if ($resource[$key]) {
											$musicname=explode("/", $resource[$key]);
										?>
											<div class="audio">
												<div class="dropped_div">
												<p class="player" rel="<?php echo $i.$resource_position[$key]; ?>">
													<span class="playtoggle"></span>
													<span class="song_name"><?php echo $musicname[5]; ?></span>
													<span class="gutter">
														<span class="loading"></span>
														<span class="handle" class="ui-slider-handle"></span>
													</span>
													<span class="timeleft"></span>
													<audio>
														<source src="<?php echo $resource[$key]; ?>" type="audio/mp3"></source>
												    </audio>
												</p>
												</div>
											</div>
										<?php
										}
											break;
										case 'f':
										if ($resource[$key]) {
											$filename=explode("/", $resource[$key]);
											$ext= explode(".",$resource[$key]);
										?>
											<div class="file content_inserted">
												<div class="dropped_div">
													<div class="attachment_info">
														<a href="<?php echo $resource[$key]?>">
															<span class="extension"><?php echo end($ext); ?></span>
															<img class="file_icon" src="img/file_icon_lightblue.png"/>
														</a>
													</div>
													<p><strong><?php echo $filename[5]; ?></strong> - <?php echo format_bytes(filesize("tmp/".$filename[5])) ?></p>
												</div>
											</div>
										<?php
										}
									}
								?>
							</div>
							<div class="large" style="min-height: 0px;">
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
										case 'a':
										if ($resource[$key]) {
											$musicname=explode("/", $resource[$key]);
										?>
											<div class="audio">
												<div class="dropped_div">
												<p class="player" rel="<?php echo $i.$resource_position[$key]; ?>">
													<span class="playtoggle"></span>
													<span class="song_name"><?php echo $musicname[5]; ?></span>
													<span class="gutter">
														<span class="loading"></span>
														<span class="handle" class="ui-slider-handle"></span>
													</span>
													<span class="timeleft"></span>
													<audio>
														<source src="<?php echo $resource[$key]; ?>" type="audio/mp3"></source>
												    </audio>
												</p>
												</div>
											</div>
										<?php
										}
											break;
										case 'f':
										if ($resource[$key]) {
											$filename=explode("/", $resource[$key]);
											$ext= explode(".",$resource[$key]);
										?>
											<div class="file content_inserted">
												<div class="dropped_div">
													<div class="attachment_info">
														<a href="<?php echo $resource[$key]?>">
															<span class="extension"><?php echo end($ext); ?></span>
															<img class="file_icon" src="img/file_icon_lightblue.png"/>
														</a>
													</div>
													<p><strong><?php echo $filename[5]; ?></strong> - <?php echo format_bytes(filesize("tmp/".$filename[5])) ?></p>
												</div>
											</div>
										<?php
										}
									}
								?>
							</div>
							<div class="fixed"></div>
							<?php
							break;
						case 8:
							?>
							<div class="large" style="min-height: 0px;">
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
										case 'a':
										if ($resource[$key]) {
											$musicname=explode("/", $resource[$key]);
										?>
											<div class="audio">
												<div class="dropped_div">
												<p class="player" rel="<?php echo $i.$resource_position[$key]; ?>">
													<span class="playtoggle"></span>
													<span class="song_name"><?php echo $musicname[5]; ?></span>
													<span class="gutter">
														<span class="loading"></span>
														<span class="handle" class="ui-slider-handle"></span>
													</span>
													<span class="timeleft"></span>
													<audio>
														<source src="<?php echo $resource[$key]; ?>" type="audio/mp3"></source>
												    </audio>
												</p>
												</div>
											</div>
										<?php
										}
											break;
										case 'f':
										if ($resource[$key]) {
											$filename=explode("/", $resource[$key]);
											$ext= explode(".",$resource[$key]);
										?>
											<div class="file content_inserted">
												<div class="dropped_div">
													<div class="attachment_info">
														<a href="<?php echo $resource[$key]?>">
															<span class="extension"><?php echo end($ext); ?></span>
															<img class="file_icon" src="img/file_icon_lightblue.png"/>
														</a>
													</div>
													<p><strong><?php echo $filename[5]; ?></strong> - <?php echo format_bytes(filesize("tmp/".$filename[5])) ?></p>
												</div>
											</div>
										<?php
										}	
									}
								?>
							</div>
							<div class="small" style="min-height: 0px;">
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
										case 'a':
										if ($resource[$key]) {
											$musicname=explode("/", $resource[$key]);
										?>
											<div class="audio">
												<div class="dropped_div">
												<p class="player" rel="<?php echo $i.$resource_position[$key]; ?>">
													<span class="playtoggle"></span>
													<span class="song_name"><?php echo $musicname[5]; ?></span>
													<span class="gutter">
														<span class="loading"></span>
														<span class="handle" class="ui-slider-handle"></span>
													</span>
													<span class="timeleft"></span>
													<audio>
														<source src="<?php echo $resource[$key]; ?>" type="audio/mp3"></source>
												    </audio>
												</p>
												</div>
											</div>
										<?php
										}
											break;
										case 'f':
										if ($resource[$key]) {
											$filename=explode("/", $resource[$key]);
											$ext= explode(".",$resource[$key]);
										?>
											<div class="file content_inserted">
												<div class="dropped_div">
													<div class="attachment_info">
														<a href="<?php echo $resource[$key]?>">
															<span class="extension"><?php echo end($ext); ?></span>
															<img class="file_icon" src="img/file_icon_lightblue.png"/>
														</a>
													</div>
													<p><strong><?php echo $filename[5]; ?></strong> - <?php echo format_bytes(filesize("tmp/".$filename[5])) ?></p>
												</div>
											</div>
										<?php
										}
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