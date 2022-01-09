<?php

namespace App\Controller\Admin;

use Framework\Controller\AbstractController;
use Framework\Controller\statsController;

class AdminHomepage extends AbstractController
{
    public function __invoke(): string
    {
        session_start();
        if($this->sessionIsStarted($_SESSION)){
            $currentUser = $_SESSION['user'] ?? null;
        }

        return $this->render('admin/adminHomepage.html.twig', [
            'user' => $currentUser ?? null,
            'numberOfUsers' => $this->getNumberOfUsers(),
            'numberOfQuestions' => $this->getNumberOfQuestions(),
        ]);
    }
}
