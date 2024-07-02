<?php
include '../database.php';
		global $db;
include 'database_profile.php';
global $pro_bdd;
$id_name = 'id';
include 'verify_sys.php';
function genererChaineAleatoire($longueur = 10)
{
 $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 $longueurMax = strlen($caracteres);
 $chaineAleatoire = '';
 for ($i = 0; $i < $longueur; $i++)
 {
 $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)]; 
 }
 return $chaineAleatoire;
}
function determineImageExtension($one_type) {
    $extension = "";

    switch ($one_type) {
        case 1:
            $extension = "gif";
            break;
        case 2:
            $extension = "jpg";
            break;
        case 3:
        case 4: // Both 3 and 4 map to "png"
            $extension = "png";
            break;
        default:
            // Gestion d'une valeur inattendue
            break;
    }

    return $extension;
}
if (isset($_POST['id']) && isset($_POST['content']) && isset($_FILES['one']) && isset($_POST['one_type']) && isset($_POST['NumberOfFiles'])) {
	if (!empty($_POST['id']) && !empty($_FILES['one']) && !empty($_POST['one_type']) && !empty($_POST['NumberOfFiles'])) {
		$user = $_POST['id'];
		$content = $_POST['content'];
		$tmp_code = genererChaineAleatoire(30);
		$hashchemin = genererChaineAleatoire(20);
		$hashchemin = crypt($hashchemin, 'piafou');
    	$hashchemin = str_replace("/", "", $hashchemin);
    	$extension_one = determineImageExtension($_POST['one_type']);
		$to_test_one = "../img_pub/" . $hashchemin . "_1." . $extension_one;
		$exist_one = 1;
		while($exist_one != 0){
		  	if(file_exists($to_test_one)){
		  		$hashchemin = genererChaineAleatoire(20);
				$hashchemin = crypt($hashchemin, 'piafou');
    			$hashchemin = str_replace("/", "", $hashchemin);
    			$to_test_one = "../img_pub/". $hashchemin ."_1." . $extension_one;
	 		}
	 		else{
	  			$exist_one = 0;
	  		}
	  	}
	  	$insert = 'content, img_pub, user, tmp_code, numberofimg, Content_Type_one';
	  	$values = ':content, :img_pub, :user, :tmp_code, :numberofimg, :Content_Type_one';
		$data = ['content' => $content, 'user' => $user,'tmp_code' => $tmp_code,'Content_Type_one' => $_POST['one_type'], 'numberofimg' => $_POST['NumberOfFiles']];
		if ($_POST['NumberOfFiles'] >= 2 && isset($_POST['two_type']) && isset($_FILES['two']) && !empty($_POST['two_type']) && !empty($_FILES['two'])) {
			$extension_two = determineImageExtension($_POST['two_type']);
			$insert .= ', Content_Type_two';
			$values .= ', :Content_Type_two';
			$data['Content_Type_two'] = $_POST['two_type'];
			$to_test_two = "../img_pub/" . $hashchemin . "_2." . $extension_two;
			$exist_two = 1;
			while($exist_two != 0){
			  	if(file_exists($to_test_two) || file_exists($to_test_one)){
			  		$hashchemin = genererChaineAleatoire(20);
					$hashchemin = crypt($hashchemin, 'piafou');
	    			$hashchemin = str_replace("/", "", $hashchemin);
	    			$to_test_one = "../img_pub/". $hashchemin ."_1." . $extension_one;
	    			$to_test_two = "../img_pub/". $hashchemin ."_2." . $extension_two;
		 		}
		 		else{
		  			$exist_two = 0;
		  		}
		  	}
		}
		if ($_POST['NumberOfFiles'] >= 3 && isset($_POST['three_type']) && isset($_FILES['three']) && !empty($_POST['three_type']) && !empty($_FILES['three'])) {
			$extension_three = determineImageExtension($_POST['three_type']);
			$insert .= ', Content_Type_three';
			$values .= ', :Content_Type_three';
			$data['Content_Type_three'] = $_POST['three_type'];
			$to_test_three = "../img_pub/" . $hashchemin . "_3." . $extension_three;
			$exist_three = 1;
			while($exist_three != 0){
			  	if(file_exists($to_test_three) || file_exists($to_test_two) || file_exists($to_test_one)){
			  		$hashchemin = genererChaineAleatoire(20);
					$hashchemin = crypt($hashchemin, 'piafou');
	    			$hashchemin = str_replace("/", "", $hashchemin);
	    			$to_test_one = "../img_pub/". $hashchemin ."_1." . $extension_one;
	    			$to_test_two = "../img_pub/". $hashchemin ."_2." . $extension_two;
	    			$to_test_three = "../img_pub/". $hashchemin ."_3." . $extension_three;
		 		}
		 		else{
		  			$exist_three = 0;
		  		}
		  	}
		}
		if ($_POST['NumberOfFiles'] == 4 && isset($_POST['four_type']) && isset($_FILES['four']) && !empty($_POST['four_type']) && !empty($_FILES['four'])) {
			$extension_four = determineImageExtension($_POST['four_type']);
			$insert .= ', Content_Type_four';
			$values .= ', :Content_Type_four';
			$data['Content_Type_four'] = $_POST['four_type'];
			$to_test_four = "../img_pub/" . $hashchemin . "_4." . $extension_four;
			$exist_four = 1;
			while($exist_four != 0){
			  	if(file_exists($to_test_four) || file_exists($to_test_three) || file_exists($to_test_two) || file_exists($to_test_one)){
			  		$hashchemin = genererChaineAleatoire(20);
					$hashchemin = crypt($hashchemin, 'piafou');
	    			$hashchemin = str_replace("/", "", $hashchemin);
	    			$to_test_one = "../img_pub/". $hashchemin ."_1." . $extension_one;
	    			$to_test_two = "../img_pub/". $hashchemin ."_2."  . $extension_two;
	    			$to_test_three = "../img_pub/". $hashchemin ."_3." . $extension_three;
	    			$to_test_four = "../img_pub/". $hashchemin ."_4." . $extension_four;
		 		}
		 		else{
		  			$exist_four = 0;
		  		}
		  	}
		}
		$data['img_pub'] = $hashchemin;
		if ($_POST['NumberOfFiles'] >= 1){$chemin_one = $to_test_one;move_uploaded_file($_FILES['one']['tmp_name'], $chemin_one);}
		if ($_POST['NumberOfFiles'] >= 2){$chemin_two = $to_test_two;move_uploaded_file($_FILES['two']['tmp_name'], $chemin_two);}
		if ($_POST['NumberOfFiles'] >= 3){$chemin_three = $to_test_three;move_uploaded_file($_FILES['three']['tmp_name'], $chemin_three);}
		if ($_POST['NumberOfFiles'] == 4){$chemin_four = $to_test_four;move_uploaded_file($_FILES['four']['tmp_name'], $chemin_four);}
		$ins = $db->prepare('INSERT INTO publications ('.$insert.') VALUES ('.$values.')');
		$ins->execute($data);
		$publications =$db->prepare('SELECT * FROM publications WHERE tmp_code = :tmp_code');
		$publications->execute([
			'tmp_code' => $tmp_code
		]);
		while($pub = $publications->fetch()) {
			$stmt1 = $pro_bdd->prepare('SELECT * FROM users WHERE use_code = :id_user');
			$stmt1->execute(array('id_user' => $pub['user']));
			$resultat1 = $stmt1->fetch();
		?>
			<div class="aff_pub_div_content" id="<?=$pub['id']?>">
		        <div style="height: 52px;">
		        	<div onclick="window.location.href = '<?=$resultat1['pseudo']?>';" style="cursor:pointer;position: absolute;height: 50px;width: 180px;">
		            <img class="nonSelectionnable" height="48px" width="48px" src="img_user/<?= $pub['user'] ?>_pp.png" style="float: left; margin-left: 16px; border-radius: 24;">
		            <label class="nonSelectionnable" style="float: left; margin-left: 8px;margin-top: 12px;font-size: 20px;cursor:pointer;"><?=$resultat1['pseudo']?></label></div>
		            <a class="button-edit nonSelectionnable" onclick="hide_edit_panel(<?= $pub['id'] ?>, '<?= $pub['user'] ?>')" style="text-decoration: none; color: #807c7cc4; margin-right: 20px; font-size: 12.6px; float: right; cursor: pointer;">●●●</a>
	            </div>
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
						<figure id="content_img_preview">
							<div class="container_img_pub">
								<div class="slider" style="width:500px;height:500px;">
									<img id="slide1" src="../img_pub/<?=$pub['img_pub']?>_1<?=$ContentTypeonepub?>" class="img-<?=$pub['tmp_code']?> slide1 active" height="560px" width="560px"/>
									<?php 
									if($pub['numberofimg'] == 2){
									?>
										<img id="slide2" src="../img_pub/<?=$pub['img_pub']?>_2<?=$ContentTypetwopub?>" class="img-<?=$pub['tmp_code']?> slide2" style="" height="560px" width="560px"/>
									<?php
									}
									elseif($pub['numberofimg'] == 3){
									?>
										<img id="slide2" src="../img_pub/<?=$pub['img_pub']?>_2<?=$ContentTypetwopub?>" class="img-<?=$pub['tmp_code']?> slide2" style="" height="560px" width="560px"/>
										<img id="slide3" src="../img_pub/<?=$pub['img_pub']?>_3<?=$ContentTypethreepub?>" class="img-<?=$pub['tmp_code']?> slide3" style="" height="560px" width="560px"/>
											<?php
									}
									elseif($pub['numberofimg'] == 4){
									?>
										<img id="slide2" src="../img_pub/<?=$pub['img_pub']?>_2<?=$ContentTypetwopub?>" class="img-<?=$pub['tmp_code']?> slide2" style="" height="560px" width="560px"/>
										<img id="slide3" src="../img_pub/<?=$pub['img_pub']?>_3<?=$ContentTypethreepub?>" class="img-<?=$pub['tmp_code']?> slide3" style="" height="560px" width="560px"/>
										<img id="slide4" src="../img_pub/<?=$pub['img_pub']?>_4<?=$ContentTypefourpub?>" class="img-<?=$pub['tmp_code']?> slide4" style="" height="560px" width="560px"/>
									<?php
									}
									?>
								</div>
								<?php
								if($pub['numberofimg'] >= 2){
									?>
								<div class="cont-btn">
								    <div class="btn-nav left" onclick="slidePrecedente('img.img-<?=$pub['tmp_code']?>',<?=$pub['numberofimg']?>,'img-<?=$pub['tmp_code']?>');" style="font-size: 0;"><img src="IMG/before2.png" height="26px" width="26px"/></div>
								    <div class="btn-nav right" onclick="slideSuivante('img.img-<?=$pub['tmp_code']?>',<?=$pub['numberofimg']?>,'img-<?=$pub['tmp_code']?>');" style="font-size: 0;"><img src="IMG/next2.png" height="26px" width="26px"/></div>
								</div>
									<?php
								}
							    ?>
							</div>
							<style type="text/css">
								::before, ::after {
								  	margin: 0;
								  	padding: 0;
								  	box-sizing: border-box;
								}
								.container {
								  	width: 560px;
								  	height: 560px;
								}

								.slider img {
								  	display: none;
								}
								img.active {
								  	display: block;
								  	animation: fade 1s;
								}
								@keyframes fade {
									from {
								    	opacity: 0;
								    }
									to {
										opacity: 1;
									}
								}
								.cont-btn {
									width: 560px;
									height: auto;
									display: flex;
									justify-content: space-between;
									position: absolute;
									margin-top: -284px;
								}
								.btn-nav {
								    font-size: 50px;
								    margin: 0 15px;
								  	cursor: pointer;
								  	width: 26px;
								 	height: 26px;
								}
								</style>
						</figure>
			        </div>
			        <div>
			           	<p class="text_pub_aff" id="<?="content_".$pub['id']?>">
		             	<?php 
		                 	$pub_content = $_POST['content'];
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
												-528 22 -585 14z" style="stroke: #000;stroke-width: 860px;fill: white;" id="like-div-<?=$pub['tmp_code']?>" class="state_like_<?=$pub['tmp_code']?>"/>
												</g>
											</svg>
										</a>
									</div>
								</li>
								<li class="exp_article" style="color: black;font-size: 24px;font-family: 'Oswald', sans-serif;;vertical-align: top;margin-top: -3px; margin-right: 16px;" id="likepart-<?=$pub['tmp_code']?>">0</li>
								<li class="exp_article">
									<div style="background-color:white;height: 30px;width: 30px;" class="comment_article">
										<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" width="35px" height="30px" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 443.541 443.541" xml:space="preserve">
											<g>
												<g>
													<path d="M76.579,433.451V335.26C27.8,300.038,0,249.409,0,195.254C0,93.155,99.486,10.09,221.771,10.09
															s221.771,83.065,221.771,185.164s-99.486,185.164-221.771,185.164c-14.488,0-29.077-1.211-43.445-3.604L76.579,433.451z" style="stroke: #000;stroke-width: 30px;cursor: pointer;fill: white;" id="comment-div-<?=$pub['tmp_code']?>" onclick="comment_aff();initilisation_comment_page(<?=$pub['id']?>)" class="state_comment_<?=$pub['tmp_code']?>"/>
												</g>
												</g>
										</svg>
									</div>
								</li>
				            </ul>
			            </div>
				</div>
		<?php
		}
	}
}



?>