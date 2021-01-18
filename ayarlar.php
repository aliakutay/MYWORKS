<?php
	## vb 
	$h="localhost";
	$k="root";
	$p="";
	$v="flimsitesi";
	##baglnatı
	$c=mysqli_connect($h,$k,$p,$v);
	## giriş
	function sgltemizle($param){
		return trim(strip_tags($param));
	}
?>