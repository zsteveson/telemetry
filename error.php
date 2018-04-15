<?php

$data = file_get_contents("php://input");
$error = json_decode($data,true);
$log = $error['message'] . ' ';
$log .= $error['url'] . ' ';
$log .= $error['line'] . ' '; 
$log .= $error['column'] . ' ';
$log .= $error['error'] . PHP_EOL;
error_log("$log", 3, "/var/tmp/telemetryError.log");
echo $log;

?>