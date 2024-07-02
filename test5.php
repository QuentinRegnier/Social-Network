<?php 
include 'includes/database_message.php';
		global $msg_bdd;
include 'includes/database_profile.php';
		global $pro_bdd;
include 'includes/verify.php';
$tab_pub = [];
if (isset($_COOKIE['id'])) { 
	if (!empty($_COOKIE['id'])) {
		$id_user_live = $_COOKIE['id'];
	}
}
?>
<!DOCTYPE html>
<html id="html" style="overflow: hidden;">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SSE</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="CSS/emojionearea.min2.css">
	<link rel="stylesheet" type="text/css" href="CSS/annimation.css">
	<link rel="stylesheet" type="text/css" href="CSS/msg_style24.css">
	<link rel="stylesheet" type="text/css" href="CSS/checkbox.css">
	<link rel="stylesheet" type="text/css" href="CSS/burgermunu3.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
	<script src="JS/emojionearea.min.js"></script>
	<script type="text/javascript">var table = [];var table_vu = [];var vu_vef = [];var conv = new Array();var to = new Array();var active_conv, username_live_actif;var id_user_live = "<?= $id_user_live ?>";var state_delete = 0;let eventSource;
	let eventSource_user;</script>
	<script src="JS/msg_35.js" defer></script>
	<script type="text/javascript">
		var getHttpRequest = function () {

		     var httpRequest = false;

		     if (window.XMLHttpRequest) { //Mozilla,Safari,...

		          httpRequest = new XMLHttpRequest();

		          if (httpRequest.overrideMimeType) {

		               httpRequest.overrideMimeType('text/xml');

		          }

		     }

		     else if (window.ActiveXObject) { //IE

		          try {
		               httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
		          }

		          catch (e) {
		                         
		               try{

		                    httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
		               }

		               catch (e) {}
		          }
		     }
		     if (!httpRequest) {
		          alert('Abandon :( Impossible de créer une instance XMLHTTP');
		          return false;
		     }

		     return httpRequest;
		}
	</script>
	<script type="text/javascript">
		function updateUserOnlineStatus() {
		  var httpRequest = getHttpRequest();
		  httpRequest.open('POST', 'includes/online.php', true);
		  httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		  httpRequest.overrideMimeType("text/plain");
		  httpRequest.send("user=" + encodeURIComponent("<?= $id_user_live ?>"));
		}
		updateUserOnlineStatus();
		setInterval(updateUserOnlineStatus, 240000);
		var httpRequest_username = getHttpRequest();
		httpRequest_username.onreadystatechange = function () {
	     	if (httpRequest_username.readyState === 4){
              	document.getElementById('id_name_label').innerHTML = httpRequest_username.responseText;
              	username_live_actif = httpRequest_username.responseText;
	        }  
	    }
	  	httpRequest_username.open('POST', 'includes/recup_user.php', true)
	  	httpRequest_username.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
	  	httpRequest_username.overrideMimeType("text/plain");
	  	httpRequest_username.send("user=" + encodeURIComponent("<?= $id_user_live ?>"))
	</script>
	<script>
		function Recup_table(from_table,to_table,id_conv_table, state){
			var httpRequest_table = getHttpRequest();
			httpRequest_table.onreadystatechange = function () {
		     	if (httpRequest_table.readyState === 4){
	              	table_vu = [];
	              	data_table = JSON.parse(httpRequest_table.responseText);
	              	length_table = data_table.length;
	              	for (let i = 0; i < length_table; i++) {
	              		if (table.indexOf(data_table[i]) == -1) {
	              			table.push(data_table[i]['id']);
	              		}
	              		if (state == 1) {
	              			if (data_table[i]['user'] !== '<?= $id_user_live ?>') {
	              				table_vu.push(data_table[i]['id']);
	              			}
	              			if (data_table[i]['user'] == '<?= $id_user_live ?>') {
	              				vu_vef.push(data_table[i]['id']);
	              			}
	              		}

					}
					if (state == 1) {
						vu(0);
					}
		        }  
		    }
		  	httpRequest_table.open('POST', 'includes/load_table_msg.php', true)
		  	httpRequest_table.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
		  	httpRequest_table.overrideMimeType("text/plain");
		  	httpRequest_table.send("from=" + encodeURIComponent(from_table) + "&id_conv=" + encodeURIComponent(id_conv_table))
		}
	</script>
