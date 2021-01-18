<?php 
	include 'ayarlar/ayarlar.php';
?>
<body>
	<div id="container">
		<div id="banner">
			<div id="logo"></div>
			<div id="reklam"></div>
		</div>
		<div id="ara"></div>
		<div id="menu">
			<span id="y"><a id="menu_item" href="index.php">KralFlimİzle Sitesi</a></span>
			<span id="y"><a id="menu_item" href="#">Box Flimler</a></span>
			<span id="y"><a id="menu_item" href="#">Tavsiyelerimiz</a></span>
			<span id="y"><a id="menu_item" href="#">En Çok İzlenenler</a></span>
			<span id="y"><a id="menu_item" href="#">İletişim</a></span>
			
		</div>
		<div id="arama">
			<span id="yazi"><h3>Arama</h3></span>
			<input type="text" value="Aramak istediğiniz flim yada oyuncu" id="kutu"/>
			<input type="submit" value="Ara" id="button"/>
		</div>
		<div id="smenu">
			<div id="slider">
				<div class="fbox">
					<a class="resim-1" href="1"><img src="images\fimages\5.-Dalga.jpg"></a>
					<a class="resim-2" href="2"><img src="images\fimages\Admiral.jpg"></a>
					<a class="resim-3" href="3"><img src="images\fimages\Antboy-3.jpg"></a>
					<a class="resim-4" href="4"><img src="images\fimages\Asla-Pes-Etme-3.jpg"></a>
					<a class="resim-5" href="5"><img src="images\fimages\Creed.jpg"></a>
					<a class="resim-6" href="6"><img src="images\fimages\Deadpool.jpg"></a>
					<a class="resim-7" href="7"><img src="images\fimages\Ejder-Kılıcı.jpg"></a>
					<a class="resim-8" href="8"><img src="images\fimages\Heist.jpg"></a>
					<a class="resim-9" href="9"><img src="images\fimages\Kaptan-Amerika.jpg"></a>
					<a class="resim-10" href="10"><img src="images\fimages\Kung-Fu-Panda-3.jpg"></a>
					<a class="resim-11" href="11"><img src="images\fimages\London-Has-Fallen.jpg"></a>
					<a class="resim-12" href="12"><img src="images\fimages\The-Revenant.jpg"></a>
					<a class="resim-13" href="13"><img src="images\fimages\X-Men-Kıyamet.jpg"></a>
					<a class="resim-14" href="14"><img src="images\fimages\Zootropolis.jpg"></a>
					<a class="resim-15" href="15"><img src="images\fimages\Zor-Saatler.jpg"></a>
				</div>
			</div>
		</div>
		<div id="ara"></div>
		<div id="content">
			<div id="seklenen">
				<div id="sekyazi">Son Eklenenler</div>
			</div>		
			<?php 
					
					$sayfa=@$_GET["s"];
					if(empty($sayfa)||!is_numeric($sayfa)){
						$sayfa=1;
					}
					$kacar=24;
					$ksayisi=mysqli_num_rows(mysqli_query($c,'select flim_id from flim'));
					$sayfasayisi=ceil($sayfa/$kacar);
					$nereden=($sayfa*$kacar)-$kacar;
					$sorgu=mysqli_query($c,'select * from flim limit '.$nereden.','.$kacar.'');
			while($row=mysqli_fetch_array($sorgu)){
			?>			
			<div id="flim">
				<a href="video.php?v=<?php echo $row["flim_id"]?>"><img src="images\fimages\<?php echo $row["resim"]?>" id="yenif"></a>
				<div id="fisim">
					<a href="video.php?v=<?php echo $row["flim_id"]?>"><?php echo $row["flim_adi"]?></a>
				</div>
				<div id="izhit"><img src="images\symbol\izhit.png">555</div>
				<div id="imdb"><img src="images\symbol\imdb.png">444</div>
			</div>
			<?php
			}
			?>
				
			<div id="syfsayisi">
				
				
				<pref id="ssayisi">Sitede <?php echo $sayfasayisi?> tane flim sayfası bulunmaktadır </pref>
				<?php 
					for($i=0;$i<$sayfasayisi;$i++){
						
						echo '<a href="index.php?s='.$i.'" id="onlink">'.$i.'</a>';
					}
				?>
			</div>
		</div>
		<div id="menu2">
		
				<div id="sira">
					<div id="sekyazi2">Flim Robotu
					</div>
				
				</div>
				
				<div id="holder">
					<ul>
						<li><a href="index.php?r=1" id="onlink">Yabancı</a></li>
						<li><a href="index.php?r=2">Yerli</a></li>
						<li><a href="index.php?r=3">Oyuncu</a></li>
					</ul>
				</div>
				<?php 
					$r=@$_GET["r"];
					/*if($r=""||!is_numeric($r)){
						$r=1;
					}*/
					if(@$_GET["r"]){
							switch($r){
							case 1:
							$sorgu=mysqli_query($c,"SELECT tur FROM `flim` WHERE `yabacimi`=1 ORDER BY `fragman` DESC");
							while($row=mysqli_fetch_array($sorgu)){
								 extract($row);
								 echo '<div id="ara2"><img src="images/symbol/sag.png"/><a href="">'.$tur.'</a></div>';
							}
							break;
							case 2:
							$sorgu=mysqli_query($c,"SELECT tur FROM `flim` WHERE `yabacimi`=0 ORDER BY `fragman` DESC");
							while($row=mysqli_fetch_array($sorgu)){
								 extract($row);
								 echo '<div id="ara2"><img src="images/symbol/sag.png"/><a href="">'.$tur.'</a></div>';
							}
							break;
							case 3:
							$sorgu=mysqli_query($c,"SELECT oyuncu FROM `flim` ORDER BY `fragman` DESC");
							while($row=mysqli_fetch_array($sorgu)){
								 extract($row);
								 echo '<div id="ara2"><img src="images/symbol/sag.png"/><a href="">'.$oyuncu.'</a></div>';
							}
						}
					}
					
					
				?>
				
				
				<div id="ara2"><img src="images/symbol/sag.png"/><a href="">AAAAAAAA</a></div>
				<div id="ara2"><img src="images/symbol/sag.png"/><a href="">AAAAAAAA</a></div>
		</div>
		<div id="yorum">
			<div id="yyazi">
				<p id="sekyazi2">Yorumlar</p>
			</div>
				<?php
				$sorgu=mysqli_query($c,"SELECT * FROM `yorum` ORDER BY `yorum`.`zaman` DESC limit 0,5");
				while($row=mysqli_fetch_array($sorgu)){
					extract($row);
					echo '
				<div id="yorumisim">
					<img src="images/symbol/yorum.png">
					<p>'.$y_adi.'</p>
					</div>
					<div id="text">	
					<p>'.$text.'</p>
					
				</div>';
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