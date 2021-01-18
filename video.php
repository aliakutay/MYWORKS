<?php 
	require_once'ayarlar/ayarlar.php';
?>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="Flim izle,Hd Flim İzle,720 Hd Flim İzle,1080p Hd Flim İzle">
		<?php
			$fid=$_GET["v"];
			$key=mysqli_query($c,"select flim_adi,oyuncu from flim where flim_id=".$fid."");
			$r=mysqli_fetch_array($key);
			extract($r);
		?>
		<meta name="keywords" content="<?php echo $flim_adi." izle,".$flim_adi." Türkçe Dublaj izle,".$flim_adi." Full Türkçe Dublaj izle,".$oyuncu." Flimleri izle,"?>Flim,720p,1080p,Flim İzle">
		<meta name="author" content="Osman Akutay">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<title>KralFlimSitesi</title>
		<script type="text/javascript" >
			//holder secim on
				function s1(){
					var s1=document.getElementById("q1");
					s1.className="z2";
					
				}
				function s2(){
					var s1=document.getElementById("q2");
					s1.className="z2";
					
				}
				function s3(){
					var s1=document.getElementById("q3");
					s1.className="z2";
					
				}
				//holder secim off
				function m1(){
					var s1=document.getElementById("q1");
					s1.className="z1";
				}
				function m2(){
					var s1=document.getElementById("q2");
					s1.className="z1";
				}
				function m3(){
					var s1=document.getElementById("q3");
					s1.className="z1";
				}
								// embed secim on
				function sec1(){
				var sec=document.getElementById("sec1");
				sec.className="s2";
				}
				function sec2(){
				var sec=document.getElementById("sec2");
				sec.className="s2";
				}
				function sec3(){
				var sec=document.getElementById("sec3");
				sec.className="s2";
				}
				//embed secim off
				function secme1(){
				var sec=document.getElementById("sec1");
				sec.className="s1";
				}
				function secme2(){
				var sec=document.getElementById("sec2");
				sec.className="s1";
				}
				function secme3(){
				var sec=document.getElementById("sec3");
				sec.className="s1";
				}
				
				function varmi(){
				var a=document.forms.yorum.yadi.value;
				var b=document.forms.yorum.com.value;
				if(a=="" )alert("Ad Alanını Boş Bırakmayınız!!!");
				if(b=="" )alert("Yorum Alanını Boş Bırakmayınız!!!");
				if((a=="") && (b==""))alert("Yorum ve Ad Alanını Boş Bırakmayınız!!!");
				if(a=="Admin")alert("Admin İsmini Kullanmayınız!!!!");
				}
		</script>
	</head>
