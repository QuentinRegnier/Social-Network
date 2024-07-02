<?php
include 'includes/database_message.php';
		global $msg_bdd;
	$discution_id = "ezdhnijkezd&ézuoijde_hjé_àe'dzunbfezd";
	if(isset($_POST['valider'])){
		if(!empty($_POST['message']) && !empty($_POST['user_id']) && !empty($_POST['discution'])){
			$user = (int)$_POST['user_id'];
			$message = $_POST['message'];
			$discution = $_POST['discution'];
			$to = 1;
			$insertmsg = $msg_bdd->prepare('INSERT INTO message(user,message, user_destination, discution_id) VALUES(:user,:message, :to, :id)');
			$insertmsg->execute([
				'user' => $user,
				'message' => $message,
				'to' => $to,
				'id' => $discution
			]);
		}
		else{
			echo "pas bien !";
			echo(var_dump($_POST)); 
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<title>Messagerie</title>
</head>
<body style="text-align: center;">
	<form method="POST" action="">
		<input type="text" name="user_id" placeholder="from">
		<br><br>
		<textarea name="message"></textarea>
		<br><br>
		<select name="discution">
			<option value="null"></option>
			<option value="zeuinbéuée_çduibezdibué_àfvyifervuherf">
				Astrid et Frank
			</option>
			<option value="ezdhnijkezd&ézuoijde_hjé_àe'dzunbfezd">
				Léonard et Frank
			</option>
			<option value="efruicerfr_ç('ubfrve_àf'(ubcerv">
				Tom et Frank
			</option>
		</select>
		<br>
		<input type="submit" name="valider">
		</textarea>
	</form>
	<section id="message">
<?php
	$from = 2;
	$to = 1;
	$id_discution = "ezdhnijkezd&ézuoijde_hjé_àe'dzunbfezd";
	$recoverMessages = $msg_bdd->prepare('SELECT * FROM message WHERE discution_id = :id ORDER BY creation_date');
	$recoverMessages->execute([
		'id' => $id_discution
	]);
	while($message = $recoverMessages->fetch()){
		if($message['user'] == $from){$id_div = "from";}
		elseif($message['user'] == $to){$id_div = "to";}
		?>
		<div class="message" id="<?= $id_div ?>">
			<p><?= $message['message']; ?></p>
		</div>
		<br><br><br>
		<?php
	}
?>
	</section>
	<style type="text/css">
		div#to{
			float: left;
		}
		div#from{
			float: right;
		}
	</style>
	<script type="text/javascript">
		var eventSource = new EventSource("includes/load_chat.php");
		eventSource.onmessage = function(event) {
		    document.getElementById("message").innerHTML += event.data;
		    console.log('messsssage!!!!')
		};
	</script>
</body>
</html>
