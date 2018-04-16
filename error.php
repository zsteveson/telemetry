<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$data = file_get_contents("php://input");
logJavasScriptError(json_decode($data,true));

function logJavasScriptError($e) {
	error_log(formatError($e), 3, "/var/tmp/telemetry.log");
}

function formatError($error) {
	return $e['message'] . ' ' . $e['url'] . ' ' . $e['line'] . ' ' . $e['column'] . PHP_EOL;
}
?>