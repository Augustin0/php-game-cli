<?php

include "./fruits/fruits.php";


class Utils{ 

    protected  $infoGame;
    protected $headerGame;
    protected $winWidth;
    protected $headerConfig;
    protected $configurationOptions;
    protected $optionText;
    protected $totalPlayerText;
    protected $roundText;
    protected $nameFruitText;
    protected $ptFruitText;
    protected $initText;
    protected $Fruits;
    protected  $sentencia;

   
    function __construct(){
      $this->winWidth=100;
      $this->sentencia=-40;

      $this->infoGame="Es un simple juego de frutas. Te daremos la opcion de seleccionar en un rango de numeros de 1 - x, si seleccionas un numero fuera del rango dado, te tocara una sentencia, si no pasas el valor correcto tambien seras sentenciado por la maquina , eso le dara a tus compañeros mas posibilidad de ganar el juego. Al pasar un valor en rango dado, te daremos como obsequio una fruta, esta fruta puede sumar tu posibilidad de ganar y a lavez puede restarle, podras elegir la cantidad de rondas que quieres  y elegir cuantas personas participaran en el juego, por defecto deran 2, al final de las rondas que configuraste , selecionaremos a un ganador. ";
      $this->headerGame=" Fruits Game ";
      $this->headerConfig=" Configuracion del juego ";
      $this->configurationOptions=array("1 - Total Jugador".$this->br(1),"2 - Total rondas".$this->br(1),"3 - Ver frutas y puntos".$this->br(1),"4 - Agregar nueva fruta & valor".$this->br(1),"5 - Iniciar Juego".$this->br(2));
      $this->optionText="Ingresa una opcion >>";
      $this->totalPlayerText="Total de jugadores >>";
      $this->roundText="Total de rondas >>";
      $this->nameFruitText="Nombre de fruta >>";
      $this->ptFruitText="Valor de fruta >>";
      $this->Fruits=new Fruit();
    } 
  
 


  protected function getInfo(){
        echo $this->br(1);
        return   $this->formatBody($this->infoGame,$this->winWidth);
    }



   protected function getHeader($decoration){
        echo $this->br(1);
       return  $this->formatHeader($this->headerGame ,$this->winWidth, $decoration);
    }



    
   
   function formatBody($textBody,$winWidth){
       $result="";
       $cut=0;
      $Chars= str_split($textBody);

      for($i=0; $i<count($Chars);$i++){
         $result .=$Chars[$i]?$Chars[$i]:"";
         if($cut===$winWidth || $i===count($Chars)-2){
            $result .=$this->br(1);
            $cut=1;
         }
         $cut++;
        }
        return $result;
   
    }




     
    function formatHeader($text, $winWidth, $decoration){
       $center=round(($winWidth-strlen($text))/2);
       $res="";
       for ($i=0; $i <= $winWidth-strlen($text); $i++) { 
            if($center==$i){
                $res.=$text;
              }
            $res.= $decoration;
            if($i===$winWidth-strlen($text))$res.=$this->br(2);
       }
       return $res; 
    }





    
    function formatItemValue($item,$value,$width,$decoration){
        $width=$width-(strlen($item)+strlen($value));
        $res="";
       for ($i=0; $i <$width ; $i++) { 
        $res .=$decoration;
       }
       return "$item $res $value \n";
    }





    function br($total){
         $res="";
        for ($i=0; $i < $total; $i++) { 
            $res.="\n";
        }
        return $res;
    }
   
    



  


}
