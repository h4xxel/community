<?
ob_start();
require("settings.php");
require("functions.php");
session_start();
$tab=2;
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
include("header.php");

if(isset($_SESSION["user_id"])) {
	if($_GET["action"]=="edit") {
		if(trim($_POST["email"])!=""&&isset($_POST["location"])&&isset($_POST["description"])&&isset($_POST["signature"])) {
			$query=sprintf("UPDATE `".$db["prefix"]."users` SET `email` = '%s', `location` = '%s', `description` = '%s', `signature` = '%s' WHERE `id` = '%s'",mysql_real_escape_string($_POST["email"]),mysql_real_escape_string($_POST["location"]),mysql_real_escape_string($_POST["description"]),mysql_real_escape_string($_POST["signature"]),$_SESSION["user_id"]);
			$r=mysql_query($query,$mysql_link);
			$s=mysql_fetch_assoc($r);
			header("Location: profile.php");
			exit();
		}else{
			?><h2 class="error">Du måste fylla i en giltig emailadress!</h2><?
		}
	}elseif($_GET["action"]=="avatar") {
		//$query=sprintf("UPDATE `".$db["prefix"]."users` SET `avatar` = '%s' WHERE `id` = '%s'",mysql_real_escape_string($_POST["signature"]),$_SESSION["user_id"]);
		//$r=mysql_query($query,$mysql_link);
		//$s=mysql_fetch_assoc($r);
		header("Location: profile.php");
		exit();
	}
	if(isset($_GET["id"])){
		$query=sprintf('SELECT * FROM `'.$db["prefix"].'users` WHERE id = "%s"',mysql_real_escape_string($_GET["id"]));
		$r=mysql_query($query,$mysql_link);
		$s=mysql_fetch_assoc($r);
		$g_query='SELECT * FROM `'.$db["prefix"].'groups` WHERE id = "'.$s["group"].'"';
		$g_r=mysql_query($g_query,$mysql_link);
		$g_s=mysql_fetch_assoc($g_r);
		?>
		<h2><?echo $s["username"];?></h2>
		<h3><?echo $g_s["name"];?></h3>
		<img class="avatar" src="<?echo $s["avatar"];?>" />
		<ul class="user_info">
			<li>Email: <?echo $s["email"];?></li>
			<li>Plats: <?echo $s["location"];?></li>
			<li>Registrerad: <?echo $s["registered"];?></li>
			<li>Senast inloggad: <?echo $s["last_active"];?></li>
			<li>Personlig info: <?echo $s["description"];?></li>
			<li>Signatur: <?echo $s["signature"];?></li>
		</ul>
		<?
	}else{
		$query='SELECT * FROM `'.$db["prefix"].'users` WHERE id = "'.$_SESSION["user_id"].'"';
		$r=mysql_query($query,$mysql_link);
		$s=mysql_fetch_assoc($r);
		$g_query='SELECT * FROM `'.$db["prefix"].'groups` WHERE id = "'.$s["group"].'"';
		$g_r=mysql_query($g_query,$mysql_link);
		$g_s=mysql_fetch_assoc($g_r);
		?>
		<h2><?echo $s["username"];?></h2>
		<h3><?echo $g_s["name"];?></h3>
		<img class="avatar" src="<?echo $s["avatar"];?>" />
		<form method="POST" action="?action=avatar">
			<p><input type="text" name="avatar" /><input type="submit" value="Byt avatar" /></p>
		</form>
		<form method="POST" action="?action=edit">
			<table class="user_info">
				<tr><td>Email:</td><td><input name="email" value="<?echo $s["email"];?>" /></td></tr>
				<tr><td>Plats:</td><td><input name="location" value="<?echo $s["location"];?>" /></td></tr>
				<tr><td>Registrerad:</td><td><?echo $s["registered"];?></td></tr>
				<tr><td>Senast inloggad:</td><td><?echo $s["last_active"];?></td></tr>
				<tr><td>Personlig info:</td><td><textarea name="description"><?echo $s["description"];?></textarea></td></tr>
				<tr><td>Signatur:</td><td><textarea name="signature"><?echo $s["signature"];?></textarea></td></tr>
				<tr><td colspan="2"><input type="submit" value="Spara ändringar" /></td></tr>
			</table>
		</form>
		<?
	}
}else{
	?><h2 class="error">Du måste vara inloggad för att kunna visa profiler.</h2><?
}

include("footer.php");
ob_end_flush();
?>