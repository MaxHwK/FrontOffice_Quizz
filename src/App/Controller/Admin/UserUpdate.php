<?php

namespace App\Controller\Admin;

use Framework\Controller\AbstractController;
use Framework\Controller\CrudUserController;

class UserUpdate extends AbstractController
{
    public function __invoke(): string
    {
        $crud = new CrudUserController();
        $currentUser = $crud->getUserById($_GET['iduser']);
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
                  $currentUser->setUsername($_POST['username']);
                  $currentUser->setFirstName($_POST['firstName']);
                  $currentUser->setLastName($_POST['lastName']);
                  $currentUser->setEmail($_POST['email']);
                  $isUpdated = $crud->updateUser($currentUser);
        
                if ($isUpdated) {
                    $this->redirect('/user');
                } else {
                    $updateError = 'Une erreur est survenue pendant la modification !';
                }
                die;
              }
        }

        return $this->render('admin/userUpdate.html.twig', [
            'user' => $currentUser,
            'usernameError' => $this->displayErrors($errors , 'username') ?? null,
            'firstnameError' => $this->displayErrors($errors , 'firstName') ?? null,
            'lastnameError' => $this->displayErrors($errors , 'lastName') ?? null,
            'emailError' => $this->displayErrors($errors , 'email') ?? null,
            'updateError' => $updateError ?? null,
        ]);
    }
}
