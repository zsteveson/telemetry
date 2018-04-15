<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$data = file_get_contents("php://input");
$e = json_decode($data,true);

$log = $e['message'] . ' ' . $e['url'] . ' ' . $e['line'] . ' ' . $e['column'] . PHP_EOL;
error_log($log, 3, "/var/tmp/telemetry.log");
echo $log
?>

