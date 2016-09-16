<?php 

namespace bowlingNS;

include_once 'Turn.php';

class Frame{ 
    // database connection and table name 
    public $turnOne;
    public $turnTwo;
    public $turnThree;
    public $value;
    public $total;
    public $type;
 
    // constructor  
    public function __construct(){ 
        
    }
    
    public function returnPinsFrame($frame, $mockOne = -1, $mockTwo = -1, $mockThree = -1){
        $stop = false;
        $turn = new Turn();
        if($mockOne === -1){
            $this->turnOne = $turn->returnPinsSingleTurn(10);
        }else{
            $this->turnOne = $turn->returnPinsSingleTurn($mockOne, false);
        }
        
        if($this->turnOne === 10){
            $this->value = "X";
            $this->total = 10;
            $frame === 10 ? $stop = false : $stop = true;
        }
        
        //check stop for second ball. No second ball on frame 1-9 and no strike
        if($stop){
            $this->type = "strike";
            return $this->value;
        }
        
        //reload pins if needed
        if($frame === 10 && $this->total === 10){
           $remainingPins = 10; 
        } else{
            $remainingPins = 10 - $this->turnOne;
        }
        
        //turn two
        if($mockTwo === -1){
            $this->turnTwo = $turn->returnPinsSingleTurn($remainingPins);
        }else{
            $this->turnTwo = $turn->returnPinsSingleTurn($mockTwo, false);
        }
        
        if($this->turnTwo === $remainingPins){
            if($this->value === "X"){
                $this->value = "XX";
            } else{
                $this->value = $this->turnOne . '\\';
                $this->total = 10;
                $this->type = "spare";
            }
            $remainingPins = 10;

        }else{
            if($this->value === "X"){
                $this->value =  "X" . $this->turnTwo;
                $this->total =  10 + $this->turnTwo;
                $remainingPins = $remainingPins - $this->turnTwo;
            }else{
                $this->value = $this->turnOne . $this->turnTwo;
                $this->total = $this->turnOne + $this->turnTwo;
                $remainingPins = -1;
            }
        }
        
        //check for third ball
       $valueHasX = strpos($this->value, "X");
           $valueHasSlash = strpos($this->value, "\\");
       if(($frame === 10) && ($this->total > 9)){
           if($mockThree === -1){
                $this->turnThree = $turn->returnPinsSingleTurn($remainingPins);
            }else{
                $this->turnThree = $turn->returnPinsSingleTurn($mockThree, false);
            }
            
            if($this->turnThree === $remainingPins){
                if($this->value === "XX"){
                    $this->value === "XXX";
                    $this->total = 30;
                }else if($valueHasX == 0){
                    $this->value = "X" . $this->turnTwo . "\\";
                    $this->total = 20;
                }else if($valueHasSlash == 1){
                    $this->value = $this->turnOne . "\\X";
                    $this->total = 20;
                }else{
                    $this->value .= $this->turnThree;
                    $this->total += $this->turnThree;
                }
            }else{
                $this->value .= $this->turnThree;
                $this->total += $this->turnThree;
            }
        }
        $this->value = str_replace("0", "-", $this->value);
        return $this->value;
    }
}
?>