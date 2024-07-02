<?php
session_start();
include 'includes/database_profile.php';
global $pro_bdd;
include 'includes/verify.php';
$id_user_live = $_COOKIE['id'];
$jsonData = file_get_contents('language/fr.json');
$data = json_decode($jsonData, true);
$langue = [];
foreach ($data as $valeur) {
    $langue[] = json_encode($valeur, JSON_UNESCAPED_UNICODE);
}
$imagePath1 = 'img_user/noimage.jpeg';
$imagePath2 = 'img_user/nobanner.png';
$imageData1 = file_get_contents($imagePath1);
$imageData2 = file_get_contents($imagePath2);
$base64Data1 = base64_encode($imageData1);
$base64Data2 = base64_encode($imageData2);
?>
<!DOCTYPE html>
<html id="html">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TEST</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="CSS/emojionearea.min2.css">
	<link rel="stylesheet" type="text/css" href="CSS/checkbox.css">
	<link rel="stylesheet" type="text/css" href="CSS/annimation.css">
	<link rel="stylesheet" type="text/css" href="CSS/comment_page.css">
	<link rel="stylesheet" type="text/css" href="CSS/index_style.css">
	<link rel="stylesheet" type="text/css" href="CSS/slider.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
	<script src="JS/emojionearea.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js" integrity="sha512-ooSWpxJsiXe6t4+PPjCgYmVfr1NS5QXJACcR/FPpsdm6kqG1FmQ2SVyg2RXeVuCRBLr0lWHnWJP6Zs1Efvxzww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="JS/index_func_34.js" defer></script>
	<script type="text/javascript">const id_user_live = '<?= $id_user_live ?>';</script>
