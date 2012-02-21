<!DOCTYPE html>
<html>
<head>
<title>The New Bottol Creation System</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen, print" />
<script type="text/javascript" language="javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.carouFredSel-5.5.0-packed.js"></script>
<script type="text/javascript" language="javascript" src="js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="js/blocks.js"></script>
<script type="text/javascript" src="js/uploader.js"></script>
<script type="text/javascript" language="javascript">
	$(function() {
		$('#elements').carouFredSel({
			circular: false,
			auto: false,
			infinite: false,
			scroll: {items: "page"},
			prev: {button: "#elements_prev", key: "left"},
			next: {button: "#elements_next", key: "right"},
			pagination: "#elements_pag"
		});
	});
</script>
</head>

<body>

<div id="giveusfeedback-side">
	<span><a href="#"></a></span>
</div>

<div id="header">
	<img src="img/fakeadminbar.png" alt="">
</div>
<div id="container">
	<div id="content">
		<h2 class="pagetitle">Create a New Bottol</h2>
		<p id="create">Create a New Bottol: &nbsp;&nbsp;&nbsp; <span class="asterisco">* &nbsp; indicates required field</span></p>
		<form action="" method="post" id="forum-topic-form" class="standard-form" enctype="multipart/form-data">
			<label>Title:</label><br/>
			<input type="text" name="topic_title" id="topic_title" value="" autocomplete="off" maxlength="50" /><span class="asterisco">*</span><br/>			
			<label>Subtitle:</label><br/>
			<input type="text" name="topic_subtitle" id="topic_subtitle" value="" autocomplete="off" maxlength="80" /><!-- <span class="asterisco">*</span> --><br/>

			<!-- Start jcarousel -->

			<div class="list_carousel">
				<div id="elements">
					<div class="element" onclick="addText()">
						<img src="img/text.png"/>
					</div>
					<div class="element" onclick="addImage()">
						<img src="img/image.png"/>
					</div>
					<div class="element" onclick="addNotAvailable()">
						<img src="img/video.png"/>
					</div>
					<div class="element" onclick="addNotAvailable()">
						<img src="img/music.png"/>
					</div>
					<div class="element" onclick="addLink()">
						<img src="img/webpage.png"/>
					</div>
					<div class="element" onclick="addNotAvailable()">
						<img src="img/document.png"/>
					</div>
					<!-- layout icons -->
					<div class="element" onclick="addNotAvailable()">
						<img src="img/2x2.png"/>
					</div>
					<div class="element" onclick="addNotAvailable()">
						<img src="img/3x1.png"/>
					</div>
					<div class="element" onclick="addNotAvailable()">
						<img src="img/3x2.png"/>
					</div>
					<div class="element" onclick="addNotAvailable()">
						<img src="img/3x3.png"/>
					</div>
					<!-- fine layout icons -->
				</div>
				<div class="clearfix"></div>
				<a class="prev" id="elements_prev" href="#"><img src="img/left.png" alt=""></a>
				<a class="next" id="elements_next" href="#"><img src="img/right.png" alt=""></a>
				<div class="pagination" id="elements_pag"></div>
			</div>

			<!-- End jcarousel -->

			<!-- Content bottle creation -->
			<div id="blocks_content"></div>

			<input type="submit" name="submit_bottol" id="submit_bottol" value="Create"/>
			<!--
			<input type="button" id="save_bottol" value="Save as Draft"/>
			<input type="button" id="preview_bottol" value="Preview"/>
			-->
			<input type="button" id="cancel_bottol" value="Cancel"/>
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