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
			
	require_once"../../ayarlar/ayarlar.php";
	date_default_timezone_set("europe/istanbul");
	$id=$_POST["id"];
	$silinecek=mysqli_fetch_array(mysqli_query($c,"select resim from flim where flim_id=$id"));
	extract($silinecek);
	$re="../../images/fimages/".$resim;
	echo $re;
	if(file_exists($re))unlink($re);else echo "Silinemedi";
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
	$sor="update flim set flim_adi='$f_a',oyuncu='$f_o',yili='$f_y',tur='$f_t',yonetmen='$f_yö',senarist='$f_s',imdb='$f_i',bilgi='$f_b',resim='$f_r',t_dublaj='$f_d',eklenme_tarihi='$f_e',fragman='$f_frag',embed='$f_em',embed2='$f_em2',tavsiye='$f_tav',yabacimi='$f_yab' where flim_id=$id";
	echo "<br><br><br><br><br><br><br>".$sor."<br><br><br><br><br><br><br>";
	mysqli_query($c,$sor);
	echo $f_r;
	require_once"../footer.php";	

?>