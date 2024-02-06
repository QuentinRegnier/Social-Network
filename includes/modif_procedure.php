<?php
include 'database.php';
		global $db;
if(isset($_POST['content_publication'])){
	// update article
	$update_pub = $db->prepare('UPDATE publications SET content = :content, update_date = NOW() WHERE id = :id');
	$update_pub->execute([
		'content' => $_POST['content_publication'],
		'id' => $_POST['id']
	]);
}
if(isset($_POST['id']) AND !empty($_POST['id'])){
	if($_POST['id'] >= 1){
		$edit_id = htmlspecialchars($_POST['id']);
		$edit_publication = $db->prepare('SELECT * FROM publications WHERE id = :id');
		$edit_publication->execute([
		'id' => $edit_id
		]);
			if($edit_publication->rowCount() ==1) {
				$edit_publication = $edit_publication->fetch(); 
				$pub_content = $edit_publication['content'];
				$pub_content = htmlspecialchars($pub_content, ENT_HTML5);
				$pub_content = nl2br($pub_content);
				header('Charset: utf-8');
				header('Content-type: text/plain');
				echo($pub_content);
			}
		else{
			die('Erreur ça n\'existe pas');
		}	
	}
}
?>
