<html>
	<head>
	<meta charset="UTF-8">
	<meta name="description" content="Flim izle,Hd Flim İzle,720 Hd Flim İzle,1080p Hd Flim İzle">
	<meta name="keywords" content="Flim,720p,1080p,Flim İzle">
	<meta name="author" content="Osman Akutay">
	<link href="../css/styleadmin.css" rel="stylesheet" />
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
	<div id="seklenen">
		<div id="sekyazi">Flim Düzelt</div>
	</div>
	<div id="fekle">
		<form method="post" action="duzelt.php" name="o" enctype="multipart/form-data">
			<table id="table1">
				<tr>
					<td>Filmin Adı:</td>
					<td><input type="text" name="f_adi"></td>
					<input type="text" name="id" style="display:none" value="
					<?php 
					$s=@$_GET["v"];
					echo $s; ?>">
				</tr>
				<tr>
					<td>Film Oyuncu:</td>
					<td><input type="text" name="f_oyuncu"></td>
				</tr>
				<tr>
					<td>Filmin Tarihi:</td>
					<td><input type="text" name="f_yili"></td>
				</tr>
				<tr>
					<td>Filmin Türü:</td>
					<td><input type="text" name="f_türü"></td>
				</tr>
				<tr>
					<td>Filmin Yönetmeni:</td>
					<td><input type="text" name="f_yön"></td>
				</tr>
				<tr>
					<td>Filmin Senarist:</td>
					<td><input type="text" name="f_sen"></td>
				</tr>
				<tr>
					<td>Filmin Imdb:</td>
					<td><input type="text" name="f_imdb"></td>
				</tr>
				<tr>
					<td>Film Bilgi:</td>
					<td><input type="text" name="f_bilgi"></td>
				</tr>
				<tr>
					<td>Film Resim:</td>
					<td><input type="file" name="f" class="k"/></td>
				</tr>
				<tr>
					<td>Film Dublajı:</td>
					<td><input type="text" name="f_dub"></td>
				</tr>
				<tr>
					<td>Film Fragman:</td>
					<td><input type="text" name="fragman"></td>
				</tr>
				<tr>
					<td>Film Embed:</td>
				<td><input type="text" name="f_embed"></td>
				</tr>
				<tr>
					<td>Film Embed2:</td>
					<td><input type="text" name="f_embed2"></td>
				</tr>
				<tr>
					<td>Film Tavsiy Et:</td>
					<td><input type="text" name="tavsiye"></td>
				</tr>
				<tr>
					<td>Film Yabancımı:</td>
					<td><input type="text" name="yabancimi"/></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="as" value="Flimi Güncelle"</td>
				</tr>
			</table>
		</form>
	</div>
<?php

if($s=="" && !is_numeric($S))header("location:adminstator.php");
$row=mysqli_fetch_array(mysqli_query($c,"select * from flim where flim_id=".$s.""));
extract($row);
?>
		<div id="image">
			<img src='<?php echo "../../images/fimages/".$resim."";?>'/>
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
	</div>
</div>
<div id="footer">
<p>Copyright © 2011 - 2015 KralFlimİzle.com kalitenin tek adresi.</p>
</div>

</body>
<?php
		require_once"../footer.php";	
			
?>