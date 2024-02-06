<?php
$jsonData = file_get_contents('language/fr.json');
$data = json_decode($jsonData, true);
$langue = [];
foreach ($data as $valeur) {
    $langue[] = json_encode($valeur, JSON_UNESCAPED_UNICODE);
}
$publicKey = file_get_contents('keys/public-key.asc');
?> 
<!DOCTYPE html>
<html id="html_corp">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="//db.onlinewebfonts.com/c/b1f909b1cb3adb801a92229ea92613e1?family=Script+MT+Bold" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="CSS/login.css">
	<link rel="stylesheet" type="text/css" href="CSS/annimation.css">
	<link rel="stylesheet" type="text/css" href="CSS/checkbox.css">
	<link rel="shortcut icon" href="IMG/favicon.png"/>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js" crossorigin="anonymous"></script>
	<script src="JS/openpgp.min.js" crossorigin="anonymous"></script>
	<script>
		var jsonData = <?= $jsonData; ?>;
	</script>
	<script>
		async function crypterEtEnvoyer(data) {
		    try {
		        const publicKeyRSA=`<?= $publicKey ?>`; // Clé publique RSA du serveur
		        if (!publicKeyRSA) {
		            throw new Error("Clé publique RSA manquante ou invalide.");
		        }
		        const cleAES = CryptoJS.lib.WordArray.random(256/8).toString();
				const iv = CryptoJS.lib.WordArray.random(128/8).toString(CryptoJS.enc.Hex); // Générer un IV
		        // Lecture de la clé publique RSA
		        const publicKey = await openpgp.readKey({ armoredKey: publicKeyRSA });
		        // Cryptage de la clé AES avec la clé publique RSA
		        const cleAESCryptee = await openpgp.encrypt({
		            message: await openpgp.createMessage({ text: cleAES }),
		            encryptionKeys: publicKey
		        });
		        // Cryptage des données avec AES
		        const donneesCryptees = CryptoJS.AES.encrypt(JSON.stringify(data), CryptoJS.enc.Hex.parse(cleAES), { iv: CryptoJS.enc.Hex.parse(iv) }).toString();
		        return { donnees: donneesCryptees, cleAES: cleAESCryptee, iv: iv };
		    } catch (error) {
		        console.error("Erreur dans le processus de cryptage : ", error);
		        return null;
		    }
		}
	</script>
	<title>Login Page</title>
</head>
<body class="font" id="corp">
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
	<div id="content_all" style="display:none;">
		<img src="IMG/logo.png" class="logo_img nonSelectionnable">
		<div class="box">
	      <div class="box-inner" id="rotate">
	        <div class="box-front">
	          	<div class="login_content">
	          		<div id="front">
						<h1 class="title_login nonSelectionnable" id="title_card"><?= trim($langue[108], '"') ?></h1>
						<img id="sous_title" src="IMG/sous.png" class="sous_login_title nonSelectionnable"><br>
						<img src="IMG/mail.png" id="img_input_one_login" class="img_input_login_one nonSelectionnable"><input id="input_login_one" type="email" name="mail" class="input_login input_login_one" placeholder="Votre adresse mail" autocomplete="off"><div class="checkbox-wrapper-4" id="contentcheck0"><input class="inp-cbx view" id="morning0" type="checkbox" value="x40umKYAi907I7r7KwuwY2KuAD79885M0dV18A7l4AiG5KRbyAV0oxY8vyzJ4lUr"><label style="display: none;" class="cbx" for="morning0"><span><svg width="30px" height="25px"><use xlink:href="#check-4"></use></svg></span><span id="span-check"><?= trim($langue[131], '"') ?></span></label><svg class="inline-svg"><symbol id="check-4" viewBox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg></div><div class="img-container-one" id="error_one"><img src="IMG/delete.png" class="img_alert"><div class="tooltip-one" id="tooltipId-one"><?= trim($langue[150], '"') ?></div></div><br id="br_2">
						<img src="IMG/lock.png" id="img_input_two_login" class="img_input_login_two nonSelectionnable"><input id="input_login_two" type="password" name="password" class="input_login input_login_two" placeholder="Votre mot de passe" autocomplete="off"><select class="input_login input_login_two" id="select_who" style="display: none;" autocomplete="off"><option value="0"><?= trim($langue[133], '"') ?></option><option value="1"><?= trim($langue[134], '"') ?></option><option value="2"><?= trim($langue[135], '"') ?></option><option value="3" selected><?= trim($langue[136], '"') ?></option></select><div class="checkbox-wrapper-4" id="contentcheck1"><input class="inp-cbx view" id="morning1" type="checkbox" value="7aqVTLmb5Re796ANA7Pa84v3h74knC6QBZ5imvjkPSF3zM3P6cbP97ra99ZniBe5Z3Z5"><label style="display: none;" class="cbx" for="morning1"><span><svg width="30px" height="25px"><use xlink:href="#check-4"></use></svg></span><span id="span-check"><?= trim($langue[132], '"') ?></span></label><svg class="inline-svg"><symbol id="check-4" viewBox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg></div><div class="img-container-two" id="error_two"><img src="IMG/delete.png" class="img_alert"><div class="tooltip-two" id="tooltipId-two"><?= trim($langue[137], '"') ?></div></div><br id="br_3">
						<div id="space-login" class="space-login"><span id="error_checkbox"><?= trim($langue[148], '"') ?></span></div><br id="br_4">
						<a href="#" class="mp-fg" id="hidden_login"><?= trim($langue[109], '"') ?></a><br id="br_5">
						<div class="absolute_animation" id="annimation_loader_front" style="height: 100%;width: 100%;margin-top: -1px; display: none;">
							<div style="position: relative;top: 20%;">
								<div class="container_animation" id="contain_animmation" style="margin: auto;">
									<div></div>
									<div></div>
									<div></div>
									<div></div>
								</div>
							</div>
						</div>
						<div id="hidden_login_btn" style="display: block;"><div id="login_btn" class="connect_div button_login_part" onclick="Send_login_request();"><span id="login_btn_span" class="text_button_login nonSelectionnable"><?= trim($langue[110], '"') ?></span></div><div id="div_subcribe_btn" class="subcribe_div button_login_part" onclick="Rotate_card_step_one()"><span id="subcribe_btn" class="text_button_login nonSelectionnable"><?= trim($langue[111], '"') ?></span></div></div><button class="butt_derv" id="butt-dsc"><?= trim($langue[149], '"') ?></button>
					</div>
				</div>
	        </div>
	        <div class="box-back" id="back">
	        </div>
	      </div>
    </div>
	</div>
</body>
<script src="JS/login.js"></script>
</html>
<!-- onblur="alert(1);" <-- détecte lorsque l'élément n'est plus focus -->
