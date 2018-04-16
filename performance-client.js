var log = {'navigation' : window.performance.getEntriesByType('navigation'),
             'resource' : window.performance.getEntriesByType('resource') };

var xhr = new XMLHttpRequest();
  
xhr.open('POST', 'http://ec2-54-236-247-79.compute-1.amazonaws.com/telemetry/performance.php',true);
xhr.setRequestHeader('Content-Type', 'application/json');
xhr.send(JSON.stringify(log));