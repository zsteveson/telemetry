<?php
header('Access-Control-Allow-Origin: *');
$data = file_get_contents("php://input");
$error = json_decode($data,true);
print_r($error);
$errorLog = $error['message'] . ' ';
$errorLog .= $error['url'] . ' ';
$errorLog .= $error['line'] . ' '; 
$errorLog .= $error['column'] . ' ';
$errorLog .= $error['error'] . PHP_EOL;
error_log($errorLog, 3, "/var/tmp/telemetryError.log");
?>