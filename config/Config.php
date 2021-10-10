<?php
include "./Utils/utils.php";
include "./players/player.php";

class Config extends Utils{
  public $utils;
  private  $instancePlayer;
  private $round;

function __construct(){

    $this->utils=new Utils();
    $this->instancePlayer=new Players();
    $this->round=0;


}


   public function init(){
        echo  $this->utils->getHeader("*");
        echo  $this->utils->getInfo();
        echo  $this->gameConfiguration("*");
    }
    
    private function gameConfiguration($decoration){
        echo $this->utils->br(2);
        echo $this->utils->formatHeader($this->utils->headerConfig ,$this->utils->winWidth, $decoration);
         for ($i=0; $i < count($this->utils->configurationOptions); $i++) { 
             echo $this->utils->configurationOptions[$i];
         }
         $this->selection();
    }
        
    private function selection(){
        $option=0;
        
        do {
          $option= (int)readline($this->utils->optionText);
        } while (!$option);
        switch ($option) {
            case 1:
               $this->setPalyers();
                break;
             case 2:
               $this->setRoud();
               break;    
             case 3:
                $this->listFruits();
                break;
             case 4:
                    $this->setFruit();
                break; 
             case 5:
                $this->startGame();
                break;          
            default:
            $this->selection();
                break;
        }
    }


    private function setPalyers(){
        $total=0;
        do {
        $total=(int)readline($this->utils->totalPlayerText);
        } while (!$total);
   
          for ($i=1; $i <$total+1 ; $i++) { 
              $nombre="";
              do {
               $nombre=(string)readline("Ingresa el nombre del Jugador $i >>");
              } while (!$nombre);
              $this->instancePlayer->setPlayer(new Player($nombre));
          }
        echo $this->utils->br(1);
        $this->selection();
   
      }

      private function setRoud(){
        do {
        $this->round=(int)readline($this->utils->roundText);
        } while (!$this->round);
          echo $this->utils->br(1);
         $this->selection();

   }

   private function startGame(){
    $list_player =$this->instancePlayer->getPlayers();
    $rouds=$this->round;
     if(!count($list_player) || !$rouds){
        echo ("Es Obligatorio  agregar los Jugadores que participaran E ingresar el total de rondas que jugaran (Opcion 1 y 2)".$this->utils->br(2));
        $this->selection();

     }else{
    $this->showConfiguration();
    $this->startRound();
     }

   }

  private function showConfiguration(){
    echo $this->utils->br(1)."Lista de  Jugadores".$this->utils->br(2);
    $list =$this->instancePlayer->getPlayers();
    foreach( $list as $player){
       echo("☺  ".$player->getName().$this->utils->br(1));
    }
    echo($this->utils->br(1)."Total rondas: ".$this->round.$this->utils->br(2));
  }
  
 private function startRound(){

    for ($i=$this->round; $i >= 0;  $i--) { 
       $this->roundx();
       $this->round--;
    }
    $this->showWinner();  

    }

    private function roundx(){

        $list_player =$this->instancePlayer->getPlayers();
        $fruit_ =$this->utils->Fruits->listFruits(); 

        echo $this->utils->br(1);
        foreach ($list_player as $player) {
            $number=0;
            do {
              $number=(int)readline($player->getName()." Selecciona un numero entre 0 y ".count($fruit_)." >>");
            } while (!$number);
            if( (int)$number <= count($fruit_) && (int)$number > 0){
              $randNumber=rand(1,(int)$number);
              $player->setScore($fruit_[$randNumber]["pt"]);
              $res=$this->utils->formatItemValue($fruit_[$randNumber]["name"],$fruit_[$randNumber]["pt"]." Puntos",$this->utils->winWidth,"*");
              echo($this->utils->br(1)."Resultado :".$this->utils->br(2).$res.$this->utils->br(2));
              $this->showScore($player->getName());
            }else{
               $SENTENCIA=$this->utils->sentencia;
              echo($this->utils->br(1)."Resultado :".$this->utils->br(2).$res.$this->utils->br(2)."Sentencia de $SENTENCIA puntos, la proxima seleciona un numero valido".$res.$this->utils->br(2));
                $player->setScore($SENTENCIA);
                $this->showScore($player->getName());
            }
        }
      }

    
    private  function showWinner(){
        $list =$this->instancePlayer->getPlayers();
        $player_score=array();
        foreach ($list as $name => $Player) {
          $player_score[$name]=array("name"=>$name,"pt"=>$Player->getScore());
        }
        $winner=max($player_score);
        $loser=min($player_score); 
      
        echo ("El ganador es ...: ".$winner["name"]."  Con un total de ".$winner["pt"]." Puntos".$this->utils->br(2));
        echo ("Anuciando el perdedor : ".$loser["name"]."  Con un total de ".$loser["pt"]." Puntos".$this->utils->br(2));
        $this->selection();
        
    }
           
   private function showScore($activPlayer){
    $list =$this->instancePlayer->getPlayers();
    $res=$this->utils->formatItemValue("☺  ".$activPlayer,$list[$activPlayer]->getScore()." Puntos",$this->utils->winWidth,"*");
    echo   $res;
    foreach($list as $player){
        if($player->getName()!=$activPlayer){
        $res=$this->utils->formatItemValue("☺  ".$player->getName(),$player->getScore()." Puntos",$this->utils->winWidth,"*");
        echo   $res;
      }
    }
    $res=$this->utils->formatItemValue("Rondas  restantes ",$this->round,$this->utils->winWidth,"*");
    echo   $this->utils->br(1).$res.$this->utils->br(2);
    
   }


 private  function listFruits(){
    $list= $this->utils->Fruits->listFruits();
   foreach($list as $fruit){
       $res=$this->utils->formatItemValue($fruit["name"],$fruit["pt"]." Puntos",$this->utils->winWidth,"*");
       echo   $res;
   }
   echo $this->utils->br(1);
   $this->selection();
 }



private function setFruit(){
     $name="";
     $pt=0;

     do {
      $name=(string)readline($this->utils->nameFruitText);
     } while (!$name);
     do {
      $pt=(int)readline($this->utils->ptFruitText);
     } while (!$pt);
      $this->utils->Fruits->setFruit($name,$pt); 
      $res=$this->utils->formatItemValue($name,$pt." Puntos",$this->utils->winWidth,"*");
      echo ($res.$this->utils->br(1));
      $this->selection();
 }


}