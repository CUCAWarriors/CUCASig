<?php
//Start the session
session_start();
//is the session array not there? well let's create it!
if (!isset($_SESSION['info']) or isset($_GET['init'])) {
	
	$_SESSION['info'] = array();
	//You haven't started yet!
	header("Location: ?p=1");
}
//Now, let's get the array
$info = $_SESSION['info'];
//See if the signiture is done, if so show it
if (isset($_GET['action'])) {
	if ($_GET['action'] == 'reveal') {

header("Content-Type: text/plain");
$first = $info['first'];
$last = $info['last'];
$title = $info['title'];
$mail = $info['mail'];
$facebook = $_SESSION['info']['faceebook'];
$twitter = $_SESSION['info']['twitter'];
$youtube = $_SESSION['info']['youtube'];
$instagram = $_SESSION['info']['instagram'];

echo <<<END 
<div style="width:630px;float:left;">
	<div style="float:left;width:155px;margin-right:10px;">
		<img alt="Your logo" src="http://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/CUCA_Logo.jpg/120px-CUCA_Logo.jpg" style="margin-bottom:10px;" /> <a href="http://facebook.com/charlotteunitedchristian" style="margin-right:30px; float:left;"> <img alt="Facebook" src="https://sites.google.com/a/flashpanel.com/signatures/images/facebook-ico.png" /></a> <a href="http://twitter.com/cucawarriors" style="margin-right:30px; float:left;"> <img alt="Twitter" src="https://sites.google.com/a/flashpanel.com/signatures/images/twitter-ico.png" /></a></div>
	<div style="float:left; color:#404040; text-align: center;">
		<span style="font-family:verdana,geneva,sans-serif;"><strong><span style="font-size: 20px; margin-bottom: 10px;">Charlotte United Chrisitan Academy</span></strong><br />
		$first<span style="font-size: 12px;"> </span>$last<br />
		<span style="font-size:12px;"><em>$title</em><br />
		<span><em><center>
END;
	
if (isset($facebook) and !$facebook == '') 
		echo "<a href='http://facebook.com/$facebook' style='margin-right:20px;'''> <img alt='Facebook' style='height:20px; width:20px;' src='https://sites.google.com/a/flashpanel.com/signatures/images/facebook-ico.png' /></a>";
if(isset($twitter) and !$twitter=='')
		echo  "<a href='http://twitter.com/$twitter' style='margin-right:20px; '> <img style='height:20px; width:20px;' alt='Twitter' src='https://sites.google.com/a/flashpanel.com/signatures/images/twitter-ico.png' /></a>";
if(isset($youtube) and !$youtube=='')
	"<a href='http://youtube.com/$youtube' style='margin-right:20px; '> <img style='height=20px; width:20px;' alt='YouTube' src='http://library.duke.edu/imgs/blue-note/youtube30x30.png' /></a>";
if(isset($instagram) and !$instagram == '')
	echo "<a href='http://instagram.com/$instagram' style='margin-right:20px; '> <img style='height=20px; width:20px;' alt='YouTube' src='http://icons.iconarchive.com/icons/designbolts/free-instagram/256/Active-Instagram-3-icon.png'/></a>";

echo <<<END
</em></span></center>
		<strong>P:</strong> 704-537-0031&nbsp;<span style="margin-left: 25px;"><strong>E: </strong><a href="mailto:$mail" style="text-decoration: none; color: inherit;">$mail</a></span><br />
		7640 Wallace Rd, Charlotte, NC 28212</span></span><br />
		<br />
		<div style="border: 1px solid rgb(221, 221, 221); padding: 10px; width: 440px; float: left; border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px; box-shadow: rgb(245, 245, 245) 0px 0px 5px 5px inset; text-align: left;">
			<div>
				<span style="font-size:14px;"><strong><span style="color:#ffa500;">NOTICE:</span></strong></span> The contents of this email message and any attachments are intended solely for the addressee(s) and may contain confidential and/or privileged information and may be legally protected from &nbsp;disclosure. If you are not the intended recipient of this message or their agent, or if this message has been addressed to you in error, please immediately alert the sender by reply email and then delete this message and any attachments. If you are not the intended recipient, you are hereby notified that any use, dissemination, copying, or storage of this message or its attachments is strictly prohibited.&nbsp;</div>
			<div>
				&nbsp;</div>
		</div>
	</div>
</div>
<br />

END;
	}


}
//If it is not lets display the steps
else {
if (isset($_POST['p'])) 
{
$page = $_POST['p'];
}

else {

	$page = 1;
}

?>
<!DOCTYPE html>
<html>
<head>
<title>CUCA Sig Gen</title>
</head>
<body>
<?php
switch ($page) {

case 1:
?>
<h3>Hello, Let's create your signiture. I am going to run though some quick steps</h3><br>
What's Your Name?<br>
<form method="post">
<label for="first">First Name</label> <input type="text" name="first"/>&nbsp;<label for="Last">Last Name</label><input type="text" name="last"/><br>
<input type='hidden' name='p' value='2'/>
<input type="submit" value="Next Step" />

</form>
<?php
break;
case 2:
if (isset($_POST['first']) && isset($_POST['last'])) {
$info['first'] = $_POST['first'];
$info['last'] = $_POST['last'];
$_SESSION['info'] = $info;
?>
<form method="post">
<label for="title">Title</label> <input type="text" name="title"/>
<input type='hidden' name='p' value='3'/>
<input type="submit" value="Next Step" />
</form>
<?php

}
else {

	echo "ERROR: <a href='?init=true'> Please go back and try again";

}

break;
case 3:
if (isset($_POST['title'])) {
$info['title'] = $_POST['title'];
$_SESSION['info'] = $info;
?>
<form method="post">
<label for="mail">E-Mail Address</label> <input type="text" name="mail"/>
<input type='hidden' name='p' value='4'/>
<input type="submit" value="Next Step" />
</form>
<?php

}
else {

	echo "ERROR: <a href='?init=true'> Please go back and try again";

}

break;
case 4:


if (isset($_POST['mail'])) {
$info['mail'] = $_POST['mail'];
$_SESSION['info'] = $info;
?>
<i>Your Social Media, Put YOUR social media info here</i><br>
<b>Please put your USERNAME only</b>
<form method="post">
<table border="1">
	<tr><td>Facebook</td><td><input type='text' name='facebook'/></td></tr>
	<tr><td>Twitter</td><td><input type='text' name='twitter'/></td></tr>
	<tr><td>YouTube</td><td><input type='text' name='youtube'/></td></tr>
	<tr><td>Instagram</td><td><input type='text' name='instagram'/></td></tr>
</table></br>
</form>
}
else {

	echo "ERROR: <a href='?init=true'> Please go back and try again";

}



<?php
break;

case 5:
if (isset($_POST['facebook'])) {
$info['facebook'] = $_POST['facebook'];
$info['twitter'] = $_POST['twitter'];
$info['youtube'] = $_POST['youtube'];
$info['instagram'] =$_POST['instagram'];


$_SESSION['info'] = $info;
?>
<i>Is this correct?</i><br>
<table border="1">
	<tr><td>First Name</td><td><?=$_SESSION['info']['first']?></td></tr>
	<tr><td>Last Name</td><td><?=$_SESSION['info']['last']?></td></tr>
	<tr><td>Title</td><td><?=$_SESSION['info']['title']?></td></tr>
	<tr><td>E-Mail</td><td><?=$_SESSION['info']['mail']?></td></tr>
		<tr><td>Facebook</td><td><?=$_SESSION['info']['facebook']?></td></tr>
	<tr><td>Twitter</td><td><?=$_SESSION['info']['twitter']?></td></tr>
	<tr><td>YouTube</td><td><?=$_SESSION['info']['youtube']?></td></tr>
	<tr><td>Instagram</td><td><?=$_SESSION['info']['instagram']?></td></tr>
</table></br>
<a href="?init=true" target="_parent"><button>No</button></a>&nbsp;<a href="?action=reveal"><button>Yes</button></a>


<?php

}
else {

	echo "ERROR: <a href='?init=true'> Please go back and try again";

}

break;

}
?>

</body>
</html>
<?
}

?>