// ####################################CHANGE_VARIABLE####################################
var prename_var = 0;
var name_var = 0;
var pseudo_var = 0;
var phone_var = 0;
var localisation_var = 0;
var school_var = 0;
var work_var = 0;
var valor_var = 0;
var pp_var = 0;
var ban_var = 0;
var desc_var = 0;
var security = 0;
var pseudo_security = false;
var valor_security = false;
var major_set_open = 0;
var checkbox1,checkbox2,checkbox3,checkbox4,checkbox5,checkbox6,checkbox7,checkbox8,checkbox9,checkbox10,checkbox11,checkbox12,checkbox13,checkbox14,checkbox15, scr_save_pp, scr_save_ban, contentparms, isClosed;
var requestOptions = {method: 'GET',};
var cropper_pp = null;
var cropper_ban = null;
var windowSize = window.innerWidth;
var mode_crop = 3;
// ####################################
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
function searchlocalisation() {
	text = document.getElementById('input_loc').value;
	if (text != "") {
		fetch("https://api.geoapify.com/v1/geocode/autocomplete?text="+text+"&apiKey=cd69e038e1bf4032a901e4378fb13e9e", requestOptions)
	  	.then(response => response.json())
	  	.then(data => {
	    	const formattedElements = data.features.map(feature => feature.properties.formatted);
	    	divElement = document.querySelector(".prop_lie_content");
			divElement.innerHTML = "";
			num = 0;
	    	formattedElements.forEach(formatted => {
	    		num = 1;
	    		spanElement = document.createElement("span");
				spanElement.className = "prop_lie";
				spanElement.textContent = formatted;
				spanElement.setAttribute("onclick", "attributeLocalisation(this);");
				brElement = document.createElement("br");
				divElement.appendChild(spanElement);
				divElement.appendChild(brElement);
	    	});
	    	if (num == 1) {
	    		document.querySelector(".prop_lie_content").style.display = 'block';
	    	}
	    	else{
	    		document.querySelector(".prop_lie_content").style.display = 'none';
	    	}
	  	})
	  	.catch(error => console.log('error', error));
	}
	else{
		document.querySelector(".prop_lie_content").style.display = 'none';
	}
}
function attributeLocalisation(element){
	texte = element.textContent;
	document.getElementById('input_loc').value = texte;
	document.querySelector(".prop_lie_content").style.display = 'none';
	document.getElementById('input_check-3').style.display = 'inline';
}
function attributeLocalisation_val(element){
	texte = element.textContent;
	document.getElementById('valor_search').value = texte;
	document.querySelector(".prop_val_content").style.display = 'none';
	document.getElementById('input_check-8').src = 'IMG/check.png';
	document.getElementById('input_check-8').className = 'check_input';
	valor_security = true;
}
function verifierTexte(texte) {
  if (texte.indexOf(' ') !== -1) {
    return false;
  }
  const caracteresInterdits = "'\"#~&([}=+-*/^`])°\\²@$£:¤%¨!§;?,";
  for (let i = 0; i < caracteresInterdits.length; i++) {
    if (texte.indexOf(caracteresInterdits[i]) !== -1) {
      return false;
    }
  }
  return true;
}
document.addEventListener("keydown", function(event) {
  if (event.key === "Enter") {
  	reserchDisponibilty('pseudo');
  }
});
function administrating_carac(){
  a = document.querySelector(".emojionearea-editor");
  c = a.innerHTML;
  d = c.replace('<div></div>', '');
  d2 = d.replace('<br>', '');
  d3 = d2.replace(/<img[^>]*>/g, "1");
  e = d3.length;
  console.log(e);
  if (e == 119) {
    elems = a;
    elems.setAttribute("contenteditable", "false");
    // SURPPRIMER LE DERNIER CARACTERE AUY LIEU DE BLOQUER LA SAISIE & SMILEY TEST OK
  }
  else{
    elems = a;
    elems.setAttribute("contenteditable", "true");
  }
}
function saveSetting(){
	var formData = new FormData();
	send_save = 0;
	formData.append('id', id_user_live);
	if (prename_var==1) {formData.append('prename', document.querySelector('input[name="prename"]').value);send_save=1;}
	if (pseudo_var==1 && pseudo_security==true) {formData.append('pseudo', document.querySelector('input[name="pseudo"]').value);send_save=1;}
	if (localisation_var==1) {formData.append('localisation', document.querySelector('input[name="localisation"]').value);send_save=1;}
	if (work_var==1) {formData.append('work', document.querySelector('input[name="work"]').value);send_save=1;}
	if (name_var==1) {formData.append('name', document.querySelector('input[name="name"]').value);send_save=1;}
	if (phone_var==1) {formData.append('phone', document.querySelector('input[name="phone"]').value);send_save=1;}
	if (school_var==1) {formData.append('school', document.querySelector('input[name="school"]').value);send_save=1;}
	if (valor_var==1 && valor_security==true) {formData.append('valor', document.querySelector('input[name="valor"]').value);send_save=1;}
	if (desc_var==1) {formData.append('desc', document.getElementById('textareacommentelement').value);send_save=1;}
	if (pp_var==1) {
		base64Image_pp = document.querySelector('.img_pp_input').src;
		base64Data_pp = base64Image_pp.split(',')[1];
		blobImage_pp = base64ToBlob(base64Data_pp, 'image/png');
		formData.append('pp', blobImage_pp);
		send_save=1;
	}
	if (ban_var==1) {
		base64Image_ban = document.querySelector('.img_ban_input').src;
		base64Data_ban = base64Image_ban.split(',')[1];
		blobImage_ban = base64ToBlob(base64Data_ban, 'image/png');
		formData.append('ban', blobImage_ban);
		send_save=1;
	}
	if (security==1) {formData.append('sec', prepare_data_sec());send_save=1;}
	if (send_save==1) {
		fetch('includes/save_setting.php', {
	        method: "POST", 
	        body: formData
	    })
	    .then(response => response.text())
	    .then(data => {
		    ajaxresponse = data;
		})
	    .then(() => {
    		prename_var = 0;
			name_var = 0;
			pseudo_var = 0;
			phone_var = 0;
			localisation_var = 0;
			school_var = 0;
			work_var = 0;
			valor_var = 0;
			pp_var = 0;
			ban_var = 0;
			desc_var = 0;
			security = 0;
			pseudo_security = false;
	    })
	    .catch(error => {
	        console.error('Error:', error);
	    })
	}
}
function checkEmail(email) {
 var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
 return re.test(email);
}
function validate_mail() {
 var email = document.getElementById("email_change").value;

 if (checkEmail(email)) {
	document.getElementById('input_check-9').src = 'IMG/check.png';
	document.getElementById('input_check-9').className = 'check_input';
	return true;
 } else {
	document.getElementById('input_check-9').src = 'IMG/delete.png';
	document.getElementById('input_check-9').className = 'check_input';
	return false;
 }
}
function validate_mdp() {
    str = document.getElementById("password_change").value;
    isValid = true;
    errorMsg = "Le mot de passe doit contenir au moins ";
    num_error = 0;
    if (!str.match(/[0-9]/g)) {
        errorMsg += "1 chiffre";
        isValid = false;
        num_error++;
    }

    if (!str.match(/[A-Z]/g)) {
        if (num_error >= 1) {
        	errorMsg += ", ";
        }
        errorMsg += "1 caractère majuscule";
        isValid = false;
        num_error++;
    }

    if (!str.match(/[a-z]/g)) {
    	if (num_error >= 1) {
        	errorMsg += ", ";
        }
        errorMsg += "1 caractère minuscule";
        isValid = false;
        num_error++;
    }

    if (!str.match(/[^a-zA-Z\d]/g)) {
        if (num_error >= 1) {
        	errorMsg += ", ";
        }
        errorMsg += "1 caractère spécial";
        isValid = false;
        num_error++;
    }

    if (str.length < 10) {
        if (num_error >= 1) {
        	errorMsg += " et ";
        }
        errorMsg += "10 caractères";
        isValid = false;
        num_error++;
    }
    errorMsg += "."
    checkInput = document.getElementById('input_check-11');
    if (isValid) {
        checkInput.src = 'IMG/check.png';
        checkInput.className = 'check_input';
        checkInput.title = "";
        return true;
    } else {
        checkInput.src = 'IMG/delete.png';
        checkInput.className = 'check_input';
        checkInput.title = errorMsg;
        return false;
    }
}
function similar(text){
	if (text == 'mail') {
		if (document.getElementById('email_change').value == document.getElementById('email_rep').value) {
			document.getElementById('input_check-10').src = 'IMG/check.png';
			document.getElementById('input_check-10').className = 'check_input';
			return true;
		}
		else{
			document.getElementById('input_check-10').src = 'IMG/delete.png';
			document.getElementById('input_check-10').className = 'check_input';
			return false;
		}
	}
	if (text == 'mdp') {
		if (document.getElementById('password_change').value == document.getElementById('password_rep').value) {
			document.getElementById('input_check-12').src = 'IMG/check.png';
			document.getElementById('input_check-12').className = 'check_input';
			return true;
		}
		else{
			document.getElementById('input_check-12').src = 'IMG/delete.png';
			document.getElementById('input_check-12').className = 'check_input';
			return false;
		}
	}
}
function validate_setting_general(){
	error = 0;
	if (major_set_open == 1) {
		if (!validate_mail()) {error++;}
		if (!validate_mdp()) {error++;}
		if (!similar('mail')) {error++;}
		if (!similar('mdp')) {error++;}
	}
	if (!valor_security) {error++;}
	if (!pseudo_security) {error++;}
}
function masquerAutresCheckboxes(checkbox, num) {
  if (num == 1) {
  	if (checkbox !== checkbox1[0]) {
  	  checkbox1[0].style.display = 'none';
  	  checkbox1[1].style.display = 'none';
  	}
  	if (checkbox !== checkbox2[0]) {
  	  checkbox2[0].style.display = 'none';
  	  checkbox2[1].style.display = 'none';
 	}
 	if (checkbox !== checkbox3[0]) {
  	  checkbox3[0].style.display = 'none';
  	  checkbox3[1].style.display = 'none';
 	}
  }
  if (num == 2) {
  	if (checkbox !== checkbox4[0]) {
  	  checkbox4[0].style.display = 'none';
  	  checkbox4[1].style.display = 'none';
  	}
  	if (checkbox !== checkbox5[0]) {
  	  checkbox5[0].style.display = 'none';
  	  checkbox5[1].style.display = 'none';
 	}
 	if (checkbox !== checkbox6[0]) {
  	  checkbox6[0].style.display = 'none';
  	  checkbox6[1].style.display = 'none';
 	}
  }
  if (num == 3) {
  	if (checkbox !== checkbox7[0]) {
  	  checkbox7[0].style.display = 'none';
  	  checkbox7[1].style.display = 'none';
  	}
  	if (checkbox !== checkbox8[0]) {
  	  checkbox8[0].style.display = 'none';
  	  checkbox8[1].style.display = 'none';
 	}
 	if (checkbox !== checkbox9[0]) {
  	  checkbox9[0].style.display = 'none';
  	  checkbox9[1].style.display = 'none';
 	}
  }
  if (num == 4) {
  	if (checkbox !== checkbox10[0]) {
  	  checkbox10[0].style.display = 'none';
  	  checkbox10[1].style.display = 'none';
  	}
  	if (checkbox !== checkbox11[0]) {
  	  checkbox11[0].style.display = 'none';
  	  checkbox11[1].style.display = 'none';
 	}
 	if (checkbox !== checkbox12[0]) {
  	  checkbox12[0].style.display = 'none';
  	  checkbox12[1].style.display = 'none';
 	}
  }
  if (num == 5) {
  	if (checkbox !== checkbox13[0]) {
  	  checkbox13[0].style.display = 'none';
  	  checkbox13[1].style.display = 'none';
  	}
  	if (checkbox !== checkbox14[0]) {
  	  checkbox14[0].style.display = 'none';
  	  checkbox14[1].style.display = 'none';
 	}
 	if (checkbox !== checkbox15[0]) {
  	  checkbox15[0].style.display = 'none';
  	  checkbox15[1].style.display = 'none';
 	}
  }
}
function afficherToutesCheckboxes(num) {
	if (num == 1) {
		checkbox1[0].style.display = 'inline-block';
  		checkbox2[0].style.display = 'inline-block';
 		checkbox3[0].style.display = 'inline-block';
  		checkbox1[1].style.display = 'inline-block';
  		checkbox2[1].style.display = 'inline-block';
  		checkbox3[1].style.display = 'inline-block';
	}
	if (num == 2) {
		checkbox4[0].style.display = 'inline-block';
  		checkbox5[0].style.display = 'inline-block';
 		checkbox6[0].style.display = 'inline-block';
  		checkbox4[1].style.display = 'inline-block';
  		checkbox5[1].style.display = 'inline-block';
  		checkbox6[1].style.display = 'inline-block';
	}
	if (num == 3) {
		checkbox7[0].style.display = 'inline-block';
  		checkbox8[0].style.display = 'inline-block';
 		checkbox9[0].style.display = 'inline-block';
  		checkbox7[1].style.display = 'inline-block';
  		checkbox8[1].style.display = 'inline-block';
  		checkbox9[1].style.display = 'inline-block';
	}
	if (num == 4) {
		checkbox10[0].style.display = 'inline-block';
  		checkbox11[0].style.display = 'inline-block';
 		checkbox12[0].style.display = 'inline-block';
  		checkbox10[1].style.display = 'inline-block';
  		checkbox11[1].style.display = 'inline-block';
  		checkbox12[1].style.display = 'inline-block';
	}
	if (num == 5) {
		checkbox13[0].style.display = 'inline-block';
  		checkbox14[0].style.display = 'inline-block';
 		checkbox15[0].style.display = 'inline-block';
  		checkbox13[1].style.display = 'inline-block';
  		checkbox14[1].style.display = 'inline-block';
  		checkbox15[1].style.display = 'inline-block';
	}
}
function processImage(num){
	if (num == 0) {
		cropper_pp = new Cropper(myGreatImage_pp, {
			aspectRatio: 1,
			dragMode: "move"
		});
		mode_crop = 0;
		document.querySelector('.content_ban_fig').style.display = 'none';
		document.querySelector('.content_pp_fig').style.display = 'block';
		document.getElementById('panel-crop-demand').style.display = 'block';
		setTimeout(() => resize_pp_crop(1), 10);
	}
	else if (num == 1) {
		cropper_ban = new Cropper(myGreatImage_ban, {
			aspectRatio: 1920 / 200,
			dragMode: "move"
		});
		mode_crop = 1;
		document.querySelector('.content_pp_fig').style.display = 'none';
		document.querySelector('.content_ban_fig').style.display = 'block';
		document.getElementById('panel-crop-demand').style.display = 'block';
		setTimeout(() => resize_pp_crop(2), 10);
	}
}
function cropImage(num){
	if (num == 0) {
		if (cropper_pp !== null) {
			imgUrl = cropper_pp.getCroppedCanvas().toDataURL();
			img_c = document.querySelector('.img_pp_input');
			img_c.src = imgUrl;
			document.getElementById('panel-crop-demand').style.display = 'none';
			contentCrop = document.querySelector('.content_figure_pp');
			contentCrop.innerHTML = '';
			imgCrop = document.createElement("img");
			imgCrop.id = "myGreatImage_pp";
			imgCrop.className = "img_crop";
			imgCrop.src = scr_save_pp;
			contentCrop.appendChild(imgCrop);
		}
	}
	else if(num == 1){
		if (cropper_ban !== null) {
			imgUrl = cropper_ban.getCroppedCanvas().toDataURL();
			img_c = document.querySelector('.img_ban_input');
			img_c.src = imgUrl;
			document.getElementById('panel-crop-demand').style.display = 'none';
			contentCrop = document.querySelector('.content_figure_ban');
			contentCrop.innerHTML = '';
			imgCrop = document.createElement("img");
			imgCrop.id = "myGreatImage_ban";
			imgCrop.className = "img_crop";
			imgCrop.src = scr_save_ban;
			contentCrop.appendChild(imgCrop);
		}
	}
	mode_crop = 3;
}
function hide_crop_demand_reverse(){
	document.getElementById('panel-crop-demand').style.display = 'none';
}
function base64ToBlob(base64, type) {
  const byteCharacters = atob(base64);
  const byteArrays = [];

  for (let offset = 0; offset < byteCharacters.length; offset += 1024) {
    const slice = byteCharacters.slice(offset, offset + 1024);

    const byteNumbers = new Array(slice.length);
    for (let i = 0; i < slice.length; i++) {
      byteNumbers[i] = slice.charCodeAt(i);
    }

    const byteArray = new Uint8Array(byteNumbers);
    byteArrays.push(byteArray);
  }

  return new Blob(byteArrays, { type });
}
function prepare_data_sec(){
	input_sec = document.querySelectorAll('input.toggle');
	resultat_sec = [];
	input_sec.forEach(function(input) {
	  if (input.checked) {
	    classe = input.className;
	    numeroQuestion = parseInt(classe.split('_')[2]);
	    numeroOption = parseInt(classe.split('_')[3]);
	    resultat_sec[numeroQuestion] = numeroOption;
	  }
	});
	return JSON.stringify(resultat_sec);
}
function unban(ban, box){
	var httpRequest = getHttpRequest();
	httpRequest.onreadystatechange = function () {
		if (httpRequest.readyState === 4){
		  	document.getElementById(box).remove();
		}  
	}
	httpRequest.open('POST', 'includes/unban.php', true)
	httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
	httpRequest.overrideMimeType("text/plain")
	httpRequest.send("id=" + encodeURIComponent(id_user_live) + "&ban=" + encodeURIComponent(ban))
}
function up(id){
	if (id == 0) {contentparms.scrollTop = 0;}
	if (id == 1) {contentparms.scrollTop = document.getElementById('general').scrollHeight;}
	if (id == 2) {contentparms.scrollTop = document.getElementById('general').scrollHeight + document.getElementById('private').scrollHeight;}
	if (id == 3) {contentparms.scrollTop = document.getElementById('general').scrollHeight + document.getElementById('private').scrollHeight + document.getElementById('block').scrollHeight;}
	if (id == 4) {contentparms.scrollTop = document.getElementById('general').scrollHeight + document.getElementById('private').scrollHeight + document.getElementById('block').scrollHeight + document.getElementById('language').scrollHeight;}
	if (id == 5) {contentparms.scrollTop = document.getElementById('general').scrollHeight + document.getElementById('private').scrollHeight + document.getElementById('block').scrollHeight + document.getElementById('language').scrollHeight + document.getElementById('engagements').scrollHeight;}
	if (id == 6) {contentparms.scrollTop = document.getElementById('general').scrollHeight + document.getElementById('private').scrollHeight + document.getElementById('block').scrollHeight + document.getElementById('language').scrollHeight + document.getElementById('engagements').scrollHeight + document.getElementById('CGU').scrollHeight + document.getElementById('CGV').scrollHeight;}
}
function setBoxWidth() {
    windowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    boxElement = document.querySelector(".box2");
    boxWidth = windowWidth - 384;
      boxElement.style.width = boxWidth + "px";
}
function setEmojioneareaWidth() {
    windowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    emojioneareaElements = document.querySelectorAll(".emojionearea");
    if (windowWidth <= 1600 && windowWidth > 450) {
      for (i = 0; i < emojioneareaElements.length; i++) {
        emojioneareaElements[i].style.width = "400px";
        emojioneareaElements[i].style.margin = "15px auto 0px";
      }
    } else if (windowWidth <= 450) {
      for (i = 0; i < emojioneareaElements.length; i++) {
        emojioneareaElements[i].style.width = "250px";
        emojioneareaElements[i].style.margin = "15px 0 0 20px";
      }
    } else {
      for (i = 0; i < emojioneareaElements.length; i++) {
        emojioneareaElements[i].style.width = "700px";
        emojioneareaElements[i].style.margin = "15px auto 0px";
      }
    }
 }
