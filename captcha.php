<?php
function randstr($length = 32) {
	$chars = 'ABCDEFGHJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz123456789';
	$numchars = (strlen($chars) - 1);
	$string = $chars{rand(0, $numchars)};
	
	for ($i = 1; $i < $length; $i+=1){
		$newchar = $chars{rand(0, $numchars)};
		$string .=  $newchar;
	}
	return $string;
}
function randline() {
	$x1=rand(0, 18);
	$x2=rand(110, 127);
	$y1=rand(0, 47);
	$y2=rand(0, 47);
	return ' -draw "line '.$x1.",".$y1.",".$x2.",".$y2.'" ';
}
if($_GET['image']!="") {
	$captchatext=randstr(6);
	$imagename="/tmp/".str_replace("/","",$_GET['image']).".png";
	$textfilename="/tmp/".str_replace("/","",$_GET['image']).".txt";
	file_put_contents($textfilename,$captchatext);
	$exectext='convert -size 128x48 xc:white -fill white -stroke black -font "AvantGarde-Demi" -pointsize 32 -gravity center -draw "text 0,0 '."'".$captchatext."'".'"'.randline().randline().randline().randline().' -implode "-0.5" '.$imagename;
	exec($exectext);
	header("Content-type: image/png");
	readfile($imagename);
	unlink($imagename);
}
?>