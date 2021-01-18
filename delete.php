<?php

			require_once "../../ayarlar/ayarlar.php";
			session_start();
				$ad=@mysql_escape_string(strip_tags($_POST["adname"]));
				$s=@mysql_escape_string(strip_tags($_POST["pass"]));
				$select=mysqli_query($c,"SELECT * FROM admin WHERE ad='$ad' and pass='$s'");
				$sonuc=mysqli_num_rows($select);
					if($sonuc>0){
						$_SESSION["ad"]=$ad;
						$_SESSION["pass"]=$s;
					}else{
						$ad=$_SESSION["ad"];
						$s=$_SESSION["pass"];
						$select=mysqli_query($c,"SELECT * FROM admin WHERE ad='$ad' and pass='$s'");
						$so=mysqli_num_rows($select);
						if($so>0){
							
						}else{
							header("location:../../index.php");
						}
					}
			

require_once "../../ayarlar/ayarlar.php";
$id=@$_GET["v"];
if($id!=""){
	echo $id;
	if($id=="" or !is_numeric($id))("location:adminstator.php");
	$s="DELETE FROM `flim` WHERE flim_id=$id";
	$a=mysqli_query($c,$s);
	if($a)
	echo '<a href=adminstator.php?sayfa=3><input id="btn" type="submit" style="display:none"></a>
	<script type="text/javascript">
		function s(){
			var s=document.getElementById("btn");
			s.click();
		}
		s();
	</script>';
}
$id2=@$_GET["c"];
if($id2!=""){
	echo $id2;
	if($id2=="" or !is_numeric($id))("location:adminstator.php");
	$s=mysqli_query($c,"select * from yorum where y_id=".$id2."");
	$r=mysqli_fetch_array($s);
	$s="DELETE FROM `yorum` WHERE `y_id`=".$id2."";
	$a=mysqli_query($c,$s);
	extract($r);
	if($a)
	echo '<a href=comment.php?v='.$f_id.'><input id="btn" type="submit" style="display:none"></a>
	<script type="text/javascript">
		function s(){
			var s=document.getElementById("btn");
			s.click();
		}
		s();
	</script>';
}	
$id3=@$_GET["i"];
if($id3!=""){
	echo '<script type="text/javascripts">
		var a=document.getElementById("z");
		a.click();
	</script>';
	if($id3=="" or !is_numeric($id3))echo '
	<input type="submit"id="xc"><a href="adminstator.php?sayfa=6"></a></input>
	<script type="text/javascript">document.getElementById("xc").click();</script>';
	$s="DELETE FROM `mesaj` WHERE id=$id3";
	$a=mysqli_query($c,$s);
	if($a)echo '<a href="adminstator.php?sayfa=7"><input type="submit"id="p" style="display:none;"></a>
								<script type="text/javascript">
								var a=document.getElementById("p");
								a.click();
								</script>';
}
$sil=@$_GET["s"];
if($sil!=""){
	echo '<script type="text/javascripts">
		var a=document.getElementById("z");
		a.click();
	</script>';
	if($sil=="" or !is_numeric($sil))echo '
	<input type="submit"id="xc"><a href="adminstator.php?sayfa=6"></a></input>
	<script type="text/javascript">document.getElementById("xc").click();</script>';
	$s="DELETE FROM `slider` WHERE f_id=$sil";
	$a=mysqli_query($c,$s);
	if($a)echo '<a href="adminstator.php?sayfa=6"><input type="submit"id="p" style="display:none;"></a>
								<script type="text/javascript">
								var a=document.getElementById("p");
								a.click();
								</script>';
}
require_once"../footer.php";	

?>