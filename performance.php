<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$data = file_get_contents("php://input");
$data = json_decode($data,true);

logNavigation($data['location'], $data['navigation']);

if ($data['resource']) {
  foreach ($data['resource'] as $resourceTiming) {
    logResource($resourceTiming);
  }
}

function logNavigation($data) {
  $timing = $data['navigation'];
  $log = Array( 
  	'dns'   => $timing['domainLookupEnd'] - $timing['domainLookupStart'],
  	'tcp'   => $timing['connectEnd'] - $timing['connectStart'],
  	'ttfb'	=> $timing['responseStart'] - $timing['requestStart'],
  	'transfer' => $timing['responseEnd'] - $timing['responseStart'],
  	'dominteractive' => $timing['domInteractive'] - $timing['domLoading'],
  	'domcomplete' => $timing['domComplete'] - $timing['domInteractive'],
  	'totalpageloadtime' =>$timing['loadEventEnd'] - $timing['navigationStart'],
    'location' => $data['location']
  );
  error_log(json_encode($log) . PHP_EOL, 3, "/var/tmp/pageperformance.log");
}

function logResource($timing) {
  $log = Array( 
    'name'     => $timing['name'],
    'dns'      => $timing['domainLookupEnd'] - $timing['domainLookupStart'],
    'tcp'      => $timing['connectEnd'] - $timing['connectStart'],
    'ttfb'     => $timing['responseStart'] - $timing['requestStart'],
    'transfer' => $timing['responseEnd'] - $timing['responseStart'],
    'duration' => $timing['duration'],
    'location' => $data['location']
  );
  error_log(json_encode($log) . PHP_EOL, 3, "/var/tmp/resourceperformance.log");
}

?>