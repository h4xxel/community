<?php
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
<!DOCTYPE html>
<html>
	<head>
		<title>omg</title>
		<link rel="Stylesheet" type="text/css" href="style.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
		<script type="text/javascript" src="script.js"></script>
		<script type="text/javascript" src="sha1.js"></script>
	</head>
	<body>
<?include("header.php");
if(isset($_GET["c"])) {
	$t_query=sprintf('SELECT * FROM `'.$db["prefix"]."threads` WHERE category = '%s' ORDER BY `id` DESC",mysql_real_escape_string($_GET["c"]));
	$t_r=mysql_query($t_query,$mysql_link);
	while($t_s=mysql_fetch_assoc($t_r)){
		$u_query='SELECT * FROM `'.$db["prefix"]."users` WHERE id='".$t_s["creator"]."'";
		$u_r=mysql_query($u_query,$mysql_link);
		$u_s=mysql_fetch_assoc($u_r);?>
		<h2><a href="?t=<?echo $t_s["id"];?>"><?echo $t_s["name"];?></a></h2><p>av: <?echo $u_s["username"];?></p><div class="clearer"></div>
	<?}
} elseif(isset($_GET["t"])) {
	$p_query=sprintf('SELECT * FROM `'.$db["prefix"]."posts` WHERE thread = '%s' ORDER BY `id` ASC",mysql_real_escape_string($_GET["t"]));
	$p_r=mysql_query($p_query,$mysql_link);
	while($p_s=mysql_fetch_assoc($p_r)){
		$u_query='SELECT * FROM `'.$db["prefix"]."users` WHERE id='".$p_s["creator"]."'";
		$u_r=mysql_query($u_query,$mysql_link);
		$u_s=mysql_fetch_assoc($u_r);?>
		<div>
			<div class="post_creator">
				<h2><?echo $u_s["username"];?></h2>
				<img class="avatar" alt="<?echo $u_s["username"];?>" src="<?echo $u_s["avatar"];?>" />
			</div>
			<article class="post">
				<p><?echo htmlspecialchars($p_s["text"]);?></p>
			</article>
			<div class="clearer"></div>
		</div>
	<?}
	if(isset($_SESSION["username"])){?>
		<div class="post_new">
			<form action="post.php?t=<?echo $_GET["t"];?>" method="POST">
				<textarea name="text"></textarea>
				<input type="submit" value="Post" />
			</form>
		</div>
	<?}
} else {
	$query='SELECT * FROM `'.$db["prefix"].'categories`';
	$r=mysql_query($query,$mysql_link);
	while($s=mysql_fetch_assoc($r)){?>
		<section class="category">
			<h2><a href="?c=<?echo $s["id"];?>"><?echo $s["name"];?></a></h2>
			<?
			$t_query='SELECT * FROM `'.$db["prefix"]."threads` WHERE category = '".$s["id"]."' ORDER BY `id` DESC LIMIT 0 , 3";
			$t_r=mysql_query($t_query,$mysql_link);
			while($t_s=mysql_fetch_assoc($t_r)){
				$u_query='SELECT * FROM `'.$db["prefix"]."users` WHERE id='".$t_s["creator"]."'";
				$u_r=mysql_query($u_query,$mysql_link);
				$u_s=mysql_fetch_assoc($u_r);?>
				<h3><a href="?t=<?echo $t_s["id"];?>"><?echo $t_s["name"];?></a></h3><p>av: <?echo $u_s["username"];?></p><div class="clearer"></div>
			<?}?>
		</section>	
<?	}
}
	include("footer.php");?>
	</body>
</html>