<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 
include_once 'Frame.php';
// initialize object
$wholeFrame = new bowlingNS\Frame;
$data=['frame'=>0];
$knockedDown = $wholeFrame->returnPinsFrame(10);
$data['frame']=$knockedDown;
echo json_encode($data); 
?>