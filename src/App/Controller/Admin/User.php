<?php

namespace App\Controller\Admin;

use Framework\Controller\AbstractController;
use Framework\Controller\CrudUserController;

class User extends AbstractController
{
    public function __invoke(): string
    {
        $crud = new CrudUserController();
        $iduser = $_GET['iduser'] ?? null;

        if($iduser != null){
            $crud->deleteUser($iduser);
        }

        return $this->render('admin/listUser.html.twig', [
            'users' => $crud->readAllUsers(),
        ]);
    }
}
