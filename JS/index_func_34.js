// ############################################Default_Values############################################
var count,numberfile,ContentType,ContentTypetwo,ContentTypethree,ContentTypefour,type_size_img_one,type_size_img_two,type_size_img_three,type_size_img_four,mode_crop,nbr_dcd,scr_save_one,scr_save_two,scr_save_three,scr_save_four,signal_element,isClosed_index,selhone,selhtwo,selhthree,selhfour,stateinputcropone,stateinputcroptwo,stateinputcropthree,stateinputcropfour,nbcropimagedelete,numOfFiles,ContentTypeone_crop,ContentTypetwo_crop,ContentTypethree_crop,ContentTypefour_crop;
var idcountforinclude = 1412672762415415641;
var nbSlidein = 0;
var statecomment = 0;
var loading = document.getElementById('contain_animmation');
var emjione_textform_stat = 0;
var cropperactive = false;
var clickburg = 0;
var clickburg_index = 0;
// ############################################Mother_Function############################################
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
// ############################################Initialisation############################################
function dmd_art(){
  var httpRequest = getHttpRequest();
  httpRequest.onreadystatechange = function () {
    if (httpRequest.readyState === 4){
      document.getElementById('annimation_loader').style.display = 'none';
      document.getElementById('aff_pub').innerHTML = httpRequest.responseText;
      updateDivHeights();
    }  
  }
  httpRequest.open('GET', 'includes/article.php', true)
  httpRequest.overrideMimeType("text/plain")
  httpRequest.send()
}
// ############################################Publication_Function############################################
function filenamefourfunc(filenamefour){
  if(filenamefour.indexOf('jpeg') !== -1) {
    contentTypefour = 2;
  }
  else if(filenamefour.indexOf('png') !== -1) {
    contentTypefour = 3;
  }
  else if(filenamefour.indexOf('jpg') !== -1) {
    contentTypefour = 2;
  }
  else if(filenamefour.indexOf('gif') !== -1) {
    contentTypefour = 1;
  }
  else{
    contentTypefour = 4;
  }
  return contentTypefour
}
function filenamethreefunc(filenamethree){
  if(filenamethree.indexOf('jpeg') !== -1) {
    contentTypethree = 2;
  }
  else if(filenamethree.indexOf('png') !== -1) {
    contentTypethree = 3;
  }
  else if(filenamethree.indexOf('jpg') !== -1) {
    contentTypethree = 2;
  }
  else if(filenamethree.indexOf('gif') !== -1) {
    contentTypethree = 1;
  }
  else{
    contentTypethree = 4;
  }
  return contentTypethree
}
function filenametwofunc(filenametwo){
  if(filenametwo.indexOf('jpeg') !== -1) {
    contentTypetwo = 2;
  }
  else if(filenametwo.indexOf('png') !== -1) {
    contentTypetwo = 3;
  }
  else if(filenametwo.indexOf('jpg') !== -1) {
    contentTypetwo = 2;
  }
  else if(filenametwo.indexOf('gif') !== -1) {
    contentTypetwo = 1;
  }
  else{
    contentTypetwo = 4;
  }
  return contentTypetwo
}
function filenameonefunc(filenameone){
  if(filenameone.indexOf('jpeg') !== -1) {
    contentTypeone = 2;
  }
  else if(filenameone.indexOf('png') !== -1) {
    contentTypeone = 3;
  }
  else if(filenameone.indexOf('jpg') !== -1) {
    contentTypeone = 2;
  }
  else if(filenameone.indexOf('gif') !== -1) {
    contentTypeone = 1;
  }
  else{
    contentTypeone = 4;
  }
  return contentTypeone
}
function creapubtxt()
{
     var httpRequest = getHttpRequest()
     var content = document.getElementById('textareatext').value;
     httpRequest.onreadystatechange = function () {
          var a = httpRequest;
          if (httpRequest.readyState === 1){
            hide_txt_panel_reverse();
          }
          if (httpRequest.readyState === 4){
            if (httpRequest.responseText != 'Veuiller remplir tout les champs'){
              idcountforinclude += 1;
              idrecuppost = idcountforinclude;
              let docu = document.getElementById('aff_pub');
              let replt = document.createElement('div');
              replt.setAttribute("id", idrecuppost);
              docu.prepend(replt);
              document.getElementById(idrecuppost).innerHTML = httpRequest.responseText;
            }
          }  
     }
     httpRequest.open('POST', 'includes/createpubtxt.php', true) 
     httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
     httpRequest.overrideMimeType("text/plain")
     httpRequest.send("content_publication=" + encodeURIComponent(content) + "&user=" + encodeURIComponent(id_user_live))
}
function getImageExtension(base64String) {
  const matches = base64String.match(/^data:image\/(\w+);base64,/);
  if (matches) {
    return matches[1].toLowerCase();
  }
  return null;
}
function determineContentType(extension) {
  switch (extension) {
    case "gif":
      return 1;
    case "jpeg":
    case "jpg":
      return 2;
    case "png":
      return 3;
    default:
      return 4;
  }
}
function creapubimg()
{
  hide_img_panel_reverse();
  document.getElementById('annimation_loader').style.display = 'block';
  document.getElementById('html').style.overflowY = 'hidden';
  var formData = new FormData();
  formData.append('id', id_user_live);
  formData.append('content', document.getElementById('content_text_area_img').value);
  fileUploadInput = document.getElementById('upload-button');
  numOfFiles = fileUploadInput.files.length;
  formData.append('NumberOfFiles', numOfFiles);
  if (numOfFiles >= 1) {
    base64Image_one = document.querySelector('img#slide1.img-preview').src;
    imageExtension_one = getImageExtension(base64Image_one);
    contentTypeValue_one = determineContentType(imageExtension_one);
    console.log(contentTypeValue_one);
    formData.append('one_type', contentTypeValue_one);
    base64Data_one = base64Image_one.split(',')[1];
    blobImage_one = base64ToBlob(base64Data_one, 'image/png');
    formData.append('one', blobImage_one);
  }
  if (numOfFiles >= 2) {
    base64Image_two = document.querySelector('img#slide2.img-preview').src;
    imageExtension_two = getImageExtension(base64Image_two);
    contentTypeValue_two = determineContentType(imageExtension_two);
    console.log(contentTypeValue_two);
    formData.append('two_type', contentTypeValue_two);
    base64Data_two = base64Image_two.split(',')[1];
    blobImage_two = base64ToBlob(base64Data_two, 'image/png');
    formData.append('two', blobImage_two);
  }
  if (numOfFiles >= 3) {
    base64Image_three = document.querySelector('img#slide3.img-preview').src;
    imageExtension_three = getImageExtension(base64Image_three);
    contentTypeValue_three = determineContentType(imageExtension_three);
    console.log(contentTypeValue_three);
    formData.append('three_type', contentTypeValue_three);
    base64Data_three = base64Image_three.split(',')[1];
    blobImage_three = base64ToBlob(base64Data_three, 'image/png');
    formData.append('three', blobImage_three);
  }
  if (numOfFiles == 4) {
    base64Image_four = document.querySelector('img#slide4.img-preview').src;
    imageExtension_four = getImageExtension(base64Image_four);
    contentTypeValue_four = determineContentType(imageExtension_four);
    console.log(contentTypeValue_four);
    formData.append('four_type', contentTypeValue_four);
    base64Data_four = base64Image_four.split(',')[1];
    blobImage_four = base64ToBlob(base64Data_four, 'image/png');
    formData.append('four', blobImage_four);
  }
  fetch('includes/createpubimg.php', {
        method: "POST", 
        body: formData
  })
  .then(response => response.text())
  .then(data => {
    ajaxresponse = data;
  })
  .then(() => {
    idcountforinclude += 1;
    let docu = document.getElementById('aff_pub');
    document.getElementById('annimation_loader').style.display = 'none';
    document.getElementById('html').style.overflowY = 'scroll';
    let replt = document.createElement('div');
    replt.setAttribute('id', idcountforinclude);
    docu.prepend(replt);
    document.getElementById(idcountforinclude).innerHTML = ajaxresponse;
    content = document.getElementById('content_text_area_img').value = '';
    document.getElementById('emojionearea-editor-txt-editor').innerHTML = '';

  })
  .catch(error => {
      console.error('Error:', error);
  })
}
var cropper_one = null;
var cropper_two = null;
var cropper_three = null;
var cropper_four = null;
inputElement = document.getElementById('upload-button');
contentCrop_one = document.querySelector('.content_figure_one');
contentCrop_two = document.querySelector('.content_figure_two');
contentCrop_three = document.querySelector('.content_figure_three');
contentCrop_four = document.querySelector('.content_figure_four');
inputElement.addEventListener("change", (event) => {
  file_one = event.target.files[0];
  file_two = event.target.files[1];
  file_three = event.target.files[2];
  file_four = event.target.files[3];
  if (file_one) {
      reader_one = new FileReader();
      reader_one.onload = (e) => {
        contentCrop_one.innerHTML = '';
        imgCrop = document.createElement("img");
        imgCrop.id = "myGreatImage_one";
        imgCrop.className = "img_crop";
        imgCrop.src = e.target.result;
        contentCrop_one.appendChild(imgCrop);
        scr_save_one = e.target.result;
      };
      reader_one.readAsDataURL(file_one);
  }
  if (file_two) {
      reader_two = new FileReader();
      reader_two.onload = (e) => {
        contentCrop_two.innerHTML = '';
        imgCrop = document.createElement("img");
        imgCrop.id = "myGreatImage_two";
        imgCrop.className = "img_crop";
        imgCrop.src = e.target.result;
        contentCrop_two.appendChild(imgCrop);
        scr_save_two = e.target.result;
      };
      reader_two.readAsDataURL(file_two);
  }
  if (file_three) {
      reader_three = new FileReader();
      reader_three.onload = (e) => {
        contentCrop_three.innerHTML = '';
        imgCrop = document.createElement("img");
        imgCrop.id = "myGreatImage_three";
        imgCrop.className = "img_crop";
        imgCrop.src = e.target.result;
        contentCrop_three.appendChild(imgCrop);
        scr_save_three = e.target.result;
      };
      reader_three.readAsDataURL(file_three);
  }
  if (file_four) {
      reader_four = new FileReader();
      reader_four.onload = (e) => {
        contentCrop_four.innerHTML = '';
        imgCrop = document.createElement("img");
        imgCrop.id = "myGreatImage_four";
        imgCrop.className = "img_crop";
        imgCrop.src = e.target.result;
        contentCrop_four.appendChild(imgCrop);
        scr_save_four = e.target.result;
      };
      reader_four.readAsDataURL(file_four);
  }
});
function previewimg(){
  cropperactive = true;
  document.getElementById('annimation_loader').style.display = 'block';
  document.getElementById('html').style.overflowY = 'hidden';
  document.getElementById('panel-img-demand').style.display = 'none';
  fileUploadInput = document.getElementById('upload-button');
  numOfFiles = fileUploadInput.files.length;
  select_element_button_crop = document.querySelectorAll('.button_crop_img_dmd');
  for (var i = 0; i < select_element_button_crop.length; i++) {
    if (numOfFiles == i+1) {
      select_element_button_crop[i].setAttribute('onclick', 'cropImage('+i+');continuetoimgpanel();');
    }else{
      select_element_button_crop[i].setAttribute('onclick', 'cropImage('+i+')');
    }
  }
  if (numOfFiles >= 1) {processImage(0);}
  document.getElementById('info_btn_img').setAttribute('onclick','affcropsel()');
  document.getElementById('panel-info').style.display = 'block';
  windowSize = window.innerWidth;
  if (windowSize <= 550) {updateMargin();}
  document.getElementById('annimation_loader').style.display = 'none';
}
function processImage(num){
  if (num == 0) {
    myGreatImage_one = document.getElementById('myGreatImage_one');
    cropper_one = new Cropper(myGreatImage_one, {
      aspectRatio: 1,
      dragMode: "move"
    });
    mode_crop = 1;
    document.querySelector('.content_four_fig').style.display = 'none';
    document.querySelector('.content_three_fig').style.display = 'none';
    document.querySelector('.content_two_fig').style.display = 'none';
    document.querySelector('.content_one_fig').style.display = 'block';
    setTimeout(() => resize_pp_crop(1), 50);
  }
  else if (num == 1) {
    myGreatImage_two = document.getElementById('myGreatImage_two');
    cropper_two = new Cropper(myGreatImage_two, {
      aspectRatio: 1,
      dragMode: "move"
    });
    mode_crop = 2;
    document.querySelector('.content_one_fig').style.display = 'none';
    document.querySelector('.content_four_fig').style.display = 'none';
    document.querySelector('.content_three_fig').style.display = 'none';
    document.querySelector('.content_two_fig').style.display = 'block';
    setTimeout(() => resize_pp_crop(2), 50);
  }
  else if (num == 2) {
    myGreatImage_three = document.getElementById('myGreatImage_three');
    cropper_three = new Cropper(myGreatImage_three, {
      aspectRatio: 1,
      dragMode: "move"
    });
    mode_crop = 3;
    document.querySelector('.content_two_fig').style.display = 'none';
    document.querySelector('.content_one_fig').style.display = 'none';
    document.querySelector('.content_four_fig').style.display = 'none';
    document.querySelector('.content_three_fig').style.display = 'block';
    setTimeout(() => resize_pp_crop(3), 50);
  }
  else if (num == 3) {
    myGreatImage_four = document.getElementById('myGreatImage_four');
    cropper_four = new Cropper(myGreatImage_four, {
      aspectRatio: 1,
      dragMode: "move"
    });
    mode_crop = 4;
    document.querySelector('.content_three_fig').style.display = 'none';
    document.querySelector('.content_two_fig').style.display = 'none';
    document.querySelector('.content_one_fig').style.display = 'none';
    document.querySelector('.content_four_fig').style.display = 'block';
    setTimeout(() => resize_pp_crop(4), 50);
  }
}
function cropImage(num){
  fileUploadInput = document.getElementById('upload-button');
  numOfFiles = fileUploadInput.files.length;
  if (num == 0) {
    if (cropper_one !== null) {
      document.getElementById('annimation_loader').style.display = 'block';
      imgUrl = cropper_one.getCroppedCanvas().toDataURL();
      img_c = document.querySelector('img#slide1.img-preview');
      img_c.src = imgUrl;
      contentCrop = document.querySelector('.content_figure_one');
      contentCrop.innerHTML = '';
      imgCrop = document.createElement("img");
      imgCrop.id = "myGreatImage_one";
      imgCrop.className = "img_crop";
      imgCrop.src = scr_save_one;
      contentCrop.appendChild(imgCrop);
      if (numOfFiles >= 2) {processImage(1);}
      document.getElementById('annimation_loader').style.display = 'none';
      document.querySelector('.content_four_fig').style.display = 'none';
      document.querySelector('.content_three_fig').style.display = 'none';
      document.querySelector('.content_one_fig').style.display = 'none';
      document.querySelector('.content_two_fig').style.display = 'block';
    }
  }
  else if(num == 1 && numOfFiles >= 2){
    if (cropper_two !== null) {
      document.getElementById('annimation_loader').style.display = 'block';
      imgUrl = cropper_two.getCroppedCanvas().toDataURL();
      img_c = document.querySelector('img#slide2.img-preview');
      img_c.src = imgUrl;
      contentCrop = document.querySelector('.content_figure_two');
      contentCrop.innerHTML = '';
      imgCrop = document.createElement("img");
      imgCrop.id = "myGreatImage_two";
      imgCrop.className = "img_crop";
      imgCrop.src = scr_save_two;
      contentCrop.appendChild(imgCrop);
      if (numOfFiles >= 3) {processImage(2);}
      document.getElementById('annimation_loader').style.display = 'none';
      document.querySelector('.content_one_fig').style.display = 'none';
      document.querySelector('.content_four_fig').style.display = 'none';
      document.querySelector('.content_two_fig').style.display = 'none';
      document.querySelector('.content_three_fig').style.display = 'block';
    }
  }
  else if(num == 2 && numOfFiles >= 3){
    if (cropper_three !== null) {
      document.getElementById('annimation_loader').style.display = 'block';
      imgUrl = cropper_three.getCroppedCanvas().toDataURL();
      img_c = document.querySelector('img#slide3.img-preview');
      img_c.src = imgUrl;
      contentCrop = document.querySelector('.content_figure_three');
      contentCrop.innerHTML = '';
      imgCrop = document.createElement("img");
      imgCrop.id = "myGreatImage_three";
      imgCrop.className = "img_crop";
      imgCrop.src = scr_save_three;
      contentCrop.appendChild(imgCrop);
      if (numOfFiles == 4) {processImage(3);}
      document.getElementById('annimation_loader').style.display = 'none';
      document.querySelector('.content_two_fig').style.display = 'none';
      document.querySelector('.content_one_fig').style.display = 'none';
      document.querySelector('.content_three_fig').style.display = 'none';
      document.querySelector('.content_four_fig').style.display = 'block';
    }
  }
  else if(num == 3 && numOfFiles == 4){
    if (cropper_four !== null) {
      document.getElementById('annimation_loader').style.display = 'block';
      imgUrl = cropper_four.getCroppedCanvas().toDataURL();
      img_c = document.querySelector('img#slide4.img-preview');
      img_c.src = imgUrl;
      contentCrop = document.querySelector('.content_figure_four');
      contentCrop.innerHTML = '';
      imgCrop = document.createElement("img");
      imgCrop.id = "myGreatImage_four";
      imgCrop.className = "img_crop";
      imgCrop.src = scr_save_four;
      contentCrop.appendChild(imgCrop);
      document.getElementById('annimation_loader').style.display = 'none';
    }
  }
  setTimeout(() => reg_crop_imp(), 20);
}
function continuetoimgpanel(){
  document.getElementById('panel-crop-demand').style.display = 'none';
  cropperactive = false;
  fileUploadInput = document.getElementById('upload-button');
  numOfFiles = fileUploadInput.files.length;
  nbSlidein = numOfFiles;
  emojiredisignimgdmd();
  hide_form_pub_img('panel-img');
  if (document.getElementById('form_pub_img').offsetHeight + 150 > window.innerHeight) {document.getElementById('panel-img').style.overflowY = 'scroll';}
  else{document.getElementById('panel-img').style.overflowY = 'hidden';}
}
function affcropsel(){
  if (document.getElementById('morning0').checked) {
    document.getElementById('panel-info').style.display = 'none';
    document.getElementById('panel-crop-demand').style.display = 'block';
    resize_pp_crop(1);
    reg_crop_imp();
  }
}
function reg_crop_imp(){
  if (mode_crop == 1) {
    element_crop = document.querySelector('div.content_figure_one');
    width_crop = element_crop.offsetWidth;
    height_crop = element_crop.offsetHeight;
    cropper_one.containerData.height = height_crop; 
    cropper_one.containerData.width = width_crop;
    if (height_crop > width_crop) {
      cropper_one.cropBoxData.maxHeight = width_crop;
      cropper_one.cropBoxData.maxWidth = width_crop;
    }else{
      cropper_one.cropBoxData.maxHeight = height_crop;
      cropper_one.cropBoxData.maxWidth = height_crop;
    }
    lf = (window.innerWidth / 2) - 100;
    document.getElementById('cropButton_one').style.left = lf + "px";
  }if (mode_crop == 2) {
    element_crop = document.querySelector('div.content_figure_two');
    width_crop = element_crop.offsetWidth;
    height_crop = element_crop.offsetHeight;
    cropper_two.containerData.height = height_crop;
    cropper_two.containerData.width = width_crop;
    if (height_crop > width_crop) {
      cropper_two.cropBoxData.maxHeight = width_crop;
      cropper_two.cropBoxData.maxWidth = width_crop;
    }else{
      cropper_two.cropBoxData.maxHeight = height_crop;
      cropper_two.cropBoxData.maxWidth = height_crop;
    }
    lf = (window.innerWidth / 2) - 100;
    document.getElementById('cropButton_two').style.left = lf + "px";
  }if (mode_crop == 3) {
    element_crop = document.querySelector('div.content_figure_three');
    width_crop = element_crop.offsetWidth;
    height_crop = element_crop.offsetHeight;
    cropper_three.containerData.height = height_crop;
    cropper_three.containerData.width = width_crop;
    if (height_crop > width_crop) {
      cropper_three.cropBoxData.maxHeight = width_crop;
      cropper_three.cropBoxData.maxWidth = width_crop;
    }else{
      cropper_three.cropBoxData.maxHeight = height_crop;
      cropper_three.cropBoxData.maxWidth = height_crop;
    }
    lf = (window.innerWidth / 2) - 100;
    document.getElementById('cropButton_three').style.left = lf + "px";
  }if (mode_crop == 4) {
    element_crop = document.querySelector('div.content_figure_four');
    width_crop = element_crop.offsetWidth;
    height_crop = element_crop.offsetHeight;
    cropper_four.containerData.height = height_crop; 
    cropper_four.containerData.width = width_crop;
    if (height_crop > width_crop) {
      cropper_four.cropBoxData.maxHeight = width_crop;
      cropper_four.cropBoxData.maxWidth = width_crop;
    }else{
      cropper_four.cropBoxData.maxHeight = height_crop;
      cropper_four.cropBoxData.maxWidth = height_crop;
    }
    lf = (window.innerWidth / 2) - 100;
    document.getElementById('cropButton_four').style.left = lf + "px";
  }
}
function resize_pp_crop(num) {
  windowSize = window.innerWidth;
  if (windowSize <= 1400) {
      t = window.innerHeight - 107;
      document.querySelector(".cropper-container").style.height = t + "px";
      document.querySelector(".cropper-drag-box").style.height = t + "px";
      document.querySelector(".cropper-wrap-box").style.height = t + "px";
      document.querySelector(".content_figure_one").style.height = t + "px";
      document.querySelector(".content_figure_two").style.height = t + "px";
      document.querySelector(".content_figure_three").style.height = t + "px";
      document.querySelector(".content_figure_four").style.height = t + "px";
  }else{
    document.querySelector(".content_figure_one").removeAttribute("style");
    document.querySelector(".content_figure_two").removeAttribute("style");
    document.querySelector(".content_figure_three").removeAttribute("style");
    document.querySelector(".content_figure_four").removeAttribute("style");
  }
  if (num == 1) {
    cropper_one.canvasData.maxHeight = Infinity;
    cropper_one.canvasData.maxLeft = 650;
    cropper_one.canvasData.maxTop = 650;
    cropper_one.canvasData.maxWidth = Infinity;
    cropper_one.canvasData.minLeft = -300;
    cropper_one.canvasData.minTop = -300;
  }
  if (num == 2) {
    cropper_two.canvasData.maxHeight = Infinity;
    cropper_two.canvasData.maxLeft = 650;
    cropper_two.canvasData.maxTop = 650;
    cropper_two.canvasData.maxWidth = Infinity;
    cropper_two.canvasData.minLeft = -300;
    cropper_two.canvasData.minTop = -300;
  }
  if (num == 3) {
    cropper_three.canvasData.maxHeight = Infinity;
    cropper_three.canvasData.maxLeft = 650;
    cropper_three.canvasData.maxTop = 650;
    cropper_three.canvasData.maxWidth = Infinity;
    cropper_three.canvasData.minLeft = -300;
    cropper_three.canvasData.minTop = -300;
  }
  if (num == 4) {
    cropper_four.canvasData.maxHeight = Infinity;
    cropper_four.canvasData.maxLeft = 650;
    cropper_four.canvasData.maxTop = 650;
    cropper_four.canvasData.maxWidth = Infinity;
    cropper_four.canvasData.minLeft = -300;
    cropper_four.canvasData.minTop = -300;
  }
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
function resizepanel(){
  windowSize = window.innerWidth;
  if (windowSize <= 600) {
    elemoji = document.querySelectorAll('.emojionearea');
    elemoji[0].style.height = '100%';
    document.getElementById('formtextpub').style.height = window.innerHeight - 88 + 'px';
    document.getElementById('content_text_area_txt-panel').style.height = window.innerHeight - 200 + 'px';
    document.getElementById('formtextpub').style.width = windowSize + 'px';
    document.getElementById('content_text_area_txt-panel').style.width = windowSize + 'px';
  }
  if (windowSize >= 600) {
    elemoji = document.querySelectorAll('.emojionearea');
    elemoji[0].style.height = '100%';
    culcul = window.innerHeight - 200;
    if (culcul <= 578) {document.getElementById('content_text_area_txt-panel').style.height = window.innerHeight - 200 + 'px';}
    else{document.getElementById('content_text_area_txt-panel').style.height = '578px';}
  }
}
function emojiredisignimgdmd(){
  var newTextareaEmojiOne = document.querySelectorAll('.emojionearea-editor');
  newTextareaEmojiOne[1].style.overflow = 'auto';
  newTextareaEmojiOne[1].style.wordWrap = 'break-word';
  newTextareaEmojiOne[1].style.height = '144px';
  newTextareaEmojiOne[1].style.textAlign = 'left';
  var divEmojiAreaImg = document.querySelector('div.emojionearea.text_area_img');
  divEmojiAreaImg.style.height = '154px';
  divEmojiAreaImg.style.display = 'block';
}
// ############################################Administration_Function############################################
function suppr_art(id){
 document.getElementById('annimation_loader').style.display = 'block';
 document.getElementById('html').style.overflowY = 'hidden';
 var httpRequest = getHttpRequest();
 httpRequest.onreadystatechange = function () {
      var a = httpRequest;
      if (httpRequest.readyState === 4){
           var art_remove = document.getElementById(id);
           art_remove.parentNode.removeChild(art_remove);
           hide_edit_panel_reverse();
      }  
 }
 httpRequest.open('POST', 'includes/suprr_article.php', true)
 httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
 httpRequest.send("id=" + encodeURIComponent(id) + "&user=" + encodeURIComponent(id_user_live))
 document.getElementById('annimation_loader').style.display = 'none';
 document.getElementById('html').style.overflowY = 'scroll';
}
function modif_art(id){
  document.getElementById('annimation_loader').style.display = 'block';
  document.getElementById('html').style.overflowY = 'hidden';
  var httpRequest = getHttpRequest();
  httpRequest.onreadystatechange = function () {
        var a = httpRequest;
        if (httpRequest.readyState === 2){
             if (emjione_textform_stat != 1) {
               elemsemojionetxtform();
               emjione_textform_stat = 1;
             }
             hide_edit_panel_reverse();
             document.getElementById('content_text_area_txt-panel').style.display = 'none';
             document.getElementById('content_text_area_txt-panel-loading').style.display = 'block';
        }
        if (httpRequest.readyState === 4){
             response = httpRequest.responseText;
             response = response.replace(/\n/g, "<div></div>");
             document.getElementById('emojionearea-editor-txt-editor').innerHTML = response;
             document.getElementById('content_text_area_txt-panel-loading').style.display = 'none';
             document.getElementById('content_text_area_txt-panel').style.display = 'block';
             document.getElementById('annimation_loader').style.display = 'none';
             document.getElementById('panel-txt').style.display = 'block';
             document.getElementById('submit').onclick = function(){modif_art_process_initialisation(id);};
        }  
   }
   httpRequest.open('POST', 'includes/modif_initialisation.php', true)
   httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
   httpRequest.overrideMimeType("text/plain")
   httpRequest.send("id=" + encodeURIComponent(id))
}
function modif_proce_art(id,content){
    var httpRequest = getHttpRequest()
     httpRequest.onreadystatechange = function () {
          var a = httpRequest;
          if (httpRequest.readyState === 2){
               document.getElementById('panel-txt').style.display = 'none';
               document.getElementById('annimation_loader').style.display = 'block';
               document.getElementById('html').style.overflowY = 'hidden';
          } 
          if (httpRequest.readyState === 4){
               document.getElementById('annimation_loader').style.display = 'none';
               document.getElementById('html').style.overflowY = 'scroll';
               document.getElementById('content_'+ id).innerHTML = httpRequest.responseText;
          }  
     }
     httpRequest.open('POST', 'includes/modif_procedure.php', true)
     httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
     httpRequest.overrideMimeType("text/plain")
     httpRequest.send("content_publication=" + encodeURIComponent(content) + "&id=" + encodeURIComponent(id))
}
function modif_art_process_initialisation(idpub){
  var content = document.getElementById('textareatext').value;
  modif_proce_art(idpub,content);
}

// ############################################Communication_Function############################################
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
function send_sign(id, id_user){
  val = [...onCheckboxClicksign()];
  text = document.querySelector('.textarea_sign').value;
  if (text !== '') {
    var httpRequest = getHttpRequest();
      httpRequest.onreadystatechange = function () {
          if (httpRequest.readyState === 4){
            document.querySelector('.textarea_sign').value = '';
            hide_sign_demand_reverse('panel-sign');
            hide_edit_panel_reverse();
          }  
      }
      httpRequest.open('POST', 'includes/signal.php', true)
      httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
      httpRequest.send("user=" + encodeURIComponent(id_user) + "&object=" + encodeURIComponent('[pub]'+ id) + "&sign=" + encodeURIComponent(JSON.stringify(val)) + "&text=" + encodeURIComponent(text))
  }
}
function like_db(user,id){
  var httpRequest = getHttpRequest()
     httpRequest.onreadystatechange = function () {
          if (httpRequest.readyState === 4){
            if (httpRequest.responseText == "envoyer") 
              {
                document.getElementById('like-div-'+ id).style.fill = 'red';
                var likenum = document.getElementById('likepart-'+ id).innerHTML;
                likenum = parseInt(likenum);
                likenum += 1
                document.getElementById('likepart-'+ id).innerHTML = likenum; 
              }
            else if(httpRequest.responseText == "supprimer")
              {
                document.getElementById('like-div-'+ id).style.fill = 'white';
                var likenum = document.getElementById('likepart-'+ id).innerHTML;
                likenum = parseInt(likenum);
                likenum = likenum - 1
                document.getElementById('likepart-'+ id).innerHTML = likenum; 
              }
              else{
                // message d'erreur
              }
            // debugger
            // var likenum = like_db_number(id);
            // debugger
            // document.getElementById('likepart-'+ id).innerHTML = likenum;
          }  
     }
     httpRequest.open('POST', 'includes/like-pgrm.php', true)
     httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
     httpRequest.overrideMimeType("text/plain")
     httpRequest.send("user=" + encodeURIComponent(user) + "&pub=" + encodeURIComponent(id))
}
function comment_aff(){
  var elems = document.querySelectorAll('div.emojionearea');
  elems[2].style.width = "450px";
  elems[2].style.backgroundColor = "#FFF0";
  elems[2].style.border = "none";
  elems[2].style.borderRadius = 0;
  elems[2].style.boxShadow = "none";
  elems[2].style.transition = "none";
  elems[2].style.display = "none"
  var elemstwo = document.querySelectorAll('div.emojionearea-editor');
  elemstwo[2].style.width = "410px";
  elemstwo[2].style.color = "#000";
  elemstwo[2].style.height = "136px";
  elemstwo[2].style.textAlign = "left";
  elemstwo[2].style.padding = 0;
  elemstwo[2].style.minHeight = "undefined";
  elemstwo[2].style.marginRight = 0;
  elemstwo[2].style.boxSizing = 0;
  elemstwo[2].style.paddingLeft = "25px";
  elemstwo[2].style.paddingRight = "25px";
  elemstwo[2].style.paddingTop = "14px";
  elemstwo[2].style.paddingBottom = "4px";
  elemstwo[2].style.wordWrap = "break-word";
  elemstwo[2].style.scrollbarWidth = "thin";
  document.getElementById('textareacommentelement').style.display = 'block';
  hide_comment_demand_reverse('panel-comment-demand');
}
// ############################################Tools_Function############################################
function makeid(length){
    var result           = '';
    var characters       = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789йцукенгшщзхъэждлорпавыфячсмитьбюЙЦУКЕНГШЩЗХФЫВАПРОЛДЖЭЯЧСМИТЬБЮςερτυθιοπλκξηγφδσαζχψωβνμςΕΡΤΥΘΙΟΠΛΚΞΗΓΦΔΣΑΖΧΨΩΒΝΝ';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * 
 charactersLength));
   }
   return result;
}
// ############################################Billsticking_Function############################################
function hide_sign_panel(id, id_user){
  if (document.querySelector('.sign_page').style.display == 'none' || document.querySelector('.sign_page').style.display == '') {
    hide_sign_demand_reverse("panel-sign");
    document.getElementById("html").style.overflowY = "hidden";
    document.getElementById('submit_sign').setAttribute('onclick', 'send_sign('+id+', "'+id_user+'");')
  }
}
function hide_edit_panel(id, id_user){
  if (document.getElementById('panel-edit').style.display == 'none' || document.getElementById('panel-edit').style.display == '')
  {
    if (id_user == id_user_live) {
      document.getElementById('suppr_edit').onclick = function(){suppr_art(id);};
      document.getElementById('modif_edit').onclick = function(){modif_art(id);};
      document.getElementById('suppr_edit').style.display = 'inline-table';
      document.getElementById('modif_edit').style.display = 'inline';
      document.getElementById('signal_edit').style.display = 'none';
    }
    else{
      document.getElementById('signal_edit').onclick = function(){hide_sign_panel(id, id_user);};
      document.getElementById('suppr_edit').style.display = 'none';
      document.getElementById('modif_edit').style.display = 'none';
      document.getElementById('signal_edit').style.display = 'inline';
    }
    document.getElementById('html').style.overflowY = 'hidden';
    document.getElementById('panel-edit').style.display = 'block';
  }
}
function hide_edit_panel_reverse(){
  if (document.getElementById('panel-edit').style.display == 'block')
  {
       document.getElementById('panel-edit').style.display = 'none';
       document.getElementById('html').style.overflowY = 'scroll';
  }
}
function hide_txt_panel_reverse(){
  if (document.getElementById('panel-txt').style.display == 'block')
  {
       document.getElementById('panel-txt').style.display = 'none';
       document.getElementById('html').style.overflowY = 'scroll';
  }
}
function hide_img_panel_reverse(){
  if (document.getElementById('panel-img').style.display == 'block')
  {
       document.getElementById('panel-img').style.display = 'none';
       document.getElementById('html').style.overflowY = 'scroll';
  }
}

