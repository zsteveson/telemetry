window.onerror = function (msg, url, lineNo, columnNo, error) {

  var log = { 'message' : msg, 'url' : url, 'line' : lineNo, 'column' : columnNo, 'error'  : error }     
  var xhr = new XMLHttpRequest();

  xhr.open('POST', 'http://ec2-54-236-247-79.compute-1.amazonaws.com/telemetry/error.php',true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.send(log);
  
 }



