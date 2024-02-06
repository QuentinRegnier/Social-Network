<?php
include '../database.php';
		global $db;
include 'database_profile.php';
		global $pro_bdd;
$id_name = 'user';
include 'verify_sys.php';
function genererChaineAleatoire($longueur = 10)
{
 $caracteres = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
 $longueurMax = strlen($caracteres);
 $chaineAleatoire = '';
 for ($i = 0; $i < $longueur; $i++)
 {
 $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
 }
 return $chaineAleatoire;
}
if(isset($_POST['content_publication']) && isset($_POST['user'])){
	if(!empty($_POST['content_publication']) && !empty($_POST['user'])){
		$tmp_code_exist = 1;
		$tmp_rand = rand(1,255);
		$tmp_code = genererChaineAleatoire($tmp_rand);
		while($tmp_code_exist != 0){
		  	$dmdtmpcode = $db->prepare('SELECT * FROM publications WHERE tmp_code = :tmp_code');
			$dmdtmpcode->execute([
			  	'tmp_code' => $tmp_code 
			]);
			if($dmdtmpcode->rowCount() == 0){
				$tmp_code_exist = 0;
			}
			else{
				$tmp_rand = rand(1,255);
		  		$tmp_code = genererChaineAleatoire($tmp_rand);
			}
		}
		$content = $_POST['content_publication']; 
		$ins = $db->prepare('INSERT INTO publications (content, user, tmp_code) VALUES (:content, :username, :tmp_code)');
		$ins->execute([
			'content' => $content,
			'username' => $_POST['user'],
			'tmp_code' => $tmp_code
		]);
		$publications = $db->prepare('SELECT * FROM publications WHERE tmp_code = :tmp_code');
		$publications->execute([
			'tmp_code' => $tmp_code 
		]);
		$pub = $publications->fetch();
		$stmt = $pro_bdd->prepare('SELECT pseudo FROM users WHERE use_code = :id_user');
		$stmt->execute(["id_user"=>$_POST['user']]);
		$response1 = $stmt->fetch();
		?>
		<div class="aff_pub_div_content" id="<?=$pub['id']?>"> 
			<div style="height: 52px;">
				<div onclick="window.location.href = '<?=$response1['pseudo']?>';" style="cursor:pointer;position: absolute;height: 50px;width: 180px;">
					<img class="nonSelectionnable" height="48px" width="48px" src="img_user/<?= $pub['user'] ?>_pp.png" style="float: left; margin-left: 16px; border-radius: 24;">
		        	<label class="nonSelectionnable" style="float: left; margin-left: 8px;margin-top: 12px;font-size: 20px;cursor:pointer;"><?=$response1['pseudo']?></label>
		        </div>
				<a class="button-edit nonSelectionnable" onclick="hide_edit_panel(<?=$pub['id']?>)" style="text-decoration: none; color: #807c7cc4; margin-right: 20px; font-size: 12.6px; float: right; cursor: pointer;">●●●</a>
			</div>
			<div>
				<p class="text_pub_aff" id="<?="content_".$pub['id']?>">
						<?php 
							$pub_content = $_POST['content_publication'];
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
				        <div style="height: 30px;width: 30px;" class="like_article phpdecidelikecolordiv-<?=$pub['id']?>" id="like-div-<?=$pub['id']?>">
				            <a style="cursor: pointer;" onclick="like_db(16,<?=$pub['id']?>,<?=$pub['id']?>);">
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
										-528 22 -585 14z" style="fill: #fff;stroke: #000;stroke-width: 860px;" id="like-div-<?=$pub['id']?>"/>
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
							if($likepub->rowCount() ==1) {
							?> 
							<script type="text/javascript">
								document.getElementById('like-div-<?=$pub['tmp_code']?>').style.fill = 'red';
							</script>
							<?php
							}
							else{
							?>
							<script type="text/javascript">
								document.getElementById('like-div-<?=$pub['tmp_code']?>').style.fill = 'white';
							</script>
							<?php
							}

						?>
					<li class="exp_article" style="color: black;font-size: 24px;font-family: 'Oswald', sans-serif;;vertical-align: top;margin-top: -3px; margin-right: 16px;" id="likepart-<?=$pub['id']?>"><?php $idpublike = $pub['tmp_code'];$likerecup = $db->prepare('SELECT * FROM like_pub WHERE pub = :id');$likerecup->execute(['id' => $idpublike]);$likecount = $likerecup->rowCount();echo $likecount;?></li>
					<li class="exp_article">
						<div style="background-color:white;height: 30px;width: 30px;" class="comment_article" id="comment-div-<?=$pub['id']?>"><a style="cursor: pointer;" onclick="comment_aff(<?=$pub['id']?>);"><img src="IMG/chat-bubble.png" height="30px" width="30px" id="comment"></a></div>
					</li>
				</ul>
			</div>
		</div>
		<?php
	}else{
		echo('Veuiller remplir tout les champs');
	}	
}
?>