function hide_img_demand(){
  if (document.getElementById('panel-img-demand').style.display == 'none' || document.getElementById('panel-img-demand').style.display == '')
  {
       document.getElementById('panel-img-demand').style.display = 'block';
       document.getElementById('html').style.overflowY = 'hidden';
       document.getElementById('button_slide_panel_img').style.display = 'flex';
  }
}
function hide_img_demand_reverse(){
  if (document.getElementById('panel-img-demand').style.display == 'block')
  {
       document.getElementById('panel-img-demand').style.display = 'none';
       document.getElementById('html').style.overflowY = 'scroll';
       document.getElementById('button_slide_panel_img').style.display = 'none';
  }
}
function hide_panel_info(){
  if (document.getElementById('panel-info').style.display == 'block') {
    document.getElementById('panel-info').style.display = 'none';
    document.getElementById('html').style.overflowY = 'scroll';
  }
}
function hide_crop_demand(){
  if (document.getElementById('panel-crop-demand').style.display == 'none' || document.getElementById('panel-crop-demand').style.display == '')
  {
       document.getElementById('panel-crop-demand').style.display = 'block';
       document.getElementById('html').style.overflowY = 'hidden';
  }
}
function hide_crop_demand_reverse(){
  if (document.getElementById('panel-crop-demand').style.display == 'block')
  {
       document.getElementById('panel-crop-demand').style.display = 'none';
       document.getElementById('html').style.overflowY = 'scroll';
  }
}
function hide_form_pub_txt(id)
{
  if (document.getElementById(id).style.display == 'none' || document.getElementById(id).style.display == '')
  {
       if (emjione_textform_stat != 1) {
          elemsemojionetxtform();
          emjione_textform_stat = 1;
       }
       document.getElementById('html').style.overflowY = 'hidden';
       document.getElementById(id).style.display = 'block';
       document.getElementById('panel-img').style.display = 'none';
       document.getElementById('submit').onclick = function(){creapubtxt();};
       document.getElementById('emojionearea-editor-txt-editor').innerHTML = "";
       resizepanel();
  }else{
       document.getElementById(id).style.display = 'none';
  }
}
function hide_form_pub_img(id)
{
  if (document.getElementById(id).style.display == 'none' || document.getElementById(id).style.display == '')
  {
       document.getElementById('html').style.overflowY = 'hidden';
       document.getElementById(id).style.display = 'block';
       document.getElementById('panel-txt').style.display = 'none';
  }else{
       document.getElementById(id).style.display = 'none';
  }
}
function hide_comment_demand_reverse(id)
{
  if (document.getElementById(id).style.display == 'none' || document.getElementById(id).style.display == '')
  {    
       document.getElementById('textareacomment').removeAttribute('style');
       document.getElementById('textareacomment').setAttribute('style', 'transition: margin-top 1s, height 1.5s, width 1s, margin-left 1s;transition-delay: 0.5s;');
       document.getElementById('divsendbotton').removeAttribute('style');
       document.getElementById('content_info_comment_aff').style.height = '620px';
       document.getElementById('textareacommentelement').style.display = 'block';
       statecomment = 0;
       document.getElementById('html').style.overflowY = 'hidden';
       document.getElementById(id).style.display = 'block';
  }else{
       document.getElementById(id).style.display = 'none';
       document.getElementById('html').style.overflowY = 'scroll';
       document.getElementById('comment-content-all').innerHTML = "";
  }
}
function hide_sign_demand_reverse(id)
{
  if (document.getElementById(id).style.display == 'none' || document.getElementById(id).style.display == '')
  {    
       document.getElementById('html').style.overflowY = 'hidden';
       document.getElementById(id).style.display = 'block';
  }else{
       document.getElementById(id).style.display = 'none';
       document.getElementById('html').style.overflowY = 'scroll';
  }
}
// ############################################Comment_Function############################################
function initilisation_comment_page(id){
  loading_html('comment-content-all');
  document.getElementById('cont-btn-comment').style.display = "block";
  document.getElementById('container_img_prem_comment').style.padding = 0;
  document.getElementById('cont-btn-comment').display = 'block';
  document.getElementById('txtpubcomment').value = '';
  var nbr_img = document.querySelectorAll('#container_img_sev_' + id + ' img').length;
  var elems = document.querySelectorAll('#container_img_sev_' + id + ' img');
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
  var tmp_code_pub = document.getElementById('info-' + id).innerHTML;
  var txtofart = document.getElementById('content_' + id).innerHTML;
  document.getElementById('pseudo-comment-page').innerHTML = document.getElementById('label-pseudo-'+ id).innerHTML;
  document.getElementById('txtpubcomment').innerHTML = txtofart;
  document.getElementById('click_comment_slide_left').setAttribute('onclick',"slidePrecedente('img.imgcomment'," + nbr_img + ",'imgcomment');");
  document.getElementById('click_comment_slide_right').setAttribute('onclick',"slideSuivante('img.imgcomment'," + nbr_img + ",'imgcomment');");
  document.getElementById('sendimgcomment').setAttribute('onclick',"send_comment('" + tmp_code_pub + "','"+id_user_live+"');");
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
    document.getElementById('cont-btn-comment').style.display = "none";
    elemscomment[1].style.display = "none";
    elemscomment[2].style.display = "none";
    elemscomment[3].style.display = "none";
    var src_one = elems[0].src;
    elemscomment[0].src = src_one;
  }
  else if(nbr_img == 2){
    elemscomment[2].style.display = "none";
    elemscomment[3].style.display = "none";
    var src_one = elems[0].src;
    elemscomment[0].src = src_one;
    var src_two = elems[1].src;
    elemscomment[1].src = src_two;
  }
  else if(nbr_img == 3){
    elemscomment[3].style.display = "none";
    var src_one = elems[0].src;
    elemscomment[0].src = src_one;
    var src_two = elems[1].src;
    elemscomment[1].src = src_two;
    var src_three = elems[2].src;
    elemscomment[2].src = src_three;
  }
  else if(nbr_img == 4){
    var src_one = elems[0].src;
    elemscomment[0].src = src_one;
    var src_two = elems[1].src;
    elemscomment[1].src = src_two;
    var src_three = elems[2].src;
    elemscomment[2].src = src_three;
    var src_four = elems[3].src;
    elemscomment[3].src = src_four;
  }
  else{
    // message d'erreur
  }
}
function send_comment(tmp_code_pub, user){
  document.getElementById('annimation_loader').style.display = 'block';
  document.getElementById('html').style.overflowY = 'hidden';
  var content = document.getElementById('textareacommentelement').value;
  var httpRequest = getHttpRequest();
  httpRequest.onreadystatechange = function () {
    if (httpRequest.readyState === 4){
      if ((httpRequest.responseText != 'erreur1') || (httpRequest.responseText != 'erreur2')){
        var elemstwo = document.querySelectorAll('div.emojionearea-editor');
        elemstwo[1].innerHTML = "";
        idcountforinclude += 1;
        idrecuppost = idcountforinclude;
        let docu = document.getElementById('comment-content-all');
        let replt = document.createElement('div');
        replt.setAttribute("id", idrecuppost);
        docu.prepend(replt);
        document.getElementById(idrecuppost).innerHTML = httpRequest.responseText;
        document.getElementById('comment-div-' + tmp_code_pub).style.fill = 'lime';
      }
    }  
  }
  httpRequest.open('POST', 'includes/comment-pgrm.php', true)
  httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  httpRequest.overrideMimeType("text/plain")
  httpRequest.send("content_comment=" + encodeURIComponent(content) + "&tmp_code_pub=" + encodeURIComponent(tmp_code_pub) + "&user=" + encodeURIComponent(user))
  document.getElementById('annimation_loader').style.display = 'none';
}
// ############################################Publication_Slider_Function############################################
function slideSuivante(content,nbSliderecup,classname){
    let items = document.querySelectorAll(content);
    let docu = document.querySelector('.'+ classname + '.active');
    if(docu.classList.contains("slide1") == true){
      count = 0;
    }
    else if(docu.classList.contains("slide2") == true){
      count = 1;
    }
    else if(docu.classList.contains("slide3") == true){
      count = 2;
    }
    else if(docu.classList.contains("slide4") == true){
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
// suivant.addEventListener('click', slideSuivante)

function slidePrecedente(content,nbSliderecup,classname){
    let items = document.querySelectorAll(content);
    let docu = document.querySelector('.'+ classname + '.active');
    if(docu.classList.contains("slide1") == true){
      count = 0;
    }
    else if(docu.classList.contains("slide2") == true){
      count = 1;
    }
    else if(docu.classList.contains("slide3") == true){
      count = 2;
    }
    else if(docu.classList.contains("slide4") == true){
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
// ############################################Change_Appareance_Function############################################
function commentchange(){
  if (statecomment == 0){
    statecomment = 1;
    let docu_content_comment = document.getElementById('content_info_comment_aff').clientHeight;
    let cululs = docu_content_comment - 70;
    document.getElementById('content_info_comment_aff').style.height = cululs + 'px';
    document.getElementById('textareacomment').style.height = '140px';
    document.getElementById('textareacomment').style.width = '460px';
    document.getElementById('textareacomment').style.marginLeft = '-90px';
    document.getElementById('textareacommentelement').style.display = 'none';
    var elems = document.querySelectorAll('div.emojionearea');
    var index = 0, length = elems.length;
    for ( ; index < length; index++) {
      elems[index].style.display = "inline-block";
    }
    var elems = document.querySelectorAll('div.emojionearea-editor');
    elems[1].setAttribute("id", "newtextareaemojione");
    elems[1].setAttribute("onkeyup", "upodatecounter();");
    elems[1].setAttribute("onkeydown", "administrating_carac();");
    statecomment = 3;
    setTimeout("document.getElementById('textareacomment').removeAttribute('style');document.getElementById('textareacomment').style.marginLeft = '20px';document.getElementById('textareacomment').style.height = '140px';document.getElementById('textareacomment').style.width = '460px';document.getElementById('divsendbotton').style.display = 'inline-block';document.getElementById('sendimgcomment').style.cursor = 'pointer';",2100)
  }
  else{
    // error
  }
}
// ############################################SetTimeout_function############################################
// ############################################Updating_function############################################
function updateMargin() {
  imgElement = document.getElementById("info_btn_img");
  windowWidth = window.innerWidth;
  newMargin = 143 - ((550 - windowWidth) / 2.4);
  imgElement.style.marginLeft = `${newMargin}px`;
}
function loadselection(position, nbr, minsel){
  debugger
  select_div = document.querySelectorAll('div.div_cropi.div_crop');
  nbr_dcd = nbr - 1;
  divh = select_div[nbr_dcd].clientHeight;
  divw = select_div[nbr_dcd].clientWidth;
  imgh = document.getElementById('img_crop_' + nbr).clientHeight;
  imgw = document.getElementById('img_crop_' + nbr).clientWidth;
  selector = minsel;
  selectorh = document.getElementById('selector' + nbr).clientHeight;
  if (position == 'right') {
    culculs = imgh - selectorh;
    value = document.getElementById('range_crop_right' + nbr).value;
    culculs *= value/100;
    result = culculs/divh;
    result *= 100;
    result += selector;
    document.getElementById('selector' + nbr).style.top = result + '%';
  }
  else if (position == 'bottom'){
    culculs = imgw - selectorh;
    value = document.getElementById('range_crop_button' + nbr).value;
    culculs *= value/100;
    result = culculs/divw;
    result *= 100;
    rebord = (divw/2) - (imgw/2);
    rebord += selectorh/2;
    rebord /= divw;
    rebord *= 100;
    result += rebord;
    document.getElementById('selector' + nbr).style.left = result + '%';
  }
  else{
    // message d'erreur
  }
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
    elems[1].setAttribute("contenteditable", "false");
  }
  else{
    var elems = document.querySelectorAll('div.emojionearea-editor');
    elems[1].setAttribute("contenteditable", "true");
  }
}
function elemsemojionetxtform(){
  var elemsemojione = document.querySelectorAll('div.emojionearea-editor');
  elemsemojione[0].setAttribute('id','emojionearea-editor-txt-editor');
  elemsemojione[0].style.color = "black";
  var elemsemojionepanel = document.querySelectorAll('div.emojionearea');
  elemsemojionepanel[0].style.display = 'block';
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
function burgerTime_index() {
   if (isClosed_index) {
      trigger_index.toggleClass('is-open is-closed');
      isClosed_index = false;
   } else {
      trigger_index.toggleClass('is-closed is-open');
      isClosed_index = true;
  }
}
function start_menu_index(){
  elem_selt = document.querySelector('#panel-hide');
  if (isClosed_index) {
    elem_selt.style.display = "block";
  }else{
    elem_selt.removeAttribute('style'); 
  }
}
function ham_li_index(){
  if (window.innerWidth <= 1140){
    isClosed_index = false;
    trigger_index = $('.hamburger-create');
    trigger_index.className = 'hamburglar is-closed pasblock hamburger-create';
    start_menu_nav();
  }
}
function updateDivHeights() {
  document.querySelector('.content_nodif').style.height = document.querySelector('.content_actu').offsetHeight + 'px';
  document.querySelector('.content_service').style.height = document.querySelector('.content_actu').offsetHeight + 'px';
}
document.querySelector('.content_actu').addEventListener('transitionend', updateDivHeights);
window.addEventListener('resize', function() {
    windowSize = window.innerWidth;
    if(cropperactive){
      lf = (window.innerWidth / 2) - 100;
      if (mode_crop == 1){document.getElementById('cropButton_one').style.left = lf + "px";}
      if (mode_crop == 2){document.getElementById('cropButton_two').style.left = lf + "px";}
      if (mode_crop == 3){document.getElementById('cropButton_thee').style.left = lf + "px";}
      if (mode_crop == 4){document.getElementById('cropButton_four').style.left = lf + "px";}
      // if (mode_crop !== 3) {resize_pp_crop(0);}
      reg_crop_imp();
    }
    resizepanel();
    if (windowSize <= 550) {updateMargin();}
    if (document.getElementById('form_pub_img').offsetHeight + 150 > window.innerHeight) {document.getElementById('panel-img').style.overflowY = 'scroll';}
    else{document.getElementById('panel-img').style.overflowY = 'hidden';}
    ham_linav();
});
window.onload = function() {
  navBar = document.querySelector('.nav_bar');
  navBar.removeAttribute('style');
  navBar.style.position = 'fixed';
  navBar.style.zIndex = 10000;
  $('document').ready(function () {
    trigger = $('.hamburger-nav');
    trigger_index = $('.hamburger-create');
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
    trigger_index.click(function () {
      burgerTime_index();
      start_menu_index();
      if (clickburg_index == 0) {
        document.documentElement.style.overflow = "hidden";clickburg_index = 1;
      }else{
        document.documentElement.style.overflow = "auto";clickburg_index = 0;
      }
    })
  });
  ham_linav();
  ham_li_index();
  document.getElementById('annimation_loader_all').style.display = 'none';
  document.getElementById('content_all').removeAttribute('style');
  document.getElementById('content_all').style.marginTop = '60px';
  slideSuivante('img.imgcomment',4,'imgcomment');
  dmd_art();
};
