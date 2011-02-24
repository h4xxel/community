<!DOCTYPE html>
<html>
	<head>
		<title><?echo $forum_name;?></title>
		<link rel="Stylesheet" type="text/css" href="style.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
		<script type="text/javascript" src="script.js"></script>
		<script type="text/javascript" src="sha1.js"></script>
	</head>
	<body>
		<header>
			<h1><?echo $forum_name;?></h1>
			<?if(isset($_SESSION["username"])){
				$query='SELECT * FROM `'.$db["prefix"].'users` WHERE id = "'.$_SESSION["user_id"].'"';
				$r=mysql_query($query,$mysql_link);
				$s=mysql_fetch_assoc($r);?>
				<div id="userinfo">
					<h6>Inloggad som: <?echo $s["username"];?></h6>
					<div id="avatar"><?echo '<img class="avatar" src="'.$s["avatar"].'" alt="avatar" />'?></div>
					<div id="userlinks">
						<ul>
							<li><a href="login.php?action=logout">Logga ut</a></li>
						</ul>
					</div>
					<div id="clearer"></div>
				</div>
			<?
			}else{
			$nonce=rand_str(32);?>
				<form action="login.php" method="POST" onsubmit="hash_password(this,'<?echo $server_id;?>' ,'<?echo $nonce?>');">
					<h6>Logga in<?if($_GET["login"]=="fail"){echo ' <span class="error">Misslyckades</span>';}?></h6>
					<table>
						<tr>
							<td>Användarnamn: </td><td><input type="text" name="u" /></td>
						</tr>
						<tr>
							<td>Lösenord: </td><td><input type="password" name="p" /></td>
						</tr>
						<tr>
							<td><input type="hidden" name="hash" value="" /><input type="hidden" name="nonce" value="<?echo $nonce;?>" /></td><td><input type="submit" value="Log In" /></td>
						</tr>
					</table>
				</form>
			<?
			}?>
			<nav>
				<ul id="menu">
					<li><a href=".">Hem</a></li>
					<li><a href="forum.php">Forum</a></li>
					<li><a href="profile.php">Profil</a></li>
				</ul>
			</nav>
		</header>