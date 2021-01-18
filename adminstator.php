

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
				<span id="y"><a id="menu_item" href="adminstator.php?sayfa=7">İstek Şikayet</a></span>
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
				<script type="text/javascript">
					function res(){
						var a=document.o.f.value;
						if(a!=""){
							var s=document.getElementById("res");
								s.src(a);
													
						}
					}
				</script>
			<div id="content">
					<?php
					$sayfa=@$_GET["sayfa"];
						if($sayfa=="" or !is_numeric($sayfa))$sayfa=1;
						switch($sayfa){
							////burası flim ekleme sayfası
							case 1:
								echo '	<div id="seklenen">
											<div id="sekyazi">Flim Ekle</div>
										</div>
										<div id="fekle">
											<form method="post" action="ekle.php" name="o" enctype="multipart/form-data">
												<table id="table1">
													<tr>
														<td>Filmin Adı:</td>
														<td><input type="text" name="f_adi"></td>
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
														<td>
															<select name="f_türü" size="1" id="osman">
																<option value="Korku">Korku</option>
																<option value="Aksiyon">Aksiyon</option>
																<option value="Komedi">Komedi</option>
																<option value="Belgesel">Belgesel</option>
																<option value="Trajedi">Trajedi</option>
																<option value="Dram">Dram</option>
																<option value="Bilim Kurgu">Bilim Kurgu</option>
																<option value="Macera">Macera</option>
																<option value="Animasyon">Animasyon</option>
															</select>
														</td>
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
														<td>Film Dublajmıı:</td>
														<td>
															Evet<input name="f_dub" type="radio" value="1" />
															Hayır<input name="f_dub" type="radio" value="0" />
														</td>
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
														<td>
															Evet<input name="tavsiye" type="radio" value="1" />
															Hayır<input name="tavsiye" type="radio" value="0" />
														</td>
													</tr>
													<tr>
														<td>Film Yabancımı:</td>
														<td>
															Evet<input name="yabancimi" type="radio" value="1" />
															Hayır<input name="yabancimi" type="radio" value="0" />
														</td>
													</tr>
													<tr>
														<td></td>
														<td><input type="submit" name="as" value="Flimi Ekle"</td>
													</tr>
												</table>
											</form>
										</div>
										
										
										';
											
							break;
							//// burası flim güncelleme sayffası
							case 2:
							echo '	<div id="seklenen">
											<div id="sekyazi">Flim Güncelle</div>
										</div>';
									$s=@$_GET["s"];
									if(empty($s)||!is_numeric($s))$s=1;
									$sorgu=mysqli_query($c,"SELECT flim_id FROM `flim` ORDER BY `fragman` DESC");
									$ksayisi=mysqli_num_rows($sorgu);
									$kacar=12;
									$sayisi=ceil($ksayisi/$kacar);
									$nerden=($s*$kacar)-$kacar;
									$say=$sayisi;
									
									
									$sorgu=mysqli_query($c,"SELECT * FROM `flim` ORDER BY `fragman` DESC limit ".$nerden.",".$kacar."");
									
									while($row=mysqli_fetch_array($sorgu)){
										extract($row);
										echo '<div id="flim">
													<a href="update.php?v='.$flim_id.'"><img src="../../images/fimages/'.$resim.'" id="yenif"></a>
													<div id="fisim">
														<a href="">'.$flim_adi.'</a>
													</div>
													<div id="izhit"><img src="../../images\symbol\izhit.png">'.$imdb.'</div>
													<div id="imdb"><img src="../../images\symbol\imdb.png">'.$izlenme.'</div>
												</div>';
									}
										##burası sayfalama divi	
									$gorunen=3;
									
									$s2=$say-1;
									if($s2==0)$s2=1;
											echo '<div id="syfsayisi"><pref id="ssayisi">Sitede '.$s2.' tane flim sayfası bulunmaktadır </pref>';
											if($s>1){
													$onceki=$s-1;
													echo "<span id='secilen'><a href='adminstator.php?sayfa=2&s=1'>ilk</a></span>";
													echo "<a href='adminstator.php?sayfa=2&s=".$onceki."'>Önceki</a>";
											}
											for($i=$s-$gorunen;$i<$s+$gorunen+1;$i++){
												if($i>0 and $i<=$say)
												echo '<a href="adminstator.php?sayfa=2&s='.$i.'" id="onlink">'.$i.'</a>';
											}
											$sonraki=0;
											if($s!=$say){
												$sonraki=$s+1;
												echo "<a href='adminstator.php?sayfa=2&s=".$sonraki."'>Sonraki</a>";
												echo "<span id='secilen'><a href='adminstator.php?sayfa=2&s=$say'>Son</a></span>";
											}
											echo '</div>';
											
							break;
							/////burası flim silme sayfası
							case 3:
							echo '	<div id="seklenen">
											<div id="sekyazi">Flim Sil</div>
										</div>';
									$s=@$_GET["s"];
									if(empty($s)||!is_numeric($s))$s=1;
									$sorgu=mysqli_query($c,"SELECT flim_id FROM `flim` ORDER BY `fragman` DESC");
									$ksayisi=mysqli_num_rows($sorgu);
									$kacar=12;
									$sayisi=ceil($ksayisi/$kacar);
									$nerden=($s*$kacar)-$kacar;
									$say=$sayisi;
									
									
									$sorgu=mysqli_query($c,"SELECT * FROM `flim` ORDER BY `fragman` DESC limit ".$nerden.",".$kacar."");
									
									while($row=mysqli_fetch_array($sorgu)){
										extract($row);
										echo '<div id="flim">
													<a href="delete.php?v='.$flim_id.'"><img src="../../images/fimages/'.$resim.'" id="yenif"></a>
													<div id="fisim">
														<a href="">'.$flim_adi.'</a>
													</div>
													<div id="izhit"><img src="../../images\symbol\izhit.png">'.$imdb.'</div>
													<div id="imdb"><img src="../../images\symbol\imdb.png">'.$izlenme.'</div>
												</div>';
									}
										##burası sayfalama divi	
									$gorunen=3;
									
									$s2=$say-1;
									if($s2==0)$s2=1;
											echo '<div id="syfsayisi"><pref id="ssayisi">Sitede '.$s2.' tane flim sayfası bulunmaktadır </pref>';
											if($s>1){
													$onceki=$s-1;
													echo "<span id='secilen'><a href='adminstator.php?sayfa=2&s=1'>ilk</a></span>";
													echo "<a href='adminstator.php?sayfa=2&s=".$onceki."'>Önceki</a>";
											}
											for($i=$s-$gorunen;$i<$s+$gorunen+1;$i++){
												if($i>0 and $i<=$say)
												echo '<a href="adminstator.php?sayfa=2&s='.$i.'" id="onlink">'.$i.'</a>';
											}
											$sonraki=0;
											if($s!=$say){
												$sonraki=$s+1;
												echo "<a href='adminstator.php?sayfa=2&s=".$sonraki."'>Sonraki</a>";
												echo "<span id='secilen'><a href='adminstator.php?sayfa=2&s=$say'>Son</a></span>";
											}
											echo '</div>';
											
							break;
							case 4:
							// yorum ekleme sayfası
							echo '	<div id="seklenen">
											<div id="sekyazi">Yorum Ekle-Sil</div>
										</div>';
									$s=@$_GET["s"];
									if(empty($s)||!is_numeric($s))$s=1;
									$sorgu=mysqli_query($c,"SELECT flim_id FROM `flim` ORDER BY `fragman` DESC");
									$ksayisi=mysqli_num_rows($sorgu);
									$kacar=12;
									$sayisi=ceil($ksayisi/$kacar);
									$nerden=($s*$kacar)-$kacar;
									$say=$sayisi;
									
									
									$sorgu=mysqli_query($c,"SELECT * FROM `flim` ORDER BY `fragman` DESC limit ".$nerden.",".$kacar."");
									
									while($row=mysqli_fetch_array($sorgu)){
										extract($row);
										echo '<div id="flim">
													<a href="comment.php?v='.$flim_id.'"><img src="../../images/fimages/'.$resim.'" id="yenif"></a>
													<div id="fisim">
														<a href="">'.$flim_adi.'</a>
													</div>
													<div id="izhit"><img src="../../images\symbol\izhit.png">'.$imdb.'</div>
													<div id="imdb"><img src="../../images\symbol\imdb.png">'.$izlenme.'</div>
												</div>';
									}
										##burası sayfalama divi	
									$gorunen=3;
									
									$s2=$say-1;
									if($s2==0)$s2=1;
											echo '<div id="syfsayisi"><pref id="ssayisi">Sitede '.$s2.' tane yorum sayfası bulunmaktadır </pref>';
											if($s>1){
													$onceki=$s-1;
													echo "<span id='secilen'><a href='adminstator.php?sayfa=2&s=1'>ilk</a></span>";
													echo "<a href='adminstator.php?sayfa=2&s=".$onceki."'>Önceki</a>";
											}
											for($i=$s-$gorunen;$i<$s+$gorunen+1;$i++){
												if($i>0 and $i<=$say)
												echo '<a href="adminstator.php?sayfa=2&s='.$i.'" id="onlink">'.$i.'</a>';
											}
											$sonraki=0;
											if($s!=$say){
												$sonraki=$s+1;
												echo "<a href='adminstator.php?sayfa=2&s=".$sonraki."'>Sonraki</a>";
												echo "<span id='secilen'><a href='adminstator.php?sayfa=2&s=$say'>Son</a></span>";
											}
											echo '</div>';
											
							break;
							case 5:
							echo '	<div id="seklenen">
											<div id="sekyazi">Slidera Flim Ekle</div>
										</div>';
									$s=@$_GET["s"];
									if(empty($s)||!is_numeric($s))$s=1;
									$sorgu=mysqli_query($c,"SELECT flim_id FROM `flim` ORDER BY `fragman` DESC");
									$ksayisi=mysqli_num_rows($sorgu);
									$kacar=12;
									$sayisi=ceil($ksayisi/$kacar);
									$nerden=($s*$kacar)-$kacar;
									$say=$sayisi;
									
									
									$sorgu=mysqli_query($c,"SELECT * FROM `flim` ORDER BY `fragman` DESC limit ".$nerden.",".$kacar."");
									
									while($row=mysqli_fetch_array($sorgu)){
										extract($row);
										echo '<div id="flim">
													<a href="ekle.php?v='.$flim_id.'"><img src="../../images/fimages/'.$resim.'" id="yenif"></a>
													<div id="fisim">
														<a href="">'.$flim_adi.'</a>
													</div>
													<div id="izhit"><img src="../../images\symbol\izhit.png">'.$imdb.'</div>
													<div id="imdb"><img src="../../images\symbol\imdb.png">'.$izlenme.'</div>
												</div>';
									}
										##burası sayfalama divi	
									$gorunen=3;
									
									$s2=$say-1;
									if($s2==0)$s2=1;
											echo '<div id="syfsayisi"><pref id="ssayisi">Sitede '.$s2.' tane flim sayfası bulunmaktadır </pref>';
											if($s>1){
													$onceki=$s-1;
													echo "<span id='secilen'><a href='adminstator.php?sayfa=2&s=1'>ilk</a></span>";
													echo "<a href='adminstator.php?sayfa=2&s=".$onceki."'>Önceki</a>";
											}
											for($i=$s-$gorunen;$i<$s+$gorunen+1;$i++){
												if($i>0 and $i<=$say)
												echo '<a href="adminstator.php?sayfa=2&s='.$i.'" id="onlink">'.$i.'</a>';
											}
											$sonraki=0;
											if($s!=$say){
												$sonraki=$s+1;
												echo "<a href='adminstator.php?sayfa=2&s=".$sonraki."'>Sonraki</a>";
												echo "<span id='secilen'><a href='adminstator.php?sayfa=2&s=$say'>Son</a></span>";
											}
											echo '</div>';
											
											
											
							break;
							case 6:
							echo '	<div id="seklenen">
											<div id="sekyazi">Slider Flim Sil</div>
										</div>';
									$s=@$_GET["s"];
									if(empty($s)||!is_numeric($s))$s=1;
									$sorgu=mysqli_query($c,"SELECT flim_id FROM `flim` ORDER BY `fragman` DESC");
									$ksayisi=mysqli_num_rows($sorgu);
									$kacar=12;
									$sayisi=ceil($ksayisi/$kacar);
									$nerden=($s*$kacar)-$kacar;
									$say=$sayisi;
									$sorgu=mysqli_query($c,"SELECT * FROM `slider` limit ".$nerden.",".$kacar."");
									while($row=mysqli_fetch_array($sorgu)){
										extract($row);
										echo '<div id="flim">
													<a href="delete.php?s='.$f_id.'"><img src="../../images/fimages/'.$resim.'" id="yenif"></a>
													<div id="fisim">
														<a href="">'.$flim_adi.'</a>
													</div>
													<div id="izhit"><img src="../../images\symbol\izhit.png">'.$imdb.'</div>
													<div id="imdb"><img src="../../images\symbol\imdb.png">'.$izlenme.'</div>
												</div>';
														
									}			
										##burası sayfalama divi	
									$gorunen=3;
									
									$s2=$say-1;
									if($s2==0)$s2=1;
											echo '<div id="syfsayisi"><pref id="ssayisi">Sitede '.$s2.' tane flim sayfası bulunmaktadır </pref>';
											if($s>1){
													$onceki=$s-1;
													echo "<span id='secilen'><a href='adminstator.php?sayfa=2&s=1'>ilk</a></span>";
													echo "<a href='adminstator.php?sayfa=6&s=".$onceki."'>Önceki</a>";
											}
											for($i=$s-$gorunen;$i<$s+$gorunen+1;$i++){
												if($i>0 and $i<=$say)
												echo '<a href="adminstator.php?sayfa=6&s='.$i.'" id="onlink">'.$i.'</a>';
											}
											$sonraki=0;
											if($s!=$say){
												$sonraki=$s+1;
												echo "<a href='adminstator.php?sayfa=6&s=".$sonraki."'>Sonraki</a>";
												echo "<span id='secilen'><a href='adminstator.php?sayfa=&s=$say'>Son</a></span>";
											}
											echo '</div>';
			
							break;
							case 7:
							
							echo '	<div id="seklenen">
											<div id="sekyazi">Slider Flim Sil</div>
										</div>';
									$s=@$_GET["s"];
									if(empty($s)||!is_numeric($s))$s=1;
									$sorgu=mysqli_query($c,"SELECT flim_id FROM `flim` ORDER BY `fragman` DESC");
									$ksayisi=mysqli_num_rows($sorgu);
									$kacar=4;
									$sayisi=ceil($ksayisi/$kacar);
									$nerden=($s*$kacar)-$kacar;
									$say=$sayisi;
									$yorumlar=mysqli_query($c,"SELECT * FROM `mesaj` limit ".$nerden.",".$kacar."");
									while($k=mysqli_fetch_array($yorumlar)){
									//yorum göstermek için döngü
										extract($k);
										echo '
												<div id="y2">
													<div id="yi">
														<p><b>'.$ad.'  </b><i>diyorki;'.$zaman.'</i><a href="delete.php?i='.$id.'" id="ca">Mesajı Sil</a></p>
													</div>
													<div id="yiy">
														<p>'.$mesaj.'</p>
													</div>
												</div>';
												
										}		
										##burası sayfalama divi	
									$gorunen=3;
									
									$s2=$say-1;
									if($s2==0)$s2=1;
											echo '<div id="syfsayisi"><pref id="ssayisi">Sitede '.$s2.' tane mesaj sayfası bulunmaktadır </pref>';
											if($s>1){
													$onceki=$s-1;
													echo "<span id='secilen'><a href='adminstator.php?sayfa=7&s=1'>ilk</a></span>";
													echo "<a href='adminstator.php?sayfa=7&s=".$onceki."'>Önceki</a>";
											}
											for($i=$s-$gorunen;$i<$s+$gorunen+1;$i++){
												if($i>0 and $i<=$say)
												echo '<a href="adminstator.php?sayfa=7&s='.$i.'" id="onlink">'.$i.'</a>';
											}
											$sonraki=0;
											if($s!=$say){
												$sonraki=$s+1;
												echo "<a href='adminstator.php?sayfa=7&s=".$sonraki."'>Sonraki</a>";
												echo "<span id='secilen'><a href='adminstator.php?sayfa=7&s=$say'>Son</a></span>";
											}
											echo '</div>';
							
			
							break;
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
	require_once '..\footer.php';
?>
