<?php
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
	$send = [];
	array_push($send, $url);
	array_push($send, $to_table_sse);
	$file_content = json_encode($send);
	$folder_path = 'configurationofuser/';
	$file_name = $id_user_live . '.json';
	$file_path_in_folder = $folder_path . $file_name;
	file_put_contents($file_path_in_folder, $file_content);
}
?>
<script type="text/javascript">
	var conv_table = JSON.parse('<?= json_encode($conv_table_sse) ?>');
	var conv_to = JSON.parse('<?= json_encode($to_table_sse) ?>');
	eventSource = new EventSource("http://localhost/sse_test.php?user=<?= $id_user_live ?>");
	eventSource.onmessage = function( event ) {
		console.log(event.data)
		let dataJSON = null;
		try {
			dataJSON = JSON.parse( event.data );
			console.log(dataJSON);
		}
		catch( SyntaxError ) {
			console.error('JSON parse have fail');
			console.log( event );
			
			eventSource.close();
		}
		if (table.length !== 0) {
			a = dataJSON.length;
			for (let i = 0; i < a; i++) {
				if (dataJSON[i]['utility'] == 1) {
					if (table.indexOf(dataJSON[i]['id']) == -1) {
						if (active_conv == dataJSON[i]['conv']) {
							document.getElementById('ballgreenred').style.backgroundColor = "#b4ff00";
							if (dataJSON[i]['nat'] == 0) {
								if (dataJSON[i]['prov'] == 0) {
									let content = document.getElementById('content-msg');
									let newDiv = document.createElement('div');
									newDiv.className = 'message msg_' + dataJSON[i]['id'] + ' clear';
									newDiv.id = 'to';
									content.append(newDiv);
									let newP = document.createElement('p');
									newP.textContent = dataJSON[i]['text'];
									newDiv.append(newP);
									let newBr1 = document.createElement('br');
									newBr1.className = 'msg_' + dataJSON[i]['id'];
									let newBr2 = document.createElement('br');
									newBr2.className = 'msg_' + dataJSON[i]['id'];
									let newBr3 = document.createElement('br');
									newBr3.className = 'msg_' + dataJSON[i]['id'];
									content.append(newBr1);
									content.append(newBr2);
									content.append(newBr3);
								}
								else if (dataJSON[i]['prov'] == 1) {
									let content = document.getElementById('content-msg');
									let newContDiv = document.createElement('div');
									newContDiv.className = 'content_group_msg clear';
									let newImg = document.createElement('img');
									newImg.className = 'img_group_msg';
									newImg.src = 'IMG/account.png';
									let newDiv = document.createElement('div');
									newDiv.className = 'message msg_' + dataJSON[i]['id'] + ' clear';
									newDiv.id = 'to';
									content.append(newContDiv);
									newContDiv.append(newImg);
									newContDiv.append(newDiv);
									let newP = document.createElement('p');
									newP.textContent = dataJSON[i]['text'];
									newDiv.append(newP);
									let newBr1 = document.createElement('br');
									newBr1.className = 'msg_' + dataJSON[i]['id'];
									let newBr2 = document.createElement('br');
									newBr2.className = 'msg_' + dataJSON[i]['id'];
									let newBr3 = document.createElement('br');
									newBr3.className = 'msg_' + dataJSON[i]['id'];
									content.append(newBr1);
									content.append(newBr2);
									content.append(newBr3);
								}
							}
							else if (dataJSON[i]['nat'] == 1){
								let img = document.createElement('img');
								chemin = dataJSON[i]['text']
								chemin = chemin.replace('i:', '');
								img.src = 'img_msg/' + chemin;
								img.classList.add('img_msg', 'message', 'msg_' + dataJSON[i]['id'], 'clear');
								img.id = 'to';
								img.style.clear = 'both';
								contentMsg = document.getElementById("content-msg");
								contentMsg.appendChild(img);
								let newBr1 = document.createElement('br');
								newBr1.className = 'msg_' + dataJSON[i]['id'];
								let newBr2 = document.createElement('br');
								newBr2.className = 'msg_' + dataJSON[i]['id'];
								let newBr3 = document.createElement('br');
								newBr3.className = 'msg_' + dataJSON[i]['id'];
								contentMsg.appendChild(newBr1);
								contentMsg.appendChild(newBr2);
								contentMsg.appendChild(newBr3);
							}
							setTimeout(function() {
							  contentMsg = document.getElementById("content-msg");
							  contentMsg.scrollTop = contentMsg.scrollHeight;
							}, 100);
							table.push(dataJSON[i]['id']);
							vu(1, dataJSON[i]['id']);
						}
						else{
							if (dataJSON[i]['state' != 1]) {
								pli = conv_table.indexOf(dataJSON[i]['conv']);
								document.getElementById('new_msg_'+ pli).style.display = "block";
								number = document.getElementById('new_msg_'+ pli +'_span');
								att = number.innerHTML;
								att = parseInt(att) + 1;
								number.innerHTML = att;
								document.getElementById('new_msg_'+ pli +'_span').style.display = "block";
								table.push(dataJSON[i]['id']);
							}
						}
					}
				}
				else if(dataJSON[i]['utility'] == 2) {
					if (table.indexOf(dataJSON[i]['id']) !== -1) {
						num = table.indexOf(dataJSON[i]['id']);
						table.splice(num, 1);
						if (active_conv == dataJSON[i]['conv']) {
							document.getElementById('ballgreenred').style.backgroundColor = "#b4ff00";
							element = document.querySelector('div#to.message.msg_' + dataJSON[i]['id']);
							element.remove();
						  	content = document.querySelectorAll('br.msg_' + dataJSON[i]['id']);
						  	content[0].remove();
						  	content[1].remove();
						  	content[2].remove();
						}
					}
				}
				else if(dataJSON[i]['utility'] == 3) {
					if (active_conv == dataJSON[i]['conv']) {
						document.getElementById('ballgreenred').style.backgroundColor = "#b4ff00";
						if (dataJSON[i]['nat'] != 1 && dataJSON[i]['prov'] == 0) {
							color = document.querySelector('path.st0_' + dataJSON[i]['id']);
							if (color.style.stroke !== '#1b02ff') {
								content = document.querySelectorAll('path.st0_' + dataJSON[i]['id']);
								content[0].style.stroke = '#1b02ff';
								content[1].style.stroke = '#1b02ff';
								content[2].style.stroke = '#1b02ff';
								if (vu_vef.indexOf(dataJSON[i]['id']) !== -1) {
									for (let i = 0; i < a; i++) {
										if(vu_vef[i] < dataJSON[i]['id']){		
											content = document.querySelectorAll('path.st0_' + vu_vef[i]);
											content[0].style.stroke = '#1b02ff';
											content[1].style.stroke = '#1b02ff';
											content[2].style.stroke = '#1b02ff';
										}
									}
								}
							}
						}
					}
				}
			}
		}
	};
	eventSource_user = new EventSource("http://localhost/includes/sse-online.php?user=<?= $id_user_live ?>");
	eventSource_user.onmessage = function( event ) {
		console.log(event.data)
		let dataJSON_user = null;
		try {
			dataJSON_user = JSON.parse( event.data );
			console.log(dataJSON_user);
		}
		catch( SyntaxError ) {
			console.error('JSON parse have fail');
			console.log( event );
			
			eventSource_user.close();
		}
		b = dataJSON_user.length;
		for (let i = 0; i < b; i++) {
			num = to.indexOf(dataJSON_user[i]['user']);
			if (conv[num] == active_conv) {
				if (dataJSON_user[i]['state'] == 0) {
					document.getElementById('ballgreenred').style.backgroundColor = "#f00";
				}
				else if(dataJSON_user[i]['state'] == 1){
					document.getElementById('ballgreenred').style.backgroundColor = "#b4ff00";
				}
			}
		}
	};
</script>