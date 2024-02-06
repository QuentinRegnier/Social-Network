<?php 
include '../database.php';
		global $db;

	$id = $_POST['pub'];
	$likepub = $db->prepare('SELECT * FROM like_pub WHERE pub = :pub AND user = :user');
	$likepub->execute([
		'user' => $_POST['user'],
		'pub' => $id
	]);
	if($likepub->rowCount() ==1) {
		$likepub = $likepub->fetch();
		$likesuprr = $db->prepare('DELETE FROM like_pub WHERE pub = :pub AND user= :user');
		$likesuprr->execute([
			'pub' => $likepub['pub'],
			'user' => $likepub['user']
		]);
		echo "supprimer";
	}
	else{
		$likeajout = $db->prepare("INSERT INTO like_pub(pub,user) VALUES(:pub,:user)");
		$likeajout->execute([
			'user' => $_POST['user'],
			'pub' => $_POST['pub']				
			]);
		echo "envoyer";
	}
?>