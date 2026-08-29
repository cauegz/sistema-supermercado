<?php

namespace App\Model;

use LogicException;

class Marca
{
    private ?int $id = null;

    public function __construct(private string $nome) {}

    public function getId(): ?int { return $this->id; }
    public function getNome(): string { return $this->nome; }

    public function setId(int $id): self
    {
        if ($this->id !== null) throw new LogicException("O id ja existe");
        $this->id = $id;
        return $this;
    }

    public function setNome(string $nome): self { $this->nome = $nome; return $this; }
}
