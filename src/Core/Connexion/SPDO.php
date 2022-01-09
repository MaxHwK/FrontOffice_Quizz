<?php 

namespace Framework\Connexion;

use Framework\Config\Config;
use PDO;

class SPDO
{
    private $PDOInstance;
    private static $instance;
    private $host;
    private $dataBase;
    private $user;
    private $password;

    public function __construct()
    {
        $this->host = Config::getDb('HOST');
        $this->dataBase = Config::getDb('DATABASE');
        $this->user = Config::getDb('USER');
        $this->password = Config::getDb('PASSWORD');
        try {
            $this->PDOInstance = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dataBase, $this->user, $this->password);
        } catch (\PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
        }
    }

    public static function getInstance()
    {  
      if(is_null(self::$instance))
      {
        self::$instance = new SPDO();
      }
      return self::$instance;
    }

    public function query($query)
    {
      return $this->PDOInstance->query($query);
    }

    public function prepare($prepared)
    {
      return $this->PDOInstance->prepare($prepared);
    }

    public function lastInsertId()
    {
      return $this->PDOInstance->lastInsertId();
    }
}