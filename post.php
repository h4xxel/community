<?
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
if(isset($_SESSION["user_id"])&&isset($_POST["text"])&&isset($_GET["t"])){
	$query=sprintf("INSERT INTO `".$db["prefix"]."posts` (`id`, `text`, `time_created`, `time_modified`, `creator`, `thread`) VALUES (NULL, '%s', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '%s', '%s')",mysql_real_escape_string($_POST["text"]),$_SESSION["user_id"],mysql_real_escape_string($_GET["t"]));
	mysql_query($query, $mysql_link);
	header("Location: forum.php?t=".$_GET["t"]);
}else{
	header("Location: .");
}
?>