var wevent = 1;
var stock_import_img, base64_img_import, img_state, input_file, base64_img_import, img_red, tab_to_crea_conv, natofconv, conv_active_id, role_conv_active, stateofmenu, isClosed, trigger, media_butt, fromDivs, toDivs, fromImgs, toImgs, state_pastll, charge_all;
var conv_add = -1;
var start = stateofmenu= 0;
const div1 = document.getElementById("send-content");
const div2 = document.getElementById("content-msg");
function page_msg_enter_adapt(){
	h = document.documentElement.scrollHeight;
	culculs = h+135 - (div1.clientHeight - 50);
  	if(culculs <= 770 && state_delete == 0){
  		div2.style.maxHeight = culculs + 'px';
  	}
  	if (img_state == 1) {
	  	culculs_u = document.getElementById('send-content').clientHeight;
	    culculs_u -= 308;
	    if (screenWidth < 590 || culculs_u < 100) {
	    	document.getElementById('img_import').style.maxHeight = '100px';
	    	document.getElementById('img_import').style.maxWidth = '100px';
	    }
	   	else{
	   		document.getElementById('img_import').style.maxHeight = culculs_u + 'px';
	   		document.getElementById('img_import').style.maxWidth = culculs_u + 'px';
	   	}
	}
}
const observer = new MutationObserver(() => {
	page_msg_enter_adapt();
});
const config = { attributes: true, childList: true, subtree: true };
observer.observe(div1, config);
function send_msg(){
	img_red = 0;
	if (img_state == 1) {
		hide_img_preview();
		contentMsg = document.getElementById("content-msg");
		let newInput_i = document.createElement('input');
		newInput_i.className = 'delete_input invisible';
		newInput_i.type = 'checkbox';
		newInput_i.autocomplete = 'off';
		newInput_i.id = 'created_file_img_input';
		contentMsg.appendChild(newInput_i);
		let img = document.createElement('img');
		img.src = base64_img_import;
		img.id = 'created_file_img';
		img.style.clear = 'both';
		img.style.display = 'none';
		contentMsg.appendChild(img);
		let newBr1i = document.createElement('br');
		let newBr2i = document.createElement('br');
		let newBr3i = document.createElement('br');
		newBr1i.id = 'created_file_img_br_a';
		newBr2i.id = 'created_file_img_br_b';
		newBr3i.id = 'created_file_img_br_c';
		contentMsg.appendChild(newBr1i);
		contentMsg.appendChild(newBr2i);
		contentMsg.appendChild(newBr3i);
		img_red = 1;
	}
	text = null;
	text = document.getElementById('textarea_msg').value;
	if (!!text) {
		let content = document.getElementById('content-msg');
		let newInput = document.createElement('input');
		newInput.className = 'delete_input invisible';
		newInput.type = 'checkbox';
		newInput.autocomplete = 'off';
		newInput.id = 'created_file_txt_input';
		content.append(newInput);
		let newDiv = document.createElement('div');
		newDiv.className = 'message';
		content.append(newDiv);
		newDiv.id = 'created_file_txt_div';
		let newP = document.createElement('p');
		newDiv.prepend(newP);
		var httpRequest = getHttpRequest();
		let newBr1t = document.createElement('br');
		let newBr2t = document.createElement('br');
		let newBr3t = document.createElement('br');
		newBr1t.id = 'created_file_txt_br_a';
		newBr2t.id = 'created_file_txt_br_b';
		newBr3t.id = 'created_file_txt_br_c';
		content.append(newBr1t);
		content.append(newBr2t);
		content.append(newBr3t);	
	}
	id_user = id_user_live;
	var formData = new FormData();
	if (img_red == 1) {formData.append('img', input_file.files[0]);}
	formData.append('text', text);
	formData.append('id_conv', id_conv);
	formData.append('id_user', id_user);
	if (natofconv == 1) {formData.append('nat', 1);}
	if (natofconv == 0) {formData.append('nat', 0);}
	// regarder nat = 0 ça va faire dans le php la merrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrde
	ajaxresponse = null;
	fetch('includes/send_msg.php', {
        method: "POST", 
        body: formData
    })
    .then(response => response.text())
    .then(data => {
	    console.log(data); // Affiche la réponse
	    ajaxresponse = data;
	})
    .then(() => {
    	dataJSON_msg = JSON.parse(ajaxresponse);
    	if (img_red == 1){
    		response_i = parseInt(dataJSON_msg['img']);
    		newInput_i = document.getElementById('created_file_img_input');
    		newInput_i.id = response_i;
    		img = document.getElementById('created_file_img');
    		img.classList.add('img_msg', 'message', 'msg_' + response_i, 'clear');
    		img.id = 'from';
    		img.style.display = 'block';
    		newBr1i = document.getElementById('created_file_img_br_a');
			newBr2i = document.getElementById('created_file_img_br_b');
			newBr3i = document.getElementById('created_file_img_br_c');
    		newBr1i.className = 'msg_' + response_i;
			newBr2i.className = 'msg_' + response_i;
			newBr3i.className = 'msg_' + response_i;
			newBr1i.removeAttribute("id");
			newBr2i.removeAttribute("id");
			newBr3i.removeAttribute("id");
			table.push(response_i);
    	}
    	if (!!text){
    		response_t = parseInt(dataJSON_msg['txt']);
    		newInput = document.getElementById('created_file_txt_input');
    		newInput.id = response_t;
    		newDiv = document.getElementById('created_file_txt_div');
			newDiv.classList.add("msg_" + response_t, 'clear');
			newBr1t = document.getElementById('created_file_txt_br_a');
			newBr2t = document.getElementById('created_file_txt_br_b');
			newBr3t = document.getElementById('created_file_txt_br_c');
			newBr1t.classList.add("msg_" + response_t);
			newBr2t.classList.add("msg_" + response_t);
			newBr3t.classList.add("msg_" + response_t);
			newBr1t.removeAttribute("id");
			newBr2t.removeAttribute("id");
			newBr3t.removeAttribute("id");
			table.push(response_t);
			if (natofconv == 0) {
				let newPasti = '<svg version="1.1" id="duble-tick" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 800 800" style="enable-background:new 0 0 800 800;" xml:space="preserve"><style type="text/css">.st0{fill:none;stroke:#FFFFFF;stroke-width:50;stroke-linecap:round;stroke-miterlimit:133.3333;}</style><path class="st0_'+response_t+' st0" d="M50,416.7l135.9,135.9c7.8,7.8,20.5,7.8,28.3,0l85.9-85.9"></path><path class="st0_'+response_t+' st0" d="M533.3,233.3L400,366.7"></path><path class="st0_'+response_t+' st0" d="M233.3,400l152.5,152.5c7.8,7.8,20.5,7.8,28.3,0l319.2-319.2"></path></svg>';
				newDiv.innerHTML = newPasti;
			}
			let newP = document.createElement('p');
			text = document.getElementById('textarea_msg').value;
			newP.textContent = text;
			newDiv.prepend(newP);
			newDiv.id = "from";
    	}
		contentMsg = document.getElementById("content-msg");
		contentMsg.scrollTop = contentMsg.scrollHeight;
		elems_emoji_in = document.querySelectorAll('div.emojionearea-editor');
		elems_emoji_in[0].innerHTML = '';
		document.getElementById('textarea_msg').value = '';
		msgadapt(1);
    })
    .catch(error => {
        console.error('Error:', error);
    })
}
function Unvinsible_input_delete(){
	state_delete = 2;
	input = document.querySelectorAll('input.delete_input.invisible');
	a = input.length;
	for (let i = 0; i < a; i++) {
	  input[i].className = 'delete_input';
	}
	document.getElementById('suppr-buuton').className = 'content-suppr-button';
	document.getElementById('ann-buuton').className = 'content-ann-button';
	inputs = document.querySelectorAll('.delete_input');
	for (var i = 0; i < inputs.length; i++) {
	  inputs[i].style.clear = 'both';
	}
	divs = document.querySelectorAll('#from');
	for (var j = 0; j < divs.length; j++) {
	  divs[j].style.clear = 'none';
	}
	document.querySelector('img.bin_band-msg').style.display = 'none';
	sizebuttdeletemess('#suppr-buuton', '.suppr_button_text');
	document.querySelector('.user-to_profile-name').style.maxWidth = '93.35px';
	document.getElementById('view_group').style.display = 'none';
}
function Unvinsible_convdelete(){
	state_delete = 1;
	if (natofconv == 0) {
		document.getElementById('ann-buuton').className = 'content-ann-button';
		document.getElementById('supconv-buuton').className = 'content-supconv-button';
		sizebuttdeletemess('#supconv-buuton', '.supconv_button_text');
		document.querySelector('.user-to_profile-name').style.maxWidth = '93.35px';
		document.getElementById('view_group').style.display = 'none';
	}
	else if (natofconv == 1) {
		document.getElementById('ann-buuton').className = 'content-ann-button';
		document.getElementById('quitconv-buuton').className = 'content-supconv-button contentquitgroup';
		sizebuttdeletemess('#quitconv-buuton', '.supconv_button_text.quitgroup');
		document.querySelector('.user-to_profile-name').style.maxWidth = '93.35px';
		document.getElementById('view_group').style.display = 'none';
	}
	document.querySelector('img.bin_band-msg').style.display = 'none';
}
function Insible_input_delete(spe){
	state_delete = 0;
	input = document.querySelectorAll('input.delete_input');
	a = input.length;
	for (let i = 0; i < a; i++) {
	  input[i].className = 'delete_input invisible';
	}
	document.getElementById('suppr-buuton').className = 'content-suppr-button invisible';
	document.getElementById('ann-buuton').className = 'content-ann-button invisible';
	document.getElementById('supconv-buuton').className = 'content-supconv-button invisible';
	document.getElementById('quitconv-buuton').className = 'content-supconv-button invisible';
	document.getElementById('alert-msg').style.display = "none";
	inputs = document.querySelectorAll('.delete_input');
	for (var i = 0; i < inputs.length; i++) {
	  inputs[i].style.clear = 'none';
	}
	divs = document.querySelectorAll('#from');
	for (var j = 0; j < divs.length; j++) {
	  divs[j].style.clear = 'both';
	}
	if (spe !== 1) {document.querySelector('img.bin_band-msg').style.display = 'block';}
	let contentsend = document.getElementById('send-content');
	let contentSupconvButton = document.querySelector('#supconv-buuton');
	let supconvButtonText = document.querySelector('.supconv_button_text');
	let groupcontentbutt = document.querySelector('#quitconv-buuton');
	let groupbutttext = document.querySelector('.supconv_button_text.quitgroup');
	let contentAnnButton = document.querySelector('.content-ann-button');
	let annButtonText = document.querySelector('.ann_button_text');
	let infoBand = document.querySelector('.info_band');
	let svgBinfonc1 = document.querySelector('.svg_binfonc_2');
	let svgBinfonc2 = document.querySelector('.svg_binfonc_4');
	let serToProfileBall = document.querySelector('.user-to_profile-ball');
	let contentSupmessButton = document.querySelector('#suppr-buuton');
	let supmessButtonText = document.querySelector('.suppr_button_text');
	let svgBinfonc3 = document.querySelector('.svg_binfonc_1');
	contentsend.removeAttribute('style');
	contentsend.style.display = 'block';
	contentsend.style.paddingRight = '10px';
	contentsend.style.overflow = 'hidden';
	contentsend.style.minHeight = '350px';
	contentsend.style.height = 'auto';
	contentsend.style.position = 'fixed';
	contentsend.style.bottom = '0px';
	contentsend.style.width = '100%';
	contentsend.style.paddingTop = '286px';
	contentsend.style.paddingBottom = '16px';
	contentSupconvButton.removeAttribute('style');
	supconvButtonText.removeAttribute('style');
	supconvButtonText.style.display = "block";
	contentSupmessButton.removeAttribute('style');
	contentAnnButton.removeAttribute('style');
	annButtonText.removeAttribute('style');
	annButtonText.style.display = "block";
	infoBand.removeAttribute('style');
	svgBinfonc1.removeAttribute('style');
	svgBinfonc2.removeAttribute('style');
	serToProfileBall.removeAttribute('style');
	serToProfileBall.style.display = "block";
	groupcontentbutt.removeAttribute('style');
	groupbutttext.removeAttribute('style');
	groupbutttext.style.display = "block";
	document.querySelector('.user-to_profile-name').style.maxWidth = '300px';
	document.getElementById('view_group').style.display = 'block';
	supmessButtonText.removeAttribute('style');
	supmessButtonText.style.display = "block";
	svgBinfonc3.removeAttribute('style');
}
function Delete_conv(conv_id) {
	var httpRequest = getHttpRequest();
	httpRequest.onreadystatechange = function () {
     	if (httpRequest.readyState === 4){
          	document.getElementById('content-msg').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="512" height="512" class="svg_start nonSelectionnableindex"><path d="M23.119.882a2.966,2.966,0,0,0-2.8-.8l-16,3.37a4.995,4.995,0,0,0-2.853,8.481L3.184,13.65a1,1,0,0,1,.293.708v3.168a2.965,2.965,0,0,0,.3,1.285l-.008.007.026.026A3,3,0,0,0,5.157,20.2l.026.026.007-.008a2.965,2.965,0,0,0,1.285.3H9.643a1,1,0,0,1,.707.292l1.717,1.717A4.963,4.963,0,0,0,15.587,24a5.049,5.049,0,0,0,1.605-.264,4.933,4.933,0,0,0,3.344-3.986L23.911,3.715A2.975,2.975,0,0,0,23.119.882ZM4.6,12.238,2.881,10.521a2.94,2.94,0,0,1-.722-3.074,2.978,2.978,0,0,1,2.5-2.026L20.5,2.086,5.475,17.113V14.358A2.978,2.978,0,0,0,4.6,12.238Zm13.971,7.17a3,3,0,0,1-5.089,1.712L11.762,19.4a2.978,2.978,0,0,0-2.119-.878H6.888L21.915,3.5Z"/></svg><h3 class="mess_start nonSelectionnableindex">Commencer à discuter !</h3>';
          	document.getElementById('content-msg').style.textAlign = 'center';
          	document.getElementById('send-content').style.display = "none";
          	start = 0;
          	infoBand = document.querySelector('.info_band');
			children = infoBand.querySelectorAll(':nth-child(-n+4)');
			for (let i = 0; i < children.length; i++) {
			  children[i].style.display = 'none';
			}
          	elemdelete = document.getElementById('active_conv');
          	classelemdelete = elemdelete.className;
          	if (classelemdelete.includes("prem_conv")) {
          		elemdelete.remove();
          		premelemli = document.querySelectorAll('ul#content-conv-list li');
          		premelemli[0].className = "name_conv_list prem_conv";
          	}
          	else{
          		elemdelete.remove();
          	}
          	num = conv.indexOf(conv_id);
          	to.splice(num, 1);
        }  
    }
  	httpRequest.open('POST', 'includes/delete_conv.php', true)
  	httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  	httpRequest.overrideMimeType("text/plain")
  	httpRequest.send("conv=" + encodeURIComponent(conv_id) + "&user=" + encodeURIComponent(id_user_live) + "&nat=" + encodeURIComponent(1))
}
function Delete_message(){
	input = document.querySelectorAll('input.delete_input');
	delete_table = new Array();
	a = input.length;
	for (let i = 0; i < a; i++) {
	  if (input[i].checked) {
	  	delete_table.push(input[i].id);
	  }
	}
	var httpRequest = getHttpRequest();
	httpRequest.onreadystatechange = function () {
     	if (httpRequest.readyState === 4){
          	for (let i = 0; i < a; i++) {
			  if (input[i].checked) {
			  	document.getElementById(input[i].id).remove();
			  	content = document.querySelectorAll('.msg_' + input[i].id);
			  	content[0].remove();
			  	content = document.querySelectorAll('br.msg_' + input[i].id);
			  	content[0].remove();
			  	content[1].remove();
			  	content[2].remove();
			  	num = table.indexOf(input[i].id);
				table.splice(num, 1);
			  }
			}
        }  
    }
  	httpRequest.open('POST', 'includes/delete_message.php', true)
  	httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  	httpRequest.overrideMimeType("text/plain")
  	httpRequest.send("table=" + encodeURIComponent(JSON.stringify(delete_table)) + "&id_conv=" + encodeURIComponent(id_conv) + "&id_user=" + encodeURIComponent(id_user_live))
}
function Change_conv(num, yu, spef, ji, nat){
	if (start == 0) {
  		document.getElementById('send-content').style.display = "block";
  		start = 1;
  		document.getElementById('content-msg').innerHTML = '';
  		document.getElementById('content-msg').removeAttribute('style');
  		elemimgpro = document.querySelectorAll('.user-to_profile-img');
  		elemimgpro[0].style.display = "block";
  		infoBand = document.querySelector('.info_band');
		children = infoBand.querySelectorAll(':nth-child(-n+4)');
		for (let i = 0; i < children.length; i++) {
		  children[i].style.display = 'block';
		}
		elempasblock = document.querySelectorAll('.pasblock');
		if (window.innerWidth <= 1202 && stateofmenu == 1){
			isClosed = false;
	    	trigger_burg = document.getElementById('hamburger');
	    	trigger_burg.className = 'hamburglar is-closed pasblock';
			start_menu();
		}
		else{
			elempasblock[0].style.display = 'none';
		}
  		elempasblock[1].removeAttribute('style');
  		elempasblock[2].removeAttribute('style');
  	}
	if (!!document.getElementById('active_conv') == true) {
		document.getElementById('active_conv').removeAttribute("id");
	}
	if (window.innerWidth <= 1202 && stateofmenu == 1){
		isClosed = false;
    	trigger_burg = document.getElementById('hamburger');
    	trigger_burg.className = 'hamburglar is-closed pasblock';
		start_menu();
	}
	document.getElementById('ballgreenred').style.display = "none";
	li = document.querySelectorAll('li.name_conv_list');
	for (i = 0; i < li.length; i++) {
  		li[i].removeAttribute('style');
  		li[i].removeAttribute('id')
  	}
	id_conv = conv[num];
	conv_active_id = id_conv;
	from_change = id_user_live;
	to_change = to[num];
	pseudo = document.getElementById('span_user_'+num).innerHTML;
	var httpRequest = getHttpRequest();
	httpRequest.onreadystatechange = function () {
     	if (httpRequest.readyState === 4){
          	document.getElementById('content-msg').innerHTML = httpRequest.responseText;
          	document.getElementById('title_user').innerHTML = pseudo;
          	elem = document.querySelectorAll('.hide_info_band');
          	a = elem.length;
          	for (let i = 0; i < a; i++){
          		elem[i].style.display = 'block';
          	}
          	elems_emoji_in = document.querySelectorAll('div.emojionearea-editor');
          	elems_emoji_in[0].style.cursor = "text";
          	elem = document.querySelectorAll('.hide_button');
          	elem[0].style.cursor = "pointer";
          	elem[1].style.cursor = "pointer";
          	if (nat !== 1) {
	          	document.getElementById('new_msg_'+num).style.display = "none";
	          	document.getElementById('new_msg_'+num+'_span').innerHTML = 0;
				document.getElementById('new_msg_'+num+'_span').style.display = "none";
			}
          	active_conv = id_conv;
          	if (nat == 1) {
		  		document.getElementById('ballgreenred').style.display = "none";
		  		document.querySelector('.user-to_profile-img').style.display = "none";
		  		document.getElementById('action-info-msg-alert').innerHTML = "Oui, je quitte le groupe";
		  		if (media_butt == 0) {document.getElementById('view_group').style.display = 'block';}
		  		document.getElementById('view_group_bar').style.display = 'block';
		  		natofconv = 1;
		  		var httpRequest_role = getHttpRequest();
		  		httpRequest_role.onreadystatechange = function () {
     				if (httpRequest_role.readyState === 4){
     					role_conv_active = JSON.parse(httpRequest_role.responseText);
     				}
     			}
		  		httpRequest_role.open('POST', 'includes/rolegroup.php', true)
			  	httpRequest_role.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
			  	httpRequest_role.overrideMimeType("text/plain")
			  	httpRequest_role.send("conv=" + encodeURIComponent(id_conv))
		  	}
		  	if (nat !== 1) {
		  		document.getElementById('view_group').style.display = 'none';
		  		document.getElementById('view_group_bar').style.display = 'none';
		  		document.getElementById('ballgreenred').style.display = "block";
		  		document.querySelector('.user-to_profile-img').style.display = "block";
		  		document.getElementById('action-info-msg-alert').innerHTML = "Oui, on supprime";
		  		natofconv = 0;
		  	}
		  	page_msg_enter_adapt();
		  	Insible_input_delete();
		  	onCheckboxClick();
          	Recup_table(from_change,to_change,id_conv, 1);
			elems_emoji_in[0].innerHTML = '';
			fromDivs = document.querySelectorAll('div#from');
			toDivs = document.querySelectorAll('div#to');
			fromImgs = document.querySelectorAll('img#from');
			toImgs = document.querySelectorAll('img#to');
			msgadapt();
			setEmojioneareaWidth();
			if (window.matchMedia("(max-width: 751px)").matches) {
		  		document.getElementById('view_group').style.display = 'none';
		  	}
			setTimeout(function() {
			  var contentMsg = document.getElementById("content-msg");
			  contentMsg.scrollTop = contentMsg.scrollHeight;
			}, 800);
        }  
    }
  	httpRequest.open('POST', 'includes/load_msg.php', true)
  	httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  	httpRequest.overrideMimeType("text/plain")
  	if (nat !== 1) {httpRequest.send("from=" + encodeURIComponent(from_change) + "&to=" + encodeURIComponent(to_change) + "&id_conv=" + encodeURIComponent(id_conv))}
  	else if (nat == 1) {httpRequest.send("from=" + encodeURIComponent(from_change) + "&to=" + encodeURIComponent(JSON.stringify(to_change)) + "&id_conv=" + encodeURIComponent(id_conv) + "&nat=" + encodeURIComponent(nat))}
  	if (yu == 1) {
  		document.getElementById("search_text").value = "";
		document.querySelector('#result_search').innerHTML = '';
		cas = document.querySelectorAll('button.butt_conv_crea_one');
		cas[0].style.display = 'none';
		cas = document.querySelectorAll('button.butt_conv_crea_two');
		cas[0].style.display = 'none';
		cas = document.querySelectorAll('button.butt_conv_crea_three');
		cas[0].style.display = 'none';
		cas = document.querySelectorAll('button.butt_conv_crea_four');
		cas[0].style.display = 'none';
  	}
  	document.getElementById('action-info-msg-alert').setAttribute("onclick", "Delete_conv('"+id_conv+"');Insible_input_delete();");
  	var httpRequest_online = getHttpRequest();
	httpRequest_online.onreadystatechange = function () {
     	if (httpRequest_online.readyState === 4){
          	if (httpRequest_online.responseText == 1) {
          		document.getElementById('ballgreenred').style.backgroundColor = "#b4ff00";
          		state_pastll = 1;
          	}
          	else if (httpRequest_online.responseText == 0) {
          		document.getElementById('ballgreenred').style.backgroundColor = "#f00";
          		state_pastll = 2;
          	}
          	else{
          		state_pastll = 0;
          		// erreur
          	}
        }  
    }
  	httpRequest_online.open('POST', 'includes/redorgreen.php', true)
  	httpRequest_online.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  	httpRequest_online.overrideMimeType("text/plain")
  	httpRequest_online.send("user=" + encodeURIComponent(to_change))
}
function vu(state, num){
	if (table_vu.length !== 0) {
		if (state == 0) {
			tab_vu = table_vu;
			chaine_vu = tab_vu.map(function(val) {return encodeURIComponent(val);}).join(',');
			var httpRequest = getHttpRequest();
		  	httpRequest.open('POST', 'includes/vu_msg.php?tableau=' + chaine_vu, true)
		  	httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
		  	httpRequest.send()
		}
		else if( state == 1){
			tab_vu = [];
			tab_vu.push(num);
			chaine_vu = tab_vu.map(function(val) {return encodeURIComponent(val);}).join(',');
			var httpRequest = getHttpRequest();
		  	httpRequest.open('POST', 'includes/vu_msg.php?tableau=' + chaine_vu, true)
		  	httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
		  	httpRequest.send()
		}
	}
}
window.onload = function() {
  	elems_emoji = document.querySelectorAll('div.emojionearea');
	elems_emoji[0].style.border = "none";
	elems_emoji[0].style.borderRadius = "20px";
	elems_emoji[0].style.minHeight = '50px';
	elems_emoji[0].style.transition = "none";
	elems_emoji[0].style.webkitTransition = "none";
	elems_emoji[0].style.oTransition = "none";
	elems_emoji[0].style.mozTransition = "none";
	elems_emoji[0].style.boxShadow = "none";
	elems_emoji[0].style.webkitBoxShadow = "none";
	elems_emoji[0].style.mozBoxShadow = "none";
	elems_emoji[0].style.padding = "0";
	elems_emoji[0].style.width = "88%";
	elems_emoji[0].style.float = "left";
	elems_emoji[0].style.boxShadow = "3px 0px 1px #0000004a";
	elems_emoji_in = document.querySelectorAll('div.emojionearea-editor');
	elems_emoji_in[0].style.padding = '12px';
	elems_emoji_in[0].style.overflowWrap = 'break-word';
	elems_emoji_in[0].style.paddingRight = '8px';
	elems_emoji_in[0].style.maxHeight = '200px';
	elems_emoji_in[0].style.scrollbarWidth = 'thin';
	elems_emoji_in[0].style.marginRight = '34px';
	elems_emoji_in[0].style.minHeight = '0';
	elems_emoji_in[0].style.height = 'auto';
	elems_emoji_in[0].innerHTML = '';
	elems_emoji_in[0].style.cursor = "not-allowed";
	content_emoji = document.getElementById('send-content');
	content_emoji.style.paddingRight = '10px';
	content_emoji.style.overflow = 'hidden';
	content_emoji.style.minHeight = '350px';
	content_emoji.style.height = 'auto';
	content_emoji.style.position = 'fixed';
	content_emoji.style.bottom = 0;
	content_emoji.style.width = '100%';
	content_emoji.style.paddingTop = '286px';
	content_emoji.style.paddingBottom = '16px';
	input_file = document.getElementById("file_input_msg");
	let content_img_import = document.getElementById("content_img_import");
	input_file.addEventListener("change", function() {
	    if (input_file.files && input_file.files[0]) {
	        let selected_file = input_file.files[0];
	        let file_extension = selected_file.name.split(".").pop();
	        if (file_extension === "jpg" || file_extension === "jpeg" || file_extension === "png") {
	            let reader = new FileReader();
	            reader.onload = function() {
	                base64_img_import = reader.result;
	                document.getElementById("img_import").src = base64_img_import;
	                stock_import_img = selected_file;
	                img_state = 1;
	                content_img_import.style.display = "block";
	                select = document.querySelectorAll('div.emojionearea');
	                select[0].style.width = "50%";
	                culculs = document.getElementById('send-content').clientHeight;
	                culculs -= 308;
	                document.getElementById('img_import').style.maxHeight = culculs + 'px';
	                setEmojioneareaWidth();
	                setTimeout(function() {
					  var contentMsg = document.getElementById("content-msg");
					  contentMsg.scrollTop = contentMsg.scrollHeight;
					}, 300);
	            };
	            reader.readAsDataURL(selected_file);
	        } else {
	            alert("Le format du fichier est invalide. Veuillez sélectionner une image au format jpg, jpeg ou png.");
	        }
	    }
	});
	buttons_emoji = document.querySelectorAll('.emojionearea-button');
	buttons_emoji = buttons_emoji[0];
	buttons_emoji.addEventListener('click', function() {
		if (document.getElementById('content-msg').style.zIndex == "0") {
			document.getElementById('content-msg').style.zIndex = "2";
		}
		else if (document.getElementById('content-msg').style.zIndex == "2") {
			document.getElementById('content-msg').style.zIndex = "0";
		}
	});
	document.addEventListener('click', function(event) {
	  if (!buttons_emoji.contains(event.target)) {
	    document.getElementById('content-msg').style.zIndex = "2";
	  }
	});
	document.getElementById('annimation_loader').style.display = 'none';
	document.getElementById('content_all').style.display = 'block';
	charge_all = 1;
};
function create_conv(to_conv, yu , nat){
	from = id_user_live;
	if (nat == 0) {to_char = to_conv.toString();}
	name_group = document.getElementById("name_group").value;
	var httpRequest = getHttpRequest();
	httpRequest.onreadystatechange = function () {
     	if (httpRequest.readyState === 4){
          	conv.push(httpRequest.responseText);
          	eventSource.close();
          	let premConvElems = document.querySelectorAll('li.prem_conv.name_conv_list');
			for(let i = 0; i < premConvElems.length; i++){
			  premConvElems[i].classList.remove('prem_conv');
			}
			if (nat == 0) {
				get_pseudo(to_conv, function(pseudo){
					to.push(to_conv);
					num = conv.indexOf(httpRequest.responseText);
					list = document.getElementById('content-conv-list');
					li = document.createElement('li');
					li.classList.add('new');
					conv_add += 1;
					li.setAttribute('onclick', "Change_conv("+num+", 0, 0, "+conv_add+");this.style.backgroundColor = 'rgb(9, 0, 211)';this.style.color = 'rgb(242, 240, 237)';this.id = 'active_conv';");
					img = document.createElement('img');
					img.src = 'IMG/account.png';
					img.classList.add('profile_img_list_conv');
					li.appendChild(img);
					span = document.createElement('span');
					span.classList.add('span_list_conv');
					span.id = 'span_user_'+num;
					span.innerHTML = pseudo;
					li.appendChild(span);
					div = document.createElement('div');
					div.classList.add('new_message');
					div.id = 'new_msg_'+num;
					div.style.display = 'none';
					li.appendChild(div);
					span2 = document.createElement('span');
					span2.classList.add('new_message_num');
					span2.id = 'new_msg_'+num+'_span';
					span2.innerHTML = '0';
					div.appendChild(span2);
					list.insertBefore(li, list.firstChild);
					document.getElementById('ballgreenred').style.display = "block";
					if(yu == 1){Change_conv(num, 0, 0, conv_add);}
					li = document.querySelector('li.new');
					li.className = '';
					li.classList.add('name_conv_list');
					li.classList.add('prem_conv');
					li.id = 'active_conv';
					li.style.backgroundColor = 'rgb(9, 0, 211)';
					li.style.color = 'rgb(242, 240, 237)';
				});
			}
			else if (nat == 1) {
				add_to =[];
				add_to.push(...tab_to_crea_conv);
				to.push(add_to);
				pseudo = document.getElementById('name_group').value;
				document.getElementById('name_group').value = "";
				num = conv.indexOf(httpRequest.responseText);
				list = document.getElementById('content-conv-list');
				li = document.createElement('li');
				li.classList.add('new');
				li.style.display = 'none';
				conv_add += 1;
				li.setAttribute('onclick', "Change_conv("+num+", 0, 0, "+conv_add+");this.style.backgroundColor = 'rgb(9, 0, 211)';this.style.color = 'rgb(242, 240, 237)';this.id = 'active_conv';");
				img = document.createElement('img');
				img.src = 'IMG/group.png';
				img.classList.add('profile_img_list_conv');
				li.appendChild(img);
				span = document.createElement('span');
				span.classList.add('span_list_conv');
				span.id = 'span_user_'+num;
				span.innerHTML = pseudo;
				li.appendChild(span);
				div = document.createElement('div');
				div.classList.add('new_message');
				div.id = 'new_msg_'+num;
				div.style.display = 'none';
				li.appendChild(div);
				span2 = document.createElement('span');
				span2.classList.add('new_message_num');
				span2.id = 'new_msg_'+num+'_span';
				span2.innerHTML = '0';
				div.appendChild(span2);
				list.insertBefore(li, list.firstChild);
				document.getElementById('ballgreenred').style.display = "none";
				if(yu == 1){Change_conv(num, 0, 0, conv_add);}
				li = document.querySelector('li.new');
				li.className = '';
				li.classList.add('name_conv_list');
				li.classList.add('prem_conv');
				li.id = 'active_conv';
				li.style.backgroundColor = 'rgb(9, 0, 211)';
				li.style.color = 'rgb(242, 240, 237)';
			}
			reconnect();
        }  
    }
  	httpRequest.open('POST', 'includes/newconv.php', true)
  	httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  	httpRequest.overrideMimeType("text/plain")
  	if (nat == 0) {httpRequest.send("from=" + encodeURIComponent(from) + "&to=" + encodeURIComponent(to_conv) + "&nat=" + encodeURIComponent(2))}
  	else if (nat == 1) {httpRequest.send("from=" + encodeURIComponent(from) + "&nat=" + encodeURIComponent(1) + "&tab=" + encodeURIComponent(JSON.stringify(tab_to_crea_conv)) + "&name=" + encodeURIComponent(name_group))}
  	// httpRequest.send("from=" + encodeURIComponent(from) + "&to=" + encodeURIComponent(to_conv) + "&nat=" + encodeURIComponent(nat) + "&tab=" + encodeURIComponent(JSON.stringify(tab_to_crea_conv)) + "&name=" + encodeURIComponent(name_group))
  	if (yu == 1) {
  		document.getElementById("search_text").value = "";
		document.querySelector('#result_search').innerHTML = '';
		cas = document.querySelectorAll('button.butt_conv_crea_one');
		cas[0].style.display = 'none';
		cas = document.querySelectorAll('button.butt_conv_crea_two');
		cas[0].style.display = 'none';
		cas = document.querySelectorAll('button.butt_conv_crea_three');
		cas[0].style.display = 'none';
		cas = document.querySelectorAll('button.butt_conv_crea_four');
		cas[0].style.display = 'none';
  	}
}
function get_pseudo(code, callback){
	httpRequest = getHttpRequest();
    httpRequest.onreadystatechange = function () {
    	if (httpRequest.readyState === 4){
    		callback(httpRequest.responseText);
    	}
    };
    httpRequest.open('POST', 'includes/get_pseudo.php', true);
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    httpRequest.overrideMimeType("text/plain");
    httpRequest.send("conv=" + encodeURIComponent(code));
}
function hide_img_preview(){
	document.getElementById("content_img_import").style.display = "none";
	document.getElementById("close_img_preview").style.cursor = "pointer";
	stock_import_img = null;
	img_state = 0;
	elems_emoji = document.querySelectorAll('div.emojionearea');
	elems_emoji[0].style.width = "88%";

}
function onCheckboxClick(event) {
  	tab_to_crea_conv = [];
  	let values = [];
  	let checkboxes = document.querySelectorAll('input[type="checkbox"].searchcheck:checked');
	for(let i = 0; i < checkboxes.length; i++) {
	  values.push(checkboxes[i].value);
	}
  	if (values.length == 1) {
  		num = to.indexOf(values[0]);
  		if ((num == -1 || Array.isArray(to[num])) && values[0] !== id_user_live) {
			cas = document.querySelectorAll('button.butt_conv_crea_two');
			cas[0].style.display = 'none';
			cas = document.querySelectorAll('button.butt_conv_crea_three');
			cas[0].style.display = 'none';
			cas = document.querySelectorAll('button.butt_conv_crea_one');
			cas[0].style.display = 'block';
			cas[0].setAttribute('onclick', 'create_conv("'+values[0]+'", 1, 0)');
			cas = document.querySelectorAll('button.butt_conv_crea_four');
			cas[0].style.display = 'none';
			if (natofconv == 1 && !to[conv.indexOf(conv_active_id)].includes(values[0])) {
				cas = document.querySelectorAll('button.butt_conv_crea_four');
				cas[0].style.display = 'block';
				cas[0].setAttribute('onclick', 'adduseringroup("'+values[0]+'", "'+conv_active_id+'")');
			}
		}
		else{
			cas = document.querySelectorAll('button.butt_conv_crea_two');
			cas[0].style.display = 'none';
			cas = document.querySelectorAll('button.butt_conv_crea_one');
			cas[0].style.display = 'none';
			cas = document.querySelectorAll('button.butt_conv_crea_three');
			cas[0].style.display = 'block';
			cas[0].setAttribute('onclick', 'Change_conv('+ num +', 1)');
			cas = document.querySelectorAll('button.butt_conv_crea_four');
			cas[0].style.display = 'none';
			if (natofconv == 1 && !to[conv.indexOf(conv_active_id)].includes(values[0])) {
				cas = document.querySelectorAll('button.butt_conv_crea_four');
				cas[0].style.display = 'block';
				cas[0].setAttribute('onclick', 'adduseringroup("'+values[0]+'", "'+conv_active_id+'")');
			}
		}
	}
	if (values.length > 1) {
		cas = document.querySelectorAll('button.butt_conv_crea_one');
		cas[0].style.display = 'none';
		cas = document.querySelectorAll('button.butt_conv_crea_three');
		cas[0].style.display = 'none';
		cas = document.querySelectorAll('button.butt_conv_crea_two');
		cas[0].style.display = 'block';
		cas[0].setAttribute('onclick', 'create_group()');
		tab_to_crea_conv.push(...values);
		cas = document.querySelectorAll('button.butt_conv_crea_four');
		cas[0].style.display = 'none';
		add_group_val = 0;
		for (var i = 0; i < values.length; i++) {
			if (natofconv == 1 && !to[conv.indexOf(conv_active_id)].includes(values[i])) {
				add_group_val++;
			}
		}
		if (add_group_val == values.length) {
			cas = document.querySelectorAll('button.butt_conv_crea_four');
			cas[0].style.display = 'block';
			cas[0].setAttribute('onclick', 'adduseringroup(-1, "'+conv_active_id+'")');
		}

	}
	if (values.length == 0) {
		cas = document.querySelectorAll('button.butt_conv_crea_one');
		cas[0].style.display = 'none';
		cas = document.querySelectorAll('button.butt_conv_crea_three');
		cas[0].style.display = 'none';
		cas = document.querySelectorAll('button.butt_conv_crea_two');
		cas[0].style.display = 'none';
		cas = document.querySelectorAll('button.butt_conv_crea_four');
		cas[0].style.display = 'none';
	}
}
window.addEventListener("beforeunload", function(event) {
  	eventSource_user.close();
  	eventSource.close();
  	event.preventDefault();
  	event.returnValue = "";
});
function create_group(){
	document.getElementById('alert-group').style.display = "block";
	document.getElementById('action-info-grp-alert').setAttribute('onclick', "document.getElementById('alert-group').style.display = 'none';create_conv('', 1, 1);");
}
function groupeAlert(){
	document.getElementById('alert-group').style.display = "none";
	cas = document.querySelectorAll('button.butt_conv_crea_two');
	cas[0].style.display = 'none';
	document.getElementById("search_text").value = "";
  	document.querySelector('#result_search').innerHTML = '';
}
function adduseringroup(user_add, group_add){
	var httpRequest_add = getHttpRequest();
	httpRequest_add.onreadystatechange = function () {
    	if (httpRequest_add.readyState === 4){
    		num = conv.indexOf(conv_active_id);
          	content = to[num];
          	for (i = 0; i < tab_to_crea_conv.length; i++) {
          		content.push(tab_to_crea_conv[i]);
          	}
          	to[num] = content;
    	}
    };
  	httpRequest_add.open('POST', 'includes/insert_user_in_group.php', true)
  	httpRequest_add.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  	if (user_add == -1) {
		httpRequest_add.send("user=" + encodeURIComponent(JSON.stringify(tab_to_crea_conv)) + "&group=" + encodeURIComponent(group_add) + "&nat=" + encodeURIComponent(1))
	}
	else{
		httpRequest_add.send("user=" + encodeURIComponent(user_add) + "&group=" + encodeURIComponent(group_add))
	}
	document.getElementById("search_text").value = "";
	document.querySelector('#result_search').innerHTML = '';
	cas = document.querySelectorAll('button.butt_conv_crea_one');
	cas[0].style.display = 'none';
	cas = document.querySelectorAll('button.butt_conv_crea_two');
	cas[0].style.display = 'none';
	cas = document.querySelectorAll('button.butt_conv_crea_three');
	cas[0].style.display = 'none';
	cas = document.querySelectorAll('button.butt_conv_crea_four');
	cas[0].style.display = 'none';
}
function viewuseringroup(){
	a = conv.indexOf(conv_active_id);
	b = to[a];
	var httpRequest = getHttpRequest();
	httpRequest.onreadystatechange = function () {
    	if (httpRequest.readyState === 4){
    		dataJSON = JSON.parse(httpRequest.responseText);
    		count_search = dataJSON.length;
    		resultDiv = document.getElementById('content-result-view');
    		resultDiv.innerHTML ='';
    		for (let i = 0; i < count_search; i++) {
    			if (role_conv_active[dataJSON[i]['code']] == 1 || role_conv_active[dataJSON[i]['code']] == 2) {admin = '<img src="IMG/couronne.png" class="admin_img_view">';admin2='style="margin-left: 8px;"';}
    			else {admin = '';admin2 = '';}
	    		tr = document.createElement('tr');
		    	tr.className = 'tr_view';
		    	tr.innerHTML = '<div class="checkbox-wrapper-4"><input class="inp-cbx view" id="morning'+i+'" type="checkbox" value="'+dataJSON[i]['code']+'"/><label class="cbx" for="morning'+i+'"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span><span '+admin2+'>'+dataJSON[i]['name']+'</span>'+admin+'</label><svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg></div>';
		    	resultDiv.appendChild(tr);
	    	}
	    	if (role_conv_active[id_user_live] == 1 || role_conv_active[id_user_live] == 2) {admin = '<img src="IMG/couronne.png" class="admin_img_view">';admin2='style="margin-left: 8px;"';}
			else {admin = '';admin2 = '';}
    		tr = document.createElement('tr');
	    	tr.className = 'tr_view';
	    	tr.innerHTML = '<div class="checkbox-wrapper-4"><input class="inp-cbx view" id="morning-a" type="checkbox" value="'+id_user_live+'"/><label class="cbx" for="morning-a"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span><span '+admin2+'>'+username_live_actif+'</span>'+admin+'</label><svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg></div>';
	    	resultDiv.appendChild(tr);
	    	document.getElementById('alert-view').style.display = 'block';
	    	let checkboxes_view = document.querySelectorAll('input.view');
			for(let i = 0; i < checkboxes_view.length; i++){
			  checkboxes_view[i].addEventListener('click', oncheckview);
			}
    	}
    };
	httpRequest.overrideMimeType("text/plain");
  	httpRequest.open('POST', 'includes/name_of_id.php', true)
  	httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  	httpRequest.send("user=" + encodeURIComponent(JSON.stringify(b)))
}
function godmod(){
	let values = [];
  	let checkboxes = document.querySelectorAll('input.view:checked');
	for(let i = 0; i < checkboxes.length; i++) {
	  values.push(checkboxes[i].value);
	}
	var httpRequest = getHttpRequest();
  	httpRequest.open('POST', 'includes/godgroup.php', true)
  	httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  	httpRequest.send("users=" + encodeURIComponent(JSON.stringify(values)) + "&group=" + encodeURIComponent(conv_active_id) + "&from=" + encodeURIComponent(id_user_live))
}
function oncheckview(event){
	values = [];
	let checkboxes = document.querySelectorAll('input.view:checked');
	for(let i = 0; i < checkboxes.length; i++) {
	  values.push(checkboxes[i].value);
	}
	contient_valeur_1_ou_2 = false;
	for(let i = 0; i < values.length; i++){
	  if(role_conv_active[values[i]] == 1 || role_conv_active[values[i]] == 2 || role_conv_active[id_user_live] !== 2){
	    contient_valeur_1_ou_2 = true;
	    break;
	  }
	}
	if (contient_valeur_1_ou_2 == false && values.length > 0) {
		document.getElementById('action-god-alert-view').style.display="inline";
	}
	else{
		document.getElementById('action-god-alert-view').style.display="none";
	}
	contient_error = false;
	for(let i = 0; i < values.length; i++){
	  if(values[i] == id_user_live || role_conv_active[values[i]] == 1 && role_conv_active[id_user_live] !== 2 || role_conv_active[values[i]] == 2){
	    contient_error = true;
	    break;
	  }
	}
	if (contient_error == false && values.length > 0) {
		document.getElementById('action-ban-alert-view').style.display="inline";
	}
	else{
		document.getElementById('action-ban-alert-view').style.display="none";
	}
}
function banuser() {
	let values = [];
  	let checkboxes = document.querySelectorAll('input.view:checked');
	for(let i = 0; i < checkboxes.length; i++) {
	  values.push(checkboxes[i].value);
	}
	var httpRequest = getHttpRequest();
	httpRequest.onreadystatechange = function () {
     	if (httpRequest.readyState === 4){
          	num = conv.indexOf(conv_active_id);
          	content = to[num];
          	for (i = 0; i < values.length; i++) {
          		content.splice(content.indexOf(values[i]), 1);
          	}
          	to[num] = content;
        }  
    }
  	httpRequest.open('POST', 'includes/delete_conv.php', true)
  	httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  	httpRequest.overrideMimeType("text/plain")
  	httpRequest.send("conv=" + encodeURIComponent(conv_active_id) + "&user=" + encodeURIComponent(JSON.stringify(values)) + "&from=" + encodeURIComponent(id_user_live) + "&nat=" + encodeURIComponent(2))
}
$('document').ready(function () {
		trigger = $('#hamburger');
	    isClosed = false;

	trigger.click(function () {
	  burgerTime();
	  start_menu();
});
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
});
function start_menu(){
	if (stateofmenu == 0) {
		mediaQuery0 = window.matchMedia("(max-width: 750px)");
		document.getElementById('body').style.overflow = 'hidden';
		document.getElementById('html').style.overflow = 'hidden';
		document.getElementById('pseudo_content').style.display = 'none';
		document.getElementById('home_btt').style.display = 'none';
		if (start == 1) {
			document.querySelector('.bin_band-msg').style.display = 'none';
			Insible_input_delete(1);
			document.querySelector('.user-to_profile-img').style = "none";
			document.querySelector('.user-to_profile-name').style = "none";
			document.getElementById('ballgreenred').style.display = 'none';
		}
		if (natofconv == 1) {
	 		document.getElementById('view_group').style.display = 'none';
	 		document.getElementById('view_group_bar').style.display = 'block';
	 	}
	 	else{
	 		document.getElementById('view_group').style.display = 'none';
	 		document.getElementById('view_group_bar').style.display = 'none';
	 	}
		document.getElementById('menu').style.display = 'block';
		document.getElementById('conv_list_content').style.display = 'block';
		if (mediaQuery0.matches) {
			document.getElementById('info_menu_slap').style.display = 'block';
		}
		stateofmenu = 1;
	}
	else if(stateofmenu == 1){
		if (window.innerWidth <= 1202){document.getElementById('conv_list_content').style.display = 'none';}
		document.getElementById('menu').style.display = 'none';
		document.getElementById('body').removeAttribute('style');
		document.getElementById('html').removeAttribute('style');
		document.getElementById('pseudo_content').style.display = 'block';
		document.getElementById('home_btt').style.display = 'block';
		if (start == 1) {
			if (natofconv == 1) {
				document.getElementById('view_group').style.display = 'block';
			}
	 		else{
	 			document.getElementById('ballgreenred').style.display = 'block';
	 			document.getElementById('view_group_bar').style.display = 'none';
	 		}
			Insible_input_delete();
			document.querySelector('.user-to_profile-img').style.display = "block";
			document.querySelector('.user-to_profile-name').style.display = "block";
		}
		if (mediaQuery0.matches) {
			document.getElementById('info_menu_slap').style.display = 'none';
			document.getElementById('view_group').style.display = 'none';;
			document.getElementById('home_btt').style.display = 'none';
			document.getElementById('pseudo_content').style.display = 'none';
		}
		stateofmenu = 0;
	}
}
let mediaQuery = window.matchMedia("(min-width: 0px) and (max-width: 1202px)");
let hamburglar = document.querySelector(".hamburglar");
let convcontent = document.querySelector('.content_conv');
function handleMediaQuery(mediaQuery) {
  if (mediaQuery.matches) {
    hamburglar.style.display = 'block';
    convcontent.style.display = 'none';
  } else {
    hamburglar.style.display = 'none';
    convcontent.style.display = 'block';
    if(stateofmenu == 1){
    	isClosed = false;
    	trigger_burg = document.getElementById('hamburger');
    	trigger_burg.className = 'hamburglar is-closed pasblock';
		document.getElementById('menu').style.display = 'none';
		document.getElementById('body').removeAttribute('style');
		document.getElementById('html').removeAttribute('style');
		document.getElementById('pseudo_content').style.display = 'block';
		document.getElementById('home_btt').style.display = 'block';
	 	if (natofconv == 1) {document.getElementById('view_group').style.display = 'block';document.getElementById('view_group_bar').style.display = 'block';}
	 	else{document.getElementById('ballgreenred').style.display = 'block';}
		if (start == 1) {
			Insible_input_delete();
			document.querySelector('.user-to_profile-img').style.display = "block"; document.querySelector('.user-to_profile-name').style.display = "block";
		}
		stateofmenu = 0;
	}
  }
}
handleMediaQuery(mediaQuery);
mediaQuery.addListener(handleMediaQuery);
let mediaQuery_sprey = window.matchMedia("(min-width: 0px) and (max-width: 750px)");
function invisible_button_config(mediaQuery){
	if (mediaQuery.matches) {
		if (stateofmenu == 1) {document.getElementById('info_menu_slap').style.display = 'block';}
		media_butt = 1;
		document.getElementById('view_group').style.display = 'none';
		document.getElementById('home_btt').style.display = 'none';
		document.getElementById('pseudo_content').style.display = 'none';
	}
	else{
		media_butt = 0;
		if (stateofmenu !== 1) {
			if (start == 1) {
				if (natofconv == 1) {
					document.getElementById('view_group').style.display = 'block';
				}
				else{
					document.getElementById('ballgreenred').style.display = 'block';
				}
				document.querySelector('.user-to_profile-img').style.display = "block";
				document.querySelector('.user-to_profile-name').style.display = "block";
			}
			document.getElementById('home_btt').style.display = 'block';
			document.getElementById('pseudo_content').style.display = 'block';
		}
		document.getElementById('info_menu_slap').style.display = 'none';
	}
}
invisible_button_config(mediaQuery_sprey);
mediaQuery_sprey.addListener(invisible_button_config);
let mediaQuery_msg0 = window.matchMedia("(min-width: 430px) and (max-width: 880px)");
let mediaQuery_msg1 = window.matchMedia("(min-width: 0px) and (max-width: 430px)");
function msgadapt(state){
	if (start == 1) {
		if (state == 1) {
			fromDivs = document.querySelectorAll('div#from');
			toDivs = document.querySelectorAll('div#to');
			fromImgs = document.querySelectorAll('img#from');
			toImgs = document.querySelectorAll('img#to');
		}
		if (mediaQuery_msg0.matches) {
		  fromDivs.forEach(fromDiv => {
		    fromDiv.style.maxWidth = '200px';
		  });
		  toDivs.forEach(toDiv => {
		    toDiv.style.maxWidth = '200px';
		  });
		  fromImgs.forEach(fromImg => {
		    fromImg.style.maxWidth = '200px';
		  });
		  toImgs.forEach(toImg => {
		    toImg.style.maxWidth = '200px';
		  });
		}
		if (mediaQuery_msg1.matches) {
		  fromDivs.forEach(fromDiv => {
		    fromDiv.style.maxWidth = '140px';
		  });
		  toDivs.forEach(toDiv => {
		    toDiv.style.maxWidth = '140px';
		  });
		  fromImgs.forEach(fromImg => {
		    fromImg.style.maxWidth = '140px';
		  });
		  toImgs.forEach(toImg => {
		    toImg.style.maxWidth = '140px';
		  });
		}
		if (!mediaQuery_msg0.matches && !mediaQuery_msg1.matches){
			fromDivs.forEach(fromDiv => {
			   fromDiv.removeAttribute('style');
			   fromDiv.style.clear = 'both';
			 });
			 toDivs.forEach(toDiv => {
			   toDiv.removeAttribute('style');
			   toDiv.style.clear = 'both';
			 });
			 fromImgs.forEach(fromImg => {
			   fromImg.removeAttribute('style');
			   fromImg.style.clear = 'both';
			 });
			 toImgs.forEach(toImg => {
			   toImg.removeAttribute('style');
			   toImg.style.clear = 'both';
			 });
		}
		var contentMsg = document.getElementById("content-msg");
		contentMsg.scrollTop = contentMsg.scrollHeight;
	}
}
msgadapt();
mediaQuery_msg0.addListener(msgadapt);
mediaQuery_msg1.addListener(msgadapt);
window.addEventListener('resize', function() {
  	h = document.documentElement.scrollHeight;
	culculs = h+135 - (div1.clientHeight - 50);
	if(culculs <= 770 && state_delete == 0){
		div2.style.maxHeight = culculs + 'px';
	}
	if (img_state == 1) {
  		culculs_u = document.getElementById('send-content').clientHeight;
    	culculs_u -= 308;
    	screenWidth = window.innerWidth;
    	if (screenWidth < 590) {
	    	document.getElementById('img_import').style.maxHeight = '100px';
	    	document.getElementById('img_import').style.maxWidth = '100px';
	    }
	   	else{
	   		document.getElementById('img_import').style.maxHeight = culculs_u + 'px';
	   		document.getElementById('img_import').style.maxWidth = culculs_u + 'px';
	   	}
	}
	if (natofconv == 0 && state_delete == 1) {
		sizebuttdeletemess('#supconv-buuton', '.supconv_button_text');
	}
	else if (natofconv == 1 && state_delete == 1) {
		sizebuttdeletemess('#quitconv-buuton', '.supconv_button_text.quitgroup');
	}
	else if (state_delete == 2) {
		sizebuttdeletemess('#suppr-buuton', '.suppr_button_text');
	}
	if (charge_all == 1) {
		setEmojioneareaWidth();
	}
});
function setEmojioneareaWidth() {
  screenWidth = window.innerWidth;
  let width = '88%';
  
  if (screenWidth >= 750 && screenWidth <= 1824) {
  	if (img_state == 1) {
  		width = '50%';
  	}
  	else{
    	width = '80%';
    }
  } else if (screenWidth >= 428 && screenWidth <= 752) {
  	if (img_state == 1) {
  		width = '50%';
  	}
  	else{
    	width = '70%';
    }
  } else if (screenWidth < 430) {
  	if (img_state == 1) {
  		width = '50%';
  	}
  	else{
    	width = '60%';
    }
  }
  if (img_state == 1) {
  	width = '50%';
  }
  if (img_state == 1 && screenWidth < 720 && screenWidth > 520) {
  		width = '40%';
  }
  if (img_state == 1 && screenWidth < 520) {
  	document.getElementById('sendimgcomment').style.position = 'absolute';
  	document.querySelector('.button-right-send').style.position = 'absolute';
  	document.getElementById('sendimgcomment').style.bottom = '5px';
  	document.querySelector('.button-right-send').style.bottom = '5px';
  	document.getElementById('sendimgcomment').style.left = '5px';
  	document.querySelector('.button-right-send').style.left = '80px';
  	document.querySelector('.emojionearea').style.float = 'right';
  	document.getElementById('send-content').style.minHeight = '450px';
  	width = '60%';
  }
  else{
  	document.getElementById('sendimgcomment').removeAttribute('style');
  	document.getElementById('sendimgcomment').style.cursor = 'pointer';
  	document.querySelector('.button-right-send').removeAttribute('style');
  	document.querySelector('.button-right-send').style.cursor = 'pointer';
  	if (charge_all == 1) {
  		document.querySelector('.emojionearea').style.float = 'left';
  	}
  	document.getElementById('send-content').style.minHeight = '350px';
  }
  if (img_state == 1 && screenWidth < 370) {
  	width = '50%';
  }
  document.querySelectorAll('.emojionearea').forEach(elem => {
    elem.style.width = width;
  });
}
setEmojioneareaWidth();
function sizebuttdeletemess(data_cl1, data_cl2){
	if (natofconv == 1) {
		document.getElementById('view_group').style.display = 'none';
	}
	let cucluls_d = 0;
	let contentsend = document.getElementById('send-content');
	let contentSupconvButton = document.querySelector(data_cl1);
	let supconvButtonText = document.querySelector(data_cl2);
	let contentAnnButton = document.querySelector('.content-ann-button');
	let annButtonText = document.querySelector('.ann_button_text');
	let infoBand = document.querySelector('.info_band');
	let svgBinfonc1 = document.querySelector('.svg_binfonc_2');
	let svgBinfonc2 = document.querySelector('.svg_binfonc_4');
	let svgBinfonc3 = document.querySelector('.svg_binfonc_1');
	let userToProfileBall = document.querySelector('.user-to_profile-ball');
	contentsend.removeAttribute('style');
	contentsend.style.display = 'block';
	contentsend.style.paddingRight = '10px';
	contentsend.style.overflow = 'hidden';
	contentsend.style.minHeight = '350px';
	contentsend.style.height = 'auto';
	contentsend.style.position = 'fixed';
	contentsend.style.bottom = '0px';
	contentsend.style.width = '100%';
	contentsend.style.paddingTop = '286px';
	contentsend.style.paddingBottom = '16px';
	contentSupconvButton.removeAttribute('style');
	supconvButtonText.removeAttribute('style');
	supconvButtonText.style.display = "block";
	contentAnnButton.removeAttribute('style');
	annButtonText.removeAttribute('style');
	annButtonText.style.display = "block";
	infoBand.removeAttribute('style');
	svgBinfonc1.removeAttribute('style');
	svgBinfonc2.removeAttribute('style');
	svgBinfonc3.removeAttribute('style');
	userToProfileBall.removeAttribute('style');
	userToProfileBall.style.display = "block";
	if (state_pastll == 1) {
		userToProfileBall.style.backgroundColor = "#b4ff00";
	}
	if (state_pastll == 2) {
		userToProfileBall.style.backgroundColor = "#f00";
	}
	if (window.matchMedia("(max-width: 1480px) and (min-width: 1203px)").matches) {
		contentSupconvButton.style.backgroundColor = '#f00';
		contentSupconvButton.style.width = '260px';
		contentSupconvButton.style.height = '35px';
		contentSupconvButton.style.float = 'right';
		contentSupconvButton.style.borderRadius = '20px';
		contentSupconvButton.style.marginTop = '16px';
		contentSupconvButton.style.marginRight = '20px';
		contentSupconvButton.style.cursor = 'pointer';
		contentSupconvButton.style.marginLeft = '10px';
		supconvButtonText.style.color = '#fff';
		supconvButtonText.style.fontWeight = 'bold';
		supconvButtonText.style.fontFamily = 'sans-serif';
		supconvButtonText.style.fontSize = '18px';
		supconvButtonText.style.lineHeight = '36px';
		supconvButtonText.style.marginLeft = '15px';
		contentAnnButton.style.backgroundColor = '#37d05d';
		contentAnnButton.style.width = '110px';
		contentAnnButton.style.height = '35px';
		contentAnnButton.style.float = 'right';
		contentAnnButton.style.borderRadius = '20px';
		contentAnnButton.style.marginTop = '16px';
		contentAnnButton.style.marginRight = '0';
		contentAnnButton.style.cursor = 'pointer';
		contentAnnButton.style.marginLeft = '10px';
		annButtonText.style.color = '#fff';
		annButtonText.style.fontWeight = 'bold';
		annButtonText.style.fontFamily = 'sans-serif';
		annButtonText.style.fontSize = '18px';
		annButtonText.style.lineHeight = '36px';
		annButtonText.style.marginLeft = '20px';
	}
	if (window.matchMedia("(max-width: 1329px) and (min-width: 1203px)").matches) {
		contentSupconvButton.style.marginTop = '61px';
		infoBand.style.height = '110px';
		contentsend.style.display = 'none';
		cucluls_d++;
		contentAnnButton.style.marginTop = '61px';
	}
	if (window.matchMedia("(max-width: 1326px) and (min-width: 1203px)").matches) {
		contentAnnButton.style.marginTop = '18px';
	}
	if (window.matchMedia("(max-width: 1292px) and (min-width: 1203px)").matches) {
		contentAnnButton.style.marginTop = '1px';
	}
	if (window.matchMedia("(max-width: 1206px) and (min-width: 1203px)").matches) {
		contentSupconvButton.style.marginTop = '18px';
	}
	if (window.matchMedia("(max-width: 1060px)").matches) {
		contentSupconvButton.style.backgroundColor = '#f00';
		contentSupconvButton.style.width = '260px';
		contentSupconvButton.style.height = '35px';
		contentSupconvButton.style.float = 'right';
		contentSupconvButton.style.borderRadius = '20px';
		contentSupconvButton.style.marginTop = '16px';
		contentSupconvButton.style.marginRight = '20px';
		contentSupconvButton.style.cursor = 'pointer';
		contentSupconvButton.style.marginLeft = '10px';
		supconvButtonText.style.color = '#fff';
		supconvButtonText.style.fontWeight = 'bold';
		supconvButtonText.style.fontFamily = 'sans-serif';
		supconvButtonText.style.fontSize = '18px';
		supconvButtonText.style.lineHeight = '36px';
		supconvButtonText.style.marginLeft = '15px';
		contentAnnButton.style.backgroundColor = '#37d05d';
		contentAnnButton.style.width = '110px';
		contentAnnButton.style.height = '35px';
		contentAnnButton.style.float = 'right';
		contentAnnButton.style.borderRadius = '20px';
		contentAnnButton.style.marginTop = '16px';
		contentAnnButton.style.marginRight = '0';
		contentAnnButton.style.cursor = 'pointer';
		contentAnnButton.style.marginLeft = '10px';
		annButtonText.style.color = '#fff';
		annButtonText.style.fontWeight = 'bold';
		annButtonText.style.fontFamily = 'sans-serif';
		annButtonText.style.fontSize = '18px';
		annButtonText.style.lineHeight = '36px';
		annButtonText.style.marginLeft = '20px';
		infoBand.style.height = '60px';
		contentsend.style.display = 'block';
		cucluls_d=0;
	}
	if (window.matchMedia("(max-width: 906px)").matches) {
		contentSupconvButton.style.marginTop = '61px';
		infoBand.style.height = '110px';
		contentsend.style.display = 'none';
		cucluls_d++;
		contentAnnButton.style.marginTop = '18px';
	}
	if (window.matchMedia("(max-width: 872px)").matches) {
		contentAnnButton.style.marginTop = '1px';
	}
	if (window.matchMedia("(max-width: 786px)").matches) {
		contentSupconvButton.style.marginTop = '18px';
	}
	if (window.matchMedia("(max-width: 752px)").matches) {
		contentSupconvButton.style.marginTop = '18px'
		contentSupconvButton.style.marginTop = '11px';
		contentAnnButton.style.marginTop = '1px';
	}
	if (window.matchMedia("(max-width: 750px)").matches) {
		contentSupconvButton.style.marginTop = '16px';
		contentAnnButton.style.marginTop = '16px';
		infoBand.style.height = '60px';
		contentsend.style.display = 'block';
		cucluls_d=0;
	}
	if (window.matchMedia("(max-width: 679px)").matches) {
		contentAnnButton.style.marginTop = '60px';
		contentAnnButton.style.marginRight = '-270px';
		infoBand.style.height = '110px';
		contentsend.style.display = 'none';
		cucluls_d++;
	}
	if (window.matchMedia("(max-width: 558px)").matches) {
		contentAnnButton.style.marginTop = "3px";
		contentAnnButton.style.marginRight = "3px";
		contentSupconvButton.style.marginTop = "20px";
	}
	if (window.matchMedia("(max-width: 524px)").matches) {
		contentSupconvButton.style.marginTop = "4px";
		contentAnnButton.style.marginTop = "4px";
	}
	if (state_delete == 1) {
		if (window.matchMedia("(max-width: 412px)").matches) {
			contentSupconvButton.style.display = "none";
			contentAnnButton.style.display = "none";
			infoBand.style.height = "60px";
			contentsend.style.display = 'block';
			cucluls_d=0;
			svgBinfonc1.style.display = "block";
			svgBinfonc2.style.display = "block";
			userToProfileBall.style.marginRight = "10px";
		}
		if (window.matchMedia("(max-width: 304px)").matches) {
			svgBinfonc1.style.marginTop = "60px";
			svgBinfonc1.style.float = "left";
			svgBinfonc2.style.marginRight = "10px";
			svgBinfonc2.style.marginTop = "0";
			infoBand.style.height = "110px";
			contentsend.style.display = 'none';
			cucluls_d++;
			userToProfileBall.style.marginRight = "0";
		}
		if (window.matchMedia("(max-width: 254px)").matches) {
			svgBinfonc1.style.marginTop = "22px";
		}
	}
	else if (state_delete == 2) {
		if (window.matchMedia("(max-width: 412px)").matches) {
			contentSupconvButton.style.display = "none";
			contentAnnButton.style.display = "none";
			infoBand.style.height = "60px";
			contentsend.style.display = 'block';
			cucluls_d=0;
			svgBinfonc3.style.display = "block";
			svgBinfonc2.style.display = "block";
			userToProfileBall.style.marginRight = "10px";
		}
		if (window.matchMedia("(max-width: 304px)").matches) {
			svgBinfonc3.style.marginTop = "60px";
			svgBinfonc3.style.float = "left";
			svgBinfonc2.style.marginRight = "10px";
			svgBinfonc2.style.marginTop = "0";
			infoBand.style.height = "110px";
			contentsend.style.display = 'none';
			cucluls_d++;
			userToProfileBall.style.marginRight = "0";
		}
		if (window.matchMedia("(max-width: 254px)").matches) {
			svgBinfonc3.style.marginTop = "22px";
		}
	}
	if (cucluls_d >= 1) {
		h = document.documentElement.scrollHeight;
		culculs = h-120;
		div2.style.maxHeight = culculs + 'px';
	}
	if (cucluls_d == 0) {
		h = document.documentElement.scrollHeight;
		culculs = h+135 - (div1.clientHeight - 50);
		if(culculs <= 770){
			div2.style.maxHeight = culculs + 'px';
		}
	}
}
function connect() {
  	eventSource = new EventSource("http://localhost/sse_test.php?user="+id_user_live);
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
	eventSource_user = new EventSource("http://localhost/includes/sse-online.php?user="+id_user_live);
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
}
function newconfig(){
	var httpRequest_config = getHttpRequest();
  	httpRequest_config.open('POST', '/includes/create_new_config_json.php', true)
  	httpRequest_config.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  	httpRequest_config.send("to_table=" + encodeURIComponent(JSON.stringify(conv_to)) + "&conv_table=" + encodeURIComponent(JSON.stringify(conv_table)) + "&id=" + encodeURIComponent(id_user_live))
}
function disconnect() {
  eventSource.close();
  eventSource_user.close();
}
function reconnect() {
	disconnect();
	newconfig();
	connect();
}