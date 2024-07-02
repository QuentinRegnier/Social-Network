<?php 
include 'includes/database.php';
		global $db;
include 'includes/verify.php';
$jsonData = file_get_contents('../language/fr.json');
$data = json_decode($jsonData, true);
$langue = [];
foreach ($data as $valeur) {
    $langue[] = json_encode($valeur, JSON_UNESCAPED_UNICODE);
}
$tab_pub = [];
if (isset($useCode) && isset($_COOKIE['id'])) { 
	if (!empty($useCode) && !empty($_COOKIE['id'])) {
		$id_user = $useCode;
		$id_user_live = $_COOKIE['id'];
		include 'includes/parms_application.php';
		$stmt1 = $pro_bdd->prepare('SELECT * FROM users WHERE use_code = :id_user');
		$stmt1->execute(array('id_user' => $id_user));
		$resultat1 = $stmt1->fetch();
		$stmt2 = $pro_bdd->prepare('SELECT * FROM color WHERE w = :id_user');
		$stmt2->execute(array('id_user' => $id_user));
		$resultat2 = $stmt2->fetch();
		$date = $resultat1['date_create'];
		$dateDiff = date_diff(date_create($date), date_create());
		$date_echo = $dateDiff->y . " ans " . $dateDiff->m . " mois " . $dateDiff->d . " jours";
		$stmt3 = $pro_bdd->prepare('SELECT * FROM sub WHERE w = :id_user');
		$stmt3->execute(array('id_user' => $id_user));
		$resultat3 = $stmt3->rowCount();
		$stmt4 = $db->prepare('SELECT id FROM like_pub WHERE pub IN (SELECT tmp_code FROM publications WHERE user = :id_user)');
		$stmt4->execute(array('id_user' => $id_user));
		$resultat4 = $stmt4->rowCount();
		$stmt5 = $db->prepare("SELECT * FROM publications WHERE user = :id_user ORDER BY create_date DESC");
		$stmt5->execute(array('id_user' => $id_user));
		$resultat5 = array();
		while ($row = $stmt5->fetch()) {
		  $resultat5[] = array($row['img_pub'], $row['Content_Type_one'], $row['content'], $row['id'], $row['tmp_code'], $row['numberofimg'], array($row['Content_Type_one'], $row['Content_Type_two'], $row['Content_Type_three'], $row['Content_Type_four']));
		}
		$stmt6 = $pro_bdd->prepare("SELECT id FROM sub WHERE w = :w AND s = :s");
		$stmt6->execute([
			'w' => $id_user,
			's' => $id_user_live
		]);
		$resultat6 = $stmt6->rowCount();
		$stmt7 = $pro_bdd->prepare('SELECT state FROM sub WHERE s = :s AND w = :w');
		$stmt7->execute([
			's' => $id_user,
			'w' => $id_user_live
		]);
		$resultat7 = $stmt7->rowCount();
		$resultat7b = $stmt7->fetch();
		$stmt8 = $pro_bdd->prepare('SELECT * FROM users WHERE use_code = :id_user');
		$stmt8->execute(array('id_user' => $id_user_live));
		$resultat8 = $stmt8->fetch();
	}
	else{
		echo "error";
	}
}
else{
	echo "error";
}
function formatNumber($number) {
  if ($number < 1000) {
    return $number;
  } elseif ($number < 1000000) {
    return floor($number / 1000) . 'k';
  } else {
    return floor($number / 1000000) . 'M';
  }
}
if ($resultat8['pp'] == 1) {
	$pp = $resultat8['use_code'] . "_pp.png";
}else{
	$pp = "noimage.jpeg";
}
if ($resultat2['ban'] == 1) {
	$ban = $resultat1['use_code'] . "_ban.png";
}else{
	$ban = "nobanner.png";
}
if ($resultat1['pp'] == 1) {
	$pp_user = $resultat1['use_code'] . "_pp.png";
}else{
	$pp_user = "noimage.jpeg";
}
?>
<!DOCTYPE html>
<html lang="french" id="html">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes"/>
	<title><?= htmlspecialchars($resultat1['pseudo'], ENT_HTML5); ?></title>
	<link rel="stylesheet" type="text/css" href="CSS/style_profile4.css">
	<link rel="stylesheet" type="text/css" href="CSS/comment_page.css">
	<link rel="stylesheet" type="text/css" href="CSS/emojionearea.min2.css">
	<link rel="stylesheet" type="text/css" href="CSS/slider.css">
	<link rel="stylesheet" type="text/css" href="CSS/checkbox.css">
	<link rel="stylesheet" type="text/css" href="CSS/burgermunu3.css">
	<link rel="shortcut icon" href="IMG/favicon.png" />
	<link rel="stylesheet" type="text/css" href="CSS/annimation.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="JS/emojionearea.min.js"></script>
	<script type="text/javascript">const id_user = "<?= $id_user ?>";var srcimgtab=[];const id_user_live = "<?= $id_user_live ?>";const identity = <?php if($identity == true){echo("true");}else{echo("false");} ?>;</script>
