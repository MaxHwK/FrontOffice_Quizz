<?php

namespace App\Controller\Admin;

use App\Entity\Answer;
use Framework\Controller\AbstractController;
use Framework\Controller\CrudQuestionController;

class QuestionUpdate extends AbstractController
{
    public function __invoke(): string
    {
        $crud = new CrudQuestionController();
        $idanswer = $_GET['idanswer'] ?? null;
        $errors = [];
        $listAnswers = [];

        if($idanswer != null){
            $crud->deleteAnswer($idanswer);
        }

        $currentQuestion = $crud->getQuestionById($_GET['idquestion']);
        
        if ($this->isPost()) {
            $validations = [
                'label' => [
                    'rules' => [
                        ['name' => 'required'],
                        ['name' => 'isString'],
                    ]
                ],
                'level' => [
                    'rules' => [
                        ['name' => 'required'],
                        ['name' => 'max', 'value' => 6],
                        ['name' => 'min', 'value' => 1],
                    ]
                ],
                'answers' => [
                    'rules' => [
                        ['name' => 'arrayVerif'],
                    ]
                ],
                'answers' => [
                    'rules' => [
                        ['name' => 'arrayVerif'],
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
                        case 'isString':
                            if (!is_string($_POST[$fieldName])) {
                                $errors[$fieldName][] = 'Ce champs doit etre une chaine de caractères !';
                            }
                            break;
                        case 'max':
                            if ($_POST[$fieldName] > $rule['value']) {
                                $errors[$fieldName][] = 'La valeur de ce champs ne doit pas dépasser ' . $rule['value'] . ' !';
                            }
                            break;
                        case 'min':
                            if ($_POST[$fieldName] < $rule['value']) {
                                $errors[$fieldName][] = 'La valeur de ce champs ne doit pas dépasser ' . $rule['value'] . ' !';
                            }
                            break;
                        case 'arrayVerif':
                            foreach ($_POST[$fieldName] as $answer) {
                                if (empty($answer)) {
                                    $errors[$fieldName][] = 'Les champs réponses ne doivent pas être vides !';
                                    break;
                                }
                            }
                            break;
                    }
                }
              }
        
              if (empty($errors)) {
                  $currentQuestion->setLabel($_POST['label']);
                  $currentQuestion->setLevel($_POST['level']);
                  $i = 0;
                  
                  foreach ($_POST['answers'] as $answer) {
                      if(is_null($currentQuestion->getAnswers()[$i])){
                          $valid = $_POST['valid'][0] ?? 0;
                      } else {
                          $valid = $_POST['valid'.$currentQuestion->getAnswers()[$i]->getId()] ?? 0;
                      }
                        $currentAnswer = new Answer(0, $answer, $_GET['idquestion'], $valid);
                        array_push($listAnswers, $currentAnswer);
                        $i++;                    
                  }
                  $currentQuestion->setAnswers($listAnswers);
                  $isUpdated = $crud->updateQuestion($currentQuestion);
        
                if ($isUpdated) {
                    $this->redirect('/question');
                } else {
                    $updateError = 'Une erreur est survenue pendant la modification !';
                }
                die;
              }
        }

        return $this->render('admin/questionUpdate.html.twig', [
            'question' => $currentQuestion,
            'labelError' => $this->displayErrors($errors , 'label') ?? null,
            'levelError' => $this->displayErrors($errors , 'level') ?? null,
            'answersError' => $this->displayErrors($errors , 'answers') ?? null,
            'updateError' => $updateError ?? null,
        ]);
    }
}