</head>
<body id="body" style="overflow: hidden;">
	<div class="absolute_animation" id="annimation_loader" style="height: 100%;background-color: rgb(9, 0, 211);">
		<div style="position: relative;top: 20%;">
			<div class="container_animation" id="contain_animmation" style="margin: auto;">
			    <div></div>
			    <div></div>
			    <div></div>
			    <div></div>
			</div>
		</div>
	</div>
	<div id="menu"></div>
	<div style="background-color: grey;height: 100%;width: 100%;" class="min-body"><p style="color: red;word-wrap: break-word;">Please excuse us, we cannot offer you our website for your screen size. Please redirect you to a device with a screen larger than 250 pixels.</p></div>
	<div id="content_all" style="display: none;height: 100%;">
		<div class="back-info-msg-alert nonSelectionnableindex" id="alert-msg">
			<div class="content-info-msg-alert">
				<p class="text-info-msg-alert">Êtes-vous sûr de vouloir supprimer la conversation ? Si vous supprimer la conversation tout les message et photos seront perdu à jamais !</p>
				<button class="button-y-info-msg-alert" id="action-info-msg-alert">Oui, on supprime</button>
				<button class="button-n-info-msg-alert" onclick="Insible_input_delete();">En fait, non</button>
			</div>
		</div>
		<div class="back-info-msg-alert nonSelectionnableindex" id="alert-group">
			<div class="content-info-msg-alert">
				<p class="text-info-msg-alert">Quel sera le nom du groupe ?</p>
				<br>
				<input type="text" name="" id="name_group" maxlength="60">
				<br>
				<button class="button-n-info-msg-alert" id="action-info-grp-alert">Créer le groupe !</button>
				<button class="button-y-info-msg-alert" onclick="groupeAlert();">En fait, non</button>
			</div>
		</div>
		<div class="back-info-msg-alert nonSelectionnableindex" id="alert-view">
			<div class="content-info-msg-alert">
				<p class="p_alertlview">Le(s) Membre(s) du groupe :</p>
				<div id="content-result-view"></div>
				<button class="button-n-info-msg-alert" id="action-god-alert-view" style="background-color: #ffcb00; display: none;" onclick="godmod();document.getElementById('alert-view').style.display = 'none';">Nommer admin</button>
				<button class="button-n-info-msg-alert" id="action-ban-alert-view" style="background-color: #f00; display: none;" onclick="banuser();document.getElementById('alert-view').style.display = 'none';">Ban du groupe</button>
				<button class="button-y-info-msg-alert" onclick="document.getElementById('alert-view').style.display = 'none';" style="background-color: #37d05d;">Revenir au groupe</button>
			</div>
		</div>
		<div class="content_conv" id="conv_list_content">
			<div class="title-part-conv">
				<h3 class="conv-title nonSelectionnableindex">Conversation :</h3>	
			</div>
			<div class="content-info-conv">
				<input type="text" name="search_text" id="search_text" placeholder="Rechercher des utilisateurs !" class="search-control">
				<button class="butt_conv_crea_one">Commencer à discuter</button><button class="butt_conv_crea_two">Créer un groupe</button><button class="butt_conv_crea_three">Continuer à discuter</button><button class="butt_conv_crea_four">Ajouter au groupe →</button>
				<div id="result_search"></div>
				<ul class="content-conv-list nonSelectionnableindex" id="content-conv-list">
				<?php
					$conv_table_sse= [];
					$to_table_sse= [];
					$from = $id_user_live;
					$recoverConv = $msg_bdd->prepare('SELECT * FROM conv_info WHERE user = :id ORDER BY modification_date DESC');
					$recoverConv->execute([
						'id' => $id_user_live
					]);
					$i = 0;
					$searchnew = $msg_bdd->prepare('SELECT id, discution_id, state FROM message WHERE user != :id AND state = :state ORDER BY creation_date');
					$searchnew->execute([
					    'id' => $id_user_live,
					    'state' => 0
					]);
					$resultat_new = $searchnew->fetchAll();
					while($conv = $recoverConv->fetch()){
						$id_discution = $conv['conv_id'];
						$state_of_conv = $conv['state'];
						if ($i == 0) {
							$prem = "prem_conv";
						}
						else{
							$prem = "";
						}
						$recoverUser = $msg_bdd->prepare('SELECT * FROM conv_info WHERE conv_id = :id');
						$recoverUser->execute([
							'id' => $id_discution
						]);
						$result_user_conv = $recoverUser->rowCount();
						if ($result_user_conv > 2) {
							if ($state_of_conv == 0) {
								$group_to_add = [];
								while($conv_user = $recoverUser->fetch()){
									$name = $conv_user['name'];
									$user_insert = $conv_user['user'];
									if ($user_insert !== $from) {
										array_push($conv_table_sse, $id_discution);
										array_push($to_table_sse, $user_insert);
										array_push($group_to_add, $user_insert);
									}
								}
								?>
								<li class="name_conv_list <?= $prem ?>" value="<?= $id_discution ?>" onclick="Change_conv(<?= $i ?>, undefined, undefined, undefined, 1);this.style.backgroundColor = 'rgb(9, 0, 211)';this.style.color = 'rgb(242, 240, 237)';this.id = 'active_conv';">
									<img src="IMG/group.png" class="profile_img_list_conv"><span class="span_list_conv" id="span_user_<?= $i ?>"><?= $name ?></span>
								</li>
								<script type="text/javascript">
									Recup_table("<?= $from ?>","<?= $user_insert ?>","<?= $id_discution ?>");conv.push("<?= $id_discution ?>");to.push(JSON.parse('<?= json_encode($group_to_add) ?>'));
								</script>
								<?php
								$i++;
							}
						}
						elseif ($result_user_conv == 2){
							$state_insert = 0;
							while($conv_user = $recoverUser->fetch()){
								$new_result_cnt = 0;
								if ($conv_user['user'] == $from) {
									if ($conv_user['state'] == 0) {
										$state_insert = 1;
									}
								}
								if ($conv_user['user'] != $from) {
									$to_sse = $conv_user['user'];
									$user_insert = $conv_user['user'];
								}
							}
							if ($state_insert == 1) {
									array_push($to_table_sse, $to_sse);
									array_push($conv_table_sse, $id_discution);
								?>
								<li class="name_conv_list <?= $prem ?>" onclick="Change_conv(<?= $i ?>);this.style.backgroundColor = 'rgb(9, 0, 211)';this.style.color = 'rgb(242, 240, 237)';this.id = 'active_conv';">
										<img src="IMG/account.png" class="profile_img_list_conv"><span class="span_list_conv" id="span_user_<?= $i ?>"></span><div id="new_msg_<?= $i ?>" class="new_message"><span id="new_msg_<?= $i ?>_span" class="new_message_num"><?php 
															if ($resultat_new !== false) {
																$id_disc = $id_discution;
																$count_new = 0;
																$count_new_tab = count($resultat_new);
																for ($ii = 0; $ii < $count_new_tab; $ii++) {
																    if ($resultat_new[$ii]['discution_id'] == $id_discution) {
																        $count_new++;
																    }
																}
																if ($count_new > 0) {
																	$new_result_cnt = 1;
																	echo $count_new;
																}
																else{
																	echo 0;
																}
															}
														 ?></span></div>
										<script type="text/javascript">
											document.addEventListener("DOMContentLoaded", function(event) {
											  	element_div = document.getElementById('new_msg_<?= $i ?>');
									 			element_div.style.display = 'block';
											  	center_div = element_div.clientWidth;
											  	center_div /= 2;
											  	marginright = 40 - center_div;
											  	element_div.style.marginRight = marginright + 'px';
											  	<?php if ($new_result_cnt == 0) {?>element_div.style.display = 'none';<?php }?>
											});
									 	</script>
								</li>
								<script type="text/javascript">
									var httpRequest_<?= $i ?> = getHttpRequest();httpRequest_<?= $i ?>.onreadystatechange = function () {if (httpRequest_<?= $i ?>.readyState === 4){document.getElementById('span_user_<?= $i ?>').innerHTML = httpRequest_<?= $i ?>.responseText;}};httpRequest_<?= $i ?>.open('POST', 'includes/get_pseudo.php', true);httpRequest_<?= $i ?>.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');httpRequest_<?= $i ?>.overrideMimeType("text/plain");httpRequest_<?= $i ?>.send("conv=" + encodeURIComponent("<?= $user_insert ?>"));conv.push("<?= $id_discution ?>");to.push("<?= $user_insert ?>");Recup_table("<?= $from ?>","<?= $user_insert ?>","<?= $id_discution ?>");
								</script>
								<?php
								$i++;
							}
						}
					}
				?>
				</ul>
			</div>
		</div>
		<div id="info_menu_slap">
			<a href="#" class="content_user" id="pseudo_content_bar" style="margin-right: 6px;margin-left: 0;"><img src="IMG/account.png" class="img_user" style="margin-right: 0;"></a>
			<br>
			<img src="IMG/home.png" class="imgnav_bar" onclick='window.location.href = "../";' id="home_btt_bar" style="margin-right: 6.5px;">
			<br>
			<img src="IMG/eye.png" class="imgnav_bar" onclick="trigger.removeClass('is-open');trigger.addClass('is-closed');isClosed = false;start_menu();viewuseringroup();" style="display:none;margin-right: 5.5px;" id="view_group_bar">
			<br>
		</div>
		<div class="content_msg">
			<div class="info_band nonSelectionnableindex">
				<img src="IMG/account.png" class="user-to_profile-img" class="hide_info_band">
				<h1 class="user-to_profile-name hide_info_band" id="title_user">Username</h1>
				<div class="user-to_profile-ball hide_info_band" id="ballgreenred"></div>
				<div id="hamburger" class="hamburglar is-closed pasblock">
				  <div class="burger-icon"style="cursor:pointer;">
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
				<a href="#" class="content_user" id="pseudo_content"><img src="IMG/account.png" class="img_user pasblock"><label class="name_user pasblock" id="id_name_label"></label></a>
				<img src="IMG/home.png" class="imgnav_bar" onclick='window.location.href = "../";' id="home_btt">
				<img src="IMG/eye.png" class="imgnav_bar" onclick='viewuseringroup();' style="display:none;" id="view_group">
				<img src="IMG/bin.png" class="bin_band-msg hide_info_band" onclick="Unvinsible_input_delete();" oncontextmenu="Unvinsible_convdelete();return false;" id="bin_butt">
				<div id="suppr-buuton" class="content-suppr-button invisible" onclick="Delete_message();Insible_input_delete();"><span class="suppr_button_text">Supprimer les messages</span></div>
				<svg version="1.1" id="Capa_1" class="svg_binfonc_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 800 800" class="svg_binfonc_1" xml:space="preserve" onclick="Delete_message();Insible_input_delete();">
					<style type="text/css">
						.st0_svg_tick_supp{fill:#FFFFFF;}
						.st1_svg_tick_supp{fill:#37D05D;}
					</style>
					<rect x="109" y="173.9" class="st0_svg_tick_supp" width="557" height="437"/>
					<path class="st1_svg_tick_supp" d="M400,0C179.4,0,0,179.4,0,400s179.4,400,400,400s400-179.4,400-400S620.6,0,400,0z M629.7,332.4L378.4,583.7
						c-10.7,10.7-24.9,16.6-40,16.6s-29.3-5.9-40-16.6l-128.1-128c-10.7-10.7-16.6-24.9-16.6-40s5.9-29.3,16.6-40
						c10.7-10.7,24.9-16.6,40-16.6s29.3,5.9,40,16.6l88.1,88.1l211.3-211.3c10.7-10.7,24.9-16.6,40-16.6s29.3,5.9,40,16.6
						C651.7,274.5,651.7,310.4,629.7,332.4z"/>
				</svg>
				<div id="supconv-buuton" class="content-supconv-button invisible" onclick="document.getElementById('alert-msg').style.display = 'block';"><span class="supconv_button_text">Supprimer la conversation</span></div>
				<svg version="1.1" id="Capa_1" class="svg_binfonc_2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 800 800" style="enable-background:new 0 0 800 800;" xml:space="preserve" onclick="document.getElementById('alert-msg').style.display = 'block';">
					<style type="text/css">
						.st0_svg_stop_conv{fill:#FFFFFF;}
						.st1_svg_stop_conv{fill:#07D05D;}
					</style>
					<rect x="203" y="198.9" class="st0_svg_stop_conv" width="402" height="410"/>
					<path class="st1_svg_stop_conv" d="M400,0C179.1,0,0,179.1,0,400s179.1,400,400,400s400-179.1,400-400S620.9,0,400,0z M574.5,512.1
						c0,34.8-28.2,63-63,63H287.3c-34.8,0-63-28.2-63-63V287.9c0-34.8,28.2-63,63-63h224.2c34.8,0,63,28.2,63,63V512.1z"/>
				</svg>
				<div id="quitconv-buuton" class="content-supconv-button invisible contentquitgroup" onclick="document.getElementById('alert-msg').style.display = 'block';"><span class="supconv_button_text quitgroup">Se retirer de ce groupe</span></div>
				<div id="ann-buuton" class="content-ann-button invisible" onclick="Insible_input_delete();state_delete = 0;"><span class="ann_button_text">Annuler</span></div>
				<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 800 800" class="svg_binfonc_4" xml:space="preserve" onclick="Insible_input_delete();state_delete = 0;">
					<style type="text/css">
						.st0_svg_cross_ann{fill:#FFFFFF;}
						.st1_svg_cross_ann{fill: #f00;}
					</style>
					<rect x="121" y="136.9" class="st0_svg_cross_ann" width="568" height="525"/>
					<g>
						<path class="st1_svg_cross_ann" d="M400,0C179.1,0,0,179.1,0,400c0,220.9,179.1,400,400,400c220.9,0,400-179.1,400-400C800,179.1,620.9,0,400,0z M621.6,535.9
							L536,621.6L400,485.7L264.1,621.6l-85.7-85.7L314.3,400L178.4,264.1l85.7-85.7L400,314.3l135.9-135.9l85.7,85.7L485.7,400
							L621.6,535.9z"/>
					</g>
				</svg>
			</div>
			<div id="content-msg" style="text-align : center;">
				<svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="512" height="512" class="svg_start nonSelectionnableindex"><path d="M23.119.882a2.966,2.966,0,0,0-2.8-.8l-16,3.37a4.995,4.995,0,0,0-2.853,8.481L3.184,13.65a1,1,0,0,1,.293.708v3.168a2.965,2.965,0,0,0,.3,1.285l-.008.007.026.026A3,3,0,0,0,5.157,20.2l.026.026.007-.008a2.965,2.965,0,0,0,1.285.3H9.643a1,1,0,0,1,.707.292l1.717,1.717A4.963,4.963,0,0,0,15.587,24a5.049,5.049,0,0,0,1.605-.264,4.933,4.933,0,0,0,3.344-3.986L23.911,3.715A2.975,2.975,0,0,0,23.119.882ZM4.6,12.238,2.881,10.521a2.94,2.94,0,0,1-.722-3.074,2.978,2.978,0,0,1,2.5-2.026L20.5,2.086,5.475,17.113V14.358A2.978,2.978,0,0,0,4.6,12.238Zm13.971,7.17a3,3,0,0,1-5.089,1.712L11.762,19.4a2.978,2.978,0,0,0-2.119-.878H6.888L21.915,3.5Z"/></svg>
				<h3 class="mess_start nonSelectionnableindex">Commencer à discuter !</h3>
			</div>
			<div class="content-send-msg" id="send-content" style="display:none;">
				<div class="img-content-import" id="content_img_import">
					<img src="IMG/noimage.jpeg" id="img_import" class="img_import">
					<a role="button" onclick="hide_img_preview();setEmojioneareaWidth();" class="close_cross_img" id="close_img_preview">✖</a>
				</div>
				<textarea placeholder="envoyer un message !" id="textarea_msg"></textarea>
				<input type="submit" name="" id="submit_msg" onclick="send_msg();" style="display:none;">
				<img src="IMG/send-message.png" id="sendimgcomment" class="hide_button" onclick="document.getElementById('submit_msg').click();">
				<input type="file" name="img-msg" accept="image/*" style="display:none;" id="file_input_msg">
				<img src="IMG/photopub.png" height="40px" class="button-right-send hide_button" onclick="document.getElementById('file_input_msg').click();">
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	$(textarea_msg).emojioneArea({
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
	})
</script>
<script>
	div_search = document.getElementById("result_search");
	input_search = document.getElementById("search_text");
	input_search.value = null;
	r = 0;
	$(document).ready(function(){

		load_data();

		function load_data(query)
		{
			$.ajax({
			   	url:"includes/research.php?user=<?= $id_user_live ?>",
			   	method:"POST",
			   	data:{query:query},
			   	success:function(data){
				   	if (data !== 'Data Not Found') {
					    dataJSON_search = JSON.parse(data);
					    count_search = dataJSON_search.length;
					    resultDiv = document.querySelector('#result_search');
					    resultDiv.innerHTML = '';
					    for (let i = 0; i < count_search; i++) {
					    	tr = document.createElement('tr');
					    	tr.className = 'tr_research';
					    	tr.innerHTML = '<div class="checkbox-wrapper-4"><input class="inp-cbx searchcheck" id="morning-'+i+'" type="checkbox" value="'+dataJSON_search[i]['code']+'"/><label class="cbx" for="morning-'+i+'"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span><span>'+dataJSON_search[i]['pseudo']+'</span></label><svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg></div>'
					    	resultDiv.appendChild(tr);
					    }
					    if (r == 1){
					    	if (input_search.value.length !== null && input_search.value.length !== 0) {
							  div_search.style.display = "block";
							} else {
							  div_search.style.display = "none";
							}
					    }
					    else{r=1;}
					    if (count_search >= 1) {
						    let checkboxes = document.querySelectorAll('input.searchcheck');
							for(let i = 0; i < checkboxes.length; i++){
							  checkboxes[i].addEventListener('click', onCheckboxClick);
							}
						}
					}
				}
		  	});
		}
		$('#search_text').keyup(function(){
		  	if(event.keyCode === 13){
			  	var search = $(this).val();
			  	if(search != ''){
			   		load_data(search);
			  	}
			  	else{
			   		load_data();
			  	}
		  	}
		});
	});
</script>
<style type="text/css" id="style_resize"></style>
</html>
<?php
include 'includes/sse_connect.php';
?>