</head>
<body>
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
	<div id="content_all" style="display:none;">
		<div class="div_banner_info nonSelectionnable" style="background-image: url('img_user/<?= $ban ?>');background-color: #fff;">
			<div class="content_div_info">
				<div style="padding-left: 20px;">
					<?php if ($vbs == true) {
						?>
					<img src="IMG/sub.png" height="30px" width="30px" class="nonSelectionnable sub_click" onclick="get_sub();"><span class="nonSelectionnable span_info_sub sub_click" onclick="get_sub();"><?= formatNumber($resultat3); ?></span><br>
					<?php
					} ?>
					<?php if ($vtl == true) {
						?>
					<img src="IMG/coeur.png" height="30px" width="30px" class="nonSelectionnable"><span class="nonSelectionnable span_info_like"><?= formatNumber($resultat4); ?></span>
					<?php
					} ?>
				</div>
			</div>
		</div>
		<div class="content_all_excp_banner">
			<div id="panel-comment-demand" style="height: 100%; width: 100%; position: fixed; background-color: rgba(0, 0, 0, 0.5);z-index:1000;display: none;">
				<a role="button" onclick="hide_comment_demand_reverse('panel-comment-demand');" class="cross_edit nonSelectionnable close_cross" style="float: right;cursor: pointer;font-size: 50px;padding: 20px;">✖</a>
				<div class="content_figure_img_comment">
					<figure id="content_img_comment" class="nonSelectionnable">
						<div id="container_img_prem_comment" class="container">
						    <div class="slider">
								<img name="img-comment-1" id="slide1" src="IMG/noimage.jpeg" class="img-border imgcomment font-loading-img-comment active" style="animation: 1.5s shine linear infinite;">
								<img name="img-comment-2" id="slide2" src="IMG/image.jpg" class="img-border imgcomment font-loading-img-comment" style="animation: 1.5s shine linear infinite;">
								<img name="img-comment-3" id="slide3" src="IMG/noimage.jpeg" class="img-border imgcomment font-loading-img-comment" style="animation: 1.5s shine linear infinite;">
								<img name="img-comment-4" id="slide4" src="IMG/noimage.jpeg" class="img-border imgcomment font-loading-img-comment" style="animation: 1.5s shine linear infinite;">
						    </div>
						</div>
						<div id="cont-btn-comment">
							<div class="btn-nav left btn-nav-comment btn-nav-comment-left"><a onclick="" class="onclik_btn_nav_aff_comu" id="click_comment_slide_left" class="clik_slide_comment"><img src="IMG/before2.png" class="befaftbutt"></a></div>
							<div class="btn-nav right btn-nav-comment btn-nav-comment-right"><a onclick="" class="onclik_btn_nav_aff_comu" id="click_comment_slide_right" class="clik_slide_comment"><img src="IMG/next2.png" class="befaftbutt"></a></div>
						</div>
					</figure>
					<div class="left-part-comment-page">
						<div class="content-name-img-publish" style="display: flow-root;">
							<img class="nonSelectionnable img-publish-comment-pub nonSelectionnable" src="IMG/favicon.png">
							<label class="name-publish-comment-pub nonSelectionnable">Nerzus</label>
							<svg class='elem_img_pub' version='1.0' width='45px' height='45px' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1280.000000 1244.000000' preserveAspectRatio='xMidYMid meet'><metadata>Created by potrace 1.15, written by Peter Selinger 2001-2017</metadata><g transform='translate(0.000000,1244.000000) scale(0.100000,-0.100000)' fill='' id='like-div-aff'><path onclick='' id='path_pub_img' d='M3595 10494 c-16 -2 -73 -9 -125 -15 -785 -89 -1525 -534 -1950 -1172 -505 -756 -581 -1802 -203 -2762 234 -592 615 -1136 1223 -1746 440 -440 761 -713 1790 -1521 723 -568 973 -780 1280 -1088 285 -285 475 -527 591 -753 24 -48 46 -87 49 -87 3 0 20 29 38 65 150 304 458 666 907 1066 253 225 441 378 1130 919 900 707 1207 970 1640 1404 468 469 775 866 1023 1321 414 761 537 1622 342 2391 -112 440 -324 822 -635 1143 -523 540 -1245 841 -2014 841 -899 0 -1671 -412 -2116 -1130 -112 -182 -234 -457 -288 -651 -21 -74 -37 -101 -37 -61 0 45 -109 334 -184 487 -367 749 -1011 1208 -1876 1335 -75 11 -528 22 -585 14z' style='cursor:pointer;stroke: #000;stroke-width: 860px;' id='like-div-JTIqPE7PuSwDzFJJfgoNEX5wyidssg5KcSfZpS3CLhBgUxYVEcDePvixCDHo' class='state_like_JTIqPE7PuSwDzFJJfgoNEX5wyidssg5KcSfZpS3CLhBgUxYVEcDePvixCDHo'></path></g></svg>
							<span class='elem_img_pub cc_pub_img' id="cc_pub"></span>
						</div>
						<div class="slice-comment slice-comment-top"></div>
						<div id="content_info_comment_aff">
							<div class="content-description-comment-pub">
								<p id="txtpubcomment">Comment of the publication</p>
							</div>
							<div class="slice-comment slice-comment-top-bottom"></div>
							<div id="comment-content-all">
							</div>
						</div>
						<div>		
							<div class="textareacomment" id="textareacomment" style="transition: margin-top 1s, height 1.5s, width 1s, margin-left 1s;transition-delay: 0.5s;">
								<textarea placeholder="Commentez ... Discuter ..." onclick="commentchange();applyStylesOnResize();" id="textareacommentelement" maxlength="255"></textarea>
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
							<div id="divsendbotton"><img src="IMG/send-message.png" id="sendimgcomment" onclick="" style="pointer-events: all;"><div id="nbr-carac-txt-comment" class="nbr_carac_text_area_comment">0/255</div></div>	
						</div>
					</div>
				</div>
				<div class="content-action-comment">
					<?php 
					if ($id_user == $id_user_live && $identity == true) {
						?>
							<a title="supprimer la pulication" class="link-action-comment nonSelectionnable" onclick="" id="sup_pub"><img src="IMG/bin_black.png" class="supp-action-com"></a>
							<a title="modifier la publication" class="link-action-comment linksuit nonSelectionnable" onclick="" id="mod_pub"><img src="IMG/pencil.png" class="mod-action-com"></a>
						<?php
					}
					?>
					<a title="signaler la publication" class="link-action-comment linksuit nonSelectionnable" onclick="" id="sign_pub"><img src="IMG/x-mark.png" class="sign-action-com"></a>
				</div>
			</div>
			<div id="panel-txt" style="height: 100%; width: 100%; position: fixed; display: none; background-color: rgba(0, 0, 0, 0.5);z-index:1000;">
				<a role="button" onclick="hide_txt_panel_reverse();" class="cross_edit nonSelectionnable close_cross" id="cross_remove_txt_panel">✖</a>
				<div id="form_pub_txt" style="margin-left: auto;margin-right: auto;">				
					<form method="POST" class="form_pub_text" enctype="multipart/form-data" id="formtextpub">
						<div class="text_area_txt" id="content_text_area_txt-panel">
							<textarea name="content_publication"id="textareatext" required></textarea>
							<script>
								$(document).ready(function() {
									$("#textareatext").emojioneArea({
										pickerPosition: "left",
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
						<div class="sign_page">
							<h3 class="sign_title nonSelectionnable">Signaler</h3>
						<?php 
						$sign_ad = [trim($langue[18], '"'), trim($langue[19], '"'), trim($langue[20], '"'), trim($langue[21], '"'), trim($langue[22], '"'), trim($langue[23], '"'), trim($langue[24], '"'), trim($langue[25], '"')];
						for ($i=0; $i<count($sign_ad); $i++) { ?>
							<div class="checkbox-wrapper-4">
								<input class="inp-cbx searchcheck" id="morning-<?= $i ?>" type="checkbox" value="<?= $i ?>">
								<label class="cbx" for="morning-<?= $i ?>">
									<span><svg class="svg_sign"><use xlink:href="#check-4"></use></svg></span>
									<span class="span_sign"><?= $sign_ad[$i] ?></span>
								</label>
								<svg class="inline-svg">
									<symbol id="check-4" viewBox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol>
								</svg>
							</div>
						<?php } ?>
							<textarea class="textarea_sign" maxlength="250" placeholder="Merci de décrire en quelque mots votre signalement." required></textarea>
						</div>
						<br>
						<div class="input_txt_area">
							<input onclick="" id="submit" name="" value="Publier" type="submit" class="submit_txt nonSelectionnable" style="cursor: pointer; margin-top: 25px;">
						</div>
						<span class="mess_sign nonSelectionnable"><?= trim($langue[26], '"') ?></span>
						<div class="nonSelectionnable sign_page mess_sub_div">
							<span id="span_sub"></span>
							<br>
							<?php
							if ($id_user_live == $id_user && $identity == true) {
								?>
								<button class="butt_sub" onclick="ban_sub();" style="display:none;"><?= trim($langue[27], '"') ?></button><button class="butt_sub g_bt_sub" onclick="friend_sub(1);" style="display:none;"><?= trim($langue[28], '"') ?></button><button class="butt_sub g_bt_sub" onclick="friend_sub(2);" style="display:none;"><?= trim($langue[29], '"') ?></button>
								<?php
							}
							?>
							<div class="mess_sub"></div>
						</div>
					</form>
				</div>
			</div>
			<div class="content_info">
				<div class="content_stat_profile">
					<div class="content_imgprofile">
						<img src="img_user/<?= $pp_user ?>" class="nonSelectionnable img_profile" height="100%" width="100%"><span class="nonSelectionnable span_info_profile" id="span_profile_name"><?= htmlspecialchars($resultat1['pseudo'], ENT_HTML5); ?></span>
					</div>
					<div class="content_span_info_profile_two nonSelectionnable"><span class="span_info_profile_two"><?= htmlspecialchars($resultat1['pseudo'], ENT_HTML5); ?></span></div>
					<div class="nonSelectionnable div_content_button">
					<?php 
					if ($id_user != $id_user_live && $resultat7b[0] != 2 && $identity == true) {
						if ($resultat6 == 1) {
							$style_butt_sub_1 = 'display:none;';
							$style_butt_sub_2 = 'display:inline-block;';
						}
						else{
							$style_butt_sub_1 = 'display:inline-block;';
							$style_butt_sub_2 = 'display:none;';
						}
						?>
							<div class="div_content_button_sub" onclick="decribe();" style="background-color: red;<?= $style_butt_sub_2 ?>" id="unsub_butt"><span class="span_button_sub">Ne plus suivre</span></div>
							<div class="div_content_button_sub" onclick="subcribe();" style="<?= $style_butt_sub_1 ?>" id="sub_butt"><img src="IMG/follow.png" class="img_button_sub"><span class="span_button_sub"><?= trim($langue[30], '"') ?></span></div>
							<?php
							if ($resultat7 == 1) {
								if ($resultat7b[0] == 1) {
									?>
									<div class="div_content_button_joinfriend" onclick="friend_submit(2)"><img src="IMG/star_white.png" class="img_button_joinfriend"><span class="span_button_joinfriend"><?= trim($langue[29], '"') ?></span></div>
									<?php
								}
								else if ($resultat7b[0] == 0) {
									?>
									<div class="div_content_button_joinfriend" onclick="friend_submit(1);"><img src="IMG/star_white.png" class="img_button_joinfriend"><span class="span_button_joinfriend"><?= trim($langue[28], '"') ?></span></div>
									<?php
								}
							}
							?>
						<?php
					}
					else if ($resultat7b[0] == 2) {
						?>
						<div class="div_content_button_sub" style="background-color: red;cursor: default;" id="unsub_butt"><span class="span_button_sub"><?= trim($langue[32], '"') ?></span></div>
						<?php
					}
					if ($id_user == $id_user_live && $identity == true) {
						?>
						<div class="div_content_button_joinfriend" onclick="window.location.href = 'http://localhost/settings';" style="background-color: #FF00BF;margin-top: 5px;"><span class="span_button_joinfriend"><?= trim($langue[31], '"') ?></span></div>
						<?php
					}
					?>
					</div>
					<div class="nonSelectionnable content_info_sub_like_two">
						<?php if ($vbs == true) {
						?>
						<img src="IMG/sub.png" height="30px" width="30px" class="nonSelectionnable sub_click" onclick="get_sub();"><span class="nonSelectionnable sub_click span_info_sub" onclick="get_sub();"><?= formatNumber($resultat3); ?></span>
						<?php
						} ?>
						<?php if ($vtl == true) {
						?>
						<img src="IMG/coeur.png" height="30px" width="30px" class="nonSelectionnable"><span class="nonSelectionnable span_info_like"><?= formatNumber($resultat4); ?></span>
						<?php
						} ?>
					</div>
					<div style="height: 20px;"></div>
					<div class="div_content_quote_img_enter"><img src="IMG/gillemetopen.png" class="nonSelectionnable" height="100%" width="100%"></div><br>
					<p class="p_content_quote"><?= htmlspecialchars($resultat2['desp'], ENT_HTML5); ?></p>
					<br><div class="div_content_quote_img_close"><img src="IMG/gillemetclose.png" class="nonSelectionnable" height="100%" width="100%"></div>
					<br>
					<?php if ($vpi == true) {
						?>
					<div class="div_content_info_card">
						<img src="IMG/maison.png" height="34px" width="34px" class="nonSelectionnable"><span class="span_info_card"><?= htmlspecialchars($resultat2['live'], ENT_HTML5); ?></span>
					</div>
					<br>
					<?php
					} ?>
					<?php if ($vrn == true) {
						?>
					<div class="div_content_info_card">
						<img src="IMG/id-card.png" height="34px" width="34px" class="nonSelectionnable"><span class="span_info_card"><?= htmlspecialchars($resultat1['first_name'], ENT_HTML5)." ".htmlspecialchars($resultat1['last_name'], ENT_HTML5); ?></span>
					</div>
					<br>
					<?php
					} ?>
					<?php if ($vpi == true) {
						?>
					<div class="div_content_info_card">
						<img src="IMG/school.png" height="34px" width="34px" class="nonSelectionnable"><span class="span_info_card"><?= htmlspecialchars($resultat2['school'], ENT_HTML5); ?></span>
					</div>
					<br>
					<div class="div_content_info_card">
						<img src="IMG/sacs.png" height="34px" width="34px" class="nonSelectionnable"><span class="span_info_card"><?= htmlspecialchars($resultat2['works'], ENT_HTML5); ?></span>
					</div>
					<br>
					<?php
					} ?>
					<div class="div_content_info_card">
						<img src="IMG/lhorloge.png" height="34px" width="34px" class="nonSelectionnable"><span class="span_info_card"><?= $date_echo ?></span>
					</div>
				</div>
				<div class="content_div_all_bdg">
					<div class="nonSelectionnable div_content_all_bdg">
						<div class="tooltip div_bdg" id="ad">
							<img src="IMG/admin.png" class="nonSelectionnable badge">
							<span class="tooltiptext nonSelectionnable"><?= trim($langue[33], '"') ?></span>
						</div>
						<div class="tooltip div_bdg" id="mod">
							<img src="IMG/modo.png" class="nonSelectionnable badge">
							<span class="tooltiptext nonSelectionnable"><?= trim($langue[34], '"') ?></span>
						</div>
						<div class="tooltip div_bdg" id="cd">
							<img src="IMG/colabo.png" class="nonSelectionnable badge">
							<span class="tooltiptext nonSelectionnable"><?= trim($langue[35], '"') ?></span>
						</div>
						<div class="tooltip div_bdg" id="act">
							<img src="IMG/actif.png" class="nonSelectionnable badge">
							<span class="tooltiptext nonSelectionnable"><?= trim($langue[36], '"') ?></span>
						</div>
						<div class="tooltip div_bdg" id="voy">
							<img src="IMG/voyage.png" class="nonSelectionnable badge">
							<span class="tooltiptext nonSelectionnable"><?= trim($langue[37], '"') ?></span>
						</div>
						<div class="tooltip div_bdg" id="cert">
							<img src="IMG/certif.png" class="nonSelectionnable badge">
							<span class="tooltiptext nonSelectionnable tooltiptextfin"><?= trim($langue[38], '"') ?></span>
						</div>
					</div>
					<script type="text/javascript">
						const colorData_bdg = '<?= $resultat2['badge'] ?>';
						const colors_bdg = JSON.parse(colorData_bdg);
						let zero_count = 0;
						for (const [key, value] of Object.entries(colors_bdg)) {
						  const element = document.querySelector('#' + key);
						  if (value === 1) {
						    element.style.display = 'inline-block';
						  } else {
						    element.style.display = 'none';
						    zero_count++;
						  }
						}
						if (zero_count != Object.keys(colors_bdg).length) {
							document.querySelector('.content_div_all_bdg').style.display = "block";
						}
					</script>
				</div>
				<div class="nonSelectionnable div_content_all_suggestion" style="display: none;">
					<span class="span_title_suggestion">Suggestion :</span>
					<div class="div_content_profile_suggest vers_content_profile_one">
						<div class="second_div_content_profile_suggest">
							<div class="div_content_user_one">
								<div class="div_content_profile_img_suggest">
									<img src="IMG/profile4.jpg" class="nonSelectionnable img_profile_suggest" height="100%" width="100%">
								</div>
								<span class="span_profile_suggest_name">Benedict Lerouge</span>
							</div>
							<div class="div_content_profile_suggest_suite div_content_user_two">					
								<div class="div_content_profile_img_suggest">
									<img src="IMG/profile2.jpg" class="nonSelectionnable img_profile_suggest" height="100%" width="100%">
								</div>
								<span class="span_profile_suggest_name">Jasmine Ivine</span><br>
								<div class="tooltip hidden_div_info_friend_suggest_profile">
									<span style="color: white; font-weight: bold;">amis de</span>
									<span class="tooltiptextfriend">Katherine</span>
								</div>
							</div>
							<div class="div_content_profile_suggest_suite div_content_user_three">
								<div class="div_content_profile_img_suggest">
									<img src="IMG/profile3.jpg" class="nonSelectionnable img_profile_suggest" height="100%" width="100%">
								</div>
								<span class="span_profile_suggest_name">Claude Tiati</span><br>
								<div class="tooltip hidden_div_info_friend_suggest_profile">
									<span style="color: white; font-weight: bold;">amis de</span>
									<span class="tooltiptextfriend">Thierry</span>
								</div>
							</div>
						</div>
						<div style="margin-top: 30px;">
							<div class="div_content_user_one">
								<div class="div_content_profile_img_suggest">
									<img src="IMG/profile6.jpg" class="nonSelectionnable img_profile_suggest" height="100%" width="100%">
								</div>
								<span class="span_profile_suggest_name">Sabrina Rave</span>
							</div>
							<div class="div_content_profile_suggest_suite div_content_user_two">
								<div class="div_content_profile_img_suggest">
									<img src="IMG/profile5.jpg" class="nonSelectionnable img_profile_suggest" height="100%" width="100%">
								</div>
								<span class="span_profile_suggest_name">Yves Guillau</span><br>
								<div class="tooltip hidden_div_info_friend_suggest_profile">
									<span style="color: white; font-weight: bold;">amis de</span>
									<span class="tooltiptextfriend">Fred</span>
								</div>
							</div>
							<div class="div_content_profile_suggest_suite div_content_user_three">
								<div class="div_content_profile_img_suggest">
									<img src="IMG/profile7.jpg" class="nonSelectionnable img_profile_suggest" height="100%" width="100%">
								</div>
								<span class="span_profile_suggest_name">Freddy Uliti</span>
							</div>
						</div>
					</div>
					<!-- --------------------------------------------------------------------------------------------------------------------- -->
					<div class="div_content_profile_suggest vers_content_profile_two">
						<div class="second_div_content_profile_suggest">
							<div class="div_content_user_one">
								<div class="div_content_profile_img_suggest">
									<img src="IMG/profile4.jpg" class="nonSelectionnable img_profile_suggest" height="100%" width="100%">
								</div>
								<span class="span_profile_suggest_name">Benedict Lerouge</span>
							</div>
							<div class="div_content_profile_suggest_suite div_content_user_two">					
								<div class="div_content_profile_img_suggest">
									<img src="IMG/profile2.jpg" class="nonSelectionnable img_profile_suggest" height="100%" width="100%">
								</div>
								<span class="span_profile_suggest_name">Jasmine Ivine</span><br>
								<div class="tooltip hidden_div_info_friend_suggest_profile">
									<span style="color: white; font-weight: bold;">amis de</span>
									<span class="tooltiptextfriend">Katherine</span>
								</div>
							</div>
						</div>
						<div style="margin-top: 30px;">
							<div class="second_div_content_profile_suggest">
								<div class="div_content_user_one">
									<div class="div_content_profile_img_suggest">
										<img src="IMG/profile6.jpg" class="nonSelectionnable img_profile_suggest" height="100%" width="100%">
									</div>
									<span class="span_profile_suggest_name">Sabrina Rave</span>
								</div>
								<div class="div_content_profile_suggest_suite div_content_user_two">
									<div class="div_content_profile_img_suggest">
										<img src="IMG/profile3.jpg" class="nonSelectionnable img_profile_suggest" height="100%" width="100%">
									</div>
									<span class="span_profile_suggest_name">Claude Tiati</span><br>
									<div class="tooltip hidden_div_info_friend_suggest_profile">
										<span style="color: white; font-weight: bold;">amis de</span>
										<span class="tooltiptextfriend">Thierry</span>
									</div>
								</div>
							</div>
						</div>
						<div style="margin-top: 30px;">
							<div class="div_content_user_one">
								<div class="div_content_profile_img_suggest">
									<img src="IMG/profile5.jpg" class="nonSelectionnable img_profile_suggest" height="100%" width="100%">
								</div>
								<span class="span_profile_suggest_name">Yves Guillau</span><br>
								<div class="tooltip hidden_div_info_friend_suggest_profile">
									<span style="color: white; font-weight: bold;">amis de</span>
									<span class="tooltiptextfriend">Fred</span>
								</div>
							</div>
							<div class="div_content_profile_suggest_suite div_content_user_two">
								<div class="div_content_profile_img_suggest">
									<img src="IMG/profile7.jpg" class="nonSelectionnable img_profile_suggest" height="100%" width="100%">
								</div>
								<span class="span_profile_suggest_name">Freddy Uliti</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php if ($vp == true) {
			?>
			<div class="sps_art">
				<div class="content_art nonSelectionnable vers_art_content_one">
					<?php
						$count_img_pub = 0;
						for ($i=0; $i < count($resultat5); $i++) { 
							if ($resultat5[$i][0] != null) {
							  $count_img_pub++;
							}
						}
						if ($count_img_pub == 1) {
							?>
							<style type="text/css">
								.zoom_art_prep_prime:hover {
									margin-left: 25px;
									margin-top: 9.2px;
								}
							</style>
							<?php
						}
						$count_pub = 0;
						$prem = 0;
						foreach($resultat5 as $resultat) {
						    if ($resultat[0] == null) {
						        continue;
						    }
						    $filename = $resultat[0] . "_1.";
						    $src_img = [];
						    $length_img = $resultat[5];
						    for ($i=0; $i < $length_img; $i++) {
						    	array_push($src_img, [$resultat[6][$i], $resultat[0]]);
						    }
						    switch ($resultat[1]) {
						        case 1:
						            $filename .= "gif";
						            break;
						        case 2:
						            $filename .= "jpeg";
						            break;
						        case 3:
						        case 4:
						            $filename .= "png";
						            break;
						        default:
						            // Erreur
						            break;
						    }
						    if ($prem == 0) {
						    	echo "<div id='".$resultat[3]."' class='artprep zoom_art_prep_prime prime_art zoom_art_general artgeneral' title='".htmlspecialchars($resultat[2], ENT_QUOTES, 'UTF-8')."' onclick='comment_aff();initilisation_comment_page(".$resultat[3].");applyStylesOnResize();'><img src='img_pub/" . $filename . "' height='100%' width='100%'\ class='nonSelectionnable'><div id='info-".$resultat[3]."' style='display: none;'>".$resultat[4]."</div><script type='text/javascript'>src_img = JSON.parse('".json_encode($src_img)."');srcimgtab['".$resultat[3]."'] = src_img;</script></div>";
						    	$prem = 1;
						    	$count_pub++;
						    }
						    elseif ($count_pub == 0) {
						    	echo "<div id='".$resultat[3]."' class='artprep zoom_art_prep zoom_art_general artgeneral' title='".htmlspecialchars($resultat[2], ENT_QUOTES, 'UTF-8')."' onclick='comment_aff();initilisation_comment_page(".$resultat[3].");applyStylesOnResize();'><img src='img_pub/" . $filename . "' height='100%' width='100%'\ class='nonSelectionnable'><div id='info-".$resultat[3]."' style='display: none;'>".$resultat[4]."</div><script type='text/javascript'>src_img = JSON.parse('".json_encode($src_img)."');srcimgtab['".$resultat[3]."'] = src_img;</script></div>";
						    	$count_pub++;
						    }
						    elseif ($count_pub == 4) {
						    	echo "<div id='".$resultat[3]."' class='artsuite zoom_art zoom_art_general artgeneral' title='".htmlspecialchars($resultat[2], ENT_QUOTES, 'UTF-8')."' onclick='comment_aff();initilisation_comment_page(".$resultat[3].");applyStylesOnResize();'><img src='img_pub/" . $filename . "' height='100%' width='100%'\ class='nonSelectionnable'><div id='info-".$resultat[3]."' style='display: none;'>".$resultat[4]."</div><script type='text/javascript'>src_img = JSON.parse('".json_encode($src_img)."');srcimgtab['".$resultat[3]."'] = src_img;</script></div><br>";
						    	$count_pub++;
						    }
						    else{
						    	echo "<div id='".$resultat[3]."' class='artsuite zoom_art zoom_art_general artgeneral' title='".htmlspecialchars($resultat[2], ENT_QUOTES, 'UTF-8')."' onclick='comment_aff();initilisation_comment_page(".$resultat[3].");applyStylesOnResize();'><img src='img_pub/" . $filename . "' height='100%' width='100%'\ class='nonSelectionnable'><div id='info-".$resultat[3]."' style='display: none;'>".$resultat[4]."</div><script type='text/javascript'>src_img = JSON.parse('".json_encode($src_img)."');srcimgtab['".$resultat[3]."'] = src_img;</script></div>";
						    	$count_pub++;
						    }
						    if ($count_pub == 5) {
						    	$count_pub = 0;
						    }
						    $tab_pub[$resultat[3]] = $resultat[4];
						}
					?>
					<br>
					<div class="content_pub_text" style="display: inline-block;width: 100%;">
						<?php
							$count_pub = 0;
							$i_txt = 0;
							foreach($resultat5 as $resultat) {
							    if ($resultat[0] != null) {
							        continue;
							    }
							    $stmt_text_1 = $db->prepare('SELECT id FROM like_pub WHERE user = :user AND pub = :pub');
							    $stmt_text_1->execute([
							    	'user' => $id_user_live,
							    	'pub' => $resultat[4]
							    ]);
							    if ($stmt_text_1->rowCount() == 1) {
							    	$color_hearth = '#ff0000';
							    }
							    else{
							    	$color_hearth = '#ffff';
							    }
							    $stmt_text_2 = $db->prepare('SELECT id FROM like_pub WHERE pub = :pub');
							    $stmt_text_2->execute([
							    	'pub' => $resultat[4]
							    ]);
							    $number_of_like = $stmt_text_2->rowCount();
							    if ($count_pub == 0) {
							    	echo "<div class='aff_pub_div_content art_txt_dbt' id='".$resultat[3]."' style='width:48%;'><div class='div_content_p_art_txt' style='max-width:65%;'><p class='p_content_txt_art' id='p-".$resultat[3]."'>".$resultat[2]."</p></div><div class='content_info_art_txt' style='width: 150px;'><svg class='elem_txt_pub' version='1.0' width='45px' height='45px' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1280.000000 1244.000000' preserveAspectRatio='xMidYMid meet'><metadata>Created by potrace 1.15, written by Peter Selinger 2001-2017</metadata><g transform='translate(0.000000,1244.000000) scale(0.100000,-0.100000)' fill='".$color_hearth."' id='like-div-".$resultat[3]."'><path onclick='like_db(".$resultat[3].");txt_art=1;' d='M3595 10494 c-16 -2 -73 -9 -125 -15 -785 -89 -1525 -534 -1950 -1172 -505 -756 -581 -1802 -203 -2762 234 -592 615 -1136 1223 -1746 440 -440 761 -713 1790 -1521 723 -568 973 -780 1280 -1088 285 -285 475 -527 591 -753 24 -48 46 -87 49 -87 3 0 20 29 38 65 150 304 458 666 907 1066 253 225 441 378 1130 919 900 707 1207 970 1640 1404 468 469 775 866 1023 1321 414 761 537 1622 342 2391 -112 440 -324 822 -635 1143 -523 540 -1245 841 -2014 841 -899 0 -1671 -412 -2116 -1130 -112 -182 -234 -457 -288 -651 -21 -74 -37 -101 -37 -61 0 45 -109 334 -184 487 -367 749 -1011 1208 -1876 1335 -75 11 -528 22 -585 14z' style='cursor:pointer;stroke: #000;stroke-width: 860px;' id='like-div-JTIqPE7PuSwDzFJJfgoNEX5wyidssg5KcSfZpS3CLhBgUxYVEcDePvixCDHo' class='state_like_JTIqPE7PuSwDzFJJfgoNEX5wyidssg5KcSfZpS3CLhBgUxYVEcDePvixCDHo'></path></g></svg><span class='span_like elem_txt_pub' id='likepart-".$resultat[3]."'>".$number_of_like."</span><svg class='elem_txt_pub' version='1.1' id='Capa_1' xmlns='http://www.w3.org/2000/svg' style='margin-right:10px;margin-top: 4px;' width='45px' height='40px' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' viewBox='0 0 443.541 443.541' xml:space='preserve'><g><g><path d='M76.579,433.451V335.26C27.8,300.038,0,249.409,0,195.254C0,93.155,99.486,10.09,221.771,10.09s221.771,83.065,221.771,185.164s-99.486,185.164-221.771,185.164c-14.488,0-29.077-1.211-43.445-3.604L76.579,433.451z' style='stroke: #000;stroke-width: 30px;cursor: pointer;fill: #71ff00;'onclick='comment_aff();comment_txt(".$resultat[3].");applyStylesOnResize();'/></div></div>
									</g>
									</g>
							</svg>";
							    	$count_pub++;
							    	$i_txt++;
							    }
							    elseif ($count_pub == 1) {
							    	echo "<div class='aff_pub_div_content art_txt_fns' id='".$resultat[3]."' style='width:48%'><div class='div_content_p_art_txt' style='max-width:75%;'><p class='p_content_txt_art' id='p-".$resultat[3]."'>".$resultat[2]."</p></div><div class='content_info_art_txt'><svg class='elem_txt_pub' version='1.0' width='45px' height='45px' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1280.000000 1244.000000' preserveAspectRatio='xMidYMid meet'><metadata>Created by potrace 1.15, written by Peter Selinger 2001-2017</metadata><g transform='translate(0.000000,1244.000000) scale(0.100000,-0.100000)' fill='".$color_hearth."' id='like-div-".$resultat[3]."'><path onclick='like_db(".$resultat[3].");txt_art=1;' d='M3595 10494 c-16 -2 -73 -9 -125 -15 -785 -89 -1525 -534 -1950 -1172 -505 -756 -581 -1802 -203 -2762 234 -592 615 -1136 1223 -1746 440 -440 761 -713 1790 -1521 723 -568 973 -780 1280 -1088 285 -285 475 -527 591 -753 24 -48 46 -87 49 -87 3 0 20 29 38 65 150 304 458 666 907 1066 253 225 441 378 1130 919 900 707 1207 970 1640 1404 468 469 775 866 1023 1321 414 761 537 1622 342 2391 -112 440 -324 822 -635 1143 -523 540 -1245 841 -2014 841 -899 0 -1671 -412 -2116 -1130 -112 -182 -234 -457 -288 -651 -21 -74 -37 -101 -37 -61 0 45 -109 334 -184 487 -367 749 -1011 1208 -1876 1335 -75 11 -528 22 -585 14z' style='cursor:pointer;stroke: #000;stroke-width: 860px;' id='like-div-JTIqPE7PuSwDzFJJfgoNEX5wyidssg5KcSfZpS3CLhBgUxYVEcDePvixCDHo' class='state_like_JTIqPE7PuSwDzFJJfgoNEX5wyidssg5KcSfZpS3CLhBgUxYVEcDePvixCDHo'></path></g></svg><span class='span_like elem_txt_pub' id='likepart-".$resultat[3]."'>".$number_of_like."</span><svg class='elem_txt_pub' version='1.1' id='Capa_1' xmlns='http://www.w3.org/2000/svg' style='margin-right:10px;margin-top: 4px;' width='45px' height='40px' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' viewBox='0 0 443.541 443.541' xml:space='preserve'><g><g><path d='M76.579,433.451V335.26C27.8,300.038,0,249.409,0,195.254C0,93.155,99.486,10.09,221.771,10.09s221.771,83.065,221.771,185.164s-99.486,185.164-221.771,185.164c-14.488,0-29.077-1.211-43.445-3.604L76.579,433.451z' style='stroke: #000;stroke-width: 30px;cursor: pointer;fill: #71ff00;'onclick='comment_aff();comment_txt(".$resultat[3].");applyStylesOnResize();'/></div></div>";
							    	$count_pub = 0;
							    	$i_txt++;
							    }
							    $tab_pub[$resultat[3]] = $resultat[4];
							}
						?>
					</div>
				</div>
				<div class="content_art nonSelectionnable vers_art_content_two">
					<?php
						$count_pub = 0;
						$prem = 0;
						foreach($resultat5 as $resultat) {
						    if ($resultat[0] == null) {
						        continue;
						    }
						    $filename = $resultat[0] . "_1.";
						    switch ($resultat[1]) {
						        case 1:
						            $filename .= "gif";
						            break;
						        case 2:
						            $filename .= "jpeg";
						            break;
						        case 3:
						        case 4:
						            $filename .= "png";
						            break;
						        default:
						            break;
						    }
						    if ($prem == 0) {
						    	echo '<div id="'.$resultat[3].'" class="artprep zoom_art_prep_prime prime_art zoom_art_general artgeneral" title="'.htmlspecialchars($resultat[2], ENT_QUOTES, 'UTF-8').'" onclick="comment_aff();initilisation_comment_page('.$resultat[3].');applyStylesOnResize();"><img src="img_pub/' . $filename . '" height="100%" width="100%" class="nonSelectionnable"></div>';
						    	$prem = 1;
						    	$count_pub++;
						    }
						    elseif ($count_pub == 0) {
						    	echo '<div id="'.$resultat[3].'" class="artprep zoom_art_prep zoom_art_general artgeneral" title="'.htmlspecialchars($resultat[2], ENT_QUOTES, 'UTF-8').'" onclick="comment_aff();initilisation_comment_page('.$resultat[3].');applyStylesOnResize();"><img src="img_pub/' . $filename . '" height="100%" width="100%" class="nonSelectionnable"></div>';
						    	$count_pub++;
						    }
						    elseif ($count_pub == 3) {
						    	echo '<div id="'.$resultat[3].'" class="artsuite zoom_art zoom_art_general artgeneral" title="'.htmlspecialchars($resultat[2], ENT_QUOTES, 'UTF-8').'" onclick="comment_aff();initilisation_comment_page('.$resultat[3].');applyStylesOnResize();"><img src="img_pub/' . $filename . '" height="100%" width="100%" class="nonSelectionnable"></div><br>';
						    	$count_pub++;
						    }
						    else{
						    	echo '<div id="'.$resultat[3].'" class="artsuite zoom_art zoom_art_general artgeneral" title="'.htmlspecialchars($resultat[2], ENT_QUOTES, 'UTF-8').'" onclick="comment_aff();initilisation_comment_page('.$resultat[3].');applyStylesOnResize();"><img src="img_pub/' . $filename . '" height="100%" width="100%" class="nonSelectionnable"></div>';
						    	$count_pub++;
						    }
						    if ($count_pub == 4) {
						    	$count_pub = 0;
						    }
						    $tab_pub[$resultat[3]] = $resultat[4];
						}
					?>
					<br>
					<div class="content_pub_text" style="display: block;">
					<?php
						$count_pub = 0;
						$i_txt = 0;
						foreach($resultat5 as $resultat) {
						    if ($resultat[0] != null) {
						        continue;
						    }
						    $stmt_text_1 = $db->prepare('SELECT id FROM like_pub WHERE user = :user AND pub = :pub');
						    $stmt_text_1->execute([
						    	'user' => $id_user_live,
						    	'pub' => $resultat[4]
						    ]);
						    if ($stmt_text_1->rowCount() == 1) {
						    	$color_hearth = '#ff0000';
						    }
						    else{
						    	$color_hearth = '#ffff';
						    }
						    $stmt_text_2 = $db->prepare('SELECT id FROM like_pub WHERE pub = :pub');
						    $stmt_text_2->execute([
						    	'pub' => $resultat[4]
						    ]);
						    $number_of_like = $stmt_text_2->rowCount();
						    if ($count_pub == 0) {
						    	echo "<div class='aff_pub_div_content' id='".$resultat[3]."'><div class='div_content_p_art_txt'><p class='p_content_txt_art' id='p-".$resultat[3]."'>".$resultat[2]."</p></div><div class='content_info_art_txt'><svg class='elem_txt_pub' version='1.0' width='45px' height='45px' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1280.000000 1244.000000' preserveAspectRatio='xMidYMid meet'><metadata>Created by potrace 1.15, written by Peter Selinger 2001-2017</metadata><g transform='translate(0.000000,1244.000000) scale(0.100000,-0.100000)' fill='".$color_hearth."' id='like-div-".$resultat[3]."'><path onclick='like_db(".$resultat[3].");txt_art=1;' d='M3595 10494 c-16 -2 -73 -9 -125 -15 -785 -89 -1525 -534 -1950 -1172 -505 -756 -581 -1802 -203 -2762 234 -592 615 -1136 1223 -1746 440 -440 761 -713 1790 -1521 723 -568 973 -780 1280 -1088 285 -285 475 -527 591 -753 24 -48 46 -87 49 -87 3 0 20 29 38 65 150 304 458 666 907 1066 253 225 441 378 1130 919 900 707 1207 970 1640 1404 468 469 775 866 1023 1321 414 761 537 1622 342 2391 -112 440 -324 822 -635 1143 -523 540 -1245 841 -2014 841 -899 0 -1671 -412 -2116 -1130 -112 -182 -234 -457 -288 -651 -21 -74 -37 -101 -37 -61 0 45 -109 334 -184 487 -367 749 -1011 1208 -1876 1335 -75 11 -528 22 -585 14z' style='cursor:pointer;stroke: #000;stroke-width: 860px;' id='like-div-JTIqPE7PuSwDzFJJfgoNEX5wyidssg5KcSfZpS3CLhBgUxYVEcDePvixCDHo' class='state_like_JTIqPE7PuSwDzFJJfgoNEX5wyidssg5KcSfZpS3CLhBgUxYVEcDePvixCDHo'></path></g></svg><span class='span_like elem_txt_pub' id='likepart-".$resultat[3]."'>".$number_of_like."</span><svg class='elem_txt_pub' version='1.1' id='Capa_1' xmlns='http://www.w3.org/2000/svg' style='margin-right:10px;margin-top: 4px;' width='45px' height='40px' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' viewBox='0 0 443.541 443.541' xml:space='preserve'><g><g><path d='M76.579,433.451V335.26C27.8,300.038,0,249.409,0,195.254C0,93.155,99.486,10.09,221.771,10.09s221.771,83.065,221.771,185.164s-99.486,185.164-221.771,185.164c-14.488,0-29.077-1.211-43.445-3.604L76.579,433.451z' style='stroke: #000;stroke-width: 30px;cursor: pointer;fill: #71ff00;'onclick='comment_aff();comment_txt(".$resultat[3].");applyStylesOnResize();'/></div></div>";
						    	$count_pub++;
						    	$i_txt++;
						    }
						    elseif ($count_pub == 1) {
						    	echo "<div class='aff_pub_div_content' id='".$resultat[3]."'><div class='div_content_p_art_txt'><p class='p_content_txt_art' id='p-".$resultat[3]."'>".$resultat[2]."</p></div><div class='content_info_art_txt'><svg class='elem_txt_pub' version='1.0' width='45px' height='45px' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1280.000000 1244.000000' preserveAspectRatio='xMidYMid meet'><metadata>Created by potrace 1.15, written by Peter Selinger 2001-2017</metadata><g transform='translate(0.000000,1244.000000) scale(0.100000,-0.100000)' fill='".$color_hearth."' id='like-div-".$resultat[3]."'><path onclick='like_db(".$resultat[3].");txt_art=1;' d='M3595 10494 c-16 -2 -73 -9 -125 -15 -785 -89 -1525 -534 -1950 -1172 -505 -756 -581 -1802 -203 -2762 234 -592 615 -1136 1223 -1746 440 -440 761 -713 1790 -1521 723 -568 973 -780 1280 -1088 285 -285 475 -527 591 -753 24 -48 46 -87 49 -87 3 0 20 29 38 65 150 304 458 666 907 1066 253 225 441 378 1130 919 900 707 1207 970 1640 1404 468 469 775 866 1023 1321 414 761 537 1622 342 2391 -112 440 -324 822 -635 1143 -523 540 -1245 841 -2014 841 -899 0 -1671 -412 -2116 -1130 -112 -182 -234 -457 -288 -651 -21 -74 -37 -101 -37 -61 0 45 -109 334 -184 487 -367 749 -1011 1208 -1876 1335 -75 11 -528 22 -585 14z' style='cursor:pointer;stroke: #000;stroke-width: 860px;' id='like-div-JTIqPE7PuSwDzFJJfgoNEX5wyidssg5KcSfZpS3CLhBgUxYVEcDePvixCDHo' class='state_like_JTIqPE7PuSwDzFJJfgoNEX5wyidssg5KcSfZpS3CLhBgUxYVEcDePvixCDHo'></path></g></svg><span class='span_like elem_txt_pub' id='likepart-".$resultat[3]."'>".$number_of_like."</span><svg class='elem_txt_pub' version='1.1' id='Capa_1' xmlns='http://www.w3.org/2000/svg' style='margin-right:10px;margin-top: 4px;' width='45px' height='40px' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' viewBox='0 0 443.541 443.541' xml:space='preserve'><g><g><path d='M76.579,433.451V335.26C27.8,300.038,0,249.409,0,195.254C0,93.155,99.486,10.09,221.771,10.09s221.771,83.065,221.771,185.164s-99.486,185.164-221.771,185.164c-14.488,0-29.077-1.211-43.445-3.604L76.579,433.451z' style='stroke: #000;stroke-width: 30px;cursor: pointer;fill: #71ff00;'onclick='comment_aff();comment_txt(".$resultat[3].");applyStylesOnResize();'/></div></div>";
						    	$count_pub = 0;
						    	$i_txt++;
						    }
						    $tab_pub[$resultat[3]] = $resultat[4];
						}
					?>
					</div>
				</div>
				<div class="content_art nonSelectionnable vers_art_content_three">
					<?php
						$count_pub = 0;
						$prem = 0;
						foreach($resultat5 as $resultat) {
						    if ($resultat[0] == null) {
						        continue;
						    }
						    $filename = $resultat[0] . "_1.";
						    switch ($resultat[1]) {
						        case 1:
						            $filename .= "gif";
						            break;
						        case 2:
						            $filename .= "jpeg";
						            break;
						        case 3:
						        case 4:
						            $filename .= "png";
						            break;
						        default:
						            // Erreur
						            break;
						    }
						    if ($prem == 0) {
						    	echo '<div id="'.$resultat[3].'" class="artprep zoom_art_prep_prime prime_art zoom_art_general artgeneral" title="'.htmlspecialchars($resultat[2], ENT_QUOTES, 'UTF-8').'" onclick="comment_aff();initilisation_comment_page('.$resultat[3].');applyStylesOnResize();"><img src="img_pub/' . $filename . '" height="100%" width="100%" class="nonSelectionnable"></div>';
						    	$prem = 1;
						    	$count_pub++;
						    }
						    elseif ($count_pub == 0) {
						    	echo '<div id="'.$resultat[3].'" class="artprep zoom_art_prep zoom_art_general artgeneral" title="'.htmlspecialchars($resultat[2], ENT_QUOTES, 'UTF-8').'" onclick="comment_aff();initilisation_comment_page('.$resultat[3].');applyStylesOnResize();"><img src="img_pub/' . $filename . '" height="100%" width="100%" class="nonSelectionnable"></div>';
						    	$count_pub++;
						    }
						    elseif ($count_pub == 2) {
						    	echo '<div id="'.$resultat[3].'" class="artsuite zoom_art zoom_art_general artgeneral" title="'.htmlspecialchars($resultat[2], ENT_QUOTES, 'UTF-8').'" onclick="comment_aff();initilisation_comment_page('.$resultat[3].');applyStylesOnResize();"><img src="img_pub/' . $filename . '" height="100%" width="100%" class="nonSelectionnable"></div><br>';
						    	$count_pub++;
						    }
						    else{
						    	echo '<div id="'.$resultat[3].'" class="artsuite zoom_art zoom_art_general artgeneral" title="'.htmlspecialchars($resultat[2], ENT_QUOTES, 'UTF-8').'" onclick="comment_aff();initilisation_comment_page('.$resultat[3].');applyStylesOnResize();"><img src="img_pub/' . $filename . '" height="100%" width="100%" class="nonSelectionnable"></div>';
						    	$count_pub++;
						    }
						    if ($count_pub == 3) {
						    	$count_pub = 0;
						    }
						    $tab_pub[$resultat[3]] = $resultat[4];
						}
					?>
					<br>
					<div id="content_pub_txt" class="content_pub_text">
						<?php
							$count_pub = 0;
							$i_txt = 0;
							foreach($resultat5 as $resultat) {
							    if ($resultat[0] != null) {
							        continue;
							    }
							    $stmt_text_1 = $db->prepare('SELECT id FROM like_pub WHERE user = :user AND pub = :pub');
							    $stmt_text_1->execute([
							    	'user' => $id_user_live,
							    	'pub' => $resultat[4]
							    ]);
							    if ($stmt_text_1->rowCount() == 1) {
							    	$color_hearth = '#ff0000';
							    }
							    else{
							    	$color_hearth = '#ffff';
							    }
							    $stmt_text_2 = $db->prepare('SELECT id FROM like_pub WHERE pub = :pub');
							    $stmt_text_2->execute([
							    	'pub' => $resultat[4]
							    ]);
							    $number_of_like = $stmt_text_2->rowCount();
							    if ($count_pub == 0) {
							    	echo "<div class='aff_pub_div_content' id='".$resultat[3]."' style='width:100%;'><div class='div_content_p_art_txt'><p class='p_content_txt_art' id='p-".$resultat[3]."'>".$resultat[2]."</p></div><div class='content_info_art_txt'><svg class='elem_txt_pub' version='1.0' width='45px' height='45px' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1280.000000 1244.000000' preserveAspectRatio='xMidYMid meet'><metadata>Created by potrace 1.15, written by Peter Selinger 2001-2017</metadata><g transform='translate(0.000000,1244.000000) scale(0.100000,-0.100000)' fill='".$color_hearth."' id='like-div-".$resultat[3]."'><path onclick='like_db(".$resultat[3].");txt_art=1;' d='M3595 10494 c-16 -2 -73 -9 -125 -15 -785 -89 -1525 -534 -1950 -1172 -505 -756 -581 -1802 -203 -2762 234 -592 615 -1136 1223 -1746 440 -440 761 -713 1790 -1521 723 -568 973 -780 1280 -1088 285 -285 475 -527 591 -753 24 -48 46 -87 49 -87 3 0 20 29 38 65 150 304 458 666 907 1066 253 225 441 378 1130 919 900 707 1207 970 1640 1404 468 469 775 866 1023 1321 414 761 537 1622 342 2391 -112 440 -324 822 -635 1143 -523 540 -1245 841 -2014 841 -899 0 -1671 -412 -2116 -1130 -112 -182 -234 -457 -288 -651 -21 -74 -37 -101 -37 -61 0 45 -109 334 -184 487 -367 749 -1011 1208 -1876 1335 -75 11 -528 22 -585 14z' style='cursor:pointer;stroke: #000;stroke-width: 860px;' id='like-div-JTIqPE7PuSwDzFJJfgoNEX5wyidssg5KcSfZpS3CLhBgUxYVEcDePvixCDHo' class='state_like_JTIqPE7PuSwDzFJJfgoNEX5wyidssg5KcSfZpS3CLhBgUxYVEcDePvixCDHo'></path></g></svg><span class='span_like elem_txt_pub' id='likepart-".$resultat[3]."'>".$number_of_like."</span><svg class='elem_txt_pub' version='1.1' id='Capa_1' xmlns='http://www.w3.org/2000/svg' style='margin-right:10px;margin-top: 4px;' width='45px' height='40px' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' viewBox='0 0 443.541 443.541' xml:space='preserve'><g><g><path d='M76.579,433.451V335.26C27.8,300.038,0,249.409,0,195.254C0,93.155,99.486,10.09,221.771,10.09s221.771,83.065,221.771,185.164s-99.486,185.164-221.771,185.164c-14.488,0-29.077-1.211-43.445-3.604L76.579,433.451z' style='stroke: #000;stroke-width: 30px;cursor: pointer;fill: #71ff00;'onclick='comment_aff();comment_txt(".$resultat[3].");applyStylesOnResize();'/></div></div>";
							    	$count_pub++;
							    	$i_txt++;
							    }
							    elseif ($count_pub == 1) {
							    	echo "<div class='aff_pub_div_content' id='".$resultat[3]."' style='width:100%;'><div class='div_content_p_art_txt'><p class='p_content_txt_art' id='p-".$resultat[3]."'>".$resultat[2]."</p></div><div class='content_info_art_txt'><svg class='elem_txt_pub' version='1.0' width='45px' height='45px' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1280.000000 1244.000000' preserveAspectRatio='xMidYMid meet'><metadata>Created by potrace 1.15, written by Peter Selinger 2001-2017</metadata><g transform='translate(0.000000,1244.000000) scale(0.100000,-0.100000)' fill='".$color_hearth."' id='like-div-".$resultat[3]."'><path onclick='like_db(".$resultat[3].");txt_art=1;' d='M3595 10494 c-16 -2 -73 -9 -125 -15 -785 -89 -1525 -534 -1950 -1172 -505 -756 -581 -1802 -203 -2762 234 -592 615 -1136 1223 -1746 440 -440 761 -713 1790 -1521 723 -568 973 -780 1280 -1088 285 -285 475 -527 591 -753 24 -48 46 -87 49 -87 3 0 20 29 38 65 150 304 458 666 907 1066 253 225 441 378 1130 919 900 707 1207 970 1640 1404 468 469 775 866 1023 1321 414 761 537 1622 342 2391 -112 440 -324 822 -635 1143 -523 540 -1245 841 -2014 841 -899 0 -1671 -412 -2116 -1130 -112 -182 -234 -457 -288 -651 -21 -74 -37 -101 -37 -61 0 45 -109 334 -184 487 -367 749 -1011 1208 -1876 1335 -75 11 -528 22 -585 14z' style='cursor:pointer;stroke: #000;stroke-width: 860px;' id='like-div-JTIqPE7PuSwDzFJJfgoNEX5wyidssg5KcSfZpS3CLhBgUxYVEcDePvixCDHo' class='state_like_JTIqPE7PuSwDzFJJfgoNEX5wyidssg5KcSfZpS3CLhBgUxYVEcDePvixCDHo'></path></g></svg><span class='span_like elem_txt_pub' id='likepart-".$resultat[3]."'>".$number_of_like."</span><svg class='elem_txt_pub' version='1.1' id='Capa_1' xmlns='http://www.w3.org/2000/svg' style='margin-right:10px;margin-top: 4px;' width='45px' height='40px' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' viewBox='0 0 443.541 443.541' xml:space='preserve'><g><g><path d='M76.579,433.451V335.26C27.8,300.038,0,249.409,0,195.254C0,93.155,99.486,10.09,221.771,10.09s221.771,83.065,221.771,185.164s-99.486,185.164-221.771,185.164c-14.488,0-29.077-1.211-43.445-3.604L76.579,433.451z' style='stroke: #000;stroke-width: 30px;cursor: pointer;fill: #71ff00;'onclick='comment_aff();comment_txt(".$resultat[3].");applyStylesOnResize();'/></div></div>";
							    	$count_pub = 0;
							    	$i_txt++;
							    }
							    $tab_pub[$resultat[3]] = $resultat[4];
							}
						?>

					</div>
				</div>
			</div>
			<?php
			} ?>
		</div>
		<div class="scs_body"><h1 style="color: red;word-wrap: break-word;">Please excuse us, we cannot offer you our website for your screen size. Please redirect you to a device with a screen larger than 310 pixels.</h1></div>
	</div>
	<?php 
	$addjsnavone = 'document.documentElement.style.overflow = "hidden";document.body.style.overflow = "hidden";';
	$addjsnavone = 'document.documentElement.style.overflow = "auto";document.body.style.overflow = "auto";';
	include 'includes/footer_index.php'; 
	?>
</body>
<script src="JS/profile.js"></script>
<script type="text/javascript">
	var tab_pub = JSON.parse('<?= json_encode($tab_pub); ?>');
</script>
</html>