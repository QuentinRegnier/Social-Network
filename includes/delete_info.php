<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
include 'database_message.php';
		global $msg_bdd;
$table=[];
$result=[];
$pass =0;
$id_discution = $_GET['conv'];
$id_to = $_GET['to'];
$search = $msg_bdd->prepare('SELECT id FROM message WHERE discution_id = :idconv AND user = :idto');
$search->execute([
	'idconv' => $id_discution,
	'idto' => $id_to
]);
while($insert = $search->fetch()){
	array_push($table, $insert['id']);
}
while ( true ) {
	
	$send =[];
	$step = 0;
	$result=[];
	$recoverMessages = $msg_bdd->prepare('SELECT id FROM message WHERE discution_id = :idconv AND user = :idto');
	$recoverMessages->execute([
		'idconv' => $id_discution,
		'idto' => $id_to
	]);
	while($mess = $recoverMessages->fetch()){
		array_push($result, $mess['id']);
	}
	$num = count($result);
	for ($i = 0; $i < $num; $i++) {
    	if (!in_array($result[$i],$table)) {array_push($table, $result[$i]);}
	}
	$num = count($table);
	for ($i = 0; $i < $num; $i++) {
    	if (!in_array($table[$i],$result)) {array_push($send, $table[$i]);$step=1;}
	}
	if ($send != null){
		$num = count($send);
		for ($i = 0; $i < $num; $i++) {
			$cle = array_search($send[$i], $table);
			array_splice($table, $cle, 1);
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
?>