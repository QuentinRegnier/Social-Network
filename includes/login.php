<?php 
session_start();
	if (isset($_POST['mail']) && isset($_POST['pass'])) {
		if(!empty($_POST['mail']) && !empty($_POST['pass'])){
			include 'database_profile.php';
			global $pro_bdd;
			$q =  $pro_bdd->prepare("SELECT password, pseudo, use_code, tmp FROM users WHERE email = :email");
			$q->execute(['email' => $_POST['mail']]);
			$result = $q->fetch();
			if($result == true){
				if(password_verify($_POST['pass'], $result['password'])){
					echo $result['pseudo'];
					$nouvelleValeur = $result['use_code'];
					setcookie('id', $nouvelleValeur, time() + 365*24*3600, '/', '127.0.0.1', false, true);
					$nouvelleValeur = $result['tmp'];
					setcookie('tmp', $nouvelleValeur, time() + 365*24*3600, '/', '127.0.0.1', false, true);
				}else{
					echo "X2";
				}
			}else{
				echo "X1";
			}

		}else{
			echo "X0";
		}

	}

?>
