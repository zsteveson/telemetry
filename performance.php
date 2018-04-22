<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$data = file_get_contents("php://input");
$data = json_decode($data,true);

logNavigation($data['location'], $data['navigation']);

foreach ($data['resource'] as $resourceTiming) {
  logResource($resourceTiming);
}

function logNavigation($url, $n) {
  $log  = $url . ' ' . dns($n) . ' ' . tcp($n) . ' ' . ttfb($n) . ' ' . transfer($n) . ' ';
  $log .= dominteractive($n) . ' ' . domcomplete($n) . ' '  . totalPageLoadTime($n) . PHP_EOL;
  $log = Array('this' => 5);
  $log = json_encode($log);
  error_log($log, 3, "/var/tmp/pageperformance.log");
}

function logResource($r) {
  $log = name($r) . ' ' . dns($r) . ' ' . tcp($r) . ' ' . ttfb($r) . ' ' . transfer($r) . ' ' . duration($r) . PHP_EOL;
  error_log($log, 3, "/var/tmp/resourceperformance.log");
}

function name($timing) {
	return $timing['name'];
}

function dns($timing) {
	return $timing['domainLookupEnd'] - $timing['domainLookupStart'];
}

function tcp($timing) {
	return $timing['connectEnd'] - $timing['connectStart'];
}

function ttfb($timing) {
	return $timing['responseStart'] - $timing['requestStart'];
}

function transfer($timing) {
	return $timing['responseEnd'] - $timing['responseStart'];
}

function dominteractive($timing) {
	return $timing['domInteractive'] - $timing['domLoading'];
}

function domcomplete($timing) {
	return $timing['domComplete'] - $timing['domInteractive'];
}

function duration($timing) {
	return $timing['duration'];
}

function totalPageLoadTime($timing) {
	$timing['loadEventEnd'] - $timing['navigationStart'];
}

?>