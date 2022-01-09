<?php

namespace Framework\Controller;

use Framework\Connexion\SPDO;
use App\Entity\Question;
use App\Entity\Answer;
use PDO;

Class CrudQuestionController
{
    public function readAllQuestions(): array
    {
        try{
            $listquestions = [];
            $pdo = SPDO::getInstance();
            $req = $pdo->prepare("SELECT * FROM `question`");
            $req->execute();
            $questions = $req->fetchAll(PDO::FETCH_ASSOC);
    
            foreach ($questions as $question) {
                $listanswers = [];
                $req = $pdo->prepare("SELECT * FROM `answer` 
                                      WHERE `id_question` = :id_question");
                $req->bindParam(':id_question', $question['id_question']);
                $req->execute();
    
                $answers = $req->fetchAll(PDO::FETCH_ASSOC);
    
                foreach ($answers as $answer) {
                    $newanswer = new Answer($answer['id_answer'], $answer['label'], $answer['id_question'] ,$answer['valid']);
                    array_push($listanswers, $newanswer);
                }
                $newquestion = new Question($question['id_question'], $question['label'], $question['level'], $listanswers);
                array_push($listquestions, $newquestion);
            }
    
            return $listquestions;

        } catch (\Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    public function updateQuestion(Question $question): bool
    {
        try{
            $pdo = SPDO::getInstance();
            $req = $pdo->prepare("UPDATE `question` 
                                  SET `label` = :label, `level` = :level 
                                  WHERE `id_question` = :id_question");
            $req->bindParam(':label', $question->getLabel());
            $req->bindParam(':level', $question->getLevel());
            $req->bindParam(':id_question', $question->getId());

            $this->deleteAllAnswer($question->getId());
            
            foreach($question->getAnswers() as $answer){
                $this->recreateAnswer($answer);
            }

            return $req->execute(); 
        } catch (\Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    public function deleteQuestion(int $id): bool
    {
        try {
            $pdo = SPDO::getInstance();
            $req = $pdo->prepare("DELETE FROM `answer` 
                                  WHERE `id_question` = :id_question;
                                  DELETE FROM `question` 
                                  WHERE `id_question` = :id_question");
            $req->bindValue(':id_question', $id);

            return $req->execute();

        } catch (\Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    public function getQuestionById(int $idquestion): Question
    {
        try{
            $pdo = SPDO::getInstance();
            $req = $pdo->prepare('SELECT * FROM `question` 
                                  WHERE `id_question` = :id_question');
            $req->bindParam(':id_question', $idquestion, PDO::PARAM_INT);

            $req->execute();
            $result = $req->fetch(PDO::FETCH_ASSOC);
            $question = new Question($result['id_question'], $result['label'], $result['level'], $this->getAllAnswerById($idquestion));

            return $question;

        } catch (\Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    public function getAllAnswerById(int $idquestion): Array
    {
        try{
            $listanswers = [];
            $pdo = SPDO::getInstance();
            $req = $pdo->prepare('SELECT * FROM `answer`
                                  WHERE `id_question` = :id_question');
            $req->bindParam(':id_question', $idquestion, PDO::PARAM_INT);

            $req->execute();
         
            $result = $req->fetchALL(PDO::FETCH_ASSOC);

            foreach ($result as $answer) {
                $newanswer = new Answer($answer['id_answer'], $answer['label'], $answer['id_question'] ,$answer['valid']);
                array_push($listanswers, $newanswer);
            }

            return $listanswers;

        } catch (\Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    public function deleteAnswer(int $idanswer): bool
    {
        try{
            $pdo = SPDO::getInstance();
            $req = $pdo->prepare('DELETE FROM `answer`
                                  WHERE `id_answer` = :id_answer');
            $req->bindParam(':id_answer', $idanswer, PDO::PARAM_INT);

            return $req->execute();;

        } catch (\Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    public function deleteAllAnswer(int $idquestion): bool
    {
        try{
            $pdo = SPDO::getInstance();
            $req = $pdo->prepare('DELETE FROM `answer`
                                  WHERE `id_question` = :id_question');
            $req->bindParam(':id_question', $idquestion, PDO::PARAM_INT);

            return $req->execute();

        } catch (\Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    public function recreateAnswer(Answer $answer): bool
    {
        try{
            $pdo = SPDO::getInstance();
            $req = $pdo->prepare('INSERT INTO answer(`id_question`, `label`, `valid`)
                                  VALUES (:id_question, :label, :valid)');
            $req->bindParam(':label', $answer->getLabel());
            $req->bindParam(':valid', $answer->getValid()); 
            $req->bindParam(':id_question', $answer->getQuestion());

            return $req->execute();

        } catch (\Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }
}


