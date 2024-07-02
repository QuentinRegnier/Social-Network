<?php
include '../database.php';
		global $db;
include 'database_profile.php';
        global $pro_bdd;
if(isset($_POST['tmp_code_pub'])){
	if(!empty($_POST['tmp_code_pub'])){
		$comment =$db->prepare('SELECT * FROM comment_pub WHERE pub = :tmp_code ORDER BY id DESC');
		$comment->execute([
			'tmp_code' => $_POST['tmp_code_pub']
		]);
		while($com = $comment->fetch()) {
			$name = $pro_bdd->prepare('SELECT * FROM users WHERE use_code = :id');
			$name->execute([
				'id' => $com['user']
			]);
			$pseudo = $name->fetch();
			$pseudo = $pseudo['pseudo'];
			?>
			<div style="display: block;margin-top: 10px;">
				<div style="display: flex;">
					<img class="nonSelectionnable" height="30px" width="30px" src="IMG/favicon.png" style="float: left; margin-left: 16px"/>
					<label class="nameuser_comment"><?= $pseudo ?></label><p class="p_comment"><?=$com['content_comment']?></p>
				</div>
			</div>
			<?php
		}
	}
	else{
		echo("erreur2");
	}
}
else{
	echo("erreur1");
}
?>