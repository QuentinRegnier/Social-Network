<?php
include '../database.php';
		global $db;
include 'database_profile.php';
global $pro_bdd;
$id_name = 'user';
include 'verify_sys.php';
if(isset($_POST['content_comment']) && isset($_POST['user']) && isset($_POST['tmp_code_pub'])){
	if(!empty($_POST['content_comment']) && !empty($_POST['user']) && !empty($_POST['tmp_code_pub'])){
		$commentajout = $db->prepare("INSERT INTO comment_pub(content_comment,user,pub) VALUES(:content_comment,:user,:pub)");
		$commentajout->execute([
			'user' => $_POST['user'],
			'content_comment' => $_POST['content_comment'],	
			'pub' => $_POST['tmp_code_pub']			
		]);
		?>
		<div style="display: block;">
			<div style="display: flex;">
				<img class="nonSelectionnable" height="30px" width="30px" src="IMG/favicon.png" style="float: left; margin-left: 16px"/>
				<label class="nameuser_comment">Nerzus</label><p class="p_comment"><?= $_POST['content_comment'] ?></p>
			</div>
		</div>
		<?php
	}
	else{
		echo("erreur2");
	}
}
else{
	echo("erreur1");
}

?>