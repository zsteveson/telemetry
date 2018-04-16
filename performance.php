<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$data = file_get_contents("php://input");
$data = json_decode($data,true);

foreach ($data['navigation'] as $navigationTiming) {
  logNavigation($navigationTiming);
}

foreach ($data['resource'] as $resourceTiming) {
  logResource($resourceTiming);
}

function logNavigation($n) {
  $log = dns($n) . ' ' . tcp($n) . ' ' . ttfb($n) . ' ' . transfer($n) . ' ' . domcomplete($n) . ' ' . total($n) . PHP_EOL;
  error_log($log, 3, "/var/tmp/navigationPerformance.log");
}

function logResource($r) {
  $log = dns($r) . ' ' . tcp($r) . ' ' . ttfb($r) . ' ' . transfer($r) . ' ' . total($r) . PHP_EOL;
}

function dns($timing) {
	return $timing['domainLookupEnd'] - $timing['domainLookupStart'];
}

function tcp($timing) {
	return $timing['connectEnd'] - $timing['connectStart'];
}

function ttfb($timing) {
	return $timing['responseStart'] - $timing['startTime'];
}

function transfer($timing) {
	return $timing['responseEnd'] - $timing['responseStart'];
}

function domcomplete($timing) {
	return $timing['domComplete'] - $timing['domLoading'];
}

function total($timing) {
	return $timing['duration'];
}

?>