<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$data = file_get_contents("php://input");
$error = json_decode($data,true);

$log = $error['message'] . ' ' . $error['url'] . ' ' . $error['line'] . ' ' . $error['column'] . PHP_EOL;
error_log($log, 3, "/var/tmp/telemetry.log");
echo $log
?>