<body>
	<div id="container" class="container">
		<div id="banner">
			<div id="logo"></div>
			<div id="reklam"></div>
		</div>
		<div id="ara"></div>
		<div id="menu">
			<span id="y"><a id="menu_item" href="index.php?sayfa=1">KralFlimİzle Sitesi</a></span>
			<span id="y"><a id="menu_item" href="index.php?sayfa=2">Tavsiyelerimiz</a></span>
			<span id="y"><a id="menu_item" href="index.php?sayfa=3">En Çok İzlenenler</a></span>
			<span id="y"><a id="menu_item" href="index.php?sayfa=4">İletişim</a></span>
			
		</div>
		<div id="arama">
		<form action="search.php" method="get"> 
			<span id="yazi"><h3>Arama</h3></span>
			<input type="text" id="kutu" name="search" placeholder="Aramak istediğiniz flim yada oyuncu"/>
			<input type="submit" value="Ara" id="button"/>
		</form>
		</div><form action="search.php" method="get"> 
			<span id="yazi"><h3>Arama</h3></span>
			<input type="text" id="kutu" name="search" placeholder="Aramak istediğiniz flim yada oyuncu"/>
			<input type="submit" value="Ara" id="button"/>
		</form>
		<div id="smenu">
			<div id="slider">
				<div class="fbox">
				 <?php
				 $r=1;
					 $sor=mysqli_query($c,"select * from slider order by zaman desc limit 0,15");
					 while($row=mysqli_fetch_array($sor)){
						 extract($row);
						 $in='resim-'.$r;
						$secim;
						if($yabacimi==1){$secim="images\symbol\dub.png";}
						else{$secim="images\symbol\sub.png";}
						 echo '
						 <a class="'.$in.'" href="video.php?v='.$f_id.'"><img src="'.$secim.'" class="fdili"/><img src="images/fimages/'.$resim.'" class="sliderres"></a>';
						 $r++;
					 }
				
					
				 ?>	
				</div>
			</div>
		</div>
		<div id="ara"></div>
		<div id="vcontent">	
			<div id="embed">
			<?php
				$fid=$_GET["v"];
				if(empty($fid))header("location:index.php");
				mysqli_query($c,"update flim set izlenme=izlenme+1 where flim_id=".$fid."");
				$em=0;
				$s=mysqli_query($c,"select * from flim where flim_id=".$fid."");
				$row=mysqli_fetch_array($s);
					extract($row);
					if($fragman!="")echo '<a id="sec1" href="video.php?v='.$fid.'&e=1" class="s1">Fragman</a>';
					if($embed!="")echo '<a id="sec2" href="video.php?v='.$fid.'&e=2" class="s1">Seçenek-1</a>';
					if($embed2!="")echo '<a id="sec3" href="video.php?v='.$fid.'&e=3" class="s1">Seçenek-2</a>';
					
			?>
			</div>
			<div id="frame">
			<?php
			$e=@$_GET["e"];
			if(!is_numeric($e))$e=2;	
			switch($e){
				case 1:
					echo '<iframe width="660" height="400" src="'.$fragman.'" frameborder="0" allowfullscreen></iframe>';
					echo '<script type="text/javascript">
							sec1();
						  </script>';
						  if($e!=1)echo '<script type="text/javascript">
							secme1();
						  </script>';
				break;
				case 2:
					echo '<iframe width="660" height="400" src="'.$embed.'" frameborder="0" allowfullscreen></iframe>';
					echo '<script type="text/javascript">
							sec2();
						  </script>';
						  if($e!=2)echo '<script type="text/javascript">
							secme2();
						  </script>';
				break;
				case 3:
					echo '<iframe width="660" height="400" src="'.$embed2.'" frameborder="0" allowfullscreen></iframe>';
					echo '<script type="text/javascript">
							sec3();
						  </script>';
						  if($e!=3)echo '<script type="text/javascript">
							secme3();
						  </script>';
				break;
			}

			?>
			</div>
			<div id="image">
				<img src='<?php echo "images/fimages/".$resim;?>'/>
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
			<div id="ar1">
			
			</div>
			
		</div>
		
		<div id="menu2">
		
				<?php 
				$sayfa=@$_GET["sayfa"];
				if(empty($sayfa)||is_numeric($sayfa))$sayfa=5;
				?>
				
				<div id="holder">
					<ul id="tab">
						<li><a href="index.php?sayfa=5&r=1" id="q1" class="z2" value="birinci">Yabancı Flimler</a></li>
						<li><a href="index.php?sayfa=6&r=2" id="q2" class="z1">Yerli Flimler</a></li>
						<li><a href="index.php?sayfa=7&r=3" id="q3" class="z1" value="sonuncu">Oyuncular</a></li>
					</ul>
				</div>
				<?php 
					$r=@$_GET["r"];
					if(empty($r)){
						$r=1;
					}
					if(!empty($r)){
							switch($r){
							case 1:
							$sorgu=mysqli_query($c,"SELECT Distinct(tur) FROM `flim` WHERE `yabacimi`=1 ORDER BY `yili` DESC");
							while($row=mysqli_fetch_array($sorgu)){
								 extract($row);
								 echo '<div id="ara2"><img src="images/symbol/sag.png"/><a href="index.php?sayfa=5&r=1&o='.$tur.'">'.ucwords($tur).'</a></div>';
							}
							$sorgu2=mysqli_query($c,"SELECT Distinct(yili) FROM `flim` WHERE `yabacimi`=1 ORDER BY `yili` DESC");
							while($row=mysqli_fetch_array($sorgu2)){
								 extract($row);
								 echo '<div id="ara2"><img src="images/symbol/sag.png"/><a href="index.php?sayfa=5&r=1&y='.$yili.'">'.$yili.'</a></div>';
							}
							break;
							case 2:
							$sorgu=mysqli_query($c,"SELECT Distinct(tur) FROM `flim` WHERE `yabacimi`=0 ORDER BY `fragman` DESC");
							while($row=mysqli_fetch_array($sorgu)){
								 extract($row);
								 echo '<div id="ara2"><img src="images/symbol/sag.png"/><a href="index.php?sayfa=6&r=2&o='.$tur.'">'.$tur.'</a></div>';
							}
							break;
							case 3:
							$sorgu=mysqli_query($c,"SELECT distinct(oyuncu) FROM `flim` ORDER BY `fragman` DESC");
							while($row=mysqli_fetch_array($sorgu)){
								 extract($row);
								 echo '<div id="ara2"><img src="images/symbol/sag.png"/><a href="index.php?sayfa=7&r=3&o='.$oyuncu.'">'.$oyuncu.'</a></div>';
							}
						}
					}
					
					
				?>
		</div>
		<?php 	
				$si=mysqli_query($c,"select * from yorum where f_id=".$fid." order by zaman desc limit 0,3");
				while($k=mysqli_fetch_array($si)){
					extract($k);
					if($admin==1)echo '
						<div id="y2">
							<div id="yi">
								<p id="admin"><b>Adminstator </b><i>diyorki;'.$zaman.'</i></p>
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
			
			?>
			<form action="video.php" method="get" name="yorum">
				<div id="y3">
							<div id="yi3">
							<input name="v" type="text" value="<?php echo $fid;?>" style="display:none"/>
							<input name="z" type="text" value="<?php date_default_timezone_get("europe/istanbul");echo date("Y-m-d H:i:s")?>" style="display:none"/>
								<p><b><input type="text" name="yadi" placeholder="Yorum yapanın ismi"/>  </b><i>diyorki;</i></p>
							</div>
							<div id="yiy3">
								<textarea style="margin: 0px; width: 641px; height: 67px; outline:none;" name="com"></textarea>
								<input type="submit" value="Yorum Yap" id="b" onclick="varmi()"/>
							</div>
				</div>
				
			</form>
			<script type="text/javascript">
			function varmi(){
				var a=document.forms.yorum.yadi.value;
				var b=document.forms.yorum.com.value;
				if(a=="" )alert("Ad Alanını Boş Bırakmayınız!!!");
				if(b=="" )alert("Yorum Alanını Boş Bırakmayınız!!!");
				if((a=="") && (b==""))alert("Yorum ve Ad Alanını Boş Bırakmayınız!!!");
			}
			</script>
			<?php
				if(@$_GET["v"] and @$_GET["yadi"] and @$_GET["com"]){
					if(!empty($_GET["v"]) and !empty($_GET["yadi"]) and !empty($_GET["com"])and !empty($_GET["z"])){
						$id=sgltemizle($_GET["v"]);
						$ad=sgltemizle($_GET["yadi"]);
						$com=sgltemizle($_GET["com"]);
						$z=sgltemizle($_GET["z"]);
						$g=mysqli_query($c,	'insert into yorum(f_id,y_adi,text,zaman,admin) values('.$id.',"'.$ad.'","'.$com.'","'.$z.'",0)');
						echo '
						<a href="video.php?v='.$id.'"><input type="submit" style="display:none" id="videophp"></a>
						<script type="text/javascript">
							var a=document.getElementById("videophp");
							a.click();
						</script>';
					}else{
						echo 'yorum alanını boş bırakmayınız';
						
					}
				}
			
			
			?>
		<div id="siteson" class="siteson">
		<h2>Film izle</h2>,<i> Hd film izle, Tek parça izle</i>
		
		<p>KralFlimİzle.com isimli film sitesinde bulunan film, film özetleri, film fragmanları ve diğer tüm videolar çeşitli sosyal paylaşım sitelerinden alınmaktadır. Sitemiz; vk.com, facebook.com, google.com, youtube.com Mail.ru gibi sitelerde paylaşılan içerikleri yayınlamaktadır.Bu nedenden dolayı KralFlimİzle.com sitesi hiç bir şekilde yasal hükümlülükle tabi tutulamaz.Telif hakları sahibi iseniz içeriğinizin kaldırılması için iletişim formunu kullanabilirsiniz.</p>
		</div>
		<div id="footer">
			<p>Copyright © 2011 - 2015 KralFlimİzle.com kalitenin tek adresi.</p>
		</div>
		
	</div>
		
		
</body>
<?php

?>