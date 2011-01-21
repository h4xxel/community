<?php
require("settings.php");
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
$s=mysql_fetch_row($r);
$forum_name=$s[1];
?>
<!DOCTYPE html>
<html>
	<head>
		<title>omg</title>
		<link rel="Stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
<?include("header.php");?>
		<article>
			<p>omfg</p>
		</article>
<?include("footer.php");?>
	</body>
</html>