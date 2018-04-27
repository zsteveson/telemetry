<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$data = file_get_contents("php://input");
$data = json_decode($data,true);
logJavasScriptError($data);

function logJavasScriptError($error) {
  $log = Array( 
  'message' => $error['message'],
  'url'     => $error['url'],
  'line'    => $error['line'],
  'column'  => $error['column'],
  'location'=> $error['location'],
  'type'    => 'jserror'
  );
  error_log(json_encode($log) . PHP_EOL, 3, "/var/tmp/jserrors.log");
}