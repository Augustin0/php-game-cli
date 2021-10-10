<?php

class Player{

private $name, $score;
function __construct($name){
    $this->name=$name;
    $this->score=0;
}

public function getName(){
    return $this->name;
}


public function setScore($score){
    $this->score+=$score;
}


public function getScore(){
   return $this->score;
}

}


class Players extends Player{
   private $players;


   function __construct(){
       $this->players=array();
   }
   
   public  function setPlayer($player){
      if(gettype($player)=="object"){
            $this->players[$player->getName()]=$player;
        }
   }
   public   function getPlayers(){
        return $this->players;
    }
  


}