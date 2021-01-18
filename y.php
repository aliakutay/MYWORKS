<?php include "ayarlar/ayarlar.php";
if($_POST){
	//date.timezone = "Europe/Istanbul";
	
	$adi=addslashes(htmlspecialchars(trim($_POST["yadi"])));
	$com=addslashes(htmlspecialchars(trim($_POST["com"])));
	$id=$_POST["t"];
	$zaman=time();
	$sorgu=mysqli_query($c,"INSERT INTO yorum(f_id,y_adi,text,zaman) VALUES(".$id.",'".$adi."','".$com."',".$zaman.")");
	if($sorgu)echo "başarılı";
	else echo "başarısız";
	$lo="location:video.php?v=";
	$lo.=$id;
	$lo.="&em=1";
	header($lo);
}
else if($_GET){
	$zaman=date('Y-m-d h:m:s');
	$madi=sgltemizle(@$_GET["madi"]);
	$mesaj=sgltemizle(@$_GET["msg"]);
		if($madi!="" and $mesaj!=""){
		$s="INSERT INTO mesaj (ad,mesaj,zaman) VALUES ('".$madi."','".$mesaj."','$zaman')";
		echo $s;
		$a=mysqli_query($c,$s);
		}
		header('location:index.php');
}
else{
	header('location:index.php');
}
?>
