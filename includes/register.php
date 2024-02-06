<?php  
		require "PHPMailer/PHPMailerAutoload.php";	
			if(isset($_POST['formsend'])){
				$password
				$cpassword
				$email
				$pseudo
				$birthday
				$birthmonth
				$birthyear
				

				if(!empty($password) && !empty($cpassword) && !empty($email) && !empty($pseudo)){

					if($password == $cpassword){

						$options = [
							'cost' => 12,
						];
						
						$hashpass = password_hash($password, PASSWORD_BCRYPT, $options);
						
						$c = $db->prepare("SELECT email FROM users WHERE email = :email");
						$c->execute(['email' => $email]);
						$result = $c->rowCount();

						$p = $db->prepare("SELECT pseudo FROM users WHERE pseudo = :pseudo");
						$p->execute(['pseudo' => $pseudo]);
						$resulttwo = $p->rowCount();

						$bd = $db->prepare("SELECT birthday FROM users WHERE birthday = :birthday");
						$bd->execute(['birthday' => $birthday]);

						$bm = $db->prepare("SELECT birthmonth FROM users WHERE birthmonth = :birthmonth");
						$bm->execute(['birthmonth' => $birthmonth]);

						$by = $db->prepare("SELECT birthyear FROM users WHERE birthyear = :birthyear");
						$by->execute(['birthyear' => $birthyear]);

  						$dateBirth = $dateNaissance = $birthyear . '-' . $birthmonth . '-' . $birthday;
  						$today = date("Y-m-d");
 						$diff = date_diff(date_create($dateBirth), date_create($today));
						$age = $diff->format('%y');

						$sx = $db->prepare("SELECT sex FROM users WHERE sex = :sex");
						$sx->execute(['sex' => $sex]);

						$cg = $db->prepare("SELECT cgu FROM users WHERE cgu = :cgu");
						$cg->execute(['cgu' => $cgu]);

						$emailkey = rand(10000000, 99999999);
 
						if($result == 0){

							if($resulttwo == 0){

								if($age >= 18){
								$q = $db->prepare("INSERT INTO users(pseudo,email,password,age,birthday,birthmonth,birthyear,sex,cgu, emailkey, confirmemailkey) VALUES(:pseudo,:email,:password,:age,:birthday,:birthmonth,:birthyear,:sex,:cgu,:emailkey,:confirmemailkey)");
								$q->execute([
								'pseudo' => $pseudo,
								'email' => $email,
								'password' => $hashpass,
								'age' => $age,
								'birthday' => $birthday,
								'birthmonth' => $birthmonth,
								'birthyear' => $birthyear,
								'sex' => $sex,
								'cgu' => $cgu,
								'emailkey' => $emailkey,
								'confirmemailkey' => 0
								]);
								

								$recupUser = $db->prepare("SELECT * FROM users WHERE email= ?");
								$recupUser->execute(array($email));

								if($recupUser->rowCount() > 0){
									$userInfos = $recupUser->fetch();
									$_SESSION['id'] = $userInfos['id'];


									// function smtpmailer($to, $from, $from_name, $subject, $body)
									//     {
									//         $mail = new PHPMailer();
									//         $mail->IsSMTP();
									//         $mail->SMTPAuth = true; 
									 
									//         $mail->SMTPSecure = 'ssl'; 
									//         $mail->Host = 'smtp.gmail.com';
									//         $mail->Port = 465;  
									//         $mail->Username = 'natspacedev@gmail.com';
									//         $mail->Password = 'nhxx nooj sbfg dzey ';   
									   
									//    	// $path = 'reseller.pdf';
									//    	// $mail->AddAttachment($path);
									   
									//         $mail->IsHTML(true);
									//         $mail->From= "maxlerinnaturist@gmail.com";
									//         $mail->FromName=$from_name;
									//         $mail->Sender=$from;
									//         $mail->AddReplyTo($from, $from_name);
									//         $mail->Subject = $subject;
									//         $mail->Body = $body;
									//         $mail->AddAddress($to);
									//         if(!$mail->Send())
									//         {
									//             $error ="Please try Later, Error Occured while Processing...";
									//             return $error; 
									//         }
									//         else 
									//         {
									//             $error = "Thanks You !! Your email is sent.";  
									//             return $error;
									//         }

									//     }
									function smtpmailer($to, $from, $from_name, $subject, $body) {
											$mail = new PHPMailer();
											$mail->IsSMTP();
											$mail->SMTPAuth = true; 
										
											$mail->SMTPSecure = 'tls'; // Utilisez TLS
											$mail->Host = 'mailslurp.mx'; // L'hôte SMTP de MailSlurp
											$mail->Port = 2587;  // Le port SMTP de MailSlurp
											$mail->Username = 'jStS0nPomhhLg5Rf3SK8IVhAZ275zzFl'; // Remplacez par votre nom d'utilisateur MailSlurp
											$mail->Password = 'gpP8Le9FBeUDfsxi9mwGB25vqvE1S07j';   // Remplacez par votre mot de passe MailSlurp
										
											// ... le reste du code reste inchangé ...
										
											if(!$mail->Send()) {
												$error = "Please try Later, Error Occured while Processing...";
												return $error; 
											} else {
												$error = "Thanks You !! Your email is sent.";  
												return $error;
											}
										}
										
									    
									    $to   = $email;
									    $from = 'maxlerinnaturist@gmail.com';
									    $name = 'Naturist';
									    $subj = 'Confirmation de compte que vous venez de créer';
									    $msg = 'http://localhost/verif.php?id='.$_SESSION['id'].'&emailkey='.$emailkey;
									    
									    $error=smtpmailer($to,$from, $name ,$subj, $msg);
									   	header('Location: vaverif.php');
								}

								}else{
									echo "Vous n'avez pas l'age requis pour vous inscrire sur ce site, il faut 18 ans pour pouvoir s'inscrire";
								}
		
						}else{
							echo "Un compte possèdant le même Pseudo existe déjà veuillet choisir un autre Pseudo";
							?>
							<script type="text/javascript">
								const validationInput = document.querySelector('.pseudo');
								validationInput.style.borderColer = "red";
							</script>
							<?php
						}
							
						}else{
							echo "Un compte possèdant le même Email existe déjà veuillet choisir un autre Email";
						}
					}

					// if(password_verify('fromage22', $hashpass)){
					// 	echo "le mot de passe est le même";
					// } else {
					// 	echo "le mot de passe n'est pas correcte";
					// }
				}else{
					echo "les champs ne sont pas tous remplies";
				}
				
			}
			
		
		?>