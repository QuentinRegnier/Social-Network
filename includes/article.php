<?php 
include 'database.php';
		global $db;
include 'database_profile.php';
global $pro_bdd;
$publications =$db->query('SELECT * FROM publications ORDER BY id DESC LIMIT 60');
while($pub = $publications->fetch()) { 
	$stmt1 = $pro_bdd->prepare('SELECT * FROM users WHERE use_code = :id_user');
	$stmt1->execute(array('id_user' => $pub['user']));
	$resultat1 = $stmt1->fetch();
	?>
	<div class="aff_pub_div_content" id="<?=$pub['id']?>">
		<div style="height: 52px;">
			<div id="info-<?=$pub['id']?>" style="display: none;"><?=$pub['tmp_code']?></div>
			<div onclick="window.location.href = '<?=$resultat1['pseudo']?>';" style="cursor:pointer;position: absolute;height: 50px;width: 180px;"><img class="nonSelectionnable" height="48px" width="48px" src="img_user/<?= $pub['user'] ?>_pp.png" style="float: left; margin-left: 16px;border-radius: 24;"/>
			<label class="nonSelectionnable" id="label-pseudo-<?=$pub['id']?>" style="float: left; margin-left: 8px;margin-top: 12px;font-size: 20px;cursor:pointer;"><?=$resultat1['pseudo']?></label></div>
			<a class="button-edit nonSelectionnable" onclick="hide_edit_panel(<?= $pub['id'] ?>, '<?= $pub['user'] ?>')" style="text-decoration: none; color: #807c7cc4; margin-right: 20px; font-size: 12.6px; float: right; cursor: pointer;">●●●</a>
		</div>
		<div style="display:none" id="creation_date_<?=$pub['id']?>"><?=$pub['create_date']?></div>
		<?php
	if($pub['numberofimg'] != null){
		?>
		<div class="nonSelectionnable">
			<?php
			if($pub['numberofimg'] >= 1){
				if(isset($pub['Content_Type_one'])){
					if(!empty($pub['Content_Type_one'])){
						if($pub['Content_Type_one'] == 1){
							$ContentTypeonepub = ".gif";
						}
						elseif($pub['Content_Type_one'] == 2){
							$ContentTypeonepub = ".jpeg";
						}
						elseif($pub['Content_Type_one'] == 3 || $pub['Content_Type_one'] == 4){
							$ContentTypeonepub = ".png";
						}
						else{
							// report crash to txt
						}
					}
				}
			}
			if($pub['numberofimg'] >= 2){
				if(isset($pub['Content_Type_two'])){
					if(!empty($pub['Content_Type_two'])){
						if($pub['Content_Type_two'] == 1){
							$ContentTypetwopub = ".gif";
						}
						elseif($pub['Content_Type_two'] == 2){
							$ContentTypetwopub = ".jpeg";
						}
						elseif($pub['Content_Type_two'] == 3 || $pub['Content_Type_two'] == 4){
							$ContentTypetwopub = ".png";
						}
						else{
							// report crash to txt
						}
					}
				}
			}
			if($pub['numberofimg'] >= 3){
				if(isset($pub['Content_Type_three'])){
					if(!empty($pub['Content_Type_three'])){
						if($pub['Content_Type_three'] == 1){
							$ContentTypethreepub = ".gif";
						}
						elseif($pub['Content_Type_three'] == 2){
							$ContentTypethreepub = ".jpeg";
						}
						elseif($pub['Content_Type_three'] == 3 || $pub['Content_Type_three'] == 4){
							$ContentTypethreepub = ".png";
						}
						else{
							// report crash to txt
						}
					}
				}
			}							    	
			if($pub['numberofimg'] == 4){
				if(isset($pub['Content_Type_four'])){
					if(!empty($pub['Content_Type_four'])){
						if($pub['Content_Type_four'] == 1){
							$ContentTypefourpub = ".gif";
						}
						elseif($pub['Content_Type_four'] == 2){
							$ContentTypefourpub = ".jpeg";
						}
						elseif($pub['Content_Type_four'] == 3 || $pub['Content_Type_four'] == 4){
							$ContentTypefourpub = ".png";
						}
						else{
							// report crash to txt
						}
					}
				}
			}
			?>





			<figure id="content_img_figure_<?=$pub['id']?>">
					<div id="container_img_prem_<?=$pub['id']?>" class="container_img_pub" title="<?=$pub['numberofimg']?>">
					    <div class="slider" style="width:500px;height:500px;" id="container_img_sev_<?=$pub['id']?>">
							<img id="slide1" src="../img_pub/<?=$pub['img_pub']?>_1<?=$ContentTypeonepub?>" class="img-<?=$pub['tmp_code']?> slide1 active img-1-<?=$pub['id']?>" height="560px" width="560px" title="<?=$pub['id']?>"/>
							<?php 
							if($pub['numberofimg'] == 2){
								?>
							<img id="slide2" src="../img_pub/<?=$pub['img_pub']?>_2<?=$ContentTypetwopub?>" class="img-<?=$pub['tmp_code']?> slide2 img-2-<?=$pub['id']?>" style="" height="560px" width="560px" title="<?=$pub['id']?>"/>
								<?php
							}
							elseif($pub['numberofimg'] == 3){
								?>
							<img id="slide2" src="../img_pub/<?=$pub['img_pub']?>_2<?=$ContentTypetwopub?>" class="img-<?=$pub['tmp_code']?> slide2 " style="" height="560px" width="560px" title="<?=$pub['id']?>"/>
							<img id="slide3" src="../img_pub/<?=$pub['img_pub']?>_3<?=$ContentTypethreepub?>" class="img-<?=$pub['tmp_code']?> slide3 img-3-<?=$pub['id']?>" style="" height="560px" width="560px" title="<?=$pub['id']?>"/>
								<?php
							}
							elseif($pub['numberofimg'] == 4){
								?>
							<img id="slide2" src="../img_pub/<?=$pub['img_pub']?>_2<?=$ContentTypetwopub?>" class="img-<?=$pub['tmp_code']?> slide2 img-2-<?=$pub['id']?>" style="" height="560px" width="560px" title="<?=$pub['id']?>"/>
							<img id="slide3" src="../img_pub/<?=$pub['img_pub']?>_3<?=$ContentTypethreepub?>" class="img-<?=$pub['tmp_code']?> slide3 img-3-<?=$pub['id']?>" style="" height="560px" width="560px" title="<?=$pub['id']?>"/>
							<img id="slide4" src="../img_pub/<?=$pub['img_pub']?>_4<?=$ContentTypefourpub?>" class="img-<?=$pub['tmp_code']?> slide4 img-4-<?=$pub['id']?>" style="" height="560px" width="560px" title="<?=$pub['id']?>"/>
								<?php
							}
							?>
					    </div>
					    <?php
					    	if($pub['numberofimg'] >= 2){
					    ?>
					    <div class="cont-btn" id="cont-btn-<?=$pub['id']?>">
					      <div class="btn-nav left"><a onclick="slidePrecedente('img.img-<?=$pub['tmp_code']?>',<?=$pub['numberofimg']?>,'img-<?=$pub['tmp_code']?>');" class="onclik_btn_nav_aff_comu-pub"><img src="IMG/before2.png" height="26px" width="26px"/></a></div>
					      <div class="btn-nav right"><a onclick="slideSuivante('img.img-<?=$pub['tmp_code']?>',<?=$pub['numberofimg']?>,'img-<?=$pub['tmp_code']?>');" class="onclik_btn_nav_aff_comu-pub"><img src="IMG/next2.png" height="26px" width="26px"/></a></div>
					    </div>
					    <?php
					    	}
						?>
					</div>
					<style type="text/css">
						.container_img_pub {
						  width: 560px;
						  margin-left: 0px;
						  height: 560px;
						}
						.cont-btn {
						  width: 560px;
						  height: auto;
						  display: flex;
						  justify-content: space-between;
						  position: absolute;
						  margin-top: -246px;
						}
						.onclik_btn_nav_aff_comu-pub{
							height: 26px;
							display: flex;
						}
					</style>
				</figure>
		</div>
		<?php
	}
		?>
		<div>
			<p class="text_pub_aff" id="<?="content_".$pub['id']?>">
				<?php 
				$pub_content = $pub['content'];
				$pub_content = htmlspecialchars($pub_content, ENT_HTML5);
				$pub_content = nl2br($pub_content);
				echo($pub_content);
				?>	
			</p>
		</div>
		<div style="background-color:#d6d6dd;height:1px;width:96%;margin-top:10px; margin-right:auto;margin-left:auto;"></div>
		<div style="text-align: left;" class="nonSelectionnable">
			<ul style="margin-top: 6px; margin-left: 20px">
				<li class="exp_article" style="margin-right: 6px">
					<div style="height: 30px;width: 30px;" class="like_article phpdecidelikecolordiv-<?=$pub['id']?>">
						<a style="cursor: pointer;" onclick='like_db(3,"<?=$pub['tmp_code']?>");'>
							<svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 1280.000000 1244.000000" preserveAspectRatio="xMidYMid meet">
								<metadata>
								Created by potrace 1.15, written by Peter Selinger 2001-2017
								</metadata>
								<g transform="translate(0.000000,1244.000000) scale(0.100000,-0.100000)"
								fill="#000000">
								<path d="M3595 10494 c-16 -2 -73 -9 -125 -15 -785 -89 -1525 -534 -1950
								-1172 -505 -756 -581 -1802 -203 -2762 234 -592 615 -1136 1223 -1746 440
								-440 761 -713 1790 -1521 723 -568 973 -780 1280 -1088 285 -285 475 -527 591
								-753 24 -48 46 -87 49 -87 3 0 20 29 38 65 150 304 458 666 907 1066 253 225
								441 378 1130 919 900 707 1207 970 1640 1404 468 469 775 866 1023 1321 414
								761 537 1622 342 2391 -112 440 -324 822 -635 1143 -523 540 -1245 841 -2014
								841 -899 0 -1671 -412 -2116 -1130 -112 -182 -234 -457 -288 -651 -21 -74 -37
								-101 -37 -61 0 45 -109 334 -184 487 -367 749 -1011 1208 -1876 1335 -75 11
								-528 22 -585 14z" style="stroke: #000;stroke-width: 860px;" id="like-div-<?=$pub['tmp_code']?>" class="state_like_<?=$pub['tmp_code']?>"/>
								</g>
							</svg>
						</a>
					</div>
				</li>
				<?php 

					$likepub = $db->prepare('SELECT * FROM like_pub WHERE pub = :pub AND user = :user');
					$likepub->execute([
						'user' => 3,
						'pub' => $pub['tmp_code']
					]);
					if($likepub->rowCount() == 1) {
					?> 
					<style type="text/css">
						.state_like_<?=$pub['tmp_code']?>{
							fill: red;
						}
					</style>
					<?php
					}
					else{
					?>
					<style type="text/css">
						.state_like_<?=$pub['tmp_code']?>{
							fill: white;
						}
					</style>
					<?php
					}

				?>
				<li class="exp_article" style="color: black;font-size: 24px;font-family: 'Oswald', sans-serif;;vertical-align: top;margin-top: -3px; margin-right: 16px;" id="likepart-<?=$pub['tmp_code']?>"><?php $idpublike = $pub['tmp_code'];$likerecup = $db->prepare('SELECT * FROM like_pub WHERE pub = :id');$likerecup->execute(['id' => $idpublike]);$likecount = $likerecup->rowCount();echo $likecount;?></li>
				<li class="exp_article">
					<div style="background-color:white;height: 30px;width: 30px;" class="comment_article">
						<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" width="35px" height="30px" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 443.541 443.541" xml:space="preserve">
							<g>
								<g>
									<path d="M76.579,433.451V335.26C27.8,300.038,0,249.409,0,195.254C0,93.155,99.486,10.09,221.771,10.09
											s221.771,83.065,221.771,185.164s-99.486,185.164-221.771,185.164c-14.488,0-29.077-1.211-43.445-3.604L76.579,433.451z" style="stroke: #000;stroke-width: 30px;cursor: pointer;" id="comment-div-<?=$pub['tmp_code']?>" onclick="comment_aff();initilisation_comment_page(<?=$pub['id']?>)" class="state_comment_<?=$pub['tmp_code']?>"/>
								</g>
								</g>
						</svg>
					</div>
				</li>
				<?php 

					$commentpub = $db->prepare('SELECT * FROM comment_pub WHERE pub = :pub AND user = :user');
					$commentpub->execute([
						'user' => 22,
						'pub' => $pub['tmp_code']
					]);
					if($commentpub->rowCount() >= 1) {
					?>
					<style type="text/css">
						.state_comment_<?=$pub['tmp_code']?>{
							fill: lime;
						}
					</style>
					<?php
					}
					else{
					?>
					<style type="text/css">
						.state_comment_<?=$pub['tmp_code']?>{
							fill: white;
						}
					</style>
					<?php
					}

				?>
			</ul>
		</div>
	</div>
<?php } ?>