<?php

namespace Framework\Controller;

use App\Entity\PlayerSettings;

Class GenerateJson
{
    function generateJson($playerOne, $playerTwo, $playerThree, $playerFour, $playerFive, $playerSix, $colorOne, $colorTwo, $colorThree, $colorFour, $colorFive, $colorSix) {

        $colors = array();
        
        $playersTemp = array($playerOne, $playerTwo, $playerThree, $playerFour, $playerFive, $playerSix);
        $colorsTemp = array($colorOne, $colorTwo, $colorThree, $colorFour, $colorFive, $colorSix);

        foreach ($playersTemp as $player){
            if($player != "") {
                $players[] = $player;
            }
        }
        foreach ($colorsTemp as $color){
            if($color != ""){
                $colors[] = $color;
            }
        }
        for ($i = 0; $i < count($players); $i++) {
            if($i === 0){
                $playerSettings[] = array('name' => $players[$i], 'color' => $colors[$i], 'host' => true);
            }else {
                $playerSettings[] = array('name' => $players[$i], 'color' => $colors[$i], 'host' => false);
            }
        }

        $json = array();
        $json['nbrPlayers'] = count($players);
        $json['players'] = $playerSettings;


        $json = json_encode($json);

        if (file_put_contents("../dataPlayer.json", $json)){
            //echo "JSON file created successfully...";
        }
        else {
            //echo "Oops! Error creating json file...";
        }

        return $json;
    }
}


