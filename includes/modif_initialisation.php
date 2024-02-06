<?php
include 'database.php';
		global $db;
if(isset($_POST['id']) AND !empty($_POST['id'])){
	if($_POST['id'] >= 1){
		$edit_id = htmlspecialchars($_POST['id']);
		$edit_publication = $db->prepare('SELECT * FROM publications WHERE id = :id');
		$edit_publication->execute([
		'id' => $edit_id
		]);
			if($edit_publication->rowCount() ==1) {
			$edit_publication = $edit_publication->fetch();
			}
		else{
			die('Erreur ça n\'existe pas');
		}	
	}
}

?><?=htmlspecialchars_decode($edit_publication['content'])?>
