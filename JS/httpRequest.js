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
function suppr_art(id)
{
     var httpRequest = getHttpRequest()
     httpRequest.onreadystatechange = function () {
          var a = httpRequest
          debugger
          if (httpRequest.readyState === 4){
               var art_remove = document.getElementById(id);
               art_remove.parentNode.removeChild(art_remove);
               alert('c\'est bon');
          }  
     }
     httpRequest.open('GET', 'includes/suprr_article.php?id=' + id, true)
     httpRequest.send()
}