		<header>
			<h1><?echo $forum_name;?></h1>
			<p><?if(isset($_SESSION["username"])){echo "<p>Inloggad som: ".$_SESSION["username"]." <a href=\"login.php?action=logout\">Logga ut</a></p>\n";}else{echo "<p><a href=\"login.php\">Logga In</a></p>";}?></p>
		</header>