<?php

namespace App\Entity;

use DateTime;

class User
{
    
    protected ?int $id = null;
    protected ?string $username = null;
    protected ?string $firstName = null;
    protected ?string $lastName = null;
    protected ?string $email = null;
    protected ?string $password = null;
    protected ?Array $role = null;
    protected ?string $createdAt = null;

    public function __construct(?int $id, ?string $username, ?string $firstName, ?string $lastName, ?string $email, ?string $password, ?Array $role, ?string $createdAt){
        $this->setId($id);
        $this->setUsername($username);
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setRole($role);
        $this->setCreatedAt($createdAt);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): User
    {
        $this->username = $username;

        return $this;
    }


    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): User
    {
        $this->firstName = $firstName;

        return $this;
    }


    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): User
    {
        $this->lastName = $lastName;

        return $this;
    }


    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): User
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getRole(): ?Array
    {
        return $this->role;
    }

    public function setRole(?Array $role): User
    {
        $this->role = $role;
        return $this;
    }

    public function getcreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function setcreatedAt(?string $createdAt): User
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
