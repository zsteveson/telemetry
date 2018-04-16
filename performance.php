<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$data = file_get_contents("php://input");
$data = json_decode($data,true);

logNavigation($data['navigation']);

$resourceTimings = $data['resource'];

print_R($resourceTimings);
foreach ($resourceTimings as $r) {
  logResource($r);
}

function logNavigation($n) {
  $log  = dns($n) . ' ' . tcp($n) . ' ' . ttfb($n) . ' ' . transfer($n) . ' ';
  $log .= dominteractive($n) . ' ' . domcomplete($n) . ' ' . onload($n) . ' ' . totalPageLoadTime($n) . PHP_EOL;
  error_log($log, 3, "/var/tmp/navigationPerformance.log");
}

function logResource($r) {
  $log = dns($r) . ' ' . tcp($r) . ' ' . ttfb($r) . ' ' . transfer($r) . ' ' . duration($r) . PHP_EOL;
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

function onload($timing) {
	return $timing['loadEventEnd'] - $timing['loadEventStart'];
}

function duration($timing) {
	return $timing['duration'];
}

function totalPageLoadTime($timing) {
	$timing['loadEventEnd'] - $timing['navigationStart'];
}

?>