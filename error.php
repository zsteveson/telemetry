<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$data = file_get_contents("php://input");
$logJavaScriptError(json_decode($data,true);)

function logJavaScriptError($e) {
	error_log(format($e), 3, "/var/tmp/telemetry.log");
}

function format($error) {
	return $e['message'] . ' ' . $e['url'] . ' ' . $e['line'] . ' ' . $e['column'] . PHP_EOL;
}
?>