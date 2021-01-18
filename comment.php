<html>
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="Flim izle,Hd Flim İzle,720 Hd Flim İzle,1080p Hd Flim İzle">
		<meta name="keywords" content="Flim,720p,1080p,Flim İzle">
		<meta name="author" content="Osman Akutay">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="..\..\css/styleadmin.css" />
		<title>KralFlimSitesi</title>
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
			
		?>
		<script type="text/javascript" >
			function varmi(){
				var a=document.forms.yorum.yadi.value;
				var b=document.forms.yorum.com.value;
				if(a=="" )alert("Ad Alanını Boş Bırakmayınız!!!");
				if(b=="" )alert("Yorum Alanını Boş Bırakmayınız!!!");
				if((a=="") && (b==""))alert("Yorum ve Ad Alanını Boş Bırakmayınız!!!");
				}
		</script>
		<?php
			require_once "../../ayarlar/ayarlar.php";
		?>
	</head>
	<body>
		<div id="container">
			<div id="banner">
			<div id="logo"></div>
			<div id="reklam"></div>
		</div>
		<div id="ara"></div>
		<div id="menu">
				<span id="y"><a id="menu_item" href="adminstator.php?sayfa=1">Flim Ekle</a></span>
				<span id="y"><a id="menu_item" href="adminstator.php?sayfa=2">Flim Güncelle</a></span>
				<span id="y"><a id="menu_item" href="adminstator.php?sayfa=3">Flim Sil</a></span>
				<span id="y"><a id="menu_item" href="adminstator.php?sayfa=4">Yorum Ekle-Sil</a></span>
				<span id="y"><a id="menu_item" href="adminstator.php?sayfa=5">Slider Ekle</a></span>
				<span id="y"><a id="menu_item" href="adminstator.php?sayfa=6">Slider Sil</a></span>
				<span id="y"><a id="menu_item" href="adminstator.php?sayfa=6">İstek Şikayet</a></span>
				<span id="y"><a id="menu_item" href="cikis.php">Çık</a></span>	
		</div>
		<div id="arama">
			<form action="search.php" method="get">
				<span id="yazi"><h3>Arama</h3></span>
				<input type="text" placeholder="Aramak istediğiniz flim yada oyuncu" id="kutu" name="search"/>
				<input type="submit" value="Ara" id="button"/></a>
			</form>
		</div>
		<div id="smenu">
			<div id="slider">
				<?php
						$r=1;
						$sor=mysqli_query($c,"select * from slider order by zaman desc limit 0,15");
						while($row=mysqli_fetch_array($sor)){
						 extract($row);
						 $in='resim-'.$r;
						 echo '<a class="'.$in.'" href="video.php?v='.$f_id.'"><img src="../../images/fimages/'.$resim.'"></a>';
						 $r++;
						}
				
					
						?>
			</div>
		</div>
		<div id="ccontent">	
			<?php
				$fid=@$_GET["v"];
				if($fid=="" or !is_numeric($fid))header ("location:adminstator.php");
				$s=mysqli_query($c,"select * from flim where flim_id=".$fid);
				$row=mysqli_fetch_array($s);
					extract($row);
			?>
			<div id="image2">
				<img src='<?php echo "../../images/fimages/".$resim;?>' width="150" height="175"/>
			</div>
			<div id="fbilgi">
				<?php
				
				echo '<h2>Flimin Adı:';
					if(!empty($flim_adi))echo $flim_adi.'</h2>';
				echo '<h3>Oyuncu:';
					if(!empty($oyuncu))echo ucwords($oyuncu).'</h3>';
				echo '<h3>Tür:';
					if(!empty($tur))echo ucwords($tur).'</h3>';
				echo '<h3 id="ackl">Açıklama:';
					if(!empty($bilgi))echo ucfirst($bilgi).'</h3>';
				echo '<h3>Yapım Yılı:';
					if(!empty($yili))echo $yili.'</h3>';
				echo '<h3>Yönetmen:';
					if(!empty($yonetmen))echo ucfirst($yonetmen).'</h3>';
				echo '<h3>Senarist:';
					if(!empty($senarist))echo ucfirst($senarist).'</h3>';
				echo '<h3>Dublaj:';
					if(!empty($t_dublaj==1))echo'Türkçe Dublaj</h3>';
				else echo 'Türkçe Dublaj Değil</h3>';
					echo '<h3>Imdb Puan:';
				if(!empty($imdb))echo ucfirst($imdb).'</h3>';
					echo '<h3>İzlenme Sayısı:';
				if(!empty($izlenme))echo ucfirst($izlenme).'</h3>';
				?>
			</div>
			<?php 
				// sayfa cekme
				$sayfa=@$_GET["sayfa"];
				//sayfaya gönderiyen bişey yoksa veya zorlanıyorsa
				if($sayfa=="" || !is_numeric($sayfa))$sayfa=1;
				//kaçar gösterilecek
				$kacar=5;
				//nerde kaldım
				$nerden=($sayfa*$kacar)-$kacar;
				//kayıt sayısı
				$ksayisi=mysqli_num_rows(mysqli_query($c,"select y_id from yorum where f_id=$fid"));
				$yorumlar=mysqli_query($c,"select * from yorum where f_id=".$fid." order by zaman desc limit ".$nerden.",".$kacar."");
				while($k=mysqli_fetch_array($yorumlar)){
					//yorum göstermek için döngü
					extract($k);
					if($admin==1)echo '
						<div id="y2">
							<div id="yi">
								<p id="admin"><b>Adminstator  </b><i>diyorki;'.$zaman.'</i></p>
							</div>
							<div id="yiy">
								<p>'.$text.'</p>
							</div>
						</div>';
					else{
						echo '
						<div id="y2">
							<div id="yi">
								<p><b>'.$y_adi.'  </b><i>diyorki;'.$zaman.'</i></p>
							</div>
							<div id="yiy">
								<p>'.$text.'</p>
							</div>
						</div>';
					}
						
				}
				//sayfa sayısı
				$tsayfa=ceil($ksayisi/$kacar);
				//sitedeki toplam sayfa sayısı
				
				$s2=$tsayfa;
				if($s2<1)$s2=1;
				echo '<div id="comyorum"><pref id="ssayisi">Bu flime yapılan yorum sayısı:'.$s2.' Yorum Bulunmaktadır...!</pref>';
				//gorunecek kayıt sayısı
				$gorunen=3;
				//önceki sayfayı bulmak
				$onceki=$sayfa;
				$onceki-=1;
				if($sayfa>1){
					echo "<span id='secilen'><a href='comment.php?v=".$fid."&sayfa=1'>ilk</a></span>";
					echo "<a href='comment.php?v=".$fid."&sayfa=".$onceki."'>Önceki</a>";
				}else if($sayfa==1){
					echo "<span id='secilen'><a href='comment.php?v=".$fid."&sayfa=1'>ilk</a></span>";
				}
				//sayfaları sıralama
				for($i=$sayfa-$gorunen;$i<$sayfa+$gorunen;$i++){
					if($i>0 && $i<=$tsayfa)
					{
						echo '<a href=comment.php?v='.$fid.'&sayfa='.$i.'>'.$i.'</a>';
					}
				}
				//sonraki kaydı göster
				$sonraki=0;
				if($sayfa!=$tsayfa){
					$sonraki=$sayfa+1;
					echo "<a href='comment.php?v=".$fid."&sayfa=".$sonraki."'>Sonraki</a>";
					echo "<span id='secilen'><a href='comment.php?v=".$fid."&sayfa=".$tsayfa."'>Son</a></span>";
				}else if($sayfa==$tsayfa){
					echo "<span id='secilen'><a href='comment.php?v=".$fid."&sayfa	=".$tsayfa."'>Son</a></span>";
				}
				echo '</div>';
			?>
			<form action="comment.php" method="get" name="yorum">
				<div id="y3">
							<div id="yi3">
							<input name="v" type="text" value="<?php echo $fid;?>" style="display:none"/>
								<p><b>Adminstator </b><i>diyorki;</i></p>
							</div>
							<div id="yiy3">
								<textarea style="margin: 0px; width: 641px; height: 67px; outline:none;" name="com"></textarea>
								<input type="submit" value="Yorum Yap" id="b" onclick="varmi()"/>
							</div>
				</div>
			</form>
			<?php
				if(@$_GET["v"]and @$_GET["com"]){
					if(!empty($_GET["v"])and !empty($_GET["com"])){
						date_default_timezone_get("europe/istanbul");
						$z=date("Y-m-d H:i:s");
						$id=sgltemizle($_GET["v"]);
						$com=sgltemizle($_GET["com"]);
						$g=mysqli_query($c,'insert into yorum (f_id,y_adi,text,zaman,admin) values('.$id.',"Adminstator","'.$com.'","'.$z.'",1)');
						if($g)
						echo '<a href="comment.php?v='.$fid.'"><input type="submit" id="btn5"></a>
						<script type="text/javascript">
							function a(){
								var g=document.getElementById("btn5");
								g.style.display="none";
								g.click();
							}
							a();
						</script>';
					}else{
						echo '<script type="text/javascript">alert("Veritabanı hatası!!!!");</script>';
						
					}
				}
			?>
		</div>
			<div id="siteson">
			<h2>Film izle</h2>,<i> Hd film izle, Tek parça izle</i>
			
			<p>KralFlimİzle.com isimli film sitesinde bulunan film, film özetleri, film fragmanları ve diğer tüm videolar çeşitli sosyal paylaşım sitelerinden alınmaktadır. Sitemiz; vk.com, facebook.com, google.com, youtube.com Mail.ru gibi sitelerde paylaşılan içerikleri yayınlamaktadır.Bu nedenden dolayı KralFlimİzle.com sitesi hiç bir şekilde yasal hükümlülükle tabi tutulamaz.Telif hakları sahibi iseniz içeriğinizin kaldırılması için iletişim formunu kullanabilirsiniz.</p>
			</div>
			<div id="footer">
				<p>Copyright © 2011 - 2015 KralFlimİzle.com kalitenin tek adresi.</p>
			</div>
			
		</div>
			
			
	</body>
<?php
	require_once"../footer.php";	
			
?>