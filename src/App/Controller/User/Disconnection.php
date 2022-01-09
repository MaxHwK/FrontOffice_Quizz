<?php

namespace App\Controller\User;

use Framework\Controller\AbstractController;


class Disconnection extends AbstractController
{
    public function __invoke()
    {
        session_start();
        session_destroy();
        $this->redirect('/');

    }
}