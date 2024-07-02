<?php
include 'database_message.php';
		global $msg_bdd;
if (isset($_POST['table']) && isset($_POST['id_conv']) && isset($_POST['id_user'])) {
	if (!empty($_POST['table']) && !empty($_POST['id_conv']) && !empty($_POST['id_user'])) {
		$data = $_POST["table"];
		$id_user = $_POST['id_user'];
		$id_conv = $_POST['id_conv'];
		$data = json_decode("$data", true);
		$a = count($data)-1;
		for($i=0;$i<=$a;$i++){
			$stmt = $msg_bdd->prepare("SELECT * FROM message WHERE id= :id");
			$stmt->execute([
				'id' => $data[$i]
			]); 
			$user = $stmt->fetch();
			if ($user) {
			  	if ($user['user'] == $id_user) {
			  		if ($user['discution_id'] == $id_conv) {
			  			$suprr_id = htmlspecialchars($data[$i]);
			  			$suppr = $msg_bdd->prepare('DELETE FROM message WHERE id = :id');
						$suppr->execute([
							'id' => $suprr_id
						]);
			  		}
			  	}
			} 
		}
	}
}
?>