function burgerTime() {
	 if (isClosed == true) {
	    trigger.removeClass('is-open');
	    trigger.addClass('is-closed');
	    isClosed = false;
	 } else {
	    trigger.removeClass('is-closed');
	    trigger.addClass('is-open');
	    isClosed = true;
	}
}
function start_menu(){
	elem_selt = document.querySelector('.box1');
	if (isClosed) {
		elem_selt.style.paddingLeft = "100px";
		elem_selt.style.width = "100%";
		elem_selt.style.display = "block";	
	}else{
		elem_selt.removeAttribute('style');	
	}
}
function ham_li(){
	if (window.innerWidth <= 1000){
		isClosed = false;
    	trigger_burg = document.querySelector('.hamburger-settings');
    	trigger_burg.className = 'hamburglar is-closed pasblock hamburger-settings';
		start_menu();
	}
}
function resize_pp_crop(num) {
	if (windowSize <= 1400) {
	  	t = window.innerHeight - 107;
	  	document.querySelector(".cropper-container").style.height = t + "px";
	  	document.querySelector(".cropper-drag-box").style.height = t + "px";
	  	document.querySelector(".cropper-wrap-box").style.height = t + "px";
	  	document.querySelector(".content_figure_pp").style.height = t + "px";
	  	document.querySelector(".content_figure_ban").style.height = t + "px";
	}else{
		document.querySelector(".content_figure_pp").removeAttribute("style");
		document.querySelector(".content_figure_ban").removeAttribute("style");
	}
	if (num == 1) {
		cropper_pp.canvasData.maxHeight = Infinity;
		cropper_pp.canvasData.maxLeft = 650;
		cropper_pp.canvasData.maxTop = 650;
		cropper_pp.canvasData.maxWidth = Infinity;
		cropper_pp.canvasData.minLeft = -300;
		cropper_pp.canvasData.minTop = -300;
	}
	if (num == 2) {
		cropper_ban.canvasData.maxHeight = Infinity;
		cropper_ban.canvasData.maxLeft = 650;
		cropper_ban.canvasData.maxTop = 650;
		cropper_ban.canvasData.maxWidth = Infinity;
		cropper_ban.canvasData.minLeft = -300;
		cropper_ban.canvasData.minTop = -300;
	}
}
window.onload = function() {
	elements = document.querySelectorAll('.emojionearea .emojionearea-editor');
	elements.forEach(function(element) {
	  element.style.height = '170px';
	  element.style.wordBreak = 'break-word';
	});
	containers = document.querySelectorAll('.emojionearea, .emojionearea.form-control');
	containers.forEach(function(container) {
	  container.style.margin = '15px auto 0 auto';
	  container.style.width = '700px';
	  container.style.border = 'none';
	  container.style.borderRadius = '12px';
	  container.style.boxShadow = '5px 2px 8px #b5b5b5b5';
	  container.style.textAlign = 'initial';
	  container.style.padding = '10px';
	});
	document.getElementById('btnUploadpp').addEventListener('click', function() {
	    document.getElementById('inputPP').click();
	});
	document.getElementById('btnUploadban').addEventListener('click', function() {
	    document.getElementById('inputBAN').click();
	});
	inputElement_one = document.getElementById("inputPP");
	imgElement_one = document.querySelector(".img_pp_input");
	contentCrop_pp = document.querySelector('.content_figure_pp');
	inputElement_one.addEventListener("change", (event) => {
	file_one = event.target.files[0];
	if (file_one) {
		pp_var=1;
			reader_one = new FileReader();
			reader_one.onload = (e) => {
			imgElement_one.src = e.target.result;
			contentCrop_pp.innerHTML = '';
			imgCrop = document.createElement("img");
			imgCrop.id = "myGreatImage_pp";
			imgCrop.className = "img_crop";
			imgCrop.src = e.target.result;
			contentCrop_pp.appendChild(imgCrop);
			scr_save_pp = e.target.result;
			};
			reader_one.readAsDataURL(file_one);
	}
	});
	inputElement_two = document.getElementById("inputBAN");
	imgElement_two = document.querySelector(".img_ban_input");
	contentCrop_ban = document.querySelector('.content_figure_ban');
	inputElement_two.addEventListener("change", (event) => {
	file_two = event.target.files[0];
	if (file_two) {
		ban_var=1;
			reader_two = new FileReader();
			reader_two.onload = (e) => {
			imgElement_two.src = e.target.result;
			contentCrop_ban.innerHTML = '';
			imgCrop = document.createElement("img");
			imgCrop.id = "myGreatImage_ban";
			imgCrop.className = "img_crop";
			imgCrop.src = e.target.result;
			contentCrop_ban.appendChild(imgCrop);
			scr_save_ban = e.target.result;
			};
			reader_two.readAsDataURL(file_two);
	}
	});
	document.querySelector(".emojionearea-editor").setAttribute('onkeydown', 'administrating_carac();desc_var=1;');
	$('#valor_search').keyup(function(event){
		if(event.key === "Enter"){
			var search = $(this).val();
			if(search !== ''){
				load_data(search);
			}
			else{
				load_data();
			}
		}
		document.getElementById('input_check-8').src = 'IMG/loading.png';
		document.getElementById('input_check-8').className = 'check_input rotate-image';
		valor_var = 1;
	});
	checkbox1 = document.querySelectorAll('.reg_priv_0_1');
	checkbox2 = document.querySelectorAll('.reg_priv_0_2');
	checkbox3 = document.querySelectorAll('.reg_priv_0_3');
	checkbox4 = document.querySelectorAll('.reg_priv_1_1');
	checkbox5 = document.querySelectorAll('.reg_priv_1_2');
	checkbox6 = document.querySelectorAll('.reg_priv_1_3');
	checkbox7 = document.querySelectorAll('.reg_priv_2_1');
	checkbox8 = document.querySelectorAll('.reg_priv_2_2');
	checkbox9 = document.querySelectorAll('.reg_priv_2_3');
	checkbox10 = document.querySelectorAll('.reg_priv_3_1');
	checkbox11 = document.querySelectorAll('.reg_priv_3_2');
	checkbox12 = document.querySelectorAll('.reg_priv_3_3');
	checkbox13 = document.querySelectorAll('.reg_priv_4_1');
	checkbox14 = document.querySelectorAll('.reg_priv_4_2');
	checkbox15 = document.querySelectorAll('.reg_priv_4_3');
	checkbox1[0].addEventListener('click', function() {
	  if (checkbox1[0].checked) {
	    masquerAutresCheckboxes(checkbox1[0],1);
	  } else {
	    afficherToutesCheckboxes(1);
	  }
	});
	checkbox2[0].addEventListener('click', function() {
	  if (checkbox2[0].checked) {
	    masquerAutresCheckboxes(checkbox2[0],1);
	  } else {
	    afficherToutesCheckboxes(1);
	  }
	});
	checkbox3[0].addEventListener('click', function() {
	  if (checkbox3[0].checked) {
	    masquerAutresCheckboxes(checkbox3[0],1);
	  } else {
	    afficherToutesCheckboxes(1);
	  }
	});
	checkbox4[0].addEventListener('click', function() {
	  if (checkbox4[0].checked) {
	    masquerAutresCheckboxes(checkbox4[0],2);
	  } else {
	    afficherToutesCheckboxes(2);
	  }
	});
	checkbox5[0].addEventListener('click', function() {
	  if (checkbox5[0].checked) {
	    masquerAutresCheckboxes(checkbox5[0],2);
	  } else {
	    afficherToutesCheckboxes(2);
	  }
	});
	checkbox6[0].addEventListener('click', function() {
	  if (checkbox6[0].checked) {
	    masquerAutresCheckboxes(checkbox6[0],2);
	  } else {
	    afficherToutesCheckboxes(2);
	  }
	});
	checkbox7[0].addEventListener('click', function() {
	  if (checkbox7[0].checked) {
	    masquerAutresCheckboxes(checkbox7[0],3);
	  } else {
	    afficherToutesCheckboxes(3);
	  }
	});
	checkbox8[0].addEventListener('click', function() {
	  if (checkbox8[0].checked) {
	    masquerAutresCheckboxes(checkbox8[0],3);
	  } else {
	    afficherToutesCheckboxes(3);
	  }
	});
	checkbox9[0].addEventListener('click', function() {
	  if (checkbox9[0].checked) {
	    masquerAutresCheckboxes(checkbox9[0],3);
	  } else {
	    afficherToutesCheckboxes(3);
	  }
	});
	checkbox10[0].addEventListener('click', function() {
	  if (checkbox10[0].checked) {
	    masquerAutresCheckboxes(checkbox10[0],4);
	  } else {
	    afficherToutesCheckboxes(4);
	  }
	});
	checkbox11[0].addEventListener('click', function() {
	  if (checkbox11[0].checked) {
	    masquerAutresCheckboxes(checkbox11[0],4);
	  } else {
	    afficherToutesCheckboxes(4);
	  }
	});
	checkbox12[0].addEventListener('click', function() {
	  if (checkbox12[0].checked) {
	    masquerAutresCheckboxes(checkbox12[0],4);
	  } else {
	    afficherToutesCheckboxes(4);
	  }
	});
	checkbox13[0].addEventListener('click', function() {
	  if (checkbox13[0].checked) {
	    masquerAutresCheckboxes(checkbox13[0],5);
	  } else {
	    afficherToutesCheckboxes(5);
	  }
	});
	checkbox14[0].addEventListener('click', function() {
	  if (checkbox14[0].checked) {
	    masquerAutresCheckboxes(checkbox14[0],5);
	  } else {
	    afficherToutesCheckboxes(5);
	  }
	});
	checkbox15[0].addEventListener('click', function() {
	  if (checkbox15[0].checked) {
	    masquerAutresCheckboxes(checkbox15[0],5);
	  } else {
	    afficherToutesCheckboxes(5);
	  }
	});
	const cropButton_pp = document.getElementById('cropButton_pp');
	const myGreatImage_pp = document.getElementById('myGreatImage_pp');
	const cropButton_ban = document.getElementById('cropButton_ban');
	const myGreatImage_ban = document.getElementById('myGreatImage_ban');
	contentparms = document.getElementById("body");
	elements = document.getElementsByClassName('box_cat_info_set');
  	elements = document.getElementsByClassName('box_cat_info_set');
	Array.from(elements).forEach(function(element, index) {
	  element.onclick = function() {
	    Array.from(elements).forEach(function(el) {
	      el.style.color = '#000';
	      el.style.backgroundColor = '#fff';
	    });
	    this.style.color = '#fff';
	    this.style.backgroundColor = '#007cff';
	    up(index);
	    ham_li();
	  };
	});
	document.getElementById('downloadBtn').onclick = function() {
	  fetch('http://localhost/language/fr.json')
	    .then(response => response.blob())
	    .then(blob => {
	      // Création du lien de téléchargement
	      const downloadLink = document.createElement('a');
	      downloadLink.href = URL.createObjectURL(blob);
	      downloadLink.download = 'fr.json';
	      downloadLink.click();
	      URL.revokeObjectURL(downloadLink.href);
	    });
	};
 	setBoxWidth();
	window.addEventListener("resize", setBoxWidth, setEmojioneareaWidth);
	setEmojioneareaWidth();
	window.addEventListener("resize", setEmojioneareaWidth, setEmojioneareaWidth);
	$('document').ready(function () {
		trigger = $('.hamburger-settings');
		isClosed = false;
		trigger.click(function () {
		  burgerTime();
		  start_menu();
		})
	})
	window.addEventListener('resize', function() {
	  windowSize = window.innerWidth;
	  spanElements = document.querySelectorAll('#span-priv');
	  if (spanElements) {
	    for (var i = 0; i < spanElements.length; i++) {
	      spanElement = spanElements[i];
	      newWidth = windowSize - 30;
	      spanElement.style.width = newWidth + 'px';
	    }
	  }
	});
	window.addEventListener('resize', function() {
	  windowSize = window.innerWidth;
	  spanElement = document.getElementById('span-desc');
	  if (spanElement && windowSize <= 400) {
	    newWidth = 400 - windowSize;
	    spanElement.style.marginLeft = newWidth - 160 + 'px';
	  }else{
	  	spanElement.removeAttribute('style');
	  }
	  lf = (window.innerWidth / 2) - 100;
	  document.getElementById('cropButton_pp').style.left = lf + "px";
	  document.getElementById('cropButton_ban').style.left = lf + "px";
	  if (mode_crop !== 3) {resize_pp_crop(0);}
	});
  	spanElements = document.querySelectorAll('#span-priv');
  	if (spanElements) {
    	for (var i = 0; i < spanElements.length; i++) {
      		spanElement = spanElements[i];
      		newWidth = windowSize - 30;
      		spanElement.style.width = newWidth + 'px';
    	}
  	}
  	spanElement = document.getElementById('span-desc');
	if (spanElement && windowSize <= 400) {
	    newWidth = 400 - windowSize;
	    spanElement.style.marginLeft = newWidth - 160 + 'px';
	}else{
		spanElement.removeAttribute('style');
	}
	$('document').ready(function () {
		trigger = $('.hamburger-nav');
		isClosednav = false;
		trigger.click(function () {
		  burgerTimenav();
		  start_menu_nav();
		})
	})
	window.addEventListener('resize', function() {
		ham_linav();
	});
	ham_linav();
	document.getElementById('annimation_loader').style.display = 'none';
	document.getElementById('content_all').removeAttribute('style');
};