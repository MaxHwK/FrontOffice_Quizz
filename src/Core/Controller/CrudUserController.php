<?php

namespace Framework\Controller;

use Framework\Connexion\SPDO;
use App\Entity\User;
use PDO;

Class CrudUserController
{
    public function createUser(User $user): bool
    {
        try {
            $pdo = SPDO::getInstance();
            $req = $pdo->prepare('INSERT INTO user(`username`, `password`, `email`, `firstname`, `lastname`, `createdat`)
                                  VALUES (:username, :password, :email, :firstname, :lastname, :createdat)');
    
            $password = password_hash($user->getPassword(), PASSWORD_ARGON2I);

            $req->bindParam(':username', $user->getUsername(), PDO::PARAM_STR);
            $req->bindParam(':password', $password, PDO::PARAM_STR);
            $req->bindParam(':firstname', $user->getFirstName(), PDO::PARAM_STR);
            $req->bindParam(':lastname', $user->getLastName(), PDO::PARAM_STR);
            $req->bindParam(':email', $user->getEmail(), PDO::PARAM_STR);
            $req->bindParam(':createdat', $user->getcreatedAt(), PDO::PARAM_STR);

            $res = $req->execute();
            $lastId = $pdo->lastInsertId();
            $user->setId($lastId);

            foreach($user->getRole() as $role) {       
                $this->addUserRole($this->getRoleByLabel($role), $user->getId());
            }

            return $res;
        } catch (\Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    public function readAllUsers(): array
    {
        try {
            $listUsers = [];
            $pdo = SPDO::getInstance();
            $req = $pdo->prepare("SELECT `username` 
                                  FROM `user`");

            $req->execute();

            $result = $req->fetchAll(PDO::FETCH_ASSOC);

            foreach($result as $user) {
                array_push($listUsers,$this->getUserByUserName($user['username']));
            }

            return $listUsers;

        } catch (\Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    public function updateUser(User $user): bool
    {
        try{
            $pdo = SPDO::getInstance();
            $req = $pdo->prepare("UPDATE `user` 
                                  SET `username` = :username, `email` = :email,
                                  `firstname` = :firstname, `lastname` = :lastname
                                  WHERE `id_user` = :id_user");

            $req->bindParam(':username', $user->getUsername(), PDO::PARAM_STR);
            $req->bindParam(':firstname', $user->getFirstName(), PDO::PARAM_STR);
            $req->bindParam(':lastname', $user->getLastName(), PDO::PARAM_STR);
            $req->bindParam(':email', $user->getEmail(), PDO::PARAM_STR);
            $req->bindParam(':id_user', $user->getId(), PDO::PARAM_INT);
            
            return $req->execute();
        } catch (\Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    public function deleteUser(int $id): bool
    {
        try {
            $pdo = SPDO::getInstance();
            $req = $pdo->prepare("DELETE FROM `userrole` 
                                  WHERE `id_user` = :id_user;
                                  DELETE FROM `user`  
                                  WHERE `id_user` = :id_user");
            $req->bindParam(':id_user', $id, PDO::PARAM_INT);

            return $req->execute();

        } catch (\Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    public function getRoleByLabel(string $label): int
    {
        try {
            $pdo = SPDO::getInstance();
            $req = $pdo->prepare("SELECT `id_role` 
                                  FROM `role` 
                                  WHERE `label` = :label");
            $req->bindParam(':label', $label, PDO::PARAM_STR);
    
            $req->execute();
    
            $result = $req->fetch(PDO::FETCH_ASSOC);
            return $result['id_role'];

        } catch (\Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    public function addUserRole(int $id_role, int $id_user): bool
    {
        try{
            $pdo = SPDO::getInstance();
            $req = $pdo->prepare('INSERT INTO userrole(`id_role`, `id_user`)
                                  VALUES (:id_role, :id_user)');

            $req->bindParam(':id_role', $id_role, PDO::PARAM_INT);
            $req->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    
            return $req->execute();

        } catch (\Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    public function getUserByUserName(string $username): User
    {
        try{
            $pdo = SPDO::getInstance();
            $req = $pdo->prepare('SELECT * FROM `user` 
                                  WHERE `username` = :username');
            $req->bindParam(':username', $username, PDO::PARAM_STR);

            $req->execute();
            $result = $req->fetch(PDO::FETCH_ASSOC);
            $user = new User($result['id_user'], $result['username'], $result['firstname'], $result['lastname'], $result['email'], $result['password'], $this->getRolesById($result['id_user']), $result['createdat']);

            return $user;

        } catch (\Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    public function getRolesById(int $id_user): array
    {
        try {
            $pdo = SPDO::getInstance();
            $req = $pdo->prepare('SELECT role.label 
                                  FROM `userrole`, `role` 
                                  WHERE userrole.id_role = role.id_role
                                  AND `id_user` = :id_user');
            $req->bindParam(':id_user', $id_user, PDO::PARAM_INT);

            $req->execute();

            $result = $req->fetchAll(PDO::FETCH_ASSOC);

            foreach($result as $role) {
                $roles[] = $role['label'];
            }

            return $roles;

        } catch (\Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    public function getUserById(int $iduser): User
    {
        try{
            $pdo = SPDO::getInstance();
            $req = $pdo->prepare('SELECT * FROM `user` 
                                  WHERE `id_user` = :id_user');
            $req->bindParam(':id_user', $iduser, PDO::PARAM_INT);

            $req->execute();
            $result = $req->fetch(PDO::FETCH_ASSOC);
            $user = new User($result['id_user'], $result['username'], $result['firstname'], $result['lastname'], $result['email'], $result['password'], $this->getRolesById($result['id_user']), $result['createdat']);

            return $user;

        } catch (\Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    public function getEmailByUsername($username)
    {
        try{
            $pdo = SPDO::getInstance();
            $mail = $pdo->prepare('SELECT `email` FROM `user` WHERE `username` = :username');
            $mail->bindParam(':username', $username, PDO::PARAM_STR);
            $mail->execute();
            $recupmail = $mail->fetchAll(PDO::FETCH_ASSOC);
    
            return $recupmail;
            
        } catch (\Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }
}


