<?php

class GameTest extends PHPUnit_Framework_TestCase
{
    public function testPerfectScore()
    {
        $values = array(10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10);
        $a = new bowlingNS\Game;
        $a->getTotalScore($values);
        $this->assertEquals(300, $a->score);
    }
    
    public function testZeroScore()
    {
        $values = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        $a = new bowlingNS\Game;
        $a->getTotalScore($values);
        $this->assertEquals(0, $a->score);
    }
    
    public function testTwoStrikesScore()
    {
        $values = array(10, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        $a = new bowlingNS\Game;
        $a->getTotalScore($values);
        $this->assertEquals(30, $a->score);
    }
    
    public function testTwoStrikesEighthFrameScore()
    {
        $values = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, 10, 0, 0);
        $a = new bowlingNS\Game;
        $a->getTotalScore($values);
        $this->assertEquals(30, $a->score);
    }
    
    public function testTwoStrikesNinthFrameScore()
    {
        $values = array(0, 0,      0, 0,      0, 0,      0, 0,      0, 0,     0, 0,     0, 0,     0, 0,     10,     10, 0, 0);
        $a = new bowlingNS\Game;
        $a->getTotalScore($values);
        $this->assertEquals(30, $a->score);
    }
    
    public function testSpareStrikeEighthFrameScore()
    {
        $values = array(0, 0,   0, 0,   0, 0,   0, 0,   0, 0,   0, 0,   0, 0,   5, 5,   10,   0, 0);
        $a = new bowlingNS\Game;
        $a->getTotalScore($values);
        $this->assertEquals(30, $a->score);
    }
    
    public function testSpareStrikeNinthFrameScore()
    {
        $values = array(0, 0,   0, 0,   0, 0,   0, 0,   0, 0,   0, 0,   0, 0,   0, 0,   5, 5,   10, 0, 0);
        $a = new bowlingNS\Game;
        $a->getTotalScore($values);
        $this->assertEquals(30, $a->score);
    }
    
    public function testFiveSpareScore()
    {
        $values = array(5, 5,     5, 5,     5, 5,     5, 5,     5, 5,     5, 5,     5, 5,     5, 5,     5, 5,     5, 5, 5);
        $a = new bowlingNS\Game;
        $a->getTotalScore($values);
        $this->assertEquals(150, $a->score);
    }
}
?>
//phpunit --bootstrap php/autoload.php tests/gameTest