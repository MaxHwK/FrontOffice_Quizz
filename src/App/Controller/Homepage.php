<?php

namespace App\Controller;

use Framework\Controller\AbstractController;

class Homepage extends AbstractController
{
    public function __invoke(): string
    {
        session_start();
        if($this->sessionIsStarted($_SESSION)){
            $currentUser = $_SESSION['user'] ?? null;

            foreach($currentUser->getRole() as $role) {
                if($role === 'ROLE_ADMIN') {
                    $userRole = 'ROLE_ADMIN';
                    break;
                } else {
                    $userRole = 'ROLE_USER';
                }
            }
        }
    
        return $this->render('home.html.twig', [
            'user' => $currentUser ?? null,
            'role' => $userRole ?? null,
        ]);
    }
}
