<?php
ob_start();
require("settings.php");
require("functions.php");
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
?>
<?include("header.php");
if(!isset($user_id)) {
	if($_GET["action"]=="register") {
		if(isset($_POST["u"])&&isset($_POST["e"])&&$_POST["hash"]==$_POST["confirmhash"]&&$_POST["hash"]!=sha1($server_id)) {
			$query=sprintf("SELECT * FROM `".$db["prefix"]."users` WHERE `username` = '%s'", mysql_real_escape_string($_POST["u"]));
			$r=mysql_query($query, $mysql_link);
			$s=mysql_fetch_assoc($r);
			if(isset($s["id"])) {
		?><h2 class="error">Användarnamnet är redan upptaget!</h2><?
			}else {
				$query=sprintf("INSERT INTO `".$db["prefix"]."users` (`id`, `username`, `email`, `password`, `avatar`, `signature`, `location`, `description`, `registered`, `last_active`, `group`, `theme`) VALUES (NULL, '%s', '%s', '%s', NULL, '', '', '', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '3', '1');", mysql_real_escape_string($_POST["u"]), mysql_real_escape_string($_POST["e"]), mysql_real_escape_string($_POST["hash"]));
				$r=mysql_query($query, $mysql_link);
				$_SESSION["user_id"]=mysql_insert_id();
				$_SESSION["username"]=$_POST["u"];
				header("Location: profile.php");
			}
		}else {
		?><h2 class="error">Du måste fylla i alla fälten!</h2><?
		}
	}else{?>
		<form method="POST" action="register.php?action=register" onsubmit="hash_register(this, '<?echo $server_id;?>');" />
			<table>
				<tr><td>Användarnamn: </td><td><input type="text" name="u" /></td></tr>
				<tr><td>Email: </td><td><input type="text" name="e" /></td></tr>
				<tr><td>Lösenord: </td><td><input type="password" name="p" /></td></tr>
				<tr><td>Upprepa lösenord: </td><td><input type="password" name="c" /></td></tr>
				<tr><td colspan="2"><input type="submit" value="Registrera" /><input type="hidden" name="hash" /><input type="hidden" name="confirmhash" /></td></tr>
			</table>
		</form>
<?	}
}
include("footer.php");
ob_end_flush();?>