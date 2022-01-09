<?php

namespace App\Entity;

class Question
{
    protected ?int $id;
    protected ?string $label = null;
    protected ?int $level;
    protected ?array $answers;

    public function __construct(?int $id, ?string $label, ?int $level, ?array $answers)
    {
        $this->setId($id);
        $this->setLabel($label);
        $this->setLevel($level);
        $this->setAnswers($answers);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Question
    {
        $this->id = $id;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): Question
    {
        $this->label = $label;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(?int $level): Question
    {
        $this->level = $level;

        return $this;
    }

    public function getAnswers(): ?array
    {
        return $this->answers;
    }

    public function setAnswers(?array $answers): Question
    {
        $this->answers = $answers;

        return $this;
    }

}