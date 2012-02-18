<!DOCTYPE html>
<html>
<head>
<title>The New Bottol Creation System</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen, print" />
</head>

<body>

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
			<input type="submit" name="submit_bottol" id="submit_bottol" value="Create"/>
			<input type="button" id="save_bottol" value="Save as Draft"/>
			<input type="button" id="preview_bottol" value="Preview"/>
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