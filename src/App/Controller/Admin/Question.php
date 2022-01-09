<?php

namespace App\Controller\Admin;

use Framework\Controller\AbstractController;
use Framework\Controller\CrudQuestionController;

class Question extends AbstractController
{
    public function __invoke(): string
    {
        $crud = new CrudQuestionController();
        $idquestion = $_GET['idquestion'] ?? null;

        if($idquestion != null){
            $crud->deleteQuestion($idquestion);
        }

        return $this->render('admin/listQuestion.html.twig', [
            'questions' => $crud->readAllQuestions(),
        ]);
    }
}
