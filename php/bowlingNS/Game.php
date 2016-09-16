<?php 

namespace bowlingNS;

include_once 'Frame.php';

class Game{ 
    // database connection and table name 
    private $frames = array();
    public $displayScores = array();
    public $score;
 
    // constructor  
    public function __construct(){ 
        
    }
    
    private function playGame(){
        for($i=0; $i<10; $i++){
            $frame = new Frame();
            $display = $frame->returnPinsFrame($i+1);
            array_push($this->displayScores, $display);
            array_push($this->frames, $frame);
        }
    }
    
    private function testGame($values = array()){
        $roll1 = -1;
        $roll2 = -1;
        $frameNum = 1;
        for($i = 0; $i < count($values); $i++){
            if($roll1 === -1){
                if($values[$i]===10){
                    $frame = new Frame();
                    $display = $frame->returnPinsFrame($frameNum, 10);
                    array_push($this->displayScores, $display);
                    array_push($this->frames, $frame);
                    $roll1 = -1;
                    $frameNum++;
                    if($frameNum === 10){
                        if($i === count($values)-3){
                               $frame = new Frame();
                               $roll1 = $values[$i+1];
                               $roll2 = $values[$i+2];
                               $display = $frame->returnPinsFrame($frameNum, $roll1, $roll2);
                               array_push($this->displayScores, $display);
                               array_push($this->frames, $frame);
                               $i = count($values);
                           } else if($i === count($values)-4){
                               $frame = new Frame();
                               $roll1 = $values[$i+1];
                               $roll2 = $values[$i+2];
                               $roll3 = $values[$i+3];
                               $display = $frame->returnPinsFrame($frameNum, $roll1, $roll2, $roll3);
                               array_push($this->displayScores, $display);
                               array_push($this->frames, $frame);
                               $i = count($values);
                           }  
                    }
                }else{
                    $roll1 = $values[$i];
                }
            }else{
                $roll2 = $values[$i];
                $frame = new Frame();
                $display = $frame->returnPinsFrame($frameNum, $roll1, $roll2);
                array_push($this->displayScores, $display);
                array_push($this->frames, $frame);
                $roll1 = -1;
                $roll2 = -1;
                $frameNum++;
                if($frameNum === 10){
                   if($i === count($values)-3){
                       $frame = new Frame();
                       $roll1 = $values[$i+1];
                       $roll2 = $values[$i+2];
                       $display = $frame->returnPinsFrame($frameNum, $roll1, $roll2);
                       array_push($this->displayScores, $display);
                       array_push($this->frames, $frame);
                       $i = count($values);
                   } else if($i === count($values)-4){
                       $frame = new Frame();
                       $roll1 = $values[$i+1];
                       $roll2 = $values[$i+2];
                       $roll3 = $values[$i+3];
                       $display = $frame->returnPinsFrame($frameNum, $roll1, $roll2, $roll3);
                       array_push($this->displayScores, $display);
                       array_push($this->frames, $frame);
                       $i = count($values);
                   }     
                }
            }
        }
    }
    
    function getTotalScore($values = array()){
        $count = count($values);
        if($count === 0){
            $this->playGame();
        }else{
            $this->testGame($values);
        }
        $this->score = 0;
        $loopTotal = count($this->frames);
        for($i=0; $i<$loopTotal; $i++){
            $this->score += $this->frames[$i]->total;
            
            if($i < $loopTotal-2){
                if($this->frames[$i]->type === "spare")$this->score += $this->frames[$i + 1]->turnOne;
                if($this->frames[$i]->type === "strike")$this->score += $this->frames[$i + 1]->total;
                if($this->frames[$i]->type === "strike" && $this->frames[$i + 1]->type === "strike")$this->score += $this->frames[$i + 2]->turnOne;
            }else if($i == $loopTotal-2){
                if($this->frames[$i]->type === "spare" || $this->frames[$i]->type === "strike")$this->score += $this->frames[$i + 1]->turnOne;
                if($this->frames[$i]->type === "strike" && $this->frames[$i + 1]->turnOne === 10)$this->score += $this->frames[$i + 1]->turnTwo;
            }   
        }
        return $this->score;
    }
}
?>
