var baseurl = 'https://monitoring.zacharysteveson.com/telemetry/';

window.addEventListener("error", function (e) {
  var errorLog = { 'message' : e['message'], 
                   'url'     : e['filename'], 
                   'line'    : e['lineno'], 
                   'column'  : e['colno']
                 };

  var xhr = new XMLHttpRequest();
  xhr.open('POST', domain + 'error.php',true);
  xhr.setRequestHeader('Content-Type', 'application/json');  
  xhr.send(JSON.stringify(errorLog));

});

window.addEventListener("load", function(){

  var log = {'navigation' : window.performance.getEntriesByType('navigation'),
             'resource' : window.performance.getEntriesByType('resource') };

  var xhr = new XMLHttpRequest();
  xhr.open('POST', domain + 'performance.php',true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.send(JSON.stringify(log));

});
  