</head>
<body>
	<div class="absolute_animation" id="annimation_loader">
		<div class="container_animation" id="contain_animmation">
		    <div></div>
		    <div></div>
		    <div></div>
		    <div></div>
		</div>
	</div>
	<div id="panel-edit">
		<a role="button" onclick="hide_edit_panel_reverse();" class="cross_edit cross_panel_edit">✖</a>	
		<div class="content_butt_edit_panel">
			<!-- mettre les paramettre pour l'utilisateur dans une contion php -->
			<a id="modif_edit" role="button" onclick=""><?= trim($langue[106], '"') ?></a><br>
			<a role="button" id="suppr_edit" onclick=""><?= trim($langue[146], '"') ?></a>
			<a role="button" id="signal_edit" onclick=""><?= trim($langue[7], '"') ?></a>
		</div>
	</div>
	<!-- Version TXT -->
	<div id="panel-txt">
		<a role="button" onclick="hide_txt_panel_reverse();" class="cross_edit nonSelectionnable close_cross">✖</a>
		<div id="form_pub_txt">				
			<form method="POST" class="form_pub_text" enctype="multipart/form-data" id="formtextpub">
				<div class="text_area_txt" id="content_text_area_txt-panel-loading">
					<div class="container_animation">
					    <div></div>
					    <div></div>
					    <div></div>
					    <div></div>
					</div>
				</div>
				<div class="text_area_txt" id="content_text_area_txt-panel">
					<textarea name="content_publication"id="textareatext" required></textarea>
					<script>
						$(document).ready(function() {
							$("#textareatext").emojioneArea({
								pickerPosition: "left",
								buttonTitle : "<?= trim($langue[141], '"') ?>",
								autocomplete: true,
								attributes: {
							        autocomplete   : "on",
				    				autocorrect    : "on",
				    				autocapitalize : "on",
				    			},
					   			placeholder: "<?= trim($langue[142], '"') ?>",
					   			searchPlaceholder : "<?= trim($langue[143], '"') ?>"
							});
						})
					</script>
				</div>
				<br>
				<div class="input_txt_area">
					<input onclick="creapubtxt();" id="submit" name="" value="<?= trim($langue[145], '"') ?>" class="submit_txt">
				</div>
			</form>
		</div>
	</div>
	<!-- Version IMG -->
	<div id="panel-img">
		<a role="button" onclick="hide_img_panel_reverse();" class="cross_edit nonSelectionnable close_cross">✖</a>
		<div id="form_pub_img">
			<form method="POST" class="form_pub_img" enctype="multipart/form-data" id="form_pub_img">
				<div id="previewimageimportpub">
					<figure id="content_img_preview">
						<div class="containervrsimg">
						    <div class="slider nonSelectionnable">
								<img id="slide1" src="IMG/noimage.jpeg" class="img-preview slide1 active" height="500px" width="500px">
								<img id="slide2" src="IMG/noimage.jpeg" class="img-preview slide2" style="" height="500px" width="500px">
								<img id="slide3" src="IMG/noimage.jpeg" class="img-preview slide3" style="" height="500px" width="500px">
								<img id="slide4" src="IMG/noimage.jpeg" class="img-preview slide4" style="" height="500px" width="500px">
						    </div>
						    <div class="cont-btnvrsimg" id="button_slide_panel_img">
						      <div class="btn-nav left nonSelectionnable" onclick="slidePrecedente('img.img-preview',undefined,'img-preview');" style="font-size : 0;"><img src="IMG/before2.png" height="26px" width="26px"></div>
						      <div class="btn-nav right nonSelectionnable" onclick=" slideSuivante('img.img-preview',undefined,'img-preview');" style="font-size : 0;"><img src="IMG/next2.png" height="26px" width="26px"></div>
						    </div>
						</div>
					</figure>
				</div>
				<textarea  id="content_text_area_img" name="content_publication" placeholder="<?= trim($langue[142], '"') ?>" class="text_area_img" required></textarea><br>
				<script>
					$(document).ready(function() {
						$("#content_text_area_img").emojioneArea({
							pickerPosition: "left",
							buttonTitle : "<?= trim($langue[141], '"') ?>",
							autocomplete: true,
							attributes: {
						        autocomplete   : "on",
			    				autocorrect    : "on",
			    				autocapitalize : "on",
			    			},
				   			placeholder: "<?= trim($langue[142], '"') ?>",
				   			searchPlaceholder : "<?= trim($langue[143], '"') ?>"
						});
					})
				</script>
				<input name="" value="<?= trim($langue[145], '"') ?>" class="submit_img nonSelectionnable" id="submitimg" onclick="creapubimg();">
			</form>
		</div>
	</div>
	<!-- Demande CROP -->
	<div id="panel-crop-demand">
			<a role="button" onclick="hide_crop_demand_reverse();" class="cross_edit nonSelectionnable close_cross cross_panel_crop">✖</a>
			<div class="content_one_fig">
				<div class="content_figure content_figure_one">
					<img src="data:image/jpeg;base64,<?= $base64Data1 ?>" class="img_crop" id="myGreatImage_one">
				</div>
				<button id="cropButton_one" class="button_crop_img_dmd" onclick=""><?= trim($langue[138], '"') ?></button>
			</div>
			<div class="content_two_fig">
				<div class="content_figure content_figure_two">
					<img src="data:image/jpeg;base64,<?= $base64Data2 ?>" class="img_crop" id="myGreatImage_two">
				</div>
				<button id="cropButton_two" class="button_crop_img_dmd" onclick=""><?= trim($langue[138], '"') ?></button>
			</div>
			<div class="content_three_fig">
				<div class="content_figure content_figure_three">
					<img src="data:image/jpeg;base64,<?= $base64Data2 ?>" class="img_crop" id="myGreatImage_three">
				</div>
				<button id="cropButton_three" class="button_crop_img_dmd" onclick=""><?= trim($langue[138], '"') ?></button>
			</div>
			<div class="content_four_fig">
				<div class="content_figure content_figure_four">
					<img src="data:image/jpeg;base64,<?= $base64Data2 ?>" class="img_crop" id="myGreatImage_four">
				</div>
				<button id="cropButton_four" class="button_crop_img_dmd" onclick=""><?= trim($langue[138], '"') ?></button>
			</div>
	</div>
	<!-- Demande IMG -->
	<div id="panel-img-demand">
		<a role="button" onclick="hide_img_demand_reverse();" class="cross_edit nonSelectionnable close_cross">✖</a>
		<div id="form_pub_img">&nbsp;
			<form id="form_prp_dmd" method="post" action="controleurs/upload.php" enctype="multipart/form-data" onsubmit="return false" style="width: 320px;height: 260px;">&nbsp;
				<div class="content_replace_butt_import_img" onclick="document.getElementById('upload-button').click();">
					<span class="nonSelectionnable"><?= trim($langue[147], '"') ?></span>
					<input type="file" accept=".png, .jpg, .jpeg, .gif" name="img_pub_form" id="upload-button" class="file_img" title="" required multiple>
				</div>
				<input type="submit" name="imgdemand" value="Continuer ➔" onclick="previewimg();" class="submit_buut_dmd_img"><br>
				<a href="#" class="cgi_img"><?= trim($langue[139], '"') ?></a>
			</form>
		</div>
	</div>
	<!-- Demande Comment -->
	<div id="panel-comment-demand">
		<a role="button" onclick="hide_comment_demand_reverse('panel-comment-demand');" class="cross_edit nonSelectionnable close_cross">✖</a>
		<div class="content_figure_img_comment">
			<figure id="content_img_comment" class="nonSelectionnable">
				<div id="container_img_prem_comment" class="container">
				    <div class="slider slider_comment">
						<img name="img-comment-1" id="slide1" src="IMG/noimage.jpeg" height="800px" width="800px" class="img_comment_panel img-border imgcomment font-loading-img-comment active">
						<img name="img-comment-2" id="slide2" src="IMG/image.jpg" height="800px" width="800px" class="img_comment_panel img-border imgcomment font-loading-img-comment">
						<img name="img-comment-3" id="slide3" src="IMG/noimage.jpeg" height="800px" width="800px" class="img_comment_panel img-border imgcomment font-loading-img-comment">
						<img name="img-comment-4" id="slide4" src="IMG/noimage.jpeg" height="800px" width="800px" class="img_comment_panel img-border imgcomment font-loading-img-comment">
				    </div>
				</div>
				<div id="cont-btn-comment">
					<div class="btn-nav left btn-nav-comment btn-nav-comment-left"><a onclick="" class="onclik_btn_nav_aff_comu" id="click_comment_slide_left" class="clik_slide_comment"><img src="IMG/before2.png" height="46px" width="46px"></a></div>
					<div class="btn-nav right btn-nav-comment btn-nav-comment-right"><a onclick="" class="onclik_btn_nav_aff_comu" id="click_comment_slide_right" class="clik_slide_comment"><img src="IMG/next2.png" height="46px" width="46px"></a></div>
				</div>
			</figure>
			<div class="left-part-comment-page">
				<div class="content-name-img-publish">
					<img class="nonSelectionnable img-publish-comment-pub" src="IMG/favicon.png">
					<label class="name-publish-comment-pub" id="pseudo-comment-page"></label>
				</div>
				<div class="slice-comment slice-comment-top"></div>
				<div id="content_info_comment_aff">
					<div class="content-description-comment-pub">
						<p id="txtpubcomment"></p>
					</div>
					<div class="slice-comment slice-comment-top-bottom"></div>
					<div id="comment-content-all">
					</div>
				</div>
				<div>		
					<div class="textareacomment" id="textareacomment">
						<textarea placeholder="<?= trim($langue[140], '"') ?>" onclick="commentchange();" id="textareacommentelement" maxlength="255"></textarea>
						<script>
							$(document).ready(function() {
								$("#textareacommentelement").emojioneArea({
									pickerPosition: "left",
									buttonTitle : "<?= trim($langue[141], '"') ?>",
									autocomplete: true,
									attributes: {
								        autocomplete   : "on",
					    				autocorrect    : "on",
					    				autocapitalize : "on",
					    			},
						   			placeholder: "<?= trim($langue[142], '"') ?>",
						   			searchPlaceholder : "<?= trim($langue[143], '"') ?>"
								});
							})
						</script>
					</div>
					<div id="divsendbotton"><img src="IMG/send-message.png" id="sendimgcomment" onclick=""><div id="nbr-carac-txt-comment" class="nbr_carac_text_area_comment">0/255</div></div>	
				</div>
			</div>
		</div>
	</div>
	<!-- Info IMG CGI -->
	<div id="panel-info">
        <a role="button" onclick="hide_panel_info();" class="cross_edit nonSelectionnable close_cross">✖</a>
        <div id="siturepondpascatesmort">&nbsp;
        	<div class="info_content_txt_img">   
                <div class="checkbox-wrapper-4-info"><input class="inp-cbx view" id="morning0" type="checkbox" value="x40umKYAi907I7r7KwuwY2KuAD79885M0dV18A7l4AiG5KRbyAV0oxY8vyzJ4lUr"><label class="cbx" for="morning0"><span><svg width="20px" height="18px"><use xlink:href="#check-4"></use></svg></span><span class="span_butt_cgu_img"><?= trim($langue[144], '"') ?></span></label><svg class="inline-svg"><symbol id="check-4" viewBox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg></div>
            </div>&nbsp;
            <button class="info_btn_img" id="info_btn_img"><?= trim($langue[138], '"') ?></button>
        </div>
    </div>
	<!-- Signal -->
	<div id="panel-sign">
		<a role="button" onclick="hide_sign_demand_reverse('panel-sign');" class="cross_edit nonSelectionnable close_cross" id="cross_remove_txt_panel">✖</a>
		<div id="form_pub_sign">				
			<form class="form_pub_sign" id="formsignpub">
				<div class="sign_page">
					<h3 class="sign_title nonSelectionnable"><?= trim($langue[7], '"') ?></h3>
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
					<input onclick="" id="submit_sign" name="" value="<?= trim($langue[7], '"') ?>" class="submit_txt nonSelectionnable">
				</div>
			</form>
		</div>
	</div>
	<div class="aff_pub" id="aff_pub">
	</div>
	<button onclick="hide_form_pub_txt('panel-txt');">TEXT</button>
	<button onclick="hide_img_demand();">IMG</button>
	<button onclick="dmd_art();">CHARGER</button>
</body>
</html>
<!-- $content = htmlspecialchars($content, ENT_HTML5); -->