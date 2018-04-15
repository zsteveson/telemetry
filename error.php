<?php

$rawData = file_get_contents("php://input");
$error = json_decode($rawData);

$log = "$error['message'] $error['url'] $error['line'] $error['column'] $error['error']PHP_EOL" 
error_log("$log", 3, "/var/tmp/telemetryPerformance.log");

?>