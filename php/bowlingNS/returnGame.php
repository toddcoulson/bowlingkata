<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 
include_once 'Game.php';
// initialize object
$wholeGame = new bowlingNS\Game;

$data=['score'=>0];
$gameScore = $wholeGame->getTotalScore();
$data['score']=$gameScore;
$data['display']= $wholeGame->displayScores;
echo json_encode($data); 
?>