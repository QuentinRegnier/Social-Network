<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
include 'includes/database_message.php'; 
		global $msg_bdd;
if (isset($_GET)) {
	if (!empty($_GET)) {
		$table=[];
		$result=[];
		$supp=[];
		$vu=[];
		$user = $_GET['user'];
		$file_path = 'configurationofuser/'.$user.'.json';
		$file_content = file_get_contents($file_path);
		$data = json_decode($file_content, true);
		$parametres = $data[0];
		$number = count($parametres);
		$idconv = null;
		$execute = [];
		$conv = [];
		$idconv = '';
		$idto = '';
		for ($i = 1; $i < $number; $i++){
			$verif = $msg_bdd->prepare('SELECT id FROM conv_info WHERE conv_id = :idconv AND user = :id');
			$verif->execute([
				'idconv' => $parametres[$i]['conv'],
				'id' => $user
			]);
			if($verif->rowCount() > 0){
				if ($i+1 == $number) {
					$idconv .= ':idconv' . $i;
					$idto .= ':idto' . $i;
				}
				else{
					$idconv .= ':idconv' . $i . ', ';
					$idto .= ':idto' . $i . ', ';
				}
				$execute['idconv'.$i] = $parametres[$i]['conv'];
				$execute['idto'.$i] = $parametres[$i]['to'];
			}
		}
		$sql = 'SELECT * FROM message WHERE discution_id IN (' . $idconv . ') AND user IN (' . $idto . ')';
		$search = $msg_bdd->prepare($sql);
		$search->execute($execute);
		while($insert = $search->fetch()){
			array_push($table, $insert['id']);
			$conv[$insert['id']] = $insert['discution_id'];
		}
		while ( true ) {
			$send =[];
			$result=[];
			$supp=[];
			$recoverMessages = $msg_bdd->prepare($sql);
			$recoverMessages->execute($execute);
			// Part of Add
			while($message = $recoverMessages->fetch()){
				array_push($result, $message['id']);
				if (!in_array($message['id'],$table)) {
		    		array_push($table, $message['id']);
		    		$conv[$message['id']] = $message['discution_id'];
		    		$new = Array ( 
		    			"id" => $message['id'],
		    			"text" => $message['message'],
		    			"user" => $message['user'],
		    			"conv" => $message['discution_id'],
		    			"utility" => 1,
		    			"nat" => $message['nat'],
		    			"state" => $message['state'],
		    			"prov" => $message['prov']
		    		);
		    		array_push($send, $new);
		    	}
			}
			// Part of Delete
			$num = count($table);
			for ($i = 0; $i < $num; $i++) {
		    	if (!in_array($table[$i],$result)) {
		    		$new = Array ( 
		    			"id" => $table[$i],
		    			"conv" => $conv[$table[$i]],
		    			"utility" => 2
		    		);
		    		array_push($supp, $table[$i]);
		    		array_push($send, $new);
		    	}
			}
			// Part of Vu
			$searchvu = $msg_bdd->prepare('SELECT id, discution_id, nat, prov FROM message WHERE user = :id AND state = :state ORDER BY creation_date DESC LIMIT 1');
			$searchvu->execute([
				'id' => $user,
				'state' => 1
			]);
			$new_vu = null;
			$messvu = $searchvu->fetch();
			if(!in_array($messvu['id'],$vu)){
				array_push($vu, $messvu['id']);
				$new_vu = Array ( 
	    			"id" => $messvu['id'],
	    			"conv" => $messvu['discution_id'],
	    			"utility" => 3,
	    			"nat" => $messvu['nat'],
	    			"prov" => $messvu['prov']
	    		);
			}
			if($new_vu != null){
				array_push($send, $new_vu);
			}
			if (!empty($send)){
				if (!empty($supp)){
					$num = count($supp);
					for ($i = 0; $i < $num; $i++) {
						$cle = array_search($supp[$i], $table);
						array_splice($table, $cle, 1);
			    	}
		    	}
				echo 'data:';
				$json = json_encode($send);
				echo "$json";
				echo "\n\n";
				ob_flush();
				flush();
				sleep(5);
		    }
		    
		}
	}
}
?>