<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 
include_once 'Turn.php';
// initialize object
$takeTurn = new bowlingNS\Turn;
$data=['pins'=>0];
$knockedDown = $takeTurn->returnPinsSingleTurn(10);
$data['pins']=$knockedDown;
echo json_encode($data); 
?>