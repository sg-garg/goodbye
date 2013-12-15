
function get_XmlHttp() {
  var xmlHttp = null;

  if(window.XMLHttpRequest) {
    xmlHttp = new XMLHttpRequest();
  }
  else if(window.ActiveXObject) {   
    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  }

  return xmlHttp;

}

function ajaxrequest(php_file, tagID) {

  var request =  get_XmlHttp();

  var  the_data = 'codeoption='+document.getElementById('txt2').value;
  request.open("POST", php_file, true);

  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send(the_data);
  request.onreadystatechange = function() {
    if (request.readyState == 4) {
      document.getElementById(tagID).innerHTML = request.responseText;  
    }
  }
}
