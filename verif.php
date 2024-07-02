<?php
	session_start();
	include 'database.php';
		global $db;
	if(isset($_GET['id']) AND !empty($_GET['id']) AND isset($_GET['emailkey']) AND !empty($_GET['id'])){
		
		$getid = $_GET['id'];
		$getkey = $_GET['emailkey'];
		$recupUser = $db->prepare('SELECT * FROM users WHERE id = :id AND emailkey = :emailkey');
		$recupUser->execute([
			'id' => $getid,
			'emailkey' => $getkey
		]);
		if($recupUser->rowCount() > 0){
			$userInfo = $recupUser->fetch();
			if($userInfo['confirmemailkey'] != 1){
				$updateConfirmation = $db->prepare('UPDATE users SET confirmemailkey = :confirmemailkey WHERE id = :id');
				$updateConfirmation->execute([
					'confirmemailkey' => 1,
					'id' => $getid
				]);
				$_SESSION['emailkey'] = $getkey;
				$_SESSION['id'] = $getid;
				header('Location: index.php');
			}else{
				$_SESSION['emailkey'] = $getkey;
				$_SESSION['id'] = $getid;
				header('Location: index.php');
			}
		}
		else{
			echo "Votre cle ou identifiant est incorrect";
		}
	}
	else{
		echo "Aucun utilisateur trouvé";
	}
?>
