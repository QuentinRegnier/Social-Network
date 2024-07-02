var input_img_one = "mail";
var input_img_two = "lock";
var register_info = [];
var mode = "login";
var prevLength = 0;
register_info['date'] = "";
register_info['who'] = "";
register_info['pseudo'] = "";
register_info['mail'] = "";
register_info['mdp'] = "";
pass444tosup = 0;
var errorregister, errorregister2;
// #################################################################################
var getHttpRequest = function () {
     var httpRequest = false;

     if (window.XMLHttpRequest) { //Mozilla,Safari,...

          httpRequest = new XMLHttpRequest();

          if (httpRequest.overrideMimeType) {

               httpRequest.overrideMimeType('text/xml');

          }

     }

     else if (window.ActiveXObject) { //IE

          try {
               httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
          }

          catch (e) {
                         
               try{

                    httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
               }

               catch (e) {}
          }
     }
     if (!httpRequest) {
          alert('Abandon :( Impossible de créer une instance XMLHTTP');
          return false;
     }

     return httpRequest;
}
document.getElementById('input_login_one').onfocus = function() {
	document.getElementById("img_input_one_login").src="IMG/" + input_img_one + "bg.png";
}
document.getElementById('input_login_one').onblur = function() {
	document.getElementById("img_input_one_login").src="IMG/" + input_img_one + ".png";
}
document.getElementById('input_login_two').onfocus = function() {
	document.getElementById("img_input_two_login").src="IMG/" + input_img_two + "bg.png";
}
document.getElementById('input_login_two').onblur = function() {
	document.getElementById("img_input_two_login").src="IMG/" + input_img_two +".png";
}
document.getElementById('select_who').onfocus = function() {
	document.getElementById("img_input_two_login").src="IMG/" + input_img_two + "bg.png";
}
document.getElementById('select_who').onblur = function() {
	document.getElementById("img_input_two_login").src="IMG/" + input_img_two +".png";
}
function Send_login_request(){ 
        var httpRequest = getHttpRequest();
	mail = document.getElementById('input_login_one').value;
	pass = document.getElementById('input_login_two').value;
	httpRequest.onreadystatechange = function () {
		if (httpRequest.readyState === 4){
		  	if (httpRequest.responseText == "X0") {
		  		document.getElementById('tooltipId-one').innerHTML = jsonData[123];
		  		document.getElementById('error_one').style.display = "block";
		  		document.getElementById('input_login_one').style.borderBottom = "4px solid red";
		  		document.getElementById('tooltipId-two').innerHTML = jsonData[123];
		  		document.getElementById('error_two').style.display = "block";
		  		document.getElementById('input_login_two').style.borderBottom = "4px solid red";
		  	}else if (httpRequest.responseText == "X1") {
		  		document.getElementById('tooltipId-one').innerHTML = jsonData[122];
		  		document.getElementById('error_one').style.display = "block";
		  		document.getElementById('input_login_one').style.borderBottom = "4px solid red";
		  		document.getElementById('tooltipId-two').innerHTML = jsonData[121];
		  		document.getElementById('error_two').style.display = "block";
		  		document.getElementById('input_login_two').style.borderBottom = "4px solid red";
		  	}else if (httpRequest.responseText == "X2") {
		  		document.getElementById('error_one').style.display = "none";
		  		document.getElementById('input_login_one').removeAttribute('style');
		  		document.getElementById('tooltipId-two').innerHTML = jsonData[121];
		  		document.getElementById('error_two').style.display = "block";
		  		document.getElementById('input_login_two').style.borderBottom = "4px solid red";
		  	}else if (httpRequest.responseText !== "") {
		  		document.getElementById('input_login_one').value = "";
				document.getElementById('input_login_two').value = "";
				window.location.href = "http://127.0.0.1/" + httpRequest.responseText;
		  	}else{
		  		// erreur
		  	}
		}  
	}
	httpRequest.open('POST', 'includes/login.php', true)
	httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
	httpRequest.overrideMimeType("text/plain")
	httpRequest.send("mail=" + encodeURIComponent(mail) + "&pass=" + encodeURIComponent(pass))
}
function Send_register_request(){
	var httpRequest = getHttpRequest();
	mail = register_info['mail'];
	pass = register_info['mdp'];
	date = register_info['date'];
	who = register_info['who'];
	pseudo = register_info['pseudo'];
	morning0Checkbox = document.getElementById("morning0");
	morning1Checkbox = document.getElementById("morning1");
	if (morning0Checkbox.checked && morning1Checkbox.checked) {
		cgu = 1;
		cgv = 1;
		document.getElementById('error_checkbox').style.display = 'none';
		appliquerInstructions(["contentcheck0","contentcheck1","space-login","br_2","br_3","br_4","br_5"], "none");
		document.getElementById('annimation_loader_front').style.display = "block";
	} 
	else {document.getElementById('error_checkbox').style.display = 'block';}
}
function Rotate_card_step_one(){
	document.getElementById('html_corp').style.overflowY = 'hidden';
	setTimeout(Rotate_card_step_two, 10);
}
function Rotate_card_step_two(){
	document.getElementById('hidden_login').style.display = 'none'
	document.getElementById('rotate').style.transform = 'rotateY(180deg)';
	document.getElementById('front').style.transform = 'rotateY(180deg)';
	setTimeout(Rotate_card_step_three, 10);
}
function Rotate_card_step_three(num){
	mode = "register";
	if (num == 1) {
		register_info['mdp'] = document.getElementById('input_login_one').value;
		if (!checkConditions(1)) {
			updateLoginContentPosition(1);
			if (errorregister == 2) {
				document.getElementById('tooltipId-one').innerHTML = jsonData[126];
				document.getElementById('error_one').style.display = "block";
				document.getElementById('input_login_one').style.borderBottom = "4px solid red";
			}else if (errorregister == 3) {
				document.getElementById('tooltipId-two').innerHTML = jsonData[127];
				document.getElementById('error_two').style.display = "block";
				document.getElementById('input_login_two').style.borderBottom = "4px solid red";
			}else if (errorregister == 4) {
				document.getElementById('tooltipId-one').innerHTML = jsonData[129];
				document.getElementById('error_one').style.display = "block";
				document.getElementById('input_login_one').style.borderBottom = "4px solid red";
				document.getElementById('tooltipId-two').innerHTML = jsonData[129];
				document.getElementById('error_two').style.display = "block";
				document.getElementById('input_login_two').style.borderBottom = "4px solid red";
			}
			return;
		}
	}
	updateLoginContentPosition(4);
}
function Rotate_card_reverse_step_one(){
	mode = "login";
	document.getElementById('butt-dsc').style.display = "none";
	document.getElementById('error_one').style.display = "none";
	document.getElementById('input_login_one').removeAttribute('style');
	document.getElementById('error_two').style.display = "none";
	document.getElementById('input_login_two').removeAttribute('style');
	updateLoginContentPosition();
	document.getElementById('html_corp').style.overflowY = 'hidden';
	setTimeout(Rotate_card_reverse_step_two, 10);
}
function Rotate_card_reverse_step_two(){
	document.getElementById('hidden_login').style.display = 'block'
	document.getElementById('rotate').style.transform = 'rotateY(-180deg)';
	document.getElementById('back').style.transform = 'rotateY(-180deg)';
	setTimeout(Rotate_card_reverse_step_three, 10);
}
function Rotate_card_reverse_step_three(){
	updateLoginContentPosition(3);
}
async function steptworegister(num){
	if (num == 1) {
		if (!checkConditions(2)) {
			updateLoginContentPosition(2);
			document.getElementById('tooltipId-one').innerHTML = jsonData[128];
			document.getElementById('error_one').style.display = "block";
			document.getElementById('input_login_one').style.borderBottom = "4px solid red";
			if (errorregister == 4){
				document.getElementById('tooltipId-one').innerHTML = jsonData[128];
				document.getElementById('error_one').style.display = "block";
				document.getElementById('input_login_one').style.borderBottom = "4px solid red";
			}
			return;
		}
		register_info['date'] = document.getElementById('input_login_one').value;
		register_info['who'] = document.getElementById('select_who').value;
	}
	if (num == 2) {
		try {
			checkConditions0 = await checkConditions(0);
			if (!checkConditions0) {
				updateLoginContentPosition(4);
				if (errorregister == 0) {
					document.getElementById('tooltipId-one').innerHTML = jsonData[54];
					document.getElementById('error_one').style.display = "block";
					document.getElementById('input_login_one').style.borderBottom = "4px solid red";
				}else if(errorregister == 1){
					document.getElementById('tooltipId-two').innerHTML = jsonData[125];
					document.getElementById('error_two').style.display = "block";
					document.getElementById('input_login_two').style.borderBottom = "4px solid red";
				}else if (errorregister == 4) {
					document.getElementById('tooltipId-one').innerHTML = jsonData[129];
					document.getElementById('error_one').style.display = "block";
					document.getElementById('input_login_one').style.borderBottom = "4px solid red";
					document.getElementById('tooltipId-two').innerHTML = jsonData[129];
					document.getElementById('error_two').style.display = "block";
					document.getElementById('input_login_two').style.borderBottom = "4px solid red";
				}else if(errorregister == 5) {
					document.getElementById('tooltipId-one').innerHTML = jsonData[151];
					document.getElementById('error_one').style.display = "block";
					document.getElementById('input_login_one').style.borderBottom = "4px solid red";
				}if(errorregister == 6 || errorregister2 == 6) {
					document.getElementById('tooltipId-two').innerHTML = jsonData[152];
					document.getElementById('error_two').style.display = "block";
					document.getElementById('input_login_two').style.borderBottom = "4px solid red";
				}
				return;
			}
			register_info['pseudo'] = document.getElementById('input_login_one').value;
			register_info['mail'] = document.getElementById('input_login_two').value;
		  } catch (error) {
			console.error(error);
		  }
	}
	updateLoginContentPosition(1);
}
function stepthreeregister(num){
	if (num == 2) {
		updateLoginContentPosition(2);
	}
	else if (!checkConditions(1)) {
		updateLoginContentPosition(1);
		if (errorregister == 2) {
			document.getElementById('tooltipId-one').innerHTML = jsonData[126];
			document.getElementById('error_one').style.display = "block";
			document.getElementById('input_login_one').style.borderBottom = "4px solid red";
		}else if (errorregister == 3) {
			document.getElementById('tooltipId-two').innerHTML = jsonData[127];
			document.getElementById('error_two').style.display = "block";
			document.getElementById('input_login_two').style.borderBottom = "4px solid red";
		}else if (errorregister == 4) {
				document.getElementById('tooltipId-one').innerHTML = jsonData[129];
				document.getElementById('error_one').style.display = "block";
				document.getElementById('input_login_one').style.borderBottom = "4px solid red";
				document.getElementById('tooltipId-two').innerHTML = jsonData[129];
				document.getElementById('error_two').style.display = "block";
				document.getElementById('input_login_two').style.borderBottom = "4px solid red";
		}
		return;
	}
	if (num == 1) {
		register_info['mdp'] = document.getElementById('input_login_one').value;
	}
	updateLoginContentPosition(2);
}
function stepfourregister(num){
	if (num == 1) {
		if (!checkConditions(2)) {
			updateLoginContentPosition(2);
			document.getElementById('tooltipId-one').innerHTML = jsonData[128];
			document.getElementById('error_one').style.display = "block";
			document.getElementById('input_login_one').style.borderBottom = "4px solid red";
			if (errorregister == 4){
				document.getElementById('tooltipId-one').innerHTML = jsonData[128];
				document.getElementById('error_one').style.display = "block";
				document.getElementById('input_login_one').style.borderBottom = "4px solid red";
			}
			return;
		}
		register_info['date'] = document.getElementById('input_login_one').value;
		register_info['who'] = document.getElementById('select_who').value;
	}
	updateLoginContentPosition(5);
}
function updateInputValue_gr() {
    selectElement_gr = document.getElementById('select_who');
    selectedValue_gr = selectElement_gr.value;
    if (selectedValue_gr == 0) {input_img_two = "femenine"}
   	else if (selectedValue_gr == 1) {input_img_two = "male-gender";}
   	else if (selectedValue_gr == 2) {input_img_two = "lgbt";}
   	else if (selectedValue_gr == 3) {input_img_two = "wedding-rings";}
   	else{input_img_two = "x-mark";}
    document.getElementById("img_input_two_login").src = "IMG/"+input_img_two+"bg.png";
}
document.getElementById('select_who').addEventListener('change', updateInputValue_gr);
function formatDate(e) {
  input = e.target;
  length_input = input.value.replace(/\D/g, '');
  let dateArray = input.value.replace(/\D/g, '').split('');
  if (length_input.length > 10) {
    input.value = input.value.slice(0, 10);
  }
  if (prevLength <= length_input.length) {
	  	// Règle 1 : Si le jour est supérieur à 31, attribuer 31
	  if (parseInt(dateArray[0] + dateArray[1]) > 31) {
	    dateArray[0] = '3';
	    dateArray[1] = '1';
	  }

	  // Règle 2 : Si le mois est supérieur à 12, attribuer 12
	  if (parseInt(dateArray[2] + dateArray[3]) > 12) {
	    dateArray[2] = '1';
	    dateArray[3] = '2';
	  }

	  // Règle 3 : Si l'année est inférieure à 1900, attribuer 1900
	  yearStr = dateArray.slice(4).join('');
	  if (yearStr.length === 4 && parseInt(yearStr) < 1900) {
		dateArray = dateArray.slice(0, 4).concat('1900'.split(''));
	  }

	  day = parseInt(dateArray[0] + dateArray[1]);
	  month = parseInt(dateArray[2] + dateArray[3]);
	  year = parseInt(dateArray.slice(4).join(''));
	  // Règle 4 : Gérer les mois avec un nombre incorrect de jours
	  maxDaysInMonth = new Date(year, month, 0).getDate();
	  if (!dateArray[3] && !dateArray[3] && day > maxDaysInMonth) {
	    if (dateArray[2] + dateArray[3] != '02') {
	    	dateArray[0] = Math.floor(maxDaysInMonth / 10).toString();
		    dateArray[1] = (maxDaysInMonth % 10).toString();
	    } else if (dateArray[2] + dateArray[3] != '02' && day > 29) {
		    // Si le mois est février, fixez le jour à 29 si supérieur à 29
		    dateArray[0] = '2';
		    dateArray[1] = '9';
		  }
	  }

	  // Règle 5 : Gérer les années bissextiles
	  isLeapYear = (year % 4 === 0 && year % 100 !== 0) || (year % 400 === 0);
	  if (!isLeapYear && month === 2 && day > 28 && yearStr.length === 4) {
	    dateArray[0] = '2';
	    dateArray[1] = '8';
	  }

	  // Règle 6 : Si l'année est supérieure à l'année actuelle plus 18, attribuer l'année actuelle plus 18
	  const currentYear = new Date().getFullYear();
	  if (year > currentYear - 18) {
	    newYear = currentYear - 18;
	    dateArray = dateArray.slice(0, 4).concat(newYear.toString().split(''));
	  }

	  if (length_input.length >= 1) {
	  	input.value = dateArray[0];
	  	if (length_input.length >= 2){
		  	input.value += dateArray[1];
		  	if (length_input.length >= 3){
			  	input.value += '/' + dateArray[2];
			  	if (length_input.length >= 4){
				  	input.value += dateArray[3];
				  	if (length_input.length >= 5){
					  	input.value += '/' + dateArray[4];
					  	if (length_input.length >= 6){
						  	input.value += dateArray[5];
						  	if (length_input.length >= 7){
							  	input.value += dateArray[6];
							  	if (length_input.length >= 8){
								  	input.value += dateArray[7];
								}
							}
						}
					}
				}
			}
		}
	  }else{
	  	input.value = '';
	  }
  }
  prevLength = length_input.length;
}
function calculateAge(birthdate) {
  today = new Date();
  birthdateArray = birthdate.split('/');
  birthYear = parseInt(birthdateArray[2]);
  birthMonth = parseInt(birthdateArray[1]) - 1;
  birthDay = parseInt(birthdateArray[0]);
  
  age = today.getFullYear() - birthYear;
  hasPassedBirthday = today.getMonth() > birthMonth || (today.getMonth() === birthMonth && today.getDate() >= birthDay);
  
  if (!hasPassedBirthday) {
    return age - 1;
  }
  
  return age;
}
function isUserAdult(birthdate) {
  age = calculateAge(birthdate);
  return age >= 18;
}
function verifMotDePasse(motDePasse) {
  	longueurMinimale = 8;
  	contientMajuscule = /[A-Z]/.test(motDePasse);
  	contientMinuscule = /[a-z]/.test(motDePasse);
  	contientChiffre = /\d/.test(motDePasse);
  	contientCaractereSpecial = /[\W_]/.test(motDePasse);

  	estRobuste = motDePasse.length >= longueurMinimale &&
    contientMajuscule &&
    contientMinuscule &&
    contientChiffre &&
    contientCaractereSpecial;

  return estRobuste;
}
function isEmpty(value) {
  return value == null || value === '' || (Array.isArray(value) && value.length === 0);
}
async function checkConditions(num) {
  	inputOne = document.getElementById('input_login_one').value;
  	inputTwo = document.getElementById('input_login_two').value;
  	if (num == 0 && !isEmpty(inputOne) && !isEmpty(inputTwo)) {
		regex_one = /^[a-zA-Z0-9_]{1,14}$/;
	  	regex_two = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
		try {
			regex_three = await checkindb(1, [inputOne, inputTwo]);
			if (!regex_one.test(inputOne)) {
				console.log("false");
				errorregister = 0;
				return false;
			}else{
				document.getElementById('error_one').style.display = "none";
				document.getElementById('input_login_one').removeAttribute('style');
				console.log("true");
			}
			if (!regex_two.test(inputTwo)) {
				console.log("false");
				errorregister = 1;
				return false;
			}else{
				document.getElementById('error_two').style.display = "none";
				document.getElementById('input_login_two').removeAttribute('style');
				console.log("true");
			}
			if (regex_three != true) {
				console.log("false");
				if (regex_three[0] != 1){
					errorregister = 5;
				}else if(regex_three[1] != 1){
					errorregister = 6;
				}
				if (regex_three[1] != 1){
					errorregister2 = 6;
				}else{
					errorregister2 = 0;
				}
				return false;
			}else{
				console.log("true");
				return true;
			}
		} catch (error) {
			console.error(error);
		}
  	}
  	else if (num == 1 && !isEmpty(inputOne) && !isEmpty(inputTwo)) {
	  	if (!verifMotDePasse(inputOne)) {
			console.log("false");
			errorregister = 2;
	    	return false;
	  	}else{
			document.getElementById('error_one').style.display = "none";
			document.getElementById('input_login_one').removeAttribute('style');
			console.log("true");
	  	}
	  	if (inputOne != inputTwo) {
			console.log("false");
			errorregister = 3;
	    	return false;
	  	}else{
	  		document.getElementById('error_two').style.display = "none";
			document.getElementById('input_login_two').removeAttribute('style');
			console.log("true");
	  		return true;
	  	}
  	}
  	else if (num == 2 && !isEmpty(inputOne) && !isEmpty(inputTwo)) {
		regex = /^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/\d{4}$/;
	  	if (!regex.test(inputOne) && !isUserAdult(inputOne)) {
			console.log("false");
	    	return false;
	  	}else{
	  		document.getElementById('error_one').style.display = "none";
			document.getElementById('input_login_one').removeAttribute('style');
			console.log("true");
	  		return true;
	  	}
  	}
  	else{
  		errorregister = 4;
	    return false;
  	}
}
function updateLoginContentPosition(info) {
    loginContent = document.querySelector('.login_content');
    sousTitle = document.getElementById('sous_title');
    inputLoginONE = document.getElementById('input_login_one');
    inputLoginTWO = document.getElementById('input_login_two');
    subcribeDiv = document.querySelector('.subcribe_div');
    spanButton = document.querySelectorAll('.text_button_login');
    loginButton = document.getElementById('login_btn');
	titleLogin = document.querySelector('.title_login');
	imgInputLoginOne = document.querySelector('.img_input_login_one');
	inputLogin = document.querySelectorAll('.input_login');
	imgContainerOne = document.querySelector('.img-container-one');
	imgContainerTwo = document.querySelector('.img-container-two');
	imgInputLoginTwo = document.querySelector('.img_input_login_two');
	tooltipOne = document.querySelector('.tooltip-one');
	tooltipTwo = document.querySelector('.tooltip-two');
	connectDiv = document.querySelector('.connect_div');
	buttdisc = document.getElementById('butt-dsc');
	select_who = document.getElementById('select_who');

  if (window.innerWidth > 444 && pass444tosup == 1) {
  	pass444tosup = 0;
  	loginContent.removeAttribute('style');
	sousTitle.removeAttribute('style');
	inputLoginONE.removeAttribute('style');
	inputLoginTWO.removeAttribute('style');
	subcribeDiv.removeAttribute('style');
	for (let i = 0; i < spanButton.length; i++) {
	    spanButton[i].removeAttribute('style');
	}
	loginButton.removeAttribute('style');
	titleLogin.removeAttribute('style');
	imgInputLoginOne.removeAttribute('style');
	for (let i = 0; i < inputLogin.length; i++) {
	    inputLogin[i].removeAttribute('style');
	}
	imgContainerOne.removeAttribute('style');
	imgContainerTwo.removeAttribute('style');
	imgInputLoginTwo.removeAttribute('style');
	tooltipOne.removeAttribute('style');
	tooltipTwo.removeAttribute('style');
	connectDiv.removeAttribute('style');
	buttdisc.removeAttribute('style');
	select_who.removeAttribute('style');
  }
  if (info == 2) {
  	document.getElementById('morning0').style.display = 'none';
	a = document.querySelectorAll('.cbx');
	a[0].style.display = 'none';
	a[1].style.display = 'none';
	document.getElementById('morning1').style.display = 'none';
	b = document.querySelectorAll('.inline-svg');
	b[0].style.display = 'none';
	b[1].style.display = 'none';
  	document.getElementById('input_login_one').value = register_info['date'];
	document.getElementById('error_one').style.display = "none";
	document.getElementById('input_login_one').removeAttribute('style');
	document.getElementById('input_login_one').setAttribute('oninput', 'formatDate(event)');
	document.getElementById('error_two').style.display = "none";
	document.getElementById('input_login_two').removeAttribute('style');
	document.getElementById('login_btn').setAttribute('onclick','steptworegister(1)');
	updateLoginContentPosition();
	document.getElementById('title_card').innerHTML = jsonData[120];
	document.getElementById("img_input_one_login").src = "IMG/calendarlog.png";
	input_img_one = "calendarlog";
	document.getElementById('input_login_one').type='text';
	document.getElementById('input_login_one').placeholder = jsonData[118];
	document.getElementById("img_input_two_login").src = "IMG/wedding-rings.png";
	input_img_two = "wedding-rings";
	document.getElementById('input_login_two').style.display = "none";
	document.getElementById('select_who').removeAttribute('style');
	document.getElementById('subcribe_btn').innerHTML = jsonData[115];
	document.getElementById('div_subcribe_btn').setAttribute('onclick','stepfourregister(1)');
	document.getElementById('input_login_one').style.display = 'initial';
	document.getElementById("img_input_one_login").style.display = 'initial';
	document.getElementById("img_input_two_login").style.display = 'initial';
	document.getElementById('morning0').style.display = 'none';
	a = document.querySelectorAll('.cbx');
	a[0].style.display = 'none';
	a[1].style.display = 'none';
	document.getElementById('morning1').style.display = 'none';
	b = document.querySelectorAll('.inline-svg');
	b[0].style.display = 'none';
	b[1].style.display = 'none';
	document.getElementById('contentcheck0').style.display = 'none';
	document.getElementById('contentcheck1').style.display = 'none';
	document.getElementById('error_checkbox').style.display = 'none';
  }
  if (info == 1) {
  	document.getElementById('input_login_one').value = register_info['mdp'];
	document.getElementById('input_login_two').value = register_info['mdp'];
	document.getElementById('select_who').style.display = "none";
	document.getElementById('error_one').style.display = "none";
	document.getElementById('input_login_one').removeAttribute('style');
	document.getElementById('input_login_one').removeAttribute('oninput')
	document.getElementById('error_two').style.display = "none";
	document.getElementById('input_login_two').removeAttribute('style');
	document.getElementById('login_btn').setAttribute('onclick','Rotate_card_step_three(1)');
	updateLoginContentPosition();
	document.getElementById('title_card').innerHTML = jsonData[119];
	document.getElementById('sous_title').style.width = '350px';
	document.getElementById('sous_title').style.marginLeft = '-450px';
	document.getElementById("img_input_one_login").src = "IMG/lock.png";
	document.getElementById("img_input_one_login").style.height = '44px';
	document.getElementById("img_input_one_login").style.marginLeft = '30px';
	document.getElementById("img_input_one_login").style.marginRight = '-77px';
	input_img_one = "lock";
	document.getElementById('input_login_one').type='password';
	document.getElementById('input_login_one').placeholder = jsonData[116];
	document.getElementById("img_input_two_login").src = "IMG/lock.png";
	document.getElementById("img_input_two_login").style.height = '44px';
	document.getElementById("img_input_two_login").style.marginLeft = '30px';
	document.getElementById("img_input_two_login").style.marginRight = '-77px';
	input_img_two = "lock";
	document.getElementById('input_login_two').type='password';
	document.getElementById('input_login_two').placeholder = jsonData[117];
	document.getElementById('div_subcribe_btn').setAttribute('onclick', 'stepthreeregister(1)');
	document.getElementById('subcribe_btn').innerHTML = jsonData[115];
  }
  if (info == 3) {
  	document.getElementById('html_corp').style.overflowY = 'scroll';
	document.getElementById('input_login_one').value = "";
	document.getElementById('input_login_two').value = "";
	document.getElementById('login_btn').setAttribute('onclick','Send_login_request()');
	document.getElementById('title_card').innerHTML = jsonData[108];
	document.getElementById('sous_title').style.width = '500px';
	document.getElementById('sous_title').style.marginLeft = '-310px';
	document.getElementById("img_input_one_login").src = "IMG/mail.png";
	document.getElementById("img_input_one_login").style.height = '34px';
	document.getElementById("img_input_one_login").style.marginLeft = '25px';
	input_img_one = "mail";
	document.getElementById('input_login_one').type='email';
	document.getElementById('input_login_one').placeholder = jsonData[113];
	document.getElementById("img_input_two_login").src = "IMG/lock.png";
	document.getElementById("img_input_two_login").style.height = '44px';
	document.getElementById("img_input_two_login").style.marginLeft = '30px';
	document.getElementById("img_input_two_login").style.marginRight = '-77px';
	input_img_two = "lock";
	document.getElementById('input_login_two').type='password';
	document.getElementById('input_login_two').placeholder = jsonData[116];
	document.getElementById('login_btn_span').innerHTML = 'OK';
	document.getElementById('div_subcribe_btn').style.width = '300px';
	document.getElementById('subcribe_btn').innerHTML = jsonData[111];
	document.getElementById('div_subcribe_btn').setAttribute('onclick', 'Rotate_card_step_one()');
  }
  if (info == 4) {
  	document.getElementById('error_one').style.display = "none";
	document.getElementById('input_login_one').removeAttribute('style');
	document.getElementById('error_two').style.display = "none";
	document.getElementById('input_login_two').removeAttribute('style');
	document.getElementById('html_corp').style.overflowY = 'scroll';
	document.getElementById('input_login_one').value = register_info['pseudo'];
	document.getElementById('input_login_two').value = register_info['mail'];
	document.getElementById('login_btn').setAttribute('onclick','Rotate_card_reverse_step_one()');
	document.getElementById('title_card').innerHTML = jsonData[111];
	document.getElementById('sous_title').style.width = '550px';
	document.getElementById('sous_title').style.marginLeft = '-220px';
	document.getElementById("img_input_one_login").src = "IMG/user.png";
	document.getElementById("img_input_one_login").style.height = '40px';
	document.getElementById("img_input_one_login").style.marginLeft = '28px';
	input_img_one = "user";
	document.getElementById('input_login_one').type='text';
	document.getElementById('input_login_one').placeholder = jsonData[112];
	document.getElementById("img_input_two_login").src = "IMG/mail.png";
	document.getElementById("img_input_two_login").style.height = '38px';
	document.getElementById("img_input_two_login").style.marginLeft = '19px';
	document.getElementById("img_input_two_login").style.marginRight = '-89px';
	input_img_two = "mail";
	document.getElementById('input_login_two').type='email';
	document.getElementById('input_login_two').placeholder = jsonData[113];
	document.getElementById('login_btn_span').innerHTML = jsonData[114];
	document.getElementById('div_subcribe_btn').style.width = '360px';
	document.getElementById('div_subcribe_btn').setAttribute('onclick', 'steptworegister(2)');
	document.getElementById('subcribe_btn').innerHTML = jsonData[115];
	document.getElementById('butt-dsc').style.display = "initial";
  }
  if (info == 5) {
  	document.getElementById('error_one').style.display = "none";
	document.getElementById('input_login_one').removeAttribute('style');
	document.getElementById('error_two').style.display = "none";
	document.getElementById('input_login_two').removeAttribute('style');
	document.getElementById('html_corp').style.overflowY = 'scroll';
	document.getElementById('title_card').innerHTML = jsonData[130];
	document.getElementById('input_login_one').style.display = 'none';
	document.getElementById('input_login_two').style.display = 'none';
	document.getElementById("img_input_one_login").style.display = 'none';
	document.getElementById("img_input_two_login").style.display = 'none';
	document.getElementById('select_who').style.display = 'none';
	document.getElementById('morning0').style.display = 'block';
	a = document.querySelectorAll('.cbx');
	a[0].style.display = 'inline-block';
	a[1].style.display = 'inline-block';
	document.getElementById('morning1').style.display = 'block';
	b = document.querySelectorAll('.inline-svg');
	b[0].style.display = 'block';
	b[1].style.display = 'block';
	document.getElementById('contentcheck0').style.display = 'block';
	document.getElementById('contentcheck1').style.display = 'block';
	document.getElementById('subcribe_btn').innerHTML = jsonData[124];
	document.getElementById('login_btn').setAttribute('onclick','stepthreeregister(2)');
	document.getElementById('div_subcribe_btn').setAttribute('onclick','Send_register_request()');
  }
  isSmallScreenONE = window.innerHeight <= 920;
  if (isSmallScreenONE) {
    topValue = (930 - window.innerHeight) * 0.5 + 'px';
    loginContent.style.top = topValue;
  } else {
    loginContent.style.top = '54%';
  }
  isSmallScreenTWO = window.innerWidth <= 800;
  if (isSmallScreenTWO) {
    widthValueONE = window.innerWidth + 'px';
    loginContent.style.width = widthValueONE;
    if (window.innerWidth > 444) {
    	widthValueTWO = (610 - (800 - window.innerWidth)) * 1.15 + 'px';
	    inputLoginONE.style.width = widthValueTWO;
	    inputLoginTWO.style.width = widthValueTWO;
	    select_who.style.width = widthValueTWO;
    }
  } else {
    loginContent.style.width = '792px';
    inputLoginONE.style.width = '610px';
    inputLoginTWO.style.width = '610px';
    select_who.style.width = '610px';
  }
  isSmallScreenTHREE = window.innerWidth <= 544 && window.innerWidth > 444;
  if (isSmallScreenTHREE) {
    if (mode == "login") {
    	subcribeDiv.style.width = "250px";
    	spanButton[0].style.fontSize = "24px";
    	spanButton[0].style.marginTop = "18px";
    	spanButton[1].style.fontSize = "24px";
    	spanButton[1].style.marginTop = "18px";
    	loginButton.style.width = "100px";
    }else if(mode == "register"){
    	subcribeDiv.style.width = "300px";
    	spanButton[0].style.fontSize = "22px";
    	spanButton[0].style.marginTop = "18px";
    	spanButton[1].style.fontSize = "22px";
    	spanButton[1].style.marginTop = "18px";
    	loginButton.style.width = "100px";
    }
  } else {
    if (mode == "login") {
    	subcribeDiv.style.width = "300px";
    	spanButton[0].style.fontSize = "26px";
    	spanButton[0].style.marginTop = "15px";
    	spanButton[1].style.fontSize = "26px";
    	spanButton[1].style.marginTop = "15px";
    	loginButton.style.width = "160px";
    }else if(mode == "register"){
    	subcribeDiv.style.width = "360px";
    	spanButton[0].style.fontSize = "26px";
    	spanButton[0].style.marginTop = "15px";
    	spanButton[1].style.fontSize = "26px";
    	spanButton[1].style.marginTop = "15px";
    	loginButton.style.width = "160px";
    }
  }
  isSmallScreenFOUR = window.innerWidth <= 800 && window.innerWidth > 544;
  isSmallScreenFIVE = window.innerWidth <= 544 && window.innerWidth > 444;
  if (isSmallScreenFOUR) {
    marginLeftValue = 800 - window.innerWidth - 314 + 'px';
    sousTitle.style.marginLeft = marginLeftValue;
  } else if(window.innerWidth > 800) {
  	if (info == 4) {sousTitle.style.marginLeft = '-200px';}
  	else if (info == 1) {sousTitle.style.marginLeft = '-450px';}
  	else if (info == 2) {sousTitle.style.marginLeft = '-450px';}
  	else if (info == 5) {sousTitle.style.marginLeft = '-450px';}
  	else{sousTitle.style.marginLeft = '-314px';}
  }else if (isSmallScreenFIVE){
  	marginLeftValue = 544 - window.innerWidth - 190 + 'px';
  	sousTitle.style.marginLeft = marginLeftValue;
  }else{
  	pass444tosup == 1;
  	marginLeftValue = (444 - window.innerWidth) * 0.45 - 90 + 'px';
  	sousTitle.style.marginLeft = marginLeftValue;
	sousTitle.style.width = '300px';
	sousTitle.style.marginTop = '-12px';
	imgInputLoginOne.style.marginRight = '-50px';
	imgInputLoginOne.style.marginLeft = '-30px';
	inputLoginONE.style.paddingLeft = '60px';
	inputLoginONE.style.marginTop = '20px';
	inputLogin[0].style.width = '250px';
	inputLogin[1].style.width = '250px';
	imgContainerOne.style.marginRight = '-40px';
	imgContainerTwo.style.marginRight = '-40px';
	imgInputLoginTwo.style.marginRight = '-38px';
	imgInputLoginTwo.style.marginLeft = '-30px';
	inputLoginTWO.style.paddingLeft = '60px';
	tooltipOne.style.top = '-95px';
	tooltipOne.style.width = '300px';
	tooltipOne.style.height = '90px';
	tooltipTwo.style.top = '-95px';
	tooltipTwo.style.width = '300px';
	tooltipTwo.style.height = '90px';
	connectDiv.style.borderRadius = '20px';
	subcribeDiv.style.borderRadius = '20px';
	buttdisc.style.fontSize = '22px';
	if (mode == "login") {
		subcribeDiv.style.width = '250px';
		spanButton[1].style.fontSize = "24px";
		spanButton[1].style.marginTop = "18px";
		titleLogin.style.fontSize = '48px';
		imgInputLoginTwo.style.marginRight = '-38px';
		imgInputLoginTwo.style.marginLeft = '-20px';
		imgInputLoginTwo.style.height = '44px';
		inputLoginTWO.style.paddingLeft = '60px';
	}else if (mode == "register") {
		subcribeDiv.style.width = '250px';
		spanButton[1].style.fontSize = "22px";
		spanButton[1].style.marginTop = "3px";
		titleLogin.style.fontSize = '36px';
		imgInputLoginTwo.style.height = '34px';
		imgInputLoginTwo.style.marginRight = '-55px';
		imgInputLoginTwo.style.marginLeft = '-34px';
		inputLoginTWO.style.paddingLeft = '70px';
	}
	if (info == 1) {
		imgInputLoginTwo.style.marginRight = '-50px';
		imgInputLoginTwo.style.marginLeft = '-30px';
		imgInputLoginTwo.style.height = '44px';
		inputLoginTWO.style.paddingLeft = '60px';
	}
	if (info == 2) {
		inputLoginONE.style.fontSize = '20px';
		select_who.style.width = '250px';
		select_who.style.paddingLeft = '70px';
		imgInputLoginTwo.style.marginRight = '-53px';
		imgInputLoginTwo.style.marginLeft = '-28px';
		imgInputLoginTwo.style.height = '44px';
	}else{
		inputLoginONE.style.fontSize = '24px';
	}
  }
}
// async function checkindb(num_check, data_check) {
// 	var httpRequest_check = getHttpRequest();
// 	httpRequest_check.onreadystatechange = function () {
//      	if (httpRequest_check.readyState === 4){
//           	console.log(httpRequest_check.responseText);
//           	return httpRequest_check.responseText;
//         }  
//     }
//   	httpRequest_check.open('POST', '../includes/checkconditionregister.php', true);
//   	httpRequest_check.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
// 	httpRequest_check.overrideMimeType("text/plain");
// 	if (num_check == 1) {
// 		username_check = await crypterEtEnvoyer(data_check[0]);
// 		mail_check = await crypterEtEnvoyer(data_check[1]);
// 		httpRequest_check.send("username=" + encodeURIComponent(JSON.stringify(username_check)) + "&mail=" + encodeURIComponent(JSON.stringify(mail_check)) + "&type=" + encodeURIComponent(1));
// 	}
// }
async function appliquerInstructions(elements, instruction) {
    if (typeof instruction === 'string') {
        // Appliquer la même instruction à tous les éléments
        for (let i = 0; i < elements.length; i++) {
            if (elements[i] != null) {
                document.getElementById(elements[i]).style.display = instruction;
            }
        }
    } else if (Array.isArray(instruction)) {
        // Appliquer une instruction spécifique à chaque élément
        for (let i = 0; i < elements.length; i++) {
            if (elements[i] != null && instruction[i] != null) {
                document.getElementById(elements[i]).style.display = instruction[i];
            }
        }
    }
}
async function checkindb(num_check, data_check) {
	return new Promise(async (resolve, reject) => {
		await appliquerInstructions(["img_input_one_login","input_login_one","img_input_two_login","input_login_two","space-login","br_2","br_3","br_4","br_5","error_one","error_two"], "none");
		document.getElementById('annimation_loader_front').style.display = "block";
	  var httpRequest_check = getHttpRequest();
	  httpRequest_check.onreadystatechange = async function () {
		if (httpRequest_check.readyState === 4){
		  if (httpRequest_check.status === 200) {
			console.log(httpRequest_check.responseText);
			resolve(JSON.parse(httpRequest_check.responseText));
			await appliquerInstructions(["annimation_loader_front","img_input_one_login","input_login_one","img_input_two_login","input_login_two","space-login","br_2","br_3","br_4","br_5"], ["none","inline","inline-block","inline","inline-block","block","inline","inline","inline","inline"]);
		  } else {
			reject(new Error('Erreur de requête : ' + httpRequest_check.statusText));
		  }
		}
	  };
	  httpRequest_check.open('POST', '../includes/checkconditionregister.php', true);
	  httpRequest_check.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	  httpRequest_check.overrideMimeType("text/plain");
	  if (num_check == 1) {
		crypterEtEnvoyer(data_check[0]).then((username_check) => {
		  crypterEtEnvoyer(data_check[1]).then((mail_check) => {
			httpRequest_check.send("username=" + encodeURIComponent(JSON.stringify(username_check)) + "&mail=" + encodeURIComponent(JSON.stringify(mail_check)) + "&type=" + encodeURIComponent(1));
		  });
		});
	  }
	});
  }
window.addEventListener('resize', updateLoginContentPosition);
window.onload = function() {
	updateLoginContentPosition();
	document.getElementById('annimation_loader').style.display = 'none';
	document.getElementById('content_all').removeAttribute('style');
// 	document.getElementById('content_all').style.marginTop = '60px';
// 	navBar = document.querySelector('.nav_bar');
// 	navBar.removeAttribute('style');
// 	navBar.style.position = 'fixed';
  // navBar.style.zIndex = 10000;
// 	$('document').ready(function () {
// 		trigger = $('.hamburger-nav');
// 		isClosednav = false;
// 		trigger.click(function () {
// 		  burgerTimenav();
// 		  start_menu_nav();
// 		  if (clickburg == 0) {
// 		  	document.documentElement.style.overflow = "hidden";clickburg = 1;
// 		  }else{
// 		  	document.documentElement.style.overflow = "auto";clickburg = 0;
// 		  }
// 		})
// 	})
// 	window.addEventListener('resize', function() {
// 		ham_linav();
// 	});
// 	ham_linav();
};
