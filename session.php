<?php session_start();
	$_SESSION['pseudo'] ="Nerzus";
	$_SESSION['age'] = 14;

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Session</title>
</head>
<body>
		<h1>Bienvenue sur votre profile</h1>
		<?php 


			if (isset($_SESSION['pseudo']) && isset($_SESSION['age'])) {
				?>
				<p>Votre Pseudo : <?= $_SESSION['pseudo']; ?></p>
				<p>Votre Age : <?= $_SESSION['age']; ?></p>

				<?php
			}else{
				echo "Veuiller vous connecter à votre compte";
			}


		?>
</body>
</html>