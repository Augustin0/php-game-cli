<?php

class Fruit{
  private $name,$pt,$listFruits;
  function __construct(){
     if($this->listFruits){
        $this->listFruits= $this->listFruits;
     }else{
        $this->listFruits=array(
            1=>array("pt"=>12,"name"=>"mango"),
            2=>array("pt"=>20,"name"=>"Guayaba"),
            3=>array("pt"=>20, "name"=>"Guayaba"),
            4=>array("pt"=>50,"name"=>"Manzana"),
            5=>array("pt"=>150, "name"=>"Pera"),
            6=>array("pt"=>-50,"name"=>"Cereza"),
            7=>array("pt"=>-30,"name"=>"Tamarindo")
            );;
    }
  }


  function listFruits(){

   return  $this->listFruits; 
  }
  
function setFruit($name,$pt){
    $totalFrutas=count($this->listFruits);
    $this->listFruits[$totalFrutas+1]=array("name"=>$name,"pt"=>$pt); 
}



}