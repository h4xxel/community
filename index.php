<?php
require("settings.php");
require("functions.php");
session_start();
$tab=0;
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
<?include("header.php");?>
		<article>
			<h2>Hej och välkommen till <?echo $forum_name;?> </h2><br/>
			<h3><?echo $forum_name;?> erbjuder sina besökare:</h3><br/>
			<ul>
			<li><h3>Ett aktivt forum med utbildade medlemmar och staff</h3></li>
			<li><h3>Ett "Up to date" forum med de hetaste och nyaste produkterna och recensionerna över hela världen</h3></li>
			<li><h3>Snygg design och lockande funktioner för både honom och henne</h3></li>
			<li><h3>Ett galleri där man kan ladda upp bilder på sin vattekylda rolex som går i 4,2GHz</h3></li>
			</ul>
		</article>
<?include("footer.php");?>