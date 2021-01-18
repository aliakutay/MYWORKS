<?php 
	require_once 'ayarlar/ayarlar.php';
?>
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
		<script>
		function a(){
			var a=document.getElementById("content");
			a.className="sscon";
		}
		
		function z(){
			var z=document.getElementById("container");
				z.className="container2";
		}
		function g(){
			var g=document.getElementById("siteson");
				g.className="siteson2";
		}
		
		</script>
		<div id="content" class="content">	
		
			 <?php
				// //iskelet oluşturma ve sayfa secimleri
				$sayfa=@$_GET["sayfa"];
				 if(empty($sayfa)||!is_numeric($sayfa))$sayfa=1;
						 switch($sayfa){
							// //index sayfası
							 case 1:
								echo '	<div id="seklenen">
										 <div id="sekyazi">Son Eklenenler</div>
									 </div>';
								 $s=@$_GET["s"];
								 if(empty($s)||!is_numeric($s))$s=1;
								 $sorgu=mysqli_query($c,"SELECT flim_id FROM `flim` ORDER BY `fragman` DESC");
								 $ksayisi=mysqli_num_rows($sorgu);
								 $kacar=24;
								 $sayisi=ceil($ksayisi/$kacar);
								 $nerden=($s*$kacar)-$kacar;
								 $say=$sayisi;
								 $sorgu=mysqli_query($c,"SELECT * FROM `flim` ORDER BY `yili` DESC limit ".$nerden.",".$kacar."");
								
								 while($row=mysqli_fetch_array($sorgu)){
									  extract($row);
									 $secim;
									 if($yabacimi==1){$secim="images\symbol\dub.png";}
									else{$secim="images\symbol\sub.png";}
									 echo '<div id="flim">
												<div class="flimdili"><a href="video.php?v='.$flim_id.'"><img src="
												'.$secim.'"/></a></div>
												 <a href="video.php?v='.$flim_id.'"><img src="images/fimages/'.$resim.'" id="yenif"></a>
												 <div id="fisim">
													 <a href="video.php?v='.$flim_id.'">'.$flim_adi.'</a>
												 </div>
												 <div id="izhit"><img src="images\symbol\izhit.png">'.$izlenme.'</div>
												 <div id="imdb"><img src="images\symbol\imdb.png">'.$imdb.'</div>
											 </div>';
								 }
									// ##burası sayfalama divi	
								$gorunen=3;
									$s2=$say-1;
									if($s2==0)$s2=1;
										echo '<div id="syfsayisi"><pref id="ssayisi">Sitede '.$s2.' tane flim sayfası bulunmaktadır </pref>';
										if($s>1){
												$onceki=$s-1;
												echo "<span id='secilen'><a href='index.php?sayfa=1&s=1'>ilk</a></span>";
												echo "<a href='index.php?sayfa=1&s=".$onceki."'>Önceki</a>";
										}
										for($i=$s-$gorunen;$i<$s+$gorunen+1;$i++){
											if($i>0 and $i<=$say)
											echo '<a href="index.php?sayfa=1&s='.$i.'" id="onlink">'.$i.'</a>';
										}
										$sonraki=0;
										if($s!=$say){
											$sonraki=$s+1;
											echo "<a href='index.php?sayfa=1&s=".$sonraki."'>Sonraki</a>";
											echo "<span id='secilen'><a href='index.php?sayfa=1&s=$say'>Son</a></span>";
										}
										echo '</div>';	
							break;
							//tavsiyelerimiz sayfası
							?>
							<?php
							case 2:
								echo '	<div id="seklenen">
										<div id="sekyazi">Tavsiyelerimiz</div>
									</div>';
								##burası cont bölümü
								$s=@$_GET["s"];
								if(empty($s)||!is_numeric($s))$s=1;
								$kayit=mysqli_num_rows(mysqli_query($c,"SELECT flim_id FROM `flim` WHERE tavsiye=1"));
								$kacar=24;
								$say=ceil($kayit/$kacar);
								$nerde=($s*$kacar)-$kacar;
								$sorgu=mysqli_query($c,"SELECT * FROM `flim` ORDER BY `yili` DESC limit ".$nerde.",".$kacar."");
								while($row=mysqli_fetch_array($sorgu)){
									 extract($row);
									 $secim;
									 if($yabacimi==1){$secim="images\symbol\dub.png";}
									else{$secim="images\symbol\sub.png";}
									 echo '<div id="flim">
												<div class="flimdili"><a href="video.php?v='.$flim_id.'"><img src="
												'.$secim.'"/></a></div>
												 <a href="video.php?v='.$flim_id.'"><img src="images/fimages/'.$resim.'" id="yenif"></a>
												 <div id="fisim">
													 <a href="video.php?v='.$flim_id.'">'.$flim_adi.'</a>
												 </div>
												 <div id="izhit"><img src="images\symbol\izhit.png">'.$izlenme.'</div>
												 <div id="imdb"><img src="images\symbol\imdb.png">'.$imdb.'</div>
											 </div>';
								}
								##burası sayfalama divi	
								$gorunen=3;
								$s2=$say-1;
								if($s2==0)$s2=1;
										echo '<div id="syfsayisi"><pref id="ssayisi">Sitede '.$s2.' tane flim sayfası bulunmaktadır </pref>';
										if($s>1){
												$onceki=$s-1;
												echo "<span id='secilen'><a href='index.php?sayfa=2&s=1'>ilk</a></span>";
												echo "<a href='index.php?sayfa=2&s=".$onceki."'>Önceki</a>";
										}
										for($i=$s-$gorunen;$i<$s+$gorunen+1;$i++){
											if($i>0 and $i<=$say)
											echo '<a href="index.php?sayfa=2&s='.$i.'" id="onlink">'.$i.'</a>';
										}
										$s2=$say-1;
										$sonraki=0;
										if($s!=$say){
											$sonraki=$s+1;
											echo "<a href='index.php?sayfa=2&s=".$sonraki."'>Sonraki</a>";
											echo "<span id='secilen'><a href='index.php?sayfa=2&s=$say'>Son</a></span>";
										}
										echo '</div>';
										
							break;	
							//ençok izlenenler sayfası
							case 3:
							echo '	<div id="seklenen">
										<div id="sekyazi">En Çok İzlenenler</div>
									</div>';
							$s=@$_GET["s"];
								if(empty($s)||!is_numeric($s))$s=1;
								$kayit=mysqli_num_rows(mysqli_query($c,"SELECT flim_id FROM `flim` order by `izlenme` desc"));
								$kacar=24;
								$say=ceil($kayit/$kacar);
								$nerde=($s*$kacar)-$kacar;
								$sorgu=mysqli_query($c,"SELECT * FROM `flim` order by `izlenme` desc limit ".$nerde.",".$kacar."");
								$secim;
								while($row=mysqli_fetch_array($sorgu)){
									 extract($row);
									 $secim;
									 if($yabacimi==1){$secim="images\symbol\dub.png";}
									else{$secim="images\symbol\sub.png";}
									 echo '<div id="flim">
												<div class="flimdili"><a href="video.php?v='.$flim_id.'"><img src="
												'.$secim.'"/></a></div>
												 <a href="video.php?v='.$flim_id.'"><img src="images/fimages/'.$resim.'" id="yenif"></a>
												 <div id="fisim">
													 <a href="video.php?v='.$flim_id.'">'.$flim_adi.'</a>
												 </div>
												 <div id="izhit"><img src="images\symbol\izhit.png">'.$izlenme.'</div>
												 <div id="imdb"><img src="images\symbol\imdb.png">'.$imdb.'</div>
											 </div>';
								}
								$gorunen=3;
								$s2=$say-1;
								if($s2==0)$s2=1;
										echo '<div id="syfsayisi"><pref id="ssayisi">Sitede '.$s2.' tane flim sayfası bulunmaktadır </pref>';
										if($s>1){
												$onceki=$s-1;
												echo "<span id='secilen'><a href='index.php?sayfa=3&s=1'>ilk</a></span>";
												echo "<a href='index.php?sayfa=3&s=".$onceki."'>Önceki</a>";
										}
										for($i=$s-$gorunen;$i<$s+$gorunen+1;$i++){
											if($i>0 and $i<=$say)
											echo '<a href="index.php?sayfa=3&s='.$i.'" id="onlink">'.$i.'</a>';
										}
										$sonraki=0;
										if($s!=$say){
											$sonraki=$s+1;
											echo "<a href='index.php?sayfa=3&s=".$sonraki."'>Sonraki</a>";
											echo "<span id='secilen'><a href='index.php?sayfa=3&s=$say'>Son</a></span>";
										}
										echo '</div>';
										
							break;
							case 4:
							echo '	<div id="seklenen">
										<div id="sekyazi">İstek flim ,Şikayet</div>
									</div>';
							echo '<script type="text/javascript">a();z();</script>';
							//iletişim sayfası
							##mesaj
							//form
							echo '<div id="mesaj">
								<form action="y.php" method="get">
									<font style="color:white">E-posta adresiniz:</font><input type="text" placeholder="Buraya E-posta adresiniz" name="madi"><font style="color:white">Adınız:</font><input type="text" placeholder="Buraya İsminizi yazın" name="madi">
									<textarea placeholder="Buraya mesajınızı yazınız!!!" style="margin: 0px; width: 550; height: 100; outline:none;" name="msg"></textarea>
									<input type="submit" value="Gönder" id="btn">
								</form>
							</div>';
							//js ile sayfayı kısaltma
							break;
							
							
							/*
							Burası Tamamen robotla alakalı
							robotla seçim yapma sıralama
							*/
							case 5:
							echo '	<div id="seklenen">
										<div id="sekyazi">Yabancı Flimler</div>
									</div>';
							$s=@$_GET["s"];
							$o=@$_GET["o"];
							$y=@$_GET["y"];
								if(empty($s)||!is_numeric($s))$s=1;
								$kayit=mysqli_num_rows(mysqli_query($c,"SELECT flim_id FROM `flim` WHERE yabacimi=1"));
								if($kayit<=0)@header("location:flim/../index.php");
								if(!empty($o)){
									$kayit=mysqli_num_rows(mysqli_query($c,"SELECT flim_id FROM `flim` WHERE yabacimi=1 and tur='".$o."' ORDER BY `yili` DESC"));
									$kacar=24;
									$say=ceil($kayit/$kacar);
									$nerde=($s*$kacar)-$kacar;
									$sorgu=mysqli_query($c,"SELECT * FROM `flim` where yabacimi=1 and tur='".$o."' ORDER BY `fragman` DESC limit ".$nerde.",".$kacar."");
									$secim;
									while($row=mysqli_fetch_array($sorgu)){
									  extract($row);
									 $secim;
									 if($yabacimi==1){$secim="images\symbol\dub.png";}
									else{$secim="images\symbol\sub.png";}
									 echo '<div id="flim">
												<div class="flimdili"><a href="video.php?v='.$flim_id.'"><img src="
												'.$secim.'"/></a></div>
												 <a href="video.php?v='.$flim_id.'"><img src="images/fimages/'.$resim.'" id="yenif"></a>
												 <div id="fisim">
													 <a href="video.php?v='.$flim_id.'">'.$flim_adi.'</a>
												 </div>
												 <div id="izhit"><img src="images\symbol\izhit.png">'.$izlenme.'</div>
												 <div id="imdb"><img src="images\symbol\imdb.png">'.$imdb.'</div>
											 </div>';
									}
									
									$gorunen=3;
									$s2=$say-1;
									if($s2==0)$s2=1;
										echo '<div id="syfsayisi"><pref id="ssayisi">Sitede '.$s2.' tane flim sayfası bulunmaktadır </pref>';
										if($s>1){
												$onceki=$s-1;
												echo "<span id='secilen'><a href='index.php?sayfa=6&s=1'>ilk</a></span>";
												echo "<a href='index.php?sayfa=6&s=".$onceki."'>Önceki</a>";
										}
										for($i=$s-$gorunen;$i<$s+$gorunen+1;$i++){
											if($i>0 and $i<=$say)
											echo '<a href="index.php?sayfa=6&s='.$i.'" id="onlink">'.$i.'</a>';
										}
										$sonraki=0;
										if($s!=$say){
											$sonraki=$s+1;
											echo "<a href='index.php?sayfa=6&s=".$sonraki."'>Sonraki</a>";
											echo "<span id='secilen'><a href='index.php?sayfa=6&s=$say'>Son</a></span>";
										}
										echo '</div>';									
								}if(!empty($y)){
									$kayit=mysqli_num_rows(mysqli_query($c,"SELECT flim_id FROM `flim` WHERE yabacimi=1 and yili=".$y." ORDER BY `izlenme` DESC"));
									$kacar=24;
									$say=ceil($kayit/$kacar);
									$nerde=($s*$kacar)-$kacar;
									$sorgu=mysqli_query($c,"SELECT * FROM `flim` where yabacimi=1 and yili=".$y." ORDER BY `izlenme` DESC limit ".$nerde.",".$kacar."");
									$secim;
									while($row=mysqli_fetch_array($sorgu)){
									  extract($row);
									 $secim;
									 if($yabacimi==1){$secim="images\symbol\dub.png";}
									else{$secim="images\symbol\sub.png";}
									 echo '<div id="flim">
												<div class="flimdili"><a href="video.php?v='.$flim_id.'"><img src="
												'.$secim.'"/></a></div>
												 <a href="video.php?v='.$flim_id.'"><img src="images/fimages/'.$resim.'" id="yenif"></a>
												 <div id="fisim">
													 <a href="video.php?v='.$flim_id.'">'.$flim_adi.'</a>
												 </div>
												 <div id="izhit"><img src="images\symbol\izhit.png">'.$izlenme.'</div>
												 <div id="imdb"><img src="images\symbol\imdb.png">'.$imdb.'</div>
											 </div>';
									}
									
									$gorunen=3;
									$s2=$say-1;
									if($s2==0)$s2=1;
										echo '<div id="syfsayisi"><pref id="ssayisi">Sitede '.$s2.' tane flim sayfası bulunmaktadır </pref>';
										if($s>1){
												$onceki=$s-1;
												echo "<span id='secilen'><a href='index.php?sayfa=6&s=1'>ilk</a></span>";
												echo "<a href='index.php?sayfa=6&s=".$onceki."'>Önceki</a>";
										}
										for($i=$s-$gorunen;$i<$s+$gorunen+1;$i++){
											if($i>0 and $i<=$say)
											echo '<a href="index.php?sayfa=6&s='.$i.'" id="onlink">'.$i.'</a>';
										}
										$sonraki=0;
										if($s!=$say){
											$sonraki=$s+1;
											echo "<a href='index.php?sayfa=6&s=".$sonraki."'>Sonraki</a>";
											echo "<span id='secilen'><a href='index.php?sayfa=6&s=$say'>Son</a></span>";
										}
										echo '</div>';	
								}
								else{
									$kayit=mysqli_num_rows(mysqli_query($c,"SELECT flim_id FROM `flim` WHERE yabacimi=1 ORDER BY `izlenme` DESC"));
									$kacar=24;
									$say=ceil($kayit/$kacar);
									$nerde=($s*$kacar)-$kacar;
									$sorgu=mysqli_query($c,"SELECT * FROM `flim` where yabacimi=1 ORDER BY `izlenme` DESC limit ".$nerde.",".$kacar."");
									while($row=mysqli_fetch_array($sorgu)){
									extract($row);
									 extract($row);
									 $secim;
									 if($yabacimi==1){$secim="images\symbol\dub.png";}
									else{$secim="images\symbol\sub.png";}
									 echo '<div id="flim">
												<div class="flimdili"><a href="video.php?v='.$flim_id.'"><img src="
												'.$secim.'"/></a></div>
												 <a href="video.php?v='.$flim_id.'"><img src="images/fimages/'.$resim.'" id="yenif"></a>
												 <div id="fisim">
													 <a href="video.php?v='.$flim_id.'">'.$flim_adi.'</a>
												 </div>
												 <div id="izhit"><img src="images\symbol\izhit.png">'.$izlenme.'</div>
												 <div id="imdb"><img src="images\symbol\imdb.png">'.$imdb.'</div>
											 </div>';
									}
									$gorunen=3;
									$s2=$say-1;
									if($s2==0)$s2=1;
										echo '<div id="syfsayisi"><pref id="ssayisi">Sitede '.$s2.' tane flim sayfası bulunmaktadır </pref>';
										if($s>1){
												$onceki=$s-1;
												echo "<span id='secilen'><a href='index.php?sayfa=5&s=1'>ilk</a></span>";
												echo "<a href='index.php?sayfa=5&s=".$onceki."'>Önceki</a>";
										}
										for($i=$s-$gorunen;$i<$s+$gorunen+1;$i++){
											if($i>0 and $i<=$say)
											echo '<a href="index.php?sayfa=5&s='.$i.'" id="onlink">'.$i.'</a>';
										}
										$sonraki=0;
										if($s!=$say){
											$sonraki=$s+1;
											echo "<a href='index.php?sayfa=5&s=".$sonraki."'>Sonraki</a>";
											echo "<span id='secilen'><a href='index.php?sayfa=5&s=$say'>Son</a></span>";
										}
										echo '</div>';
									
									
								}
										
							break;
							case 6:
							echo '	<div id="seklenen">
										<div id="sekyazi">Yerli Flimler</div>
									</div>';
								$s=@$_GET["s"];
								$o=@$_GET["o"];
								$y=@$_GET["y"];
								if(empty($s)||!is_numeric($s))$s=1;
								if(!empty($o)){
									
									$kayit=mysqli_num_rows(mysqli_query($c,"SELECT flim_id FROM flim WHERE yabacimi=0 and tur='".$o."'"));
									$kacar=24;
									$say=ceil($kayit/$kacar);
									$nerde=($s*$kacar)-$kacar;
									$sorgu=mysqli_query($c,"SELECT * FROM flim WHERE yabacimi=0 and tur='".$o."' ORDER BY yili desc limit ".$nerde.",".$kacar."");
									while($row=mysqli_fetch_array($sorgu)){
									 extract($row);
									 $secim;
									 if($yabacimi==1){$secim="images\symbol\dub.png";}
									else{$secim="images\symbol\sub.png";}
									 echo '<div id="flim">
												<div class="flimdili"><a href="video.php?v='.$flim_id.'"><img src="
												'.$secim.'"/></a></div>
												 <a href="video.php?v='.$flim_id.'"><img src="images/fimages/'.$resim.'" id="yenif"></a>
												 <div id="fisim">
													 <a href="video.php?v='.$flim_id.'">'.$flim_adi.'</a>
												 </div>
												 <div id="izhit"><img src="images\symbol\izhit.png">'.$izlenme.'</div>
												 <div id="imdb"><img src="images\symbol\imdb.png">'.$imdb.'</div>
											 </div>';
									}
									$gorunen=3;
									$s2=$say-1;
									if($s2==0)$s2=1;
										echo '<div id="syfsayisi"><pref id="ssayisi">Sitede '.$s2.' tane flim sayfası bulunmaktadır </pref>';
										if($s>1){
												$onceki=$s-1;
												echo "<span id='secilen'><a href='index.php?sayfa=6&s=1'>ilk</a></span>";
												echo "<a href='index.php?sayfa=6&s=".$onceki."'>Önceki</a>";
										}
										for($i=$s-$gorunen;$i<$s+$gorunen+1;$i++){
											if($i>0 and $i<=$say)
											echo '<a href="index.php?sayfa=6&s='.$i.'" id="onlink">'.$i.'</a>';
										}
										$sonraki=0;
										if($s!=$say){
											$sonraki=$s+1;
											echo "<a href='index.php?sayfa=6&s=".$sonraki."'>Sonraki</a>";
											echo "<span id='secilen'><a href='index.php?sayfa=6&s=$say'>Son</a></span>";
										}
										echo '</div>';
									
								}else if(!empty($y)){
									
									$kayit=mysqli_num_rows(mysqli_query($c,"SELECT flim_id FROM flim WHERE yabacimi=0 and yili=".$y." ORDER BY yili desc"));
									$kacar=24;
									$say=ceil($kayit/$kacar);
									$nerde=($s*$kacar)-$kacar;
									$sorgu=mysqli_query($c,"SELECT * FROM flim WHERE yabacimi=0 and yili=".$y." ORDER BY yili desc limit ".$nerde.",".$kacar."");
									while($row=mysqli_fetch_array($sorgu)){
									 extract($row);
									 $secim;
									 if($yabacimi==1){$secim="images\symbol\dub.png";}
									else{$secim="images\symbol\sub.png";}
									 echo '<div id="flim">
												<div class="flimdili"><a href="video.php?v='.$flim_id.'"><img src="
												'.$secim.'"/></a></div>
												 <a href="video.php?v='.$flim_id.'"><img src="images/fimages/'.$resim.'" id="yenif"></a>
												 <div id="fisim">
													 <a href="video.php?v='.$flim_id.'">'.$flim_adi.'</a>
												 </div>
												 <div id="izhit"><img src="images\symbol\izhit.png">'.$izlenme.'</div>
												 <div id="imdb"><img src="images\symbol\imdb.png">'.$imdb.'</div>
											 </div>';
									}
									$gorunen=3;
									$s2=$say-1;
									if($s2==0)$s2=1;
										echo '<div id="syfsayisi"><pref id="ssayisi">Sitede '.$s2.' tane flim sayfası bulunmaktadır </pref>';
										if($s>1){
												$onceki=$s-1;
												echo "<span id='secilen'><a href='index.php?sayfa=6&s=1'>ilk</a></span>";
												echo "<a href='index.php?sayfa=6&s=".$onceki."'>Önceki</a>";
										}
										for($i=$s-$gorunen;$i<$s+$gorunen+1;$i++){
											if($i>0 and $i<=$say)
											echo '<a href="index.php?sayfa=6&s='.$i.'" id="onlink">'.$i.'</a>';
										}
										$sonraki=0;
										if($s!=$say){
											$sonraki=$s+1;
											echo "<a href='index.php?sayfa=6&s=".$sonraki."'>Sonraki</a>";
											echo "<span id='secilen'><a href='index.php?sayfa=6&s=$say'>Son</a></span>";
										}
										echo '</div>';
								}
								
								else{
									$kayit=mysqli_num_rows(mysqli_query($c,"SELECT flim_id FROM `flim` WHERE yabacimi=0"));
									$kacar=24;
									$say=ceil($kayit/$kacar);
									$nerde=($s*$kacar)-$kacar;
									$sorgu=mysqli_query($c,"SELECT * FROM `flim` where yabacimi=0 ORDER BY `yili` desc limit ".$nerde.",".$kacar."");
									while($row=mysqli_fetch_array($sorgu)){
									 extract($row);
									 $secim;
									 if($yabacimi==1){$secim="images\symbol\dub.png";}
									else{$secim="images\symbol\sub.png";}
									 echo '<div id="flim">
												<div class="flimdili"><a href="video.php?v='.$flim_id.'"><img src="
												'.$secim.'"/></a></div>
												 <a href="video.php?v='.$flim_id.'"><img src="images/fimages/'.$resim.'" id="yenif"></a>
												 <div id="fisim">
													 <a href="video.php?v='.$flim_id.'">'.$flim_adi.'</a>
												 </div>
												 <div id="izhit"><img src="images\symbol\izhit.png">'.$izlenme.'</div>
												 <div id="imdb"><img src="images\symbol\imdb.png">'.$imdb.'</div>
											 </div>';
									}
									$gorunen=3;
									$s2=$say-1;
									if($s2==0)$s2=1;
										echo '<div id="syfsayisi"><pref id="ssayisi">Sitede '.$s2.' tane flim sayfası bulunmaktadır </pref>';
										if($s>1){
												$onceki=$s-1;
												echo "<span id='secilen'><a href='index.php?sayfa=6&s=1'>ilk</a></span>";
												echo "<a href='index.php?sayfa=6&s=".$onceki."'>Önceki</a>";
										}
										for($i=$s-$gorunen;$i<$s+$gorunen+1;$i++){
											if($i>0 and $i<=$say)
											echo '<a href="index.php?sayfa=6&s='.$i.'" id="onlink">'.$i.'</a>';
										}
										$sonraki=0;
										if($s!=$say){
											$sonraki=$s+1;
											echo "<a href='index.php?sayfa=6&s=".$sonraki."'>Sonraki</a>";
											echo "<span id='secilen'><a href='index.php?sayfa=6&s=$say'>Son</a></span>";
										}
										echo '</div>';
									
									
								}
							break;
							case 7:
							echo '	<div id="seklenen">
										<div id="sekyazi">Oyuncular</div>
									</div>';
							$s=@$_GET["s"];
							$o=@$_GET["o"];
								if(empty($s)||!is_numeric($s))$s=1;
								if(!empty($o)){
									$kayit=mysqli_num_rows(mysqli_query($c,"SELECT flim_id FROM `flim` WHERE oyuncu='".$o."' "));
									$kacar=24;
									$say=ceil($kayit/$kacar);
									$nerde=($s*$kacar)-$kacar;
									$sorgu=mysqli_query($c,"SELECT * FROM `flim` where oyuncu='".$o."' ORDER BY `yili` DESC limit ".$nerde.",".$kacar."");
									while($row=mysqli_fetch_array($sorgu)){
									  extract($row);
									 $secim;
									 if($yabacimi==1){$secim="images\symbol\dub.png";}
									else{$secim="images\symbol\sub.png";}
									 echo '<div id="flim">
												<div class="flimdili"><a href="video.php?v='.$flim_id.'"><img src="
												'.$secim.'"/></a></div>
												 <a href="video.php?v='.$flim_id.'"><img src="images/fimages/'.$resim.'" id="yenif"></a>
												 <div id="fisim">
													 <a href="video.php?v='.$flim_id.'">'.$flim_adi.'</a>
												 </div>
												 <div id="izhit"><img src="images\symbol\izhit.png">'.$izlenme.'</div>
												 <div id="imdb"><img src="images\symbol\imdb.png">'.$imdb.'</div>
											 </div>';
									}
									$gorunen=3;
									$s2=$say-1;
									if($s2==0)$s2=1;
										echo '<div id="syfsayisi"><pref id="ssayisi">Sitede '.$s2.' tane flim sayfası bulunmaktadır </pref>';
										if($s>1){
												$onceki=$s-1;
												echo "<span id='secilen'><a href='index.php?sayfa=7&s=1'>ilk</a></span>";
												echo "<a href='index.php?sayfa=7&s=".$onceki."'>Önceki</a>";
										}
										for($i=$s-$gorunen;$i<$s+$gorunen+1;$i++){
											if($i>0 and $i<=$say)
											echo '<a href="index.php?sayfa=7&s='.$i.'" id="onlink">'.$i.'</a>';
										}
										$sonraki=0;
										if($s!=$say){
											$sonraki=$s+1;
											echo "<a href='index.php?sayfa=7&s=".$sonraki."'>Sonraki</a>";
											echo "<span id='secilen'><a href='index.php?sayfa=7&s=$say'>Son</a></span>";
										}
										echo '</div>';
									
								}else{
									$kayit=mysqli_num_rows(mysqli_query($c,"SELECT flim_id FROM `flim` ORDER BY `oyuncu` DESC"));
									$kacar=24;
									$say=ceil($kayit/$kacar);
									$nerde=($s*$kacar)-$kacar;
									$sorgu=mysqli_query($c,"SELECT * FROM `flim` ORDER BY `oyuncu` DESC limit ".$nerde.",".$kacar."");
									while($row=mysqli_fetch_array($sorgu)){
									 extract($row);
									 $secim;
									 if($yabacimi==1){$secim="images\symbol\dub.png";}
									else{$secim="images\symbol\sub.png";}
									 echo '<div id="flim">
												<div class="flimdili"><a href="video.php?v='.$flim_id.'"><img src="
												'.$secim.'"/></a></div>
												 <a href="video.php?v='.$flim_id.'"><img src="images/fimages/'.$resim.'" id="yenif"></a>
												 <div id="fisim">
													 <a href="video.php?v='.$flim_id.'">'.$flim_adi.'</a>
												 </div>
												 <div id="izhit"><img src="images\symbol\izhit.png">'.$izlenme.'</div>
												 <div id="imdb"><img src="images\symbol\imdb.png">'.$imdb.'</div>
											 </div>';
									}
									$gorunen=3;
									$s2=$say-1;
									if($s2==0)$s2=1;
										echo '<div id="syfsayisi"><pref id="ssayisi">Sitede '.$s2.' tane flim sayfası bulunmaktadır </pref>';
										if($s>1){
												$onceki=$s-1;
												echo "<span id='secilen'><a href='index.php?sayfa=7&s=1'>ilk</a></span>";
												echo "<a href='index.php?sayfa=7&s=".$onceki."'>Önceki</a>";
										}
										for($i=$s-$gorunen;$i<$s+$gorunen+1;$i++){
											if($i>0 and $i<=$say)
											echo '<a href="index.php?sayfa=7&s='.$i.'" id="onlink">'.$i.'</a>';
										}
										$sonraki=0;
										if($s!=$say){
											$sonraki=$s+1;
											echo "<a href='index.php?sayfa=7&s=".$sonraki."'>Sonraki</a>";
											echo "<span id='secilen'><a href='index.php?sayfa=7&s=$say'>Son</a></span>";
										}
										echo '</div>';
									
									
								}
							break;
							
						}
						
							
			?>
			
			
				
			
		</div>
		<div id="menu2">
		
				
				
				<div id="holder">
					<ul id="tab">
						<li><a href="index.php?sayfa=5&r=1" id="q1" class="z1" value="birinci">Yabancı Flimler</a></li>
						<li><a href="index.php?sayfa=6&r=2" id="q2" class="z1">Yerli Flimler</a></li>
						<li><a href="index.php?sayfa=7&r=3" id="q3" class="z1" value="sonuncu">Oyuncular</a></li>
					</ul>
				</div>
				<?php 
					$r=@$_GET["r"];
					if(empty($r)){
						$r=1;
					}
					if(!empty($r)&&!empty($sayfa)){
							switch($r){
							case 1:
							$sorgu=mysqli_query($c,"SELECT Distinct(tur)FROM `flim` WHERE `yabacimi`=1 ORDER BY `yili` desc");
							while($row=mysqli_fetch_array($sorgu)){
								 extract($row);
								 echo '<div id="ara2"><img src="images/symbol/sag.png"/><a href="index.php?sayfa=5&r=1&o='.$tur.'">'.ucwords($tur).'</a></div>';
							}
							$sorgu2=mysqli_query($c,"SELECT Distinct(yili)FROM `flim` WHERE `yabacimi`=1 ORDER BY `yili` DESC");
							while($row=mysqli_fetch_array($sorgu2)){
								 extract($row);
								 echo '<div id="ara2"><img src="images/symbol/sag.png"/><a href="index.php?sayfa=5&r=1&y='.$yili.'">'.$yili.'</a></div>';
							}
							echo '<script type="text/javascript">
											s1();
										</script>';
							break;
							if($r!=1)echo '<script type="text/javascript">
											m1();
										</script>';
							case 2:
							$sorgu=mysqli_query($c,"SELECT Distinct(tur) FROM `flim` WHERE `yabacimi`=0 ORDER BY `tur` DESC");
							while($row=mysqli_fetch_array($sorgu)){
								 extract($row);
								 echo '<div id="ara2"><img src="images/symbol/sag.png"/><a href="index.php?sayfa=6&r=2&o='.$tur.'">'.ucwords($tur).'</a></div>';
							}
							$sorgu2=mysqli_query($c,"SELECT Distinct(yili) FROM `flim` WHERE `yabacimi`=0 ORDER BY `yili` DESC");
							while($row=mysqli_fetch_array($sorgu2)){
								 extract($row);
								 echo '<div id="ara2"><img src="images/symbol/sag.png"/><a href="index.php?sayfa=6&r=2&y='.$yili.'">'.$yili.'</a></div>';
							}
							echo '<script type="text/javascript">
											s2();
										</script>';
							break;
							if($r!=2)echo '<script type="text/javascript">
											m2();
										</script>';
							break;
							case 3:
							$sorgu=mysqli_query($c,"SELECT distinct(oyuncu) FROM `flim` ORDER BY `fragman` DESC");
							while($row=mysqli_fetch_array($sorgu)){
								 extract($row);
								 echo '<div id="ara2"><img src="images/symbol/sag.png"/><a href="index.php?sayfa=7&r=3&o='.$oyuncu.'">'.ucwords($oyuncu).'</a></div>';
							}
							echo '<script type="text/javascript">
											s3();
										</script>';
							break;
							if($r!=3)echo '<script type="text/javascript">
											m3();
										</script>';
							break;
						}
					}
					
					
				?>
		</div>
		<div id="yorum">
			<div id="yyazi">
				<p id="sekyazi2">Son Yorumlar</p>
			</div>
				<?php
				$sorgu=mysqli_query($c,"SELECT * FROM `yorum` ORDER BY `yorum`.`zaman` DESC limit 0,5");
				while($row=mysqli_fetch_array($sorgu)){
					extract($row);
					$say=strlen($text);
					echo '
				<div id="yorumisim">
					<p><b>'.$y_adi.'</b> <i>Diyorki;</i></p>
					</div>
					<div id="text">	
					<p>';
					if($say>255){
					$t=substr($text,0,255);
					echo $t."...<a href='video.php?v=".$f_id."' style='color:white;text-decoration:none;'>Devamı</a></p>
					
				</div>';";
					}else{
						echo $text."</p></div>";
					}
				}
				?>
			
			
		</div>
		<div id="siteson" class="siteson">
		<?php
			if($sayfa==4){
				echo'<script>g();</script>
				';
			}
		?>
		<h2>Film izle</h2>,<i> Hd film izle, Tek parça izle</i>
		
		<p>KralFlimİzle.com isimli film sitesinde bulunan film, film özetleri, film fragmanları ve diğer tüm videolar çeşitli sosyal paylaşım sitelerinden alınmaktadır. Sitemiz; vk.com, facebook.com, google.com, youtube.com Mail.ru gibi sitelerde paylaşılan içerikleri yayınlamaktadır.Bu nedenden dolayı KralFlimİzle.com sitesi hiç bir şekilde yasal hükümlülükle tabi tutulamaz.Telif hakları sahibi iseniz içeriğinizin kaldırılması için iletişim formunu kullanabilirsiniz.</p>
		</div>
		<div id="footer">
			<p>Copyright © 2011 - 2015 KralFlimİzle.com kalitenin tek adresi.</p>
		</div>
		
	</div>
		
		
</body>