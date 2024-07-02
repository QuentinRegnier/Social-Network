var emjione_textform_stat = 0;
var buttclik = 0;
var nbslide_live = 0;
var txt_art = 0;
var idcountforinclude = 1412672762415415641;
var clickburg = 0;
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
let checkedBoxes = document.querySelectorAll('input[type="checkbox"].searchcheck:checked');
checkedBoxes.forEach(function(box) {
  box.checked = false;
});
document.querySelector('.textarea_sign').value = '';
function commentchange(){
  if (statecomment == 0){
    statecomment = 1;
    let docu_content_comment = document.getElementById('content_info_comment_aff').clientHeight;
    let cululs = docu_content_comment - 70;
    document.getElementById('content_info_comment_aff').style.height = cululs + 'px';
    document.getElementById('textareacomment').style.height = '140px';
    if (window.matchMedia("(max-width: 630px)").matches){
    	document.getElementById('textareacomment').style.width = '290px';
    	document.getElementById('textareacomment').style.marginLeft = '2px';
    }
    else if (window.matchMedia("(max-width: 630px)").matches){
    	document.getElementById('textareacomment').style.width = '192px';
    	document.getElementById('textareacomment').style.marginLeft = '2px';
    }
    else{
    	document.getElementById('textareacomment').style.width = '460px';
    }
    document.getElementById('textareacomment').style.marginLeft = '-90px';
    document.getElementById('textareacommentelement').style.display = 'none';
    var elems = document.querySelectorAll('div.emojionearea');
    var index = 0, length = elems.length;
    for ( ; index < length; index++) {
      elems[index].style.display = "inline-block";
    }
    var elems = document.querySelectorAll('div.emojionearea-editor');
    elems[0].setAttribute("id", "newtextareaemojione");
    elems[0].setAttribute("onkeyup", "upodatecounter();");
    elems[0].setAttribute("onkeydown", "administrating_carac();");
    statecomment = 3;
    setTimeout("if (window.matchMedia('(max-width: 630px)').matches){document.getElementById('textareacomment').style.width = '290px';}else if (window.matchMedia('(max-width: 630px)').matches){document.getElementById('textareacomment').style.width = '192px';}else{document.getElementById('textareacomment').style.width = '460px';}document.getElementById('textareacomment').removeAttribute('style');document.getElementById('textareacomment').style.marginLeft = '20px';document.getElementById('textareacomment').style.height = '140px';document.getElementById('divsendbotton').style.display = 'inline-block';document.getElementById('sendimgcomment').style.cursor = 'pointer';applyStylesOnResize();",2100)
  }
  else{
    // error
  }
}
function comment_aff(){
  document.querySelector('.emojionearea-editor').innerHTML = '';
  var elems = document.querySelectorAll('div.emojionearea');
  elems[0].style.width = "450px";
  elems[0].style.backgroundColor = "#FFF0";
  elems[0].style.border = "none";
  elems[0].style.borderRadius = 0;
  elems[0].style.boxShadow = "none";
  elems[0].style.transition = "none";
  elems[0].style.display = "none"
  var elemstwo = document.querySelectorAll('div.emojionearea-editor');
  elemstwo[0].style.width = "410px";
  elemstwo[0].style.color = "#000";
  elemstwo[0].style.height = "136px";
  elemstwo[0].style.textAlign = "left";
  elemstwo[0].style.padding = 0;
  elemstwo[0].style.minHeight = "undefined";
  elemstwo[0].style.marginRight = 0;
  elemstwo[0].style.boxSizing = 0;
  elemstwo[0].style.paddingLeft = "25px";
  elemstwo[0].style.paddingRight = "25px";
  elemstwo[0].style.paddingTop = "14px";
  elemstwo[0].style.paddingBottom = "4px";
  elemstwo[0].style.wordWrap = "break-word";
  elemstwo[0].style.scrollbarWidth = "thin";
  document.getElementById('textareacommentelement').style.display = 'block';
  hide_comment_demand_reverse('panel-comment-demand');
}
function initilisation_comment_page(id){
	txt_art = 0;
	getnum_like(id);
	document.querySelector('.content_figure_img_comment').removeAttribute('style');
	document.querySelector('.left-part-comment-page').removeAttribute('style');
	document.getElementById('content_img_comment').removeAttribute('style');
	document.getElementById('nbr-carac-txt-comment').innerHTML = "0/255";
	loading_html('comment-content-all');
	document.getElementById('cont-btn-comment').style.display = "block";
	document.getElementById('container_img_prem_comment').style.padding = 0;
	document.getElementById('cont-btn-comment').display = 'block';
	document.getElementById('txtpubcomment').value = '';
	var nbr_img = srcimgtab[id].length;
	var elemscomment = document.querySelectorAll('#container_img_prem_comment img');
	elemscomment[0].removeAttribute('style');
	elemscomment[1].removeAttribute('style');
	elemscomment[2].removeAttribute('style');
	elemscomment[3].removeAttribute('style');
	elemscomment[0].style.animation = "animation: 1.5s shine linear infinite;";
	elemscomment[1].style.animation = "animation: 1.5s shine linear infinite;";
	elemscomment[2].style.animation = "animation: 1.5s shine linear infinite;";
	elemscomment[3].style.animation = "animation: 1.5s shine linear infinite;";
	var httpRequest = getHttpRequest();
	var tmp_code_pub = tab_pub[id];
	var txtofart = document.getElementById(id).title;
	if (window.matchMedia("(max-width: 430px)").matches){
		document.getElementById('textareacommentelement').style.paddingTop = '15px';
		document.getElementById('textareacommentelement').style.width = '190px';
	}
	document.getElementById('txtpubcomment').innerHTML = txtofart;
	document.getElementById('click_comment_slide_left').setAttribute('onclick',"slidePrecedente('img.imgcomment'," + nbr_img + ",'imgcomment');");
	document.getElementById('click_comment_slide_right').setAttribute('onclick',"slideSuivante('img.imgcomment'," + nbr_img + ",'imgcomment');");
	document.getElementById('sendimgcomment').setAttribute('onclick',"send_comment('" + tmp_code_pub + "');");
	httpRequest.onreadystatechange = function () {
		if (httpRequest.readyState === 4){
		  	if ((httpRequest.responseText != 'erreur1') || (httpRequest.responseText != 'erreur2')){
		    	if (httpRequest.responseText != null){
		      		document.getElementById('comment-content-all').innerHTML = httpRequest.responseText;
		    	}
		  	}
		}  
	}
	httpRequest.open('POST', 'includes/comment-dmd.php', true)
	httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
	httpRequest.overrideMimeType("text/plain")
	httpRequest.send("tmp_code_pub=" + encodeURIComponent(tmp_code_pub))
	if(nbr_img == 1){
		nbslide_live = 0;
		document.getElementById('cont-btn-comment').style.display = "none";
		elemscomment[1].style.display = "none";
		elemscomment[2].style.display = "none";
		elemscomment[3].style.display = "none";
		if (srcimgtab[id][0][0] == 1) {
			ext_img_one = "gif";
		}
		else if (srcimgtab[id][0][0] == 2) {
			ext_img_one = "jpeg";
		}
		else if (srcimgtab[id][0][0] == 3 || srcimgtab[id][0][0] == 4) {
		  	ext_img_one = "png";
		}
		var src_one = 'img_pub/' + srcimgtab[id][0][1] + '_1.' + ext_img_one;
		elemscomment[0].src = src_one;
	}
	else if(nbr_img == 2){
		nbslide_live = 1;
		elemscomment[2].style.display = "none";
		elemscomment[3].style.display = "none";
		if (srcimgtab[id][0][0] == 1) {
			ext_img_one = "gif";
		}
		else if (srcimgtab[id][0][0] == 2) {
			ext_img_one = "jpeg";
		}
		else if (srcimgtab[id][0][0] == 3 || srcimgtab[id][0][0] == 4) {
	  		ext_img_one = "png";
		}
		var src_one = 'img_pub/' + srcimgtab[id][0][1] + '_1.' + ext_img_one;
		elemscomment[0].src = src_one;
		if (srcimgtab[id][1][0] == 1) {
			ext_img_two = "gif";
		}
		else if (srcimgtab[id][1][0] == 2) {
			ext_img_two = "jpeg";
		}
		else if (srcimgtab[id][1][0] == 3 || srcimgtab[id][0][0] == 4) {
	  		ext_img_two = "png";
		}
		var src_two = 'img_pub/' + srcimgtab[id][1][1] + '_2.' + ext_img_two;
		elemscomment[1].src = src_two;
	}
	else if(nbr_img == 3){
		nbslide_live = 1;
		elemscomment[3].style.display = "none";
		if (srcimgtab[id][0][0] == 1) {
			ext_img_one = "gif";
		}
		else if (srcimgtab[id][0][0] == 2) {
			ext_img_one = "jpeg";
		}
		else if (srcimgtab[id][0][0] == 3 || srcimgtab[id][0][0] == 4) {
		  	ext_img_one = "png";
		}
		var src_one = 'img_pub/' + srcimgtab[id][0][1] + '_1.' + ext_img_one;
		elemscomment[0].src = src_one;
		if (srcimgtab[id][1][0] == 1) {
			ext_img_two = "gif";
		}
		else if (srcimgtab[id][1][0] == 2) {
			ext_img_two = "jpeg";
		}
		else if (srcimgtab[id][1][0] == 3 || srcimgtab[id][0][0] == 4) {
		  	ext_img_two = "png";
		}
		var src_two = 'img_pub/' + srcimgtab[id][1][1] + '_2.' + ext_img_two;
		elemscomment[1].src = src_two;
		if (srcimgtab[id][2][0] == 1) {
			ext_img_three = "gif";
		}
		else if (srcimgtab[id][2][0] == 2) {
			ext_img_three = "jpeg";
		}
		else if (srcimgtab[id][2][0] == 3 || srcimgtab[id][0][0] == 4) {
		  	ext_img_three = "png";
		}
		var src_three = 'img_pub/' + srcimgtab[id][2][1] + '_3.' + ext_img_three;
		elemscomment[2].src = src_three;
	}
	else if(nbr_img == 4){
		nbslide_live = 1;
		if (srcimgtab[id][0][0] == 1) {
			ext_img_one = "gif";
		}
		else if (srcimgtab[id][0][0] == 2) {
			ext_img_one = "jpeg";
		}
		else if (srcimgtab[id][0][0] == 3 || srcimgtab[id][0][0] == 4) {
		  	ext_img_one = "png";
		}
		var src_one = 'img_pub/' + srcimgtab[id][0][1] + '_1.' + ext_img_one;
		elemscomment[0].src = src_one;
		if (srcimgtab[id][1][0] == 1) {
			ext_img_two = "gif";
		}
		else if (srcimgtab[id][1][0] == 2) {
			ext_img_two = "jpeg";
		}
		else if (srcimgtab[id][1][0] == 3 || srcimgtab[id][0][0] == 4) {
		  	ext_img_two = "png";
		}
		var src_two = 'img_pub/' + srcimgtab[id][1][1] + '_2.' + ext_img_two;
		elemscomment[1].src = src_two;
		if (srcimgtab[id][2][0] == 1) {
			ext_img_three = "gif";
		}
		else if (srcimgtab[id][2][0] == 2) {
			ext_img_three = "jpeg";
		}
		else if (srcimgtab[id][2][0] == 3 || srcimgtab[id][0][0] == 4) {
		  	ext_img_three = "png";
		}
		var src_three = 'img_pub/' + srcimgtab[id][2][1] + '_3.' + ext_img_three;
		elemscomment[2].src = src_three;
		if (srcimgtab[id][3][0] == 1) {
			ext_img_four = "gif";
		}
		else if (srcimgtab[id][3][0] == 2) {
			ext_img_four = "jpeg";
		}
		else if (srcimgtab[id][3][0] == 3 || srcimgtab[id][0][0] == 4) {
		  	ext_img_four = "png";
		}
		var src_four = 'img_pub/' + srcimgtab[id][3][1] + '_4.' + ext_img_four;
		elemscomment[3].src = src_four;
	}
	else{
	// message d'erreur
	}
	if (id_user_live == id_user) {
		document.getElementById('sup_pub').setAttribute('onclick', 'suppr_art('+id+');updateDiv('+id+');hide_comment_demand_reverse("panel-comment-demand");');
		document.getElementById('mod_pub').setAttribute('onclick', 'hide_comment_demand_reverse("panel-comment-demand");modif_art('+id+')');
	}
	document.getElementById('sign_pub').setAttribute('onclick', 'hide_sign_panel('+id+');');
	image1 = document.querySelector('.slider');
	image2 = document.querySelector('.container');
	image4 = document.querySelectorAll('.img-border');
	selector = document.getElementById('cont-btn-comment');
	content = document.querySelector('.content_figure_img_comment');
	windowWidth = window.innerWidth;
	desiredWidth = 630;
	let docu = document.querySelector('.imgcomment.active');
	docu.classList.remove('active');
	let items = document.querySelectorAll('img.imgcomment');
	items[0].classList.add('active');
	if (windowWidth <= desiredWidth) {
	    image1.style.height = windowWidth + 'px';
	    image2.style.height = windowWidth + 'px';
	    image4[0].style.height = windowWidth + 'px';
	    image4[1].style.height = windowWidth + 'px';
	    image4[2].style.height = windowWidth + 'px';
	    image4[3].style.height = windowWidth + 'px';
	    content.style.height = windowWidth + 800 + 'px';	
	    if (windowWidth <= 430 && txt_art == 0) {
			selector.style.top = (415*windowWidth)/630+20 + 'px';
		}
		else{selector.style.top = (415*windowWidth)/630 + 'px';}
	}
	else{
		image1.removeAttribute('style');
	    image2.removeAttribute('style');
	    image2.style.padding = 0;
	    image4[0].removeAttribute('style');
	    image4[1].removeAttribute('style');
	    image4[2].removeAttribute('style');
	    image4[3].removeAttribute('style');
	    selector.removeAttribute('style');
	    if (nbslide_live == 1) {selector.style.display = 'block';}
	    else{selector.style.display = 'none';}
	    content.removeAttribute('style');
	}
}
function slideSuivante(content,nbSliderecup,classname){
	let items = document.querySelectorAll(content);
    let docu = document.querySelector('.'+ classname + '.active');
    if(docu.id == "slide1"){
      count = 0;
    }
    else if(docu.id == "slide2"){
      count = 1;
    }
    else if(docu.id == "slide3"){
      count = 2;
    }
    else if(docu.id == "slide4"){
      count = 3;
    }
    docu.classList.remove('active');
    if(nbSliderecup === undefined){
      nbSlide = nbSlidein;
    }
    else{
      nbSlide = nbSliderecup;
    }

    if(count < nbSlide - 1){
        count++;
    } else {
        count = 0;
    }

    items[count].classList.add('active')
}
function slidePrecedente(content,nbSliderecup,classname){
    let items = document.querySelectorAll(content);
    let docu = document.querySelector('.'+ classname + '.active');
    if(docu.id == "slide1"){
      count = 0;
    }
    else if(docu.id == "slide2"){
      count = 1;
    }
    else if(docu.id == "slide3"){
      count = 2;
    }
    else if(docu.id == "slide4"){
      count = 3;
    }
    docu.classList.remove('active');
    if(nbSliderecup === undefined){
      nbSlide = nbSlidein;
    }
    else{
      nbSlide = nbSliderecup;
    }

    if(count > 0){
        count--;
    } else {
        count = nbSlide - 1;
    }

    items[count].classList.add('active')
}
function hide_comment_demand_reverse(id){
  if (document.getElementById(id).style.display == 'none')
  {    
       document.getElementById('textareacomment').removeAttribute('style');
       document.getElementById('textareacomment').setAttribute('style', 'transition: margin-top 1s, height 1.5s, width 1s, margin-left 1s;transition-delay: 0.5s;');
       document.getElementById('divsendbotton').removeAttribute('style');
       document.getElementById('content_info_comment_aff').style.height = '620px';
       document.getElementById('textareacommentelement').style.display = 'block';
       statecomment = 0;
       document.getElementById('html').style.overflow = 'hidden';
       document.getElementById(id).style.display = 'block';
  }else{
       document.getElementById(id).style.display = 'none';
       document.getElementById('html').style.overflowY = 'scroll';
       document.getElementById('comment-content-all').innerHTML = "";
  }
}
function loading_html(id){
  var httpRequest = getHttpRequest();
  httpRequest.onreadystatechange = function () {
    if (httpRequest.readyState === 4){
      document.getElementById(id).innerHTML = httpRequest.responseText;
    }  
  }
  httpRequest.open('GET', 'includes/loader.html', true)
}
function upodatecounter(){
  a = document.querySelectorAll('#newtextareaemojione');
  b = a[0];
  c = b.innerHTML;
  d = c.replace('<div></div>', '');
  d2 = c.replace('<br>', '');
  e = d2.length;
  document.getElementById('nbr-carac-txt-comment').innerHTML = e + "/255";
}
function administrating_carac(){
  a = document.querySelectorAll('#newtextareaemojione');
  b = a[0];
  c = b.innerHTML;
  d = c.replace('<div></div>', '');
  d2 = c.replace('<br>', '');
  e = d2.length;
  if (e == 255) {
    var elems = document.querySelectorAll('div.emojionearea-editor');
    elems[0].setAttribute("contenteditable", "false");
  }
  else{
    var elems = document.querySelectorAll('div.emojionearea-editor');
    elems[0].setAttribute("contenteditable", "true");
  }
}
function send_comment(tmp_code_pub){
  document.getElementById('html').style.overflowY = 'hidden';
  var content = document.getElementById('textareacommentelement').value;
  var httpRequest = getHttpRequest();
  httpRequest.onreadystatechange = function () {
    if (httpRequest.readyState === 4){
      if ((httpRequest.responseText != 'erreur1') || (httpRequest.responseText != 'erreur2')){
        var elemstwo = document.querySelectorAll('div.emojionearea-editor');
        elemstwo[0].innerHTML = "";
        document.getElementById('nbr-carac-txt-comment').innerHTML = "0/255";
        idcountforinclude += 1;
        idrecuppost = idcountforinclude;
        let docu = document.getElementById('comment-content-all');
        let replt = document.createElement('div');
        replt.setAttribute("id", idrecuppost);
        docu.prepend(replt);
        document.getElementById(idrecuppost).innerHTML = httpRequest.responseText;
      }
    }  
  }
  httpRequest.open('POST', 'includes/comment-pgrm.php', true)
  httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  httpRequest.send("content_comment=" + encodeURIComponent(content) + "&tmp_code_pub=" + encodeURIComponent(tmp_code_pub) + "&user=" + encodeURIComponent(id_user_live))
  document.getElementById('annimation_loader').style.display = 'none';
}
function applyStylesOnResize() {
  if (window.matchMedia("(max-width: 630px)").matches) {
  	textareaComment = document.getElementById("textareacomment");
    textareaComment.style.width = "290px";
    textareaComment.style.marginLeft = "2px";
    if (document.querySelector(".emojionearea")) {
    	emojionearea = document.querySelector(".emojionearea");
    	emojionearea.style.width = "280px";
    }
    if (document.getElementById("newtextareaemojione")) {
    	newTextareaEmojione = document.getElementById("newtextareaemojione");
    	newTextareaEmojione.style.width = "270px";
    }
  }
  else{
  	textareaComment = document.getElementById("textareacomment");
    textareaComment.style.width = "460px";
    textareaComment.style.marginLeft = "20px";
    if (document.querySelector(".emojionearea")) {
    	emojionearea = document.querySelector(".emojionearea");
    	emojionearea.style.width = "450px";
    }
    if (document.getElementById("newtextareaemojione")) {
    	newTextareaEmojione = document.getElementById("newtextareaemojione");
    	newTextareaEmojione.style.width = "410px";
    }
  }
  if (window.matchMedia("(max-width: 430px)").matches){
  	textareaComment = document.getElementById("textareacomment");
    textareaComment.style.width = "192px";
    textareaComment.style.marginLeft = "2px";
    if (document.querySelector(".emojionearea")) {
    	emojionearea = document.querySelector(".emojionearea");
    	emojionearea.style.width = "182px";
    }
    if (document.getElementById("newtextareaemojione")) {
    	newTextareaEmojione = document.getElementById("newtextareaemojione");
    	newTextareaEmojione.style.width = "172px";
    }
  }
}
window.addEventListener('resize', function() {
	 applyStylesOnResize();
});
function suppr_art(id){
	if (id_user_live == id_user) {
		var httpRequest = getHttpRequest();
		httpRequest.onreadystatechange = function () {
		    var a = httpRequest;
	      	if (httpRequest.readyState === 4){
	           	if (txt_art==1) {
	           		div_txt = document.querySelectorAll('div.aff_pub_div_content');
	           		for (var i = 0; i < div_txt.length; i++) {
					  	currentDiv = div_txt[i];
					  	if (currentDiv.id == id) {
					  		var start_txt = i;
					    	break;
					  	}
					}
	           		for (var i = start_txt+1; i < div_txt.length; i++) {
	           			if (div_txt[i].classList.contains("art_txt_dbt")){
	           				div_txt[i].classList.remove("art_txt_dbt");
							div_txt[i].classList.add("art_txt_fns");
	           			}
	           			if (div_txt[i].classList.contains("art_txt_fns")){
	           				div_txt[i].classList.remove("art_txt_fns");
							div_txt[i].classList.add("art_txt_dbt");
	           			}
	           		}
	           		document.getElementById(id).remove();
	           	}
	     	}  
		}
		httpRequest.open('POST', 'includes/suprr_article.php', true)
		httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
		httpRequest.send("id=" + encodeURIComponent(id) + "&user=" + encodeURIComponent(id_user_live))
	}
}
function updateDiv(id) {
	if (id_user_live == id_user) {
	  	elementsToRemove = document.querySelectorAll("div[id='"+id+"']");
			elementsToRemove.forEach(element => element.remove());
	  
	  	contentDiv_a = document.querySelector('.content_art.nonSelectionnable.vers_art_content_one');
		brTags_a = contentDiv_a.querySelectorAll('br');
		brTags_a.forEach(br => {
		  br.remove();
		});

		contentDiv_b = document.querySelector('.content_art.nonSelectionnable.vers_art_content_two');
		brTags_b = contentDiv_b.querySelectorAll('br');
		brTags_b.forEach(br => {
		  br.remove();
		});

		contentDiv_c = document.querySelector('.content_art.nonSelectionnable.vers_art_content_three');
		brTags_c = contentDiv_c.querySelectorAll('br');
		brTags_c.forEach(br => {
		  br.remove();
		});

		allDivs_a = contentDiv_a.querySelectorAll('div.artgeneral');

		allDivs_b = contentDiv_b.querySelectorAll('div.artgeneral');

		allDivs_c = contentDiv_c.querySelectorAll('div.artgeneral');


		pattern_a_a = [
		    'artprep zoom_art_prep_prime prime_art zoom_art_general artgeneral',
		    'artsuite zoom_art zoom_art_general artgeneral',
		    'artsuite zoom_art zoom_art_general artgeneral',
		    'artsuite zoom_art zoom_art_general artgeneral',
		    'artsuite zoom_art zoom_art_general artgeneral'
		];
		pattern_a_b = [
		    'artprep zoom_art_prep zoom_art_general artgeneral',
		    'artsuite zoom_art zoom_art_general artgeneral',
		    'artsuite zoom_art zoom_art_general artgeneral',
		    'artsuite zoom_art zoom_art_general artgeneral',
		    'artsuite zoom_art zoom_art_general artgeneral'
		];

		pattern_b_a = [
		    'artprep zoom_art_prep_prime prime_art zoom_art_general artgeneral',
		    'artsuite zoom_art zoom_art_general artgeneral',
		    'artsuite zoom_art zoom_art_general artgeneral',
		    'artsuite zoom_art zoom_art_general artgeneral'
		];
		pattern_b_b = [
		    'artprep zoom_art_prep zoom_art_general artgeneral',
		    'artsuite zoom_art zoom_art_general artgeneral',
		    'artsuite zoom_art zoom_art_general artgeneral',
		    'artsuite zoom_art zoom_art_general artgeneral'
		];

		pattern_c_a = [
		    'artprep zoom_art_prep_prime prime_art zoom_art_general artgeneral',
		    'artsuite zoom_art zoom_art_general artgeneral',
		    'artsuite zoom_art zoom_art_general artgeneral'
		];
		pattern_c_b = [
		    'artprep zoom_art_prep zoom_art_general artgeneral',
		    'artsuite zoom_art zoom_art_general artgeneral',
		    'artsuite zoom_art zoom_art_general artgeneral'
		];

		for (let i = 0; i < allDivs_a.length; i++) {
		    div = allDivs_a[i];
		    if (i <= 4) {
		    	newClass = pattern_a_a[i];
		    	div.className = newClass;
		    	if (i == 4) {
		    		div.insertAdjacentHTML('afterend', '<br>');
		    	}
		    }
		    else{
		    	patternIndex = i % pattern_a_b.length;
			    newClass = pattern_a_b[patternIndex];
			    div.className = newClass;
			    if (patternIndex == 4) {
			      	div.insertAdjacentHTML('afterend', '<br>');
			    }
		    }
		}
		for (let i = 0; i < allDivs_b.length; i++) {
		    div = allDivs_b[i];
		    if (i <= 3) {
		    	newClass = pattern_b_a[i];
		    	div.className = newClass;
		    	if (i == 3) {
		    		div.insertAdjacentHTML('afterend', '<br>');
		    	}
		    }
		    else{
		    	patternIndex = i % pattern_b_b.length;
			    newClass = pattern_b_b[patternIndex];
			    div.className = newClass;
			    if (patternIndex == 3) {
			      	div.insertAdjacentHTML('afterend', '<br>');
			    }
		    }
		}

		for (let i = 0; i < allDivs_c.length; i++) {
		    div = allDivs_c[i];
		    if (i <= 2) {
		    	newClass = pattern_c_a[i];
		    	div.className = newClass;
		    	if (i == 2) {
		    		div.insertAdjacentHTML('afterend', '<br>');
		    	}
		    }
		    else{
		    	patternIndex = i % pattern_c_b.length;
			    newClass = pattern_c_b[patternIndex];
			    div.className = newClass;
			    if (patternIndex == 2) {
			      	div.insertAdjacentHTML('afterend', '<br>');
			    }
		    }
		}
	}
}
function modif_art(id){
	if (id_user_live == id_user) {
		if (emjione_textform_stat != 1) {
	        elemsemojionetxtform();
	        emjione_textform_stat = 1;
	    }
		document.getElementById('html').style.overflowY = 'hidden';
		var httpRequest = getHttpRequest();
		httpRequest.onreadystatechange = function () {
	        var a = httpRequest;
	        if (httpRequest.readyState === 2){
	            if (emjione_textform_stat != 1) {
	               elemsemojionetxtform();
	               emjione_textform_stat = 1;
	            }
	            document.getElementById('content_text_area_txt-panel').style.display = 'none';
	        }
	        if (httpRequest.readyState === 4){
	            response = httpRequest.responseText;
	            response = response.replace(/\n/g, "<div></div>");
	            document.getElementById('emojionearea-editor-txt-editor').innerHTML = response;
	            document.getElementById('content_text_area_txt-panel').style.display = 'block';
	            document.getElementById('panel-txt').style.display = 'block';
	            document.getElementById('submit').setAttribute('onclick', 'modif_art_process_initialisation('+id+');')
	        }  
		}
		httpRequest.open('POST', 'includes/modif_initialisation.php', true)
		httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
		httpRequest.overrideMimeType("text/plain")
		httpRequest.send("id=" + encodeURIComponent(id))
	}
}
function modif_proce_art(id,content){
	if (id_user_live == id_user) {
	    var httpRequest = getHttpRequest()
	     httpRequest.onreadystatechange = function () {
	          var a = httpRequest;
	          if (httpRequest.readyState === 2){
	               document.getElementById('panel-txt').style.display = 'none';
	               document.getElementById('html').style.overflowY = 'hidden';
	          } 
	          if (httpRequest.readyState === 4){
	               document.getElementById('html').style.overflowY = 'scroll';
	               if (txt_art == 0) {document.getElementById(id).title = supprimerBalisesHTML(httpRequest.responseText);}
	               else if(txt_art == 1){document.getElementById('p-'+id).innerHTML = supprimerBalisesHTML(httpRequest.responseText);}
	          }  
	     }
	     httpRequest.open('POST', 'includes/modif_procedure.php', true)
	     httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
	     httpRequest.overrideMimeType("text/plain")
	     httpRequest.send("content_publication=" + encodeURIComponent(content) + "&id=" + encodeURIComponent(id))
 	}
}
function modif_art_process_initialisation(idpub){
  var content = document.getElementById('textareatext').value;
  modif_proce_art(idpub,content);
}
function hide_txt_panel_reverse(){
	if (id_user_live == id_user) {
		if (document.querySelector('.sign_page').style.display == 'block'){
	  	document.getElementById('content_text_area_txt-panel').style.display = 'block';
	  	document.querySelector('.sign_page').style.display = 'none';
	  	document.getElementById('submit').value = 'Publier';
	  	let checkedBoxes = document.querySelectorAll('input[type="checkbox"].searchcheck:checked');
		checkedBoxes.forEach(function(box) {
		  box.checked = false;
		});
		document.querySelector('.textarea_sign').value = '';
		document.querySelector('.cross_edit').setAttribute('onclick', 'hide_txt_panel_reverse();');
	  }
	  if (document.getElementById('panel-txt').style.display == 'block'){
	    document.getElementById('panel-txt').style.display = 'none';
	    document.getElementById('html').style.overflowY = 'scroll';
	  }
	}
	else if(buttclik == 1){
		if (document.querySelector('.sign_page').style.display == 'block'){
	  	document.getElementById('content_text_area_txt-panel').style.display = 'block';
	  	document.querySelector('.sign_page').style.display = 'none';
	  	document.getElementById('submit').value = 'Publier';
	  	let checkedBoxes = document.querySelectorAll('input[type="checkbox"].searchcheck:checked');
		checkedBoxes.forEach(function(box) {
		  box.checked = false;
		});
		document.querySelector('.textarea_sign').value = '';
		buttclik = 0;
	  }
	  if (document.getElementById('panel-txt').style.display == 'block'){
	    document.getElementById('panel-txt').style.display = 'none';
	    document.getElementById('html').style.overflowY = 'scroll';
	  }
	}
}
function elemsemojionetxtform(){
  var elemsemojione = document.querySelectorAll('div.emojionearea-editor');
  elemsemojione[1].setAttribute('id','emojionearea-editor-txt-editor');
  elemsemojione[1].style.color = "black";
  var elemsemojionepanel = document.querySelectorAll('div.emojionearea');
  elemsemojionepanel[1].style.display = 'block';
}
function supprimerBalisesHTML(str) {
  return str.replace(/<[^>]*>/g, '');
}
function hide_sign_panel(id){
	if (document.querySelector('.sign_page').style.display == 'none' || document.querySelector('.sign_page').style.display == '') {
		hide_comment_demand_reverse("panel-comment-demand");
		document.getElementById("html").style.overflowY = "hidden";
		document.getElementById("panel-txt").style.display = "block";
		document.getElementById('content_text_area_txt-panel').style.display = 'none';
		document.querySelector('.sign_page').style.display = 'block';
		document.getElementById('submit').value = 'Signaler';
		document.getElementById('submit').setAttribute('onclick', 'send_sign('+id+');')
		buttclik = 1;
	}
}
function onCheckboxClicksign(event){
	let values = [];
  	let checkboxes = document.querySelectorAll('input[type="checkbox"].searchcheck');
	for(let i = 0; i < checkboxes.length; i++) {
	  if (checkboxes[i].checked) {
	  	values.push(1);
	  }
	  else{
	  	values.push(0);
	  }
	}
	return values
}
function send_sign(id){
	val = [...onCheckboxClicksign()];
	text = document.querySelector('.textarea_sign').value;
	if (text !== '') {
		var httpRequest = getHttpRequest();
	    httpRequest.onreadystatechange = function () {
	        if (httpRequest.readyState === 4){
	        	document.getElementById('submit').style.display = 'none';
	        	document.querySelector('.sign_page').style.display = 'none';
	            document.querySelector('.mess_sign').style.display = 'block';
	            setTimeout("hide_txt_panel_reverse();document.getElementById('submit').style.display = 'block';document.querySelector('.mess_sign').style.display = 'none';",3000)
	        }  
	    }
	    httpRequest.open('POST', 'includes/signal.php', true)
	    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
	    httpRequest.send("user=" + encodeURIComponent(id_user) + "&object=" + encodeURIComponent('[pub]'+ id) + "&sign=" + encodeURIComponent(JSON.stringify(val)) + "&text=" + encodeURIComponent(text))
	}
}
function subcribe(){
	var httpRequest = getHttpRequest();
    httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState === 4){
        	document.getElementById('sub_butt').style.display = 'none';
        	document.getElementById('unsub_butt').style.display = 'inline-block';
        }  
    }
    httpRequest.open('POST', 'includes/sub.php', true)
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    httpRequest.send("user=" + encodeURIComponent(id_user_live) + "&id=" + encodeURIComponent(id_user) + '&config=' + encodeURIComponent(1))
}
function decribe() {
	var httpRequest = getHttpRequest();
    httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState === 4){
        	document.getElementById('unsub_butt').style.display = 'none';
        	document.getElementById('sub_butt').style.display = 'inline-block';
        }  
    }
    httpRequest.open('POST', 'includes/sub.php', true)
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    httpRequest.send("user=" + encodeURIComponent(id_user_live) + "&id=" + encodeURIComponent(id_user) + '&config=' + encodeURIComponent(2))
}
function get_sub(){
	document.getElementById('content_text_area_txt-panel').style.display = "none";
	document.querySelector('#formtextpub br').style.display = "none";
	document.querySelector('.input_txt_area').style.display = "none";
	document.querySelector('.mess_sub_div').style.display = "block";
	document.getElementById("html").style.overflowY = "hidden";
	var httpRequest = getHttpRequest();
    httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState === 4){
        	if (httpRequest.responseText !== '') {
			    dataJSON_search = JSON.parse(httpRequest.responseText);
			    count_search = dataJSON_search.length;
			    resultDiv = document.querySelector('.mess_sub');
			    resultDiv.innerHTML = '';
			    for (let i = 0; i < count_search; i++) {
			    	morn = i+8;
			    	if (dataJSON_search[i]['state'] == 1) {colorspan = '#699f15';}
			    	else if (dataJSON_search[i]['state'] == 0) {colorspan = '#000';}
			    	tr = document.createElement('tr');
			    	tr.className = 'tr_research';
			    	tr.id = dataJSON_search[i]['code'];
			    	tr.innerHTML = '<div class="checkbox-wrapper-4"><input class="inp-cbx searchcheck get_sub" id="morning-'+morn+'" type="checkbox" value="'+dataJSON_search[i]['code']+'"/><label class="cbx" for="morning-'+morn+'" style="display:block;"><span><svg class="svg_sign"><use xlink:href="#check-4"></use></svg></span><span style="color:'+colorspan+'" class="span_sign" onclick="window.location.href = \'http://localhost/'+dataJSON_search[i]['pseudo']+'\';">'+dataJSON_search[i]['pseudo']+'</span></label><svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg></div><br>'
			    	resultDiv.appendChild(tr);
			    }
			    if (id_user_live == id_user) {
			    	document.getElementById('span_sub').innerHTML = 'Vos abonnées';
			    	checkboxes = document.querySelectorAll('input.get_sub');
					for(let i = 0; i < checkboxes.length; i++){
					  checkboxes[i].addEventListener('click', onCheckboxClick);
					}
				}
			    else{
			    	pseudo_span = document.getElementById('span_profile_name').innerHTML;
			    	document.getElementById('span_sub').innerHTML = 'Les abonnées de ' + pseudo_span;
			    }
			    document.getElementById('cross_remove_txt_panel').setAttribute("onclick", "hide_get_sub_panel();");
			    document.getElementById('panel-txt').style.display = "block";
			}
        }  
    }
    httpRequest.open('POST', 'includes/get_sub.php', true)
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    httpRequest.overrideMimeType("text/plain")
    httpRequest.send("id=" + encodeURIComponent(id_user))
}
function hide_get_sub_panel(){
	document.getElementById('panel-txt').style.display = "none";
	document.getElementById('content_text_area_txt-panel').style.display = "";
	document.querySelector('#formtextpub br').style.display = "";
	document.querySelector('.input_txt_area').style.display = "";
	document.querySelector('.mess_sub_div').style.display = "";
	document.getElementById("html").style.overflowY = "";
	document.getElementById('cross_remove_txt_panel').setAttribute("onclick" , "hide_txt_panel_reverse();");
}
function getCookie(name) {
  const cookieString = decodeURIComponent(document.cookie);
  const cookies = cookieString.split(';');
  
  for (let i = 0; i < cookies.length; i++) {
    const cookie = cookies[i].trim();
    if (cookie.startsWith(name + '=')) {
      return cookie.substring(name.length + 1);
    }
  }
  return '';
}
function ban_sub(){
	let values = [];
  	let checkboxes = document.querySelectorAll('input.get_sub:checked');
	for(let i = 0; i < checkboxes.length; i++) {
	  values.push(checkboxes[i].value);
	}
	var httpRequest = getHttpRequest();
    httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState === 4){
		   	for (var i = 0; i < values.length; i++) {
		   		document.getElementById(values[i]).remove();
		   	}
        }  
    }
    httpRequest.open('POST', 'includes/ban_sub.php', true)
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    httpRequest.overrideMimeType("text/plain")
    httpRequest.send("id=" + encodeURIComponent(id_user) + "&values=" + encodeURIComponent(JSON.stringify(values)))
}
function friend_sub(it){
	let values = [];
  	let checkboxes = document.querySelectorAll('input.get_sub:checked');
	for(let i = 0; i < checkboxes.length; i++) {
	  values.push(checkboxes[i].value);
	}
	var httpRequest = getHttpRequest();
    httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState === 4){
        	if (it == 1) {
        		for (var i = 0; i < checkboxes.length; i++) {
					id_check = checkboxes[i].id;
					elem_check = document.querySelector('label[for="'+id_check+'"] span.span_sign');
					elem_check.style.color = '#699f15';
				}
        	}
        	else if (it == 2) {
				for (var i = 0; i < checkboxes.length; i++) {
					id_check = checkboxes[i].id;
					elem_check = document.querySelector('label[for="'+id_check+'"] span.span_sign');
					elem_check.style.color = '#000';
				}
        	}
        	onCheckboxClick();
        }  
    }
    httpRequest.open('POST', 'includes/friend_sub.php', true)
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    httpRequest.overrideMimeType("text/plain")
    httpRequest.send("id=" + encodeURIComponent(id_user) + "&values=" + encodeURIComponent(JSON.stringify(values)) + "&it=" + encodeURIComponent(it))
}
function onCheckboxClick(){
	let checkboxes = document.querySelectorAll('input.get_sub:checked');
	colored_check = 0;
	uncolored_check = 0;
	for (var i = 0; i < checkboxes.length; i++) {
		id_check = checkboxes[i].id;
		elem_check = document.querySelector('label[for="'+id_check+'"] span.span_sign');
		if (elem_check.style.color == "#699f15" || elem_check.style.color == "rgb(105, 159, 21)") {
			colored_check = 1;
		}
		else{
			uncolored_check = 1;
		}
	}
	if (colored_check == 1 && uncolored_check == 0) {
		elem = document.querySelectorAll('.butt_sub');
		elem[0].style.display = "inline";
		elem[1].style.display = "none";
		elem[2].style.display = "inline";
	}
	else if (colored_check == 0 && uncolored_check == 1) {
		elem = document.querySelectorAll('.butt_sub');
		elem[0].style.display = "inline";
		elem[1].style.display = "inline";
		elem[2].style.display = "none";
	}
	else if (colored_check == 1 && uncolored_check == 1) {
		elem = document.querySelectorAll('.butt_sub');
		elem[0].style.display = "inline";
		elem[1].style.display = "none";
		elem[2].style.display = "none";
	}
	else{
		elem = document.querySelectorAll('.butt_sub');
		elem[0].style.display = "none";
		elem[1].style.display = "none";
		elem[2].style.display = "none";
	}
}
function friend_submit(it){
	var httpRequest = getHttpRequest();
	httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState === 4){
        	if (it == 1) {
        		document.querySelector('.span_button_joinfriend').innerHTML = "Retirer des amis";
        		document.querySelector('.div_content_button_joinfriend').setAttribute("onclick", "defriend_submit()");
        	}
        	else if (it == 2) {
        		document.querySelector('.span_button_joinfriend').innerHTML = "Ajouter aux amis";
        		document.querySelector('.div_content_button_joinfriend').setAttribute("onclick", "friend_submit()");
        	}
        }  
    }
    httpRequest.open('POST', 'includes/friend_submit.php', true)
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    httpRequest.overrideMimeType("text/plain")
    httpRequest.send("id=" + encodeURIComponent(id_user_live) + "&user=" + encodeURIComponent(id_user) + "&it=" + encodeURIComponent(it))
}
window.addEventListener('resize', function() {
	image1 = document.querySelector('.slider');
	image2 = document.querySelector('.container');
	image4 = document.querySelectorAll('.img-border');
	selector = document.getElementById('cont-btn-comment');
	content = document.querySelector('.content_figure_img_comment');
	windowWidth = window.innerWidth;
	desiredWidth = 630;
	if (windowWidth <= desiredWidth && txt_art == 0) {
	    image1.style.height = windowWidth + 'px';
	    image2.style.height = windowWidth + 'px';
	    image4[0].style.height = windowWidth + 'px';
	    image4[1].style.height = windowWidth + 'px';
	    image4[2].style.height = windowWidth + 'px';
	    image4[3].style.height = windowWidth + 'px';
	    selector.style.top = (415*windowWidth)/630 + 'px';
	    content.style.height = windowWidth + 800 + 'px';
	    if (windowWidth <= 430 && txt_art == 0) {
			selector.style.top = (415*windowWidth)/630+20 + 'px';
		}
		else{selector.style.top = (415*windowWidth)/630 + 'px';}	
	}
	else{
		image1.removeAttribute('style');
	    image2.removeAttribute('style');
	    image2.style.padding = 0;
	    image4[0].removeAttribute('style');
	    image4[1].removeAttribute('style');
	    image4[2].removeAttribute('style');
	    image4[3].removeAttribute('style');
	    selector.removeAttribute('style');
	    if (nbslide_live == 1) {selector.style.display = 'block';}
	    else{selector.style.display = 'none';}
	    content.removeAttribute('style');
	}
});
function comment_txt(id){
	document.getElementById('nbr-carac-txt-comment').innerHTML = "0/255";
	loading_html('comment-content-all');
	document.getElementById('cont-btn-comment').style.display = "block";
	document.getElementById('container_img_prem_comment').style.padding = 0;
	document.getElementById('cont-btn-comment').display = 'block';
	document.getElementById('txtpubcomment').value = '';
	elemscomment = document.querySelectorAll('#container_img_prem_comment img');
	tmp_code_pub = tab_pub[id];
	elemscomment[0].removeAttribute('style');
	elemscomment[1].removeAttribute('style');
	elemscomment[2].removeAttribute('style');
	elemscomment[3].removeAttribute('style');
	elemscomment[0].style.animation = "animation: 1.5s shine linear infinite;";
	elemscomment[1].style.animation = "animation: 1.5s shine linear infinite;";
	elemscomment[2].style.animation = "animation: 1.5s shine linear infinite;";
	elemscomment[3].style.animation = "animation: 1.5s shine linear infinite;";
	var httpRequest = getHttpRequest();
	var txtofart = document.getElementById('p-'+id).innerHTML;
	if (window.matchMedia("(max-width: 430px)").matches){
		document.getElementById('textareacommentelement').style.paddingTop = '15px';
		document.getElementById('textareacommentelement').style.width = '190px';
	}
	document.getElementById('txtpubcomment').innerHTML = txtofart;
	document.getElementById('sendimgcomment').setAttribute('onclick',"send_comment('" + tmp_code_pub + "');");
	httpRequest.onreadystatechange = function () {
		if (httpRequest.readyState === 4){
		  	if ((httpRequest.responseText != 'erreur1') || (httpRequest.responseText != 'erreur2')){
		    	if (httpRequest.responseText != null){
		      		document.getElementById('comment-content-all').innerHTML = httpRequest.responseText;
		    	}
		  	}
		}  
	}
	httpRequest.open('POST', 'includes/comment-dmd.php', true)
	httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
	httpRequest.overrideMimeType("text/plain")
	httpRequest.send("tmp_code_pub=" + encodeURIComponent(tmp_code_pub))
	if (id_user_live == id_user) {
		document.getElementById('sup_pub').setAttribute('onclick', 'suppr_art('+id+');hide_comment_demand_reverse("panel-comment-demand");');
		document.getElementById('mod_pub').setAttribute('onclick', 'hide_comment_demand_reverse("panel-comment-demand");modif_art('+id+')');
	}
	document.getElementById('sign_pub').setAttribute('onclick', 'hide_sign_panel('+id+');');
	image1 = document.querySelector('.slider');
	image2 = document.querySelector('.container');
	image4 = document.querySelectorAll('.img-border');
	selector = document.getElementById('cont-btn-comment');
	content = document.querySelector('.content_figure_img_comment');
	windowWidth = window.innerWidth;
	desiredWidth = 630;
	let docu = document.querySelector('.imgcomment.active');
	docu.classList.remove('active');
	let items = document.querySelectorAll('img.imgcomment');
	items[0].classList.add('active');
	if (windowWidth <= desiredWidth) {
	    image1.style.height = windowWidth + 'px';
	    image2.style.height = windowWidth + 'px';
	    image4[0].style.height = windowWidth + 'px';
	    image4[1].style.height = windowWidth + 'px';
	    image4[2].style.height = windowWidth + 'px';
	    image4[3].style.height = windowWidth + 'px';
	    selector.style.top = (415*windowWidth)/630 + 'px';
	    content.style.height = windowWidth + 800 + 'px';	
	}
	else{
		image1.removeAttribute('style');
	    image2.removeAttribute('style');
	    image2.style.padding = 0;
	    image4[0].removeAttribute('style');
	    image4[1].removeAttribute('style');
	    image4[2].removeAttribute('style');
	    image4[3].removeAttribute('style');
	    selector.removeAttribute('style');
	    if (nbslide_live == 1) {selector.style.display = 'block';}
	    else{selector.style.display = 'none';}
	    content.removeAttribute('style');
	}
	document.getElementById('content_img_comment').style.display = 'none';
	txt_art = 1;
	windowWidth = window.innerWidth;
	if (txt_art == 1 && windowWidth >= 1430) {
		content_all = document.querySelector('.content_figure_img_comment');
		content_all.style.marginLeft = ((windowWidth-600)/2)-10 + 'px';
	}
	if (txt_art == 1 && windowWidth >= 830) {
		content_all = document.querySelector('.content_figure_img_comment');
		content_all.style.width = '600px';
	}
	if (txt_art == 1) {
		document.querySelector('.left-part-comment-page').style.marginLeft = 0;
	}
	if (txt_art == 1 && windowWidth <= 1430 && windowWidth > 830) {
		content_all = document.querySelector('.content_figure_img_comment');
		content_all.style.marginTop = '-200px';
	}
	if (txt_art == 1 && windowWidth <= 1430) {
		content_all = document.querySelector('.content_figure_img_comment');
		content_all.style.height = '800px';
	}
	if (txt_art == 1 && windowWidth <= 630) {
		content_all = document.querySelector('.left-part-comment-page');
		content_all.removeAttribute('style');
	}
}
window.addEventListener('resize', function() {
	windowWidth = window.innerWidth;
	if (txt_art == 1 && windowWidth >= 1430) {
		content_all = document.querySelector('.content_figure_img_comment');
		content_all.style.marginLeft = ((windowWidth-600)/2)-10 + 'px';
	}
	if (txt_art == 1 && windowWidth >= 830) {
		content_all = document.querySelector('.content_figure_img_comment');
		content_all.style.width = '600px';
	}
	if (txt_art == 1) {
		document.querySelector('.left-part-comment-page').style.marginLeft = 0;
	}
	if (txt_art == 1 && windowWidth <= 1430 && windowWidth > 830) {
		content_all = document.querySelector('.content_figure_img_comment');
		content_all.style.marginTop = '-200px';
	}
	if (txt_art == 1 && windowWidth <= 1430) {
		content_all = document.querySelector('.content_figure_img_comment');
		content_all.style.height = '800px';
	}
	if (txt_art == 1 && windowWidth <= 630) {
		content_all = document.querySelector('.left-part-comment-page');
		content_all.removeAttribute('style');
	}
});
if (id_user_live != id_user) {
	document.getElementById('sign_pub').style.marginLeft = 0;
}
function like_db(id){
  	var httpRequest = getHttpRequest()
    httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState === 4){
            if (txt_art == 0) {
	        	if (httpRequest.responseText == "envoyer"){
	                document.getElementById('like-div-aff').style.fill = 'red';
	                var likenum = document.getElementById('cc_pub').innerHTML;
	                likenum = parseInt(likenum);
	                likenum += 1
	                document.getElementById('cc_pub').innerHTML = likenum; 
	            }
	            else if(httpRequest.responseText == "supprimer"){
	                document.getElementById('like-div-aff').style.fill = 'white';
	                var likenum = document.getElementById('cc_pub').innerHTML;
	                likenum = parseInt(likenum);
	                likenum = likenum - 1;
	                document.getElementById('cc_pub').innerHTML = likenum; 
	             }
	          	else{
	            	// message d'erreur
	          	}
	        }
            else if (txt_art == 1){
            	if (httpRequest.responseText == "envoyer"){
	                like_svg = document.querySelectorAll('#like-div-' + id);
	                for (var i = 0; i < like_svg.length; i++) {
	                	like_svg[i].style.fill = 'red';
	                }
	                var likenum = document.getElementById('likepart-'+ id).innerHTML;
	                likenum = parseInt(likenum);
	                likenum += 1;
	                like_num = document.querySelectorAll('#likepart-' + id);
	                for (var i = 0; i < like_num.length; i++) {
	                	like_num[i].innerHTML = likenum;
	                }
	            }
	            else if(httpRequest.responseText == "supprimer"){
	                like_svg = document.querySelectorAll('#like-div-' + id);
	                for (var i = 0; i < like_svg.length; i++) {
	                	like_svg[i].style.fill = 'white';
	                }
	                var likenum = document.getElementById('likepart-'+ id).innerHTML;
	                likenum = parseInt(likenum);
	                likenum = likenum - 1;
	                like_num = document.querySelectorAll('#likepart-' + id);
	                for (var i = 0; i < like_num.length; i++) {
	                	like_num[i].innerHTML = likenum; 
	                }
	             }
	          	else{
	            	// message d'erreur
	          	}
	          	txt_art = 0;
            }
        }
     }
     httpRequest.open('POST', 'includes/like-pgrm.php', true)
     httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
     httpRequest.overrideMimeType("text/plain")
     httpRequest.send("user=" + encodeURIComponent(id_user_live) + "&pub=" + encodeURIComponent(tab_pub[id]))
}
function getnum_like(id){
	var httpRequest = getHttpRequest()
    httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState === 4){
            data = JSON.parse(httpRequest.responseText);
            if (data['yn'] == 1){
	            document.getElementById('like-div-aff').style.fill = 'red';
	            var likenum = data['num'];
	            document.getElementById('cc_pub').innerHTML = likenum; 
	        }
	        else if(data['yn'] == 0){
	            document.getElementById('like-div-aff').style.fill = 'white';
	           	var likenum = data['num'];
	            document.getElementById('cc_pub').innerHTML = likenum;
            }
          	else{
            	// message d'erreur
          	}
          	document.getElementById('path_pub_img').setAttribute('onclick', 'like_db('+id+')');  
        }  
    }
    httpRequest.open('POST', 'includes/get_number_like.php', true)
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    httpRequest.overrideMimeType("text/plain")
    httpRequest.send("user=" + encodeURIComponent(id_user_live) + "&pub=" + encodeURIComponent(tab_pub[id]))
}
window.onload = function() {
	document.getElementById('annimation_loader').style.display = 'none';
	document.getElementById('content_all').removeAttribute('style');
	document.getElementById('content_all').style.marginTop = '60px';
	navBar = document.querySelector('.nav_bar');
	navBar.removeAttribute('style');
	navBar.style.position = 'fixed';
  navBar.style.zIndex = 10000;
	$('document').ready(function () {
		trigger = $('.hamburger-nav');
		isClosednav = false;
		trigger.click(function () {
		  burgerTimenav();
		  start_menu_nav();
		  if (clickburg == 0) {
		  	document.documentElement.style.overflow = "hidden";clickburg = 1;
		  }else{
		  	document.documentElement.style.overflow = "auto";clickburg = 0;
		  }
		})
	})
	window.addEventListener('resize', function() {
		ham_linav();
	});
	ham_linav();
};