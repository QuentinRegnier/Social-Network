<?php
if (isset($_POST['conv']) && isset($_POST['to']) && isset($_POST['id'])) {
	if (!empty($_POST['conv']) && !empty($_POST['to']) && !empty($_POST['id'])) {
		$conv_table_sse = $_POST['conv'];
		$to_table_sse = $_POST['to'];
		$id_user_live = $_POST['id'];
		$conv_table_sse = json_decode("$conv_table_sse", true);
		$to_table_sse = json_decode("$to_table_sse", true);
		$num1 = count($conv_table_sse);
		$num2 = count($to_table_sse);
		$i = 0;
		$url = [];
		if ($num1 == $num2) {
			$num = $num1 = $num2;
			$user_url = Array(
					"user" => $id_user_live
			);
			array_push($url, $user_url);	
			for ($i = 0; $i < $num; $i++) {
				$tableau_url = Array(
					"conv" => $conv_table_sse[$i],
					"to" => $to_table_sse[$i]
				);
				array_push($url, $tableau_url);		
			}
		}
		echo http_build_query($url);
	}
}
?>