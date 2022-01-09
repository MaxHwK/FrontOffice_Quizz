<?php

namespace App\Entity;

class Answer
{
    protected ?int $id;
    protected ?string $label = null;
    protected ?int $question;
    protected ?bool $valid;

    public function __construct(?int $id, ?string $label, ?int $question, ?bool $valid)
    {
        $this->setId($id);
        $this->setLabel($label);
        $this->setQuestion($question);
        $this->setValid($valid);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Answer
    {
        $this->id = $id;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): Answer
    {
        $this->label = $label;

        return $this;
    }

    public function getQuestion(): ?int
    {
        return $this->question;
    }

    public function setQuestion(?int $question): Answer
    {
        $this->question = $question;

        return $this;
    }

    public function getValid(): ?bool
    {
        return $this->valid;
    }

    public function setValid(?bool $valid): Answer
    {
        $this->valid = $valid;

        return $this;
    }

}