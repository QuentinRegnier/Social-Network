<?php
include 'database_message.php';
		global $msg_bdd;
if (isset($_POST['from']) && isset($_POST['to']) && isset($_POST['id_conv'])) {
	if (!empty($_POST['from']) && !empty($_POST['to']) && !empty($_POST['id_conv'])) {
		$from = $_POST['from'];
		$to = $_POST['to'];
		$to_state = 0;
		$user_send = null;
		if (isset($_POST['nat']) && !empty($_POST['nat']) && $_POST['nat'] == 1) {
			$to = json_decode("$to", true);
			$to_state = 1;
		}
		$id_discution = $_POST['id_conv'];
		$recoverMessages = $msg_bdd->prepare('SELECT * FROM message WHERE discution_id = :id ORDER BY id');
		$recoverMessages->execute([
			'id' => $id_discution
		]);
		while($message = $recoverMessages->fetch()){
			$text_message = htmlspecialchars($message['message'], ENT_HTML5);
			if($message['user'] == $from){
				$id_div = "from";
				?>
				<input id="<?= $message['id']; ?>" type="checkbox" name="" class="delete_input invisible" autocomplete="off">
				<?php
			}
			elseif ($to_state == 1) {
				if(in_array($message['user'], $to)){$id_div = "to";}
			}
			elseif ($to_state == 0) {
				if($message['user'] == $to){$id_div = "to";}
			}
			if ($message['nat'] == 1) {
				$chemin = $message['message'];
				if (substr($chemin, 0, 2) === "i:") {
				    $chemin = substr($chemin, 2);
				    if ($to_state == 1 && $id_div == "to" && $message['user'] !== $user_send) {
					?>
						<div class="content_group_msg clear">
							<img src="IMG/account.png" class="img_group_msg img_group_img">
					<?php
					}
				?>
					<img src="img_msg/<?= $chemin ?>" class="img_msg message msg_<?= $message['id']; ?> clear" id="<?= $id_div ?>" <?php if ($message['user'] == $user_send && $to_state == 1) { ?>style ="margin-left: 30px;"<?php }?>>
					<br class="msg_<?= $message['id']; ?>"><br class="msg_<?= $message['id']; ?>"><br class="msg_<?= $message['id']; ?>">
				<?php
					if ($to_state == 1 && $id_div == "to" && $message['user'] !== $user_send) {
					?>
						</div>
					<?php
					}
				}
			}
			else{
				if ($to_state == 1 && $id_div == "to" && $message['user'] !== $user_send) {
					?>
					<div class="content_group_msg clear">
						<img src="IMG/account.png" class="img_group_msg">
					<?php
				}
				?>
				<div class="message msg_<?= $message['id']; ?> clear" id="<?= $id_div ?>" <?php if ($message['user'] == $user_send && $to_state == 1) { ?>style ="margin-left: 40px;"<?php }?>>
					<p><?= $text_message; ?></p>
				<?php
				if($id_div == "from" && $to_state == 0){
				?>
					<svg version="1.1" id="duble-tick" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						 viewBox="0 0 800 800" style="enable-background:new 0 0 800 800;" xml:space="preserve">
						<style type="text/css">
							.st0_<?= $message['id']; ?>{fill:none;stroke:#FFFFFF;stroke-width:50;stroke-linecap:round;stroke-miterlimit:133.3333;}
						</style>
						<path class="st0_<?= $message['id']; ?>" d="M50,416.7l135.9,135.9c7.8,7.8,20.5,7.8,28.3,0l85.9-85.9" <?php if ($message['state'] == 1) {echo('style="stroke:#1b02ff"');} ?>/>
						<path class="st0_<?= $message['id']; ?>" d="M533.3,233.3L400,366.7"<?php if ($message['state'] == 1) {echo('style="stroke:#1b02ff"');} ?>/>
						<path class="st0_<?= $message['id']; ?>" d="M233.3,400l152.5,152.5c7.8,7.8,20.5,7.8,28.3,0l319.2-319.2" <?php if ($message['state'] == 1) {echo('style="stroke:#1b02ff"');} ?>/>
					</svg>
				<?php
				}
				?>
				</div>
				<?php
				if ($to_state == 1 && $id_div == "to" && $message['user'] !== $user_send) {
					?>
					</div>
					<?php
				}
				?>
				<br class="msg_<?= $message['id']; ?>"><br class="msg_<?= $message['id']; ?>"><br class="msg_<?= $message['id']; ?>">
				<?php
			}
			$user_send = $message['user'];
		}
		if ($to_state == 1) {
			?>
			<style type="text/css">
				#from{
					padding-bottom: 10px !important;
				}
				div.content_group_msg div#to{
					float: right !important;
				}
				.img_group_img{
					margin-top: 25%;
				}
			</style>
			<?php
		}
	}
}
?>