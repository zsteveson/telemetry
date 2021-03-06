var baseurl = 'https://monitoring.zacharysteveson.com/telemetry/';

window.addEventListener("error", function (e) {
  var errorLog = { 'message' : e['message'], 
                   'url'     : e['filename'], 
                   'line'    : e['lineno'], 
                   'column'  : e['colno'],
                   'location': window.location.href
                 };

  var xhr = new XMLHttpRequest();
  xhr.open('POST', baseurl + 'error.php',true);
  xhr.setRequestHeader('Content-Type', 'application/json');  
  xhr.send(JSON.stringify(errorLog));

});

window.addEventListener("load", function(){

  var log = {'location' : window.location.href,
             'navigation' : window.performance.timing,
             'resource' : window.performance.getEntriesByType('resource') 
             };

  var xhr = new XMLHttpRequest();
  xhr.open('POST', baseurl + 'performance.php',true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.send(JSON.stringify(log));

});
  