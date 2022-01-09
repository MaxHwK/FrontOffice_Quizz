<?php

namespace App\Controller\User;

use Framework\Controller\AbstractController;
use Framework\Controller\CrudUserController;

class Connection extends AbstractController
{
  public function __invoke()
  {
    $crud = new CrudUserController;
    $verif2 = true;
    $verif1 = true;

    if ($this->isPost()) {
        if (empty($_POST['username'])) {       
            $userNameError = 'Le nom d\'utilisateur est obligatoire !';
            $verif1 = false;
        }
        if (empty($_POST['password'])) {
            $passwordError = 'Le mot de passe est obligatoire !';
            $verif2 = false;
        } 
        if($verif1 && $verif2){
          $ispost = true;
          $password = htmlspecialchars($_POST['password']);
          $username = htmlspecialchars($_POST['username']);
  
          if ($this->checkUserCredentials($username, $password)) {
              session_start();
              $connectedUser = $crud->getUserByUsername($username);
              $_SESSION['user'] = $connectedUser;
              $this->redirect('/');
          } else {  
              $IdentificationError = "Mot de passe ou nom d'utilisateur incorrect !";
          }
        }
    }

    return $this->render(
      'user/connection.html.twig',
      [
        'IdentificationError' => $IdentificationError ?? null,
        'passwordError' => $passwordError ?? null,
        'userNameError' => $userNameError ?? null,
        'ispost' => $ispost ?? null,
      ]);
  }
}

