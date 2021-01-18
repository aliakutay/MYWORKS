<html>
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="Flim izle,Hd Flim İzle,720 Hd Flim İzle,1080p Hd Flim İzle">
		<meta name="keywords" content="Flim,720p,1080p,Flim İzle">
		<meta name="author" content="Osman Akutay">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../../css/styleadmin.css" />
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
							header("location:giris.php");
						}
					}
			
		?>
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
				}
		</script>
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
			<input type="submit" value="Ara" id="button"/>
		</form>
		</div>
		<div id="smenu">
			<div id="slider">
				<div class="fbox">
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
		</div>
		<div id="ara"></div>
		<div id="content">	
			<?php
			echo '	<div id="seklenen">
										<div id="sekyazi">Arama Sonuçları</div>
									</div>';
							$s=@$_GET["s"];
							$o=@$_GET["search"];
								if(empty($s)||!is_numeric($s))$s=1;
								// if(empty($o)){
									// echo '<a href="adminstator.php?sayfa=1"><input type="submit" id="o" ></a>';
									// echo '<script type="text/javascript">
										// var a=document.getElementById("o");
										// a.click();
									// </script>';
								//}
									$kayit=mysqli_num_rows(mysqli_query($c,"SELECT flim_id FROM `flim` where flim_adi like '%$o%' or oyuncu like '%$o%' ORDER BY `oyuncu` DESC"));
									$kacar=24;	
									$say=ceil($kayit/$kacar);
									$nerde=($s*$kacar)-$kacar;
									$sorgu=mysqli_query($c,"SELECT * FROM `flim` where flim_adi like '%$o%' or oyuncu like '%$o%' ORDER BY `oyuncu` DESC limit ".$nerde.",".$kacar."");
									while($row=mysqli_fetch_array($sorgu)){
									extract($row);
									echo'
									<div id="araflim">
												<a href="video.php?v='.$flim_id.'"><img src="../../images/fimages/'.$resim.'" id="yenif"></a>
												<div id="fisim">
													<a href="">'.$flim_adi.'</a>
												</div>
												<a href="update.php?v='.$flim_id.'"><input type="submit" value="Güncelle"/></a>
												<a href="delete.php?v='.$flim_id.'"><input type="submit" value="Sil"/></a>
												<a href="ekle.php?v='.$flim_id.'"><input type="submit" value="Slider Ekle"/></a>
												<div id="izhit"><img src="..\..\images\symbol\izhit.png">555</div>
												<div id="imdb"><img src="..\..\images\symbol\imdb.png">444</div>
											</div>';
									}
									$gorunen=3;
									$s2=$say;
										echo '<div id="syfsayisi"><pref id="ssayisi">Sitede '.$s2.' tane flim sayfası bulunmaktadır </pref>';
										if($s>1){
												$onceki=$s-1;
												echo "<span id='secilen'><a href='search.php?search=".$o."&s=1'>ilk</a></span>";
												echo "<a href='search.php?search=".$o."&s=".$onceki."'>Önceki</a>";
										}
										for($i=$s-$gorunen;$i<$s+$gorunen+1;$i++){
											if($i>0 and $i<=$say)
											echo '<a href="search.php?search='.$o.'&s='.$i.'" id="onlink">'.$i.'</a>';
										}
										$sonraki=0;
										if($s!=$say&&$say!=0){
											$sonraki=$s+1;
											echo "<a href='search.php?search=".$o."&s=".$sonraki."'>Sonraki</a>";
											echo "<span id='secilen'><a href='search.php?search=".$o."&s=$say'>Son</a></span>";
										}
										echo '</div>';	
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
include_once"../../tema/footer.php";
?>