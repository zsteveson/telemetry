var domain = 'http://ec2-54-236-247-79.compute-1.amazonaws.com';

window.addEventListener("error", function (msg, url, lineNo, columnNo, error) {

  var log = { 'message' : msg, 'url' : url, 'line' : lineNo, 'column' : columnNo } 

  var xhr = new XMLHttpRequest();
  xhr.open('POST', domain + 'telemetry/error.php',true);
  xhr.setRequestHeader('Content-Type', 'application/json');  
  xhr.send(JSON.stringify(log));

 });

window.addEventListener("load", function(){

  var log = {'navigation' : window.performance.getEntriesByType('navigation'),
             'resource' : window.performance.getEntriesByType('resource') };

  var xhr = new XMLHttpRequest();
  xhr.open('POST', domain + '/telemetry/performance.php',true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.send(JSON.stringify(log));

});


