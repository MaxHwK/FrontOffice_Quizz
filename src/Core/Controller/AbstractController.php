<?php

namespace Framework\Controller;

use Framework\Templating\Twig;
use Framework\Connexion\SPDO;
use PDO;

abstract class AbstractController
{
    public function render(string $template, array $args = []): string
    {
        $twig = new Twig();

        return $twig->render($template, $args);
    }

    public function isPost(): bool
    {
      return strtoupper($_SERVER['REQUEST_METHOD']) === 'POST';
    }

    public function redirect(string $uri): void
    {
      header("Location: $uri");
      die;
    }

    public function sessionIsStarted(array $session): bool
    {
      if (count($session) === 0) {
        return false;
      }
      return true;
    }

    public function checkUserCredentials(string $username, string $password): bool
    {
      try{
          $db = SPDO::getInstance();
          $stmt = $db->prepare('SELECT `password` 
                                FROM `user` 
                                WHERE `username` = :username');
          $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    
          if ($stmt->execute()) {
              $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
              if (isset($result['password']) && password_verify($password, $result['password'])) {
                  return true;
              }
              return false;
          }

      } catch (\Exception $e) {
          var_dump($e->getMessage());
      }

      return false;
    }

    public function displayErrors(array $errors, string $fieldName): string
    {
        $return = '';
        if (isset($errors[$fieldName])) {
            foreach ($errors[$fieldName] as $error) {
                if($return === '') {
                    $return .= $error;
                } else {
                    $return = $return . ' | ' . $error;
                }               
            }
        }

        return $return;
    }

    public function userExists(string $username): bool
    {
        try{
            $db = SPDO::getInstance();
            $stmt = $db->prepare('SELECT COUNT(*) AS nb 
                                  FROM `user` 
                                  WHERE `username`=:username');
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    
            if ($stmt->execute()) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result['nb'] > 0;
            }
    
            return false;

        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }

    public function getNumberOfUsers(): int
    {
        try {
            $db = SPDO::getInstance();
            $stmt = $db->prepare('SELECT COUNT(*) AS nb 
                                  FROM `user`');
    
            if ($stmt->execute()) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result['nb'];
            }
    
            return 0;

        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }

    public function getNumberOfQuestions(): int
    {
        try {
            $db = SPDO::getInstance();
            $stmt = $db->prepare('SELECT COUNT(*) AS nb 
                              FROM `question`');
    
            if ($stmt->execute()) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result['nb'];
            }
    
            return 0;

        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }

}
