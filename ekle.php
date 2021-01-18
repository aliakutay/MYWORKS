
<html>
	<head>
		<meta charset="UTF-8">
		<title>KralFlimSitesi</title>
		<?php
			require_once "../../ayarlar/ayarlar.php";
		?>
	</head>
	<body>
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
			
	if($_POST)
			{
				$ad=$_SESSION["ad"];
				$s=$_SESSION["pass"];
				$select=mysqli_query($c,"SELECT * FROM admin WHERE ad='$ad' and pass='$s'");
				$sonuc=mysqli_num_rows($select);
				if(!$sonuc>0)header("location:../../index.php");
				date_default_timezone_set("europe/istanbul");
				$f_tmp=$_FILES['f']['tmp_name'];
				$f_r="../../images/fimages/";
				$f_r.=$_FILES['f']['name'];
				$t=move_uploaded_file($f_tmp,$f_r);
				$f_a=$_POST["f_adi"];
				$f_o=$_POST["f_oyuncu"];
				$f_y=$_POST["f_yili"];
				$f_t=$_POST["f_türü"];
				$f_yö=$_POST["f_yön"];
				$f_s=$_POST["f_sen"];
				$f_i=$_POST["f_imdb"];
				$f_b=$_POST["f_bilgi"];
				$f_r=$_FILES['f']['name'];
				$f_d=$_POST["f_dub"];
				$f_frag=$_POST["fragman"];
				$f_em=$_POST["f_embed"];
				$f_em2=$_POST["f_embed2"];
				$f_tav=$_POST["tavsiye"];
				$f_yab=$_POST["yabancimi"];
				$f_e=date("Y/m/d");
				echo 'Flim adı:'.$f_a;
				echo 'Flim oyuncu:'.$f_o;
				echo 'Flim yılı:'.$f_y;
				echo 'Flim türü:'. $f_t;
				echo 'Flim yönetmen:'.$f_yö;
				echo 'Flim senarist:'.$f_s;
				echo 'Flim imdb:'.$f_i;
				echo 'Flim bilgi:'.$f_b;
				echo 'Flim resim:'.$f_r;
				echo 'Flim dublaj:'.$f_d;
				echo 'Flim embed kodu:'.$f_em;
				echo 'Flim eklenmetarihi:'.$f_e;
				$sor="insert into flim(flim_adi,oyuncu,yili,tur,yonetmen,senarist,imdb,bilgi,resim,t_dublaj,eklenme_tarihi,izlenme,fragman,embed,embed2,tavsiye,yabacimi) values ('$f_a','$f_o','$f_y','$f_t','$f_yö','$f_s','$f_i','$f_b','$f_r','$f_d','$f_e',0,'$f_frag','$f_em','$f_em2','$f_tav','$f_yab')";
				echo "<br><br><br><br><br><br><br>".$sor;
				mysqli_query($c,$sor);
				echo $f_r;
					
				
				/*INSERT INTO `flim`(`flim_adi`, `oyuncu`, `yapım_yili`, `tür`, `yonetmen`, `senarist`, `imdb`, `bilgi`, `resim`, `t_dublaj`, `eklenme_tarihi`,`embed`) VALUES ('asdas','asdas','sd','asdas','Das','dasd','sdasd','adasssda','bz.jpg','sdasd','13/06/2016','asd')
				
				
				INSERT INTO `flim`(`flim_adi`, `oyuncu`, `yapım_yili`, `tür`, `yonetmen`, `senarist`, `imdb`, `bilgi`, `resim`, `t_dublaj`, `eklenme_tarihi`,`embed`) VALUES ('$f_a','$f_o','$f_y','$f_t','$f_yö','$f_s','$f_i','$f_b','$f_r','$f_d','$f_e','$f_em')
				
				
				("asdas","asdas","sd","asdas","Das","dasd","sdasd","adasssda","bz.jpg","sdasd","1asda","asd","sdasd")
				header("location:adminstator.php");
				
				*/
			}
			if($_GET){
				$id=$_GET["v"];
				$z=time();
				$r=mysqli_fetch_array(mysqli_query($c,"select * from flim where flim_id=".$id.""));
				extract($r);
				$s=mysqli_query($c,'INSERT INTO `slider`(`f_id`, `resim`, `zaman`, `flim_adi`, `imdb`, `izlenme`,yabacimi) VALUES ('.$id.',"'.$resim.'","'.$z.'","'.$flim_adi.'","'.$imdb.'",'.$izlenme.',"'.$yabacimi.'")');
				if($s){
					echo '<a href="adminstator.php?sayfa=5"><input type="submit" id="o" ></a>';
					 echo '<script type="text/javascript">
						var a=document.getElementById("o");
						a.click();
					</script>';
				}
			}
	
	
?>
	</body>
<?php
require_once"../footer.php";	
?>