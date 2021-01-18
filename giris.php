
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="Flim izle,Hd Flim İzle,720 Hd Flim İzle,1080p Hd Flim İzle">
		<meta name="keywords" content="Flim,720p,1080p,Flim İzle">
		<meta name="author" content="Osman Akutay">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="..\..\css\styleadmin.css" />
		<title>KralFlimSitesi</title>
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
			<span id="yazi"><h3>Arama</h3></span>
			<input type="text" value="Aramak istediğiniz flim yada oyuncu" id="kutu"/>
			<input type="submit" value="Ara" id="button"/>
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
		<div id="gcontent">
		<div id="seklenen">
			<div id="sekyazi">Admin Girişi</div>
		</div>
			<form action="adminstator.php" method="post" >
			<div id="gname">
					Kullanıcı Adı:
					<input type="text" name="adname" class="t"/>
					 Password:</td>
					<input type="password" name="pass" class="t"/>
					<td><input type="submit" id="btn" value="Giriş"/>
			</div>
			</form>
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
	include '..\footer.php';
?>