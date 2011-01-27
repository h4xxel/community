		<header>
			<h1><?echo $forum_name;?></h1>
			<?if(isset($_SESSION["username"])){
				echo "<div id=\"userinfo\"><p>Inloggad som: ".$_SESSION["username"]." <a href=\"login.php?action=logout\">Logga ut</a></p></div>\n";
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
					<li><a href=".">Hem</a></li>
					<li><a href=".">Hem</a></li>
					<li><a href=".">Hem</a></li>
					<li><a href=".">Hem</a></li>
					<li><a href=".">Hem</a></li>
				</ul>
			</nav>
		</header>