<?php
include 'includes/database_profile.php';
global $pro_bdd;
include 'includes/verify.php';

$jsonData = file_get_contents('language/fr.json');
$data = json_decode($jsonData, true);
$langue = [];
foreach ($data as $valeur) {
    $langue[] = json_encode($valeur, JSON_UNESCAPED_UNICODE);
}
$id_user_live = $_COOKIE['id'];
$stmt2 = $pro_bdd->prepare('SELECT * FROM color WHERE w = :id_user');
$stmt2->execute(array('id_user' => $id_user_live));
$resultat2 = $stmt2->fetch();
$stmt8 = $pro_bdd->prepare('SELECT * FROM users WHERE use_code = :id_user');
$stmt8->execute(array('id_user' => $id_user_live));
$resultat8 = $stmt8->fetch();
if ($resultat8['pp'] == 1) {
	$pp = $resultat8['use_code'] . "_pp.png";
}else{
	$pp = "noimage.jpeg";
}
if ($resultat2['ban'] == 1) {
	$ban = $resultat8['use_code'] . "_ban.png";
}else{
	$ban = "nobanner.png";
}
$stmt3 = $pro_bdd->prepare('SELECT * FROM parms WHERE w = :id_user');
$stmt3->execute(array('id_user' => $id_user_live));
$resultat3 = $stmt3->fetch();
if ($resultat3['vrn'] == 1) {$r0_1 = true;$r0_2 = false;$r0_3 = false;}else if ($resultat3['vrn'] == 2) {$r0_1 = false;$r0_2 = true;$r0_3 = false;}else if ($resultat3['vrn'] == 3) {$r0_1 = false;$r0_2 = false;$r0_3 = true;}
if ($resultat3['vpi'] == 1) {$r1_1 = true;$r1_2 = false;$r1_3 = false;}else if ($resultat3['vpi'] == 2) {$r1_1 = false;$r1_2 = true;$r1_3 = false;}else if ($resultat3['vpi'] == 3) {$r1_1 = false;$r1_2 = false;$r1_3 = true;}
if ($resultat3['vbs'] == 1) {$r2_1 = true;$r2_2 = false;$r2_3 = false;}else if ($resultat3['vbs'] == 2) {$r2_1 = false;$r2_2 = true;$r2_3 = false;}else if ($resultat3['vbs'] == 3) {$r2_1 = false;$r2_2 = false;$r2_3 = true;}
if ($resultat3['vp'] == 1) {$r3_1 = true;$r3_2 = false;$r3_3 = false;}else if ($resultat3['vp'] == 2) {$r3_1 = false;$r3_2 = true;$r3_3 = false;}else if ($resultat3['vp'] == 3) {$r3_1 = false;$r3_2 = false;$r3_3 = true;}
if ($resultat3['vtl'] == 1) {$r4_1 = true;$r4_2 = false;$r4_3 = false;}else if ($resultat3['vtl'] == 2) {$r4_1 = false;$r4_2 = true;$r4_3 = false;}else if ($resultat3['vtl'] == 3) {$r4_1 = false;$r4_2 = false;$r4_3 = true;}
if ($r0_1 == true){$reg_priv_0_1 = $r0_1 ? 'checked' : '';$reg_lab_0_1 = '';}else{$reg_priv_0_1 = 'style="display:none;"';$reg_lab_0_1 = 'display:none;';}
if ($r0_2 == true){$reg_priv_0_2 = $r0_2 ? 'checked' : '';$reg_lab_0_2 = '';}else{$reg_priv_0_2 = 'style="display:none;"';$reg_lab_0_2 = 'display:none;';}
if ($r0_3 == true){$reg_priv_0_3 = $r0_3 ? 'checked' : '';$reg_lab_0_3 = '';}else{$reg_priv_0_3 = 'style="display:none;"';$reg_lab_0_3 = 'display:none;';}
if ($r1_1 == true){$reg_priv_1_1 = $r1_1 ? 'checked' : '';$reg_lab_1_1 = '';}else{$reg_priv_1_1 = 'style="display:none;"';$reg_lab_1_1 = 'display:none;';}
if ($r1_2 == true){$reg_priv_1_2 = $r1_2 ? 'checked' : '';$reg_lab_1_2 = '';}else{$reg_priv_1_2 = 'style="display:none;"';$reg_lab_1_2 = 'display:none;';}
if ($r1_3 == true){$reg_priv_1_3 = $r1_3 ? 'checked' : '';$reg_lab_1_3 = '';}else{$reg_priv_1_3 = 'style="display:none;"';$reg_lab_1_3 = 'display:none;';}
if ($r2_1 == true){$reg_priv_2_1 = $r2_1 ? 'checked' : '';$reg_lab_2_1 = '';}else{$reg_priv_2_1 = 'style="display:none;"';$reg_lab_2_1 = 'display:none;';}
if ($r2_2 == true){$reg_priv_2_2 = $r2_2 ? 'checked' : '';$reg_lab_2_2 = '';}else{$reg_priv_2_2 = 'style="display:none;"';$reg_lab_2_2 = 'display:none;';}
if ($r2_3 == true){$reg_priv_2_3 = $r2_3 ? 'checked' : '';$reg_lab_2_3 = '';}else{$reg_priv_2_3 = 'style="display:none;"';$reg_lab_2_3 = 'display:none;';}
if ($r3_1 == true){$reg_priv_3_1 = $r3_1 ? 'checked' : '';$reg_lab_3_1 = '';}else{$reg_priv_3_1 = 'style="display:none;"';$reg_lab_3_1 = 'display:none;';}
if ($r3_2 == true){$reg_priv_3_2 = $r3_2 ? 'checked' : '';$reg_lab_3_2 = '';}else{$reg_priv_3_2 = 'style="display:none;"';$reg_lab_3_2 = 'display:none;';}
if ($r3_3 == true){$reg_priv_3_3 = $r3_3 ? 'checked' : '';$reg_lab_3_3 = '';}else{$reg_priv_3_3 = 'style="display:none;"';$reg_lab_3_3 = 'display:none;';}
if ($r4_1 == true){$reg_priv_4_1 = $r4_1 ? 'checked' : '';$reg_lab_4_1 = '';}else{$reg_priv_4_1 = 'style="display:none;"';$reg_lab_4_1 = 'display:none;';}
if ($r4_2 == true){$reg_priv_4_2 = $r4_2 ? 'checked' : '';$reg_lab_4_2 = '';}else{$reg_priv_4_2 = 'style="display:none;"';$reg_lab_4_2 = 'display:none;';}
if ($r4_3 == true){$reg_priv_4_3 = $r4_3 ? 'checked' : '';$reg_lab_4_3 = '';}else{$reg_priv_4_3 = 'style="display:none;"';$reg_lab_4_3 = 'display:none;';}
$stmt4 = $pro_bdd->prepare('SELECT * FROM ban WHERE pp = :id');
$stmt4->execute([
	"id" => $id_user_live
]);
$imagePath1 = 'img_user/' . $pp;
$imagePath2 = 'img_user/' . $ban;
$imageData1 = file_get_contents($imagePath1);
$imageData2 = file_get_contents($imagePath2);
$base64Data1 = base64_encode($imageData1);
$base64Data2 = base64_encode($imageData2);
?>
<!DOCTYPE html>
<html style="overflow: hidden;">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes"/>
	<link rel="stylesheet" type="text/css" href="CSS/checkbox.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="shortcut icon" href="IMG/favicon.png" />
	<link rel="stylesheet" type="text/css" href="CSS/annimation.css">
	<link rel="stylesheet" type="text/css" href="CSS/burgermunu3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
	<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="CSS/emojionearea.min2.css">
	<link rel="stylesheet" type="text/css" href="CSS/setings_style.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="JS/emojionearea.min.js"></script> 
	<title>Réglages</title>
	<script type="text/javascript">const id_user_live = "<?= $id_user_live ?>";const identity = <?php if($identity == true){echo("true");}else{echo("false");} ?>;</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
	<script src="JS/settings.js"></script>
	<script type="text/javascript">
		function reserchDisponibilty(element){
			if (element == "pseudo") {
				pseudo_tx = document.getElementById('pseudo_input').value;
				if (verifierTexte(pseudo_tx) && pseudo_tx.length <= 14) {
					var httpRequest = getHttpRequest();
					httpRequest.onreadystatechange = function () {
						if (httpRequest.readyState === 4){
						  	if ((httpRequest.responseText != 'erreur1') || (httpRequest.responseText != 'erreur2')){
						    	if (httpRequest.responseText == true){
						      		document.getElementById('input_check-2').src = 'IMG/check.png';
						      		document.getElementById('input_check-2').className = 'check_input';
						      		pseudo_security=true;
						    	}
						    	else{
						    		document.getElementById('input_check-2').src = 'IMG/delete.png';
						      		document.getElementById('input_check-2').className = 'check_input';
						      		document.getElementById('input_check-2').title = <?= $langue[55] ?>;
						      		pseudo_security=false;
						    	}
						  	}
						}  
					}
					httpRequest.open('POST', 'includes/checkpseudo.php', true)
					httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
					httpRequest.overrideMimeType("text/plain")
					httpRequest.send("pseudo=" + encodeURIComponent(document.getElementById('pseudo_input').value) + "&use_code=" + encodeURIComponent(id_user_live))
				}else{
					document.getElementById('input_check-2').src = 'IMG/delete.png';
					document.getElementById('input_check-2').className = 'check_input';
					document.getElementById('input_check-2').title = <?= $langue[54] ?>;
					pseudo_security=false;
				}
			}
		}
		function load_data(query){
			$.ajax({
			   	url:"includes/research.php?user=<?= $id_user_live ?>",
			   	method:"POST",
			   	data:{query:query},
			   	success:function(data){
				   	if (data !== 'Data Not Found') {
					    dataJSON_search = JSON.parse(data);
					    count_search = dataJSON_search.length;
					    divElement = document.querySelector(".prop_val_content");
						divElement.innerHTML = "";
						num = 0;
					    for (let i = 0; i < count_search; i++) {
					    	num = 1;
					    	spanElement = document.createElement("span");
							spanElement.className = "prop_lie";
							spanElement.textContent = dataJSON_search[i]['pseudo'];
							spanElement.setAttribute("onclick", "attributeLocalisation_val(this);");
							brElement = document.createElement("br");
							divElement.appendChild(spanElement);
							divElement.appendChild(brElement);
					    }
					    if (num == 1) {
				    		document.querySelector(".prop_val_content").style.display = 'block';
				    	}
				    	else{
				    		document.querySelector(".prop_val_content").style.display = 'none';
				    	}
					}
				}
		  	});
		}
		scr_save_pp = "img_user/<?= $resultat8['use_code'] ?>_pp";
		scr_save_ban = "img_user/<?= $resultat8['use_code'] ?>_ban";
	</script>
