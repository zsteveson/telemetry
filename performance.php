<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$data = file_get_contents("php://input");
$data = json_decode($data,true);

$nav = $data['navigation'];

$dns  = $nav['domainLookupEnd'] - $nav['domainLookupStart'];
$tcp  = $nav['connectEnd'] - $nav['connectStart'];
$ttfb = $nav['responseStart'] - $nav['startTime'];
$transfer = $nav['responseEnd'] - $nav['responseStart'];
$ttdc = $nav['domComplete' - $nav['domLoading';
$total = $nav['duration'];

$log  = $resource['name'] . ' ' . $dns . ' ' . $tcp . ' ' . $ttfb . ' ' . $transfer . ' ';
$log .= $tti . ' '  . $ttdc . ' ' . $total . ' ' . PHP_EOL;

error_log($log, 3, "/var/tmp/navigationPerformance.log");


foreach ($data['resource'] as $r) {
  $dns  = $resource['domainLookupEnd'] - $resource['domainLookupStart'];
  $tcp  = $resource['connectEnd'] - $resource['connectStart'];
  $ttfb = $resource['responseStart'] - $resource['startTime'];
  $transfer = $resource['responseEnd'] - $resource['responseStart'];
  $total = $resource['duration'];
  $log = $resource['name'] . ' ' . $dns . ' ' . $tcp . ' ' . $ttfb . ' ' . $transfer . ' ' . $total . PHP_EOL;
  error_log($log, 3, "/var/tmp/resourcePerformance.log");
}

?>