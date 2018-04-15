<?php
header('Access-Control-Allow-Origin: *');
$data = file_get_contents("php://input");
$e = json_decode($data,true);
$log = $e['message'] . $e['url'] . $e['line'] . ' ' . $e['column'] . $e['error'] . PHP_EOL;
error_log($log, 3, "/var/tmp/telemetry.log");
echo $log
?>