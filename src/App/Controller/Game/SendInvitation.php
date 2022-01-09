<?php

namespace App\Controller\Game;

use Framework\Controller\AbstractController;
use Framework\Controller\GenerateJson;
use Framework\Controller\SendEmail;

class SendInvitation extends AbstractController 
{
    public function __invoke(): string 
    {
        session_start();
        $envMail = new SendEmail();
        if($this->isPost()) {
            $playerOne = $_POST["player-one"] ?? null;
            $playerTwo = $_POST["player-two"] ?? null;
            $playerThree = $_POST["player-three"] ?? null;
            $playerFour = $_POST["player-four"] ?? null;
            $playerFive = $_POST["player-five"] ?? null;
            $playerSix = $_POST["player-six"] ?? null;

            $colorOne = $_POST["colorOne"] ?? null;
            $colorTwo = $_POST["colorTwo"] ?? null;
            $colorThree = $_POST["colorThree"] ?? null;
            $colorFour = $_POST["colorFour"] ?? null;
            $colorFive = $_POST["colorFive"] ?? null;
            $colorSix = $_POST["colorSix"] ?? null;
        }

        if ($this->sessionIsStarted($_SESSION)) {
            $currentUser = $_SESSION['user'] ?? null;

            foreach($currentUser->getRole() as $role) {
                if ($role === 'ROLE_ADMIN') {
                    $userRole = 'ROLE_ADMIN';
                    break;
                } else {
                    $userRole = 'ROLE_USER';
                }
            }
        }
        $playerO = $_POST["playerOne"] ?? null;

        if($playerO === null) {
            $generate = new GenerateJson();
            $generate->generateJson($playerOne, $playerTwo, $playerThree, $playerFour, $playerFive, $playerSix, $colorOne, $colorTwo, $colorThree, $colorFour, $colorFive, $colorSix);    
        }
        $hash = $this->generateRandomString();

        if(!is_null($playerO)) {
            $players = array($playerO, $playerTwo, $playerThree, $playerFour, $playerFive, $playerSix);
            $envMail->SendEmail($players, $hash);
        } 

        return $this->render('game/sendInvitation.html.twig', [
            'user' => $currentUser ?? null,
            'playerone' => $playerOne ?? null,
            'playertwo' => $playerTwo ?? null,
            'playerthree' => $playerThree ?? null,
            'playerfour' => $playerFour ?? null,
            'playerfive' => $playerFive ?? null,
            'playersix' => $playerSix ?? null,
            'role' => $userRole ?? null,
            'hash' => $hash ?? null,
        ]);
  
    }

    function generateRandomString() {
        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
      