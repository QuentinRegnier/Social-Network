<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
	if (isset($_POST['type'])) {
		if(!empty($_POST['type'])){
			include 'database_profile.php';
			include 'RSA4096AES256.php';
			global $pro_bdd;
			if ($_POST['type'] = 1) {
				if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['mail']) && !empty($_POST['mail'])) {
					try {
						$pseudo = Decrypt($_POST['username']);
						$pseudo = removeFirstAndLastChar($pseudo);
					} catch (Exception $e) {
						echo "</br></br></br></br>Erreur lors du décryptage : " . $e->getMessage()."</br></br></br></br>";
					}
					try {
						$mail = Decrypt($_POST['mail']);
						$mail = removeFirstAndLastChar($mail);
					} catch (Exception $e) {
						echo "</br></br></br></br>Erreur lors du décryptage : " . $e->getMessage()."</br></br></br></br>";
					}
					$q =  $pro_bdd->prepare("SELECT id, pseudo, email FROM users WHERE email = :email OR pseudo = :pseudo");
					$q->execute([
						'email' => $mail,
						'pseudo' => $pseudo
					]);
					if ($q->rowCount() == 0) {
						echo true;
					}else{
						$data = $q->fetchAll();
						$return = [];
						if($data[0][1] == $pseudo){$return[0]=false;}else{$return[0]=true;}
						if($data[0][2] == $mail){$return[1]=false;}else{$return[1]=true;}
						echo json_encode($return);
					}
				}
			}elseif ($_POST['type'] = 1) {
				// code...
			}elseif ($_POST['type'] = 2) {
				// code...
			}
			// $q =  $pro_bdd->prepare("SELECT password, pseudo, use_code, tmp FROM users WHERE email = :email");
			// $q->execute(['email' => $_POST['mail']]);
		}
	}