<!DOCTYPE html>
<html>
<head>
<title>The New Bottol Creation System</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen, print" />
<link rel="stylesheet" href="js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/spinner.css">
<script type="text/javascript" language="javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" language="javascript" src="js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="js/blocks.js"></script>
<script type="text/javascript" src="js/uploader.js"></script>
<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="js/jquery.embedly.js"></script>
<script type="text/javascript" src="js/jquery.tools.min.js"></script>
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
		<h2 class="pagetitle">Create a New Bottol</h2>
		<p id="create">Create a New Bottol: &nbsp;&nbsp;&nbsp; <span class="asterisco">* &nbsp; indicates required field</span></p>
		<form action="created.php" method="post" id="forum-topic-form" class="standard-form" enctype="multipart/form-data">
			<label>Title:</label><br/>
			<input type="text" name="topic_title" id="topic_title" value="" autocomplete="off" maxlength="50" /><span class="asterisco">*</span><br/>			
			<label>Subtitle:</label><br/>
			<input type="text" name="topic_subtitle" id="topic_subtitle" value="" autocomplete="off" maxlength="80" /><!-- <span class="asterisco">*</span> --><br/>

			

			<!-- hidden menu -->

			<div style="display: none;">
				<div id="hidden_menu_largest">
					<div class="element_popup" onclick="appendText()" title="Embed Text">
						<img src="img/text.png"/>
					</div>
					<div class="element_popup" onclick="appendImage()" title="Embed Image">
						<img src="img/image.png"/>
					</div>
					<div class="element_popup" onclick="appendVideo()" title="Embed Video">
						<img src="img/video.png"/>
					</div>
					<div class="element_popup" onclick="appendGenericLink()" title="Embed Web Link">
						<img src="img/multimedia.png"/>
					</div>
					<div class="element_popup" onclick="appendWebPage()" title="Embed Web Page">
						<img src="img/webpage.png"/>
					</div>
					<div class="element_popup" onclick="appendDocument()" title="Embed Document">
						<img src="img/document.png"/>
					</div>
				</div>
				<div id="hidden_menu">
					<div class="element_popup" onclick="appendText()" title="Embed Text">
						<img src="img/text.png"/>
					</div>
					<div class="element_popup" onclick="appendImage()" title="Embed Image">
						<img src="img/image.png"/>
					</div>
					<div class="element_popup" onclick="appendVideo()" title="Embed Video">
						<img src="img/video.png"/>
					</div>
					<div class="element_popup" onclick="appendGenericLink()" title="Embed Web Link">
						<img src="img/multimedia.png"/>
					</div>
				</div>
			</div>

			<!-- end hidden menu -->

			<!-- max chars reached message-->

			<a href="#maxCharsReachMsg" id="maxCharsReach" class="fancybox"></a>
			<div style="display:none">
				<div id="maxCharsReachMsg">
					Sorry but you can enter a maximum of 10000 characters...
				</div>
			</div>

			<!-- Content bottle creation -->
			<div id="blocks_content"></div>

			<!-- start select layout -->

			<div class="list_carousel">
				<div id='counter_blocks'></div>
				<div id="elements">

					<!--
						<div class="element" onclick="addText()" title="Embed Text">
							<img src="img/text.png"/>
						</div>
						<div class="element" onclick="addImage()" title="Embed Image">
							<img src="img/image.png"/>
						</div>
						<div class="element" onclick="addVideo()" title="Embed Video">
							<img src="img/video.png"/>
						</div>
						<div class="element" onclick="addNotAvailable()" title="Embed audio">
							<img src="img/music.png"/>
						</div>
						<div class="element" onclick="addGenericLink()" title="Embed Web Link">
							<img src="img/link.png"/>
						</div>
						<div class="element" onclick="addLink()" title="Embed Web Page">
							<img src="img/webpage.png"/>
						</div>
						<div class="element" onclick="addDocument()" title="Embed Document">
							<img src="img/document.png"/>
						</div>
					-->

					<!-- start layout icons -->

					<div class="element" onclick="addXL()" title="Add one largest slot">
						<img src="img/xl.png"/>
					</div>
					<div class="element" onclick="addMM()" title="Add two medium slots">
						<img src="img/mm.png"/>
					</div>
					<div class="element" onclick="addSSS()" title="Add three small slots">
						<img src="img/sss.png"/>
					</div>
					<div class="element" onclick="addSL()" title="Add a small and a large slot">
						<img src="img/sl.png"/>
					</div>
					<div class="element" onclick="addLS()" title="Add a large and a small slot">
						<img src="img/ls.png"/>
					</div>

					<!-- fine layout icons -->
					
				</div>
				<div class="clearfix"></div>

				<!--

				<a class="prev" id="elements_prev" href="#"><img src="img/left.png" alt=""></a>
				<a class="next" id="elements_next" href="#"><img src="img/right.png" alt=""></a>
				<div class="pagination" id="elements_pag"></div>

				-->

			</div>

			<input type="submit" name="submit_bottol" id="submit_bottol" value="Create"/>
			<!--
			<input type="button" id="save_bottol" value="Save as Draft"/>
			<input type="button" id="preview_bottol" value="Preview"/>
			-->
			<input type="button" id="cancel_bottol" value="Cancel" onclick="window.location = 'http://<?php echo $db_domain;?>';"/>
			<div id="loading_resources"></div>
		</form>
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