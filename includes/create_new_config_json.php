<?php
include 'database_profile.php';
global $pro_bdd;
$id_name = 'id';
include 'verify_sys.php';
if (isset($_POST['to_table']) && isset($_POST['conv_table']) && isset($_POST['id'])) { 
	if (!empty($_POST['to_table']) && !empty($_POST['conv_table']) && !empty($_POST['id'])) {
		$conv_table = $_POST['conv_table'];
		$to_table = $_POST['to_table'];
		$conv_table_sse = json_decode("$conv_table", true);
		$to_table_sse = json_decode("$to_table", true);
		$id_user_live = $_POST['id'];
		$num1 = count($conv_table_sse);
		$num2 = count($to_table_sse);
		$url = [];
		if ($num1 == $num2) {
			$num = $num1;
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
			$send = [];
			array_push($send, $url);
			array_push($send, $to_table_sse);
			$file_content = json_encode($send);
			$folder_path = '../configurationofuser/';
			$file_name = $id_user_live . '.json';
			$file_path_in_folder = $folder_path . $file_name;
			file_put_contents($file_path_in_folder, $file_content);
		}
	}
}