</head>
<body id="body">
	<div class="absolute_animation" id="annimation_loader" style="height: 100%;background-color: rgb(9, 0, 211);width: 100%;margin-top: -1px;">
		<div style="position: relative;top: 20%;">
			<div class="container_animation" id="contain_animmation" style="margin: auto;">
			    <div></div>
			    <div></div>
			    <div></div>
			    <div></div>
			</div>
		</div>
	</div>
	<?php include 'includes/nav.php'; ?>
	<div id="content_all" style="display: none;">
		<div id="panel-crop-demand" style="height: 100%; width: 100%; position: fixed; background-color: rgba(0, 0, 0, 0.5);z-index:1000;display: none;margin-top: -60px;text-align: center;">
			<a role="button" onclick="hide_crop_demand_reverse();" class="cross_edit nonSelectionnable close_cross" style="float: right;cursor: pointer;font-size: 50px;padding: 20px;color: #fff;margin-top: 30px;">✖</a>
			<div class="content_pp_fig">
				<div class="content_figure content_figure_pp">
					<img src="data:image/jpeg;base64,<?= $base64Data1 ?>" class="img_crop" id="myGreatImage_pp">
				</div>
				<button id="cropButton_pp" onclick="cropImage(0)"><?= trim($langue[106], '"') ?></button>
			</div>
			<div class="content_ban_fig">
				<div class="content_figure content_figure_ban">
					<img src="data:image/jpeg;base64,<?= $base64Data2 ?>" class="img_crop" id="myGreatImage_ban">
				</div>
				<button id="cropButton_ban" onclick="cropImage(1)"><?= trim($langue[106], '"') ?></button>
			</div>
		</div>
		<div class="box1">
			<ul class="listparms_bar">
				<li class="box_cat_info_set"><img src="IMG/user_settings.png" class="icon_li_set"><?= trim($langue[0], '"') ?></li> 
				<li class="box_cat_info_set"><img src="IMG/insurance.png" class="icon_li_set"><?= trim($langue[1], '"') ?></li>
				<li class="box_cat_info_set"><img src="IMG/banned.png" class="icon_li_set"><?= trim($langue[2], '"') ?></li>
				<li class="box_cat_info_set"><img src="IMG/belgium.png" class="icon_li_set"><?= trim($langue[3], '"') ?></li>
				<li class="box_cat_info_set"><img src="IMG/handshake.png" class="icon_li_set"><?= trim($langue[4], '"') ?></li>
				<li class="box_cat_info_set"><img src="IMG/law.png" class="icon_li_set"><?= trim($langue[5], '"') ?> & <?= trim($langue[6], '"') ?></li>
				<li class="box_cat_info_set"><img src="IMG/charity.png" class="icon_li_set"><?= trim($langue[8], '"') ?></li>
			</ul>
			<button onclick="saveSetting();" class="butt_save"><?= trim($langue[52], '"') ?></button>
		</div>
		<div class="box2" id="content_parms_all">
			<div id="hamburger" class="hamburglar is-closed pasblock hamburger-settings">
			  <div class="burger-icon">
			    <div class="burger-container">
			      <span class="burger-bun-top"></span>
			      <span class="burger-filling"></span>
			      <span class="burger-bun-bot"></span>
			    </div>
			  </div>
			  <div class="burger-ring">
			  </div>
			  <div class="path-burger">
			    <div class="animate-path">
			      <div class="path-rotation"></div>
			    </div>
			  </div>
			</div>
			<div id="general">
				<h1><?= trim($langue[0], '"') ?></h1>
				<hr class="slim_bar">
				<div class="left_content">
					<div class="content-input">
						<span><?= trim($langue[11], '"') ?></span><br>
						<input type="text" name="prename" value="<?= $resultat8['first_name'] ?>" autocomplete="off" onkeyup="prename_var=1;"><img src="IMG/check.png" class="check_input nonSelectionnable" id="input_check-1">
					</div>
					<div class="content-input">
						<span><?= trim($langue[13], '"') ?></span><br>
						<input type="text" id="pseudo_input" name="pseudo" value="<?= $resultat8['pseudo'] ?>" onkeyup="document.getElementById('input_check-2').src = 'IMG/loading.png';document.getElementById('input_check-2').className = 'check_input rotate-image';pseudo_var=1;" autocomplete="off"><img src="IMG/check.png" class="check_input nonSelectionnable" id="input_check-2">
					</div>
					<div class="content-input">
						<span><?= trim($langue[45], '"') ?></span><br>
						<input type="text" name="localisation" onkeyup="searchlocalisation();document.getElementById('input_check-3').style.display = 'none';localisation_var=1;" id="input_loc" value="<?= $resultat2['live'] ?>" autocomplete="off"><img src="IMG/check.png" class="check_input nonSelectionnable" id="input_check-3">
						<div class="prop_lie_content" style="display:none;">
						</div>
					</div>
					<div class="content-input">
						<span><?= trim($langue[47], '"') ?></span><br>
						<input type="text" name="work" value="<?= $resultat2['works'] ?>" onkeyup="work_var=1;" autocomplete="off"><img src="IMG/check.png" class="check_input nonSelectionnable" id="input_check-4">
					</div>
					<div class="content-input">
						<span><?= trim($langue[51], '"') ?></span><br>
						<div class="content_input_file_pp">
							<img src="img_user/<?= $pp ?>" class="img_pp_input nonSelectionnable"><br><button id="btnUploadpp"><?= trim($langue[106], '"') ?></button><br><button id="btnRedpp" onclick="processImage(0);" style="width: 165px;"><?= trim($langue[107], '"') ?></button><input type="file" name="pp" id="inputPP" accept="image/png, image/jpeg, image/jpg" style="display: none;">
						</div><br>
					</div>
				</div>
				<div class="right_content">
					<div class="content-input">
						<span><?= trim($langue[12], '"') ?></span><br>
						<input type="text" name="name" value="<?= $resultat8['last_name'] ?>" autocomplete="off" onkeyup="name_var=1;"><img src="IMG/check.png" class="check_input nonSelectionnable" id="input_check-5">
					</div>
					<div class="content-input">
						<span><?= trim($langue[44], '"') ?></span><br>
						<select name="pets" id="pet-select" autocomplete="off" style="cursor:pointer;">
							<?php
							$numeroSelectionne = $resultat8['prefix_phone'];
							$numeros = array(
							    'CA' => '+1','BS' => '+1-242','BB' => '+1-246','AI' => '+1-264','AG' => '+1-268','VG' => '+1-284','VI' => '+1-340','KY' => '+1-345','BM' => '+1-441','GD' => '+1-473','TC' => '+1-649','MS' => '+1-664','TT' => '+1-868','MP' => '+1-670','GU' => '+1-671','AS' => '+1-684','SX' => '+1-721','DM' => '+1-767','VC' => '+1-784','PR' => '+1-787, +1-939','DO' => '+1-809, +1-829, +1-849','JM' => '+1-876',	'RU' => '+7','KZ' => '+7','EG' => '+20','ZA' => '+27','GR' => '+30','NL' => '+31','BE' => '+32','FR' => '+33','ES' => '+34','HU' => '+36','HU' => '+36','IT' => '+39','RO' => '+40','CH' => '+41','AT' => '+43','GB' => '+44','DK' => '+45','SE' => '+46','NO' => '+47','PL' => '+48','DE' => '+49','PE' => '+51','MX' => '+52','CU' => '+53','AR' => '+54','BR' => '+55','CL' => '+56','CO' => '+57','VE' => '+58','MY' => '+60','AU' => '+61','ID' => '+62','PH' => '+63','NZ' => '+64','SG' => '+65','TH' => '+66','JP' => '+81','KR' => '+82','VN' => '+84','CN' => '+86','TR' => '+90','IN' => '+91','PK' => '+92','AF' => '+93','LK' => '+94','MM' => '+95','IR' => '+98','SS' => '+211','MA' => '+212','EH' => '+212','DZ' => '+213','TN' => '+216','LY' => '+218','GM' => '+220','SN' => '+221','MR' => '+222','ML' => '+223','GN' => '+224','CI' => '+225','BF' => '+226','NE' => '+227','TG' => '+228','BJ' => '+229','MU' => '+230','LR' => '+231','SL' => '+232','GH' => '+233','NG' => '+234','TD' => '+235','CF' => '+236','CM' => '+237','CV' => '+238','ST' => '+239','GQ' => '+240','GA' => '+241','CG' => '+242','CD' => '+243','AO' => '+244','GW' => '+245','SC' => '+248','SD' => '+249','RW' => '+250','ET' => '+251','SO' => '+252','DJ' => '+253','KE' => '+254','TZ' => '+255','UG' => '+256','BI' => '+257','MZ' => '+258','ZM' => '+260','MG' => '+261','RE' => '+262','ZW' => '+263','NA' => '+264','MW' => '+265','LS' => '+266','BW' => '+267','SZ' => '+268','KM' => '+269','SH' => '+290','ER' => '+291','AW' => '+297','FO' => '+298','GL' => '+299','GI' => '+350','PT' => '+351','LU' => '+352','IE' => '+353','IS' => '+354','AL' => '+355','MT' => '+356','CY' => '+357','FI' => '+358','BG' => '+359','LT' => '+370','LV' => '+371','EE' => '+372','MD' => '+373','AM' => '+374','BY' => '+375','AD' => '+376','MC' => '+377','SM' => '+378','VA' => '+379','UA' => '+380','RS' => '+381','ME' => '+382','HR' => '+385','SI' => '+386','BA' => '+387','MK' => '+389','CZ' => '+420','SK' => '+421','LI' => '+423','FK' => '+500','BZ' => '+501','GT' => '+502','SV' => '+503','HN' => '+504','NI' => '+505','CR' => '+506','PA' => '+507','PM' => '+508','HT' => '+509','HT' => '+509','BQ' => '+599','CW' => '+599','SX' => '+599','BO' => '+591','GY' => '+592','EC' => '+593','PY' => '+595','SR' => '+597','UY' => '+598','TL' => '+670','NF' => '+672','BN' => '+673','NR' => '+674','PG' => '+675','TO' => '+676','SB' => '+677','VU' => '+678','FJ' => '+679','PW' => '+680','WF' => '+681','CK' => '+682','NU' => '+683','WS' => '+685','KI' => '+686','NC' => '+687','TV' => '+688','PF' => '+689','TK' => '+690','FM' => '+691','MH' => '+692','KP' => '+850','HK' => '+852','MO' => '+853','KH' => '+855','LA' => '+856','BD' => '+880','TW' => '+886','MV' => '+960','LB' => '+961','JO' => '+962','SY' => '+963','IQ' => '+964','KW' => '+965','SA' => '+966','YE' => '+967','PS' => '+970','AE' => '+971','IL' => '+972','BH' => '+973','QA' => '+974','BT' => '+975','MN' => '+976','NP' => '+977','TJ' => '+992','TM' => '+993','AZ' => '+994','GE' => '+995','KG' => '+996'
							);
							foreach ($numeros as $codePays => $numero) {
							    if ($numero == $numeroSelectionne) {
							        echo '<option value="' . $codePays . '" selected>' . $numero . '</option>';
							    } else {
							        echo '<option value="' . $codePays . '">' . $numero . '</option>';
							    }
							}
							?></select><input type="tel" name="phone" value="<?= $resultat8['phone'] ?>" autocomplete="off" onkeyup="phone_var=1;" id="tel-input"><img src="IMG/check.png" class="check_input nonSelectionnable" id="input_check-6">
					</div>
					<div class="content-input">
						<span><?= trim($langue[46], '"') ?></span><br>
						<input type="text" name="school" value="<?= $resultat2['school'] ?>" autocomplete="off" onkeyup="school_var=1;"><img src="IMG/check.png" class="check_input nonSelectionnable" id="input_check-7">
					</div>
					<div class="content-input">
						<span><?= trim($langue[48], '"') ?></span><br>
						<input type="text" name="valor" value="<?= $resultat2['valor'] ?>" id="valor_search" autocomplete="off"><img src="IMG/check.png" class="check_input nonSelectionnable" id="input_check-8">
						<div class="prop_val_content" style="display:none;">
						</div>
					</div>
						<span><?= trim($langue[50], '"') ?></span><br>
						<div class="content_input_file_pp">
							<img src="img_user/<?= $ban ?>" class="img_ban_input nonSelectionnable"><br><button id="btnUploadban"><?= trim($langue[106], '"') ?></button><br><button id="btnRedpp" onclick="processImage(1);" style="width: 165px;"><?= trim($langue[107], '"') ?></button><input type="file" name="ban" id="inputBAN" accept="image/png, image/jpeg, image/jpg" style="display: none;">
						</div><br>
					<div class="content-input">
					</div>
				</div>
				<button class="butt_modif_st_max" onclick="document.getElementById('mdp_vef').style.display = 'block';"><?= trim($langue[9], '"') ?></button><br>
				<input type="password" name="mdp" style="display:none;margin-left: auto;margin-right: auto;" id="mdp_vef" placeholder="<?= trim($langue[16], '"') ?>"><br><br>
				<div class="left_content" id="connectinfo-left">
					<div class="content-input">
						<span><?= trim($langue[14], '"') ?></span><br>
						<input type="email" name="mail" id="email_change" onkeyup="validate_mail();" autocomplete="off"><img src="IMG/check.png" class="check_input nonSelectionnable" id="input_check-9">
					</div>
					<div class="content-input">
						<span><?= trim($langue[15], '"') ?></span><br>
						<input type="email" id="email_rep" name="remail" autocomplete="off" onkeyup="similar('mail')"><img src="IMG/check.png" class="check_input nonSelectionnable" id="input_check-10">
					</div>
				</div>
				<div class="right_content" id="connectinfo-right">
					<div class="content-input">
						<span><?= trim($langue[16], '"') ?></span><br>
						<input type="password" id="password_change" name="pass" onkeyup="validate_mdp();" autocomplete="off"><img src="IMG/check.png" class="check_input nonSelectionnable" id="input_check-11">
					</div>
					<div class="content-input">
						<span><?= trim($langue[17], '"') ?></span><br>
						<input type="password" id="password_rep" name="repass" autocomplete="off" onkeyup="similar('mdp')"><img src="IMG/check.png" class="check_input nonSelectionnable" id="input_check-12">
					</div>
				</div><br id="br-info-connect"><br id="br-info-connect"><br id="br-info-connect"><br id="br-info-connect"><br id="br-info-connect"><br id="br-info-connect"><br id="br-info-connect"><br id="br-info-connect"><br id="br-info-connect"><br id="br-info-connect"><br id="br-info-connect"><br id="br-info-connect"><br id="br-info-connect"><br id="br-info-connect">
				<span id="span-desc"><?= trim($langue[49], '"') ?></span>
				<textarea id="textareacommentelement" maxlength="120" autocomplete="off"><?= $resultat2['desp'] ?></textarea>
				<script>
					$(document).ready(function() {
						$("#textareacommentelement").emojioneArea({
							pickerPosition: "top",
							buttonTitle : "Utilisez la touche TAB pour insérer des emoji plus rapidement",
							autocomplete: true,
							attributes: {
						        autocomplete   : "on",
			    				autocorrect    : "on",
			    				autocapitalize : "on",
			    			},
				   			placeholder: "Qu'avez-vous à raconter",
				   			searchPlaceholder : "Rechercher"
						});
					})
				</script>
			</div>
			<div id="private">
				<h1><?= trim($langue[1], '"') ?></h1>
				<hr class="slim_bar">
				<div class="left_content_pri">
					<div class="content-input_pri">
						<span id="span-priv"><?= trim($langue[39], '"') ?></span><br><br>
						<input type="checkbox" class="toggle reg_priv_0_1" autocomplete="off" onclick="security=1;" <?= $reg_priv_0_1 ?>/><label class="reg_priv_0_1 nonSelectionnable" style="line-height: 30px;<?= $reg_lab_0_1 ?>">Tous le monde</label><br><br>
						<input type="checkbox" class="toggle reg_priv_0_2" autocomplete="off" onclick="security=1;" <?= $reg_priv_0_2 ?>/><label class="reg_priv_0_2 nonSelectionnable" style="line-height: 30px;<?= $reg_lab_0_2 ?>">Seulement les amis</label><br><br>
						<input type="checkbox" class="toggle reg_priv_0_3" autocomplete="off" onclick="security=1;" <?= $reg_priv_0_3 ?>/><label class="reg_priv_0_3 nonSelectionnable" style="line-height: 30px;<?= $reg_lab_0_3 ?>">C'est caché !</label><br><br><br>
					</div>
					<div class="content-input_pri">
						<span id="span-priv"><?= trim($langue[40], '"') ?></span><br><br>
						<input type="checkbox" class="toggle reg_priv_1_1" autocomplete="off" onclick="security=1;" <?= $reg_priv_1_1 ?>/><label class="reg_priv_1_1 nonSelectionnable" style="line-height: 30px;<?= $reg_lab_1_1 ?>">Tous le monde</label><br><br>
						<input type="checkbox" class="toggle reg_priv_1_2" autocomplete="off" onclick="security=1;" <?= $reg_priv_1_2 ?>/><label class="reg_priv_1_2 nonSelectionnable" style="line-height: 30px;<?= $reg_lab_1_2 ?>">Seulement les amis</label><br><br>
						<input type="checkbox" class="toggle reg_priv_1_3" autocomplete="off" onclick="security=1;" <?= $reg_priv_1_3 ?>/><label class="reg_priv_1_3 nonSelectionnable" style="line-height: 30px;<?= $reg_lab_1_3 ?>">C'est caché !</label><br><br><br>
					</div>
				</div>
				<div class="right_content_pri">
					<div class="content-input_pri">
						<span id="span-priv"><?= trim($langue[41], '"') ?></span><br><br>
						<input type="checkbox" class="toggle reg_priv_2_1" autocomplete="off" onclick="security=1;" <?= $reg_priv_2_1 ?>/><label class="reg_priv_2_1 nonSelectionnable" style="line-height: 30px;<?= $reg_lab_2_1 ?>">Tous le monde</label><br><br>
						<input type="checkbox" class="toggle reg_priv_2_2" autocomplete="off" onclick="security=1;" <?= $reg_priv_2_2 ?>/><label class="reg_priv_2_2 nonSelectionnable" style="line-height: 30px;<?= $reg_lab_2_2 ?>">Seulement les amis</label><br><br>
						<input type="checkbox" class="toggle reg_priv_2_3" autocomplete="off" onclick="security=1;" <?= $reg_priv_2_3 ?>/><label class="reg_priv_2_3 nonSelectionnable" style="line-height: 30px;<?= $reg_lab_2_3 ?>">C'est caché !</label><br><br><br>
					</div>
					<div class="content-input_pri">
						<span id="span-priv"><?= trim($langue[42], '"') ?></span><br><br>
						<input type="checkbox" class="toggle reg_priv_3_1" autocomplete="off" onclick="security=1;" <?= $reg_priv_3_1 ?>/><label class="reg_priv_3_1 nonSelectionnable" style="line-height: 30px;<?= $reg_lab_3_1 ?>">Tous le monde</label><br><br>
						<input type="checkbox" class="toggle reg_priv_3_2" autocomplete="off" onclick="security=1;" <?= $reg_priv_3_2 ?>/><label class="reg_priv_3_2 nonSelectionnable" style="line-height: 30px;<?= $reg_lab_3_2 ?>">Seulement les amis</label><br><br>
						<input type="checkbox" class="toggle reg_priv_3_3" autocomplete="off" onclick="security=1;" <?= $reg_priv_3_3 ?>/><label class="reg_priv_3_3 nonSelectionnable" style="line-height: 30px;<?= $reg_lab_3_3 ?>">C'est caché !</label><br><br><br>
					</div>
					<div class="content-input_pri">
						<span id="span-priv"><?= trim($langue[43], '"') ?></span><br><br>
						<input type="checkbox" class="toggle reg_priv_4_1" autocomplete="off" onclick="security=1;" <?= $reg_priv_4_1 ?>/><label class="reg_priv_4_1 nonSelectionnable" style="line-height: 30px;<?= $reg_lab_4_1 ?>">Tous le monde</label><br><br>
						<input type="checkbox" class="toggle reg_priv_4_2" autocomplete="off" onclick="security=1;" <?= $reg_priv_4_2 ?>/><label class="reg_priv_4_2 nonSelectionnable" style="line-height: 30px;<?= $reg_lab_4_2 ?>">Seulement les amis</label><br><br>
						<input type="checkbox" class="toggle reg_priv_4_3" autocomplete="off" onclick="security=1;" <?= $reg_priv_4_3 ?>/><label class="reg_priv_4_3 nonSelectionnable" style="line-height: 30px;<?= $reg_lab_4_3 ?>">C'est caché !</label><br><br><br>
					</div>
				</div>
			</div>
			<div id="block">
				<h1><?= trim($langue[2], '"') ?></h1>
				<hr class="slim_bar">
				<?php
				if ($stmt4->rowCount() != 0) {
					$counter = 0;
					$countery = 0;
					$html_1 = '';
					$html_2 = '';
					$html_3 = '';
					$html_4 = '';
					while ($result_ban = $stmt4->fetch()) {
						$txt_ban = trim($langue[53], '"');
						$ban_id = $result_ban['b'];
			            $stmt_ban = $pro_bdd->prepare('SELECT pseudo FROM users WHERE use_code = :id');
			            $stmt_ban->execute([
			            	"id" => $ban_id
			            ]);
			            $name_ban = $stmt_ban->fetch();
			            $ban_id_func = "'".$ban_id."'";
			            $counter_func = "'ban-".$counter."'";
						if ($counter% 3 === 0) {
							$countery++;
				            $html_1 .= '<div class="ban_content" id="ban-'.$counter.'"><img src="img_user/'.$ban_id.'_pp" class="img_ban nonSelectionnable"><a href="'.$name_ban["pseudo"].'"><span class="span_ban">'.$name_ban["pseudo"].'</span></a><button class="button_ban" title="'.$txt_ban.'" onclick="unban('. $ban_id_func.', '.$counter_func.');">✖</button></div>';
				        } elseif ($counter % 3 === 1) {
				            $html_2 .= '<div class="ban_content" id="ban-'.$counter.'"><img src="img_user/'.$ban_id.'_pp" class="img_ban nonSelectionnable"><a href="'.$name_ban["pseudo"].'"><span class="span_ban">'.$name_ban["pseudo"].'</span></a><button class="button_ban" title="'.$txt_ban.'" onclick="unban('. $ban_id_func.', '.$counter_func.');">✖</button></div>';
				        } elseif ($counter % 3 === 2) {
				            $html_3 .= '<div class="ban_content" id="ban-'.$counter.'"><img src="img_user/'.$ban_id.'_pp" class="img_ban nonSelectionnable"><a href="'.$name_ban["pseudo"].'"><span class="span_ban">'.$name_ban["pseudo"].'</span></a><button class="button_ban" title="'.$txt_ban.'" onclick="unban('. $ban_id_func.', '.$counter_func.');">✖</button></div>';
				        }
				        $html_4 .= '<div class="ban_content" id="ban-'.$counter.'"><img src="img_user/'.$ban_id.'_pp" class="img_ban nonSelectionnable"><a href="'.$name_ban["pseudo"].'"><span class="span_ban">'.$name_ban["pseudo"].'</span></a><button class="button_ban" title="'.$txt_ban.'" onclick="unban('. $ban_id_func.', '.$counter_func.');">✖</button></div>';
				        $counter++;
					}
					?>
					<div class="content_block_left">
						<?= $html_1 ?>
					</div>
					<div class="content_block_center">
						<?= $html_2 ?>
					</div>
					<div class="content_block_right">
						<?= $html_3 ?>
					</div>
					<div class="content-center-ban">
						<?= $html_4 ?>
					</div>
					<style type="text/css">
						.content_block_right, .content_block_center, .content_block_left{
							height: <?= $countery*200 ?>px;
						}
					</style>
					<?php
				}else{
					?>
					<span class="span_noban"><?= trim($langue[56], '"') ?></span>
					<?php
				}
				?>
			</div>
			<div id="language">
				<h1><?= trim($langue[3], '"') ?></h1>
				<hr class="slim_bar">
				<div class="content-lang">
					<h3 class="title_lang nonSelectionnableindex"><?= trim($langue[98], '"') ?>(choice your language) :</h3>
					<select id="sel_lang" autocomplete="off">
						<option selected>Français</option>
					</select><br><span class="span_lang"><?= trim($langue[99], '"') ?></span><br>
					<span class="info_lang"><?= trim($langue[100], '"') ?></span><br>
					<div style="text-align:center;width: 100%;"><button class="butt_lang" onclick="up(6);"><?= trim($langue[8], '"') ?></button></div>
				</div>
			</div>
			<div id="engagements">
				<h1><?= trim($langue[4], '"') ?></h1>
				<hr class="slim_bar">
				<p class="intro_enga nonSelectionnable intro_intro_enga"><?= trim($langue[57], '"') ?><span class="hightl"><?= trim($langue[58], '"') ?></span><?= trim($langue[59], '"') ?><FONT color="#1f0bd9" class="bright"><?= trim($langue[60], '"') ?></FONT> <?= trim($langue[61], '"') ?><FONT color="#1f0bd9" class="bright"><?= trim($langue[62], '"') ?></FONT><?= trim($langue[63], '"') ?><span class="hightl"><?= trim($langue[64], '"') ?></span>.</p><br>
				<p class="intro_enga nonSelectionnable"><?= trim($langue[65], '"') ?><span class="hightl"><?= trim($langue[66], '"') ?></span><?= trim($langue[67], '"') ?><FONT color="#1f0bd9" class="bright"><?= trim($langue[68], '"') ?></FONT>.</p>
				<p class="intro_enga nonSelectionnable"><?= trim($langue[69], '"') ?><span class="hightl"><?= trim($langue[70], '"') ?></span class="hightl"><?= trim($langue[71], '"') ?><span class="hightl"><?= trim($langue[72], '"') ?></span><?= trim($langue[73], '"') ?><FONT color="#1f0bd9" class="bright"><?= trim($langue[74], '"') ?></FONT><?= trim($langue[75], '"') ?></p><br>
				<p class="intro_enga nonSelectionnable"><?= trim($langue[76], '"') ?><span class="hightl"><?= trim($langue[77], '"') ?></span><?= trim($langue[78], '"') ?></p>
				<p class="intro_enga nonSelectionnable"><?= trim($langue[79], '"') ?><FONT color="#1f0bd9" class="bright"><?= trim($langue[80], '"') ?></FONT><?= trim($langue[81], '"') ?><span class="hightl"><?= trim($langue[82], '"') ?></span><?= trim($langue[83], '"') ?><FONT color="#1f0bd9" class="bright"><?= trim($langue[84], '"') ?></FONT>.</p>
				<p class="intro_enga nonSelectionnable"><?= trim($langue[85], '"') ?><span class="hightl"><?= trim($langue[86], '"') ?></span><?= trim($langue[87], '"') ?><FONT color="#1f0bd9" class="bright"><?= trim($langue[88], '"') ?></FONT><?= trim($langue[89], '"') ?><FONT color="#1f0bd9" class="bright"><?= trim($langue[90], '"') ?></FONT><?= trim($langue[91], '"') ?><FONT color="#1f0bd9" class="bright"><?= trim($langue[92], '"') ?></FONT>.</p><br>
				<p class="intro_enga nonSelectionnable end_intro_enga"><?= trim($langue[93], '"') ?><span class="hightl"><?= trim($langue[94], '"') ?></span><span class="hightl"><?= trim($langue[95], '"') ?></span><?= trim($langue[96], '"') ?><FONT color="#1f0bd9" class="bright"><?= trim($langue[97], '"') ?></FONT>.</p>
			</div>
			<div id="CGU">
				<h1><?= trim($langue[5], '"') ?></h1>
				<hr class="slim_bar">
			</div>
			<div id="CGV">
				<h1><?= trim($langue[6], '"') ?></h1>
				<hr class="slim_bar">
			</div>
			<div id="volunteer">
				<h1><?= trim($langue[10], '"') ?></h1>
				<hr class="slim_bar">
				<div class="content_volunteer">
					<h2 class="title_volunteer"><?= trim($langue[101], '"') ?></h2>
					<h3 class="sis_title_volunteer"><?= trim($langue[102], '"') ?></h3><br>
					<p class="span_volunteer"><?= trim($langue[103], '"') ?></p><br>
				</div>
				<button class="butt_volunteer" id="downloadBtn"><?= trim($langue[104], '"') ?></button>
			</div>
		</div>
	</div>
</body>
<?php include 'includes/footer_index.php'; ?>
</html>