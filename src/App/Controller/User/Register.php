<?php

namespace App\Controller\User;

use App\Entity\User;
use Framework\Controller\AbstractController;
use Framework\Controller\CrudUserController;

use DateTime;

class Register extends AbstractController
{
  public function __invoke()
  {
    $crud = new CrudUserController();
    $errors = [];

    if ($this->isPost()) {

      $validations = [
        'username' => [
            'rules' => [
                ['name' => 'required'],
                ['name' => 'maxlength', 'value' => 20],
                ['name' => 'isString'],
                ['name' => 'unique'],
            ]
        ],
        'password' => [
            'rules' => [
                ['name' => 'required'],
                ['name' => 'maxlength', 'value' => 100]
            ]
        ],
        'confpwd' => [
            'rules' => [
                [
                    'name' => 'sameAs',
                    'field' => 'password',
                    'validationMessage' => 'Les mots de passe doivent correspondre'
                ],
            ]
        ],
        'firstName' => [
            'rules' => [
                ['name' => 'required'],
                ['name' => 'maxlength', 'value' => 100]
            ]
        ],
        'lastName' => [
            'rules' => [
                ['name' => 'required'],
                ['name' => 'maxlength', 'value' => 100]
            ]
        ],
        'email' => [
            'rules' => [
                ['name' => 'required'],
                ['name' => 'maxlength', 'value' => 100],
                ['name' => 'email'],
            ]
        ],
      ];

      foreach ($validations as $fieldName => $params) {
        foreach ($params['rules'] as $rule) {
            switch ($rule['name']) {
                case 'required':
                    if (empty($_POST[$fieldName])) {
                        $errors[$fieldName][] = 'Le champs est obligatoire';
                    }
                    break;
                case 'maxlength':
                    if (strlen($_POST[$fieldName]) > $rule['value']) {
                        $errors[$fieldName][] = 'La valeur de ce champs ne doit pas dépasser ' . $rule['value'] . ' caractères !';
                    }
                    break;
                case 'email':
                    if (!filter_var($_POST[$fieldName], FILTER_VALIDATE_EMAIL)) {
                        $errors[$fieldName][] = 'Ce champs doit contenir une adresse email valide !';
                    }
                    break;
                case 'sameAs':
                    if ($_POST[$fieldName] !== $_POST[$rule['field']]) {
                        $errors[$fieldName][] = $rule['validationMessage'];
                    }
                    break;
                case 'isString':
                    if (!is_string($_POST[$fieldName])) {
                        $errors[$fieldName][] = 'Ce champs doit etre une chaine de caractères !';
                    }
                    break;
                case 'unique':
                    if ($this->userExists($_POST[$fieldName])) {
                        $errors[$fieldName][] = 'Username déjà existant !';
                    }
                    break;
            }
        }
      }

      if (empty($errors)) {
          $dt = new DateTime();
          $newRegisteredUser = new User(0, $_POST['username'], $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password'], ['ROLE_USER'], $dt->format('Y-m-d H:i:s'));
          $isRegistered = $crud->createUser($newRegisteredUser);

        if ($isRegistered) {
            session_start();
            $_SESSION['user'] = $newRegisteredUser;
            $this->redirect('/');
        } else {
            $registerError = 'Une erreur est survenue pendant votre inscription !';
        }
        die;
      }
  }

    return $this->render(
      'user/register.html.twig',
      [
        'usernameError' => $this->displayErrors($errors , 'username') ?? null,
        'passwordError' => $this->displayErrors($errors , 'password') ?? null,
        'passwordConfError' => $this->displayErrors($errors , 'confpwd') ?? null,
        'firstnameError' => $this->displayErrors($errors , 'firstName') ?? null,
        'lastnameError' => $this->displayErrors($errors , 'lastName') ?? null,
        'emailError' => $this->displayErrors($errors , 'email') ?? null,
        'registerError' => $registerError ?? null,
        'post' => $_POST ?? null,
      ]);
  }
}

