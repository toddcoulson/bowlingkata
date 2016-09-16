<?php 

namespace bowlingNS;

class Turn{ 
    // database connection and table name 
    private $currentTurn;
 
    // constructor  
    public function __construct(){ 
        
    }
    
    public function returnPinsSingleTurn($pins, $random = true){
        if($random === true){
            $this->currentTurn = mt_rand(0, $pins);
        }else{
            $this->currentTurn = $pins;
        }
        
        return $this->currentTurn;
    }
}
?>