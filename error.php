<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$data = file_get_contents("php://input");
logJavasScriptError(json_decode($data,true));

function logJavasScriptError($error) {
	error_log(formatError($error), 3, "/var/tmp/telemetry.log");
}

function formatError($error) {
	return $error['message'] . ' ' . $error['url'] . ' ' . $error['line'] . ' ' . $error['column'] . PHP_EOL;
}
?>