<?php

namespace App\Entity;

class PlayerSettings
{
    protected ?string $name;
    protected ?string $color;
    protected ?bool $host;

    public function __construct(?string $name, ?string $color, ?bool $host)
    {
        $this->setName($name);
        $this->setColor($color);
        $this->setHost($host);
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): PlayerSettings
    {
        $this->name = $name;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): PlayerSettings
    {
        $this->color = $color;

        return $this;
    }

    public function getHost(): ?bool
    {
        return $this->host;
    }

    public function setHost(?bool $host): PlayerSettings
    {
        $this->host = $host;

        return $this;
    }
}