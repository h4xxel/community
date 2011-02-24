<?php
ob_start();
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

if($_GET["action"]=="logout") {
	session_destroy();
	header("Location: .");
}
if(isset($_POST["hash"])) {
	$query=sprintf("SELECT `password`, `id` FROM `".$db["prefix"]."users` WHERE `username` = '%s'",mysql_real_escape_string($_POST["u"]));
	$r=mysql_query($query,$mysql_link);
	$s=mysql_fetch_assoc($r);
	if($_POST["hash"]==sha1($s["password"].$_POST["nonce"])&&$s["password"]) {
		$_SESSION["username"]=$_POST["u"];
		$_SESSION["user_id"]=$s["id"];
		
		header("Location: .");
	}else{
		header("Location: .?login=fail");
	}
}else{
	header("Location: .");
}
ob_end_flush();
?>