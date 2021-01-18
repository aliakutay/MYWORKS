	<?php>

	echo '	<div id="seklenen">
										<div id="sekyazi">Arama Sonuçları</div>
									</div>';
							$s=@$_GET["s"];
								if(empty($s)||!is_numeric($s))$s=1;
								if(!empty($o)){
									$kayit=mysqli_num_rows(mysqli_query($c,"SELECT flim_id FROM `flim` WHERE oyuncu='$o' ORDER BY `oyuncu` DESC"));
									$kacar=24;
									$say=ceil($kayit/$kacar);
									$nerde=($s*$kacar)-$kacar;
									$sorgu=mysqli_query($c,"SELECT * FROM `flim` where flim_adi like '*$o*' or oyuncu like '*$o*' or yili like '*$o*' or tur like '*$o*' or yonetmen like '*$o*' or senarist like '*$o*' or bilgi like '*$o*'  ORDER BY `oyuncu` DESC limit ".$nerde.",".$kacar."");
									while($row=mysqli_fetch_array($sorgu)){
									extract($row);
									echo'
									<div id="flim">
												<a href="video.php?v='.$flim_id.'"><img src="images/fimages/'.$resim.'" id="yenif"></a>
												<div id="fisim">
													<a href="">'.$flim_adi.'</a>
												</div>
												<div id="izhit"><img src="images\symbol\izhit.png">555</div>
												<div id="imdb"><img src="images\symbol\imdb.png">444</div>
											</div>';
									}
									$gorunen=3;
									$s2=$say-1;
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
									
								}else{
									$kayit=mysqli_num_rows(mysqli_query($c,"SELECT flim_id FROM `flim` WHERE yabacimi=1 ORDER BY `fragman` DESC"));
									$kacar=24;
									$say=ceil($kayit/$kacar);
									$nerde=($s*$kacar)-$kacar;
									$sorgu=mysqli_query($c,"SELECT * FROM `flim` ORDER BY `fragman` DESC limit ".$nerde.",".$kacar."");
									while($row=mysqli_fetch_array($sorgu)){
									extract($row);
									echo'
									<div id="flim">
												<a href="video.php?v='.$flim_id.'"><img src="images/fimages/'.$resim.'" id="yenif"></a>
												<div id="fisim">
													<a href="">'.$flim_adi.'</a>
												</div>
												<div id="izhit"><img src="images\symbol\izhit.png">555</div>
												<div id="imdb"><img src="images\symbol\imdb.png">444</div>
											</div>';
									}
									$gorunen=3;
									$s2=$say-1;
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
			?>