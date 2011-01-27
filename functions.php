<?
function rand_str($length) {
	$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
	$numchars = (strlen($chars) - 1);
	$string = $chars{rand(0, $numchars)};
	
	for ($i = 1; $i < $length; $i+=1){
		$newchar = $chars{rand(0, $numchars)};
		$string .=  $newchar;
	}
	return $string;
}
?>