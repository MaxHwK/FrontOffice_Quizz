<?php

namespace App\Controller\Game;

use Framework\Controller\AbstractController;
use Framework\Controller\CrudUserController;

class Autocomplete extends AbstractController 
{
    public function __invoke()
    {
        $crud = new CrudUserController();

        $listUsers = $crud->readAllUsers();
        $results = array();
        $find = $_GET['Rec'];
    
        foreach ($listUsers as $user) { 
            if (stripos($user->getUsername(), $find) !== false) { 
                array_push($results, $user->getUsername());
            }
        }
        sort($results);
        $resultsText = implode("|", $results);
        echo $resultsText;
    }
}

