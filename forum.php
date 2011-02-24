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
<?include("header.php");
if(isset($_GET["c"])) {
	if($_GET["action"]=="new"&&isset($_SESSION["user_id"])) {
		$query=sprintf("SELECT * FROM `".$db["prefix"]."categories` WHERE `id` = '%s'",mysql_real_escape_string($_GET["c"]));
		$r=mysql_query($query,$mysql_link);
		$s=mysql_fetch_assoc($r);
		?>
		<div class="post_new">
			<h2>Skapar ny tråd i <?echo $s["name"];?></h2>
			<form action="post.php?c=<?echo $_GET["c"];?>" method="POST">
				<ul>
					<li>Titel:</li>
					<li><input name="title" type="text" /></li>
					<li>Första posten:</li>
					<li><textarea name="text"></textarea></li>
					<li><input type="submit" value="Skapa tråd" /></li>
				</ul>
			</form>
		</div>
		<?
	}else{
		$query=sprintf("SELECT * FROM `".$db["prefix"]."categories` WHERE `id` = '%s'",mysql_real_escape_string($_GET["c"]));
		$r=mysql_query($query,$mysql_link);
		$s=mysql_fetch_assoc($r);
		$t_query=sprintf('SELECT * FROM `'.$db["prefix"]."threads` WHERE category = '%s' ORDER BY `id` DESC",mysql_real_escape_string($_GET["c"]));
		$t_r=mysql_query($t_query,$mysql_link);
		echo "<h2>".$s["name"]."</h2>";
		?><span class="new_thread"><?if(isset($_SESSION["user_id"])) {echo '<a href="?c='.$_GET["c"].'&amp;action=new">Ny tråd</a>';}?></span><?
		while($t_s=mysql_fetch_assoc($t_r)){
			$u_query='SELECT * FROM `'.$db["prefix"]."users` WHERE id='".$t_s["creator"]."'";
			$u_r=mysql_query($u_query,$mysql_link);
			$u_s=mysql_fetch_assoc($u_r);?>
			<h2><a href="?t=<?echo $t_s["id"];?>"><?echo $t_s["name"];?></a></h2><p>av: <?echo '<a href="profile.php?id='.$u_s["id"].'">'.$u_s["username"];?></a></p><div class="clearer"></div>
		<?}
	}
} elseif(isset($_GET["t"])) {
	$query=sprintf("SELECT * FROM `".$db["prefix"]."threads` WHERE `id` = '%s'",mysql_real_escape_string($_GET["t"]));
	$r=mysql_query($query,$mysql_link);
	$s=mysql_fetch_assoc($r);
	echo "<h2>".$s["name"]."</h2>";
	$p_query=sprintf('SELECT * FROM `'.$db["prefix"]."posts` WHERE thread = '%s' ORDER BY `id` ASC",mysql_real_escape_string($_GET["t"]));
	$p_r=mysql_query($p_query,$mysql_link);
	while($p_s=mysql_fetch_assoc($p_r)){
		$u_query='SELECT * FROM `'.$db["prefix"]."users` WHERE id='".$p_s["creator"]."'";
		$u_r=mysql_query($u_query,$mysql_link);
		$u_s=mysql_fetch_assoc($u_r);?>
		<div>
			<div class="post_creator">
				<h2><?echo '<a href="profile.php?id='.$u_s["id"].'">'.$u_s["username"];?></a></h2>
				<img class="avatar" alt="<?echo $u_s["username"];?>" src="<?echo $u_s["avatar"];?>" />
			</div>
			<article class="post">
				<?//Plocka ut url:er och gör de till länkar?>
				<p><?echo preg_replace("/((http|ftp):\/\/[^ ]*)/i", '<a href="$1">$1</a>', htmlspecialchars($p_s["text"]));?></p>
			</article>
			<div class="clearer"></div>
		</div>
	<?}
	if(isset($_SESSION["user_id"])){?>
		<div class="post_new">
			<form action="post.php?t=<?echo $_GET["t"];?>" method="POST">
				<ul>
					<li><textarea name="text"></textarea></li>
					<li><input type="submit" value="Posta svar" /></li>
				</ul>
			</form>
		</div>
	<?}
} else {
	$query='SELECT * FROM `'.$db["prefix"].'categories`';
	$r=mysql_query($query,$mysql_link);
	while($s=mysql_fetch_assoc($r)){?>
		<section class="category">
			<h2><a href="?c=<?echo $s["id"];?>"><?echo $s["name"];?></a><span class="new_thread"><?if(isset($_SESSION["user_id"])) echo '<a href="?c='.$_GET["c"].'&amp;action=new">Ny tråd</a>';?></span></h2>
			<?
			$t_query='SELECT * FROM `'.$db["prefix"]."threads` WHERE category = '".$s["id"]."' ORDER BY `id` DESC LIMIT 0 , 3";
			$t_r=mysql_query($t_query,$mysql_link);
			while($t_s=mysql_fetch_assoc($t_r)){
				$u_query='SELECT * FROM `'.$db["prefix"]."users` WHERE id='".$t_s["creator"]."'";
				$u_r=mysql_query($u_query,$mysql_link);
				$u_s=mysql_fetch_assoc($u_r);?>
				<h3><a href="?t=<?echo $t_s["id"];?>"><?echo $t_s["name"];?></a></h3><p>av: <?echo '<a href="profile.php?id='.$u_s["id"].'">'.$u_s["username"];?></a></p><div class="clearer"></div>
			<?}?>
		</section>	
<?	}
}
	include("footer.php");?>