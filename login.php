<?php
require("settings.php");
session_start();
$mysql_link=mysql_connect($db["host"],$db["username"],$db["password"]);
if(!$mysql_link) {
	die("Error: ".mysql_error());
}

$mysql_db=mysql_select_db($db["database"],$mysql_link);
if(!$mysql_db) {
	die("Error: ".mysql_error());
}

$query='SELECT * FROM `'.$db["prefix"].'forum`';
$r=mysql_query($query,$mysql_link);
$s=mysql_fetch_assoc($r);
$forum_name=$s["name"];
$server_id=$s["server_id"];

function rand_str($length) {
	$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
	$numchars = (strlen($chars) - 1);
	$string = $chars{rand(0, $numchars)};
	
	for ($i = 1; $i < $length; $i+=1){
		$newchar = $chars{rand(0, $numchars)};
		$string .=  $newchar;
	}
	return $string;
}
function display_login($fail=false) {
	$nonce=rand_str(32);
	global $server_id;
	?>
<!DOCTYPE html>
<html>
	<head>
		<title>Log In</title>
		<link rel="Stylesheet" type="text/css" href="style.css" />
		<script type="text/javascript" src="script.js"></script>
		<script type="text/javascript" src="sha1.js"></script>
	</head>
	<body>
		<h1>Log In</h1>
		<?if($fail){echo "<h2>u fAil @ lajf.</h2>";}?>
		<form action="login.php" method="POST" onsubmit="hash_password(this,'<?echo $server_id;?>' ,'<?echo $nonce?>');">
			<input type="text" name="u" />
			<input type="password" name="p" />
			<input type="submit" value="Log In" />
			<input type="hidden" name="hash" value="" /><input type="hidden" name="nonce" value="<?echo $nonce;?>" />
		</form>
	</body>
</html>
	<?
}
if($_GET["action"]=="logout") {
	session_destroy();
	header("Location: .");
}
if(isset($_POST["hash"])) {
	$query=sprintf("SELECT `password` FROM `".$db["prefix"]."users` WHERE `username` = '%s'",mysql_real_escape_string($_POST["u"]));
	$r=mysql_query($query,$mysql_link);
	$s=mysql_fetch_assoc($r);
	if($_POST["hash"]==sha1($s["password"].$_POST["nonce"])&&$s["password"]) {
		$_SESSION["username"]=$_POST["u"];
		header("Location: .");
	}else{
		display_login(true);
	}
}else{
	display_login();
}
?>